<?php

namespace App\Controllers;

class HomeController
{
   private $view;
   
   public function __construct()
   {
      $this->view = new \stdClass;
      $this->view->nome = "Wanderlei Hüttel";
   }
   
   public function index()
   {
      require_once __DIR__ . "/../Views/home/index.phtml";
   }   
}