<?php

 namespace App\Http\Controllers\Installer\Helpers; class InstalledFileManager { public function create() { $installedLogFile = storage_path("\151\x6e\x73\164\x61\154\154\x65\144"); $dateStamp = date("\x59\x2f\x6d\57\x64\x20\150\72\151\72\163\141"); if (!file_exists($installedLogFile)) { goto c6cwF; } $message = trans("\151\x6e\163\x74\141\x6c\154\x65\x72\137\x6d\x65\163\x73\x61\x67\145\163\x2e\x75\160\144\141\x74\145\162\56\154\157\x67\56\163\165\143\x63\145\x73\163\137\x6d\x65\x73\x73\x61\x67\x65") . $dateStamp; file_put_contents($installedLogFile, $message . PHP_EOL, FILE_APPEND | LOCK_EX); goto k0sMA; c6cwF: $message = trans("\x69\156\163\x74\x61\154\154\145\162\137\155\145\x73\163\x61\147\x65\163\x2e\x69\x6e\163\164\x61\x6c\x6c\145\144\x2e\163\165\143\x63\145\x73\x73\x5f\x6c\x6f\147\x5f\155\145\x73\163\x61\147\x65") . $dateStamp . "\xa"; file_put_contents($installedLogFile, $message); k0sMA: return $message; } public function update() { return $this->create(); } }
