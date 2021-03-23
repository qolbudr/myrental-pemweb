<?php

class database {

	private $host = "127.0.0.1";
	private $user = "root";
	private $pass = "Dzikru!234";
	private $dbse = "db_rental";

	public function connection() {
		$db = mysqli_connect($this->host, $this->user, $this->pass, $this->dbse);
		return $db;
	}

	public function split($data) {
		$keys = '';
		$values = '';
		foreach($data as $key => $value) {
			$keys .= "`".$key."`, ";
			$values .= "'".$value."', ";
		}

		$keys = substr($keys, 0, -2);
		$values = substr($values, 0, -2);

		return '('.$keys.') VALUES ('.$values.')';
	}

	public function splitIns($data) {
		$quer = '';
		foreach($data as $key => $value) {
			$quer .= "`".$key."` = "."'".$value."', ";
		}

		$quer = substr($quer, 0, -2);

		return $quer;
	}

	public function splitGet($data) {
		$quer = '';
		foreach($data as $key => $value) {
			$quer .= "`".$key."` = "."'".$value."' and ";
		}

		$quer = substr($quer, 0, -5);

		return $quer;
	}

	public function insert($table, $data) {
		$value = $this->split($data);
		$query = "INSERT INTO ".$table." ".$value;
		return mysqli_query($this->connection(), $query);
	}

	public function update($table, $data, $where) {
		$value = $this->splitIns($data);
		$ident = $this->splitIns($where);
		$query = "UPDATE `".$table."` SET ".$value." WHERE `".$table."`.".$ident."";
		return mysqli_query($this->connection(), $query);
	}

	public function get($table, $where) {
		if(!empty($where)) {
			$where = $this->splitGet($where);
			$query = "SELECT * FROM `".$table."` WHERE ".$where;
		} else {
			$query = "SELECT * FROM `".$table."`";
		}
		$data = mysqli_query($this->connection(), $query);
		$row = mysqli_fetch_all($data, MYSQLI_ASSOC);;
		return $row;		
	}

	public function query($string) {
		$query = $string;
		$data = mysqli_query($this->connection(), $query);
		$row = mysqli_fetch_all($data, MYSQLI_ASSOC);;
		return $row;
	}

	public function delete($table, $where) {
		$ident = $this->splitIns($where);
		$query = "DELETE FROM `".$table."` WHERE `".$table."`.".$ident;
		return mysqli_query($this->connection(), $query);
	}
}