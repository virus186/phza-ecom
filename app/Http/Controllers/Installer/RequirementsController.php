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
 namespace App\Http\Controllers\Installer; use App\Http\Controllers\Installer\Helpers\RequirementsChecker; use Illuminate\Routing\Controller; class RequirementsController extends Controller { protected $requirements; public function __construct(RequirementsChecker $checker) { $this->requirements = $checker; } public function requirements() { $phpSupportInfo = $this->requirements->checkPHPversion(config("\151\156\163\x74\x61\x6c\x6c\145\162\x2e\x63\157\162\x65\x2e\155\x69\x6e\120\x68\160\126\145\162\x73\151\157\x6e"), config("\151\x6e\x73\x74\x61\x6c\x6c\x65\162\x2e\143\157\162\145\56\155\141\170\x50\150\x70\x56\145\x72\x73\151\157\156")); $requirements = $this->requirements->check(config("\x69\156\x73\x74\x61\x6c\x6c\x65\x72\x2e\162\x65\161\x75\x69\x72\x65\x6d\145\x6e\164\x73")); return view("\x69\x6e\163\164\x61\x6c\x6c\145\162\56\x72\145\x71\165\x69\162\145\155\x65\156\x74\x73", compact("\x72\x65\161\x75\x69\162\x65\155\x65\x6e\x74\163", "\160\x68\160\123\165\x70\160\157\x72\164\x49\156\146\x6f")); } }
