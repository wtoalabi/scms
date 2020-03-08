<?php
    /**
     * Created by Alabi Olawale
     * Date: 6/1/2019
     */
    declare(strict_types=1);

    namespace App\EntitySetup\Stubs\Policies;


    use App\EntitySetup\ScaffoldCommand;
    use App\EntitySetup\Stubs\FileEditor;
    use Illuminate\Support\Str;

    class Policies
    {

        public static function SetUp() {
            $data = session('data');
            static::moveBasePolicy($data);
            static::generatePolicyStubs($data);
        }

        private static function moveBasePolicy($data) {
            if(!$data['file']->exists("{$data['base']}//Base/BasePolicy.php")) {
                $source = "App/EntitySetup/Stubs/Policies/DummyBasePolicy.stub";
                $dummyContent = $data['file']->get($source);
                $basePolicy = str_replace(['Path'],
                    [$data['base']], $dummyContent
                );
                $data['file']->put("{$data['base']}/Base/BasePolicy.php", $basePolicy);
            }
        }

        private static function generatePolicyStubs($data) {
            $modelName = "{$data['pathName']}/{$data['pluralizedName']}/Policies";
            static::stub("$modelName", $data);
            $data['command']->info('Policy file for ' . $data['name']. ' has been created.');
        }

        private static function stub(string $destination, $data) {
            $dummyModel = '';
            $destinationFile = "$destination//{$data['name']}Policy";
            $source = app_path('EntitySetUp/Stubs/Policies/DummyPolicy.stub');
            $dummyContent = $data['file']->get($source);
            $policyContent = str_replace(['Dummy', 'Dummies', 'DUMMY','Path','Main', 'dummy', 'DummyModel'],
                [$data['name'], $data['pluralizedName'], Str::upper($data['name']), $data['namespace'],$data['namespace'], Str::lower($data['name']),$dummyModel], $dummyContent
            );
            ScaffoldCommand::makeDirectory("$destination");
            $data['file']->put("$destinationFile.php", $policyContent);
            static::RegisterPolicies($destinationFile, $data);

        }

        private static function RegisterPolicies($destinationFile, $data) {
            $path = app_path('Providers/AuthServiceProvider.php');
            FileEditor::Write(policiesArrayLine(), newPolicyItem($data), $path);
            FileEditor::Write(policiesImportLocation(), policyImportStatements($data, $destinationFile), $path);
        }
    }

    function policiesArrayLine(){
        return 'protected $policies = [';
    }
    function newPolicyItem($data){
        return "        {$data['name']}::class => {$data['name']}Policy::class,";
    }
    function policiesImportLocation(){
        return 'use Illuminate\Support\Facades\Gate;';
    }
    function policyImportStatements($data, $destinationFile){
        $policyLocation = "use $destinationFile";
        return "$policyLocation;\nuse {$data['namespace']}\\{$data['pluralizedName']}\\{$data['name']};";
    }
