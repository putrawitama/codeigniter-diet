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

	public function cetak_progress($id){
		
		$progress = $this->mprogress->getProgress($id)->row();
		$customer = $this->mcustomer->getCustomer($progress->id_customer)->row();
		$recent_timbang = $this->mprogress->getTimbang($progress->id_progress, false, true)->row();
		$all_timbang = $this->mprogress->getAllTimbang($progress->id_progress)->result();

		$judul = "LAPORAN PROGRESS DIET CUSTOMER";

		require_once('application/libraries/FPDF/fpdf.php');

		$pdf = new FPDF();
		$pdf->SetTitle('ProgressDiet_'.$customer->nama.', '.$customer->gelar);
		$pdf->SetAutoPageBreak(true, 10);
		$pdf->SetMargins(25, 15);
		$pdf->AddPage('L');
		$pdf->SetFont('Times','B',16);
		$pdf->Cell(0,7, $judul, 0, 1, 'C');
		$pdf->Ln();

		$pdf->SetFont('Times','',12);
		$pdf->Cell(0,7, 'ID: '.$customer->id_customer, 0, 1);
		$pdf->Cell(0,7, 'Nama: '.$customer->nama.', '.$customer->gelar, 0, 1);
		$pdf->Cell(0,7, 'Terakhir Timbang: '.date('d F Y', strtotime($recent_timbang->tanggal)), 0, 1);
		$pdf->Ln();

		$pdf->SetFont('Times','B',12);
		$pdf->Cell(20, 7, 'Program: ', 0);
		$pdf->SetFont('Times','',12);
		$pdf->Cell(20, 7, ucfirst($progress->program), 0);
		$pdf->SetFont('Times','B',12);
		$pdf->Cell(16, 7, 'Tinggi: ', 0);
		$pdf->SetFont('Times','',12);
		$pdf->Cell(20, 7, $progress->tinggi, 0);
		$pdf->SetFont('Times','B',12);
		$pdf->Cell(12, 7, 'Usia: ', 0);
		$pdf->SetFont('Times','',12);
		$pdf->Cell(20, 7, $progress->usia, 0);
		$pdf->SetFont('Times','B',12);
		$pdf->Cell(16, 7, 'Target: ', 0);
		$pdf->SetFont('Times','',12);
		$pdf->Cell(20, 7, $progress->target, 0);
		$pdf->SetFont('Times','B',12);
		$pdf->Cell(15, 7, 'Status: ', 0);
		$status = $progress->status == 1 ? 'Aktif' : 'Tidak Aktif';
		$pdf->SetFont('Times','',12);
		$pdf->Cell(20, 7, $status, 0, 1);
		$pdf->Ln();

		$pdf->SetFont('Times','B',12);
		$pdf->Cell(12, 14, 'No.', 1, 0, 'C');
		$pdf->Cell(35, 14, 'Tanggal', 1, 0, 'C');
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$w = 20;
		$pdf->MultiCell(20, 7, 'Minggu ke-', 1, 'C');
		$pdf->SetXY($x+$w, $y);
		$pdf->Cell(20, 14, 'Berat', 1, 0, 'C');
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$w = 20;
		$pdf->MultiCell(20, 7, 'Lemak Tubuh', 1, 'C');
		$pdf->SetXY($x+$w, $y);
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$w = 20;
		$pdf->MultiCell(20, 7, 'Massa Tulang', 1, 'C');
		$pdf->SetXY($x+$w, $y);
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$w = 20;
		$pdf->MultiCell(20, 7, 'Kadar Air', 1, 'C');
		$pdf->SetXY($x+$w, $y);
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$w = 20;
		$pdf->MultiCell(20, 7, 'Massa Otot', 1, 'C');
		$pdf->SetXY($x+$w, $y);
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$w = 20;
		$pdf->MultiCell(20, 7, 'Rating Fisik', 1, 'C');
		$pdf->SetXY($x+$w, $y);
		$pdf->Cell(20, 14, 'BMR', 1, 0, 'C');
		$pdf->Cell(20, 14, 'Usia Sel', 1, 0, 'C');
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$w = 20;
		$pdf->MultiCell(20, 7, 'Lemak Visceral', 1, 'C');
		$pdf->SetFont('Times','',12);

		$nomor = 1;
		foreach($all_timbang as $timbang){
			$pdf->Cell(12, 7, $nomor, 1, 0, 'C');
			$pdf->Cell(35, 7, date('d-m-Y', strtotime($timbang->tanggal)), 1, 0, 'C');
			$pdf->Cell(20, 7, $timbang->minggu, 1, 0, 'C');
			$pdf->Cell(20, 7, $timbang->berat, 1, 0, 'C');
			$pdf->Cell(20, 7, $timbang->body_fat, 1, 0, 'C');
			$pdf->Cell(20, 7, $timbang->bon_mass, 1, 0, 'C');
			$pdf->Cell(20, 7, $timbang->body_water, 1, 0, 'C');
			$pdf->Cell(20, 7, $timbang->muscle_mass, 1, 0, 'C');
			$pdf->Cell(20, 7, $timbang->rating_fisik, 1, 0, 'C');
			$pdf->Cell(20, 7, $timbang->bmr, 1, 0, 'C');
			$pdf->Cell(20, 7, $timbang->usia_sel, 1, 0, 'C');
			$pdf->Cell(20, 7, $timbang->visceral_fat, 1, 0, 'C');
			$pdf->Ln();
			$nomor++;
		}
		$pdf->Output();

	}

	public function get_chart($progress_id){

		$progress = $this->mprogress->getProgress($progress_id)->row();
		$customer = $this->mcustomer->getCustomer($progress->id_customer)->row();
		$timbangs = $this->mprogress->getTimbang($progress_id)->result();

		$ch_timbang = [];

		foreach($timbangs as $timbang){

			$ch_timbang[] = [
				'attribute' => 'Berat',
				'tanggal' => date('d F Y', strtotime($timbang->tanggal)),
				'nilai' => $timbang->berat
			];
			$ch_timbang[] = [
				'attribute' => 'Lemak Tubuh',
				'tanggal' => date('d F Y', strtotime($timbang->tanggal)),
				'nilai' => $timbang->body_fat
			];
			$ch_timbang[] = [
				'attribute' => 'Massa Tulang',
				'tanggal' => date('d F Y', strtotime($timbang->tanggal)),
				'nilai' => $timbang->bon_mass
			];
			$ch_timbang[] = [
				'attribute' => 'Kadar Air',
				'tanggal' => date('d F Y', strtotime($timbang->tanggal)),
				'nilai' => $timbang->body_water
			];
			$ch_timbang[] = [
				'attribute' => 'Massa Otot',
				'tanggal' => date('d F Y', strtotime($timbang->tanggal)),
				'nilai' => $timbang->muscle_mass
			];
			$ch_timbang[] = [
				'attribute' => 'Rating Fisik',
				'tanggal' => date('d F Y', strtotime($timbang->tanggal)),
				'nilai' => $timbang->rating_fisik
			];
			$ch_timbang[] = [
				'attribute' => 'BMR',
				'tanggal' => date('d F Y', strtotime($timbang->tanggal)),
				'nilai' => $timbang->bmr
			];
			$ch_timbang[] = [
				'attribute' => 'Usia Sel',
				'tanggal' => date('d F Y', strtotime($timbang->tanggal)),
				'nilai' => $timbang->usia_sel
			];
			$ch_timbang[] = [
				'attribute' => 'Lemak Visceral',
				'tanggal' => date('d F Y', strtotime($timbang->tanggal)),
				'nilai' => $timbang->visceral_fat
			];

		}

		$view_data = [
			'id_customer' => $customer->id_customer,
			'nama' => $customer->nama.', '.$customer->gelar,
			'program' => ucfirst($progress->program),
			'json_data' => json_encode($ch_timbang)
		];

		$this->load->view('progressChart', $view_data);

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */