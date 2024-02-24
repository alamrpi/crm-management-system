<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        try {
            $limit = $request->limit;
            $skip = $request->skip;
            $patientModel = new Patient();
            $data = $patientModel->getPatients($limit,$skip);
            $dataCount = $patientModel->getPatientCount();
            $response = array(
                'data' => $data,
                'count' => $dataCount
            );
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

    public function view($id)
    {
        try {
            $patient = (array) DB::table('patients')->find($id);
            $response = [
                'status' => 'success',
                'message' => '',
                'errors' => '',
                'data' => [
                    'patient' => $patient
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

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'mobile' => 'required'
        ]);
        if ($validator->fails())
        {
            $response = [
                'status' => 'fail',
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all(),
                'data' => ''
            ];
            return response($response, 422);
        }

        try {
            $mrn_no = Helper::generateMrn();
            $patient = Patient::create([
                'mrn' => $mrn_no,
                'name' => $request->name,
                'age' => $request->age,
                'gender' => $request->gender,
                'mobile' => $request->mobile,
                'drugHistory' => json_encode(explode('#', $request->drugHistory)),
                'diseaseHistory' => json_encode(explode('#', $request->diseaseHistory))
            ]);
            $response = [
                'status' => 'success',
                'message' => 'Patient saved successfully',
                'errors' => '',
                'data' => [
                    'patient' => $patient
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
