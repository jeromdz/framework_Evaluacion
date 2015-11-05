<?php
	/**
	 * @author  Jeronimo Mendez <Jero_mdz@gmail.com>
	 * @version  1.0 Primera versión estable
	 * @package  framework
	 * @copyright  2015
	 */
class categoriasController extends Appcontroller{
		protected $categorias;
		
		public function __construct(){
		parent::__construct();
		$this->categorias=new classPDO();
	}


	/**
	 * Metodo index lista las categorias
	 * @return void
	 */
	public function index() {
		/*$categoria= $this->categoriasController->find("categorias", "all");
		$this->set("categorias", $categoria);*/
		
		$this->_view->titulo = 'Listado de categorias';
		$this->_view->categorias = $this->categorias->find('categorias', 'all');
		$this->_view->setLayout('default');
		$this->_view->renderizar('index');

	}
	/**
	 * edit  de edicion de categorias
	 * @param  string $id contiene id de la fila
	 * @return void
	 */
	public function edit($id = null){
		if ($_POST) {
				if ($this->categorias->update('categorias', $_POST)) {
				$this->redirect(
						array(
								'controller'=>'categorias',
								'action'=>'index'
							)
					);
			}else{
				$this->redirect(
						array(
								'controller'=>'categorias',
								'action'=>'edit/'.$_POST['id']
							)
					);
			}


		}else{
		$conditions = array(
				'conditions'=>'id='.$id
			);
		$this->_view->categoria =  $this->categorias->find('categorias', 'first', $conditions);
		$this->_view->titulo = "Editar Categoría";
		$this->_view->renderizar('edit');
		}

	}
		/**
		 * add  para agregar nuevas categorias
		 * @return  void
		 */
		public function add(){
		if ($_POST) {
			if ( $this->categorias->save('categorias', $_POST)) {
				$this->redirect(
						array(
								'controller'=>'categorias',
								'action'=>'index'
							)
					);
			}else{
				$this->redirect(
						array(
								'controller'=>'categorias',
								'action'=>'index'
							)
					);
			}
			
		}else{
			$this->_view->titulo = "Agregar Categoría";
			$this->_view->renderizar('add');
		}

	}
		/**
		 * delete  para eliminar categorias
		 * @param  string $id contiene id de la fila
		 * @return void
		 */
		public function delete($id){
		$conditions = "id=".$id;
		if ($this->categorias->delete('categorias', $conditions)) {
			$this->redirect(array('controller'=>'categorias'));
		}

	}



}




?>