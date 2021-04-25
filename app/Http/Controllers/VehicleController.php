<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class VehicleController extends Controller
{
    public $NUM_PAGE_LIMIT = 5;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vehicle::paginate($this->NUM_PAGE_LIMIT)->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'make'=>'required|max:50',
            'model'=>'required|max:50',
            'year'=>'required|numeric|between:0,32000',
            'color'=>'required|max:50',
            'price'=>'required|numeric|between:0,2000000000',
            'mileage'=>'required|numeric|between:0,2000000000',
            'options'=>'nullable|json',
        ]);

        if($validator->fails()){
            return response()->json(["validation failed" => $validator->errors()], $status = Response::HTTP_BAD_REQUEST);
        }

        $vehicle = new Vehicle();
        $vehicle->make = $request->input('make');
        $vehicle->model = $request->input('model');
        $vehicle->year = $request->input('year');
        $vehicle->color = $request->input('color');
        $vehicle->price = $request->input('price');
        $vehicle->mileage = $request->input('mileage');
        $vehicle->options = $request->input('options');
        $vehicle->save();

        // return response($status = Response::$statusTexts[Response::HTTP_CREATED]);
        return response()->json($status = Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Vehicle::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function searchMake($make){
        return Vehicle::where('make', 'LIKE', "%$make%")->paginate($this->NUM_PAGE_LIMIT)->toJson();
    }
}
