<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

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
	 		$this->load->model('Category_model');
	 	}

 
	public function index()
	{
 
		$data['categorys']=$this->Category_model->get_all_books();
		$this->load->view('category_view',$data);
	}
	public function Category_add()
		{
                        $data = array(
					'cat_name' => $this->input->post('cat_name'),
					
				);
			$insert = $this->Category_model->Category_add($data);
			// redirect(site_url('book/index'));
			echo json_encode(array("status" => TRUE));
                }

		public function ajax_edit($id)
		{
			$data = $this->Category_model->get_by_id($id);



			echo json_encode($data);
		}
 
		public function Category_update()
	{
	

				
                	 $data = array(
					'cat_name' => $this->input->post('cat_name'),
					
				);
				$this->Category_model->Category_update(array('id' => $this->input->post('cat_id')), $data);
				echo json_encode(array("status" => TRUE));
                  
			
			
	}

	public function Category_delete($id)
	{
		$this->Category_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}



}