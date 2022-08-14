<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategorim extends CI_Model
{
	private $_table = "kategori";

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

	public function getList()
	{
		$sql = "  SELECT *
		from " . $this->_table . " 
		order by nama";
		$list = $this->db->query($sql)->result();
		return $list;
	}

	public function getListById($id)
	{
		$sql = "  SELECT *
		from " . $this->_table . " 
		where id='".$id."'
		order by nama";
		$list = $this->db->query($sql)->result();
		return $list;
	}
}//end of class