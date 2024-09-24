<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;

use DB;

class TehRelasiController extends Controller
{
    public function dashsdm01()
    {
        $datakebun = DB::connection('sqlsrv_spdk')->table('tehrelasi')->where('bagian',Auth::user()->lokasiunit)->get();
  
            // ->whereRaw('(name like "Febri%" or password="1111")')
            $searchnama = "";
            $searchkebun = "";
            $datauser = "";
            if(isset($_COOKIE['kebuncari']) and $_COOKIE['kebuncari']!=""){
                $searchkebun = $_COOKIE['kebuncari'];  
            }
    
            if(isset($_COOKIE['namasearch']) and $_COOKIE['namasearch']!=""){
                $searchnama = $_COOKIE['namasearch'];  
            }
    
            $datauser = DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP','like',$searchnama)->get();
            $datasdm01_cari = DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP','like',$searchnama)->get();
            $dataallusers = DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP','like',$searchnama)->get();           
        
        return view('masterdata.sdm01',compact('datakebun','searchnama','searchkebun','datauser','datasdm01_cari','dataallusers'));
    }

    public function exportsdm01()
    {
        $dataallusers = DB::connection('sqlsrv')->table('sdm01_backup')->get();

        // $products = Product::all();
        $csvFileName = 'sdm01.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment;  filename="' . $csvFileName . '"',
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, [
            'No',
            'Kode Plant', 
            'Nama sdm01',
            'Regional',
            'Provinsi',
            'Kabupaten'
        ]); // Add more headers as needed
        $i=1;
        foreach ($dataallusers as $product) {
            fputcsv($handle, [
                $i++,
                $product->regional,
                $product->nama_sdm01,
                $product->region, 
                $product->provinsi,
                $product->kabupaten
                ]
            ); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }

    public function get_data_sdm01($id = null){
        $datauser= DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP',$id)->first();
        return response()->json($datauser);
    }

    public function view_detail_sdm01($id = null){
        //dd($id);
        $datauser= DB::connection('sqlsrv')->table('sdm01_backup')->where('id',$id)->first('nama');
        if($id){
            
            if(isset($datauser)){
                return view('masterdata.detail_sdm01', compact('datauser'));
            }
            else{
                return view('masterdata.detail_sdm01', compact('datauser'));
            }
            
        }
        else{
            return view('masterdata.detail_sdm01', compact('datauser'));
        }
        
    }

    public function func_storesdm01(Request $request){
        $user=Auth::user();
        $namafotos = $request->Foto;
        $namafoto = $request->NPP.'.'.$namafotos->getClientOriginalExtension();
        $namafotos->move(public_path('fotokaryawan'), $namafoto); // move files to destination folder

        //$namafoto->move(public_path().'/fotokaryawan', $namafoto);
        $adddokumen=[
            'NPP'=> $request->NPP,
            'RegSAP'=>$request->RegSAP,            
            'Nama'=>$request->Nama,
            'GlrDepan'=>$request->GlrDepan,
            'GlrBelakang'=>$request->GlrBelakang,
            'NamaPanggilan'=>$request->NamaPanggilan,
            'KotaLahir'=>$request->KotaLahir,
            'Propinsi'=>$request->Propinsi,
            'Negara'=>$request->Negara,
            'TglLahir'=>$request->TglLahir,
            'JenisKelamin'=>$request->JenisKelamin,
            'GolDarah'=>$request->GolDarah,
            'Agama'=>$request->Agama,
            'TglMasuk'=>$request->TglMasuk,
            'StatSipil'=>$request->StatSipil,
            'NPWP'=>$request->NPWP,
            'Alamat'=>$request->Alamat,
            'KodePos'=>$request->KodePos,
            'NoTelp'=>$request->NoTelp,
            'Jenis_AsPens'=>$request->Jenis_AsPens,
            'Nomor_AsPens'=>$request->Nomor_AsPens,
            'Nomor_BPJSTK'=>$request->Nomor_BPJSTK,
            'Nomor_BPJSKS'=>$request->Nomor_BPJSKS,
            'KodeBank'=>$request->KodeBank,
            'NoAccBank'=>$request->NoAccBank,
            'AtasNama'=>$request->AtasNama,
            'NoKTP'=>$request->NoKTP,
            'NoKK'=>$request->NoKK,
            'Email'=>$request->Email,
            'Sosmed'=>$request->Sosmed,
            'Foto'=>$namafoto,
            'UserId'=>Auth::user()->email,
            'TglInput'=>Carbon::now()->format('Y-m-d')

        ];
        // $id = DB::connection('mysql')->table('stakeholder')->insert($addstakeholder);
        try {
            $id = DB::connection('sqlsrv')->table('sdm01_backup')->insert($adddokumen);
            return redirect('/masterdata/sdm01')->with('sukses','Berhasil Menambahkan Data sdm01');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
        }
    }

    public function func_updatesdm01(Request $request){
        $idnourut = $request->NPP;
        $namafotos = $request->Foto;
        $namafoto = $request->NPP.'.'.$namafotos->getClientOriginalExtension();
        $namafotos->move(public_path('fotokaryawan'), $namafoto); // move files to destination folder
        $adddokumen=[
            'NPP'=> $request->NPP,
            'RegSAP'=>$request->RegSAP,            
            'Nama'=>$request->Nama,
            'GlrDepan'=>$request->GlrDepan,
            'GlrBelakang'=>$request->GlrBelakang,
            'NamaPanggilan'=>$request->NamaPanggilan,
            'KotaLahir'=>$request->KotaLahir,
            'Propinsi'=>$request->Propinsi,
            'Negara'=>$request->Negara,
            'TglLahir'=>$request->TglLahir,
            'JenisKelamin'=>$request->JenisKelamin,
            'GolDarah'=>$request->GolDarah,
            'Agama'=>$request->Agama,
            'TglMasuk'=>$request->TglMasuk,
            'StatSipil'=>$request->StatSipil,
            'NPWP'=>$request->NPWP,
            'Alamat'=>$request->Alamat,
            'KodePos'=>$request->KodePos,
            'NoTelp'=>$request->NoTelp,
            'Jenis_AsPens'=>$request->Jenis_AsPens,
            'Nomor_AsPens'=>$request->Nomor_AsPens,
            'Nomor_BPJSTK'=>$request->Nomor_BPJSTK,
            'Nomor_BPJSKS'=>$request->Nomor_BPJSKS,
            'KodeBank'=>$request->KodeBank,
            'NoAccBank'=>$request->NoAccBank,
            'AtasNama'=>$request->AtasNama,
            'NoKTP'=>$request->NoKTP,
            'NoKK'=>$request->NoKK,
            'Email'=>$request->Email,
            'Sosmed'=>$request->Sosmed,
            'Foto' => $namafoto,
            'UserId'=>Auth::user()->email,
            'TglInput'=>Carbon::now()->format('Y-m-d')
        ];
        // dd($adddokumen);
        try {
            DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP',$idnourut)->update($adddokumen);
            return redirect('/masterdata/sdm01')->with('sukses','Berhasil Merubah Data sdm01');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
        }
        // DB::connection('mysql')->table('stakeholder')->where('id',$idnourut)->update($addstakeholder);
        // return redirect('/dash/stakeholder');
    }

    public function func_deletesdm01($id = null){
        DB::connection('sqlsrv')->table('sdm01_backup')->where('id',$id)->delete();
        return redirect('/masterdata/sdm01')->with('suksesdelete','Berhasil Menghapus Data sdm01');

    }

    // public function getkodekebun($id = null){
    //     $month = Carbon::now()->format('m');
    //     $year = Carbon::now()->format('Y');
    //     $datauser = "";
    //     //$datauser= DB::connection('sqlsrv')->table('File_A1_SQL')->where('KD_KBN',$id)->whereRaw('MONTH(STAT_REC)=?',[$month])->whereRaw('YEAR(STAT_REC)=?',[$year])->get();
    //     $datauser= DB::connection('sqlsrv')->table('File_A1_SQL')->where('KD_KBN',$id)->where('STS_ADMINISTRATIF','AKTIF')->wheremonth('STAT_REC',$month)->whereyear('STAT_REC',$year)->get();

    //     return response()->json($datauser);
        
    // }
 
    // public function getkodekebun($id = null){
    //     $datauser="";        
    //     $datauser= DB::connection('sqlsrv')->table('Ref_Bagian')->where('kd_unit',$id)->where('Status','1')->get();
    // //     return response()->json($datauser);

    //     return response()->json($datauser);
        
    // }   


   // -------------- MASTER DATA SDM02
   public function dashsdm02()
    {
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');
        $datakebun = DB::connection('sqlsrv')->table('ref_kebun')->where('status',1)->get();        
 
        $searchnama = "";
        $searchkebun = "";
        $datauser = "";
        if(isset($_COOKIE['kebuncari']) and $_COOKIE['kebuncari']!=""){
            $searchkebun = $_COOKIE['kebuncari'];  
        }

        if(isset($_COOKIE['namasearch']) and $_COOKIE['namasearch']!=""){
            $searchnama = $_COOKIE['namasearch'];  
        }
        $lokasikerja = Auth::user()->lokasiunit;
        //dd($lokasikerja);
        $datacarinama= DB::connection('sqlsrv')->table('File_A1_SQL')->where('KD_KBN',$lokasikerja)->where('STS_ADMINISTRATIF','AKTIF')->wheremonth('STAT_REC',$month)->whereyear('STAT_REC',$year)->orderby('nama')->get();
        $datauser = DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP','like',$searchnama)->get();
        $datasdm01_cari = DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP','like',$searchnama)->get();
        $dataallusers = DB::connection('sqlsrv')->table('sdm02_backup')->where('NPP','like',$searchnama)->orderbydesc('tgllahir')->get();   
        return view('masterdata.sdm02',compact('datakebun','searchnama','searchkebun','datauser','datasdm01_cari','dataallusers','datacarinama'));    

        
    }

    public function exportsdm02()
    {
        $dataallusers = DB::connection('mysql')->table('m_perizinan');
            // ->whereIn('tbl_bagian.kode_bagian',$bagian_yang_komoditasnya_karet)
            // ->whereRaw('(name like "Febri%" or password="1111")')
        $searchperizinan = "";

        $datajenisperizinan = DB::table('m_perizinan')->select('nama')->get();
            
        if(isset($_COOKIE['perizinan']) and $_COOKIE['perizinan']!=""){
            $searchperizinan = $_COOKIE['perizinan'];
            $dataallusers = $dataallusers->where('nama','like',$_COOKIE['perizinan']);
        }
        $dataallusers = $dataallusers->get();

        // $products = Product::all();
        $csvFileName = 'master_perizinan '.$searchperizinan.''.date('Ymd').'.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment;  filename="' . $csvFileName . '"',
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, [
            'No',
            'Nama', 
            'Status',
            'Jenis Perizinan'
        ]); // Add more headers as needed
        $i=1;
        foreach ($dataallusers as $product) {
            fputcsv($handle, [
                $i++,
                $product->nama,
                $product->status, 
                $product->jenis_perizinan
                ]
            ); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }

    public function get_data_sdm02($id = null){
        $datauser= DB::connection('sqlsrv')->table('sdm02_backup')->where('NoId',$id)->first();
        return response()->json($datauser);
    }

    public function func_storesdm02(Request $request){
        $adddokumen=[
            'NPP'=> $request->NPPClass,
            'Nama'=>$request->Nama,
            'Hubungan'=>$request->Hubungan,
            'TglLahir'=>$request->TglLahir,
            'Kota'=>$request->Kota,
            'Propinsi'=>$request->Propinsi,
            'Negara'=>$request->Negara,           
            'JenisKelamin'=>$request->JenisKelamin,
            'GolDarah'=>$request->GolDarah,
            'Agama'=>$request->Agama,
            'TKPendidikan'=>$request->TKPendidikan,
            'StatSipil'=>$request->StatSipil,
            'StatKerja'=>$request->StatKerja,
            'TglNikah'=>$request->TglNikah,
            'TglCerai'=>$request->TglCerai,
            'StatTanggung'=>$request->StatTanggung,
            'NIK'=>$request->NIK,
            'NoBPJSKes'=>$request->NoBPJSKes,
            'UserId'=>Auth::user()->email,
            'TglInput'=>Carbon::now()->format('Y-m-d')
        ];
        // dd($adddokumen);
        // $id = DB::connection('mysql')->table('stakeholder')->insert($addstakeholder);
        try {
            $id = DB::connection('sqlsrv')->table('sdm02_backup')->insert($adddokumen);
            return redirect('/masterdata/sdm02')->with('sukses','Berhasil Menambahkan Data Keluarga');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
        }
    }

    public function func_updatesdm02(Request $request){
        $id = $request->NoId;
        
        $adddokumen=[
            'NPP'=> $request->NPP,
            'Nama'=>$request->Nama,
            'Hubungan'=>$request->Hubungan,
            'TglLahir'=>$request->TglLahir,
            'Kota'=>$request->Kota,
            'Propinsi'=>$request->Propinsi,
            'Negara'=>$request->Negara,           
            'JenisKelamin'=>$request->JenisKelamin,
            'GolDarah'=>$request->GolDarah,
            'Agama'=>$request->Agama,
            'TKPendidikan'=>$request->TKPendidikan,
            'StatSipil'=>$request->StatSipil,
            'StatKerja'=>$request->StatKerja,
            'TglNikah'=>$request->TglNikah,
            'TglCerai'=>$request->TglCerai,
            'StatTanggung'=>$request->StatTanggung,
            'NIK'=>$request->NIK,
            'NoBPJSKes'=>$request->NoBPJSKes,
            'UserId'=>Auth::user()->email,
            'TglInput'=>Carbon::now()->format('Y-m-d')

        ];

        try {
            DB::connection('sqlsrv')->table('sdm02_backup')->where('Noid',$id)->update($adddokumen);
            return redirect('/masterdata/sdm02')->with('sukses','Berhasil Merubah Data Keluarga');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
        }
    }

    public function func_deletesdm02($id = null){
        try {
            DB::connection('sqlsrv')->table('sdm02_backup')->where('Noid',$id)->delete();
            return redirect('/masterdata/sdm02')->with('sukses','Berhasil Menghapus Data Keluarga');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
        }

    }  

   // -------------- MASTER DATA SDM03

   public function dashsdm03()
    {
        $datakebun = DB::connection('sqlsrv')->table('ref_kebun')->where('status',1)->get();        
 
        $searchnama = "";
        $searchkebun = "";
        $datauser = "";
        if(isset($_COOKIE['kebuncari']) and $_COOKIE['kebuncari']!=""){
            $searchkebun = $_COOKIE['kebuncari'];  
        }

        if(isset($_COOKIE['namasearch']) and $_COOKIE['namasearch']!=""){
            $searchnama = $_COOKIE['namasearch'];  
        }

        $datauser = DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP','like',$searchnama)->get();
        $datasdm01_cari = DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP','like',$searchnama)->get();
        $dataallusers = DB::connection('sqlsrv')->table('sdm03_backup')->where('NPP','like',$searchnama)->orderbydesc('tahun')->get();   
        return view('masterdata.sdm03',compact('datakebun','searchnama','searchkebun','datauser','datasdm01_cari','dataallusers'));   

        
    }

    public function exportsdm03()
    {
        $dataallusers = DB::connection('mysql')->table('m_perizinan');
            // ->whereIn('tbl_bagian.kode_bagian',$bagian_yang_komoditasnya_karet)
            // ->whereRaw('(name like "Febri%" or password="1111")')
        $searchperizinan = "";

        $datajenisperizinan = DB::table('m_perizinan')->select('nama')->get();
            
        if(isset($_COOKIE['perizinan']) and $_COOKIE['perizinan']!=""){
            $searchperizinan = $_COOKIE['perizinan'];
            $dataallusers = $dataallusers->where('nama','like',$_COOKIE['perizinan']);
        }
        $dataallusers = $dataallusers->get();

        // $products = Product::all();
        $csvFileName = 'master_perizinan '.$searchperizinan.''.date('Ymd').'.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment;  filename="' . $csvFileName . '"',
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, [
            'No',
            'Nama', 
            'Status',
            'Jenis Perizinan'
        ]); // Add more headers as needed
        $i=1;
        foreach ($dataallusers as $product) {
            fputcsv($handle, [
                $i++,
                $product->nama,
                $product->status, 
                $product->jenis_perizinan
                ]
            ); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }

    public function get_data_sdm03($id = null){
        $datauser= DB::connection('sqlsrv')->table('sdm03_backup')->where('NoId',$id)->first();
        return response()->json($datauser);
    }

    public function func_storesdm03(Request $request){
        $adddokumen=[
            'NPP'=> $request->NPP,
            'Pendidikan'=>$request->Pendidikan,
            'Nama'=>$request->Nama,
            'Kota'=>$request->Kota,
            'Prodi'=>$request->Prodi,            
            'StatAkreditasi'=>$request->StatAkreditasi,
            'Tahun'=>$request->Tahun,
            'NoIjasah'=>$request->NoIjasah,
            'TglIjasah'=>$request->TglIjasah,
            'UserId'=>Auth::user()->email,
            'TglInput'=>Carbon::now()->format('Y-m-d')

        ];
        // $id = DB::connection('mysql')->table('stakeholder')->insert($addstakeholder);
        try {
            $id = DB::connection('sqlsrv')->table('sdm03_backup')->insert($adddokumen);
            return redirect('/masterdata/sdm03')->with('sukses','Berhasil Menambahkan Data Pendidikan');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
        }
    }

    public function func_updatesdm03(Request $request){
        $id = $request->NoId;
        $adddokumen=[
            'NPP'=> $request->NPP,
            'Pendidikan'=>$request->Pendidikan,
            'Nama'=>$request->Nama,
            'Kota'=>$request->Kota,
            'Prodi'=>$request->Prodi,            
            'StatAkreditasi'=>$request->StatAkreditasi,
            'Tahun'=>$request->Tahun,
            'NoIjasah'=>$request->NoIjasah,
            'TglIjasah'=>$request->TglIjasah,
            'UserId'=>Auth::user()->email,
            'TglInput'=>Carbon::now()->format('Y-m-d')

        ];
        try {
            DB::connection('sqlsrv')->table('sdm03_backup')->where('Noid',$id)->update($adddokumen);
            return redirect('/masterdata/sdm03')->with('sukses','Berhasil Merubah Data Pendidikan');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
        }
    }

    public function func_deletesdm03($id = null){
        try {
            DB::connection('sqlsrv')->table('sdm03_backup')->where('Noid',$id)->delete();
            return redirect('/masterdata/sdm03')->with('sukses','Berhasil Menghapus Data Pendidikan');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
        }

    }      

   // -------------- MASTER DATA SDM04

   public function dashsdm04()
    {
        $datakebun = DB::connection('sqlsrv')->table('ref_kebun')->where('status',1)->get();        
 
        $searchnama = "";
        $searchkebun = "";
        $datauser = "";
        if(isset($_COOKIE['kebuncari']) and $_COOKIE['kebuncari']!=""){
            $searchkebun = $_COOKIE['kebuncari'];  
        }

        if(isset($_COOKIE['namasearch']) and $_COOKIE['namasearch']!=""){
            $searchnama = $_COOKIE['namasearch'];  
        }

        $datauser = DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP','like',$searchnama)->get();
        $datasdm01_cari = DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP','like',$searchnama)->get();
        $dataallusers = DB::connection('sqlsrv')->table('sdm04_backup')->where('NPP','like',$searchnama)->orderbydesc('Tahun')->get();   
        return view('masterdata.sdm04',compact('datakebun','searchnama','searchkebun','datauser','datasdm01_cari','dataallusers'));   

        
    }

    // public function exportsdm04()
    // {
    //     $dataallusers = DB::connection('mysql')->table('m_perizinan');
    //         // ->whereIn('tbl_bagian.kode_bagian',$bagian_yang_komoditasnya_karet)
    //         // ->whereRaw('(name like "Febri%" or password="1111")')
    //     $searchperizinan = "";

    //     $datajenisperizinan = DB::table('m_perizinan')->select('nama')->get();
            
    //     if(isset($_COOKIE['perizinan']) and $_COOKIE['perizinan']!=""){
    //         $searchperizinan = $_COOKIE['perizinan'];
    //         $dataallusers = $dataallusers->where('nama','like',$_COOKIE['perizinan']);
    //     }
    //     $dataallusers = $dataallusers->get();

    //     // $products = Product::all();
    //     $csvFileName = 'master_perizinan '.$searchperizinan.''.date('Ymd').'.csv';
    //     $headers = [
    //         'Content-Type' => 'text/csv',
    //         'Content-Disposition' => 'attachment;  filename="' . $csvFileName . '"',
    //         "Pragma" => "no-cache",
    //         "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
    //         "Expires" => "0"
    //     ];

    //     $handle = fopen('php://output', 'w');
    //     fputcsv($handle, [
    //         'No',
    //         'Nama', 
    //         'Status',
    //         'Jenis Perizinan'
    //     ]); // Add more headers as needed
    //     $i=1;
    //     foreach ($dataallusers as $product) {
    //         fputcsv($handle, [
    //             $i++,
    //             $product->nama,
    //             $product->status, 
    //             $product->jenis_perizinan
    //             ]
    //         ); // Add more fields as needed
    //     }

    //     fclose($handle);

    //     return Response::make('', 200, $headers);
    // }

    public function get_data_sdm04($id = null){
        $datauser= DB::connection('sqlsrv')->table('sdm04_backup')->where('NoId',$id)->first();
        return response()->json($datauser);
    }

    public function func_storesdm04(Request $request){
        $adddokumen=[
            'NPP'=> $request->NPP,
            'Pelatihan'=>$request->Pelatihan,
            'Nama'=>$request->Nama,
            'Kota'=>$request->Kota,
            'Tahun'=>$request->Tahun,
            'NoSertifikat'=>$request->NoSertifikat,
            'TglSertifikat'=>$request->TglSertifikat,
            'UserId'=>Auth::user()->email,
            'TglInput'=>Carbon::now()->format('Y-m-d')

        ];
        // $id = DB::connection('mysql')->table('stakeholder')->insert($addstakeholder);
        try {
            $id = DB::connection('sqlsrv')->table('sdm04_backup')->insert($adddokumen);
            return redirect('/masterdata/sdm04')->with('sukses','Berhasil Menambahkan Data Pelatihan');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
        }
    }

    public function func_updatesdm04(Request $request){
        $id = $request->NoId;
        $adddokumen=[
            'NPP'=> $request->NPP,
            'Pelatihan'=>$request->Pelatihan,
            'Nama'=>$request->Nama,
            'Kota'=>$request->Kota,
            'Tahun'=>$request->Tahun,
            'NoSertifikat'=>$request->NoSertifikat,
            'TglSertifikat'=>$request->TglSertifikat,
            'UserId'=>Auth::user()->email,
            'TglInput'=>Carbon::now()->format('Y-m-d')

        ];
        try {
            DB::connection('sqlsrv')->table('sdm04_backup')->where('Noid',$id)->update($adddokumen);
            return redirect('/masterdata/sdm04')->with('sukses','Berhasil Merubah Data Pelatihan');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
        }
    }

    public function func_deletesdm04($id = null){
        try {
            DB::connection('sqlsrv')->table('sdm04_backup')->where('Noid',$id)->delete();
            return redirect('/masterdata/sdm04')->with('sukses','Berhasil Menghapus Data Pelatihan');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
        }

    }      

   // -------------- MASTER DATA SDM08

   public function dashsdm08()
    {
        $datajaball = DB::connection('sqlsrv')->table('Ref_KodeJabatan')->orderBy('uraian')->get();
        $dataunitall = DB::connection('sqlsrv')
        ->table('Ref_Kebun')
        ->where('status','1')
        ->orderBy('Kd_Unit')->get();

        $databagian = DB::connection('sqlsrv')
        ->table('Ref_Bagian')
        ->where('status','1')
        ->orderBy('Kd_Bagian')->get();

        $dataafdeling = DB::connection('sqlsrv')
        ->table('Ref_Afdeling')
        ->orderBy('Kd_Afd')->get();        

        $datainstansi = DB::connection('sqlsrv')
        ->table('Ref_Instansi')
        ->orderBy('Nm_Instansi')->get();        

        $datakebun = DB::connection('sqlsrv')->table('ref_kebun')->where('status',1)->get();        
 
        $searchnama = "";
        $searchkebun = "";
        $datauser = "";
        if(isset($_COOKIE['kebuncari']) and $_COOKIE['kebuncari']!=""){
            $searchkebun = $_COOKIE['kebuncari'];  
        }

        if(isset($_COOKIE['namasearch']) and $_COOKIE['namasearch']!=""){
            $searchnama = $_COOKIE['namasearch'];  
        }

        $datauser = DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP','like',$searchnama)->get();
        $datasdm01_cari = DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP','like',$searchnama)->get();
        $dataallusers = DB::connection('sqlsrv')->table('sdm08_backup')->where('NPP','like',$searchnama)->orderbydesc('TMT')->get();   
        return view('masterdata.sdm08',compact('datakebun','searchnama','searchkebun','datauser','datasdm01_cari','dataallusers','dataunitall','datajaball','databagian','dataafdeling','datainstansi'));  

        
    }

    // public function exportsdm04()
    // {
    //     $dataallusers = DB::connection('mysql')->table('m_perizinan');
    //         // ->whereIn('tbl_bagian.kode_bagian',$bagian_yang_komoditasnya_karet)
    //         // ->whereRaw('(name like "Febri%" or password="1111")')
    //     $searchperizinan = "";

    //     $datajenisperizinan = DB::table('m_perizinan')->select('nama')->get();
            
    //     if(isset($_COOKIE['perizinan']) and $_COOKIE['perizinan']!=""){
    //         $searchperizinan = $_COOKIE['perizinan'];
    //         $dataallusers = $dataallusers->where('nama','like',$_COOKIE['perizinan']);
    //     }
    //     $dataallusers = $dataallusers->get();

    //     // $products = Product::all();
    //     $csvFileName = 'master_perizinan '.$searchperizinan.''.date('Ymd').'.csv';
    //     $headers = [
    //         'Content-Type' => 'text/csv',
    //         'Content-Disposition' => 'attachment;  filename="' . $csvFileName . '"',
    //         "Pragma" => "no-cache",
    //         "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
    //         "Expires" => "0"
    //     ];

    //     $handle = fopen('php://output', 'w');
    //     fputcsv($handle, [
    //         'No',
    //         'Nama', 
    //         'Status',
    //         'Jenis Perizinan'
    //     ]); // Add more headers as needed
    //     $i=1;
    //     foreach ($dataallusers as $product) {
    //         fputcsv($handle, [
    //             $i++,
    //             $product->nama,
    //             $product->status, 
    //             $product->jenis_perizinan
    //             ]
    //         ); // Add more fields as needed
    //     }

    //     fclose($handle);

    //     return Response::make('', 200, $headers);
    // }

    public function get_data_sdm08($id = null){
        $datauser= DB::connection('sqlsrv')->table('sdm08_backup')->where('NoId',$id)->first();
           return response()->json($datauser);

        // $dataafd= DB::connection('sqlsrv')->table('ref_afdeling')
        // ->where('Kd_Unit',$datauser[Kd_Unit])
        // ->where('Kd_Bagian',$datauser[Kd_Bagian])
        // ->first();
        // return view('masterdata.sdm08' ,compact('dataafd'));        
    }

    public function getkodekebun($id = null){
        $datauser= DB::connection('sqlsrv')->table('Ref_Bagian')->where('kd_unit',$id)->where('Status','1')->get();
        return response()->json($datauser);
        
    }

    public function getkodeafdeling($id = null){
        $datauser= DB::connection('sqlsrv')->table('Ref_Afdeling')->where('kd_unit',$id)->get();
        return response()->json($datauser);
        
    }

    public function getkodebagian($id = null){
        $datausersubbagian= DB::connection('sqlsrv')->table('Ref_Afdeling')->where('kd_bagian',$id)->where('Status',1)->get();
        return response()->json($datausersubbagian);
        
    }




    public function func_storesdm08(Request $request){
        $adddokumen=[
            'NPP'=> $request->NPP,
            'Kd_Mutasi'=> $request->Kd_Mutasi,
            'Kd_Unit'=> $request->Kd_UnitAdd,
            'Kd_Bagian'=> $request->Kd_BagianAdd,
            'Kd_Afd'=> $request->Kd_AfdAdd,
            'Kd_Bud'=> $request->Kd_Bud,
            'Kd_Jabatan'=> $request->Kd_Jabatan,
            'TMT'=> $request->TMT,
            'No_SK'=> $request->No_SK,
            'Tgl_SK'=> $request->Tgl_SK,
            'NmPejabat'=> $request->NmPejabat,
            'KdBranded'=> $request->KdBranded,
            'Sansos'=> $request->Sansos,
            'StatusKerja'=> $request->StatusKerja,
            'Kd_Instansi'=> $request->Kd_Instansi,
            'EmployeeSubGrup'=> $request->EmployeeSubGrup,
            'UserId'=>Auth::user()->email,
            'TglInput'=>Carbon::now()->format('Y-m-d')

        ];
        // $id = DB::connection('mysql')->table('stakeholder')->insert($addstakeholder);
        try {
            $id = DB::connection('sqlsrv')->table('sdm08_backup')->insert($adddokumen);
            return redirect('/masterdata/sdm08')->with('sukses','Berhasil Menambahkan Data Riwayat Jabatan');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
        }
    }

    public function func_updatesdm08(Request $request){
        $id = $request->NoId;
        $adddokumen=[
            'NPP'=> $request->NPP,
            'Kd_Mutasi'=> $request->Kd_Mutasi,
            'Kd_Unit'=> $request->Kd_UnitEdit,
            'Kd_Bagian'=> $request->Kd_BagianEdit,
            'Kd_Afd'=> $request->Kd_AfdEdit,
            'Kd_Bud'=> $request->Kd_Bud,
            'Kd_Jabatan'=> $request->Kd_Jabatan,
            'TMT'=> $request->TMT,
            'No_SK'=> $request->No_SK,
            'Tgl_SK'=> $request->Tgl_SK,
            'NmPejabat'=> $request->NmPejabat,
            'KdBranded'=> $request->KdBranded,
            'Sansos'=> $request->Sansos,
            'StatusKerja'=> $request->StatusKerja,
            'Kd_Instansi'=> $request->Kd_Instansi,
            'EmployeeSubGrup'=> $request->EmployeeSubGrup,
            'UserId'=>Auth::user()->email,
            'TglInput'=>Carbon::now()->format('Y-m-d')

        ];
        try {
            DB::connection('sqlsrv')->table('sdm08_backup')->where('Noid',$id)->update($adddokumen);
            return redirect('/masterdata/sdm08')->with('sukses','Berhasil Merubah Data Riwayat Jabatan');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
        }
    }

    public function func_deletesdm08($id = null){
        try {
            DB::connection('sqlsrv')->table('sdm08_backup')->where('Noid',$id)->delete();
            return redirect('/masterdata/sdm08')->with('sukses','Berhasil Menghapus Data Riwayat Jabatan');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
        }

    }      

   // -------------- MASTER DATA SDM16

   public function dashsdm16()
    {
        $datakebun = DB::connection('sqlsrv')->table('ref_kebun')->where('status',1)->get();        
 
        $searchnama = "";
        $searchkebun = "";
        $datauser = "";
        if(isset($_COOKIE['kebuncari']) and $_COOKIE['kebuncari']!=""){
            $searchkebun = $_COOKIE['kebuncari'];  
        }

        if(isset($_COOKIE['namasearch']) and $_COOKIE['namasearch']!=""){
            $searchnama = $_COOKIE['namasearch'];  
        }

        $datauser = DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP','like',$searchnama)->get();
        $datasdm01_cari = DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP','like',$searchnama)->get();
        $dataallusers = DB::connection('sqlsrv')->table('sdm16_backup')->where('NPP','like',$searchnama)->orderbydesc('TMT')->get();   
        return view('masterdata.sdm16',compact('datakebun','searchnama','searchkebun','datauser','datasdm01_cari','dataallusers'));   
        
    }

 
    public function get_data_sdm16($id = null){
        $datauser= DB::connection('sqlsrv')->table('sdm16_backup')->where('NoId',$id)->first();
        return response()->json($datauser);
    }

    public function func_storesdm16(Request $request){
        $adddokumen=[
            'NPP'=> $request->NPP,
            'NoId'=> $request->NoId,
            'Golongan'=> $request->Golongan,
            'MK'=> $request->MK,
            'TMT'=> $request->TMT,
            'NoSK'=> $request->NoSK,
            'TglSK'=> $request->TglSK,
            'NmPejabat'=> $request->NmPejabat,
            'UserId'=>Auth::user()->email,
            'TglInput'=>Carbon::now()->format('Y-m-d')

        ];
        // $id = DB::connection('mysql')->table('stakeholder')->insert($addstakeholder);
        try {
            $id = DB::connection('sqlsrv')->table('sdm16_backup')->insert($adddokumen);
            return redirect('/masterdata/sdm16')->with('sukses','Berhasil Menambahkan Data Riwayat Golongan (PHDP)');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
        }
    }

    public function func_updatesdm16(Request $request){
        $id = $request->NoId;
        $adddokumen=[
            'NPP'=> $request->NPP,
            'Golongan'=> $request->Golongan,
            'MK'=> $request->MK,
            'TMT'=> $request->TMT,
            'NoSK'=> $request->NoSK,
            'TglSK'=> $request->TglSK,
            'NmPejabat'=> $request->NmPejabat,
            'UserId'=>Auth::user()->email,
            'TglInput'=>Carbon::now()->format('Y-m-d')

        ];
        try {
            DB::connection('sqlsrv')->table('sdm16_backup')->where('Noid',$id)->update($adddokumen);
            return redirect('/masterdata/sdm16')->with('sukses','Berhasil Merubah Data Riwayat Golongan (PHDP)');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
        }
    }

    public function func_deletesdm16($id = null){
        try {
            DB::connection('sqlsrv')->table('sdm16_backup')->where('Noid',$id)->delete();
            return redirect('/masterdata/sdm16')->with('sukses','Berhasil Menghapus Data Riwayat Golongan (PHDP)');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
        }

    }      

       // -------------- MASTER DATA SDM15

   public function dashsdm15()
   {
       $datakebun = DB::connection('sqlsrv')->table('ref_kebun')->where('status',1)->get();        

       $searchnama = "";
       $searchkebun = "";
       $datauser = "";
       if(isset($_COOKIE['kebuncari']) and $_COOKIE['kebuncari']!=""){
           $searchkebun = $_COOKIE['kebuncari'];  
       }

       if(isset($_COOKIE['namasearch']) and $_COOKIE['namasearch']!=""){
           $searchnama = $_COOKIE['namasearch'];  
       }

       $datauser = DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP','like',$searchnama)->get();
       $datasdm01_cari = DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP','like',$searchnama)->get();
       $dataallusers = DB::connection('sqlsrv')->table('sdm15_backup')->where('NPP','like',$searchnama)->orderbydesc('TMT')->get();   
       return view('masterdata.sdm15',compact('datakebun','searchnama','searchkebun','datauser','datasdm01_cari','dataallusers'));   
       
   }


   public function get_data_sdm15($id = null){
       $datauser= DB::connection('sqlsrv')->table('sdm16_backup')->where('NoId',$id)->first();
       return response()->json($datauser);
   }

   public function func_storesdm15(Request $request){
       $adddokumen=[
           'NPP'=> $request->NPP,
           'NoId'=> $request->NoId,
           'PerGrade'=> $request->PerGrade,
           'TMT'=> $request->TMT,
           'NoSK'=> $request->NoSK,
           'TglSK'=> $request->TglSK,
           'NmPejabat'=> $request->NmPejabat,
           'UserId'=>Auth::user()->email,
           'TglInput'=>Carbon::now()->format('Y-m-d')

       ];
       // $id = DB::connection('mysql')->table('stakeholder')->insert($addstakeholder);
       try {
           $id = DB::connection('sqlsrv')->table('sdm15_backup')->insert($adddokumen);
           return redirect('/masterdata/sdm15')->with('sukses','Berhasil Menambahkan Data Person Grade');
       } catch (\Exception $e) {
           return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
       }
   }

   public function func_updatesdm15(Request $request){
       $id = $request->NoId;
       $adddokumen=[
           'NPP'=> $request->NPP,
           'PersGrade'=> $request->PresGrade,
           'TMT'=> $request->TMT,
           'NoSK'=> $request->NoSK,
           'TglSK'=> $request->TglSK,
           'NmPejabat'=> $request->NmPejabat,
           'UserId'=>Auth::user()->email,
           'TglInput'=>Carbon::now()->format('Y-m-d')

       ];
       try {
           DB::connection('sqlsrv')->table('sdm15_backup')->where('Noid',$id)->update($adddokumen);
           return redirect('/masterdata/sdm15')->with('sukses','Berhasil Merubah Data Person Grade');
       } catch (\Exception $e) {
           return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
       }
   }

   public function func_deletesdm15($id = null){
       try {
           DB::connection('sqlsrv')->table('sdm15_backup')->where('Noid',$id)->delete();
           return redirect('/masterdata/sdm15')->with('sukses','Berhasil Menghapus Data Person Grade');
       } catch (\Exception $e) {
           return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
       }

   }  
   
       // -------------- MASTER DATA SDM14

       public function dashsdm14()
       {
           $datakebun = DB::connection('sqlsrv')->table('ref_kebun')->where('status',1)->get();        
    
           $searchnama = "";
           $searchkebun = "";
           $datauser = "";
           if(isset($_COOKIE['kebuncari']) and $_COOKIE['kebuncari']!=""){
               $searchkebun = $_COOKIE['kebuncari'];  
           }
    
           if(isset($_COOKIE['namasearch']) and $_COOKIE['namasearch']!=""){
               $searchnama = $_COOKIE['namasearch'];  
           }
    
           $datauser = DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP','like',$searchnama)->get();
           $datasdm01_cari = DB::connection('sqlsrv')->table('sdm01_backup')->where('NPP','like',$searchnama)->get();
           $dataallusers = DB::connection('sqlsrv')->table('sdm14_backup')->where('NPP','like',$searchnama)->orderbydesc('TglSK')->get();   
           return view('masterdata.sdm14',compact('datakebun','searchnama','searchkebun','datauser','datasdm01_cari','dataallusers'));   
           
       }
    
    
       public function get_data_sdm14($id = null){
           $datauser= DB::connection('sqlsrv')->table('sdm14_backup')->where('NoId',$id)->first();
           return response()->json($datauser);
       }
    
       public function func_storesdm14(Request $request){
           $adddokumen=[
               'NPP'=> $request->NPP,
               'NoId'=> $request->NoId,
               'JnsHukuman'=> $request->JnsHukuman,
               'TglPelanggaran'=> $request->TglPelanggaran,
               'Uraian'=> $request->Uraian,
               'NoSK'=> $request->NoSK,
               'TglSK'=> $request->TglSK,
               'NmPejabat'=> $request->NmPejabat,
               'UserId'=>Auth::user()->email,
               'TglInput'=>Carbon::now()->format('Y-m-d')
    
           ];
           // $id = DB::connection('mysql')->table('stakeholder')->insert($addstakeholder);
           try {
               $id = DB::connection('sqlsrv')->table('sdm14_backup')->insert($adddokumen);
               return redirect('/masterdata/sdm14')->with('sukses','Berhasil Menambahkan Data Hukuman');
           } catch (\Exception $e) {
               return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
           }
       }
    
       public function func_updatesdm14(Request $request){
           $id = $request->NoId;
           $adddokumen=[
               'NPP'=> $request->NPP,
               'JnsHukuman'=> $request->JnsHukuman,
               'TglPelanggaran'=> $request->TglPelanggaran,
               'Uraian'=> $request->Uraian,
               'NoSK'=> $request->NoSK,
               'TglSK'=> $request->TglSK,
               'NmPejabat'=> $request->NmPejabat,
               'UserId'=>Auth::user()->email,
               'TglInput'=>Carbon::now()->format('Y-m-d')
    
           ];
           try {
               DB::connection('sqlsrv')->table('sdm14_backup')->where('Noid',$id)->update($adddokumen);
               return redirect('/masterdata/sdm14')->with('sukses','Berhasil Merubah Data Hukuman');
           } catch (\Exception $e) {
               return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
           }
       }
    
       public function func_deletesdm14($id = null){
           try {
               DB::connection('sqlsrv')->table('sdm14_backup')->where('Noid',$id)->delete();
               return redirect('/masterdata/sdm14')->with('sukses','Berhasil Menghapus Data Hukuman');
           } catch (\Exception $e) {
               return back()->withErrors(['message' => 'Unable to insert data: ' . $e->getMessage()])->withInput();
           }
    
       }    

       public function dashmbt()
       {
        $searchtanggal = "";
        $searchnosk = "";
        $searchtglsk = "";
        $searchnmpejabat = "";


        if(isset($_COOKIE['TglTransaksi']) and $_COOKIE['TglTransaksi']!=""){
            $searchtanggal = $_COOKIE['TglTransaksi']; 
        }
        if(isset($_COOKIE['NoSK']) and $_COOKIE['NoSK']!=""){
            $searchnosk = $_COOKIE['NoSK']; 
        }
        if(isset($_COOKIE['TglSK']) and $_COOKIE['TglSK']!=""){
            $searchtglsk = $_COOKIE['TglSK']; 
        }
        if(isset($_COOKIE['NmPejabat']) and $_COOKIE['NmPejabat']!=""){
            $searchnmpejabat = $_COOKIE['NmPejabat']; 
        }                
           $dataallusers = DB::connection('sqlsrv')
           ->table('sdm08_backup')
           ->where('Kd_Mutasi','M')
           ->where('TMT',$searchtanggal)
           ->where('No_SK',$searchnosk)
           ->where('NmPejabat',$searchnmpejabat)
           ->orderby('NPP')->get();  
            // = DB::connection('sqlsrv')->table('sdm14_backup')->where('NPP','like',$searchnama)->orderbydesc('TglSK')->get();   
           return view('masterdata.mbt',compact('searchtanggal','searchnosk','searchtglsk','searchnmpejabat','dataallusers'));   

       }
       
       public function func_generate_mbt(Request $request){
        $tmt = $request->input('TglTransaksi');
        $nosk = $request->input('NoSK');
        $tglsk = $request->input('TglSK');
        $nmpejabat = $request->input('NmPejabat');
        $searchtanggal = $tmt;
        $searchnosk = $nosk;
        $searchtglsk = $tglsk;
        $searchnmpejabat = $nmpejabat;
        try {
            DB::select("SET NOCOUNT ON ; exec input_MBT '$tmt','$nosk','$tglsk','$nmpejabat'");
            $dataallusers = DB::connection('sqlsrv')
           ->table('sdm08_backup')
           ->where('Kd_Mutasi','M')
           ->where('TMT',$searchtanggal)
           ->where('No_SK',$searchnosk)
           ->where('NmPejabat',$searchnmpejabat)
           ->orderby('NPP')->get();  
             // = DB::connection('sqlsrv')->table('sdm14_backup')->where('NPP','like',$searchnama)->orderbydesc('TglSK')->get();   
            return redirect('/masterdata/mbt',compact('searchtanggal','searchnosk','searchtglsk','searchnmpejabat','dataallusers'))->with('sukses','Berhasil Input MBT Karpel');
        } 
        catch (\Exception $e) {
            $dataallusers = DB::connection('sqlsrv')
           ->table('sdm08_backup')
           ->where('Kd_Mutasi','M')
           ->where('TMT',$searchtanggal)
           ->where('No_SK',$searchnosk)
           ->where('NmPejabat',$searchnmpejabat)
           ->orderby('NPP')->get();  
            return view('masterdata.mbt',compact('searchtanggal','searchnosk','searchtglsk','searchnmpejabat','dataallusers'))->with('sukses','Berhasil Input MBT Karpel');
        }
    }




}
