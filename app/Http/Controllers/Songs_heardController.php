<?php

namespace App\Http\Controllers;

use App\Models\Songs;
use App\Models\Songs_heard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Songs_heardController extends Controller
{
    public function createListSongsHeard(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'date' => ['required', 'date'],
                'photo' => 'string',
                'song_id' => ['required','integer']
            ]);

            if($validator->fails()){
                return response()->json([
                    'success' => true,
                    'message' => $validator->errors()
                ], 400);
            }

            $user_id = auth()->user()->id;

            $date = $request->input('date');
            $photo = $request->input('photo');
            $song_id = $request->input('song_id');

            $song_id_exist = Songs::query()
            ->find($song_id);

            if(!isset($song_id_exist)){
                return response()->json([
                    'success' => true,
                    'message' => 'The id '.$song_id.' does not exist.'
                ],400);
            }
            
            $listSongsHeard = new Songs_heard();
            $listSongsHeard->date = $date;
            $listSongsHeard->photo = $photo;
            $listSongsHeard->user_id = $user_id;
            $listSongsHeard->song_id = $song_id;

            $listSongsHeard->save();

            return response()->json([
                'success' => true,
                'message' => 'The song was added to the list'
            ], 200);

        }catch(\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => 'Error petition '.$exception->getMessage()
            ], 500);
        }
    }

    public function showSongsHeards(){
        try{
            $songsHeards = Songs_heard::all();

            if($songsHeards->isEmpty()){
                return response()->json([
                    'success' => true,
                    'message' => 'You have no songs heard'
                ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => 'These are all the songs heard',
                'data' => $songsHeards
            ],200);

        }catch(\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => 'Error petition '.$exception->getMessage()
            ], 500);
        }
    }
}
