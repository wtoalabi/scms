<?php
  /**
   * Created by Alabi Olawale
   * Date: 6/3/2019
   */
  declare(strict_types=1);

  namespace App\EntitySetup\Stubs\Seeders;
  use App\EntitySetup\ScaffoldCommand;
  use App\EntitySetup\Stubs\FileEditor;

  class Seeders
  {
    public static function SetUp(){
      $data = session('data');
      $name = $data['pluralizedName'];
      $pathName = $data['givenPath'] ? "{$data['givenPath']}\\$name" : $name;
      $path = database_path("seeds\\$pathName");

      static::MoveInitialSetupFile($data['file']);

      if(!$data['file']->exists($path)){
          static::CreateSeederWith($data, $path);
          static::EditDatabaseSeederFile($data);
          $data['command']->info('Default Seeder for ' . $data['pluralizedName'] . ' has been created.');
        }else{
            $data['command']->error("Seeder already exists!");
        }
    }

    private static function CreateSeederWith($data, $path) {
      $name = "{$data['namespace']}\\{$data['pluralizedName']}\\{$data['name']}";
      $dummyContent = $data['file']->get("App\EntitySetup\Stubs\Seeders\DummySeeder.stub");
      $seederContent = str_replace(['Namespace', 'Dummies', 'Dummy'], [$name, $data['pluralizedName'], $data['name']], $dummyContent);
      $customPath = $data['givenPath'] ?? '';
      $seederPath = database_path("seeds\\$customPath\\{$data['pluralizedName']}");
      ScaffoldCommand::makeDirectory($seederPath);
      $data['file']->put("$path\\{$data['pluralizedName']}Seeder.php", $seederContent);
    }

    private static function EditDatabaseSeederFile($data) {
      $path = database_path('seeds/DatabaseSeeder.php');
      FileEditor::Write(oldLine(), newLine($data), $path);
    }
    public static function MoveInitialSetupFile($file){
        $path = database_path("seeds\SetUps\InitialSetUp.php");
        if(!$file->exists($path)){
            $content = $file->get("App\EntitySetup\Stubs\Seeders\InitialSetup.stub");
            $file->put($path, $content);
            $initialCall = '      $this->call(InitialSetUp::class);';
            FileEditor::Write(oldLine(), $initialCall, database_path("seeds\DatabaseSeeder.php") );
        }
    }
  }

  function oldLine(){
    return '// $this->call(UsersTableSeeder::class);';
  }

  function newLine($data){
    $class = "{$data['pluralizedName']}Seeder::class";
    return '      $this->call('.$class.');';
  }
