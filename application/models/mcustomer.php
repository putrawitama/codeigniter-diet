<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcustomer extends CI_Model {

	public function __construct(){
		
		parent::__construct();

	}

	//simpan data customer baru
	public function save($data)
	{
		if ($this->db->insert('customer', $data)) { //jika data berhasil di input ke database maka

			return true; // mengembalikan nilai true
		
		} else { //jika gagal maka
		
			return false;  //mengembalikan nilai false
		
		}
	}


	public function getLast()
	{
		$this->db->select('id_customer');
		$this->db->from('customer');
		$this->db->order_by('id_customer', 'desc');
		$this->db->limit(1);
		return $this->db->get();
	}

	//ambil satu data dari tabel customer berdasarkan id_customer
	public function getCustomer($id)
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id_customer', $id);
		return $this->db->get();
	}

	public function getAllCustomer()
	{
		$this->db->select('*');
		$this->db->from('customer');
		return $this->db->get();
	}

	//ambil seluruh data customer pada tabel customer
	public function getAll($from, $to, $q = null)
	{

		$this->db->select('*');
		$this->db->from('customer');
		if ($q != null) {
			$this->db->like('nama', $q);
			$this->db->or_like('email', $q);
			$this->db->or_like('id_customer', $q);
		}
		$this->db->limit($from, $to);
		return $this->db->get();
	}

	public function getCount($q = null)
	{
		$this->db->select('*');
		$this->db->from('customer');
		if ($q != null) {
			$this->db->like('nama', $q);
			$this->db->or_like('email', $q);
			$this->db->or_like('id_customer', $q);
		}
		$query = $this->db->get();
		return count($query->result_array()) ;
	}

	//update data customer
	public function update($id, $data)
	{
		$this->db->where('id_customer', $id);
		if ($this->db->update('customer', $data)) { //jika data berhasil diupdate ke database maka

			return true; // mengembalikan nilai true
		
		} else { //jika gagal maka
		
			return false;  //mengembalikan nilai false
		
		}
	}


	//menghapus data customer
	public function delete($id)
	{
		$this->db->where('id_customer', $id);
		if ($this->db->delete('customer')) { //jika data berhasil diupdate ke database maka

			return true; // mengembalikan nilai true
		
		} else { //jika gagal maka
		
			return false;  //mengembalikan nilai false
		
		}
	}

	public function getPagination($num, $offset, $q = null)
	{
		$this->db->select('*');
		$this->db->from('customer');
		if ($q != null) {
			$this->db->like('nama', $q);
			$this->db->or_like('email', $q);
			$this->db->or_like('id_customer', $q);
		}
		$this->db->limit($num, $offset);
		return $this->db->get();
	}
}

/* End of file mcustomer.php */
/* Location: ./application/model/mcustomer.php */