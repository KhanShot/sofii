<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Results;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ResultController extends Controller
{
    public function index($patient_id){
        $result['right'] = Results::query()->where('patient_id', $patient_id)
            ->where('eye', 'right')->latest()->first();

        $result['left'] = Results::query()->where('patient_id', $patient_id)
            ->where('eye', 'left')->latest()->first();


        $result = collect($result)->transform(function ($item) use ($patient_id){
            return [
                'eye' => $item->eye ?? '',
                'patient_id' => $item->patient_id,
                'id' => $item->id,
                'all_dots' => unserialize($item->all_dots),
                'pressed_dots' => unserialize($item->pressed_dots),
                'unpressed_dots' => unserialize($item->unpressed_dots),
            ];
        });
        $patient = Patient::query()->find($patient_id);
        return Inertia::render('Patient/Result', ['result' => $result, 'patient' => $patient]);
    }
    public function submit(Request $request)
    {
        $all_dots = [];
        $pressed_dots = [];
        foreach ($request->get('all_dots') as $dot){
            if (!is_null($dot))
                $all_dots[] = $dot;
        }
        foreach ($request->get('pressed_dots') as $dot){
            if (!is_null($dot))
                $pressed_dots[] = $dot;
        }
        $unpressed_dots = $this->array_diff_recursive($all_dots, $pressed_dots);

        $data = [
            'patient_id' => $request->get('patient_id'),
            'eye' => $request->get('eye'),
            'all_dots' => serialize($all_dots),
            'pressed_dots' => serialize($pressed_dots),
            'unpressed_dots' => serialize($unpressed_dots),
        ];
        Results::query()->create($data);
    }


    private function array_diff_recursive($array1, $array2)
    {
        $difference = [];

        foreach ($array1 as $key => $value) {
            $found = false;
            foreach ($array2 as $subArray) {
                if ($value == $subArray) {
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $difference[$key] = $value;
            }
        }
        return $difference;
    }
}
