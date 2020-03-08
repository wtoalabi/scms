<?php
  /**
   * Created by Alabi Olawale
   * Date: 6/3/2019
   */
  declare(strict_types=1);
  
  namespace App\EntitySetup\Stubs\Controllers;
  
  
  use App\EntitySetup\ScaffoldCommand;
  use Illuminate\Support\Str;

  class Controllers
  {
    
    private static $data;
  
    public static function SetUp() {
      static::$data = $data = session('data');
      $path = $data['givenPath'] ? "{$data['givenPath']}\\":'';
      $controllerNamespace = self::getControllerNamespace($path);
      $repositoryContent = self::getRepositoryContent($controllerNamespace);
      static::createPathIfNotExisting($controllerNamespace);
      self::createController($controllerNamespace, $repositoryContent);
      $data['command']->info('Resourceful Controller for ' . $data['pluralizedName'] . ' has been created.');
    }
  
    private static function createPathIfNotExisting($namespace) {
      $data = static::$data;
      if(!$data['file']->exists($namespace)){
        ScaffoldCommand::makeDirectory($namespace);
      }
    }
  
    protected static function getRepositoryContent(string $controllerNamespace){
      $data = static::$data;
      $modelName = "{$data['namespace']}\\{$data['pluralizedName']}\Requests";
      $repositoryNamespace = self::getRepositoryNamespace();
      $dummyContent = self::getDummyContent();
      $repositoryContent = str_replace([
        'RequestNamespace','Dummy', 'Dummies', 'controllerNamespace', 'RepositoryNamespace', 'dummy'
      ],
        [$modelName, $data['name'], $data['pluralizedName'], "$controllerNamespace", $repositoryNamespace,
          Str::lower($data['name'])], $dummyContent);
      return $repositoryContent;
    }
  
    protected static function getControllerNamespace(string $path) {
      $data = static::$data;
      $controllerNamespace = "App\Http\Controllers\\{$path }{$data['pluralizedName']}";
      return $controllerNamespace;
    }
  
    protected static function getDummyContent() {
      $dummyContent = static::$data['file']->get("App\EntitySetUp\Stubs\Controllers\DummyController.stub");
      return $dummyContent;
    }
  
    protected static function getRepositoryNamespace(): string {
      $data = static::$data;
      $path = "{$data['namespace']}\\{$data['pluralizedName']}";
      $repositoryNamespace = "$path\Repositories\Interfaces\\{$data['name']}RepositoryInterface
      ";
      return $repositoryNamespace;
    }
  
    protected static function createController(string $controllerNamespace, $repositoryContent): void {
      $data = static::$data;
      $data['file']->put("{$controllerNamespace}\\{$data['pluralizedName']}Controller.php", $repositoryContent);
    }
  }