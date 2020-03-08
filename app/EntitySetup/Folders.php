<?php
    /**
     * Created by Alabi Olawale
     * Date: 6/1/2019
     */
    declare(strict_types=1);

    namespace App\EntitySetup;


    class Folders
    {
        public static function SetUp() {
            $data = session('data');
            ScaffoldCommand::makeDirectory("{$data['pathName']}//{$data['pluralizedName']}");
            ScaffoldCommand::makeDirectory("{$data['pathName']}//{$data['pluralizedName']}/Requests");
            ScaffoldCommand::makeDirectory("{$data['pathName']}//{$data['pluralizedName']}/Policies");
            //ScaffoldCommand::makeDirectory("{$data['pathName']}//{$data['pluralizedName']}/Rules");
            //ScaffoldCommand::makeDirectory("{$data['pathName']}//{$data['pluralizedName']}/Repositories");
            ScaffoldCommand::makeDirectory("{$data['pathName']}//{$data['pluralizedName']}/Resources");
            ScaffoldCommand::makeDirectory("{$data['pathName']}//{$data['pluralizedName']}/Exceptions");
            //ScaffoldCommand::makeDirectory("{$data['pathName']}/{$data['pluralizedName']}/Repositories/Interfaces");
            static::createBaseFolders($data);
            $data['command']->info('Folder structure for ' . $data['pluralizedName'] . ' created.');
            return;
        }

        private static function createBaseFolders($data) {
            if(!$data['file']->exists("{$data['base']}/Base")){
                ScaffoldCommand::makeDirectory("{$data['base']}/Base");
            }
        }
    }
