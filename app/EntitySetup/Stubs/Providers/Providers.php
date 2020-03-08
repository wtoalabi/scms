<?php
  /**
   * Created by Alabi Olawale
   * Date: 6/1/2019
   */
  declare(strict_types=1);
  
  namespace App\EntitySetup;
  
  
  use App\EntitySetup\Stubs\FileEditor;
  use Illuminate\Support\Str;

  class Providers
  {
    public static function SetUp() {
      $data = session('data');
      $path = app_path('Providers\EntitiesServiceProvider.php');
      if(!$data['file']->exists("$path")){
        static::MoveBaseProvider($path);
        static::RegisterBaseProvider();
      }
       FileEditor::Write(oldBindingLine(), addNewBindingLine($data), $path);
        FileEditor::Write(importStatementToBeReplaced(), newImportStatement($data), $path);
    }
    public static function MoveBaseProvider($path) {
      $data = session('data');
        $data['file']->copy("App\EntitySetUp\Stubs\Providers\DummyEntitiesProvider.stub", $path);
        $data['command']->info('Entities Service Provider was created successfully.');
   }
  
    private static function RegisterBaseProvider() {
      $existingPageMarker = 'App\Providers\AppServiceProvider::class,';
      $location = config_path("app.php");
      $stringToInsert = "        App\Providers\EntitiesServiceProvider::class,";
      FileEditor::Write($existingPageMarker, $stringToInsert, $location);
    }
  }
  
  function oldBindingLine(){
  return "//Add New Binding";
  }
  function addNewBindingLine($data){
    $bind = '       $this->app->bind(';
    $name = Str::studly($data['name']);
    return $bind."{$name}RepositoryInterface::class, {$name}Repository::class);";
  }
  function newImportStatement($data){
    $base = "use {$data['namespace']}\\{$data['pluralizedName']}\Repositories";
    return "{$base}\\{$data['name']}Repository;\n{$base}\Interfaces\\{$data['name']}RepositoryInterface;";

  }
  function importStatementToBeReplaced(){
    return "use Illuminate\Support\ServiceProvider;";
  }