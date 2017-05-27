<?php
namespace App\Controllers;

use App\Models\Post;
use Core\BaseController;
use Core\Container;
use Core\Database;


class PostsController extends BaseController
{
   public function index()
   {
      $model = Container::getModel("Post");
      $posts = $model->All();
      print_r($posts);
   }

   public function show($id, $request)
   {
      echo "id: $id" . "<br>";
      echo $request->get->nome . "<br>";
      echo $request->get->sexo . "<br>";
   }    
}