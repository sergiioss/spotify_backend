<?php

namespace App\Http\Controllers;

use App\Models\Albums;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AlbumsController extends Controller
{
    public function createAlbum(Request $request){
        try{
            Log::info("Creating artist");

            $validator = Validator::make($request->all(),[
                'name'=> ['required', 'string'],
                'artist_id' => ['required', 'integer'],
                'release_date' => ['required', 'string'],
                'photo' => 'string',
            ]);

            if($validator->fails()){
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()
                ],400);
            }

            $name = $request->input('name');
            $artist_id = $request->input('artist_id');
            $release_date = $request->input('release_date');
            $photo = $request->input('photo');

            $artist_exist = Artist::find($artist_id);

            if($artist_exist === null){
                return response()->json(
                    [
                        'message' => "Don't exist Artist_id"
                    ]
                );
            }
            $repeat_name = Albums::where('name', $name)
            ->first();
            
            if(isset($repeat_name->name)){
                return response()->json(
                    [
                        'message' => 'The name of this album already exists'
                    ]
                );
            }

            $album = new Albums();
            $album->name = $name;
            $album->artist_id = $artist_id;
            $album->release_date = $release_date;
            $album->photo = $photo;

            $album->save();

            return response()->json ([
                'success'=> true,
                'message'=> 'Album created'
            ],200);

        }catch(\Exception $exception){
            Log::error("Error creating album:" . $exception->getMessage());

            return response()->json([
                'succes'=> false,
                'message' => "Error creating album"
            ],500);
        }
    }

    public function updatedAlbum(Request $request, $id){
        try{

            Log::info("Updated album");

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
}
