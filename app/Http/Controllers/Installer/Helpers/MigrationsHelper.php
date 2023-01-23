<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2022-08-31 19:46:01              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
/*
* Copyright (C) Incevio Systems, Inc - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
* Written by Munna Khan <help.Phza24@gmail.com>, September 2018
*/
 namespace App\Http\Controllers\Installer\Helpers; use Illuminate\Support\Facades\DB; trait MigrationsHelper { public function getMigrations() { $migrations = glob(database_path() . DIRECTORY_SEPARATOR . "\155\151\147\162\x61\164\151\157\156\x73" . DIRECTORY_SEPARATOR . "\x2a\56\160\x68\x70"); return str_replace("\56\x70\150\160", '', $migrations); } public function getExecutedMigrations() { return DB::table("\155\x69\147\162\x61\164\151\x6f\156\x73")->get()->pluck("\155\151\147\162\x61\x74\x69\x6f\156"); } }
