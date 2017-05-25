<?php
/**
 * Created by PhpStorm.
 * User: wanderlei
 * Date: 25/05/2017
 * Time: 20:28
 */

namespace Core;

use PDO;
use PDOException;

class Database
{
	pubic function getDatabase()
   {
	   $conf = require_once __DIR__ . "/..app/database.php";
		if($conf['driver']=="sqlite"){
			$sqlite = __DIR__  . "/../storage/database/" . $conf['sqlite']['host'];
			$sqlite = "sqlite:".$sqlite;
			//$charset = $conf['sqlite']['charset'];
			//$collation = $conf['sqlite']['collation'];
			try{
				 $pdo = new PDO($sqlite);
				 $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				 $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
				 return $pdo;
			}
			catch (PDOException $e){
				echo $e->getMessage();
			}
		} else if ($conf['driver']=='mysql'){
		     $host = $config['mysql']['host'];
			  $db = $config['mysql']['database'];
			  $user = $config['mysql']['user'];
			  $password = $config['mysql']['password'];
			  $charset = $conf['mysql']['charset'];
			  $collation = $conf['mysql']['collation'];
			try{
				$pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $password);
				$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES '$charset' COLLATE '$collation'");
				$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
				return $pdo;
			}
			catch (PDOException $e){
				echo $e->getMessage();
			}

		}
   }
	
}