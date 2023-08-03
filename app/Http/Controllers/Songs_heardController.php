<?php

namespace App\Http\Controllers;

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
                'user_id' => ['required','integer'],
                'song_id' => ['required','integer']
            ]);

            if($validator->fails()){
                return response()->json([
                    'success' => true,
                    'message' => $validator->errors()
                ], 400);
            }
            
            $date = $request->input('date');
            $photo = $request->input('photo');
            $user_id = $request->input('user_id');
            $song_id = $request->input('song_id');

            $listSongsHeard = new Songs_heard();
            $listSongsHeard->date = $date;
            $listSongsHeard->photo = $photo;
            $listSongsHeard->user_id = $user_id;
            $listSongsHeard->song_id = $song_id;

            $listSongsHeard->save();

            return response()->json([
                'success' => true,
                'message' => 'Se ha creado la cancion de la lista'
            ], 200);

        }catch(\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => 'Error petition '.$exception->getMessage()
            ], 500);
        }
    }
}
