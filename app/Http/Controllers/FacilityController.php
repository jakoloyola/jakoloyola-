<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\Facility;

class FacilityController extends Controller
{
    

    public function index()
    {        
        $facilities = Facility::paginate(10);
        
        return response()->json($facilities);
    }

    public function store(Request $request)
    {        
        $validator = Validator::make($request->all(), 
            [
                'name' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip' => 'required',
                'contact' => 'required',
            ]
        );

        if ($validator->fails()) {
           return response()->json($validator->errors(), 422);
        }

        if(Facility::create($request->all())){
            return response()->json('success');
        }

    }

    public function update(Request $request, Facility $facilityId)
    {
        $validator = Validator::make($request->all(), 
            [
                'name' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip' => 'required',
                'contact' => 'required',
            ]
        );

        if ($validator->fails()) {
           return response()->json($validator->errors(), 422);
        }

        $facility = Facility::find($facilityId)->first();

        if($facility->update($request->all())){
            return response()->json('success');
        }
    }
    
    public function show(Request $request, Facility $facilityId)
    {        
        $facility = Facility::find($facilityId)->first();
        
        return response()->json($facility);
    }
    
    public function destroy(Facility $facilityId)
    {
        $facility = Facility::find($facilityId)->first();
        if($facility->delete()){            
            return response()->json('success');
        }
    }
}
