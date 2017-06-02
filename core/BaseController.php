<?php

namespace Core;

class BaseController
{
   protected $view;
   private $viewPath;
   private $layoutPath;
   private $title = null;
   
   public function __construct()
   {
      $this->view = new \stdClass;
   }
   
   protected function renderView($viewPath, $layoutPath = null)
   {
      $this->viewPath = $viewPath;
      $this->layoutPath = $layoutPath;
      if($layoutPath){
         return $this->setLayout();
      } else {
         return  $this->content();
      }
   }
   
   protected function content()
   {
      $path = __DIR__ . "/../app/Views/{$this->viewPath}.phtml";
      if(file_exists( __DIR__ . "/../app/Views/{$this->viewPath}.phtml")){
         return require_once __DIR__ . "/../app/Views/{$this->viewPath}.phtml";
      } else {
         echo "Error: View path not found! <br/>$path";
      }
   }
   
   protected function setLayout()
   {
      $path = __DIR__ . "/../app/Views/{$this->layoutPath}.phtml";
      if(file_exists( __DIR__ . "/../app/Views/{$this->layoutPath}.phtml")){
         return require_once __DIR__ . "/../app/Views/{$this->layoutPath}.phtml";
      } else {
         echo "Error: Layout path not found!<br/>$path";
      }
   }

   protected function setPageTitle($title)
   {
      $this->title = $title;
   }

   protected function getPageTitle($separator=null)
   {
      if($separator){
         return $this->title . " " . $separator . " ";
      } else {
         return $this->title;
      }
   }

    
}