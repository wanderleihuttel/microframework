<?php

namespace Core;


class Validator
{
   public static function make(array $data,array $rules)
   {
      $errors = [];
      foreach ($rules as $ruleKey => $ruleValue){
         foreach ($data as $dataKey => $dataValue){
            if($ruleKey == $dataKey){
               switch ($ruleValue){
                  case 'required':
                     if($dataValue=='' || empty($dataValue)){
                        $errors[$ruleKey] = "O campo '{$ruleKey}' deve preenchido.";
                     }
                     break;
                  case 'email':
                     if(!filter_var($dataValue,FILTER_VALIDATE_EMAIL)){
                        $errors[$ruleKey] = "O campo '{$ruleKey}' não é válido.";
                     }
                     break;
                  case 'float':
                     if(!filter_var($dataValue,FILTER_VALIDATE_FLOAT)){
                        $errors[$ruleKey] = "O campo '{$ruleKey}' deve conter um número decimal.";
                     }
                     break;
                  case 'integer':
                     if(!filter_var($dataValue,FILTER_VALIDATE_INT)){
                        $errors[$ruleKey] = "O campo '{$ruleKey}' deve conter um número inteiro.";
                     }
                     break;
               }
            }
         }
      }
      if($errors){
         Session::set('error',$errors);
         Session::set('input',$data);
         return true;
      } else {
         Session::destroy(['error','input']);
         return false;
      }
   }
   
}