<?php
/**
 * @author  Jeronimo Mendez <Jero_mdz@gmail.com>
 * @version  1.0 Primera versión estable
 * @package  framework
 * @copyright  2015
 */

/**  Se defineel controlador y metodo por default y ruta de las aplicaciones
 */
define("DEFAULT_CONTROLLER", "tareas");
define("DEFAULT_LAYOUT", "default");

define("APP_FOLDER", "framework");
define("APP_URL", "http://".$_SERVER['SERVER_NAME']."/".APP_FOLDER."/");

define("APP_URL_CSS", APP_URL."public/css/");
define("APP_URL_IMG", APP_URL."public/img/");
define("APP_URL_JS",  APP_URL."public/js/");

define("APP_NAME", "Framework");

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "gestion");
define("DB_CHAR", "UTF8");
?>