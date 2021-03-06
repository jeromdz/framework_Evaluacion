<?php
/**
 * clase password
 * 
 * clase para el manejo de contraseñas
 * 
 * @author  Jorge Rivera <yo.jrivera@gmail.com>
 * @version  1.0 Primera versión estable
 * @package  seguridad
 * @copyright  2015
 * 
 */


	class password
	{
		public function __construct(){
			$this->checkblowfish();

		}
		/**
		 * checkblowfish chequeo de algoritmo de codificación
		 * @return void 
		 */
		private function checkblowfish(){
			if(!defined("CRYPT_BLOWFISH") && !CRYPT_BLOWFISH)
			{
				echo "Algoritm Blowfish no esta soportado";
				die();
			}		
		}

		/**
		 * getpassword Metodo para generar hash de contrseñas
		 * @param  string $password contraseña base para generar hash
		 * @return string hash de contraseña generado
		 */
		static public function getpassword($password){
			$option = array(
					"cost" => 7
				);
			/**
			 * $hash variable que guarda el hash generado
			 * @var string
			 */
			$hash = password_hash($password, PASSWORD_BCRYPT, $option);

			return $hash;
		}
		/**
		 * passwordverify description verificación de contraseñas
		 * @param  string $pass1 hash a comparar
		 * @param  string $pass2 hash base
		 * @return boolean    
		 * @version  5.5 php
		 */
		static public function passwordverify($pass1, $pass2){
			if(password_verify($pass1, $pass2)) {
				return true;
			}

			return false;
		}

	}
?>