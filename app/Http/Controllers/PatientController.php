<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PatientParams;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function index(){
        return Inertia::render('Patient/Create', []);
    }

    public function testParams()
    {
        return Inertia::render('Patient/TestParams', []);
    }

    public function testInstruction()
    {
        return Inertia::render('Patient/TestInstruction', []);
    }

    public function testing($patient_id)
    {
        $patient = Patient::query()->with('params')->find($patient_id);

        return Inertia::render('Patient/Testing', ['params' => $patient->params]);
    }
    public function testing_second($patient_id)
    {
        $patient = Patient::query()->with('params')->find($patient_id);
        return Inertia::render('Patient/TestingSecond',  ['params' => $patient->params]);
    }

    public function storeParams(Request $request)
    {
        $patient = Patient::query()->find($request->get('patient_id', Patient::query()->latest()->first()->id));
        $data = [
            'duration' => $request->get('duration'),
            'sectors' => $request->get('sectors'),
            'size' => $request->get('size'),
            'dot_size' => $request->get('dot_size'),
            'patient_id' => $patient->id,
        ];

        PatientParams::query()->create($data);
        $patient_id = $patient->id;
        return redirect()->route('patient.testInstruction', compact('patient_id'));
    }

    public function store(Request $request){
        $data = [
            'notes' => $request->get('notes'),
            'name' => $request->get('name'),
            'gender' => $request->get('gender'),
            'birthday' => $request->get('birthday'),
        ];

        $patient = Patient::query()->create($data);

        return redirect()->route('patient.testParams', compact('patient'));
    }

}
