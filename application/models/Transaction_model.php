<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model {

    public function count_payments($filters = [])
    {
        if (!$this->db->table_exists('payments')) return 0;

        $this->apply_filters($filters);
        return (int) $this->db->count_all_results();
    }

    public function list_payments($filters = [], $limit = 20, $offset = 0)
    {
        if (!$this->db->table_exists('payments')) return [];

        $this->db->select('payments.id, payments.order_id, payments.user_id, payments.amount, payments.payment_type, payments.status, payments.item_type, payments.item_id, payments.created_at, users.name AS user_name, users.email AS user_email');
        $this->db->from('payments');
        $this->db->join('users', 'users.id = payments.user_id', 'left');

        $this->apply_filters($filters, false);

        $this->db->order_by('payments.created_at', 'DESC');
        $this->db->limit((int)$limit, (int)$offset);
        $rows = $this->db->get()->result();

        // best-effort item title
        foreach ($rows as $r) {
            $r->item_title = null;
            if ($r->item_type === 'Training' && $this->db->table_exists('trainings')) {
                $t = $this->db->select('title')->from('trainings')->where('id', $r->item_id)->get()->row();
                $r->item_title = $t->title ?? null;
            } elseif ($r->item_type === 'Webinar' && $this->db->table_exists('webinars')) {
                $w = $this->db->select('title')->from('webinars')->where('id', $r->item_id)->get()->row();
                $r->item_title = $w->title ?? null;
            } elseif ($r->item_type === 'Mentoring') {
                $r->item_title = 'Sesi Mentoring';
            }
        }

        return $rows;
    }

    private function apply_filters($filters = [], $from_added = true)
    {
        if (!$from_added) {
            // from already set in list_payments
        } else {
            $this->db->from('payments');
            $this->db->join('users', 'users.id = payments.user_id', 'left');
        }

        $q = trim((string)($filters['q'] ?? ''));
        if ($q !== '') {
            $this->db->group_start();
            $this->db->like('payments.order_id', $q);
            $this->db->or_like('users.name', $q);
            $this->db->or_like('users.email', $q);
            $this->db->group_end();
        }

        $status = trim((string)($filters['status'] ?? ''));
        if ($status !== '' && in_array($status, ['Pending','Success','Failed','Expired'], true)) {
            $this->db->where('payments.status', $status);
        }

        $item_type = trim((string)($filters['item_type'] ?? ''));
        if ($item_type !== '' && in_array($item_type, ['Training','Webinar','Mentoring'], true)) {
            $this->db->where('payments.item_type', $item_type);
        }

        $date_from = trim((string)($filters['date_from'] ?? ''));
        if ($date_from !== '') {
            $this->db->where('DATE(payments.created_at) >=', $date_from);
        }
        $date_to = trim((string)($filters['date_to'] ?? ''));
        if ($date_to !== '') {
            $this->db->where('DATE(payments.created_at) <=', $date_to);
        }
    }
}

