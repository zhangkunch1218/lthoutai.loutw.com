<?php
class Scenic_base_model extends CI_Model
{
    private $table = 'scenic_base';

    public function findById($sid)
    {
        $this->db->where('sid', $sid);
        return $this->db->get($this->table);
    }

    public function total($params=array()) 
    {
        $this->db->from($this->table);
        if (!empty($params['sid'])) {
            $this->db->where('sid', $params['sid']);
        }
        if (!empty($params['scenic_name'])) {
            $this->db->where('scenic_name', $params['scenic_name']);
        }
        if (!empty($params['uid'])) {
            $this->db->where('uid', $params['uid']);
        }
        if (!empty($params['scope'])) {
            $this->db->where('scope', $params['scope']);
        }
        if (!empty($params['status'])) {
            $this->db->where('status', $params['status']);
        }
        if (!empty($params['start_time'])) {
            $this->db->where('created_at >=', $params['start_time'].' 00:00:00');
        }
        if (!empty($params['end_time'])) {
            $this->db->where('created_at <=', $params['end_time'].' 23:59:59');
        }
        return $this->db->count_all_results();
    }   
			
    public function page_list($page_num, $num, $params=array())
    {
        $this->db->from($this->table);
        if (!empty($params['sid'])) {
            $this->db->where('sid', $params['sid']);
        }
        if (!empty($params['scenic_name'])) {
            $this->db->where('scenic_name', $params['scenic_name']);
        }
        if (!empty($params['uid'])) {
            $this->db->where('uid', $params['uid']);
        }
        if (!empty($params['scope'])) {
            $this->db->where('scope', $params['scope']);
        }
        if (!empty($params['status'])) {
            $this->db->where('status', $params['status']);
        }
        if (!empty($params['start_time'])) {
            $this->db->where('created_at >=', $params['start_time'].' 00:00:00');
        }
        if (!empty($params['end_time'])) {
            $this->db->where('created_at <=', $params['end_time'].' 23:59:59');
        }
        $this->db->order_by('sid', 'DESC');
        $this->db->limit($page_num, $num);
        return $this->db->get();
    }

    public function insert($postData=array())
    {
        $data = array(
            'coupon_set_id' => $postData['coupon_set_id'],
            'coupon_name'   => $postData['coupon_name'],
            'uid'           => $postData['uid'],
            'scope'         => $postData['scope'],
            'related_id'    => $postData['related_id'],
            'amount'        => $postData['amount'],
            'condition'     => !empty($postData['condition']) ? $postData['condition'] : 0,
            'note'          => !empty($postData['note']) ? $postData['note'] : '',
            'start_time'    => $postData['start_time'],
            'end_time'      => $postData['end_time'],
            'status'        => $postData['status'],
            'created_at'    => date('Y-m-d H:i:s'),
        );
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function update($postData=array())
    {
        $data = array(
            'coupon_name'   => $postData['coupon_name'],
            'uid'           => $postData['uid'],
            'scope'         => $postData['scope'],
            'related_id'    => $postData['related_id'],
            'amount'        => $postData['amount'],
            'condition'     => $postData['condition'],
            'note'          => !empty($postData['note']) ? $postData['note'] : '',
            'start_time'    => $postData['start_time'],
            'end_time'      => $postData['end_time'],
            'status'        => $postData['status'],
        );
        $this->db->where('coupon_get_id', $postData['coupon_get_id']);
        return $this->db->update($this->table, $data);
    }
}