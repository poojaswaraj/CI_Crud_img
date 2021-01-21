<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_Category extends CI_Controller {

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
	 		$this->load->model('Sub_Category_model');
	 	}

 
	public function index($id)
	{
 
		$data['Sub_categorys']=$this->Sub_Category_model->get_all_books($id);
		$this->load->view('Sub_category_view',$data);
	}
	public function Sub_Category_add()
		{
                        $data = array(
					'category_id' => $this->input->post('cat_id'),
					'sub_category_name' => $this->input->post('Sub_cat_name'),
					
				);
			$insert = $this->Sub_Category_model->Sub_Category_add($data);
			// redirect(site_url('book/index'));
			echo json_encode(array("status" => TRUE));
                }

		public function ajax_edit($id)
		{
			$data = $this->Sub_Category_model->get_by_id($id);



			echo json_encode($data);
		}
 
		public function Sub_Category_update()
	{
	

				
                	 $data = array(
					'sub_category_name' => $this->input->post('Sub_cat_name'),
					
				);
				$this->Sub_Category_model->Sub_Category_update(array('id' => $this->input->post('Sub_cat_id')), $data);
				echo json_encode(array("status" => TRUE));
                  
			
			
	}

	public function Sub_Category_delete($id)
	{
		$this->Sub_Category_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}



}