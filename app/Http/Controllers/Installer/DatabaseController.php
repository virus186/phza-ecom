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
 namespace App\Http\Controllers\Installer; use App\Http\Controllers\Installer\Helpers\DatabaseManager; use Exception; use Illuminate\Routing\Controller; use Illuminate\Support\Facades\DB; class DatabaseController extends Controller { private $databaseManager; public function __construct(DatabaseManager $databaseManager) { $this->databaseManager = $databaseManager; } public function database() { if ($this->checkDatabaseConnection()) { goto ppoGa; } return redirect()->back()->withErrors(["\144\141\164\141\142\141\163\145\137\143\x6f\x6e\156\x65\x63\x74\x69\157\156" => trans("\x69\x6e\163\x74\x61\x6c\x6c\145\x72\137\x6d\x65\x73\163\141\147\145\163\x2e\145\156\166\151\x72\157\x6e\155\145\156\164\x2e\167\x69\172\x61\162\x64\x2e\146\x6f\x72\x6d\56\x64\142\137\143\157\156\156\145\143\x74\151\157\x6e\137\x66\141\151\x6c\x65\x64")]); ppoGa: ini_set("\155\x61\x78\x5f\145\x78\x65\143\x75\x74\x69\x6f\x6e\137\x74\x69\155\145", 600); $response = $this->databaseManager->migrateAndSeed(); return redirect()->route("\x49\156\163\x74\141\154\x6c\145\162\56\146\x69\156\x61\x6c")->with(["\155\x65\x73\163\x61\x67\x65" => $response]); } private function checkDatabaseConnection() { try { DB::connection()->getPdo(); return true; } catch (Exception $e) { return false; } } }
