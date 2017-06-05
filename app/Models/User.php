<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
   public $table = "users";
   public $timestamps = false;
   public $fillable = ['name', 'email', 'password'];
   
   public function rules($id=null)
   {
      if(isset($id)){
         $id=":$id";
      }
      return [
         'name'   => 'min:4|max:255',
         'email' => "email|unique:User:email{$id}",
         'password' => 'min:5|max:50'
      ];
   }
}