<?php
/**
 * clase Bootstrap
 */

/**
 * @author  Jeronimo Mendez <Jero_mdz@gmail.com>
 * @version  1.0 Primera versión estable
 * @package  framework
 * @copyright  2015
 */

class Bootstrap{
	 /**
	 * run ejecuta clase Request
	 * permite llamar una funcion sin necesidad de instanciar la clase
	 * @param  string $peticion parametro que se recibe de Request
	 * @var  string controller almacena controlador
	 * @var  string rutaControlador guarda ruta del controlador
	 * @var  string $metodo invoca a la funcion getMetodo de request
	 * @var  string $args invoca a la funcion getArgs de request
	 * */

	
   public static function run(Request $peticion){
		$controller = $peticion->getControlador().'Controller';
		$rutaControlador = ROOT.'controllers'. DS . $controller . '.php';
		$metodo = $peticion->getMetodo();
		$args = $peticion->getArgs();

		if (is_readable($rutaControlador)) {
			include_once $rutaControlador;
			$controlador = new $controller;
				if (is_callable(array($controller, $metodo))) {
					$metodo = $peticion->getMetodo();
				}else{
					$metodo = 'index';
				}

				if ($metodo =='login') {
					
				}else{
					Authorization::logged();
				}
				if(isset($args)){
					call_user_func_array(array($controlador, $metodo), $args);
				}else{
					call_user_func_array(array($controller, $metodo));
				}
		}else{
			throw new Exception("Controlador no encontrado");
			
		}

	}
}