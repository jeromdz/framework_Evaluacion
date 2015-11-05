<?php
/**
 * @author  Jeronimo Mendez <Jero_mdz@gmail.com>
 * @version  1.0 Primera versión estable
 * @package  framework
 * @copyright  2015
 */

 /**
 * Appcontroller para renderizar vistas y redireccionar
 * @param  string $_view atributo protegido de la clase
 * @param  string $db objeto de la clase PDO 
 */
abstract class Appcontroller {
	protected $_view;
	protected $db;

	abstract public function index();
	
	


	public function __construct(){
		
		$this->_view = new View(new Request);
		$this->db = new classPDO();
	}
	
	protected function set($name = null, $value=array()){
		$GLOBALS[$name] = $value;
	}
    /**
    * redirect redireccion de archivos
	* @param   array $url  para redirección
	* @var  string $path almacena ruta completa de la redirección
	*/
	protected function redirect($url = array()){
		$path = "";

		if ($url['controller']) {
			$path .= $url['controller'];
		}
		if ($url['action']) {
			$path .= "/".$url['action'];
		}
		header("location: ".APP_URL.$path);

	}

}
