<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Progress extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('input');
		$this->load->model('mprogress');
		$this->load->model('mcustomer');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function add($id = null)
	{
		if ($id == null) {
			show_404();
		}

		$customer = $this->mcustomer->getCustomer($id)->row();

		if (!$customer) {
			show_404();
		}

		if (!($customer->id_customer == $id)) {
			show_404();
		}

		$tgl = date("Y-m-d");

		$usia = $tgl - $customer->tgl_lahir;

		$data = [
			'customer' => $customer,
			'usia' => $usia
		];

		$this->load->view('newProgress', $data);
	}

	public function postAdd($id)
	{
		$data = [
			'id_customer' => $id,
			'program' => $this->input->post("program"),
			'masalah' => $this->input->post("masalah"),
			'tinggi' => $this->input->post("tinggi"),
			'usia' => $this->input->post("usia"),
			'target' => 0,
			'status' => 1
		];	

		$input = $this->mprogress->save($data);

		if ($input) {

			// echo "sukses";
			redirect("/progress?success=1");

		} else {

			// echo "gagal";
			redirect("/progress?error=1");

		}
	}

	public function finish($id = null)
	{
		if ($id == null) {
			show_404();
		}

		$progress = $this->mprogress->getProgress($id)->row();

		if (!$progress) {
			show_404();
		}

		if (!($progress->id_progress == $id)) {
			show_404();
		}

		$data = [
			'status' => 0
		];

		$edit = $this->mprogress->update($id, $data);

		if ($edit) {
			redirect('progress?success=1');
		} else {
			redirect('progress?error=1');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */