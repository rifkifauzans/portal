<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;

class HomeController extends Controller
{
    public function index(){
        $current_month=Carbon::now()->month;
        $current_year=Carbon::now()->year;

        $dataseluruhkaryawan = DB::connection('sqlsrv')->table('File_A1_SQL') 
        ->whereRaw("month(STAT_REC)=$current_month")
        ->whereRaw("year(STAT_REC)=$current_year")
        ->count();
        $dataseluruhkaryawan=number_format($dataseluruhkaryawan);

        $dataseluruhkaryawanpimpinan = DB::connection('sqlsrv')->table('File_A1_SQL') 
        ->whereRaw("month(STAT_REC)=$current_month")
        ->whereRaw("year(STAT_REC)=$current_year")
        ->whereRaw("EMPLOYEESUBGRUP='AA - Karpim'")
        ->where('STS_ADMINISTRATIF','AKTIF')
        ->count();
        $dataseluruhkaryawanpimpinan=number_format($dataseluruhkaryawanpimpinan);

        $dataseluruhkaryawanpelaksana = DB::connection('sqlsrv')->table('File_A1_SQL') 
        ->whereRaw("month(STAT_REC)=$current_month")
        ->whereRaw("year(STAT_REC)=$current_year")
        ->whereRaw("EMPLOYEESUBGRUP='BA - Karpel'")
        ->where('STS_ADMINISTRATIF','AKTIF')
        ->count();
        $dataseluruhkaryawanpelaksana=number_format($dataseluruhkaryawanpelaksana);

        $dataseluruhkaryawanpkwt = DB::connection('sqlsrv')->table('File_A1_SQL') 
        ->whereRaw("month(STAT_REC)=$current_month")
        ->whereRaw("year(STAT_REC)=$current_year")
        ->whereRaw("EMPLOYEESUBGRUP='CC - PKWT'")
        ->where('STS_ADMINISTRATIF','AKTIF')
        ->count();
        $dataseluruhkaryawanpkwt=number_format($dataseluruhkaryawanpkwt);

        $dataseluruhkaryawanmbt = DB::connection('sqlsrv')->table('File_A1_SQL') 
        ->whereRaw("month(STAT_REC)=$current_month")
        ->whereRaw("year(STAT_REC)=$current_year")
        ->whereRaw("EMPLOYEESUBGRUP='ZA -  MBT:Masa Bebas Tugas'")
        ->where('STS_ADMINISTRATIF','MBT')
        ->count();
        $dataseluruhkaryawanmbt=number_format($dataseluruhkaryawanmbt);

        $dataseluruhkaryawanpenugasan = DB::connection('sqlsrv')->table('File_A1_SQL') 
        ->whereRaw("month(STAT_REC)=$current_month")
        ->whereRaw("year(STAT_REC)=$current_year")
        ->where('STS_ADMINISTRATIF','PENUGASAN')
        ->count();
        $dataseluruhkaryawanpenugasan=number_format($dataseluruhkaryawanpenugasan);

        $dataseluruhkaryawancdt = DB::connection('sqlsrv')->table('File_A1_SQL') 
        ->whereRaw("month(STAT_REC)=$current_month")
        ->whereRaw("year(STAT_REC)=$current_year")
        ->where('STS_ADMINISTRATIF','CDT')
        ->count();
        $dataseluruhkaryawancdt=number_format($dataseluruhkaryawancdt);

        //dd($dataalluser);
        $status=0;
        //ini pakai compact
        return view('home.home',compact('dataseluruhkaryawan','dataseluruhkaryawanpimpinan','dataseluruhkaryawanpelaksana','dataseluruhkaryawanpkwt','dataseluruhkaryawanmbt','dataseluruhkaryawanpenugasan','dataseluruhkaryawancdt'));
    }
    
    
    
}
