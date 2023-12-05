<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.permissionPage.user.index',[
            'users' => User::where('role','admin')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissionPage.user.create', [
            'roles' => Role::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "name" => "required|string|max:30",
                "role" => "required",
                "email" => "required|email|unique:users,email",
                "password" => "required|min:6|confirmed"
            ],
            [],
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'admin',
                'password' => Hash::make($request->password)
            ]);
            $user->assignRole($request->role);
            return redirect()->route('user.index')->with(['success' => 'Data berhasil disimpan!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors($validator)->with(['error' => $th->getMessage()]);
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.permissionPage.user.edit',[
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validator = Validator::make(
            $request->all(),
            [
                "name" => "required|string|max:30",
                "role" => "required",
                "email" => "required|email|unique:users,email,". $user->id,
                "password" => "confirmed"
            ],
            [],
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            $user->syncRoles($request->role);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->input('password')) {
                $user->password = Hash::make($request->password);
            }
            return redirect()->route('user.index')->with(['success' => 'Data berhasil diubah!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors($validator)->with(['error' => $th->getMessage()]);
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->removeRole($user->roles->first());
        $user->delete();
        if($user){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
