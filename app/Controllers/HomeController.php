<?php

namespace App\Controllers;

use Core\BaseController;

class HomeController extends BaseController
{
   
   public function index()
   {
      $this->view->nome = "Wanderlei Hüttel";
      $this->renderView('home/index', 'layout');
   }   
}