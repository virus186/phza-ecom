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
 namespace App\Http\Controllers\Installer; use App\Http\Controllers\Installer\Helpers\DatabaseManager; use App\Http\Controllers\Installer\Helpers\EnvironmentManager; use App\Http\Controllers\Installer\Helpers\FinalInstallManager; use App\Http\Controllers\Installer\Helpers\InstalledFileManager; use Illuminate\Routing\Controller; class FinalController extends Controller { public function final(FinalInstallManager $finalInstall, EnvironmentManager $environment) { $finalMessages = $finalInstall->runFinal(); $finalEnvFile = $environment->getEnvContent(); return view("\151\x6e\x73\164\141\154\x6c\x65\x72\56\x66\x69\156\151\163\150\x65\144", compact("\146\x69\156\x61\x6c\x4d\x65\x73\163\x61\x67\x65\x73", "\x66\151\156\x61\154\105\156\166\x46\151\154\145")); } public function seedDemo(DatabaseManager $databaseManager) { $response = $databaseManager->seedDemoData(); return redirect()->route("\111\156\x73\x74\141\x6c\x6c\145\x72\56\x66\151\x6e\151\x73\150"); } public function finish(InstalledFileManager $fileManager) { $finalStatusMessage = $fileManager->update(); return redirect()->to(config("\151\x6e\x73\164\141\154\154\x65\162\x2e\162\145\x64\x69\162\145\x63\x74\125\x72\x6c"))->with("\x6d\145\163\x73\141\x67\x65", $finalStatusMessage); } }
