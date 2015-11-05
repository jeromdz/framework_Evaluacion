<?php
/**
 * @author  Jeronimo Mendez <Jero_mdz@gmail.com>
 * @version  1.0 Primera versión estable
 * @package  framework
 * @copyright  2015
 */
class tareasController extends Appcontroller
{	protected $tareas;
	public function __construct(){
		parent::__construct();
		$this->tareas= new classPDO();
	}
	/**
	 * index lista las tareas
	 * @return  void
	 */
	public function index() {
	
		$conditions = array(
			"conditions"=>" tareas.categoria_id=categorias.id",
			"order"=>"tareas.id asc"
		);
		$this->_view->titulo = 'Listado de tareas';
		$tareas = $this->tareas->find('tareas, categorias', 'all', $conditions);
		$this->_view->tareas = $tareas->fetchAll(PDO::FETCH_NUM);
		$this->_view->setLayout('default');
		$this->_view->renderizar('index');
	}
	/**
	 * edit lista las tareas
	 * @param  string $id contiene id de la fila
	 * @return void
	 */
	 
	public function edit($id = null){
		if ($_POST) {
				
				if ($this->tareas->update('tareas', $_POST)) {
				$this->redirect(
						array(
								'controller'=>'tareas',
								'action'=>'index'
							)
					);
				}else{
					$this->redirect(
							array(
									'controller'=>'tareas',
									'action'=>'edit/'.$_POST['id']
								)
						);
					}	
				
	
		} else {
				$conditions = array(
						'conditions'=>'id='.$id
					);
				$this->_view->tarea = $this->db->find('tareas', 'first', $conditions);
				$this->_view->categorias = $this->db->find('categorias','all');
				//$categorias = $this->_view->categorias->fetchAll(PDO::FETCH_NUM);
				//$categorias = $this->_view->categorias->fetchAll(PDO::FETCH_ASSOC);
				$this->_view->titulo = "Editar tarea";
				$this->_view->renderizar('edit');
		}

	}
	/**
	 *funcion add sirve para agregar nuevas tareas
	 * 
	 * @return void
	 */
	public function add(){
		if ($_POST) {
			if ($this->tareas->save('tareas', $_POST)) {
				$this->redirect(
						array(
								'controller'=>'tareas',
								'action'=>'index'
							)
					);
			}else{
				$this->redirect(
						array(
								'controller'=>'tareas',
								'action'=>'index'
							)
					);
			}
			
		}else{
			$this->_view->categorias = $this->db->find('categorias','all');
			$this->_view->titulo = "Agregar tarea";
			$this->_view->renderizar('add');
		}
	}
	/**
	 * Funcion delete sirve para eliminar tareas
	 * @param  string $id contiene id de la fila
	 * @return void
	 */
	public function delete($id){
		$conditions = "id=".$id;
		if ($this->tareas->delete('tareas', $conditions)) {
			$this->redirect(array('controller'=>'tareas'));
		}

	}




}