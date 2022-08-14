<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produkm extends CI_Model
{
	private $_table = "produk";

	public function getKey()
	{
		return $this->_key;
	}

	public function add($input)
	{
		if (!$this->db->insert($this->_table, $input)) {
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

	public function getList($aktif='')
	{
		$sql = "  SELECT k.id as id_kategori,k.nama as nama_kategori,p.id,p.nama as nama_produk,p.harga_beli,p.harga_jual,p.deskripsi,gambar,aktif,
		( (select sum(jumlah) from pembelian pe left outer join pembelian_detail pd on pe.id=pd.id_pembelian where pe.batal=0 and pd.id_produk=p.id) - 
		(select sum(jumlah) from penjualan pj left outer join penjualan_detail pd on pj.id=pd.id_penjualan where pd.id_produk=p.id) ) as stok
		from " . $this->_table . " p left outer join
		kategori k on p.id_kategori=k.id ";
		if($aktif<>'')
			$sql .= "where aktif='".$aktif."' ";
		$sql .= "order by p.nama";
		$list = $this->db->query($sql)->result();
		return $list;
	}

	public function getListById($id)
	{
		$sql = "  SELECT k.id as id_kategori,k.nama as nama_kategori,p.id,p.nama as nama_produk,p.harga_beli,p.harga_jual,p.deskripsi,gambar,aktif,
		( (select sum(jumlah) from pembelian pe left outer join pembelian_detail pd on pe.id=pd.id_pembelian where pe.batal=0 and pd.id_produk=p.id) - 
		(select sum(jumlah) from penjualan pj left outer join penjualan_detail pd on pj.id=pd.id_penjualan where pd.id_produk=p.id) ) as stok
		from " . $this->_table . " p left outer join
		kategori k on p.id_kategori=k.id
		where p.id='".$id."'
		order by p.nama";
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