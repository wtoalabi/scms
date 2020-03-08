<?php
  /**
   * Created by Alabi Olawale
   * Date: 6/3/2019
   */
  declare(strict_types=1);
  
  namespace App\EntitySetup\Stubs\Tests;
  
  
  use App\EntitySetup\ScaffoldCommand;
  use Illuminate\Support\Str;

  class Tests
  {
    public static function SetUp() {
      $data = session('data');
      static::moveDefaultTestParentFor("Feature",$data);
      static::moveDefaultTestParentFor("Unit",$data);
      static::moveSampleTest("Feature", $data);
      static::moveSampleTest("Unit", $data);
    }
  
    private static function moveDefaultTestParentFor($test, $data) {
      $testName = base_path("tests\\{$test}TestCase.php");
      if(!$data['file']->exists($testName)) {
        $dummyResource = $data['file']->get("App\EntitySetup\Stubs\Tests\\{$test}TestCase.stub");
        $data['file']->put($testName, $dummyResource);
      }
      
    }
  
    private static function moveSampleTest($test, $data) {
      $base = base_path("tests\\{$test}");
      $normalizedPath = ScaffoldCommand::NormalizedPath($data['givenPath'], $base);
      $namespace = ScaffoldCommand::NormalizedPath($data['givenPath'], $data['pluralizedName']);
      $filePath = "{$normalizedPath}\\{$data['pluralizedName']}\\{$data['name']}{$test}Test.php";
      ScaffoldCommand::makeDirectory("$normalizedPath\\{$data['pluralizedName']}");
      $dummyContent = $data['file']->get("App\EntitySetup\Stubs\Tests\\{$test}Test.stub");
      $testContent = str_replace(['Path', 'Dummy','dummy'], [$namespace, $data['name'], Str::lower($data['name'])], $dummyContent);
      $data['file']->put($filePath, $testContent);
    }
  }