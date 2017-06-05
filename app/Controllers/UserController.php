<?php


namespace App\Controllers;


use Core\BaseController;
use Core\Redirect;
use Core\Validator;

class UserController extends BaseController
{
   private $user;
   
   public function __construct()
   {
      parent::__construct();
      $this->user = new User();
      
   }
   
   public function create()
   {
      $this->setPageTitle('New user');
      return $this->renderView('user/create','layout');
   }
   
   public function store(array $request)
   {
      $data = [
         'name' => $request->post->name,
         'email' => $request->post->email,
         'password' => $request->post->password
      ];
      
      if(Validator::make($data,$this->user->rules())){
         return Redirect::route('/users/create');
      }
      
      $data['password'] = password_hash($request->post->password,PASSWORD_BCRYPT);
      try{
         $post = $this->user->create($data);
         return Redirect::route('/',[ 'success' => ['Usuário criado com sucesso!']]);
      } catch(\Exception $e){
         return Redirect::route('/',[ 'error' => [$e->getMessage()]]);
      }   }
}