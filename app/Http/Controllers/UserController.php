<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class UserController extends Controller
{
    public function view(){ 
       return view('users.list');
    }

    public function create(Request $request){

        $validator  = FacadesValidator::make($request->all(), [
            'name'  => 'required',
            'email' => 'required',
            'phone' => 'required',
            'city'  => 'required',
        ]);

        if ($validator->fails()) {
            return false;
        }

       $name  = $request->input('name');
       $email = $request->input('email');
       $phone = $request->input('phone');
       $city  = $request->input('city');

       $user        = new User();
       $user->name  = $name;
       $user->email = $email;
       $user->phone = $phone;
       $user->city  = $city;
       $user->save(); 
       
       echo json_encode([
           'status' => 'success',
           'message' => 'User Added'
       ]);
       
    }

    public function update(Request $request){

        $validator  = FacadesValidator::make($request->all(), [
            'id'    => 'required',
            'ename'  => 'required',
            'eemail' => 'required',
            'ephone' => 'required',
            'ecity'  => 'required',
        ]);

        if ($validator->fails()) {
            return false;
        }


        $id    = $request->input('id');
        $name  = $request->input('ename');
        $email = $request->input('eemail');
        $phone = $request->input('ephone');
        $city  = $request->input('ecity');

        $user        = User::find($id);
        $user->name  = $name;
        $user->email = $email;
        $user->phone = $phone;
        $user->city  = $city;
        $user->save();
       
        echo json_encode([
            'status' => 'success',
            'message' => 'User Updated'
        ]);
    }

    public function delete(Request $request){
        $id    = $request->input('did');
        $user        = User::find($id);
        $user->delete();

        echo json_encode([
            'status' => 'success',
            'message' => 'User Deleted'
        ]);
    }

    public function ajaxAll(){
        $data = User::all();
        $result = view('users.listAjax')->with('users', $data);
        return $result;
    }
}
