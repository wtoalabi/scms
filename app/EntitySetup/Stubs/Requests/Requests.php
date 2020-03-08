<?php
    /**
     * Created by Alabi Olawale
     * Date: 6/1/2019
     */
    declare(strict_types=1);

    namespace App\EntitySetup\Stubs\Requests;


    use App\EntitySetup\ScaffoldCommand;
    use Illuminate\Support\Str;

    class Requests
    {

        public static function SetUp() {
            $data = session('data');
            static::moveBaseRequest($data);
            static::generateRequestStubs($data);
            $data['command']->info('Form Request files for ' . $data['name'] . ' have been created.');
        }


        private static function moveBaseRequest($data) {
            if (!$data['file']->exists("{$data['base']}/Base/BaseRequest")) {
                $data['file']->copy("App/EntitySetup/Stubs/Requests/DummyBaseRequest.stub",
                    "{$data['base']}/Base/BaseFormRequest.php");
            }
        }

        private static function generateRequestStubs($data) {
            $modelName = "{$data['pathName']}/{$data['pluralizedName']}/Requests";
            static::stub("$modelName", "Create", $data);
            static::stub("$modelName", "Update", $data);
        }

        private static function stub(string $destination, $action, $data) {

            $destinationFile = "$destination/$action{$data['name']}FormRequest.php";
            ScaffoldCommand::makeDirectory("$destination");
            $source = app_path('EntitySetUp/Stubs/Requests/DummyRequest.stub');
            $dummyContent = $data['file']->get($source);
            $requestContent = str_replace(['Dummy', 'Dummies', 'Action', 'Path'],
                [$data['name'], $data['pluralizedName'], $action, $data['namespace']], $dummyContent);
            $data['file']->put("$destinationFile", $requestContent);
        }


    }
