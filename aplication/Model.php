<?php
/**
 * @author  Jeronimo Mendez <Jero_mdz@gmail.com>
 * @version  1.0 Primera versión estable
 * @package  framework
 * @copyright  2015
 */
class AppModel{
	protected $_db;

	public function __construct(){
		$this->_db = new Database();
	}
}

