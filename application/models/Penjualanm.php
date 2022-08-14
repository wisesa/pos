<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualanm extends CI_Model
{
	private $_table = "penjualan";
	private $_table_detail = "penjualan_detail";

	public function getKey()
	{
		return $this->_key;
	}

	public function commit($input_master, $input_detail)
	{
		$this->db->trans_start();
		$this->add($this->_table,$input_master);
		$this->add($this->_table_detail,$input_detail);
		
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}

	public function add($table, $input)
	{
		if (!$this->db->insert($table, $input)) {
			return false;
		} else {
			return true;
		}
	}

	public function edit($input, $id)
	{
		$this->db->where('id', $id);
		$this->db->update($this->_table, $input);
	}

	public function getList($id_pelanggan='', $id_produk='')
	{
		$sql = "  SELECT p.id as id,p.id_pelanggan,p.created_on,pd.id_produk,pd.harga,pd.jumlah,u.nama as nama_pelanggan,pr.nama as nama_produk
		from " . $this->_table . " p left outer join
		" . $this->_table_detail . "  pd on p.id=pd.id_penjualan left outer join
		user u on p.id_pelanggan=u.id left outer join
		produk pr on pd.id_produk=pr.id ";
		if($id_pelanggan<>'')
			$sql .= "where id_pelanggan='".$id_pelanggan."'";
		else if($id_produk<>'')
			$sql .= "where pr.id='".$id_produk."'";
		$sql .= " order by p.created_on desc";
		$list = $this->db->query($sql)->result();
		return $list;
	}

	public function getListPerProduk()
	{
		$sql = "SELECT pr.id as id_produk,pr.nama as nama_produk,count(p.id) as jumlah,harga as harga_satuan,harga*count(p.id) as harga_total
		from " . $this->_table . " p left outer join
		" . $this->_table_detail . "  pd on p.id=pd.id_penjualan left outer join
		produk pr on pd.id_produk=pr.id 
		group by pd.id_produk
		order by pr.nama;";
		$list = $this->db->query($sql)->result();
		return $list;
	}

	public function checkExist($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get($this->_table);
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}