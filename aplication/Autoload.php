<?php
	/**
	 * @author  Jeronimo Mendez <Jero_mdz@gmail.com>
	 * @version  1.0 Primera versión estable
	 * @package  framework
	 * @copyright  2015
	 */

	/**
	 * __autoload un metodo para cargar automaticamente las librerias  que contiene  libs
	 * @param  string $name contiene nombre de la libreria
	 * @return  void
	 */
	function __autoload($name){
		require_once(ROOT."libs".DS.$name.".php");
	}
?>