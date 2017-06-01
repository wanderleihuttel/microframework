<?php
namespace App\Controllers;

use App\Models\Post;
use Core\BaseController;
use Core\Container;
use Core\Database;
use Core\Redirect;
use Core\Session;


class PostsController extends BaseController
{
   private $post;
   
   public function __construct()
   {
      parent::__construct();
      $this->post = Container::getModel("Post");
      
   }
   
   public function index()
   {
      if(Session::get('success')){
         $this->view->success = Session::get('success');
         Session::destroy('success');
      }
      if(Session::get('error')){
         $this->view->success = Session::get('error');
         Session::destroy('success');
      }
      $this->setPageTitle("Todos Posts");
      $this->view->posts = $this->post->All();
      $this->renderView('posts/index', 'layout');
   }

   public function show($id)
   {
      $this->view->post = $this->post->find($id);
      $this->setPageTitle($this->view->post->title);
      $this->renderView('posts/show', 'layout');
   }

   public function create()
   {
      $this->setPageTitle("New post");
      $this->renderView('posts/create', 'layout');
   }

   public function store($request)
   {
      $data = [
         'title'   => $request->post->title,
         'content' => $request->post->content
      ];
      
      if($this->post->create($data)){
         return Redirect::route('/posts');
      } else {
         return  "Erro ao inserir no banco de dados!";
      }
   }
   
   public function edit($id)
   {
      $this->view->post = $this->post->find($id);
      $this->setPageTitle('Edit post - ' . $this->view->post->title);
      $this->renderView('posts/edit', 'layout');
   }
   
   public function update($id, $request)
   {
      $data = [
         'title'   => $request->post->title,
         'content' => $request->post->content
      ];
   
      if(!$this->post->update($data,$id)){
         return Redirect::route('/posts',[ 'success' => ['Post atualizado com sucesso!']]);
      } else {
         return Redirect::route('/posts',[ 'error' => ['Ocorreu um erro ao atualizar o post!']]);
      }
   }
   
   public function delete($id)
   {
      if($this->post->delete($id)){
         return Redirect::route('/posts');
      } else {
         return "Erro ao excluir registro!";
      }
   }

}