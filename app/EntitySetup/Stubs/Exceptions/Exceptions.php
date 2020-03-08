<?php
  /**
   * Created by Alabi Olawale
   * Date: 6/1/2019
   */
  declare(strict_types=1);
  
  namespace App\EntitySetup\Stubs\Exceptions;
  
  
  use Illuminate\Support\Str;
  
  class Exceptions
  {
    public static function SetUp() {
      $data = session('data');
      $name = $data['name'];
      static::generateException("{$name}NotFound", $data);
      static::generateException("Create{$name}Error", $data);
      static::generateException("Update{$name}Error", $data);
      static::generateException("Delete{$name}Error", $data);
      $data['command']->info('Exception files for ' . $data['name'] . ' have been created.');
    }
    
    private static function generateException($name, $data) {
      $path = "{$data['namespace']}\\{$data['pluralizedName']}\Exceptions";
      $nameInFull = "$path\\{$name}Exception";
      $data['command']->callSilent('make:exception', ['name' => $nameInFull]);
    }
    
    /*ModelNotFoundException
    CreateModelErrorException
    UpdateModelErrorException
    DeleteModelErrorException*/
  }