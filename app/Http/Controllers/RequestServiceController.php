<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\JenisInventaris;
use App\Models\KeteranganService;
use App\Models\Service;
use App\Models\TeknisiUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class RequestServiceController extends Controller
{
    public function index_request(){
      $status[] = "";
      $status = [6,7,8,9];
      if(Auth::user()->department_id == 1){
        $jenis_inventaris_id = [4];
      }elseif(Auth::user()->department_id == 4){
        $jenis_inventaris_id = [3];
      }else{
        $jenis_inventaris_id = [3,4];
        $status[] = 5;
      }
      if(auth()->user()->jabatan_id != 4){
        $check_inventaris = Inventaris::whereIn('jenis_inventaris_id', $jenis_inventaris_id)->get();
        foreach($check_inventaris as $val){
          $inventaris_id[] = $val->id;
        }
        $service_requests = Service::whereIn('inventaris_id', $inventaris_id)
                                     ->whereIn('status_id', $status);
        if(Auth::user()->department_id == 7){
          $service_requests = $service_requests->where('biaya_service','<>','0');
        }
          $service_requests = $service_requests->orderby('status_id')
                                     ->orderby('created_at', 'desc')
                                     ->get();
      }else{
        $service_requests = Service::whereIn('status_id', [6,7,8,9])
                                    ->orderby('status_id')
                                    ->orderby('created_at', 'desc')
                                    ->get();
      }

      $teknisi_umums = TeknisiUmum::all();
      return view('service.index_request', compact('service_requests','teknisi_umums'));
    }

    public function onprogress(Request $request){
        $service = Service::find($request->service_id);
        $service->status_id = 7;
        $service->biaya_service = $request->biaya_service;
        if(Auth::user()->department_id != 4){
          $service->teknisi_id = Auth::user()->id;
        }else {
          $service->teknisi_umum_id = $request->teknisi_umum_id;
        }
        $service->tgl_teknisi = date('Y-m-d H:i:s');

        if($service->save()){
            $keterangan = new KeteranganService;
            $keterangan->keterangan = $request->keterangan;
            $keterangan->service_id = $request->service_id;
            $keterangan->user_id = Auth::user()->id;

            if($keterangan->save()){
              return Redirect::back()->with('success', 'Service Siap DiKerjakan!');
            }
        }
    }

    public function selesai(Request $request){
        $service = Service::find($request->service_id);
        $service->status_id = 8;
        if($service->save()){
          $keterangan = new KeteranganService;
          $keterangan->keterangan = $request->keterangan;
          $keterangan->service_id = $request->service_id;
          $keterangan->user_id = Auth::user()->id;
          if($keterangan->save()){
            return Redirect::back()->with('success', 'Service Telah Selesai DiKerjakan!');
          }
        }
    }

    public function closed(Request $request){
        $service = Service::find($request->service_id);
        $service->status_id = 9;
        $service->teknisi_id = Auth::user()->id;
        $service->tgl_teknisi = date('Y-m-d H:i:s');
        if($service->save()){
          $keterangan = new KeteranganService;
          $keterangan->keterangan = $request->keterangan;
          $keterangan->service_id = $request->service_id;
          $keterangan->user_id = Auth::user()->id;
          if($keterangan->save()){
            return Redirect::back()->with('success', 'Service diTutup atau Tidak Diproses');
          }
        }
    }

    public function lonceng_request_service(Request $request)
    {
      $status = 6;
      if(Auth::user()->department_id == 1){
        $jenis_inventaris_id = [4];
      }elseif(Auth::user()->department_id == 4) {
        $jenis_inventaris_id = [3];
      }else{
        $jenis_inventaris_id = [3,4];
        $status = 5;
      }
      $check_inventaris = Inventaris::whereIn('jenis_inventaris_id', $jenis_inventaris_id)->get();
      foreach($check_inventaris as $val){
        $inventaris_id[] = $val->id;
      }
      if(auth()->user()->jabatan_id != 4){
          $check_data = Service::where('status_id', $status)
                                ->whereIn('inventaris_id', $inventaris_id)
                                ->count();
      }else{
          $check_data = Service::where('status_id', 6)
                                ->count();
      }
      return json_encode(['response'  => "success", 'total_data' => $check_data]);
    }

}
