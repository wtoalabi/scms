<?php
  /**
   * Created by Alabi Olawale
   * Date: 6/1/2019
   */
  declare(strict_types=1);
  
  namespace App\EntitySetup\Stubs\Repositories;
  use Illuminate\Support\Str;

  class Repositories
  {
    
    public static function Setup() {
      static::createStubs();
    }
    
    private static function createStubs() {
      $data = session('data');
      if(!$data['file']->exists("{$data['base']}\Base\BaseRepositoryInterface")){
        
        static::makeFile(
          app_path('EntitySetUp\Stubs\Repositories\DummyRepositoryBase.stub'),
          "{$data['base']}\Base\BaseRepositoryInterface.php"
        );
      }
      
      static::makeFile(
        app_path('EntitySetUp\Stubs\Repositories\DummyRepositoryInterface.stub'),
        "{$data['namespace']}\\{$data['pluralizedName']}\Repositories\Interfaces\\{$data['name']}RepositoryInterface.php"
      );
  
      static::makeFile(
        app_path('EntitySetUp\Stubs\Repositories\DummyRepository.stub'),
        "{$data['namespace']}\\{$data['pluralizedName']}\Repositories\\{$data['name']}Repository.php"
      );
  
      $data['command']->info('Repositories for ' . $data['pluralizedName'] . ' created.');
    }
    
    public static function makeFile($dummySource, $destinationPath) {
      $data = session('data');
      $dummyContent = $data['file']->get($dummySource);
      $repositoryContent = str_replace(['Dummy', 'Dummies', 'Path','Main','dummy'], [$data['name'], $data['pluralizedName'], $data['namespace'], $data['base'],Str::lower($data['name'])], $dummyContent);
      $data['file']->put($destinationPath, $repositoryContent);
      /*$data['file']->put($dummySource, $repositoryContent);
      $data['file']->copy($dummySource, $destinationPath);
      $data['file']->put($dummySource, $dummyContent);*/
    }
    
  }
  
