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
 namespace App\Http\Controllers\Installer\Helpers; use Exception; use Illuminate\Http\Request; class EnvironmentManager { private $envPath; private $envExamplePath; public function __construct() { $this->envPath = base_path("\x2e\x65\156\x76"); $this->envExamplePath = base_path("\x2e\x65\x6e\166\x2e\x65\x78\x61\x6d\x70\x6c\145"); } public function getEnvContent() { if (file_exists($this->envPath)) { goto rinT2; } if (file_exists($this->envExamplePath)) { goto uaVYR; } touch($this->envPath); goto p3K5s; uaVYR: copy($this->envExamplePath, $this->envPath); p3K5s: rinT2: return file_get_contents($this->envPath); } public function getEnvPath() { return $this->envPath; } public function getEnvExamplePath() { return $this->envExamplePath; } public function saveFileClassic(Request $input) { $message = trans("\151\156\x73\164\141\x6c\154\145\162\x5f\155\x65\x73\x73\141\147\145\163\x2e\145\156\x76\x69\162\x6f\156\x6d\x65\x6e\x74\x2e\x73\x75\143\x63\145\163\163"); try { file_put_contents($this->envPath, $input->get("\x65\156\x76\x43\157\156\146\x69\x67")); } catch (Exception $e) { $message = trans("\x69\156\163\x74\141\x6c\x6c\x65\x72\x5f\155\145\163\163\x61\x67\x65\163\56\x65\156\x76\151\x72\157\156\155\x65\156\164\56\x65\162\162\157\x72\163"); } return $message; } }
