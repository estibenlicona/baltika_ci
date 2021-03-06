<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Seanson extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form','url');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->model("Seanson_model");
		if (!$this->session->has_userdata('usuario')) {
			redirect(base_url('login'), 'location');
		}
	}
  public function index(){
    $datosHeader['title'] = 'Seansons';
    $data  = array('seansons' => $this->Seanson_model->getSeansons());
		$datos_session = ['usuario' => $this->session->userdata('usuario')];
		$this->load->view("header",$datosHeader);
		$this->load->view('nav',$datos_session);
		$this->load->view('menu');
    $this->load->view('seanson',$data);
		$this->load->view('footer');
  }
	public function add()
	{
		$nombre = $this->input->post('nombre');
		$this->Seanson_model->addSeanson($nombre);
		redirect(base_url('seanson'), 'location');
	}
	public function edit()
	{
		$id = $this->input->post('id');
		$nombre = $this->input->post('nombre');

		$this->Seanson_model->editSeanson($id,$nombre);
		redirect(base_url('seanson'), 'location');
	}
	//Cambiar estado a liga
	public function delete($id){
		$this->Seanson_model->deleteSeanson($id);
		redirect(base_url('seanson'), 'location');
	}
}
