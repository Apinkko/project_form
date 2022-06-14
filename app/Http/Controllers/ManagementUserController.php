<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Gender;
use App\Models\Jabatan;
use App\Models\User;
use App\Models\Status;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ManagementUserController extends Controller
{
    public function index(){
      $users = User::all();
      $genders = Gender::all();
      $departments = Department::all();
      $statuses = Status::wherein('id', [1,2])->get();
      $jabatans = Jabatan::all();
      $units = Unit::all();

      return view('management_user.index', compact('users', 'genders', 'departments', 'jabatans', 'statuses', 'units'));
    }


    public function store(Request $request){
      // dd($request->all());
      $request->validate([
        'password' => ['required'],
        'password_confirmed' => ['required', 'same:password'],
      ]);
      DB::beginTransaction();
      // $cek_nik = User::where('nik', $request->nik)->count();
      // if($cek_nik != 0){
      //     DB::rollback();
      //     return Redirect::back()->with('failed','Create Data User Failed, Nik Telah Tersedia !!');
      // }
      // else{
        $cek_username = User::where('username', $request->username)->count();
        if($cek_username != 0){
            DB::rollback();
            return Redirect::back()->with('failed','Create Data User Failed, Username Telah digunakan !!');
        }else{
            $user = new User;
            $user->nama = $request->nama;
            $user->username = $request->username;
            // $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->remember_token = $request->_token;
            $user->status_id = 1;
            // $user->nik = $request->nik;
            $user->gender_id = $request->gender_id;
            $user->department_id = $request->department_id;
            $user->unit_id = $request->unit_id;
            $user->jabatan_id = $request->jabatan_id;
              if($user->save()){
                DB::commit();
                return Redirect::back()->with('success', 'Create Data Users Berhasil!');
              } else{
                DB::rollBack();
                return Redirect::back()->with('failed', 'Create Data User Failed, Cek Kembali Data Anda!');
              }
        }
    }

    public function update(Request $request, $id){
      dd($request->all());
      $request->validate([
        'password' => ['required'],
        'password_confirmed' => ['required', 'same:password'],
      ]);
      DB::beginTransaction();
      // $cek_nik = User::where('nik', $request->nik)->where('id', '<>', $id)->count();
      // if($cek_nik != 0){
      //     DB::rollback();
      //     return Redirect::back()->with('failed','Update Data User Failed, Nik Telah Tersedia !!');
      // }else{
        $cek_username = User::where('username', $request->username)->where('id', '<>', $id)->count();
        if($cek_username != 0){
            DB::rollback();
            return Redirect::back()->with('failed','Update Data User Failed, Username Telah digunakan !!');
        }else{
            $user = User::find($id);
            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->remember_token = $request->_token;
            $user->status_id = $request->status_id;
            $user->nik = $request->nik;
            $user->gender_id = $request->gender_id;
            $user->department_id = $request->department_id;
            $user->unit_id = $request->unit_id;
            $user->jabatan_id = $request->jabatan_id;
            // $user->jabatan_id = $request->jabatan_id;

              if($user->save()){
                DB::commit();
                return Redirect::back()->with('success', 'Update Data Users Berhasil!');
              } else{
                DB::rollBack();
                return Redirect::back()->with('failed', 'Update Data User Failed, Cek Kembali Data Anda!');
              }
        }


    }

}
