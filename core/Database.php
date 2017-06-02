<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
	public static function getDatabase()
   {
	   $conf = require_once __DIR__ . "/../app/database.php";
		if($conf['driver']=='sqlite'){
			$sqlite = __DIR__  . "/../storage/database/" . $conf['sqlite']['database'];
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
			  $db_name = $config['mysql']['db_name'];
			  $username = $config['mysql']['db_username'];
			  $password = $config['mysql']['db_password'];
			  $charset = $conf['mysql']['charset'];
			  $collation = $conf['mysql']['collation'];
			try{
				$pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=$charset", $username, $password);
				print_r ($pdo);
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