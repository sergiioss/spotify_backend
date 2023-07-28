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
                'artist_id' => 'integer',
                'release_date' => 'string',
                'photo' => 'string',
            ]);

            if($validator->fails()){
                return response()->json([
                    'success'=> false,
                    'message'=> $validator->errors()
                ],400);
            };

            $artist_id = $request->input('artist_id');

            $artist_exist = Artist::find($artist_id);

            if($artist_exist === null){
                return response()->json(
                    [
                        'message' => "Don't exist Artist_id"
                    ]
                );
            }

            $updatedAlbum = Albums::find($id);
            
            if(!isset($updatedAlbum->id)){
                return response()->json(
                    [
                        'success' => true,
                        'message'=> "There is no such album to update"
                    ]
                    );
            }

            $name = $request->input('name');
            $release_date = $request->input('release_date');
            $photo = $request->input('photo');

            if (isset($name)) {
                $updatedAlbum->name = $name;
            }

            if (isset($release_date)) {
                $updatedAlbum->release_date = $release_date;
            }

            if (isset($artist_id)) {
                $updatedAlbum->artist_id = $artist_id;
            }

            if (isset($photo)) {
                $updatedAlbum->photo = $photo;
            }
            
            $updatedAlbum->save();

            return response()->json([
                'success'=> true,
                'message'=> "Album " .$updatedAlbum->name." ".$updatedAlbum->artist_id. " updated"
            ],200);

        }catch(\Exception $exception){
            Log::error('Error updated album' . $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error updated album'
                ],500
            );
        }
    }
}
