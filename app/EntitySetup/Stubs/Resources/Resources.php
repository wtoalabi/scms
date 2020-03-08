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
            static::CreateResource($path,$data,$dummyCollection, "{$data['name']}Collection");
            static::CreateResource($path,$data, $dummyResource,"{$data['name']}Resource");
            session('data')['command']->info('Resources created Successfully!');
        }

        private static function CreateResource($path,$data, $content, $name = "") {
            $resourceContent = str_replace(['Namespace', 'Dummies', 'Dummy', 'dummy'],
                ["$path;", $data['pluralizedName'], $data['name'], Str::lower($data['name'])], $content);
            $data['file']->put("$path/$name.php", $resourceContent);
        }

    }
