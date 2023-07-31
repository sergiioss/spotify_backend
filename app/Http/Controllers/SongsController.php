<?php

namespace App\Http\Controllers;

use App\Models\Albums;
use App\Models\Songs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SongsController extends Controller
{
    const NO_ALBUM = 0; //The song has no album 
    const NO_PHOTO = 'https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png'; //Photo default
    

    public function createSong(Request $request){
        try{
            Log::info('Create Song');

            $validator = Validator::make($request->all(),[
                'name'=> ['required', 'string'],
                'artist_id' => ['required', 'integer'],
                'album_id' => 'integer',
                'photo' => 'string'
            ]);

            if($validator->fails()){
                return response()->json([
                    'success'=> false,
                    'message' => $validator->errors()
                ]);
            }

            $name = $request->input('name');
            $artist_id = $request->input('artist_id');
            $album_id = $request->input('album_id');
            $photo = $request->input('photo');

            $song = new Songs();
            $song->name = $name;
            $song->artist_id = $artist_id;
            
            if(isset($album_id)){
                $song->album_id = $album_id;
            }
            
            if(isset($photo)){
                $song->photo = $photo;
            }
            
            if($song->album_id === null){
                $song->album_id = self::NO_ALBUM;
            }
            if($song->photo === null){
                $song->photo = self::NO_PHOTO;
            }

            $song->save();

            $song->albums()->attach($album_id);
            

            return response()->json ([
                'success'=> true,
                'message'=> 'Song created'
            ],200);

        }catch(\Exception $exception){
            Log::error('Error creating Song' .$exception->getMessage());
            return response()->json([
                'success'=> false,
                'message' => "Error creating song"
            ]);
        }
    }
}
