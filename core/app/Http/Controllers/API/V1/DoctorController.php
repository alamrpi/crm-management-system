<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function profile($id)
    {
        try {
            $doctor = (array) DB::table('users')
                        ->join('doctor_details', 'users.id', '=', 'doctor_details.dr_id')
                        ->where('users.id', $id)
                        ->select('users.id','users.name','users.email','doctor_details.regi_no','doctor_details.specialist','doctor_details.designation','doctor_details.medical_id')->first();
            $response = [
                'status' => 'success',
                'message' => '',
                'errors' => '',
                'data' => [
                    'doctor' => $doctor
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
