<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KKMVerifierService;

class KKMVerifierController extends Controller
{
    public function checkGovClinic(Request $request)
    {
        $clinicName = $request->input('clinic_name');

        $verifier = new KKMVerifierService();
        $isVerified = $verifier->isGovernmentClinicVerified($clinicName);

        return response()->json([
            'clinic' => $clinicName,
            'verified' => $isVerified
        ]);
    }
}



