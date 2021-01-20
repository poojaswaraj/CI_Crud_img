<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller {

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
	 		$this->load->model('book_model');
	 	}

 
	public function index()
	{

		$data['books']=$this->book_model->get_all_books();
		$this->load->view('book_view',$data);
	}
	public function book_add()
		{
	// echo		print_r($_FILES);exit;
				$config['upload_path']          = './assets/uploads/';
				$config['allowed_types']        = 'gif|jpg|png';
				// $config['max_size']      = 1000; 

				$config['max_width']     = 1024; 
				$config['max_height']    = 768;

                $this->load->library('upload', $config);
                // $this->upload->initialize($config);
                  if ( ! $this->upload->do_upload('product_img'))
                {
                        $error = array('error' => $this->upload->display_errors());
 // echo print_r($error);exit;
                        // $this->load->view('upload_form', $error);
                }
                else
                {
              // echo "ss";exit;
                        $data = array(
					'book_isbn' => $this->input->post('book_isbn'),
					'book_title' => $this->input->post('book_title'),
					'book_author' => $this->input->post('book_author'),
					'book_category' => $this->input->post('book_category'),
					'upload_data'=>$this->upload->data('file_name'),
				);
			$insert = $this->book_model->book_add($data);
			// redirect(site_url('book/index'));
			echo json_encode(array("status" => TRUE));
                }




			
		}
		public function ajax_edit($id)
		{
			$data = $this->book_model->get_by_id($id);



			echo json_encode($data);
		}
 
		public function book_update()
	{
	

				$config['upload_path']          = './assets/uploads/';
				$config['allowed_types']        = 'gif|jpg|png';
				// $config['max_size']      = 1000; 

				$config['max_width']     = 1024; 
				$config['max_height']    = 768;

                $this->load->library('upload', $config);
                // $this->upload->initialize($config);
                if($_FILES["product_img"]["error"] == 4)
                {
                	$data = array(
				'book_isbn' => $this->input->post('book_isbn'),
				'book_title' => $this->input->post('book_title'),
				'book_author' => $this->input->post('book_author'),
				'book_category' => $this->input->post('book_category'),
				
			);
				$this->book_model->book_update(array('book_id' => $this->input->post('book_id')), $data);
				echo json_encode(array("status" => TRUE));
                  
			}
			else
			{
				


				if ( ! $this->upload->do_upload('product_img'))
               
                {
                        $error = array('error' => $this->upload->display_errors());

                }
                else
                {
				$data = array(
				'book_isbn' => $this->input->post('book_isbn'),
				'book_title' => $this->input->post('book_title'),
				'book_author' => $this->input->post('book_author'),
				'book_category' => $this->input->post('book_category'),
				'upload_data'=>$this->upload->data('file_name'),
			);
				$this->book_model->book_update(array('book_id' => $this->input->post('book_id')), $data);
				echo json_encode(array("status" => TRUE));
				}
				}
			
	}

	public function book_delete($id)
	{
		$this->book_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}



}