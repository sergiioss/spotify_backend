<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ArtistController extends Controller
{
    public function createArtist(Request $request){
        try{
            Log::info("Creating artist");

            $validator = Validator::make($request->all(),[
                'name'=> ['required', 'string'],
                'surnames' => ['required', 'string'],
                'nationality' => ['required', 'string'],
                'photo' => 'string',
            ]);

            if($validator->fails()){
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()
                ],400);
            }           

            $name = $request->input('name');
            $surnames = $request->input('surnames');
            $nationality = $request->input('nationality');
            $photo = $request->input('photo');

            $artist = new Artist();
            $artist->name = $name;
            $artist->surnames = $surnames;
            $artist->nationality = $nationality;
            $artist->photo = $photo;

            $artist->save();

            return response()->json ([
                'success'=> true,
                'message'=> 'Artist created'
            ],200);

        }catch(\Exception $exception){
            Log::error("Error creating artist:" . $exception->getMessage());

            return response()->json([
                'succes'=> false,
                'message' => "Error creating artist"
            ],500);
        }
    }

    public function artistAll()
    {
        try {
            Log::info('Getting all artists');

            $artist = Artist::get()->toArray();

            return $artist;

        } catch (\Exception $exception) {
            Log::error('Customer information error' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Customer information error'
            ], 500);
        }
    }
}
