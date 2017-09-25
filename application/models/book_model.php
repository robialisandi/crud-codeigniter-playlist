<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book_model extends CI_Model
{
   var $table = 'books';

   public function __construct()
   {
      parent::__construct();
      $this->load->database();
   }

   public function get_all_books($limit, $start){

      $this->db->limit($limit, $start);
      $query = $this->db->get($this->table);

      if($query->num_rows() > 0)
      {
         foreach ($query->result() as $row)
         {
            $data[] = $row;
         }
         return $data;
      }
      return false;
   }

   public function get_by_id($id)
   {
      $this->db->from($this->table);
      $this->db->where('book_id', $id);
      $query = $this->db->get();

      return $query->row();
   }

   public function book_add($data)
   {
      $this->db->insert($this->table, $data);
      return $this->db->insert_id();
   }

   public function book_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

   public function delete_by_id($id)
	{
		$this->db->where('book_id', $id);
		$this->db->delete($this->table);
	}

   public function get_count_books()
   {
      //return $this->db->get($this->table)->num_rows();
      return $this->db->count_all($this->table);
      // $this->db->from($this->table);
      // $query = $this->db->get();
      // return $query->num_rows();
   }

}
