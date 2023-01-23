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
 namespace App\Http\Controllers\Installer\Helpers; class PermissionsChecker { protected $results = []; public function __construct() { $this->results["\160\145\x72\155\x69\x73\163\151\x6f\156\163"] = []; $this->results["\x65\162\x72\x6f\162\163"] = null; } public function check(array $folders) { foreach ($folders as $folder => $permission) { if (!($this->getPermission($folder) >= $permission)) { goto s22mH; } $this->addFile($folder, $permission, true); goto ggxTC; s22mH: $this->addFileAndSetErrors($folder, $permission, false); ggxTC: h00yR: } p87NE: return $this->results; } private function getPermission($folder) { return substr(sprintf("\45\x6f", fileperms(base_path($folder))), -4); } private function addFile($folder, $permission, $isSet) { array_push($this->results["\160\145\x72\155\151\163\x73\x69\157\x6e\x73"], ["\x66\x6f\154\144\145\x72" => $folder, "\160\x65\x72\x6d\151\x73\x73\x69\x6f\156" => $permission, "\151\163\123\145\x74" => $isSet]); } private function addFileAndSetErrors($folder, $permission, $isSet) { $this->addFile($folder, $permission, $isSet); $this->results["\x65\162\162\x6f\x72\x73"] = true; } }
