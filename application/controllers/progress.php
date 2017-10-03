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

	public function all($id = null)
	{
		if ($id == null) {
			show_404();
		}

		// $progress = $this->mprogress->getAll($id)->result();
		// $timbang = $this->getAllTimbang($id, false, true)->row();
		$progress = $this->mprogress->getAllWithTimbang($id)->result();
		$customer = $this->mcustomer->getCustomer($id)->row();

		// echo "<pre>";
		// print_r($progress);
		// if (!$progress) {
		// 	show_404();
		// }
		if (!$progress) {
			$customer = $this->mcustomer->getCustomer($id)->row();
			if (!$customer) {
				show_404();
			}
		}

		$data = [
			'progress' => $progress,
			'customer' => $customer->id_customer
		];

		if($this->input->get('success') == 1)
		{
			$data['success'] = "Success";
		}

		//menampilkan alert error
		if($this->input->get('error') == 1)
		{
			$data['error'] = "Tidak dapat menambah program";
		}

		$this->load->view('homeProgress', $data);
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

		$progress = $this->mprogress->getAll($id)->result();

		foreach ($progress as $d) {
			if ($d->status == 1) {
				redirect("/progress/all/".$id."?error=1");
			}
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
			redirect("/progress/all/".$id."?success=1");

		} else {

			// echo "gagal";
			redirect("/progress/all/".$id."?error=1");

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

		$customer = $this->mprogress->getProgress($id)->row();

		if ($edit) {
			redirect('progress/all/'.$customer->id_customer.'?success=1');
		} else {
			redirect('progress/all/'.$customer->id_customer.'?error=1');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */