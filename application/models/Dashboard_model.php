<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    /** @var int */
    private $days = 30;

    public function __construct()
    {
        parent::__construct();
        $this->ensure_enrollments_table();
    }

    /**
     * Buat tabel enrollment jika belum ada (development-friendly).
     */
    private function ensure_enrollments_table()
    {
        if ($this->db->table_exists('user_enrollments')) {
            return;
        }

        $this->db->query("CREATE TABLE IF NOT EXISTS `user_enrollments` (
            `id` int NOT NULL AUTO_INCREMENT,
            `user_id` int NOT NULL,
            `training_id` int NOT NULL,
            `enrolled_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `user_training_unique` (`user_id`,`training_id`),
            KEY `idx_enrolled_at` (`enrolled_at`),
            KEY `idx_training_id` (`training_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci");
    }

    public function set_range_days($days)
    {
        $allowed = [7, 30, 90];
        $this->days = in_array((int) $days, $allowed, true) ? (int) $days : 30;
        return $this;
    }

    public function get_range_days()
    {
        return $this->days;
    }

    private function since_datetime()
    {
        return date('Y-m-d H:i:s', strtotime('-' . $this->days . ' days'));
    }

    public function get_kpis()
    {
        $since = $this->since_datetime();
        $today_start = date('Y-m-d 00:00:00');
        $month_start = date('Y-m-01 00:00:00');

        $kpis = [
            'participants_active' => 0,
            'mentors_total' => 0,
            'mentors_inactive' => 0,
            'trainings_total' => 0,
            'trainings_published' => 0,
            'trainings_draft' => 0,
            'webinars_total' => 0,
            'webinars_upcoming' => 0,
            'certificates_total' => 0,
            'revenue_period' => 0.0,
            'revenue_today' => 0.0,
            'revenue_month' => 0.0,
            'payments_pending' => 0,
            'enrollments_period' => 0,
            'enrollments_total' => 0,
            'range_days' => $this->days,
        ];

        $this->db->from('users');
        $this->db->where('role_id', 4);
        $this->db->where('is_active', 1);
        $kpis['participants_active'] = (int) $this->db->count_all_results();

        if ($this->db->table_exists('mentors')) {
            $this->db->from('mentors');
            $kpis['mentors_total'] = (int) $this->db->count_all_results();
        } else {
            $this->db->from('users');
            $this->db->where('role_id', 3);
            $kpis['mentors_total'] = (int) $this->db->count_all_results();
        }

        $this->db->from('users');
        $this->db->where('role_id', 3);
        $this->db->where('is_active', 0);
        $kpis['mentors_inactive'] = (int) $this->db->count_all_results();

        $this->db->from('trainings');
        $kpis['trainings_total'] = (int) $this->db->count_all_results();

        $this->db->from('trainings');
        $this->db->where('is_published', 1);
        $kpis['trainings_published'] = (int) $this->db->count_all_results();

        $kpis['trainings_draft'] = $kpis['trainings_total'] - $kpis['trainings_published'];

        if ($this->db->table_exists('webinars')) {
            $this->db->from('webinars');
            $kpis['webinars_total'] = (int) $this->db->count_all_results();

            $this->db->from('webinars');
            $this->db->where('schedule_datetime >=', date('Y-m-d H:i:s'));
            $kpis['webinars_upcoming'] = (int) $this->db->count_all_results();
        }

        if ($this->db->table_exists('certificates')) {
            $this->db->from('certificates');
            $kpis['certificates_total'] = (int) $this->db->count_all_results();
        }

        if ($this->db->table_exists('user_enrollments')) {
            $this->db->from('user_enrollments');
            $kpis['enrollments_total'] = (int) $this->db->count_all_results();

            $this->db->from('user_enrollments');
            $this->db->where('enrolled_at >=', $since);
            $kpis['enrollments_period'] = (int) $this->db->count_all_results();
        }

        if ($this->db->table_exists('payments')) {
            $this->db->select('COALESCE(SUM(amount), 0) AS total', false);
            $this->db->from('payments');
            $this->db->where('status', 'Success');
            $this->db->where('created_at >=', $since);
            $kpis['revenue_period'] = (float) ($this->db->get()->row()->total ?? 0);

            $this->db->select('COALESCE(SUM(amount), 0) AS total', false);
            $this->db->from('payments');
            $this->db->where('status', 'Success');
            $this->db->where('created_at >=', $today_start);
            $kpis['revenue_today'] = (float) ($this->db->get()->row()->total ?? 0);

            $this->db->select('COALESCE(SUM(amount), 0) AS total', false);
            $this->db->from('payments');
            $this->db->where('status', 'Success');
            $this->db->where('created_at >=', $month_start);
            $kpis['revenue_month'] = (float) ($this->db->get()->row()->total ?? 0);

            $this->db->from('payments');
            $this->db->where('status', 'Pending');
            $kpis['payments_pending'] = (int) $this->db->count_all_results();
        }

        return $kpis;
    }

    /**
     * Item yang perlu ditindaklanjuti admin.
     */
    public function get_attention_items()
    {
        $items = [];

        if ($this->db->table_exists('payments')) {
            $this->db->from('payments');
            $this->db->where('status', 'Pending');
            $pending_count = (int) $this->db->count_all_results();

            if ($pending_count > 0) {
                $this->db->select('payments.id, payments.order_id, payments.amount, payments.created_at, users.name AS user_name');
                $this->db->from('payments');
                $this->db->join('users', 'users.id = payments.user_id', 'left');
                $this->db->where('payments.status', 'Pending');
                $this->db->order_by('payments.created_at', 'DESC');
                $this->db->limit(5);
                $pending = $this->db->get()->result();

                $items[] = [
                    'type' => 'pending_payments',
                    'icon' => 'fa-receipt',
                    'title' => 'Transaksi pending',
                    'count' => $pending_count,
                    'url' => base_url('admin/transaction?status=Pending'),
                    'rows' => $pending,
                ];
            }
        }

        $this->db->from('trainings');
        $this->db->where('is_published', 0);
        $draft_count = (int) $this->db->count_all_results();

        if ($draft_count > 0) {
            $this->db->select('id, title, created_at');
            $this->db->from('trainings');
            $this->db->where('is_published', 0);
            $this->db->order_by('created_at', 'DESC');
            $this->db->limit(5);
            $drafts = $this->db->get()->result();

            $items[] = [
                'type' => 'draft_trainings',
                'icon' => 'fa-book',
                'title' => 'Program masih draft',
                'count' => $draft_count,
                'url' => base_url('admin/training'),
                'rows' => $drafts,
            ];
        }

        $this->db->from('users');
        $this->db->where('role_id', 3);
        $this->db->where('is_active', 0);
        $inactive_count = (int) $this->db->count_all_results();

        if ($inactive_count > 0) {
            $this->db->select('id, name, email');
            $this->db->from('users');
            $this->db->where('role_id', 3);
            $this->db->where('is_active', 0);
            $this->db->limit(5);
            $inactive_mentors = $this->db->get()->result();

            $items[] = [
                'type' => 'inactive_mentors',
                'icon' => 'fa-chalkboard-teacher',
                'title' => 'Mentor nonaktif',
                'count' => $inactive_count,
                'url' => base_url('admin/mentor'),
                'rows' => $inactive_mentors,
            ];
        }

        if ($this->db->table_exists('webinars')) {
            $this->db->select('webinars.id, webinars.title, webinars.schedule_datetime');
            $this->db->from('webinars');
            $this->db->where('schedule_datetime >=', date('Y-m-d H:i:s'));
            $this->db->where('schedule_datetime <=', date('Y-m-d H:i:s', strtotime('+14 days')));
            $this->db->order_by('webinars.schedule_datetime', 'ASC');
            $this->db->limit(5);
            $upcoming = $this->db->get()->result();
            if (count($upcoming) > 0) {
                $items[] = [
                    'type' => 'upcoming_webinars',
                    'icon' => 'fa-video',
                    'title' => 'Webinar 14 hari ke depan',
                    'count' => count($upcoming),
                    'url' => base_url('admin/webinar'),
                    'rows' => $upcoming,
                ];
            }
        }

        return $items;
    }

    public function get_top_programs($limit = 5)
    {
        $limit = (int) $limit;
        if (!$this->db->table_exists('user_enrollments')) {
            return [];
        }

        $this->db->select('trainings.id, trainings.title, COUNT(user_enrollments.id) AS enroll_count');
        $this->db->from('user_enrollments');
        $this->db->join('trainings', 'trainings.id = user_enrollments.training_id');
        $this->db->where('user_enrollments.enrolled_at >=', $this->since_datetime());
        $this->db->group_by('trainings.id, trainings.title');
        $this->db->order_by('enroll_count', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function get_recent_payments($limit = 8)
    {
        if (!$this->db->table_exists('payments')) {
            return [];
        }

        $this->db->select('payments.id, payments.order_id, payments.amount, payments.status, payments.item_type, payments.item_id, payments.created_at, users.name AS user_name, users.email AS user_email');
        $this->db->from('payments');
        $this->db->join('users', 'users.id = payments.user_id', 'left');
        $this->db->order_by('payments.created_at', 'DESC');
        $this->db->limit((int) $limit);
        $payments = $this->db->get()->result();

        foreach ($payments as $p) {
            $p->item_title = $this->resolve_item_title($p->item_type, $p->item_id);
        }

        return $payments;
    }

    public function get_recent_participants($limit = 6)
    {
        $this->db->select('id, name, email, created_at, is_active');
        $this->db->from('users');
        $this->db->where('role_id', 4);
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit((int) $limit);
        return $this->db->get()->result();
    }

    public function get_timeseries_payments_success($days = null)
    {
        if (!$this->db->table_exists('payments')) {
            return [];
        }

        $days = $days ?? min($this->days, 30);
        $days = max(7, min(90, (int) $days));
        $since_date = date('Y-m-d', strtotime('-' . ($days - 1) . ' days'));

        $this->db->select("DATE(created_at) AS d, COUNT(*) AS c, COALESCE(SUM(amount),0) AS a", false);
        $this->db->from('payments');
        $this->db->where('status', 'Success');
        $this->db->where('DATE(created_at) >=', $since_date);
        $this->db->group_by('DATE(created_at)');
        $rows = $this->db->get()->result();

        $map = [];
        foreach ($rows as $r) {
            $map[$r->d] = ['count' => (int) $r->c, 'amount' => (float) $r->a];
        }

        $series = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $d = date('Y-m-d', strtotime('-' . $i . ' days'));
            $series[] = [
                'date' => $d,
                'count' => $map[$d]['count'] ?? 0,
                'amount' => $map[$d]['amount'] ?? 0.0,
            ];
        }

        return $series;
    }

    public function get_timeseries_enrollments($days = null)
    {
        if (!$this->db->table_exists('user_enrollments')) {
            return [];
        }

        $days = $days ?? min($this->days, 30);
        $days = max(7, min(90, (int) $days));
        $since_date = date('Y-m-d', strtotime('-' . ($days - 1) . ' days'));

        $this->db->select('DATE(enrolled_at) AS d, COUNT(*) AS c', false);
        $this->db->from('user_enrollments');
        $this->db->where('DATE(enrolled_at) >=', $since_date);
        $this->db->group_by('DATE(enrolled_at)');
        $rows = $this->db->get()->result();

        $map = [];
        foreach ($rows as $r) {
            $map[$r->d] = (int) $r->c;
        }

        $series = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $d = date('Y-m-d', strtotime('-' . $i . ' days'));
            $series[] = [
                'date' => $d,
                'count' => $map[$d] ?? 0,
            ];
        }

        return $series;
    }

    private function resolve_item_title($item_type, $item_id)
    {
        if ($item_type === 'Training' && $this->db->table_exists('trainings')) {
            $row = $this->db->select('title')->from('trainings')->where('id', $item_id)->get()->row();
            return $row->title ?? null;
        }
        if ($item_type === 'Webinar' && $this->db->table_exists('webinars')) {
            $row = $this->db->select('title')->from('webinars')->where('id', $item_id)->get()->row();
            return $row->title ?? null;
        }
        if ($item_type === 'Mentoring') {
            return 'Sesi Mentoring';
        }
        return null;
    }
}
