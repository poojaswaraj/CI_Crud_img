<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	/** 
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	 public function __construct()
	 	{
	 		parent::__construct();
	  $this->load->helper(array('form', 'url'));
	 		$this->load->model('Product_model');
	 	}

 
	public function index($id)
	{
 
		$data['Products']=$this->Product_model->get_all_books($id);
		$this->load->view('Product_view',$data);
	}
	public function Product_add()
		{
                        $data = array(
					'sub_cat_id' => $this->input->post('sub_cat_id'),
					'product_name' => $this->input->post('Product_name'),
					'price' => $this->input->post('Product_Price'),
					
				);
			$insert = $this->Product_model->Product_add($data);
			// redirect(site_url('book/index'));
			echo json_encode(array("status" => TRUE));
                }

		public function ajax_edit($id)
		{
			$data = $this->Product_model->get_by_id($id);



			echo json_encode($data);
		}
 
		public function Product_update()
	{
	

				
                	 $data = array(
					'product_name' => $this->input->post('Product_name'),
					'price' => $this->input->post('Product_Price'),
					
				);
				$this->Product_model->Product_update(array('id' => $this->input->post('product_id')), $data);
				echo json_encode(array("status" => TRUE));
                  
			
			
	}

	public function Product_delete($id)
	{
		$this->Product_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}



}