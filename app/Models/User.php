<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
   public $table = "users";
   public $timestamps = false;
   public $fillable = ['name', 'email', 'password'];
   
   public function rules()
   {
      return [
         'title'   => 'min:2|max:255',
         'content' => 'min:10'
      ];
   }
}