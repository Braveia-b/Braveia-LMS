<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function get_kpis()
    {
        $kpis = [
            'participants_active' => 0,
            'mentors_total' => 0,
            'trainings_total' => 0,
            'webinars_total' => 0,
            'certificates_total' => 0,
            'revenue_30d_success' => 0.0,
            'payments_pending' => 0,
            'enrollments_30d' => 0,
        ];

        // Participants (role_id = 4) active
        $this->db->from('users');
        $this->db->where('role_id', 4);
        $this->db->where('is_active', 1);
        $kpis['participants_active'] = (int) $this->db->count_all_results();

        // Mentors total (role_id = 3) — fallback to mentors table if exists
        if ($this->db->table_exists('mentors')) {
            $this->db->from('mentors');
            $kpis['mentors_total'] = (int) $this->db->count_all_results();
        } else {
            $this->db->from('users');
            $this->db->where('role_id', 3);
            $kpis['mentors_total'] = (int) $this->db->count_all_results();
        }

        // Trainings total
        $this->db->from('trainings');
        $kpis['trainings_total'] = (int) $this->db->count_all_results();

        // Webinars total (optional)
        if ($this->db->table_exists('webinars')) {
            $this->db->from('webinars');
            $kpis['webinars_total'] = (int) $this->db->count_all_results();
        }

        // Certificates total (optional)
        if ($this->db->table_exists('certificates')) {
            $this->db->from('certificates');
            $kpis['certificates_total'] = (int) $this->db->count_all_results();
        }

        // Payments & revenue (last 30 days)
        if ($this->db->table_exists('payments')) {
            $since = date('Y-m-d H:i:s', strtotime('-30 days'));

            $this->db->select('COALESCE(SUM(amount), 0) AS total', false);
            $this->db->from('payments');
            $this->db->where('status', 'Success');
            $this->db->where('created_at >=', $since);
            $kpis['revenue_30d_success'] = (float) ($this->db->get()->row()->total ?? 0);

            $this->db->from('payments');
            $this->db->where('status', 'Pending');
            $kpis['payments_pending'] = (int) $this->db->count_all_results();
        }

        // Enrollments last 30 days (best effort)
        if ($this->db->table_exists('user_enrollments')) {
            $since = date('Y-m-d H:i:s', strtotime('-30 days'));
            $this->db->from('user_enrollments');
            $this->db->where('enrolled_at >=', $since);
            $kpis['enrollments_30d'] = (int) $this->db->count_all_results();
        } elseif ($this->db->table_exists('payments')) {
            // Approximate: successful training payments within 30 days
            $since = date('Y-m-d H:i:s', strtotime('-30 days'));
            $this->db->from('payments');
            $this->db->where('status', 'Success');
            $this->db->where('item_type', 'Training');
            $this->db->where('created_at >=', $since);
            $kpis['enrollments_30d'] = (int) $this->db->count_all_results();
        }

        return $kpis;
    }

    public function get_recent_payments($limit = 8)
    {
        if (!$this->db->table_exists('payments')) return [];

        $this->db->select('payments.id, payments.order_id, payments.amount, payments.status, payments.item_type, payments.item_id, payments.created_at, users.name AS user_name, users.email AS user_email');
        $this->db->from('payments');
        $this->db->join('users', 'users.id = payments.user_id', 'left');
        $this->db->order_by('payments.created_at', 'DESC');
        $this->db->limit((int) $limit);
        $payments = $this->db->get()->result();

        // Attach item title (training/webinar) best-effort
        foreach ($payments as $p) {
            $p->item_title = null;
            if ($p->item_type === 'Training' && $this->db->table_exists('trainings')) {
                $row = $this->db->select('title')->from('trainings')->where('id', $p->item_id)->get()->row();
                $p->item_title = $row->title ?? null;
            } elseif ($p->item_type === 'Webinar' && $this->db->table_exists('webinars')) {
                $row = $this->db->select('title')->from('webinars')->where('id', $p->item_id)->get()->row();
                $p->item_title = $row->title ?? null;
            } elseif ($p->item_type === 'Mentoring' && $this->db->table_exists('bookings')) {
                $p->item_title = 'Sesi Mentoring';
            }
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

    public function get_timeseries_payments_success($days = 14)
    {
        if (!$this->db->table_exists('payments')) return [];

        $days = max(7, (int) $days);
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
}

