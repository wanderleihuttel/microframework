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
      $this->setPageTitle("Todos Posts");
      $model = Container::getModel("Post");
      $this->view->posts = $model->All();
      $this->renderView('posts/index', 'layout');
   }

   public function show($id)
   {
      $model = Container::getModel("Post");
      $this->view->post = $model->find($id);
      $this->setPageTitle($this->view->post->title);
      $this->renderView('posts/show', 'layout');
   }
}