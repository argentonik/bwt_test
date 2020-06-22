<?php

namespace core;

use components\Db;

abstract class Model {

	public $db;
	
	public function __construct() {
		$this->db = Db::getInstance()->getConnection();
	}

}