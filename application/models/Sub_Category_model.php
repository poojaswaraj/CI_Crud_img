<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_Category_model extends CI_Model
{

	var $table = 'sub_category';


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


public function get_all_books($id)
{
$this->db->select('sub_category.id as ids,sub_category.*,category.*,category.id as cat_id');
$this->db->from('sub_category');
$this->db->where('category_id',$id);
$this->db->join('category','sub_category.category_id=category.id');
$query=$this->db->get();
return $query->result(); 
}


	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function Sub_Category_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function Sub_Category_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{

		
		
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}


}