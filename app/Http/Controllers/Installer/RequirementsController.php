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
 namespace App\Http\Controllers\Installer; use App\Http\Controllers\Installer\Helpers\RequirementsChecker; use Illuminate\Routing\Controller; class RequirementsController extends Controller { protected $requirements; public function __construct(RequirementsChecker $checker) { $this->requirements = $checker; } public function requirements() { $phpSupportInfo = $this->requirements->checkPHPversion(config("\151\x6e\x73\x74\141\154\x6c\x65\x72\56\x63\157\x72\x65\x2e\x6d\151\x6e\x50\150\x70\126\145\x72\163\x69\x6f\x6e"), config("\151\x6e\x73\x74\141\154\154\x65\162\x2e\x63\x6f\162\x65\56\x6d\x61\x78\120\x68\x70\126\x65\162\163\151\157\156")); $requirements = $this->requirements->check(config("\x69\156\x73\164\141\154\154\x65\162\56\162\145\161\x75\151\x72\145\x6d\x65\x6e\164\163")); return view("\151\156\x73\164\141\154\154\x65\162\56\162\145\161\165\151\162\x65\x6d\145\x6e\x74\163", compact("\x72\x65\x71\165\151\162\145\155\145\x6e\164\163", "\x70\x68\x70\x53\165\160\x70\x6f\162\x74\111\156\x66\157")); } }
