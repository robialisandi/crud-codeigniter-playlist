<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('book_model');
		$this->load->library("pagination");
	}

	public function index()
	{
		$config = array();
		$count_book = $this->book_model->get_count_books();

		$config['base_url'] = base_url() . "book/index";
		$config['total_rows'] = $count_book;
		$config['per_page'] = 10;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = "<div class='pagination pagination-right'><ul>";
		$config['full_tag_close'] ="</ul></div>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
    	$config['cur_tag_open'] = '<li class="active"><a href="#">';
    	$config['cur_tag_close'] = '</a></li>';
    	$config['prev_tag_open'] = '<li>';
    	$config['prev_tag_close'] = '</li>';
    	$config['first_tag_open'] = '<li>';
    	$config['first_tag_close'] = '</li>';
    	$config['last_tag_open'] = '<li>';
    	$config['last_tag_close'] = '</li>';

    	$config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>Previous Page';
    	$config['prev_tag_open'] = '<li>';
    	$config['prev_tag_close'] = '</li>';

    	$config['next_link'] = 'Next Page<i class="fa fa-long-arrow-right"></i>';
    	$config['next_tag_open'] = '<li>';
    	$config['next_tag_close'] = '</li>';

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['books'] = $this->book_model->get_all_books($config['per_page'], $page);
		$data["links"] = $this->pagination->create_links();
		//echo "<pre>";
		//die(print_r($data, TRUE));
		$this->load->view('book_view', $data);
	}

	public function book_add()
	{
		$data = array(
			'book_isbn' => $this->input->post('book_isbn'),
	  		'book_title' => $this->input->post('book_title'),
	  		'book_author' => $this->input->post('book_author'),
	  		'book_category' => $this->input->post('book_category'),
		);

		$insert = $this->book_model->book_add($data);
		echo json_encode(array('status' => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->book_model->get_by_id($id);
		echo json_encode($data);
	}

	public function book_update()
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

	public function book_delete($id)
	{
		$this->book_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

}
