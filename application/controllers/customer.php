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
		$page = $this->input->get('per_page');

        if($page == null):     //jika page bernilai kosong maka batas akhirna akan di set 0
           $dari = 0;
        else:
           $dari = $page; // jika tidak kosong maka nilai batas akhir nya akan diset nilai page terakhir
        endif;

		$pg_i = $this->config->item('pagination_cfg');
		$pg_i['page_query_string'] = true;
		$pg_i['base_url'] = base_url().'index.php/customer?';
		$pg_i['total_rows'] = $this->mcustomer->getCount();
		$pg_i['per_page'] = 10;
		$pg_i['uri_segment'] = $page;
		$this->pagination->initialize($pg_i);
		   
		$data['halaman'] = $this->pagination->create_links();
		   /*membuat variable halaman untuk dipanggil di view nantinya*/
		$data['offset'] = $dari;

		$data['customer'] = $this->mcustomer->getAll($pg_i['per_page'], $dari)->result();

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

	public function cari()
	{
		$q = (trim($this->input->post('q',true)))? trim($this->input->post('q',true)) : '';

		$q = ($this->uri->segment(3)) ? $this->uri->segment(3) : $q;
		$url = 'cari/'.$q;
		// $page = 4;
		// $dari = $this->uri->segment('4');
		$page = $this->input->get('per_page');

        if($page == null):     //jika page bernilai kosong maka batas akhirna akan di set 0
           $dari = 0;
        else:
           $dari = $page; // jika tidak kosong maka nilai batas akhir nya akan diset nilai page terakhir
        endif;

		$pg_i = $this->config->item('pagination_cfg');
		$pg_i['page_query_string'] = true;
		$pg_i['base_url'] = base_url().'index.php/customer/'.$url.'?';
		$pg_i['total_rows'] = $this->mcustomer->getCount($q);
		$pg_i['per_page'] = 10;
		$pg_i['uri_segment'] = $page;
		$this->pagination->initialize($pg_i);
		   
		$data['halaman'] = $this->pagination->create_links();

		   /*membuat variable halaman untuk dipanggil di view nantinya*/
		$data['offset'] = $dari;

		$data['customer'] = $this->mcustomer->getAll($pg_i['per_page'], $dari, $q)->result();
		   /*memanggil view pagination*/

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
		$tgl = date("ymd");
		$last = $this->mcustomer->getLast()->row();
		$date = substr($last->id_customer, 1, 6);

		if ($date == $tgl) {
			$increment = substr($last->id_customer, 7);
			$id = $increment+1;
		} else {
			$id = 1;
		}

		$data = [
			'id_customer' => 'C'.$tgl.$id,
			'nama' => $this->input->post("nama"),
			'gelar' => $this->input->post("gelar"),
			'telepon' => $this->input->post("tlp"),
			'hp' => $this->input->post("hp"),
			'tgl_lahir' => $this->input->post("lahir"),
			'email' =>$this->input->post("email"),
			'gender' =>$this->input->post("gender"),
			'tgl_daftar' => date("Y-m-d")
		];	

		$input = $this->mcustomer->save($data);

		if ($input) {

			// echo "sukses";
			redirect("/customer?success=1");

		} else {

			// echo "gagal";
			redirect("/customer?error=1");

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
			'email' =>$this->input->post("email"),
			'gender' =>$this->input->post("gender")
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

	public function cetak_customer(){
		
		$customers = $this->mcustomer->getAllCustomer()->result();

		$judul = "DAFTAR CUSTOMER PER ".strtoupper(date('d F Y'));

		require_once('application/libraries/FPDF/fpdf.php');

		$pdf = new FPDF();
		$pdf->SetTitle('DaftarCustomer_'.date('d-m-Y'));
		$pdf->SetAutoPageBreak(true, 10);
		$pdf->SetMargins(15, 15);
		$pdf->AddPage('L');
		$pdf->SetFont('Times','B',16);
		$pdf->Cell(0,7, $judul, 0, 1, 'C');
		$pdf->Ln();

		$pdf->SetFont('Times','B',12);
		$pdf->Cell(12, 14, 'No.', 1, 0, 'C');
		$pdf->Cell(20, 14, 'ID', 1, 0, 'C');
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$w = 35;
		$pdf->MultiCell(35, 14, 'Nama', 1, 'C');
		$pdf->SetXY($x+$w, $y);
		$pdf->Cell(40, 14, 'Gelar', 1, 0, 'C');
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$w = 30;
		$pdf->MultiCell(30, 14, 'No. Telepon', 1, 'C');
		$pdf->SetXY($x+$w, $y);
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$w = 30;
		$pdf->MultiCell(30, 14, 'No. HP', 1, 'C');
		$pdf->SetXY($x+$w, $y);
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$w = 50;
		$pdf->MultiCell(50, 14, 'Email', 1, 'C');
		$pdf->SetXY($x+$w, $y);
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$w = 25;
		$pdf->MultiCell(25, 7, 'Tanggal Lahir', 1, 'C');
		$pdf->SetXY($x+$w, $y);
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$w = 20;
		$pdf->MultiCell(25, 7, 'Tanggal Daftar', 1, 'C');

		$nomor = 1;
		$pdf->SetFont('Times','',11);
		foreach($customers as $customer){
			$pdf->Cell(12, 7, $nomor, 1, 0, 'C');
			$pdf->Cell(20, 7, $customer->id_customer, 1, 0, 'C');
			$pdf->Cell(35, 7, $customer->nama, 1, 0, 'C');
			$pdf->Cell(40, 7, $customer->gelar, 1, 0, 'C');
			$pdf->Cell(30, 7, $customer->telepon, 1, 0, 'C');
			$pdf->Cell(30, 7, $customer->hp, 1, 0, 'C');
			$pdf->Cell(50, 7, $customer->email, 1, 0, 'C');
			$pdf->Cell(25, 7, date('d-m-Y', strtotime($customer->tgl_lahir)), 1, 'C');
			$pdf->Cell(25, 7, date('d-m-Y', strtotime($customer->tgl_daftar)), 1, 'C');
			$pdf->Ln();
			$nomor++;
		}
		$pdf->Output();

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */