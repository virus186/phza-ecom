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
 namespace App\Http\Controllers\Installer; use App\Http\Controllers\Installer\Helpers\EnvironmentManager; use Illuminate\Http\Request; use Illuminate\Routing\Controller; use Illuminate\Routing\Redirector; use Validator; class EnvironmentController extends Controller { protected $EnvironmentManager; public function __construct(EnvironmentManager $environmentManager) { $this->EnvironmentManager = $environmentManager; } public function environmentMenu() { return view("\151\x6e\163\164\x61\x6c\154\145\162\56\x65\156\166\x69\x72\x6f\x6e\155\x65\156\x74"); } public function environmentWizard() { } public function environmentClassic() { $envConfig = $this->EnvironmentManager->getEnvContent(); return view("\151\x6e\163\x74\141\154\x6c\x65\x72\x2e\145\156\166\151\162\157\x6e\155\x65\x6e\164\x2d\x63\154\141\163\163\x69\x63", compact("\145\x6e\x76\x43\x6f\156\146\x69\147")); } public function saveClassic(Request $input, Redirector $redirect) { $message = $this->EnvironmentManager->saveFileClassic($input); return $redirect->route("\x49\x6e\x73\164\141\154\x6c\x65\162\56\x65\156\166\151\162\157\156\155\145\156\164\103\x6c\x61\163\163\151\x63")->with(["\155\x65\163\163\x61\147\x65" => $message]); } }
