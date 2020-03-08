<?php
  /**
   * Created by Alabi Olawale
   * Date: 7/25/2019
   */
  declare(strict_types=1);
  
  namespace App\Platform\Base\Exceptions;
  
  
  use Exception;

  class ExceptionResponse{
    
    public static function Message(Exception $exception) {
      if(isset($exception->custom)){
        return response(['message'=> $exception->getMessage()],405);
      }else{
        return response(['message'=> "Internal Server Error. Please try again later."],500);
      }
    }
  }