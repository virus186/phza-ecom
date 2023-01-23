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
 namespace App\Http\Controllers\Installer\Helpers; class PermissionsChecker { protected $results = []; public function __construct() { $this->results["\x70\145\162\155\x69\163\x73\x69\157\x6e\x73"] = []; $this->results["\x65\x72\162\157\162\x73"] = null; } public function check(array $folders) { foreach ($folders as $folder => $permission) { if (!($this->getPermission($folder) >= $permission)) { goto RCOtW; } $this->addFile($folder, $permission, true); goto HdCvH; RCOtW: $this->addFileAndSetErrors($folder, $permission, false); HdCvH: HMdaV: } X79Oo: return $this->results; } private function getPermission($folder) { return substr(sprintf("\45\x6f", fileperms(base_path($folder))), -4); } private function addFile($folder, $permission, $isSet) { array_push($this->results["\x70\145\162\x6d\151\x73\x73\x69\157\156\x73"], ["\x66\x6f\x6c\144\145\x72" => $folder, "\x70\145\162\x6d\x69\163\x73\x69\x6f\156" => $permission, "\151\x73\123\145\x74" => $isSet]); } private function addFileAndSetErrors($folder, $permission, $isSet) { $this->addFile($folder, $permission, $isSet); $this->results["\x65\x72\162\x6f\x72\163"] = true; } }
