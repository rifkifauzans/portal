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
<h1 class="h3 mb-2 text-gray-800">Master Data SDM 01</h1>
<div class="card shadow mb-4">
    
        <div class="card-body row" style="font-size: 0.85em;">
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
            <div class="col-md-5">           
                <div class="form-group row">
                    <label for="namasearch" class="col-md-3 control-label" style="text-align: right"><strong>Nama Karyawan</strong></label>
                    <select name="namasearch" id="namasearch" class="col-sm-7 form-control">
                    @foreach($datauser as $data)
                        <option value="">Pilih..</option>
                        <option value="{{$data->NPP}}" @if($searchnama==$data->NPP) selected @endif>{{$data->Nama}}</option>
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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align:center">NPP</th>
                            <th style="text-align:center">NIK SAP</th>
                            <th style="text-align:center">NAMA</th>
                            <th style="text-align:center">KOTA LAHIR</th>
                            <th style="text-align:center">TGL LAHIR</th>
                            <th style="text-align:center">TGL MASUK</th>
                            <th style="text-align:center">ALAMAT</th>
                            <th style="text-align:center">EMAIL</th>
                            <th style="text-align:center">FOTO</th>
                            <th style="text-align:center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody style='font-size: 0.85em;'>
                        <?php $i = 1; ?>
                        @foreach($dataallusers as $key)
                        <tr>
                            <td ><a href="{{url('/masterdata/form_kebun_detail')}}/{{$key->NPP}}"><i class="fas fa-fw fa-search"></i></a> {{$key->NPP}}</td>
                            <td style="text-align:center">{{$key->RegSAP}}</td>
                            <td style="text-align:center">{{$key->Nama}}</td>
                            <td style="text-align:center">{{$key->KotaLahir}}</td>
                            <td style="text-align:center">{{$key->TglLahir}}</td>
                            <td style="text-align:center">{{$key->TglMasuk}}</td>
                            <td style="text-align:center">{{$key->Alamat}}</td>
                            <td style="text-align:center">{{$key->Email}}</td>
                            <td style="text-align:center">
                            <img src="{{ asset('public/fotokaryawan/'. $key->Foto)}}" height="100px" width="80px" alt="" srcset="">
                            </td>
                            <td style="text-align:center" width="100">
                                <btn class="btn btn-warning btn-sm editdata" id="{{$key->NPP}}"><i class="fas fa-fw fa-edit"></i></btn>
                                <a href="{{url('/masterdata/deletekebun')}}/{{$key->NPP}}">
                                    <btn class="btn btn-danger btn-sm deletedata"><i class="fas fa-fw fa-trash"></i></btn>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modaladddata">
        <div class="card shadow mb-4 modal modalpopup" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding:15px; max-height: 800px;">   
            <div class="card-body ">  
            <h1 class="h3 mb-2 text-gray-800"> Tambah Data SDM 01</h1>
            <br>
            <form action="{{url('/masterdata/storesdm01')}}" enctype="multipart/form-data" method="post">
            @csrf        
                    <div class="row" style="font-size: 0.85em;">
                        <div class="col-md-5">                       
                            <div class="form-group row">
                                <label for="NPP" class="col-sm-3 control-label">NPP</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NPP" name="NPP" aria-describedby="NPP" value=""
                                    placeholder="NPP..." required>
                            </div>
                            <div class="form-group row">
                                <label for="RegSAP" class="col-sm-3 control-label">Reg SAP</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="RegSAP" name="RegSAP" aria-describedby="RegSAP" value=""
                                    placeholder="RegSAP..." required>
                            </div>                            
                            <div class="form-group row">
                                <label for="Nama" class="col-sm-3 control-label">Nama</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Nama" name="Nama" aria-describedby="Nama" value=""
                                    placeholder="Nama..." required>
                            </div>
                            <div class="form-group row">
                                <label for="GlrDepan" class="col-sm-3 control-label">Glr. Depan</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="GlrDepan" name="GlrDepan" aria-describedby="GlrDepan" value=""
                                    placeholder="Gelar Depan..." >
                            </div>
                            <div class="form-group row">
                                <label for="GlrBelakang" class="col-sm-3 control-label">Glr. Belakang</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="GlrBelakang" name="GlrBelakang" aria-describedby="GlrBelakang" value=""
                                    placeholder="Gelar Belakang..." >
                            </div>
                            <div class="form-group row">
                                <label for="NamaPanggilan" class="col-sm-3 control-label">Nama Panggilan</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NamaPanggilan" name="NamaPanggilan" aria-describedby="NamaPanggilan" value=""
                                    placeholder="Nama Panggilan..." required>
                            </div>
                            <div class="form-group row">
                                <label for="KotaLahir" class="col-sm-3 control-label">Kota Lahir</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="KotaLahir" name="KotaLahir" aria-describedby="KotaLahir" value=""
                                    placeholder="Kota Lahir..." required>
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
                                <label for="TglLahir" class="col-sm-3 control-label">Tgl. Lahir</label>
                                <input type="date" class="col-sm-7 form-control form-control-user"
                                    id="TglLahir" name="TglLahir" aria-describedby="TglLahir" value=""
                                    placeholder="Tgl. Lahir..." required>
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
                                <label for="TglMasuk" class="col-sm-3 control-label">Tgl. Masuk</label>
                                <input type="date" class="col-sm-7 form-control form-control-user"
                                    id="TglMasuk" name="TglMasuk" aria-describedby="TglMasuk" value=""
                                    placeholder="Tgl. Masuk..." required>
                            </div>
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
                                <label for="NPWP" class="col-sm-3 control-label">NPWP</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NPWP" name="NPWP" aria-describedby="NPWP" value=""
                                    placeholder="NPWP..." >
                            </div>  
                        </div>
                        <div class="col-md-5">
                            <div class="form-group row">
                                <label for="Alamat" class="col-sm-3 control-label">Alamat</label>
                                <input type="textarea" class="col-sm-7 form-control form-control-user"
                                    id="Alamat" name="Alamat" aria-describedby="Alamat" value=""
                                    placeholder="Alamat..." required>
                            </div>  
                            <div class="form-group row">
                                <label for="KodePos" class="col-sm-3 control-label">Kode Pos</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="KodePos" name="KodePos" aria-describedby="KodePos" value=""
                                    placeholder="KodePos..." required>
                            </div>  
                            <div class="form-group row">
                                <label for="NoTelp" class="col-sm-3 control-label">No. Telp</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NoTelp" name="NoTelp" aria-describedby="NoTelp" value=""
                                    placeholder="NoTelp..." required>
                            </div>                             
                            <div class="form-group row">
                                <label for="Jenis_AsPens" class="col-sm-3 control-label">Jenis. Asuransi Pensiun</label>
                                <select name="Jenis_AsPens" id="Jenis_AsPens" class="col-sm-6 form-control">
                                    <option value="">Pilih...</option>    
                                    <option value="DAPENBUN">Dapenbun</option>
                                    <option value="DPLK">PPIP/DPLK</option>
                                </select> 
                            </div>
                            <div class="form-group row">
                                <label for="Nomor_AsPens" class="col-sm-3 control-label">Nomor. Asuransi Pensiun</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Nomor_AsPens" name="Nomor_AsPens" aria-describedby="Nomor_AsPens" value=""
                                    placeholder="Nomor_AsPens..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Nomor_BPJSTK" class="col-sm-3 control-label">Nomor BPJSTK</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Nomor_BPJSTK" name="Nomor_BPJSTK" aria-describedby="Nomor_BPJSTK" value=""
                                    placeholder="Nomor_BPJSTK..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Nomor_BPJSKS" class="col-sm-3 control-label">Nomor BPJSKS</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Nomor_BPJSKS" name="Nomor_BPJSKS" aria-describedby="Nomor_BPJSKS" value=""
                                    placeholder="Nomor_BPJSKS..." required>
                            </div>                                                                                       
                            <div class="form-group row">
                                <label for="kodebank" class="col-sm-3 control-label">Kode Bank</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="kodebank" name="kodebank" aria-describedby="kodebank" value=""
                                    placeholder="Kode Bank..." required>
                            </div>
                            <div class="form-group row">
                                <label for="NoAccBank" class="col-sm-3 control-label">No. Acc Bank</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NoAccBank" name="NoAccBank" aria-describedby="NoAccBank" value=""
                                    placeholder="NoAccBank..." required>
                            </div>
                            <div class="form-group row">
                                <label for="AtasNama" class="col-sm-3 control-label">Atas Nama</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="AtasNama" name="AtasNama" aria-describedby="AtasNama" value=""
                                    placeholder="AtasNama..." required>
                            </div>
                            <div class="form-group row">
                                <label for="NoKTP" class="col-sm-3 control-label">No. KTP</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NoKTP" name="NoKTP" aria-describedby="NoKTP" value=""
                                    placeholder="NoKTP..." required>
                            </div>
                            <div class="form-group row">
                                <label for="NoKK" class="col-sm-3 control-label">No. KK</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NoKK" name="NoKK" aria-describedby="NoKK" value=""
                                    placeholder="NoKK..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Email" class="col-sm-3 control-label">Email</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Email" name="Email" aria-describedby="Email" value=""
                                    placeholder="Email..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Sosmed" class="col-sm-3 control-label">Sosial Media</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Sosmed" name="Sosmed" aria-describedby="Sosmed" value=""
                                    placeholder="Sosmed..." required>
                            </div>  
                            <div class="form-group row">
                                <label for="Foto" class="col-sm-3 control-label">Foto</label>
                                <input type="file" class="col-sm-7 form-control form-control-user"
                                    id="Foto" name="Foto" aria-describedby="Foto" value=""
                                    placeholder="Foto..." required>
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
            <h1 class="h3 mb-2 text-gray-800"> Edit Data Stakeholder</h1>
            <br>
            
            <form action="{{url('/masterdata/updatesdm01')}}" enctype="multipart/form-data" method="post">
            @csrf
            
            <div class="row" style="font-size: 0.85em;">
                        <div class="col-md-5">                       
                            <div class="form-group row">
                                <label for="NPP" class="col-sm-3 control-label">NPP</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NPP" name="NPP" aria-describedby="NPP" value=""
                                    placeholder="NPP..." required>
                            </div>
                            <div class="form-group row">
                                <label for="RegSAP" class="col-sm-3 control-label">Reg SAP</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="RegSAP" name="RegSAP" aria-describedby="RegSAP" value=""
                                    placeholder="RegSAP..." required>
                            </div>                            
                            <div class="form-group row">
                                <label for="Nama" class="col-sm-3 control-label">Nama</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Nama" name="Nama" aria-describedby="Nama" value=""
                                    placeholder="Nama..." required>
                            </div>
                            <div class="form-group row">
                                <label for="GlrDepan" class="col-sm-3 control-label">Glr. Depan</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="GlrDepan" name="GlrDepan" aria-describedby="GlrDepan" value=""
                                    placeholder="Gelar Depan..." >
                            </div>
                            <div class="form-group row">
                                <label for="GlrBelakang" class="col-sm-3 control-label">Glr. Belakang</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="GlrBelakang" name="GlrBelakang" aria-describedby="GlrBelakang" value=""
                                    placeholder="Gelar Belakang..." >
                            </div>
                            <div class="form-group row">
                                <label for="NamaPanggilan" class="col-sm-3 control-label">Nama Panggilan</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NamaPanggilan" name="NamaPanggilan" aria-describedby="NamaPanggilan" value=""
                                    placeholder="Nama Panggilan..." required>
                            </div>
                            <div class="form-group row">
                                <label for="KotaLahir" class="col-sm-3 control-label">Kota Lahir</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="KotaLahir" name="KotaLahir" aria-describedby="KotaLahir" value=""
                                    placeholder="Kota Lahir..." required>
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
                                <label for="TglLahir" class="col-sm-3 control-label">Tgl. Lahir</label>
                                <input type="date" class="col-sm-7 form-control form-control-user"
                                    id="TglLahir" name="TglLahir" aria-describedby="TglLahir" value=""
                                    placeholder="Tgl. Lahir..." required>
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
                                <label for="TglMasuk" class="col-sm-3 control-label">Tgl. Masuk</label>
                                <input type="date" class="col-sm-7 form-control form-control-user"
                                    id="TglMasuk" name="TglMasuk" aria-describedby="TglMasuk" value=""
                                    placeholder="Tgl. Masuk..." required>
                            </div>
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
                                <label for="NPWP" class="col-sm-3 control-label">NPWP</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NPWP" name="NPWP" aria-describedby="NPWP" value=""
                                    placeholder="NPWP..." required>
                            </div>  
                                       
                        </div>
                        <div class="col-md-5">
                            <div class="form-group row">
                                <label for="Alamat" class="col-sm-3 control-label">Alamat</label>
                                <input type="textarea" class="col-sm-7 form-control form-control-user"
                                    id="Alamat" name="Alamat" aria-describedby="Alamat" value=""
                                    placeholder="Alamat..." required>
                            </div>  
                            <div class="form-group row">
                                <label for="KodePos" class="col-sm-3 control-label">Kode Pos</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="KodePos" name="KodePos" aria-describedby="KodePos" value=""
                                    placeholder="KodePos..." required>
                            </div>  
                            <div class="form-group row">
                                <label for="NoTelp" class="col-sm-3 control-label">No. Telp</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NoTelp" name="NoTelp" aria-describedby="NoTelp" value=""
                                    placeholder="NoTelp..." required>
                            </div>   
                            <div class="form-group row">
                                <label for="Jenis_AsPens" class="col-sm-3 control-label">Jenis. Asuransi Pensiun</label>
                                <select name="Jenis_AsPens" id="Jenis_AsPens" class="col-sm-6 form-control">
                                @if(isset($datauser->GolDarah))   
                                    <option value="DAPENBUN">Dapenbun</option>
                                    <option value="DPLK">DPLK</option>
                                @else    
                                    <option value="DAPENBUN">Dapenbun</option>
                                    <option value="DPLK">DPLK</option>
                                @endif
                            </select> 
                            </div>
                            <div class="form-group row">
                                <label for="Nomor_AsPens" class="col-sm-3 control-label">Nomor. Asuransi Pensiun</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Nomor_AsPens" name="Nomor_AsPens" aria-describedby="Nomor_AsPens" value=""
                                    placeholder="Nomor_AsPens..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Nomor_BPJSTK" class="col-sm-3 control-label">Nomor BPJSTK</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Nomor_BPJSTK" name="Nomor_BPJSTK" aria-describedby="Nomor_BPJSTK" value=""
                                    placeholder="Nomor_BPJSTK..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Nomor_BPJSKS" class="col-sm-3 control-label">Nomor BPJSKS</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Nomor_BPJSKS" name="Nomor_BPJSKS" aria-describedby="Nomor_BPJSKS" value=""
                                    placeholder="Nomor_BPJSKS..." required>
                            </div>                                                                                       
                            <div class="form-group row">
                                <label for="kodebank" class="col-sm-3 control-label">Kode Bank</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="kodebank" name="kodebank" aria-describedby="kodebank" value=""
                                    placeholder="Kode Bank..." required>
                            </div>
                            <div class="form-group row">
                                <label for="NoAccBank" class="col-sm-3 control-label">No. Acc Bank</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NoAccBank" name="NoAccBank" aria-describedby="NoAccBank" value=""
                                    placeholder="NoAccBank..." required>
                            </div>
                            <div class="form-group row">
                                <label for="AtasNama" class="col-sm-3 control-label">Atas Nama</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="AtasNama" name="AtasNama" aria-describedby="AtasNama" value=""
                                    placeholder="AtasNama..." required>
                            </div>
                            <div class="form-group row">
                                <label for="NoKTP" class="col-sm-3 control-label">No. KTP</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NoKTP" name="NoKTP" aria-describedby="NoKTP" value=""
                                    placeholder="NoKTP..." required>
                            </div>
                            <div class="form-group row">
                                <label for="NoKK" class="col-sm-3 control-label">No. KK</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NoKK" name="NoKK" aria-describedby="NoKK" value=""
                                    placeholder="NoKK..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Email" class="col-sm-3 control-label">Email</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Email" name="Email" aria-describedby="Email" value=""
                                    placeholder="Email..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Sosmed" class="col-sm-3 control-label">Sosial Media</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Sosmed" name="Sosmed" aria-describedby="Sosmed" value=""
                                    placeholder="Sosmed..." required>
                            </div>   
                            <div class="form-group row">
                                <label for="Foto" class="col-sm-3 control-label">Foto</label>
                                <input type="file" class="col-sm-7 form-control form-control-user"
                                    id="Foto" name="Foto" aria-describedby="Foto" value=""
                                    placeholder="Foto..." required>
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
            url: "{{url('/masterdata/get_data_sdm01')}}/"+id,
            type: "GET",
            dataType: "json",
            success: function(response) {
            // Populate the modal with the data from the response
            // For example, if you have an input field with id "name" in the modal:
                
                $('#NPP').val(response.NPP);
                $('#RegSAP').val(response.RegSAP);
                $('#Nama').val(response.Nama);
                $('#GlrDepan').val(response.GlrDepan);
                $('#GlrBelakang').val(response.GlrBelakang);
                $('#NamaPanggilan').val(response.NamaPanggilan);
                $('#KotaLahir').val(response.KotaLahir);
                $('#Propinsi').val(response.Propinsi);
                $('#Negara').val(response.Negara);
                $('#TglLahir').val(response.TglLahir);
                $('#JenisKelamin').val(response.JenisKelamin);
                $('#GolDarah').val(response.GolDarah);
                $('#Agama').val(response.Agama);
                $('#TglMasuk').val(response.TglMasuk);
                $('#StatSipil').val(response.StatSipil);
                $('#NPWP').val(response.NPWP);
                $('#Alamat').val(response.Alamat);
                $('#KodePos').val(response.KodePos);
                $('#NoTelp').val(response.NoTelp);
                $('#NoFaks').val(response.NoFaks);
                $('#Jenis_AsPens').val(response.Jenis_AsPens);
                $('#Nomor_AsPens').val(response.Nomor_AsPens);
                $('#Nomor_BPJSTK').val(response.Nomor_BPJSTK);                                                
                $('#Nomor_BPJSKS').val(response.Nomor_BPJSKS);                                                                
                $('#KodeBank').val(response.KodeBank);
                $('#NoAccBank').val(response.NoAccBank);
                $('#AtasNama').val(response.AtasNama);
                $('#NoKTP').val(response.NoKTP);
                $('#NoKK').val(response.NoKK);
                $('#RegSAP').val(response.RegSAP);
                $('#Email').val(response.Email);
                $('#Sosmed').val(response.Sosmed);
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
    

    // $("#region, #kebun").select2({});
    // $('.cari').click(function(){
    //     var region = $('#region').find(":selected").val();
    //     var kebun = $('#kebun').find(":selected").val();

    //     $.cookie("region", region, { expires : 3600 });
    //     $.cookie("kebun", kebun, { expires : 3600 });
    //     location.reload();
    // });
    // $('.cancelsearch').click(function(){
    //     $.cookie("region", "", { expires : 3600 });
    //     $.cookie("kebun", "", { expires : 3600 });
    //     location.reload();
    // })

    // $('.nav_sdm').addClass('active');
 
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

</script>
@endsection