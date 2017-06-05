<?php
namespace Core;


class Validator
{
   public static function make(array $data, array $rules)
   {
      $error=[];
      foreach ($rules as $ruleKey => $ruleValue) {
         foreach ($data as $dataKey => $dataValue) {
            if ($ruleKey == $dataKey) {
               $itemsValue = [];
               if(strpos($ruleValue, "|")){
                  $itemsValue = explode("|", $ruleValue);
                  foreach ($itemsValue as $itemValue){
                     $subItems = [];
                     if(strpos($itemValue, ":")){
                        $subItems = explode(":", $itemValue);
                        switch ($subItems[0]) {
                           case 'min':
                              if (strlen($dataValue) < $subItems[1])
                                 $error["$ruleKey"] = "O campo {$ruleKey} deve ter um mínimo de {$subItems[1]} caracteres.";
                              break;
                           case 'max' :
                              if (strlen($dataValue) > $subItems[1])
                                 $error["$ruleKey"] = "O campo {$ruleKey} deve ter um máximo de {$subItems[1]} caracteres.";
                              break;
                           case 'unique' :
                              $objModel = "\\App\\Models\\" . $subItems[1];
                              $model = new $objModel;
                              $find = $model->where($subItems[2], $dataValue)->first();
                              if($find->subItens[2]){
                                 if(isset($subItems[3]) && $find->id == $subItems[3]){
                                    break;
                                 } else {
                                    $error["$ruleKey"] = "{$ruleKey} já registrado no banco de dados.";
                                    break;
                                 }
                              }
                              break;
                        }
                     }else{
                        switch ($itemValue) {
                           case 'required':
                              if ($dataValue == ' ' || empty($dataValue))
                                 $error["$ruleKey"] = "O campo {$ruleKey} deve ser preenchido.";
                              break;
                           case 'email':
                              if (!filter_var($dataValue, FILTER_VALIDATE_EMAIL))
                                 $error["$ruleKey"] = "O campo {$ruleKey} não é válido.";
                              break;
                           case 'float':
                              if (!filter_var($dataValue, FILTER_VALIDATE_FLOAT))
                                 $error["$ruleKey"] = "O campo {$ruleKey} deve conter número decimal.";
                           case 'int':
                              if (!filter_var($dataValue, FILTER_VALIDATE_INT))
                                 $error["$ruleKey"] = "O campo {$ruleKey} deve conter número inteiro.";
                              break;
                           default :
                              break;
                        }
                     }
                  }
               }elseif (strpos($ruleValue, ":")) {
                  $items = explode(":", $ruleValue);
                  switch ($items[0]) {
                     case 'min':
                        if (strlen($dataValue) < $items[1])
                           $error["$ruleKey"] = "O campo {$ruleKey} deve ter um mínimo de {$items[1]} caracteres.";
                        break;
                     case 'max' :
                        if (strlen($dataValue) > $items[1])
                           $error["$ruleKey"] = "O campo {$ruleKey} deve ter um máximo de {$items[1]} caracteres.";
                        break;
                     case 'unique' :
                        $objModel = "\\App\\Models\\" . $subItems[1];
                        $model = new $objModel;
                        $find = $model->where($subItems[2], $dataValue)->first();
                        if($find->subItens[2]){
                           if(isset($subItems[3]) && $find->id == $subItems[3]){
                              break;
                           } else {
                              $error["$ruleKey"] = "{$ruleKey} já registrado no banco de dados.";
                              break;
                           }
                        }
                        break;
                     
                  }
               } else {
                  switch ($ruleValue) {
                     case 'required':
                        if ($dataValue == ' ' || empty($dataValue))
                           $error["$ruleKey"] = "O campo {$ruleKey} deve ser preenchido.";
                        break;
                     case 'email':
                        if (!filter_var($dataValue, FILTER_VALIDATE_EMAIL))
                           $error["$ruleKey"] = "O campo {$ruleKey} não é válido.";
                        break;
                     case 'float':
                        if (!filter_var($dataValue, FILTER_VALIDATE_FLOAT))
                           $error["$ruleKey"] = "O campo {$ruleKey} deve conter número decimal.";
                        break;
                     case 'int':
                        if (!filter_var($dataValue, FILTER_VALIDATE_INT))
                           $error["$ruleKey"] = "O campo {$ruleKey} deve conter número inteiro.";
                        break;
                     default :
                        break;
                  }
               }
            }
         }
      }
      if ($error) {
         Session::set('error', $error);
         Session::set('input', $data);
         return true;
      } else {
         Session::destroy(['error', 'inputs']);
         return false;
      }
   }
}