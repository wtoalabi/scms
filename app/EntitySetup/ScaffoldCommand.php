<?php

  namespace App\EntitySetup;

  use App\EntitySetup\Stubs\Controllers\Controllers;
  use App\EntitySetup\Stubs\Exceptions\Exceptions;
  use App\EntitySetup\Stubs\Permissions\Permissions;
  use App\EntitySetup\Stubs\Policies\Policies;
  use App\EntitySetup\Stubs\Repositories\Repositories;
  use App\EntitySetup\Stubs\Requests\Requests;
  use App\EntitySetup\Stubs\Resources\Resources;
  use App\EntitySetup\Stubs\Seeders\Seeders;
  use App\EntitySetup\Stubs\Tests\Tests;

  class ScaffoldCommand
  {

    public function __construct() {
    }

    public function setUp() {
      if ($this->entityExists()) {
        return session('data')['command']->error("Entity exists!");
      }
      $this->runCommands();
      session()->forget('data');

    }

    private function runCommands() {
      Tests::SetUp();
      Folders::SetUp();
      Permissions::SetUp();
      //Providers::SetUp();
      //Repositories::Setup();
      Requests::SetUp();
      Exceptions::SetUp();
      Policies::SetUp();
      //Controllers::SetUp();
      //Seeders::SetUp();
      //Resources::SetUp();
      $this->createModel();
      session('data')['command']->info('All scafolding created Successfully!');
    }

    private function entityExists() {
      $data = session('data');
      return $data['file']->exists("{$data['pathName']}\\{$data['pluralizedName']}");
    }

    private function createModel() {
      $data = session('data');
      $fullModelName = "{$data['namespace']}\\{$data['pluralizedName']}\\{$data['model']}";
      $data['command']->call('make:model', [
        'name' => $fullModelName,
        '--migration' => $data['command']->options('migration'),
        '--factory' => $data['command']->options('factory'),
      ]);
      return $this;
    }

    public static function makeDirectory($path) {
      $file = session('data')['file'];
      if (!$file->exists($path)) {
        return $file->makeDirectory($path, 0755, true, true);
      }
    }

    public static function NormalizedPath($given, $base) {
      if($given){
        return "{$base}\\{$given}";
      }
      return $base;
    }
  }
