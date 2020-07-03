<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Summernote_model extends CI_Model
{
    /**
     * Adiciona na tabela table
     *
     * @param array $data
     * @return bool
     */
    public function insert($data)
    {
        $this->load->database();

        $row = array(
            'title' => $data['title'],
            'text' => $data['text'],
            'update_date' => date('Y-m-d H:i:s')
        );

        return $this->db->insert('table', $row) ?: false;
    }

    /**
     * Recebe dados da tabela baseados, ou não, no ID
     *
     * @param int|null $id
     * @return array
     */
    public function select_news($id = NULL)
    {
        if ($id) {
            $query = $this->db->select('id,title, text, update_date')
                ->from('table')
                ->where('id', $id)
                ->get()->row();
        } else {
            $query = $this->db->select('id,title')
                ->from('table')
                ->where('deleted_at', NULL)
                ->order_by('created_at', 'desc')
                ->get()->result();
        }

        return $query;
    }
}
