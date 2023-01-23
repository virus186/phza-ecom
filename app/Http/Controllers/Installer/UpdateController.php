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
 namespace App\Http\Controllers\Installer; use App\Http\Controllers\Installer\Helpers\DatabaseManager; use App\Http\Controllers\Installer\Helpers\InstalledFileManager; use Illuminate\Routing\Controller; class UpdateController extends Controller { use \App\Http\Controllers\Installer\Helpers\MigrationsHelper; public function welcome() { return view("\151\x6e\x73\164\141\154\154\145\x72\x2e\x75\x70\x64\x61\164\x65\56\x77\x65\154\143\157\x6d\x65"); } public function overview() { $migrations = $this->getMigrations(); $dbMigrations = $this->getExecutedMigrations(); return view("\x69\156\163\x74\141\x6c\154\x65\162\56\165\160\144\141\x74\145\56\x6f\166\145\x72\x76\151\x65\x77", ["\156\x75\x6d\x62\x65\x72\117\x66\x55\x70\144\x61\x74\145\163\x50\145\156\x64\151\x6e\147" => count($migrations) - count($dbMigrations)]); } public function database() { $databaseManager = new DatabaseManager(); $response = $databaseManager->migrateAndSeed(); return redirect()->route("\x4c\141\162\141\166\145\154\x55\x70\x64\141\x74\x65\x72\x3a\x3a\146\151\156\141\x6c")->with(["\155\145\163\x73\141\x67\x65" => $response]); } public function finish(InstalledFileManager $fileManager) { $fileManager->update(); return view("\x69\156\163\x74\141\154\154\x65\x72\56\165\x70\x64\x61\164\x65\x2e\146\151\x6e\151\163\x68\x65\x64"); } }
