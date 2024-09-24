@extends('layouts.app')
 
@section('content')
<style>
    body {
        /* background-color: #add8e645; */
    }
    .content-body .container {
        margin: 0px;
        max-width: 100%!important;
        height:99%;
    }
    .content-body {
        padding: 3px!important;
    }
    .dt-length label{
        display:none;
    }
    .modalpopup {
        width: 80%;
        margin-top: 3%;
        margin-left: 10%;
        height: auto;
    }
    .form-group {
        margin-bottom: 0.5rem!important;
    }
    .form-control {
        font-size: 1em!important;
    }

</style>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Master Data SDM 02</h1>
    <div class="card shadow mb-4">
   
        <div class="card-body row" style="font-size: 0.85em;">
        @if(Auth::user()->hakakses =='Admin')
            <div class="col-md-2"> 
                <div class="form-group row">
                    <label for="kebuncari" class="col-md-4 control-label" style="text-align: right"><strong>Unit</strong></label>
                    <select name="kebuncari" id="kebuncari" class="col-sm-7 form-control">
                    @foreach($datakebun as $data)
                        @if($searchkebun!="")                        
                            <option value="{{$data->Kd_Unit}}" @if($searchkebun==$data->Kd_Unit) selected @endif>{{$data->Nm_Unit}}</option>                          
                        @else
                            <option value="{{$data->Kd_Unit}}">{{$data->Nm_Unit}}</option>
                        @endif
                    @endforeach 
                    </select>
                </div>
            </div>
            @endif
            <div class="col-md-5">           
                <div class="form-group row">
                    <label for="namasearch" class="col-md-3 control-label" style="text-align: right"><strong>Nama Karyawan</strong></label>
                    <select name="namasearch" id="namasearch" class="col-sm-7 form-control">
                    <option value="">Pilih..</option>
                    @foreach($datacarinama as $data)                     
                        <option value="{{$data->REG}}" @if($searchnama==$data->REG) selected @endif>{{$data->NAMA}}</option>
                    @endforeach   
                    </select>
                </div>
            </div>
           
        </div>

        <div class="card-footer">
            <!-- <a href="{{url('/')}}/dash/stakeholder"> -->
            <button class="btn btn-outline-warning float-right btn-sm cancelsearch" style="margin-right: 10px;"><i class="fas fa-fw fa-stop"></i> Batalkan </button>
            <!-- </a> -->
            &nbsp;
            <button type="submit" name="submit" class="btn btn-outline-success float-right btn-sm cari" style="margin-right: 10px;"><i class="fas fa-fw fa-filter"></i> Cari </button>
        </div>
    
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        
        <div class="card-body">
            <form action="{{url('/masterdata/sdm02')}}" method="get">              
            @csrf
            <!-- <a href="{{url('/dash/form_stakeholder_add')}}">
                <button class="btn btn-primary btn-rounded add_user">
                <i class="fas fa-fw fa-plus"></i> Tambah Data
                </button>
            </a> -->
            <button type="button" class="btn btn-primary tambahdata">
              <i class="fas fa-fw fa-plus"></i> Tambah Data
            </button>
            <a href="{{url('/exportstakeholder')}}">
                <button class="btn btn-success btn-rounded add_user">
                <i class="fas fa-fw fa-download"></i> Export
                </button>
            </a>
            
            <br><br>   
            <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align:center">NAMA</th>
                            <th style="text-align:center">HUBUNGAN</th>
                            <th style="text-align:center">TGL LAHIR</th>
                            <th style="text-align:center">JENIS KELAMIN</th>
                            <th style="text-align:center">GOL. DARAH</th>
                            <th style="text-align:center">AGAMA</th>
                            <th style="text-align:center">TK. PENDIDIKAN</th>
                            <th style="text-align:center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody style='font-size: 0.85em;'>
                        <?php $i = 1; ?>
                        @foreach($dataallusers as $key)
                        <tr>
                            <td ><a href="{{url('/masterdata/form_kebun_detail')}}/{{$key->NIK}}"><i class="fas fa-fw fa-search"></i></a> {{$key->Nama}}</td>
                            <td style="text-align:center">{{$key->Hubungan}}</td>
                            <td style="text-align:center">{{$key->TglLahir}}</td>
                            <td style="text-align:center">{{$key->JenisKelamin}}</td>
                            <td style="text-align:center">{{$key->GolDarah}}</td>
                            <td style="text-align:center">{{$key->Agama}}</td>
                            <td style="text-align:center">{{$key->TKPendidikan}}</td>
                            <td style="text-align:center" width="100">
                                <btn class="btn btn-warning btn-sm editdata" id="{{$key->NoId}}"><i class="fas fa-fw fa-edit"></i></btn>
                                <a href="{{url('/masterdata/deletesdm02')}}/{{$key->NoId}}">
                                    <btn class="btn btn-danger btn-sm deletedata"><i class="fas fa-fw fa-trash"></i></btn>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-success float-right">
                    Kembali
                    </button>
                </div>
              </form>
        </div>
    </div>    

    <div class="modaladddata">
        <div class="card shadow mb-4 modal modalpopup" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding:15px; max-height: 800px;">   
            <div class="card-body ">  
            <h1 class="h3 mb-2 text-gray-800"> Tambah Data Keluarga</h1>
            <br>
            <form action="{{url('/masterdata/storesdm02')}}" enctype="multipart/form-data" method="post">
            @csrf        
                    <div class="row" style="font-size: 0.85em;">
                    <div class="col-md-5">   
                        <input type="hidden"  name="NPPClass" id="NPPClass" required="NPPClass" value="{{$searchnama}}">                    
                            <div class="form-group row">
                                <label for="Nama" class="col-sm-3 control-label">Nama</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Nama" name="Nama" aria-describedby="Nama" value=""
                                    placeholder="Nama..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Hubungan" class="col-sm-3 control-label">Hubungan</label>
                                <select name="Hubungan" id="Hubungan" class="col-sm-6 form-control">
                                    <option value="">Pilih...</option>    
                                    <option value="I">Istri</option>
                                    <option value="S">Suami</option>
                                    <option value="K">Anak Kandung</option>
                                    <option value="T">Anak Tiri</option>
                                    <option value="A">Anak Angkat</option>
                                </select>  
                            </div>
                            <div class="form-group row">
                                <label for="TglLahir" class="col-sm-3 control-label">Tgl. Lahir</label>
                                <input type="date" class="col-sm-7 form-control form-control-user"
                                    id="TglLahir" name="TglLahir" aria-describedby="TglLahir" value=""
                                    placeholder="Tgl. Lahir..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Kota" class="col-sm-3 control-label">Kota</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Kota" name="Kota" aria-describedby="Kota" value=""
                                    placeholder="Kota..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Propinsi" class="col-sm-3 control-label">Propinsi</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Propinsi" name="Propinsi" aria-describedby="Propinsi" value=""
                                    placeholder="Propinsi..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Negara" class="col-sm-3 control-label">Negara</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Negara" name="Negara" aria-describedby="Negara" value=""
                                    placeholder="Negara..." required>
                            </div>
                            <div class="form-group row">
                                <label for="JenisKelamin" class="col-sm-3 control-label">Jenis Kelamin</label>
                                <select name="JenisKelamin" id="JenisKelamin" class="col-sm-6 form-control">
                                    <option value="">Pilih...</option>    
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>  
                            </div>
                            <div class="form-group row">
                                <label for="GolDarah" class="col-sm-3 control-label">Gol. Darah</label>
                                <select name="GolDarah" id="GolDarah" class="col-sm-6 form-control">
                                    <option value="">Pilih...</option>    
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="O">O</option>
                                    <option value="AB">AB</option>
                                </select> 
                            </div>
                            <div class="form-group row">
                                <label for="Agama" class="col-sm-3 control-label">Agama</label>
                                <select name="Agama" id="Agama" class="col-sm-6 form-control">
                                    <option value="">Pilih...</option>    
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Khonghucu">Khonghucu</option>
                                </select>    
                            </div>
                            <div class="form-group row">
                                <label for="TKPendidikan" class="col-sm-3 control-label">TK. Pendidikan</label>
                                <select name="TKPendidikan" id="TKPendidikan" class="col-sm-6 form-control">
                                    <option value="">Pilih...</option>    
                                    <option value="0">Tidak/Belum Sekolah</option>
                                    <option value="1">SD/MI/Sederajat</option>
                                    <option value="2">SMP/MTs/Sederajat</option>
                                    <option value="3">SMA/MA/Sederajat</option>
                                    <option value="4">D1</option>
                                    <option value="5">D2</option>
                                    <option value="6">D3</option>
                                    <option value="7">S1/D4</option>
                                    <option value="8">S2</option>
                                    <option value="9">S3</option>                                    
                                </select>    
                            </div>                             
                        </div>
                        <div class="col-md-5">
                        <div class="form-group row">
                                <label for="StatSipil" class="col-sm-3 control-label">Stat. Sipil</label>
                                <select name="StatSipil" id="StatSipil" class="col-sm-6 form-control">
                                    <option value="">Pilih...</option>    
                                    <option value="Kawin">Kawin</option>
                                    <option value="Tidak Kawin">Tidak Kawin</option>
                                    <option value="Duda">Duda</option>
                                    <option value="Janda">Janda</option>
                                </select> 
                            </div>
                            <div class="form-group row">
                                <label for="StatKerja" class="col-sm-3 control-label">Stat. Kerja</label>
                                <select name="StatKerja" id="StatKerja" class="col-sm-6 form-control">
                                    <option value="">Pilih...</option>    
                                    <option value="Y">Bekerja</option>
                                    <option value="T">Tidak Bekerja</option>
                                </select> 
                            </div>
                            <div class="form-group row">
                                <label for="TglNikah" class="col-sm-3 control-label">Tgl. Nikah</label>
                                <input type="date" class="col-sm-7 form-control form-control-user"
                                    id="TglNikah" name="TglNikah" aria-describedby="TglNikah" value=""
                                    placeholder="Tgl. Nikah..." required>
                            </div>
                            <div class="form-group row">
                                <label for="TglCerai" class="col-sm-3 control-label">Tgl. Cerai</label>
                                <input type="date" class="col-sm-7 form-control form-control-user"
                                    id="TglCerai" name="TglCerai" aria-describedby="TglCerai" value=""
                                    placeholder="Tgl. Cerai..." required>
                            </div>
                            <div class="form-group row">
                                <label for="StatTanggung" class="col-sm-3 control-label">Stat. Tanggung</label>
                                <select name="StatTanggung" id="StatTanggung" class="col-sm-6 form-control">
                                    <option value="">Pilih...</option>    
                                    <option value="Y">Tanggungan</option>
                                    <option value="T">Bukan Tanggungan</option>
                                </select> 
                            </div>
                            <div class="form-group row">
                                <label for="NIK" class="col-sm-3 control-label">NIK</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NIK" name="NIK" aria-describedby="NIK" value=""
                                    placeholder="NIK..." required>
                            </div>
                            <div class="form-group row">
                                <label for="NoBPJSKes" class="col-sm-3 control-label">No. BPJS Kes</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NoBPJSKes" name="NoBPJSKes" aria-describedby="NoBPJSKes" value=""
                                    placeholder="NoBPJSKes..." required>
                            </div>                               
                            <div class="form-group row">
                                <label for="UserId" class="col-sm-3 control-label"></label>
                                <input type="hidden" class="col-sm-7 form-control form-control-user"
                                    id="UserId" name="UserId" aria-describedby="UserId" value=""
                                    placeholder="UserId..." required>
                            </div>
                            <div class="form-group row">
                                <label for="TglInput" class="col-sm-3 control-label"></label>
                                <input type="hidden" class="col-sm-7 form-control form-control-user"
                                    id="TglInput" name="TglInput" aria-describedby="TglInput" value=""
                                    placeholder="TglInput..." required>
                            </div>
                        </div>
                    </div>
                    
                    <!-- /.card-body -->
                    <div class="card-footer modal-footer">
                        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="submit" class="btn btn-primary float-right"><i class="fas fa-fw fa-plus"></i> Tambah </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="modaleditdata">
        <div class="card shadow mb-4 modal modalpopup" id="editdataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding:15px;max-height: 800px;">   
            <div class="card-body ">  
            <h1 class="h3 mb-2 text-gray-800"> Edit Data SDM 02</h1>
            <br>
            
            <form action="{{url('/masterdata/updatesdm02')}}" enctype="multipart/form-data" method="post">
            @csrf
            
                    <div class="row" style="font-size: 0.85em;">
                    <div class="col-md-5">   
                    <input type="hidden" name="NoId" id="NoId" required="NoId" value="">
                    <input type="hidden" name="NPP" id="NPP" required="NPP" value="">                     
                            <div class="form-group row">
                                <label for="Nama" class="col-sm-3 control-label">Nama</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Nama" name="Nama" aria-describedby="Nama" value=""
                                    placeholder="Nama..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Hubungan" class="col-sm-3 control-label">Hubungan</label>
                                <select name="Hubungan" id="Hubungan" class="col-sm-6 form-control">
                                @if(isset($datauser->Hubungan))
                                    <option value="I" @if($datauser->Hubungan=="I") selected @endif>Istri</option>
                                    <option value="S" @if($datauser->Hubungan=="S") selected @endif>Suami</option>
                                    <option value="K" @if($datauser->Hubungan=="K") selected @endif>Anak Kandung</option>
                                    <option value="T" @if($datauser->Hubungan=="T") selected @endif>Anak Tiri</option>
                                    <option value="A" @if($datauser->Hubungan=="A") selected @endif>Anak Angkat</option>
                                @else                                        
                                    <option value="I">Istri</option>
                                    <option value="S">Suami</option>
                                    <option value="K">Anak Kandung</option>
                                    <option value="T">Anak Tiri</option>
                                    <option value="A">Anak Angkat</option>
                                @endif    
                                </select>  
                            </div>
                            <div class="form-group row">
                                <label for="TglLahir" class="col-sm-3 control-label">Tgl. Lahir</label>
                                <input type="date" class="col-sm-7 form-control form-control-user"
                                    id="TglLahir" name="TglLahir" aria-describedby="TglLahir" value=""
                                    placeholder="Tgl. Lahir..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Kota" class="col-sm-3 control-label">Kota</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Kota" name="Kota" aria-describedby="Kota" value=""
                                    placeholder="Kota..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Propinsi" class="col-sm-3 control-label">Propinsi</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Propinsi" name="Propinsi" aria-describedby="Propinsi" value=""
                                    placeholder="Propinsi..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Negara" class="col-sm-3 control-label">Negara</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Negara" name="Negara" aria-describedby="Negara" value=""
                                    placeholder="Negara..." required>
                            </div>
                            <div class="form-group row">
                                <label for="JenisKelamin" class="col-sm-3 control-label">Jenis Kelamin</label>
                                <select name="JenisKelamin" id="JenisKelamin" class="col-sm-6 form-control">
                                @if(isset($datauser->JenisKelamin))
                                    <option value="L" @if($datauser->JenisKelamin=="L") selected @endif>Laki-Laki</option>
                                    <option value="P" @if($datauser->JenisKelamin=="P") selected @endif>Perempuan</option>                                    
                                @else    
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                @endif    
                                </select>  
                            </div>
                            <div class="form-group row">
                                <label for="GolDarah" class="col-sm-3 control-label">Gol. Darah</label>
                                <select name="GolDarah" id="GolDarah" class="col-sm-6 form-control">
                                @if(isset($datauser->GolDarah))
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="O">O</option>
                                    <option value="AB">AB</option>
                                @else                                        
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="O">O</option>
                                    <option value="AB">AB</option>
                                @endif    
                                </select> 
                            </div>
                            <div class="form-group row">
                                <label for="Agama" class="col-sm-3 control-label">Agama</label>
                                <select name="Agama" id="Agama" class="col-sm-6 form-control">
                                @if(isset($datauser->Agama))
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Khonghucu">Khonghucu</option>
                                @else    
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Khonghucu">Khonghucu</option>
                                @endif    
                                </select>    
                            </div>
                            <div class="form-group row">
                                <label for="TKPendidikan" class="col-sm-3 control-label">TK. Pendidikan</label>
                                <select name="TKPendidikan" id="TKPendidikan" class="col-sm-6 form-control">
                                @if(isset($datauser->TKPendidikan))
                                    <option value="0" @if($datauser->TKPendidikan=="0") selected @endif>Tidak/Belum Sekolah</option>
                                    <option value="1" @if($datauser->TKPendidikan=="1") selected @endif>SD/MI/Sederajat</option>
                                    <option value="2" @if($datauser->TKPendidikan=="2") selected @endif>SMP/MTs/Sederajat</option>
                                    <option value="3" @if($datauser->TKPendidikan=="3") selected @endif>SMA/MA/Sederajat</option>
                                    <option value="4" @if($datauser->TKPendidikan=="4") selected @endif>D1</option>
                                    <option value="5" @if($datauser->TKPendidikan=="5") selected @endif>D2</option>
                                    <option value="6" @if($datauser->TKPendidikan=="6") selected @endif>D3</option>
                                    <option value="7" @if($datauser->TKPendidikan=="7") selected @endif>S1/D4</option>
                                    <option value="8" @if($datauser->TKPendidikan=="8") selected @endif>S2</option>
                                    <option value="9" @if($datauser->TKPendidikan=="9") selected @endif>S3</option>
                                @else
                                    <option value="0">Tidak/Belum Sekolah</option>
                                    <option value="1">SD/MI/Sederajat</option>
                                    <option value="2">SMP/MTs/Sederajat</option>
                                    <option value="3">SMA/MA/Sederajat</option>
                                    <option value="4">D1</option>
                                    <option value="5">D2</option>
                                    <option value="6">D3</option>
                                    <option value="7">S1/D4</option>
                                    <option value="8">S2</option>
                                    <option value="9">S3</option>
                                @endif                                        
                                </select>    
                            </div>                             
                        </div>
                        <div class="col-md-5">
                        <div class="form-group row">
                                <label for="StatSipil" class="col-sm-3 control-label">Stat. Sipil</label>
                                <select name="StatSipil" id="StatSipil" class="col-sm-6 form-control">
                                @if(isset($datauser->StatSipil))
                                    <option value="Kawin">Kawin</option>
                                    <option value="Tidak Kawin">Tidak Kawin</option>
                                    <option value="Duda">Duda</option>
                                    <option value="Janda">Janda</option>
                                @else
                                    <option value="Kawin">Kawin</option>
                                    <option value="Tidak Kawin">Tidak Kawin</option>
                                    <option value="Duda">Duda</option>
                                    <option value="Janda">Janda</option>
                                @endif    
                                </select> 
                            </div>
                            <div class="form-group row">
                                <label for="StatKerja" class="col-sm-3 control-label">Stat. Kerja</label>
                                <select name="StatKerja" id="StatKerja" class="col-sm-6 form-control">
                                @if(isset($datauser->StatKerja))
                                    <option value="Y" @if($datauser->StatKerja=="Y") selected @endif>Bekerja</option>
                                    <option value="T" @if($datauser->StatKerja=="T") selected @endif>Tidak Bekerja</option>
                                @else                                        
                                    <option value="Y">Bekerja</option>
                                    <option value="T">Tidak Bekerja</option>
                                @endif    
                                </select> 
                            </div>
                            <div class="form-group row">
                                <label for="TglNikah" class="col-sm-3 control-label">Tgl. Nikah</label>
                                <input type="date" class="col-sm-7 form-control form-control-user"
                                    id="TglNikah" name="TglNikah" aria-describedby="TglNikah" value=""
                                    placeholder="Tgl. Nikah..." required>
                            </div>
                            <div class="form-group row">
                                <label for="TglCerai" class="col-sm-3 control-label">Tgl. Cerai</label>
                                <input type="date" class="col-sm-7 form-control form-control-user"
                                    id="TglCerai" name="TglCerai" aria-describedby="TglCerai" value=""
                                    placeholder="Tgl. Cerai..." required>
                            </div>
                            <div class="form-group row">
                                <label for="StatTanggung" class="col-sm-3 control-label">Stat. Tanggung</label>
                                <select name="StatTanggung" id="StatTanggung" class="col-sm-6 form-control">
                                @if(isset($datauser->StatTanggung))
                                    <option value="Y" @if($datauser->StatTanggung=="Y") selected @endif>Tanggungan</option>
                                    <option value="T" @if($datauser->StatTanggung=="T") selected @endif>Bukan Tanggungan</option>
                                @else       
                                    <option value="Y">Tanggungan</option>
                                    <option value="T">Bukan Tanggungan</option>
                                @endif    
                                </select> 
                            </div>
                            <div class="form-group row">
                                <label for="NIK" class="col-sm-3 control-label">NIK</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NIK" name="NIK" aria-describedby="NIK" value=""
                                    placeholder="NIK..." required>
                            </div>
                            <div class="form-group row">
                                <label for="NoBPJSKes" class="col-sm-3 control-label">No. BPJS Kes</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NoBPJSKes" name="NoBPJSKes" aria-describedby="NoBPJSKes" value=""
                                    placeholder="NoBPJSKes..." required>
                            </div>                               
                            <div class="form-group row">
                                <label for="UserId" class="col-sm-3 control-label"></label>
                                <input type="hidden" class="col-sm-7 form-control form-control-user"
                                    id="UserId" name="UserId" aria-describedby="UserId" value=""
                                    placeholder="UserId..." required>
                            </div>
                            <div class="form-group row">
                                <label for="TglInput" class="col-sm-3 control-label"></label>
                                <input type="hidden" class="col-sm-7 form-control form-control-user"
                                    id="TglInput" name="TglInput" aria-describedby="TglInput" value=""
                                    placeholder="TglInput..." required>
                            </div>
                        </div>
                    </div>                    
                    <!-- /.card-body -->
                    <div class="card-footer modal-footer">
                        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="submit" class="btn btn-success float-right"><i class="fas fa-fw fa-edit"></i> Ubah </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    var modaladddata = $('.modaladddata').detach();
    var modaleditdata = $('.modaleditdata').detach();
    var namasearch;

$(document).ready(function() {  
       
    $('#kebuncari').on('click',function(){
        var kode_kebun = $(this).val();
        console.log(kode_kebun);
        if (kode_kebun) {
            $.ajax ({
                url:'../masterdata/kodekebunfilter/' +kode_kebun,
                type: 'GET',
                data: {
                    '_token' : '{{ csrf_token() }}'
                },
                dataType : 'json',
                success: function(data) {
                    if(data) {
                        $('#namasearch').empty();
                        $.each(data, function(key, datauser) {
                            $('select[name="namasearch"]').append (
                                '<option value ="'+ datauser.REG + '">' +
                                datauser.NAMA + '</option>'
                            );
                        });
                    } else {
                        $('#namasearch').empty();
                    }
                } 
            });
        } 
    });
});   

    @if($errors->any())
        Swal.fire({
            title: "Error",
            text: "@foreach ($errors->all() as $error){{ $error }},@endforeach",
            icon: "error"
        });
        
    @endif
    @if(session('suksesdelete'))
        Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
        });
    @endif
    
    @if(session('sukses'))
        Swal.fire({
            title: "Sukses",
            text: "{{session('sukses')}}",
            icon: "success"
        });
    @endif
    $('.deletedata').click(function(e){
        e.preventDefault();
        var href = $(this).parent('a').attr('href');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    });
    $('.tambahdata').click(function(e){
        console.log(modaladddata);
        $('.modaladddata').remove();
        $('.modaleditdata').remove();
        $('body').append(modaladddata);
        $('#exampleModal').modal('show');
    })

    $('.editdata').click(function(e){
        $('.modaladddata').remove();
        $('.modaleditdata').remove();
        $('body').append(modaleditdata);
        
        
        var id = $(this).attr('id');
        console.log(id);
        $.ajax({
            url: "{{url('/masterdata/get_data_sdm02')}}/"+id,
            type: "GET",
            dataType: "json",
            success: function(response) {
            // Populate the modal with the data from the response
            // For example, if you have an input field with id "name" in the modal:
                $('#NoId').val(response.NoId);
                $('#NPP').val(response.NPP);
                $('#Nama').val(response.Nama);
                $('#Hubungan').val(response.Hubungan);
                $('#TglLahir').val(response.TglLahir);
                $('#Kota').val(response.Kota);
                $('#Propinsi').val(response.Propinsi);
                $('#Negara').val(response.Negara);               
                $('#JenisKelamin').val(response.JenisKelamin);
                $('#GolDarah').val(response.GolDarah);
                $('#Agama').val(response.Agama);
                $('#TKPendidikan').val(response.TKPendidikan);
                $('#StatSipil').val(response.StatSipil);
                $('#StatKerja').val(response.StatKerja);
                $('#TglNikah').val(response.TglNikah);
                $('#TglCerai').val(response.TglCerai);
                $('#StatTanggung').val(response.StatTanggung);
                $('#NIK').val(response.NIK);
                $('#NoBPJSKes').val(response.NoBPJSKes);
                $('#UserId').val(response.UserId);
                $('#TglInput').val(response.TglInput);
                $('#editdataModal').modal('show');
            // Repeat this for other fields you want to populate in the modal
            },
            error: function(xhr, status, error) {
            console.log(xhr.responseText);
            }
        });
    });
    

    $("#namasearch").select2({ width: '75%' });
    $('.cari').click(function(){
        var kebun = $('#kebuncari').find(":selected").val();
        namasearch = $('#namasearch').find(":selected").val();

        $.cookie("kebuncari", kebun, { expires : 3600 });
        $.cookie("namasearch", namasearch, { expires : 3600 });
        location.reload();
    });
    $('.cancelsearch').click(function(){
        $.cookie("kebuncari", "", { expires : 3600 });
        $.cookie("namasearch", "", { expires : 3600 });
        location.reload();
    })
    // $('.nav_sdm').addClass('active');
</script>
@endsection