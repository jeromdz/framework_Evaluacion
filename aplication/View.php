<?php
/**
 * @author  Jeronimo Mendez <Jero_mdz@gmail.com>
 * @version  1.0 Primera versión estable
 * @package  framework
 * @copyright  2015
 */
class View{
	private $_controlador;
	private $_metodo;
	private $_layout;

	public function __construct(Request $peticion){
		$this->_controlador = $peticion->getControlador();
		$this->_metodo = $peticion->getMetodo();
		$this->_layout=DEFAULT_LAYOUT;
	}
	/**
	 * Metodo renderizar funcion que contiene los elementos de la vista
	 * @param  string $vista contiene nombre de la vista
	 */
	public function setLayout($layout){
		$this->_layout=$layout;
		
		
	}
	public function renderizar($vista){

		$_layoutParams = array(
				'ruta_css'=> APP_URL.'views/layouts/'.$this->_layout.'/css/',
				'ruta_img'=> APP_URL.'views/layouts/'.$this->_layout.'/img/',
				'ruta_js'=> APP_URL.'views/layouts/'.$this->_layout.'/js/'
			);

		$rutaView = ROOT.'views'.DS.$this->_controlador.DS.$vista.'.phtml';

		/*if ($this->_metodo=='login') {
			$layout = 'login';
		}else{
			$layout = DEFAULT_LAYOUT;
		}*/

		/**
		 *Valida si la ruta pueda
		 *leerse y su codigo interno
		 *no tenga ningun error.
		 */
		if(is_readable($rutaView)){
			include_once ROOT.'views'.DS.'layouts'.DS.$this->_layout.DS.'header.php';
			include_once $rutaView;
			include_once ROOT.'views'.DS.'layouts'.DS.$this->_layout.DS.'footer.php';
		}else{
			throw new Exception("Error de vista");
		}
	}
}