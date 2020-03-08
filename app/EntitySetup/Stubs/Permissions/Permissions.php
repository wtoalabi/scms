<?php
  /**
   * Created by Alabi Olawale
   * Date: 6/3/2019
   */
  declare(strict_types=1);

  namespace App\EntitySetup\Stubs\Permissions;

  use App\EntitySetup\ScaffoldCommand;
  use App\EntitySetup\Stubs\FileEditor;
  use Illuminate\Support\Str;

  class Permissions
  {

    public static function SetUp() {
      $data = session('data');
      static::CheckDefaults($data);
    }

    private static function CheckDefaults($data) {
      $file = $data['file'];
      self::CreatePermissionDefaults($data);
      self::CreatePermissionSeedForEntity();
      self::RegisterEntityPermissionSeeder($data);
    }

    private static function CreatePermissionDefaults($data) {
      static::createSetUpFile($data);
      static::CreatePermissionsFolder();
      static::CreatePermissionModel($data);
    }

    private static function createSetUpFile($data) {
      $nameInFull = "SetUps\\PermissionsSetup";
      $data['command']->callSilent('make:seeder', ['name' => $nameInFull]);
    }

    private static function CreatePermissionsFolder() {
      ScaffoldCommand::makeDirectory(database_path("seeds\Authorization\Permissions"));
    }


    private static function CreatePermissionSeedForEntity() {
      $data = session('data');
      $dummyContent = $data['file']->get('App\EntitySetUp\Stubs\Permissions\EntityPermission.stub');
      $permissionModelLocation = "{$data['base']}\\Base\Authorization\Permission";
      $destinationPath = database_path("seeds\Authorization\Permissions\\{$data['name']}PermissionsSeeder.php");
      $repositoryContent = str_replace(
        ['Dummy', 'Dummies', 'DUMMY', 'PermissionModel',],
        [
          $data['name'], $data['pluralizedName'], Str::upper($data['name']),
          $permissionModelLocation, $data['base'],Str::lower($data['name'])], $dummyContent);
      $data['file']->put($destinationPath, $repositoryContent);
    }

    private static function CreatePermissionModel($data) {
      if(!$data['file']->exists("{$data['base']}\\Base\Authorization\Permission.php")) {
        $fullModelName = "{$data['base']}\\Base\Authorization\Permission";
        $data['command']->call('make:model', [
          'name' => $fullModelName,
          '--migration' => $data['command']->options('migration'),
          '--factory' => $data['command']->options('factory'),
        ]);
      }
    }

    private static function RegisterEntityPermissionSeeder($data) {
      $newString = '      $this->call('. "{$data['name']}PermissionSeeder::class);";
      $destinationPath = database_path("seeds\SetUps\PermissionsSetup.php");
      FileEditor::Write("//", $newString, $destinationPath);
    }
  }
