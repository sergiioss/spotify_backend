<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class PlaylistController extends Controller
{
    public function createPlaylist(Request $request){
        try{
            Log::info('Create Playlist');
            $validator = FacadesValidator::make($request->all(),[
                'name' => ['required', 'string']
            ]); 

            if($validator->fails()){
                return response()->json([
                    'success' => true,
                    'message' => $validator->errors()
                ],400);
            }

            $auth_id = auth()->user()->id;

            $name = $request->input('name');
            $user_id = $auth_id 

            $playlist = new Playlist();
            $playlist->name = $name;
            $playlist->user_id = $user_id;

            $playlist->save();

        }catch(\Exception $exception){
            return response()->json([
                'succes' => false,
                'message'=> 'error'.$exception
            ], 500);
        }
    }
}
