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
 namespace App\Http\Controllers\Installer\Helpers; use Exception; use Illuminate\Support\Facades\Artisan; use Symfony\Component\Console\Output\BufferedOutput; class FinalInstallManager { public function runFinal() { $outputLog = new BufferedOutput(); $this->generateKey($outputLog); $this->publishVendorAssets($outputLog); return $outputLog->fetch(); } private static function generateKey($outputLog) { try { if (!config("\151\x6e\x73\x74\x61\154\154\x65\162\x2e\146\151\x6e\141\x6c\56\153\145\171")) { goto oseO7; } Artisan::call("\153\x65\x79\72\x67\145\x6e\145\x72\x61\164\x65", ["\x2d\55\x66\x6f\x72\x63\x65" => true], $outputLog); oseO7: } catch (Exception $e) { return static::response($e->getMessage(), $outputLog); } return $outputLog; } private static function publishVendorAssets($outputLog) { try { if (!config("\151\156\163\164\141\154\x6c\145\162\56\x66\151\x6e\141\154\x2e\160\x75\142\154\x69\x73\150")) { goto MH21e; } Artisan::call("\166\145\156\144\x6f\162\72\160\165\142\x6c\x69\x73\150", ["\x2d\x2d\141\x6c\154" => true], $outputLog); MH21e: } catch (Exception $e) { return static::response($e->getMessage(), $outputLog); } return $outputLog; } private static function response($message, $outputLog) { return ["\163\164\141\x74\165\163" => "\x65\162\x72\x6f\162", "\155\x65\x73\163\x61\x67\x65" => $message, "\x64\142\x4f\165\164\160\165\164\x4c\x6f\147" => $outputLog->fetch()]; } }
