<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    


    public function getUser($id = false, $password = false, $comments = false)
    {
        if (request()->method() == "GET") {
            //validation
            if(!$id || !is_numeric($id)){
                $this->apidie('No such user ', 404);
            }

            $user = User::find($id);

            return view('user', compact('user'));
        }

    }

    function apidie($string, $code = 200){
        $string .= "";
        http_response_code($code);
        if(defined('SCRIPT') && SCRIPT)
            throw new Exception($string);
        dd($string);
    }
}
