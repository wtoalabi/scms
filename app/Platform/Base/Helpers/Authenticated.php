<?php
  /**
   * Created by Alabi Olawale
   * Date: 6/21/2019
   */
  declare(strict_types=1);

  namespace App\Platform\Base\Helpers;


  class Authenticated{
    public static function User() {
      $user = '';
      if(auth('user')->user()){
        $user = auth('user')->user();
      }elseif (auth('merchant')->user()){
        $user = auth('merchant')->user();
      }elseif(auth('admin')->user()){
        $user = auth('admin')->user();
      }
      return $user;
    }

      public static function LimitToID() {
          $user = static::User();
          if(class_basename($user) == "User"){
              $id = $user->id;
          }else{
              if(class_basename($user) == "Admin"){
                  $id = request('user_id');
              }else{
                  $id = 1;
              }
          }
          return $id;
    }
  }
