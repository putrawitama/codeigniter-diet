<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mprogress extends CI_Model {

	public function __construct(){
		
		parent::__construct();

	}

	//simpan data customer baru
	public function save($data)
	{
		if ($this->db->insert('progress', $data)) { //jika data berhasil di input ke database maka

			return true; // mengembalikan nilai true
		
		} else { //jika gagal maka
		
			return false;  //mengembalikan nilai false
		
		}
	}

	//ambil satu data dari tabel customer berdasarkan id_customer
	public function getProgress($id)
	{
		$this->db->select('*');
		$this->db->from('progress');
		$this->db->where('id_progress', $id);

		return $this->db->get();
	}

	public function getProgressByCustomer($id)
	{
		$this->db->select('*');
		$this->db->from('progress');
		$this->db->where('id_customer', $id);

		return $this->db->get();
	}

	//ambil seluruh data customer pada tabel customer
	public function getAll($id, $q = null)
	{

		$this->db->select('*');
		$this->db->from('progress');
		if ($q != null) {
			$this->db->like('program', $q);
		}
		$this->db->where('id_customer', $id);
		// $this->db->limit($from, $to);
		return $this->db->get();
	}

	public function getAllWithTimbang($id)
	{
		// $this->db->query("select p.*, t.tanggal, t.berat
		// 	from progress p
		// 	inner join (select id_progress, tanggal, berat
		// 	from timbang
		// 	where tanggal = (
		// 	select max(tanggal)
		// 	from timbang
		// 	where id_progress = id_progress)) t
		// 	on p.id_progress = t.id_progress
		// 	order BY p.id_progress ASC");

		$this->db->select('progress.*, t.tanggal, t.berat');
		$this->db->from('progress');
		$this->db->join('(select id_progress, tanggal, berat
			from timbang
			where tanggal = (
			select max(tanggal)
			from timbang
			where id_progress = id_progress)) t', 'progress.id_progress=t.id_progress', 'left');
		$this->db->where('progress.id_customer', $id);
		$this->db->order_by('progress.id_progress', 'ASC');
		return $this->db->get();
	}

	public function getCount($id, $q = null)
	{
		$this->db->select('*');
		$this->db->from('progress');
		if ($q != null) {
			$this->db->like('program', $q);
		}
		$this->db->where('id_customer', $id);
		return $this->db->count_all_results();
	}

	//update data customer
	public function update($id, $data)
	{
		$this->db->where('id_progress', $id);
		if ($this->db->update('progress', $data)) { //jika data berhasil diupdate ke database maka

			return true; // mengembalikan nilai true
		
		} else { //jika gagal maka
		
			return false;  //mengembalikan nilai false
		
		}
	}


	// public function getPagination($num, $offset, $q = null)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('customer');
	// 	if ($q != null) {
	// 		$this->db->like('nama', $q);
	// 		$this->db->or_like('email', $q);
	// 		$this->db->or_like('id_customer', $q);
	// 	}
	// 	$this->db->limit($num, $offset);
	// 	return $this->db->get();
	// }


	public function getTimbang($id, $first = false, $last = false)
	{
		$this->db->select('*');
		$this->db->from('timbang');
		$this->db->where('id_progress', $id);
		if ($first == true) {
			$this->db->order_by('tanggal', 'ASC');
			$this->db->limit(1);
		} 

		if ($last == true) {
			$this->db->order_by('tanggal', 'DESC');
			$this->db->limit(1);
		}
		
		return $this->db->get();
	}

	public function getAllTimbang($id, $count = false)
	{
		$this->db->select('*');
		$this->db->from('timbang');
		$this->db->where('id_progress', $id);
		// $query = $this->db->get();
		if ($count == true) {
			// return count($query->result());
			return $this->db->count_all_results();
		} else {
			return $this->db->get();
		}
	}

	public function saveTimbang($data)
	{
		if ($this->db->insert('timbang', $data)) { //jika data berhasil di input ke database maka

			return true; // mengembalikan nilai true
		
		} else { //jika gagal maka
		
			return false;  //mengembalikan nilai false
		
		}
	}
}

/* End of file mcustomer.php */
/* Location: ./application/model/mcustomer.php */