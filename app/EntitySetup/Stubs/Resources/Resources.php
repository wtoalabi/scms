<?php
    /**
     * Created by Alabi Olawale
     * Date: 6/4/2019
     */
    declare(strict_types=1);

    namespace App\EntitySetup\Stubs\Resources;


    use App\EntitySetup\ScaffoldCommand;
    use Illuminate\Support\Str;

    class Resources
    {
        public static function SetUp() {
            $data = session('data');
            $path = "{$data['pathName']}/{$data['pluralizedName']}/Resources";
            ScaffoldCommand::makeDirectory($path);
            $dummyCollection = $data['file']->get("App/EntitySetup/Stubs/Resources/DummyCollection.stub");
            $dummyResource = $data['file']->get("App/EntitySetup/Stubs/Resources/DummyResource.stub");
            static::CreateResource($data,$dummyCollection, "{$data['name']}Collection");
            static::CreateResource($data, $dummyResource,"{$data['name']}Resource");
            session('data')['command']->info('Resources created Successfully!');
        }

        private static function CreateResource($data, $content, $name = "") {
            $path = "{$data['pathName']}/{$data['pluralizedName']}/Resources";
            $namespace = "{$data['namespace']}\\{$data['pluralizedName']}\Resources";
            $resourceContent = str_replace(['Namespace', 'Dummies', 'Dummy', 'dummy'],
                ["$namespace;", $data['pluralizedName'], $data['name'], Str::lower($data['name'])], $content);
            $data['file']->put("$path/$name.php", $resourceContent);
        }

    }
