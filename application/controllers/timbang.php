<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timbang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('input');
		$this->load->model('mprogress');
		$this->load->model('mcustomer');
	}

	public function add($id = null)
	{
		if ($id == null) {
			show_404();
		}

		$progress = $this->mprogress->getProgress($id)->row();

		if (!$progress) {
			show_404();
		}

		if ($progress->status == 0) {
			redirect("/progress/all/".$id."?error=1");
		}

		$timbang = $this->mprogress->getAllTimbang($id, true);

		$data = [
			'progress' => $progress,
			'timbang' => $timbang+1
		];

		$this->load->view('newTimbang', $data);
	}

	public function postAdd($id)
	{
		
		$timbang = $this->mprogress->getTimbang($id, true)->row();

		if ($timbang) {
			$detik = 24 * 3600;
			$tgl_awal = strtotime($timbang->tanggal);
			$tgl_akhir = strtotime(date("Y-m-d"));

			$minggu = 0;
			for ($i=$tgl_awal; $i < $tgl_akhir; $i += $detik)
			{
				if (date("w", $i) == "0"){
					$minggu++;
				}
			}
		} else {
			$minggu = 0;
		}

		$data = [
			'id_progress' => $id,
			'tanggal' => date("Y-m-d"),
			'minggu' => $minggu,
			'berat' => $this->input->post("berat"),
			'body_fat' => $this->input->post("tubuh"),
			'bon_mass' => $this->input->post("tulang"),
			'body_water' => $this->input->post("air"),
			'muscle_mass' => $this->input->post("otot"),
			'rating_fisik' => $this->input->post("fisik"),
			'bmr' => $this->input->post("bmr"),
			'usia_sel' => $this->input->post("sel"),
			'visceral_fat' => $this->input->post("perut")
		];

		// print_r($data);

		$input = $this->mprogress->saveTimbang($data);
		$progress = $this->mprogress->getProgress($id)->row();

		if ($input) {
			// echo "sukses";
			redirect("/progress/all/".$progress->id_customer."?success=1");
		} else {
			// echo "gagal";
			redirect("/progress/all/".$progress->id_customer."?error=1");

		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */