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
 namespace App\Http\Controllers\Installer\Helpers; use Exception; use Illuminate\Http\Request; class EnvironmentManager { private $envPath; private $envExamplePath; public function __construct() { $this->envPath = base_path("\56\145\156\166"); $this->envExamplePath = base_path("\56\145\x6e\166\56\145\x78\141\x6d\x70\x6c\x65"); } public function getEnvContent() { if (file_exists($this->envPath)) { goto eEp7Z; } if (file_exists($this->envExamplePath)) { goto r_A5i; } touch($this->envPath); goto NYmMQ; r_A5i: copy($this->envExamplePath, $this->envPath); NYmMQ: eEp7Z: return file_get_contents($this->envPath); } public function getEnvPath() { return $this->envPath; } public function getEnvExamplePath() { return $this->envExamplePath; } public function saveFileClassic(Request $input) { $message = trans("\151\x6e\163\x74\141\154\x6c\145\162\137\155\x65\x73\x73\x61\x67\145\x73\x2e\145\156\166\x69\x72\x6f\x6e\x6d\x65\x6e\164\x2e\x73\x75\143\x63\x65\x73\163"); try { file_put_contents($this->envPath, $input->get("\x65\156\x76\x43\x6f\x6e\146\x69\x67")); } catch (Exception $e) { $message = trans("\x69\x6e\x73\164\x61\154\154\145\162\x5f\155\x65\x73\163\x61\147\145\163\56\x65\156\166\x69\162\157\156\155\145\x6e\x74\56\145\162\162\157\x72\x73"); } return $message; } }
