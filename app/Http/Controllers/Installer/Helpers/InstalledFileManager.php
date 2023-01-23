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
 namespace App\Http\Controllers\Installer\Helpers; class InstalledFileManager { public function create() { $installedLogFile = storage_path("\151\x6e\x73\x74\141\x6c\x6c\x65\x64"); $dateStamp = date("\131\x2f\x6d\x2f\x64\40\150\x3a\x69\72\163\141"); if (!file_exists($installedLogFile)) { goto pTVsX; } $message = trans("\x69\x6e\163\164\141\x6c\x6c\x65\162\x5f\x6d\145\x73\163\x61\x67\x65\163\x2e\x75\x70\144\141\x74\x65\162\x2e\154\157\x67\56\163\165\x63\x63\145\163\x73\137\x6d\145\x73\163\x61\147\145") . $dateStamp; file_put_contents($installedLogFile, $message . PHP_EOL, FILE_APPEND | LOCK_EX); goto UXco0; pTVsX: $message = trans("\x69\156\x73\x74\141\x6c\154\x65\162\x5f\155\145\163\163\141\147\145\163\56\151\156\x73\164\x61\154\154\x65\144\56\x73\165\143\x63\x65\x73\163\137\154\157\x67\137\x6d\145\x73\163\141\147\x65") . $dateStamp . "\xa"; file_put_contents($installedLogFile, $message); UXco0: return $message; } public function update() { return $this->create(); } }
