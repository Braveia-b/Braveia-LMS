<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    public function get_all()
    {
        if (!$this->db->table_exists('settings')) return [];
        $this->db->order_by('key_name', 'ASC');
        return $this->db->get('settings')->result();
    }

    public function get_by_key($key_name)
    {
        if (!$this->db->table_exists('settings')) return null;
        return $this->db->get_where('settings', ['key_name' => $key_name])->row();
    }

    public function upsert($key_name, $value)
    {
        if (!$this->db->table_exists('settings')) return false;
        $existing = $this->get_by_key($key_name);
        if ($existing) {
            $this->db->where('id', (int)$existing->id);
            return $this->db->update('settings', ['value' => $value]);
        }
        return $this->db->insert('settings', ['key_name' => $key_name, 'value' => $value]);
    }

    public function get_map($keys)
    {
        $keys = array_values(array_filter(array_map('strval', (array)$keys)));
        $map = [];
        foreach ($keys as $k) $map[$k] = null;
        if (!$this->db->table_exists('settings') || empty($keys)) return $map;

        $this->db->select('key_name, value');
        $this->db->from('settings');
        $this->db->where_in('key_name', $keys);
        $rows = $this->db->get()->result();
        foreach ($rows as $r) {
            $map[$r->key_name] = $r->value;
        }
        return $map;
    }

    public function delete($id)
    {
        if (!$this->db->table_exists('settings')) return false;
        $this->db->where('id', (int)$id);
        return $this->db->delete('settings');
    }
}

