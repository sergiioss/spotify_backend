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

    public function updatedArtist(Request $request, $id){
        try{

            Log::info("Updated artist");

            $validator = Validator::make($request->all(),[
                'name'=> 'string',
                'surnames' => 'string',
                'nationality' => 'string',
                'photo' => 'string'
            ]);

            if($validator->fails()){
                return response()->json([
                    'success'=> false,
                    'message'=> $validator->errors()
                ],400);
            };

            $artist = Artist::query()
            ->where('id', $id)
            ->find($id);

            if(!$artist){
                return response()->json(
                    [
                        'success' => true,
                        'message'=> 'Error'
                    ]
                    );
            }

            $name = $request->input('name');
            $surnames = $request->input('surnames');
            $nationality = $request->input('nationality');
            $photo = $request->input('photo');
            
            if(isset($name)){
                $artist->name = $name;
            };

            if(isset($surnames)){
                $artist->surnames = $surnames;
            };

            if(isset($nationality)){
                $artist->nationality = $nationality;
            };

            if(isset($photo)){
                $artist->photo = $photo;
            };

            $artist->save();

            return response()->json([
                'success'=> true,
                'message'=> "Artist " .$artist->name." ".$artist->surnames. " updated"
            ],200);

        }catch(\Exception $exception){
            Log::error('Error updated artist' . $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error updated artist'
                ],500
            );
        }
    }

    public function deleteArtist($id){
        try{
            Log::info('Delete a product');

            $artist = Artist::query()
            ->where('id', $id)
            ->find($id);

            if(!$artist){
                return response()->json([
                    'success'=> true,
                    'message'=> 'Artist doesnt exists'
                ],404);
            }

            $artist->delete();

            return response()->json([
                'success'=>true,
                'message'=> 'Artist ' .$artist->name." ".$artist->surnames.' deleted'
            ],200);

        }catch(\Exception $exception){
            Log::error('Error delete Artist' . $exception->getMessage());
            return response()->json(
                [
                    'success'=> false,
                    'message'=> 'Error delete artist'
                ],500);
        }
    }
}
