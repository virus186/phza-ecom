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
 namespace App\Http\Controllers\Installer; use App\Http\Controllers\Installer\Helpers\PermissionsChecker; use App\Http\Requests; use Illuminate\Routing\Controller; class PermissionsController extends Controller { protected $permissions; public function __construct(PermissionsChecker $checker) { $this->permissions = $checker; } public function permissions() { $permissions = $this->permissions->check(config("\x69\x6e\x73\164\141\154\154\x65\162\x2e\160\x65\x72\x6d\x69\x73\163\x69\157\x6e\x73")); return view("\x69\156\163\x74\x61\x6c\154\x65\x72\x2e\160\145\x72\155\x69\163\x73\151\157\156\163", compact("\160\x65\x72\155\151\x73\163\x69\157\x6e\163")); } }
