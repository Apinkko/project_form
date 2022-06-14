<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Exports\LaporanServiceExcel;
use Maatwebsite\Excel\Excel;
use PDF;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function laporan_service()
    {
        return view('laporan.laporan_service');
    }

    public function cek_data($start_date, $end_date)
    {


          $dept = Auth::user()->department_id;
          $user = User::where('department_id', $dept)->get();

      // Join table service to users


      foreach($user as $userId){
        $user_id[] = $userId->id;
      }

      $search = Service::join('users as a', 'service.user_id', '=', 'a.id')
                            ->join('users as aa', 'service.teknisi_id', '=', 'aa.id')
                            ->join('department as b', 'a.department_id', '=', 'b.id')
                            ->join('inventaris as c', 'service.inventaris_id', '=', 'c.id')
                            ->join('jenis_inventaris as d', 'c.jenis_inventaris_id', '=',  'd.id')
                            ->join('unit as e', 'a.unit_id', '=',  'e.id')
                            // ->whereBetween('service.created_at', [$start_date, $end_date])
                            ->whereDate('service.created_at', '>=', $start_date)
                            ->whereDate('service.created_at', '<=', $end_date)
                            ->where('service.status_id', 8);
      if($dept == 1 ){
        $search = $search->whereIn('service.user_id', $user_id)->orwhere('c.jenis_inventaris_id', 4);
      }elseif($dept == 4 ){
        $search = $search->whereIn('service.user_id', $user_id)->orwhere('c.jenis_inventaris_id', 3);
      }else if($dept == 7) {
        $search = $search->where('service.biaya_service','<>','0');
      }else if($dept == 4 ){
        $search->whereIn('service.user_id', $user_id);
      } else if(Auth::user()->jabatan_id == 2){
         $search->where('b.id', $dept);
      }

      $search = $search->select('service.id as id_service', 'service.no_tiket' , 'a.nama as pemohon','b.department', 'e.nama_unit', 'd.jenis_inventaris', 'c.nama as inventaris', 'service.service',
                            'service.biaya_service', 'service.created_at', 'service.keterangan', 'aa.nama as nama_teknisi')
                            ->orderBy('service.created_at')
                            ->get();
          // dd($search);
      return $search;
    }

    public function search(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $search = self::cek_data($start_date, $end_date);
        return json_encode(['response' => 'success', 'search' => $search]);
    }


    public function search_excel(Request $request)
    {
      $start_date = $request->start_date;
      $end_date = $request->end_date;

      return \Excel::download(new LaporanServiceExcel($start_date, $end_date), 'Laporan Service Excel '.date("d_M_Y", strtotime($start_date)). '-'.date("d_M_Y", strtotime($end_date)). '.xlsx');
      // return json_encode(['response' => 'success']);
    }

    public function search_pdf(Request $request)
    {
      $start_date = $request->start_date;
      $end_date = $request->end_date;

      $data_service = self::cek_data($start_date, $end_date);

      $pdf = PDF::loadview('laporan.laporan_service_pdf',compact('data_service','start_date','end_date'))->setPaper('a4', 'landscape');
      // return $pdf->stream();
      return $pdf->download('Laporan Service '. date('d/M/Y', strtotime($start_date)). '-'.date('d/M/Y', strtotime($end_date)). '.pdf');
  }

  public function search_pdf_single($id)
  {
      $data_service = Service::find($id);
      $manager = User::where('department_id', $data_service->user->department_id)->where('jabatan_id',2)->first();
      // return view('laporan.form_service_pdf',compact('data_service'));
      $pdf = PDF::loadview('laporan.form_service_pdf',compact('data_service','manager'));
      // return $pdf->stream();
      return $pdf->download('Laporan Form Service '.$data_service->created_at->format('d/M/Y').'.pdf');
  }
}
