<?php
  /**
   * Created by Alabi Olawale
   * Date: 6/3/2019
   */
  declare(strict_types=1);
  
  namespace App\EntitySetup\Stubs;
  
  
  use Illuminate\Support\Str;

  class FileEditor
  {
    public static function Write($existingPageMarker, $stringToInsert, $location) {
      $data = session('data');
      $oldFile = $data['file']->get($location);
      if(!Str::contains($oldFile, $stringToInsert)){
        $replacement = static::generateReplacementFrom($existingPageMarker, $stringToInsert);
        $newContent = str_replace([$existingPageMarker], [$replacement], $oldFile);
        $data['file']->put($location, $newContent);
      }
      return;
    }
  
    private static function generateReplacementFrom($oldString, $newString) {
      return "{$oldString}\n{$newString}";
    }
  }