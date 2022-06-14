<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Department;
use App\Models\Inventaris;
use App\Models\JenisInventaris;
use App\Models\KeteranganService;
use App\Models\Service;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Exports\LaporanExcel;
use App\Models\Unit;
use Maatwebsite\Excel\Excel;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $dept = Auth::user()->department_id;

        // Join table service to users

        if(Auth::user()->jabatan_id == 2 || Auth::user()->jabatan_id == 3){
             $user = User::where('department_id', Auth::user()->department_id)->get();
        }else {
             $user = User::where('unit_id', Auth::user()->unit_id)->get();
        }

        foreach($user as $userId){
          $user_id[] = $userId->id;
        }

        if(Auth()->user()->jabatan_id != 4){
            $services = Service::whereIn('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
            if(Auth::user()->department_id == 4){

              $services = Service::select('service.*')
                ->join('inventaris', 'inventaris.id', '=', 'service.inventaris_id')
                ->where('inventaris.jenis_inventaris_id', '=', '3')
                ->orderBy('created_at', 'DESC')
                ->get();
            }
        }else{
            $services = Service::orderBy('created_at', 'DESC')->get();
        }
        $departments = Department::all();
        $jenis_inventariss = JenisInventaris::orderBy('jenis_inventaris')->get();
        $statuses = Status::all();

        return view('service.index', compact('services', 'jenis_inventariss', 'statuses', 'departments'));
    }

    public function approve($id){
      // return 'wew';
      $service = Service::find($id);
      // Handle Finance
      if($service->status_id == 5){
        $status = 6;
        $from = "Finance";
      }else{
        $from = "Spv";
        $status = 4;
      }
      $service->status_id = $status;
      if($service->save()){
        return Redirect::back()->with('success', 'Approval by '. $from .' telah berhasil!');
      }
    }

    public function approve_manager(Request $request) {

      $service = Service::find($request->service_id);
      if($service->biaya_service != 0){
        if($service->user->department_id == 7){
          $service->status_id = 6;
        } else {
          $service->status_id = 5;
        }
      }else {
        $service->status_id = 6;
      }
      $service->type_permohonan = $request->type_permohonan;

      if($service->save()){
        $keterangan = new KeteranganService;
        $keterangan->keterangan = $request->keterangan;
        $keterangan->service_id = $request->service_id;
        $keterangan->user_id = Auth::user()->id;
        if($keterangan->save()){
          return Redirect::back()->with('success', 'Service Telah di Setujui');
        }
      }
    }

    public function reject(Request $request) {

      $service = Service::find($request->service_id);
      $service->status_id = 10;

      if($service->save()){
        $keterangan = new KeteranganService;
        $keterangan->keterangan = $request->keterangan;
        $keterangan->service_id = $request->service_id;
        $keterangan->user_id = Auth::user()->id;
        if($keterangan->save()){
          return Redirect::back()->with('failed', 'Service Telah ditolak!');
        }
      }
    }

    public function store(ServiceRequest $request)
    {
       // ADD NO TIKET

       $cek_inventaris = Inventaris::find($request->inventaris);

       if($cek_inventaris->jenis_inventaris_id == 3){
         $cek_tiket = Service::where('no_tiket','like','MT%')->orderby('id','DESC')->first();
         if(!empty($cek_tiket)){
           $no_tiket = substr($cek_tiket->no_tiket,3)+1;
           $no_tiket = 'MT-'.$no_tiket;
         }else{
           $no_tiket = 'MT-1';
         }
     } else{
         $cek_tiket = Service::where('no_tiket','like','IT%')->orderby('id','DESC')->first();
         if(!empty($cek_tiket)){
           $no_tiket = substr($cek_tiket->no_tiket,3)+1;
           $no_tiket = 'IT-'.$no_tiket;
         }else{
           $no_tiket = 'IT-1';
         }
      }

        // dd($no_tiket);
        DB::beginTransaction();
        if(Auth::user()->jabatan_id == 2){
          $status = 6;
        } elseif(Auth::user()->jabatan_id == 3){
          $status = 6;
          if(!empty($request->biaya_service) && Auth::user()->department_id != 7){
              $status = 5;
          }
        }else{
          $status = 3;
        }

        $biaya_service = 0;
        if(!empty($request->biaya_service)){
          $biaya_service = preg_replace("/[^0-9]/", "", $request->biaya_service);
        }
        $service = new Service;
        $service->user_id = Auth::user()->id;
        $service->no_tiket = $no_tiket;
        $service->status_id = $status;
        $service->inventaris_id = $request->inventaris;
        $service->service = $request->service;
        $service->biaya_service = $biaya_service;
        $service->keterangan = $request->keterangan;

        if($service->save()){
          DB::commit();
          return Redirect::back()->with('success', 'Permohonan Service Berhasil diajukkan');
        }else{
          DB::rollBack();
          return Redirect::back()->with('failed', 'Permohonan Service Failed, Cek Kembali Data Anda');
        }
    }


    public function getInventaris(Request $request){
        $inventaries = Inventaris::where('jenis_inventaris_id', $request->id_jenis)->orderBy('nama')->get();
        return json_encode(['response'  => "success", 'val_inventaris' => $inventaries]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $keterangan_service = KeteranganService::where('service_id',$service->id)->get();

        return view('service.show', compact('service','keterangan_service'));
    }

    public function update(Request $request, Service $service)
    {

      $service->update([
        'user_id' => Auth::user()->id,
        'status_id' => Auth::user()->status->id,
        'jenis_inventaris_id' => $request->jenis_inventaris_id,
        'created_at' => $request->created_at,
        'service' => $request->service,
        'biaya_service' => $request->biaya_service,
        'keterangan' => $request->keterangan,
      ]);

     return redirect(route('service.index'))->with('success', 'Data Berhasil di Update!');

    }

    public function destroy(Service $service)
    {
        DB::beginTransaction();
        if($service->delete()){
          DB::commit();
          return back()->with('success', 'Data Service Berhasil Dihapus!');
        }else{
          DB::rollback();
          return back()->with('failed', 'Data Service Gagal Dihapus, Cek Kembali Data Anda!');
        }

    }

    public function check_data_service(Request $request)
    {
      if (auth()->user()->jabatan_id == 4){
        // $status = [3,4];
        $get_data_service = 0;

        $get_data_service = Service::whereIn('status_id', [3,4])->count();
      }elseif(auth()->user()->department_id == 4){
        $get_data_service = 0;

        // $get_data_service = Service::whereIn('status_id', [3,4])->count();
        $get_data_service = Service::select('service.*')
        ->join('inventaris', 'inventaris.id', '=', 'service.inventaris_id')
        ->where('inventaris.jenis_inventaris_id', '=', '3')
        ->where('service.status_id', '=', '3')
        ->count();
      }
      else {
        $dept = Auth::user()->department_id;

        $user = User::where('department_id', $dept)->get();
        foreach($user as $userId){
          $user_id[] = $userId->id;
        }

        $get_data_service = 0;

        if(Auth::user()->jabatan_id == 2 || Auth::user()->jabatan_id == 3){
          if(Auth::user()->jabatan_id == 2){
            $status = [3];
          }else{
            $status = [3,4];
          }
          $get_data_service = Service::whereIn('user_id', $user_id)->whereIn('status_id', $status)->count();
        }

      }


        return json_encode(['response' => 'success', 'total_data_service' => $get_data_service]);
    }

    public function export_service_excel()
    {
      // return $this->excel->download(new LaporanExcel, 'laporan_service.xlsx');
      return \Excel::download(new LaporanExcel, 'laporan_service.xlsx');
    }




}
