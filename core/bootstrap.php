<?php
/* start session */
if(!session_id()){
   session_start();
}

/* Start Illuminate Database */
$config = require_once __DIR__ . "/../app/database.php";
if($config['baseModel']=='illuminate'){
   $capsule = new \Illuminate\Database\Capsule\Manager;
   if($config['driver']=='mysql'){
      $capsule->addConnection([
         'driver' => 'mysql',
         'host' => $config['mysql']['host'],
         'database' => $config['mysql']['db_name'],
         'username' => $config['mysql']['username'],
         'password' => $config['mysql']['password'],
         'charset' => $config['mysql']['charset'],
         'collation' => $config['mysql']['collation'],
         'prefix' => '',
      ]);
   } else if($config['driver']=='sqlite'){
      $capsule->addConnection([
         'driver' => 'sqlite',
         'database' => __DIR__ . "/../storage/database/" . $config['sqlite']['database']
      ]);
   }
   $capsule->bootEloquent();
}

/* Start routes */
$routes = require_once __DIR__ . "/../app/routes.php";
$route = new \Core\Route($routes);
