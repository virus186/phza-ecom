<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2022-12-16 18:01:51              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
/*
* Copyright (C) Incevio Systems, Inc - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
* Written by Munna Khan <help.Phza24@gmail.com>, September 2018
*/
 namespace App\Http\Controllers\Installer\Helpers; use Illuminate\Support\Facades\DB; trait MigrationsHelper { public function getMigrations() { $migrations = glob(database_path() . DIRECTORY_SEPARATOR . "\155\x69\147\x72\141\x74\x69\x6f\x6e\163" . DIRECTORY_SEPARATOR . "\x2a\x2e\160\150\x70"); return str_replace("\x2e\x70\150\160", '', $migrations); } public function getExecutedMigrations() { return DB::table("\x6d\x69\147\x72\141\164\x69\x6f\x6e\163")->get()->pluck("\155\151\147\162\141\x74\151\x6f\156"); } }
