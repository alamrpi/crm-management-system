<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrescriptionController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'cc' => 'required',
        ]);
        if ($validator->fails())
        {
            $response = [
                'status' => 'fail',
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all(),
                'data' => ''
            ];
            return response($response, 400);
        }

        try {
            $last_pres = Prescription::orderBy('id', 'desc')->first();
            if(!empty($last_pres)){
                $trn_sl = (int)$last_pres->trn;
                if($trn_sl/100 >= 1)
                {
                    $next_trn = $trn_sl + 1;
                }
                else if($trn_sl / 10 >= 1)
                {
                    $next_trn = '0' . ($trn_sl + 1);
                }
                else
                {
                    $next_trn = '00'. ($trn_sl + 1);
                }
            }
            else {
                $next_trn = '001';
            }
            $prescription = Prescription::create([
                'patient_id' => $request->id,
                'trn' => $next_trn,
                'pdate' => date('Y-m-d'),
                'cc' => $request->cc,
                'inv' => json_encode($request->investigations),
                'rx' => 'Medicine',
            ]);
            $response = [
                'status' => 'success',
                'message' => 'Prescription created successfully',
                'errors' => '',
                'data' => [
                    'prescription' => $prescription
                ]
            ];
            return response($response, 200);
        }
        catch (\Exception $ex) {
            $response = [
                'status' => 'fail',
                'message' => 'Exception',
                'errors' => $ex->getMessage(),
                'data' => ''
            ];
            return response($response, 500);
        }
    }
}
