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
 namespace App\Http\Controllers\Installer; use App\Http\Controllers\Installer\Helpers\DatabaseManager; use App\Http\Controllers\Installer\Helpers\InstalledFileManager; use Illuminate\Routing\Controller; class UpdateController extends Controller { use \App\Http\Controllers\Installer\Helpers\MigrationsHelper; public function welcome() { return view("\151\x6e\163\x74\x61\154\154\145\162\x2e\165\x70\144\141\164\x65\56\167\x65\154\143\x6f\155\x65"); } public function overview() { $migrations = $this->getMigrations(); $dbMigrations = $this->getExecutedMigrations(); return view("\x69\156\x73\164\x61\x6c\x6c\145\x72\56\165\160\144\x61\164\x65\x2e\x6f\x76\x65\162\x76\151\145\167", ["\156\x75\x6d\x62\145\x72\117\146\125\x70\x64\x61\164\145\163\x50\x65\156\x64\x69\x6e\147" => count($migrations) - count($dbMigrations)]); } public function database() { $databaseManager = new DatabaseManager(); $response = $databaseManager->migrateAndSeed(); return redirect()->route("\114\x61\x72\141\166\x65\154\x55\160\144\x61\164\145\x72\x3a\x3a\x66\x69\x6e\x61\154")->with(["\x6d\x65\163\x73\141\x67\x65" => $response]); } public function finish(InstalledFileManager $fileManager) { $fileManager->update(); return view("\151\x6e\x73\x74\x61\154\x6c\145\x72\56\165\x70\144\141\x74\145\56\146\151\156\151\x73\x68\145\144"); } }
