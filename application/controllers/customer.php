<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('input');
		$this->load->model('mcustomer');
	}

	public function index()
	{
		$data = [
			'customer' => $this->mcustomer->getAll()->result()
		];

		//menampilkan alert success
		if($this->input->get('success') == 1)
		{
			$data['success'] = "Success";
		}

		//menampilkan alert error
		if($this->input->get('error') == 1)
		{
			$data['error'] = "Error";
		}

		$this->load->view('home', $data);
	}

	public function add()
	{
		// echo date("Y-m-d H:i:s");
		$this->load->view('newCustomer');
	}

	public function postAdd()
	{
		$tgl = date("Y-m-d");
		$hitung = count($this->mcustomer->cek_customer($tgl)->result());
		$hitung = $hitung + 1;
		$data = [
			'id_customer' => 'C'.date("ymd").$hitung,
			'nama' => $this->input->post("nama"),
			'gelar' => $this->input->post("gelar"),
			'telepon' => $this->input->post("tlp"),
			'hp' => $this->input->post("hp"),
			'tgl_lahir' => $this->input->post("lahir"),
			'email' =>$this->input->post("email"),
			'tgl_daftar' => date("Y-m-d")
		];	

		$input = $this->mcustomer->save($data);

		if ($input) {

			echo "sukses";
			// redirect("/tugas3/post?success=1");

		} else {

			echo "gagal";
			// redirect("/tugas3/post?error=1");

		}
	}

	public function edit($id)
	{
		$customer = $this->mcustomer->getCustomer($id)->row();

		if ($customer) {
			$data = [
				'd' => $customer
			];

			$this->load->view('editCustomer', $data);
		} else {
			show_404();
		}
	}

	public function postEdit($id)
	{
		$data = [
			'nama' => $this->input->post("nama"),
			'gelar' => $this->input->post("gelar"),
			'telepon' => $this->input->post("tlp"),
			'hp' => $this->input->post("hp"),
			'tgl_lahir' => $this->input->post("lahir"),
			'email' =>$this->input->post("email")
		];

		$edit = $this->mcustomer->update($id, $data);

		if ($edit) {
			redirect('customer?success=1');
		} else {
			redirect('customer?error=1');
		}
		
	}

	public function delete($id)
	{
		$customer = $this->mcustomer->getCustomer($id)->row();

		if ($customer) {
			$del = $this->mcustomer->delete($id);

			if ($del) {
				redirect('customer?success=1');
			} else {
				redirect('customer?error=1');
			}
			
		} else {
			show_404();
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */