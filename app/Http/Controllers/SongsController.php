<?php

namespace App\Http\Controllers;

use App\Models\Albums;
use App\Models\Artist;
use App\Models\Songs;
use App\Models\Songs_heard;
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
                $album_exist = Albums::find($album_id);
                if($album_exist === null){
                    return response()->json(['error' => 'Error Album does not exist'], 500);
                }
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

    public function deleteSong($id){
        try{
            Log::info('Delete Song');

            $song = Songs::find($id);

            if($song === null){
                return response()->json([
                    'success' => false,
                    'message'=> 'The song does not exist'
                ]);
            }

            $song->delete();

            return response()->json([
                'succes' => true,
                'message' => 'Song ' .$song->name. ' deleted'
            ],200);

        }catch(\Exception $exception){
            Log::error('Error delete Song' .$exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error delete Song'
            ]);
        }
    }

    public function updatedSong(Request $request, $id){
        try{
            Log::info('Updated song');

            $song = Songs::query()
            ->where('id', $id)
            ->first();

            if(!isset($song)){
                return response()->json([
                    'success' => false,
                    'message' => 'The '.$id. ' of the song does not exist'
                ]);
            }

            $validator = Validator::make($request->all(),[
                'name' => 'string',
                'artist_id' => 'integer',
                'album_id' => 'integer',
                'photo' => 'string'
            ]);

            if($validator->fails()){
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()
                ], 400);
            }

            $name = $request->input('name');
            $artist_id = $request->input('artist_id');
            $album_id = $request->input('album_id');
            $photo = $request->input('photo');

            $updateSong = Songs::query()
            ->where('id', $id)
            ->first();

            if(isset($name)){
                $updateSong->name = $name;
            }

            if(isset($album_id)){
                $album_exist = Albums::find($album_id);
                if($album_exist === null){
                    return response()->json(['error' => 'Error Album does not exist'], 500);
                }
                $updateSong->album_id = $album_id;
            }

            if(isset($artist_id)){
                $artist_exist = Artist::find($artist_id);
                if($artist_exist === null){
                    return response()->json(['error' => 'Error Artist does not exist'], 500);
                }
                $updateSong->artist_id = $artist_id;
            }

            if(isset($photo)){
                $updateSong->photo = $photo;
            }

            $updateSong->save();

            return response()->json([
                'success' => true,
                'message' => 'The song '.$updateSong->name.' and id '.$updateSong->id.' updated'
            ]);

        }catch(\Exception $exception){

            return response()->json([
                'success' => false,
                'message' => 'Error updated song'
            ]);
        }
    }

    public function showSongs(){
        try{

            $allSongs = Songs_heard::all();

            if($allSongs->isEmpty()){
                return response()->json([
                    'success' => true,
                    'message' => 'Does not exist songs'
                ], 200);
            }

            return response()->json([
                'success' => true,
                'message' => 'These are all the songs',
                'data' => $allSongs
            ],200);

        }catch(\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => 'Error in the request to show all songs'.$exception
            ], 500);
        }
    }
}
