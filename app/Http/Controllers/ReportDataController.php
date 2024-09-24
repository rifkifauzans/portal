<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;

use DB;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportDataController extends Controller
{
    public function report_sdm()
    {
        $datakebun = DB::connection('sqlsrv')->table('ref_kebun')->where('status',1)->get();
        //$datasdm01 = DB::connection('sqlsrv')->table('sdm01_backup')->get();
        $datasdm02 = DB::connection('sqlsrv')->table('sdm02_backup');
        $datasdm03 = DB::connection('sqlsrv')->table('sdm03_backup');
        $datasdm04 = DB::connection('sqlsrv')->table('sdm04_backup');
        $datasdm08 = DB::connection('sqlsrv')->table('sdm08_backup');       
        $datasdm16 = DB::connection('sqlsrv')->table('sdm16_backup');
        $searchnama = "";
        $searchkebun = "";
        $datauser = "";
        if(isset($_COOKIE['kebun']) and $_COOKIE['kebun']!=""){
            $searchkebun = $_COOKIE['kebun'];  
        }

        if(isset($_COOKIE['namasearch']) and $_COOKIE['namasearch']!=""){
            $searchnama = $_COOKIE['namasearch'];  
        }

        $datauser = DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP','like',$searchnama)->get();
        $datasdm01_cari = DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP','like',$searchnama)->get();
        //dd($datasdm01_cari);
        $datafotokaryawan = DB::connection('sqlsrv')->table('FotoKaryawan')->where('NPP','like','01030984041312')->first();
        //dd($datafotokaryawan);
        $datasdm02 = $datasdm02->where('NPP','like',$searchnama)->get();
        $datasdm03 = $datasdm03->where('NPP','like',$searchnama)->get();
        $datasdm04 = $datasdm04->where('NPP','like',$searchnama)->get();
        //$datasdm08 = $datasdm08->where('NPP','like','01011692042196')->orderbydesc('TMT')->get();
        //$datasdm16 = $datasdm16->where('NPP','like','01011692042196')->orderbydesc('TMT')->get();
        $output_sdm08 = DB::select("SET NOCOUNT ON ; exec OutCV_SDM08 '$searchnama'");
        $output_sdm16 = DB::select("SET NOCOUNT ON ; exec OutCV_SDM16 '$searchnama'");
        //dd($dataallusers);
        return view('reportdata.report_sdm',compact('datauser','datasdm02','searchnama','datasdm03','datasdm04','datasdm08','datasdm16','output_sdm08','datakebun','searchkebun','output_sdm16','datasdm01_cari','datafotokaryawan'));
    }

    public function get_image(){
        $searchnama = "";
        if(isset($_COOKIE['namasearch']) and $_COOKIE['namasearch']!=""){
            $searchnama = $_COOKIE['namasearch'];  
        }

        $datafotokaryawan = DB::connection('sqlsrv')->table('FotoKaryawan')->where('NPP','like','01030984041312')->first();

        $imageData = $datafotokaryawan->Foto;
        //dd($datafotokaryawan);
        return Response::make($imageData, 200, [
            'Content-Type' => 'image/jpeg', // Adjust the content type as needed
            'Content-Disposition' => 'inline; filename="image.jpg"',
        ]);
    
    }

    public function getkodekebun($id = null){
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');
        $datauser = "";
        //$datauser= DB::connection('sqlsrv')->table('File_A1_SQL')->where('KD_KBN',$id)->whereRaw('MONTH(STAT_REC)=?',[$month])->whereRaw('YEAR(STAT_REC)=?',[$year])->get();
        $datauser= DB::connection('sqlsrv')->table('File_A1_SQL')->where('KD_KBN',$id)->where('STS_ADMINISTRATIF','AKTIF')->wheremonth('STAT_REC',$month)->whereyear('STAT_REC',$year)->get();
        //dd($datauser);
        return response()->json($datauser);
        
    }

    public function dashfilea1()
    {

        return view('reportdata.data_file_a1');
    }

    public function exportfilea1(Request $request) {
        $tanggal      = $request->input('datepickerexport');
        // Assuming $csvData is an array of arrays, where each sub-array represents a row in the spreadsheet
        $dataallusers = DB::connection('sqlsrv')->table('File_A1_SQL_Backup')->where('STAT_REC',$tanggal)->where('STS_ADMINISTRATIF','AKTIF');
            // ->whereIn('tbl_bagian.kode_bagian',$bagian_yang_komoditasnya_karet)
            // ->whereRaw('(name like "Febri%" or password="1111")')
        $dataallusers = $dataallusers->get();
        $dataallusers_count = $dataallusers->count();
        $rowNumber = 1;
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->insertNewRowBefore($rowNumber + 1, $dataallusers_count);

        $csvData[] = [
            'REG',
            'NAMA', 
            'NM_PGL',
            'GLR_DPN',
            'GLR_BLK',
            'TPT_LAHIR',
            'TGL_LAHIR',
            'KELAMIN',
            'GOL_DARAH',
            'Agama',
            'Alamat',
            'KOTA',
            'TINGGAL',
            'SIPIL',
            'STAT_IS',
            'TGL_NIKAH',
            'TGL_CERAI',
            'KANDUNG',
            'ANGKAT',
            'TANGGUNG',
            'TGG_PPH',
            'KD_PEND',
            'TGL_SK',
            'NO_SK',
            'KD_KELAS',
            'KLS_TMT',
            'KLS_SK',
            'GOL',
            'MK',
            'GOL_TMT',
            'GOL_SK',
            'GPO',
            'KD_KBN',
            'KD_AFD',
            'KD_JAB',
            'NAMA_JAB',
            'KD_BUD',
            'JAB_TMT',
            'JAB_SK',
            'JAB_TGL',
            'ASTEK',
            'TASPEN',
            'NO_KK',
            'NO_NIK',
            'NO_BPJS',
            'TGL_MPP',
            'TGL_PEN',
            'MKTHN',
            'MKBLN',
            'MKHR',
            'MPP',
            'STAT_REC',
            'KD_BAGIAN',
            'KD_INSTANSI',
            'STS_ADMINISTRATIF',
            'NM_BAGIAN',
            'NM_SUBBAGIAN',
            'EMPLOYEESUBGRUP',
            'UMK',
            'KBN_ASAL',
            'PERS_GRADE',
            'JOB_GRADE',
            'KATEGORI',
            'NIK_SAP',
            'PLANT'
        ];
        $i=1;
        foreach ($dataallusers as $product) {
            $csvData[] = [
                $i++,
                $product->REG,
                $product->NAMA, 
                $product->NM_PGL,
                $product->GLR_DPN,
                $product->GLR_BLK,
                $product->TPT_LAHIR,
                $product->TGL_LAHIR,
                $product->KELAMIN,
                $product->GOL_DARAH,
                $product->Agama,
                $product->Alamat,
                $product->KOTA,
                $product->TINGGAL,
                $product->SIPIL,
                $product->STAT_IS,
                $product->TGL_NIKAH,
                $product->TGL_CERAI,
                $product->KANDUNG,
                $product->ANGKAT,
                $product->TANGGUNG,
                $product->TGG_PPH,
                $product->KD_PEND,
                $product->TGL_SK,
                $product->NO_SK,
                $product->KD_KELAS,
                $product->KLS_TMT,
                $product->KLS_SK,
                $product->GOL,
                $product->MK,
                $product->GOL_TMT,
                $product->GOL_SK,
                $product->GPO,
                $product->KD_KBN,
                $product->KD_AFD,
                $product->KD_JAB,
                $product->NAMA_JAB,
                $product->KD_BUD,
                $product->JAB_TMT,
                $product->JAB_SK,
                $product->JAB_TGL,
                $product->ASTEK,
                $product->TASPEN,
                $product->NO_KK,
                $product->NO_NIK,
                $product->NO_BPJS,
                $product->TGL_MPP,
                $product->TGL_PEN,
                $product->MKTHN,
                $product->MKBLN,
                $product->MKHR,
                $product->MPP,
                $product->STAT_REC,
                $product->KD_BAGIAN,
                $product->KD_INSTANSI,
                $product->STS_ADMINISTRATIF,
                $product->NM_BAGIAN,
                $product->NM_SUBBAGIAN,
                $product->EMPLOYEESUBGRUP,
                $product->UMK,
                $product->KBN_ASAL,
                $product->PERS_GRADE,
                $product->JOB_GRADE,
                $product->KATEGORI,
                $product->NIK_SAP,
                $product->PLANT
                ];
        }
        // $csvData = // your data fetching logic here
        
        foreach ($csvData as $row) {
            $columnLetter = 'A';
            foreach ($row as $cellValue) {
                $sheet->setCellValue($columnLetter++ . $rowNumber, $cellValue);
            }
            $rowNumber++;
        }
        $fileName = 'FileA1'.'.xlsx';
        // $fileName = 'filename.xlsx';
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Cache-Control' => 'max-age=0',
        ];
    
        $writer = new Xlsx($spreadsheet);
    
        $callback = function() use ($writer) {
            $writer->save('php://output');
        };
    
        return new StreamedResponse($callback, 200, $headers);
    }

    public function exportfilea1_tidakaktif(Request $request) {
        $tanggal      = $request->input('datepickerexport');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Assuming $csvData is an array of arrays, where each sub-array represents a row in the spreadsheet
        $dataallusers = DB::connection('sqlsrv')->table('File_A1_SQL_Backup')->where('STAT_REC',$tanggal)->whereRaw("STS_ADMINISTRATIF <> 'AKTIF'");
            // ->whereIn('tbl_bagian.kode_bagian',$bagian_yang_komoditasnya_karet)
            // ->whereRaw('(name like "Febri%" or password="1111")')
        $dataallusers = $dataallusers->get();

        $csvData[] = [
            'REG',
            'NAMA', 
            'NM_PGL',
            'GLR_DPN',
            'GLR_BLK',
            'TPT_LAHIR',
            'TGL_LAHIR',
            'KELAMIN',
            'GOL_DARAH',
            'Agama',
            'Alamat',
            'KOTA',
            'TINGGAL',
            'SIPIL',
            'STAT_IS',
            'TGL_NIKAH',
            'TGL_CERAI',
            'KANDUNG',
            'ANGKAT',
            'TANGGUNG',
            'TGG_PPH',
            'KD_PEND',
            'TGL_SK',
            'NO_SK',
            'KD_KELAS',
            'KLS_TMT',
            'KLS_SK',
            'GOL',
            'MK',
            'GOL_TMT',
            'GOL_SK',
            'GPO',
            'KD_KBN',
            'KD_AFD',
            'KD_JAB',
            'NAMA_JAB',
            'KD_BUD',
            'JAB_TMT',
            'JAB_SK',
            'JAB_TGL',
            'ASTEK',
            'TASPEN',
            'NO_KK',
            'NO_NIK',
            'NO_BPJS',
            'TGL_MPP',
            'TGL_PEN',
            'MKTHN',
            'MKBLN',
            'MKHR',
            'MPP',
            'STAT_REC',
            'KD_BAGIAN',
            'KD_INSTANSI',
            'STS_ADMINISTRATIF',
            'NM_BAGIAN',
            'NM_SUBBAGIAN',
            'EMPLOYEESUBGRUP',
            'UMK',
            'KBN_ASAL',
            'PERS_GRADE',
            'JOB_GRADE',
            'KATEGORI',
            'NIK_SAP',
            'PLANT'
        ];
        $i=1;
        foreach ($dataallusers as $product) {
            $csvData[] = [
                $i++,
                $product->REG,
                $product->NAMA, 
                $product->NM_PGL,
                $product->GLR_DPN,
                $product->GLR_BLK,
                $product->TPT_LAHIR,
                $product->TGL_LAHIR,
                $product->KELAMIN,
                $product->GOL_DARAH,
                $product->Agama,
                $product->Alamat,
                $product->KOTA,
                $product->TINGGAL,
                $product->SIPIL,
                $product->STAT_IS,
                $product->TGL_NIKAH,
                $product->TGL_CERAI,
                $product->KANDUNG,
                $product->ANGKAT,
                $product->TANGGUNG,
                $product->TGG_PPH,
                $product->KD_PEND,
                $product->TGL_SK,
                $product->NO_SK,
                $product->KD_KELAS,
                $product->KLS_TMT,
                $product->KLS_SK,
                $product->GOL,
                $product->MK,
                $product->GOL_TMT,
                $product->GOL_SK,
                $product->GPO,
                $product->KD_KBN,
                $product->KD_AFD,
                $product->KD_JAB,
                $product->NAMA_JAB,
                $product->KD_BUD,
                $product->JAB_TMT,
                $product->JAB_SK,
                $product->JAB_TGL,
                $product->ASTEK,
                $product->TASPEN,
                $product->NO_KK,
                $product->NO_NIK,
                $product->NO_BPJS,
                $product->TGL_MPP,
                $product->TGL_PEN,
                $product->MKTHN,
                $product->MKBLN,
                $product->MKHR,
                $product->MPP,
                $product->STAT_REC,
                $product->KD_BAGIAN,
                $product->KD_INSTANSI,
                $product->STS_ADMINISTRATIF,
                $product->NM_BAGIAN,
                $product->NM_SUBBAGIAN,
                $product->EMPLOYEESUBGRUP,
                $product->UMK,
                $product->KBN_ASAL,
                $product->PERS_GRADE,
                $product->JOB_GRADE,
                $product->KATEGORI,
                $product->NIK_SAP,
                $product->PLANT
                ];
        }
        // $csvData = // your data fetching logic here
        $rowNumber = 1;
        foreach ($csvData as $row) {
            $columnLetter = 'A';
            foreach ($row as $cellValue) {
                $sheet->setCellValue($columnLetter++ . $rowNumber, $cellValue);
            }
            $rowNumber++;
        }
        $fileName = 'FileA1_TidakAktif'.'.xlsx';
        // $fileName = 'filename.xlsx';
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Cache-Control' => 'max-age=0',
        ];
    
        $writer = new Xlsx($spreadsheet);
    
        $callback = function() use ($writer) {
            $writer->save('php://output');
        };
    
        return new StreamedResponse($callback, 200, $headers);
    }

    public function func_generate_fileA1(Request $request){
        $tanggal = $request->input('datepickergenerate');
        try {
            DB::select("SET NOCOUNT ON ; exec Buat_File_A1 '$tanggal'");
            return redirect('/reportdata/data_file_a1')->with('sukses','Berhasil Generate Data File A1');
        } catch (\Exception $e) {
            return back()->with('sukses','Berhasil Generate Data File A1');
        }
    }

    public function getdemografi(Request $request)
    {
        $tanggaltransaksi      = $request->input('TglInput');
        $current_month=Carbon::now()->month;
        $current_year=Carbon::now()->year;

        //$uraian_cashin = DB::connection('sqlsrv')->table('DashboardBOM_CashFlowPTPNVIII')->select('Uraian') 
        //->whereRaw("Tanggal='2023-04-03'")
        //->pluck('Uraian');
        $searchtanggal = Carbon::now();
        
        if(isset($_COOKIE['TglTransaksi']) and $_COOKIE['TglTransaksi']!=""){
            $searchtanggal = $_COOKIE['TglTransaksi'];  
        }

        $rows_pendidikan = DB::select("SET NOCOUNT ON ; exec Demografi_Pendidikan '$searchtanggal'");

        $column_pendidikan = [];
        foreach ($rows_pendidikan as $row) {
            $column_pendidikan['categories'][] = $row->Level_Jabatan;
            $column_pendidikan['data'][] = floatval($row->SD);
            $column_pendidikan['data2'][] = floatval($row->SMP);
            $column_pendidikan['data3'][] = floatval($row->SMA);
            $column_pendidikan['data4'][] = floatval($row->D1);
            $column_pendidikan['data5'][] = floatval($row->D2);
            $column_pendidikan['data6'][] = floatval($row->D3);
            $column_pendidikan['data7'][] = floatval($row->S1);
            $column_pendidikan['data8'][] = floatval($row->S2);
            $column_pendidikan['data9'][] = floatval($row->S3);
        }

        $rows_grading = DB::select("SET NOCOUNT ON ; exec Demografi_Grading '$searchtanggal'");

        $column_grading = [];
        foreach ($rows_grading as $row) {
            $column_grading['categories'][] = $row->Level_Jabatan;
            $column_grading['data'][] = floatval($row->NG);
            $column_grading['data2'][] = floatval($row->G_6);
            $column_grading['data3'][] = floatval($row->G_7);
            $column_grading['data4'][] = floatval($row->G_8);
            $column_grading['data5'][] = floatval($row->G_9);
            $column_grading['data6'][] = floatval($row->G_10);
            $column_grading['data7'][] = floatval($row->G_11);
            $column_grading['data8'][] = floatval($row->G_12);
            $column_grading['data9'][] = floatval($row->G_13);
            $column_grading['data10'][] = floatval($row->G_14);
            $column_grading['data11'][] = floatval($row->G_15);
            $column_grading['data12'][] = floatval($row->G_16);
            $column_grading['data13'][] = floatval($row->G_17);
            $column_grading['data14'][] = floatval($row->G_18);
            $column_grading['data15'][] = floatval($row->G_19);
            $column_grading['data16'][] = floatval($row->G_20);
            $column_grading['data17'][] = floatval($row->G_21);
            $column_grading['data18'][] = floatval($row->G_22);
        }

        $rows_usia = DB::select("SET NOCOUNT ON ; exec Demografi_Usia '$searchtanggal'");

        $column_usia = [];
        foreach ($rows_usia as $row) {
            $column_usia['categories'][] = $row->Level_Jabatan;
            $column_usia['data'][] = floatval($row->Dibawah26);
            $column_usia['data2'][] = floatval($row->umur26sd30);
            $column_usia['data3'][] = floatval($row->umur31sd35);
            $column_usia['data4'][] = floatval($row->umur36sd40);
            $column_usia['data5'][] = floatval($row->umur41sd45);
            $column_usia['data6'][] = floatval($row->umur46sd50);
            $column_usia['data7'][] = floatval($row->Diatas50);
        }

        $rows_gender = DB::select("SET NOCOUNT ON ; exec Demografi_Gender '$searchtanggal'");

        $column_gender = [];
        foreach ($rows_gender as $row) {
            $column_gender['categories'][] = $row->Level_Jabatan;
            $column_gender['data'][] = floatval($row->L);
            $column_gender['data2'][] = floatval($row->P);

        }

        $rows_unit = DB::select("SET NOCOUNT ON ; exec Demografi_Unit '$searchtanggal'");

        $column_unit = [];
        foreach ($rows_unit as $row) {
            $column_unit['categories'][] = $row->Level_Jabatan;
            $column_unit['data'][] = floatval($row->Kanpus);
            $column_unit['data2'][] = floatval($row->Distrik);
            $column_unit['data3'][] = floatval($row->Kebun);
            $column_unit['data4'][] = floatval($row->Pabrik);
            $column_unit['data5'][] = floatval($row->Penugasan);
            $column_unit['data6'][] = floatval($row->MBT);
            $column_unit['data7'][] = floatval($row->CDT);
        }

        //dd($column_unit);


        return view('reportdata.demografi',compact('searchtanggal','column_pendidikan','column_grading','column_usia','column_gender','column_unit'));
    }

    public function talent()
    {
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');
        $datajab = DB::connection('sqlsrv')
        ->table('File_A1_SQL_Backup')
        ->distinct()
        ->select('nama_jab')
        ->whereyear('stat_rec',$year)
        ->wheremonth('stat_rec',$month)
        ->whereRaw('job_grade > 11')
        ->orderby('nama_jab')
        ->get();     
      
        // $searchnama = "";
        $searchjab = "";
        $searchpendik = "";
        $searchmaker = "";
        $searchmaker2 = "";
        
        // $datauser = "";
        if(isset($_COOKIE['jabcari']) and $_COOKIE['jabcari']!=""){
            $searchjab = $_COOKIE['jabcari'];  
        }

        if(isset($_COOKIE['pendikcari']) and $_COOKIE['pendikcari']!=""){
            $searchpendik = $_COOKIE['pendikcari'];  
        }

        if(isset($_COOKIE['makercari']) and $_COOKIE['makercari']!=""){
            $searchmaker = $_COOKIE['makercari'];
            
            $searchmaker2 = $searchmaker + 9;
           
        }

        $dataallusers = DB::connection('sqlsrv')
        ->table('File_A1_SQL_Backup')
        ->whereyear('stat_rec',$year)
        ->wheremonth('stat_rec',$month)
        ->where('nama_jab',$searchjab)
        ->where('kd_pend',$searchpendik)
        ->whereRaw("lamakerja >='$searchmaker' and lamakerja <='$searchmaker2'")
        ->orderby('nama')
        ->get();   

        //dd($dataallusers);
        return view('reportdata.talent',compact('datajab','searchjab','searchpendik','searchmaker','searchmaker2','dataallusers'));  
    }

      
}
