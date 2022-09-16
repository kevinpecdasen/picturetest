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
                $this->apidie('No such user ', 422);
            }

            $user = User::find($id);

            return view('user', compact('user'));
        }

        if (request()->method() == "POST") {

        }

    }

    public function add_comment(Request $request)
    {
        //post requests
        if($request->getMethod() == "POST"){
            if($request->isJson()){
                $post_data = $request->json()->all();
            }else{
                $post_data = $request->all();
            }

            //check if all the required field are present
            foreach(['password', 'id', 'comments'] as $key){
                if(!isset($post_data[$key]) or !$post_data[$key] or !$key)
                    $this->apidie('Missing key/value for "'.$key.'"', 422);
            }

             //check if the password is match
            if(strtoupper($post_data['password']) != '720DF6C2482218518FA20FDC52D4DED7ECC043AB')
                $this->apidie('Invalid password', 401);
        }
        //catching if from the terminal command
        else{
            $post_data = $request->all();
        }

        if(!is_numeric($post_data['id']))
            $this->apidie('Invalid id', 422);

        try { 
            //search and update the comment
            $user = User::find($post_data['id']);
            $user->comments = $post_data['comments'];
            
            if(!$user)
                $this->apidie('user id '.$post_data['id'].' was not found in the database.', 404);

            if($user->update()) 
                $this->apidie('OK', 200);
        } catch(\Illuminate\Database\QueryException $ex){
          $this->apidie('Could not update database: '.$ex->getMessage(), 500);
        }

    
    }

    function apidie($string, $code = 200){
        $string .= "";
        http_response_code($code);
        if(defined('SCRIPT') && SCRIPT)
            throw new Exception($string);
        die($string);
    }
}
