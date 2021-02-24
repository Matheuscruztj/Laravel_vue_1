<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Person;

class PersonController extends Controller
{
    public function index()
    {
        return response(Person::orderBy('id', 'asc')->get()->jsonserialize(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        try{
            $p1 = new Person();
            $p1->name = $request->name;

            if(!is_double($request->weight)){
                return response("Numero invalido", Response::HTTP_BAD_REQUEST);
            }
            $p1->weight = round(floatval($request->weight), 2);
            $p1->gender = $request->gender;
            $p1->birthdate = $request->birthdate;
            $p1->save();
            return response($p1->jsonSerialize(), Response::HTTP_CREATED);
        }catch(Exception $ex){
            return response($ex->jsonSerialize(), Response::HTTP_NO_CONTENT);
        }
    }

    public function show($id)
    {
        $p1 = Person::findOrFail($id);
        if($p1 == null){
            return response(null, Response::HTTP_NOT_FOUND);
        }
        return response($p1->jsonSerialize(), Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $p1 = Person::findOrFail($id);
        if($p1 == null){
            return response("Id não encontrado", Response::HTTP_NOT_FOUND);
        }
        if(!is_double($request->weight)){
            return response("Numero invalido", Response::HTTP_BAD_REQUEST);
        }
        $p1->name = $request->name;
        $p1->weight = round(floatval($request->weight), 2);
        $p1->gender = $request->gender;
        $p1->birthdate = $request->birthdate;

        $p1->save();

        return response($p1->jsonSerialize(), Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $p1 = Person::findOrFail($id);
        if($p1 == null){
            return response("Id não encontrado", Response::HTTP_NOT_FOUND);
        }
        Person::destroy($id);
        return response(null, Response::HTTP_OK);
    }
}
