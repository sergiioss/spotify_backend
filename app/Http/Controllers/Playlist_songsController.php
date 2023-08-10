<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Playlist_songsController extends Controller
{
    public function getter(){
        try{
            
        }catch(\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => 'Error'.$exception
            ],500);
        }
    }
}
