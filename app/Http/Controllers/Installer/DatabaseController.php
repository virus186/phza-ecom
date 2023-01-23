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
 namespace App\Http\Controllers\Installer; use App\Http\Controllers\Installer\Helpers\DatabaseManager; use Exception; use Illuminate\Routing\Controller; use Illuminate\Support\Facades\DB; class DatabaseController extends Controller { private $databaseManager; public function __construct(DatabaseManager $databaseManager) { $this->databaseManager = $databaseManager; } public function database() { if ($this->checkDatabaseConnection()) { goto tfbad; } return redirect()->back()->withErrors(["\x64\141\x74\x61\x62\141\x73\x65\137\143\x6f\156\x6e\x65\143\x74\x69\x6f\156" => trans("\151\x6e\163\164\141\x6c\154\145\162\137\x6d\145\x73\x73\x61\147\145\163\x2e\145\156\166\x69\x72\157\156\x6d\145\156\x74\56\x77\151\x7a\141\162\144\x2e\146\157\x72\155\56\144\142\137\x63\157\156\x6e\x65\x63\164\x69\157\x6e\137\x66\141\151\x6c\145\144")]); tfbad: ini_set("\x6d\x61\170\x5f\145\x78\x65\x63\x75\164\x69\x6f\156\x5f\x74\x69\155\145", 600); $response = $this->databaseManager->migrateAndSeed(); return redirect()->route("\111\x6e\163\x74\141\154\x6c\145\x72\56\x66\151\x6e\x61\x6c")->with(["\155\145\163\x73\x61\147\x65" => $response]); } private function checkDatabaseConnection() { try { DB::connection()->getPdo(); return true; } catch (Exception $e) { return false; } } }
