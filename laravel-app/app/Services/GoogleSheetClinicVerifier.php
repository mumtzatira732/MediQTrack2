<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use League\Csv\Reader;
use Illuminate\Support\Facades\Log;

class GoogleSheetClinicVerifier
{
    public static function verify($clinicName)
    {
        $url = 'https://docs.google.com/spreadsheets/d/1juukIEirv0BytdVrQYpGfjdhr4rhJnEAho0KmbwKy8A/export?format=csv&gid=1762903856';

        $csvContent = Http::get($url)->body();

        $csv = Reader::createFromString($csvContent);
        $csv->setHeaderOffset(1); // row 1 is header

        foreach ($csv as $record) {
            if (strtolower(trim($record['NAMA_PENUH_FASILITI'])) === strtolower(trim($clinicName))) {
                return true;
            }
        }

        return false;

        Log::info('Checking clinic name:', [$record['NAMA_PENUH_FASILITI']]);


        Log::info("Checking clinic name: " . $clinicName);

    }
}
