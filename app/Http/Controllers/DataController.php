<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use Validator;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Data::all();
        return response()->json($data);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
         'text' => 'required'
       ]);

       if($validator->fails()){
          $response = array('response' => $validator->messages(), 'success' => false);
          return $response;
       }
       else{
         //Insert data into debug
         $data = new Data;
         $data->text = $request->input('text');
         $data->body = $request->input('body');
         $data->save();

         return response()->json($item);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Data::find($id);
        return response()->json($data);
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
      $validator = Validator::make($request->all(), [
        'text' => 'required'
      ]);

      if($validator->fails()){
         $response = array('response' => $validator->messages(), 'success' => false);
         return $response;
      }
      else{
        //Find data in DB
        $data = Data::find($id);
        $data->text = $request->input('text');
        $data->body = $request->input('body');
        $data->save();

        return response()->json($item);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //Find data in DB
      $data = Data::find($id);
      $data->delete();
      $response = array('response' => 'Data deleted', 'success' => true);
      return $response;
    }
}
