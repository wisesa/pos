<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userm extends CI_Model
{
	private $_table = "user";

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

	public function getList($type)
	{
		$sql = "  SELECT *
		from " . $this->_table . " 
		where type<>'administrator' and type='".$type."'
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

	public function authenticate($email, $password)
	{
		$sql = "  SELECT *
		from " . $this->_table . " 
		where email =" . "'" . $email . "' and password='" . md5($password) . "' and aktif=1";
		$rs = $this->db->query($sql);
		// print_r($rs->num_rows());
		// die;

		if ($rs->num_rows()>0) {
			return $rs->result();
		} else {
			return false;
		}
	} //end authenticate()
}