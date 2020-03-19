<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\models\Client;
use App\User;

class ProfileController extends Controller
{

    public function login()
    {
        return view('eCommerce.register');
    }

    public function register()
    {
        return view('eCommerce.register');
    }



    public function register_store(Request $request)
    {
        $url = $request->url;
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'password'       => 'required|min:6|same:re_password',
            're_password' => 'required'
        ]);

        $model = new Client();
        $model->name = $request->name;
        $model->type = $request->customer;
        $model->last_name = $request->last_name;
        $model->user_name = $request->username;
        $model->email = $request->email;
        $model->mobile = $request->phone;
        $model->address = $request->address;
        $model->password = Hash::make($request->password);
        $model->save();

        $id = $model->id;

        $user = new User();
        $user->clients_id = $id;
        $user->first_name = $request->name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        $user->assignRole('Clients');



        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Thamks for product rating'), 'goto' => url($url)]);
    }
}
