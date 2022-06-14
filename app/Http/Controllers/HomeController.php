<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function home(){
        $data_account = User::count();
        $total_service = Service::count();
        $service_selesai = Service::where('status_id', 7)->count();
        $service_reject = Service::where('status_id', 10)->count();

        return view('dashboard',compact('data_account', 'total_service', 'service_selesai', 'service_reject'));
    }



    public function ubah_password(Request $request)
    {
      DB::beginTransaction();
      $id = auth::user()->id;
      $old_pass = $request->password_old;
      $new_pass = $request->password_new;
      $conf_new_pass = $request->confirm_password_new;
      $cek_password= User::find($id);
      if(!Hash::check($old_pass, $cek_password->password)) {
          DB::rollback();
          return Redirect::back()->with('failed', 'Update Your Password Failed, Password Lama Anda Salah !!!');
      }else{
          if(Hash::check($new_pass, $cek_password->password)) {
              DB::rollback();
              return Redirect::back()->with('failed', 'Update Your Password Failed, Tidak Dapat Menggunakan Password Lama !!!');
          }else{
              if($new_pass == $conf_new_pass){
                  $reset = DB::table('users')
                                  ->where('id',$id)
                                  ->update([
                                      'password' => Hash::make($new_pass)
                                    ]);
                  if($reset != 0){
                    DB::commit();
                    return Redirect::back()->with('success', 'Update Your Password Success !!!');
                  }else{
                    DB::rollback();
                    return Redirect::back()->with('failed', 'Update Your Password Failed, Silahkan Cek Kembali Data Anda !!!');
                  }
              }else{
                DB::rollback();
                return Redirect::back()->with('failed', 'Update Your Password Failed, Password Baru Anda Tidak Sesuai !!!');
              }
          }
      }
    }
}
