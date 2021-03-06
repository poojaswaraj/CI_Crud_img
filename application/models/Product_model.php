<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model
{

	var $table = 'product';


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


public function get_all_books($id)
{
$this->db->select('*');
$this->db->from('product');
$this->db->where('sub_cat_id',$id);

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

	public function Product_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function Product_update($where, $data)
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