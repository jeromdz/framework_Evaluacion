<?php
/**
 * @author  Jeronimo Mendez <Jero_mdz@gmail.com>
 * @version  1.0 Primera versión estable
 * @package  framework
 * @copyright  2015
 */
	/**
	 * Archivo de clase de conexión PDO
	 * Clase que permite acciones CRUD usando PDO
	 * @package    PDO
	 * @author   Jeronimo <jero_mdz@gmail.com>
	 */
	class classPDO{
		public $connection;
		private $dsn;
		private $drive;
		private $host;
		private $database;
		private $username;
		private $password;
		public $result;
		public $lastInsertId;
		public $numbers_Rows;
		/**
		* Constructor de la clase
		* @return void
		*/

		public function __construct(
				$drive 	= 	'mysql',
				$host 	=	'localhost',
				$database =	'gestion',
				$username =	'root',
				$password =	''
			){
			$this->drive 		= $drive;
			$this->host 		= $host;
			$this->database 	= $database;
			$this->username 	= $username;
			$this->password 	= $password;
			$this->connection();
		}
		/**
		* Método de conexión a la base de datos.
		* Método que permite establecer una conexión a la base de datos
		* @return void
		*/

		public function connection(){
			$this->dsn = $this->drive.':host='.$this->host.';dbname='.$this->database;
			try{
				$this->connection = new PDO(
						$this->dsn,
						$this->username,
						$this->password
					);
				$this->connection->setAttribute(
						PDO::ATTR_ERRMODE,
						PDO::ERRMODE_EXCEPTION
					);
			}catch(PDOException $e){
				echo "ERROR: ".$e->getMessage();
				die();
			}
		}
		/**
		* Método find
		*
		* Método que sirve para hacer consultas a la base de datos
		*
		* @param string $table nombe de la tabla a consultar
		* @param string $query tipo de consulta
		*  - all
		*  - first
		*  - count
		* @param array $options restriciones en la consulta
		*  - fields
		*  - conditions
		*  - group
		*  - order
		*  - limit
		* @return object
		*/


		public function find($table = null, $query = null, $options = array()){
			$fields = '*';
			$parameters = '';

			if (!empty($options['field'])) {
				$fields = $options['field'];
			}
			if (!empty($options['conditions'])) {
				$parameters = ' WHERE ' .$options['conditions'];
			}
			if (!empty($options['group'])) {
				$parameters .= ' GROUP BY ' .$options['group'];
			}
			if (!empty($options['order'])) {
				$parameters .= ' ORDER BY ' .$options['order'];
			}
			if (!empty($options['limit'])) {
				$parameters .= ' LIMIT ' .$options['limit'];
			}
			switch ($query) {
				case 'all':
					$sql = "SELECT $fields FROM $table".' '.$parameters;
					$this->result = $this->connection->query($sql);
					break;
				case 'count':
					$sql = "SELECT COUNT(*) FROM $table".' '.$parameters;
					$result = $this->result = $this->connection->query($sql);
					$this->result = $result->fetchColumn();
					break;
				case 'first':
					$sql = "SELECT $fields FROM $table".' '.$parameters;
					$result = $this->result = $this->connection->query($sql);
					$this->result = $result->fetch();

					break;
				
				default:
					$sql = "SELECT $fields FROM $table".' '.$parameters;
					$this->result = $this->connection->query($sql);
					break;
			}
			return $this->result;
		}

		/**
		* Metodo save 
		* 
		* Metodo que sirve para guardar registros
		* Obtener el numero de columnas
		* @param  $table tabla a consultar
		* @param  $data valores a guardar
		* @return object
		* @author Jeronimo Mendez <jero_mdz@gmail.com>
		*/
		public function save($table = null, $data = array()){
			$sql = "SELECT * FROM $table";
			$result = $this->connection->query($sql);

			for ($i=0; $i < $result->columnCount(); $i++) { 
				$meta = $result->getColumnMeta($i);
				$fields[$meta['name']] = null;
			}

			/**
			 *Convecion de nombres,
			 *Tablas en plural
			 */
			$fieldsToSave = 'id';
			$valueToSave = 'NULL';

			foreach ($data as $key => $value) {
				if (array_key_exists($key, $fields)) {
					$fieldsToSave .= ', ' .$key;
					$valueToSave  .= ', '."\"$value\"";				
				}
			}
		

		$sql = "INSERT INTO $table ($fieldsToSave) 
		VALUES ($valueToSave);";

		$this->result = $this->connection->query($sql);

		return $this->result;

		}



	/**
	 * Metodo update 
	 * Metodo que sirve para actualizar registros
	 * @param  $table tabla a consultar
	 * @param  $data valores a actualizar
	 * @return object
	 * @author Jeronimo Mendez <jero_mdz@gmail.com>
	 */

	public function update($table = null, $data = array()){
		$sql = "SELECT * FROM $table";
			$result = $this->connection->query($sql);

			for ($i=0; $i < $result->columnCount(); $i++) { 
				$meta = $result->getColumnMeta($i);
				$fields[$meta['name']] = null;
			}
			if (array_key_exists("id", $data)) {
				$fieldsToSave = "";
				$id = $data['id'];
				unset($data['id']);

				foreach ($data as $key => $value) {
					if (array_key_exists($key, $fields)){
						$fieldsToSave .= $key."="."\"$value\", ";
					}
				}
				$fieldsToSave = substr_replace($fieldsToSave, "", -2);
				$sql = "UPDATE $table SET $fieldsToSave WHERE $table.id=$id;";
			}	
			$this->result = $this->connection->query($sql);
			return $this->result;

	}


	 /* Método delete 
	 * Método que sirve para eliminar registros
	 * @param  $table tabla a consultar
	 * @param  $condition condición a cumplir
	 * @return object
	 * @author Jeronimo Mendez <Jero_mdz@gmail.com>
	 */

	public function delete($table = null, $conditions){
		$sql = "DELETE FROM $table WHERE $conditions".";";
		$this->result = $this->connection->query($sql);

		$this->numberRows = $this->result->rowCount();
		return $this->result;
	}

}
$db = new classPDO();

?>

