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
        $vehicleQuery = Vehicle::where('id', $id);
        if($vehicleQuery->doesntExist()){
            return response()->json(["error" => "vehicle with id $id not found"], $status = Response::HTTP_NOT_FOUND);
        }

        return $vehicleQuery->get()->toJson();
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
        $validator = Validator::make($request->all(),[
            'make'=>'nullable|max:50',
            'model'=>'nullable|max:50',
            'year'=>'nullable|numeric|between:0,32000',
            'color'=>'nullable|max:50',
            'price'=>'nullable|numeric|between:0,2000000000',
            'mileage'=>'nullable|numeric|between:0,2000000000',
            'options'=>'nullable|json',
        ]);

        if($validator->fails()){
            return response()->json(["validation failed" => $validator->errors()], $status = Response::HTTP_BAD_REQUEST);
        }

        $vehicle = Vehicle::find($id);

        $vehicle->make = is_null($request->input('make')) ? $vehicle->make : $request->input('make');
        $vehicle->model = is_null($request->input('model')) ? $vehicle->model : $request->input('model');
        $vehicle->year = is_null($request->input('year')) ? $vehicle->year : $request->input('year');
        $vehicle->color = is_null($request->input('color')) ? $vehicle->color : $request->input('color');
        $vehicle->price = is_null($request->input('price')) ? $vehicle->price : $request->input('price');
        $vehicle->mileage = is_null($request->input('mileage')) ? $vehicle->mileage : $request->input('mileage');
        $vehicle->options = is_null($request->input('options')) ? $vehicle->options : $request->input('options');
        $vehicle->save();

        return response()->json($status = Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicleQuery = Vehicle::where('id', $id);
        if($vehicleQuery->doesntExist()){
            return response()->json(["error" => "vehicle with id $id not found"], $status = Response::HTTP_NOT_FOUND);
        }

        $vehicleQuery->delete();

        return response()->json($status = Response::HTTP_OK);
    }

    /**
     * Search all vehicles for a make containing search target
     * 
     * @param  string  $make
     * @return \Illuminate\Http\Response
     */
    public function searchMake($make){
        return Vehicle::where('make', 'LIKE', "%$make%")->paginate($this->NUM_PAGE_LIMIT)->toJson();
    }

    
    /**
     * Search all vehicles for a model containing search target
     * 
     * @param  string  $model
     * @return \Illuminate\Http\Response
     */
    public function searchModel($model){
        return Vehicle::where('model', 'LIKE', "%$model%")->paginate($this->NUM_PAGE_LIMIT)->toJson();
    }

    
    /**
     * Search all vehicles for a year containing search target
     * 
     * @param  string  $year
     * @return \Illuminate\Http\Response
     */
    public function searchYear($year){
        return Vehicle::where('year', 'LIKE', "%$year%")->paginate($this->NUM_PAGE_LIMIT)->toJson();
    }

    
    /**
     * Search all vehicles for a color containing search target
     * 
     * @param  string  $color
     * @return \Illuminate\Http\Response
     */
    public function searchColor($color){
        return Vehicle::where('color', 'LIKE', "%$color%")->paginate($this->NUM_PAGE_LIMIT)->toJson();
    }
}
