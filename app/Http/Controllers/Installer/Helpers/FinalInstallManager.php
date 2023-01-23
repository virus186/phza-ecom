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
 namespace App\Http\Controllers\Installer\Helpers; use Exception; use Illuminate\Support\Facades\Artisan; use Symfony\Component\Console\Output\BufferedOutput; class FinalInstallManager { public function runFinal() { $outputLog = new BufferedOutput(); $this->generateKey($outputLog); $this->publishVendorAssets($outputLog); return $outputLog->fetch(); } private static function generateKey($outputLog) { try { if (!config("\x69\156\x73\x74\141\154\154\x65\x72\56\x66\x69\x6e\141\154\x2e\x6b\x65\171")) { goto fr3O_; } Artisan::call("\x6b\145\171\x3a\147\145\x6e\145\162\x61\x74\145", ["\55\55\x66\157\162\143\145" => true], $outputLog); fr3O_: } catch (Exception $e) { return static::response($e->getMessage(), $outputLog); } return $outputLog; } private static function publishVendorAssets($outputLog) { try { if (!config("\x69\x6e\x73\164\x61\154\x6c\x65\162\56\x66\151\156\x61\154\56\160\x75\x62\x6c\x69\163\x68")) { goto wdGdx; } Artisan::call("\166\145\156\144\157\162\x3a\160\x75\x62\x6c\151\163\150", ["\x2d\55\141\154\154" => true], $outputLog); wdGdx: } catch (Exception $e) { return static::response($e->getMessage(), $outputLog); } return $outputLog; } private static function response($message, $outputLog) { return ["\163\164\x61\x74\165\x73" => "\145\x72\162\157\162", "\155\145\163\163\141\147\145" => $message, "\x64\x62\117\x75\x74\160\x75\164\x4c\x6f\147" => $outputLog->fetch()]; } }
