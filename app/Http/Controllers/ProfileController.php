<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($id)
    {
        $provinces = Province::orderBy('name', 'ASC')->get();
        $user = User::findOrFail($id);
        return view('user.profile.index', compact('user','provinces'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => $request->avatar,
            'phone_number' => $request->phone_number,
            'provinces_id' => $request->province_id,
            'regencies_id' => $request->city_id,
            'districts_id' => $request->district_id,
            'address' => $request->address
        ]);

        if($request->input('password')) {
            $user->password= bcrypt(($request->get('password')));
            $user->save();
        }

        return redirect()->back();
        
    }
}
