<?php

namespace App\Controllers;

class PostsController
{
   public function index()
   {
      echo "Posts";
   }

   public function show($id, $request)
   {
      echo "id: $id" . "<br>";
      echo $request->get->nome . "<br>";
      echo $request->get->sexo . "<br>";
   }    
}