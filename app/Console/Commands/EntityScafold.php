<?php

  namespace App\Console\Commands;

  use Illuminate\Console\Command;
  use App\EntitySetup\ScaffoldCommand;
  use Illuminate\Filesystem\Filesystem;
  use Illuminate\Support\Str;

  class EntityScafold extends Command
  {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entity:scaffold {name}
    {--p|path= : (Optional) Give a preferred path within the Shop namespace. EG `Account`. This will produce `Shop\Account`}
    {--m|model= : (Optional) Specify the model to use}'
    ;
    protected $name = "Entity Scaffold";
    protected $entityName;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Quickly whip up all the mundane files needed by an entity';
    /**
     * @var Filesystem
     */
    private $file;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ScaffoldCommand $command, Filesystem $file)
    {
      parent::__construct();
      $this->command = $command;
      $this->file = $file;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $name = ucfirst($this->argument('name'));
      $options = $this->options();
      $this->putInSession($name, $options);
      $this->command->setUp();
    }

    private function putInSession($incomingName, $options) {
      $name = $this->normalize(Str::singular($incomingName));
      $path = $this->normalize($options['path']);
      $model = $this->normalize($options['model']);
      $basePath = config('session.entity_base_path');
      session()->put('data',[
        'command' => $this,
        'name' => $name,
        'base' => config('session.entity_base_path'),
        'pluralizedName' => Str::plural($name),
        'model' =>  $this->generateModel($name, $model),
        'pathName' => $this->setPath($path, $basePath),
        'givenPath' => $path,
        'namespace' => $this->generateNamespace($path, $basePath),
        'file' => $this->file,
      ]);
    }

    private function setPath($customPath, $basePath) {
      if($customPath){
        $this->preferredPath = $customPath;
        return $basePath = "$basePath\\$customPath";
      }
      return $basePath;
    }
      private function generateNamespace($path, $basePath){
          $namespace = str_replace('/', "\\", $basePath);
          if($path){
              $namespace .= "\\{$path}";
          }
          return $namespace;
      }
    private function generateModel($name,$model) {
      $modelName = $name;
      if($model){
        $modelName = $model;
      }
      return Str::studly($modelName);
    }
    private function normalize($input) {
      return preg_replace("/[^a-zA-Z]+/", "", $input);
    }
  }
