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
<h1 class="h3 mb-2 text-gray-800">Master Data SDM08</h1>
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
            <form action="{{url('/masterdata/sdm08')}}" method="get">              
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
                            <th style="text-align:center">KD_MUTASI</th>
                            <th style="text-align:center">KD_UNIT</th>
                            <th style="text-align:center">KD_BAGIAN</th>
                            <th style="text-align:center">KD_AFD</th>
                            <th style="text-align:center">KD_BUD</th>
                            <th style="text-align:center">KD_JABATAN</th>
                            <th style="text-align:center">TMT</th>
                            <th style="text-align:center">No. SK</th>
                            <th style="text-align:center">Tgl. SK</th>
                            <th style="text-align:center">AKSI</th>                            
                        </tr>
                    </thead>
                    <tbody style='font-size: 0.85em;'>
                        <?php $i = 1; ?>
                        @foreach($dataallusers as $key)
                        <tr>
                            <td ><a href="{{url('/masterdata/form_kebun_detail')}}/{{$key->NoId}}"><i class="fas fa-fw fa-search"></i></a> {{$key->Kd_Mutasi}}</td>
                            <td style="text-align:center">{{$key->Kd_Unit}}</td>
                            <td style="text-align:center">{{$key->Kd_Bagian}}</td>
                            <td style="text-align:center">{{$key->Kd_Afd}}</td>
                            <td style="text-align:center">{{$key->Kd_Bud}}</td>
                            <td style="text-align:center">{{$key->Kd_Jabatan}}</td>
                            <td style="text-align:center">{{$key->TMT}}</td>                                                                                    
                            <td style="text-align:center">{{$key->No_SK}}</td>                                                                                    
                            <td style="text-align:center">{{$key->Tgl_SK}}</td>                                                                                    
                            <td style="text-align:center" width="100">
                                <btn class="btn btn-warning btn-sm editdata" id="{{$key->NoId}}"><i class="fas fa-fw fa-edit"></i></btn>
                                <a href="{{url('/masterdata/deletesdm08')}}/{{$key->NoId}}">
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
            <h1 class="h3 mb-2 text-gray-800"> Tambah Data Riwayat Jabatan</h1>
            <br>
            <form action="{{url('/masterdata/storesdm08')}}" enctype="multipart/form-data" method="post">
            @csrf        
            <div class="row" style="font-size: 0.85em;">
                        <div class="col-md-5">    
                        <input type="hidden" name="NoId" id="NoId" required="NoId" value="">
                        <input type="hidden" name="NPP" id="NPP" required="NPP" value="{{$searchnama}}">                       
                            <div class="form-group row">
                                <label for="Kd_Mutasi" class="col-sm-3 control-label">Kd_Mutasi</label>
                                <select name="Kd_Mutasi" id="Kd_Mutasi" class="col-sm-6 form-control">
                                    <option value="">Pilih ...</option>
                                    <option value="P">Promosi</option>
                                    <option value="R">Rotasi</option>
                                    <option value="D">Demosi</option>
                                    <option value="T">Penugasan</option>
                                    <option value="C">CDT</option>
                                    <option value="M">MBT</option>
                                    <option value="N">Pensiun/Non Aktif</option>
                                    <option value="L">Lain-lain</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="Kd_Unit" class="col-sm-3 control-label">Kd_Unit</label>
                                <select name="Kd_UnitAdd" id="Kd_UnitAdd" class="col-sm-6 form-control">
                                    <option value="">Pilih ...</option>
                                @foreach ($dataunitall as $data)    
                                    <option value="{{$data->Kd_Unit}}" @if($dataunitall==$data->Kd_Unit) selected @endif>{{$data->Kd_Unit}}-{{$data->Nm_Unit}}</option>
                                @endforeach             
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="Kd_Bagian" class="col-sm-3 control-label">- Kd_Bagian</label>
                                <select name="Kd_BagianAdd" id="Kd_BagianAdd" class="col-sm-6 form-control">
                                    <option value="">Pilih ...</option>
                                @foreach ($databagian as $data)    
                                    <option value="{{$data->Kd_Bagian}}" @if($databagian==$data->Kd_Bagian) selected @endif>{{$data->Nm_Bagian}}</option>
                                @endforeach             
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="Kd_Afd" class="col-sm-3 control-label">- Kd_Afd</label>
                                <select name="Kd_AfdAdd" id="Kd_AfdAdd" class="col-sm-6 form-control">
                                    <option value="">Pilih ...</option>
                                @foreach ($dataafdeling as $data)    
                                    <option value="{{$data->Kd_Afd}}" @if($dataafdeling==$data->Kd_Afd) selected @endif>{{$data->Kd_Afd}}</option>
                                @endforeach             
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="Kd_Bud" class="col-sm-3 control-label">Kd_Bud</label>
                                <select name="Kd_Bud" id="Kd_Bud" class="col-sm-6 form-control">
                                    <option value="">Pilih ...</option>    
                                    <option value="00">Karet</option>
                                    <option value="02">Teh</option>
                                    <option value="10">Non Budidaya</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="Kd_Jabatan" class="col-sm-3 control-label">Kd_Jabatan</label>
                                <select name="Kd_Jabatan" id="Kd_Jabatan" class="col-sm-6 form-control">
                                    <option value="">Pilih ...</option>                                
                                @foreach ($datajaball as $data)    
                                    <option value="{{$data->Kd_Jabatan}}" @if($datajaball==$data->Kd_Jabatan) selected @endif>{{$data->uraian}}</option>
                                @endforeach             
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="TMT" class="col-sm-3 control-label">TMT</label>
                                <input type="date" class="col-sm-7 form-control form-control-user"
                                    id="TMT" name="TMT" aria-describedby="TMT" value=""
                                    placeholder="TMT..." required>
                            </div>
                            <div class="form-group row">
                                <label for="No_SK" class="col-sm-3 control-label">No_SK</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="No_SK" name="No_SK" aria-describedby="No_SK" value=""
                                    placeholder="No_SK..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Tgl_SK" class="col-sm-3 control-label">Tgl_SK</label>
                                <input type="date" class="col-sm-7 form-control form-control-user"
                                    id="Tgl_SK" name="Tgl_SK" aria-describedby="Tgl_SK" value=""
                                    placeholder="Tgl_SK..." required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group row">
                                <label for="NmPejabat" class="col-sm-3 control-label">NmPejabat</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NmPejabat" name="NmPejabat" aria-describedby="NmPejabat" value=""
                                    placeholder="NmPejabat..." required>
                            </div>
                            <div class="form-group row">
                                <label for="KdBranded" class="col-sm-3 control-label">KdBranded</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="KdBranded" name="KdBranded" aria-describedby="KdBranded" value=""
                                    placeholder="KdBranded...">
                            </div>
                            <div class="form-group row">
                                <label for="Sansos" class="col-sm-3 control-label">Sansos</label>
                                <select name="Sansos" id="Sansos" class="col-sm-6 form-control">
                                    <option value="Y">Pilih ...</option>    
                                    <option value="Y">Ya</option>
                                    <option value="T">Tidak</option>
                                </select>
                                </div>
                            <div class="form-group row">
                                <label for="StatusKerja" class="col-sm-3 control-label">StatusKerja</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="StatusKerja" name="StatusKerja" aria-describedby="StatusKerja" value="" disabled
                                    placeholder="StatusKerja..." required>
                                </div>
                            <div class="form-group row">
                                <label for="Kd_Instansi" class="col-sm-3 control-label">Kd_Instansi</label>
                                <select name="Kd_Instansi" id="Kd_Instansi" class="col-sm-6 form-control">
                                    <option value="">Pilih ...</option>
                                @foreach ($datainstansi as $data)    
                                    <option value="{{$data->Kd_Instansi}}" @if($datainstansi==$data->Kd_Instansi) selected @endif>{{$data->Nm_Instansi}}</option>
                                @endforeach             
                                </select>
                             </div>
                            <div class="form-group row">
                                <label for="EmployeeSubGrup" class="col-sm-3 control-label">EmployeeSubGrup</label>
                                <select name="EmployeeSubGrup" id="EmployeeSubGrup" class="col-sm-6 form-control">
                                    <option value="">Pilih ...</option>
                                    <option value="AA">Karpim</option>
                                    <option value="BA">Karpel</option>
                                    <option value="CA">OJT/CKP Eksternal</option>
                                    <option value="CC">PKWT</option>
                                    <option value="CP">PKWT Setara Karpim</option>
                                    <option value="DB">Direktur</option>
                                    <option value="DC">SEVP</option>
                                    <option value="EA">Komisaris Utama</option>
                                    <option value="EB">Anggota Komisaris</option>
                                </select>                                    
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
            <h1 class="h3 mb-2 text-gray-800"> Edit Data SDM08</h1>
            <br>
            
            <form action="{{url('/masterdata/updatesdm08')}}" enctype="multipart/form-data" method="post">
            @csrf
            
                    <div class="row" style="font-size: 0.85em;">
                        <div class="col-md-5">    
                        <input type="hidden" name="NoId" id="NoId" required="NoId" value="">
                        <input type="hidden" name="NPP" id="NPP" required="NPP" value="">                       
                            <div class="form-group row">
                                <label for="Kd_Mutasi" class="col-sm-3 control-label">Kd_Mutasi</label>
                                <select name="Kd_Mutasi" id="Kd_Mutasi" class="col-sm-6 form-control">
                                    @if(isset($datauser->Kd_Mutasi))
                                    <option value="P" @if($datauser->Kd_Bud=="P") selected @endif>Promosi</option>
                                    <option value="R" @if($datauser->Kd_Bud=="R") selected @endif>Rotasi</option>
                                    <option value="D" @if($datauser->Kd_Bud=="D") selected @endif>Demosi</option>
                                    <option value="T" @if($datauser->Kd_Bud=="T") selected @endif>Penugasan</option>
                                    <option value="C" @if($datauser->Kd_Bud=="C") selected @endif>CDT</option>
                                    <option value="M" @if($datauser->Kd_Bud=="M") selected @endif>MBT</option>
                                    <option value="N" @if($datauser->Kd_Bud=="N") selected @endif>Pensiun/Non Aktif</option>
                                    <option value="L" @if($datauser->Kd_Bud=="L") selected @endif>Lain-lain</option>
                                    @else
                                    <option value="P">Promosi</option>
                                    <option value="R">Rotasi</option>
                                    <option value="D">Demosi</option>
                                    <option value="T">Penugasan</option>
                                    <option value="C">CDT</option>
                                    <option value="M">MBT</option>
                                    <option value="N">Pensiun/Non Aktif</option>
                                    <option value="L">Lain-lain</option>
                                    @endif                                    
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="Kd_Unit" class="col-sm-3 control-label">Kd_Unit</label>
                                <select name="Kd_UnitEdit" id="Kd_UnitEdit" class="col-sm-6 form-control">
                                @foreach ($dataunitall as $data)    
                                    @if(isset($datauser->Kd_Unit))
                                        <option value="{{$data->Kd_Unit}}" @if($dataunitall==$data->Kd_Unit) selected @endif>{{$data->Kd_Unit}}-{{$data->Nm_Unit}}</option>
                                @else
                                        <option value="{{$data->Kd_Unit}}" @if($dataunitall==$data->Kd_Unit) selected @endif>{{$data->Nm_Unit}}</option>
                                    @endif
                                @endforeach             
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="Kd_Bagian" class="col-sm-3 control-label">- Kd_Bagian</label>
                                <select name="Kd_BagianEdit" id="Kd_BagianEdit" class="col-sm-6 form-control">
                                @foreach ($databagian as $data)    
                                @if(isset($datauser->Kd_Bagian))
                                        <option value="{{$data->Kd_Bagian}}" @if($databagian==$data->Kd_Bagian) selected @endif>{{$data->Kd_Bagian}}-{{$data->Nm_Bagian}}</option>
                                @else
                                        <option value="{{$data->Kd_Bagian}}" @if($databagian==$data->Kd_Bagian) selected @endif>{{$data->Nm_Bagian}}</option>
                                @endif

                                @endforeach             
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="Kd_Afd" class="col-sm-3 control-label">- Kd_Afd</label>
                                <select name="Kd_AfdEdit" id="Kd_AfdEdit" class="col-sm-6 form-control">
                                @foreach ($dataafdeling as $data)    
                                @if(isset($datauser->Kd_Afd))
                                    <option value="{{$data->Kd_Afd}}" @if($dataafdeling==$data->Kd_Afd) selected @endif>{{$data->Kd_Afd}}-{{$data->Nm_Afd}}</option>
                                @else
                                    <option value="{{$data->Kd_Afd}}" @if($dataafdeling==$data->Kd_Afd) selected @endif>{{$data->Kd_Afd}}</option>
                                @endif
                                @endforeach             
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="Kd_Bud" class="col-sm-3 control-label">Kd_Bud</label>
                                <select name="Kd_Bud" id="Kd_Bud" class="col-sm-6 form-control">
                                    @if(isset($datauser->Kd_Bud))
                                    <option value="00" @if($datauser->Kd_Bud=="00") selected @endif>Karet</option>
                                    <option value="02" @if($datauser->Kd_Bud=="02") selected @endif>Teh</option>
                                    <option value="10" @if($datauser->Kd_Bud=="10") selected @endif>Non Budidaya</option>
                                    @else
                                    <option value="00">Karet</option>
                                    <option value="02">Teh</option>
                                    <option value="10">Non Budidaya</option>
                                    @endif                                    
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="Kd_Jabatan" class="col-sm-3 control-label">Kd_Jabatan</label>
                                <select name="Kd_Jabatan" id="Kd_Jabatan" class="col-sm-6 form-control">
                                @foreach ($datajaball as $data)    
                                @if(isset($datauser->Kd_Jabatan))
                                    <option value="{{$data->Kd_Jabatan}}" @if($datajaball==$data->Kd_Jabatan) selected @endif>{{$data->Kd_Jabatan}}-{{$data->uraian}}</option>
                                    @else
                                    <option value="{{$data->Kd_Jabatan}}" @if($datajaball==$data->Kd_Jabatan) selected @endif>{{$data->uraian}}</option>
                                    @endif
                                @endforeach             
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="TMT" class="col-sm-3 control-label">TMT</label>
                                <input type="date" class="col-sm-7 form-control form-control-user"
                                    id="TMT" name="TMT" aria-describedby="TMT" value=""
                                    placeholder="TMT..." required>
                            </div>
                            <div class="form-group row">
                                <label for="No_SK" class="col-sm-3 control-label">No_SK</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="No_SK" name="No_SK" aria-describedby="No_SK" value=""
                                    placeholder="No_SK..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Tgl_SK" class="col-sm-3 control-label">Tgl_SK</label>
                                <input type="date" class="col-sm-7 form-control form-control-user"
                                    id="Tgl_SK" name="Tgl_SK" aria-describedby="Tgl_SK" value=""
                                    placeholder="Tgl_SK..." required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group row">
                                <label for="NmPejabat" class="col-sm-3 control-label">NmPejabat</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NmPejabat" name="NmPejabat" aria-describedby="NmPejabat" value=""
                                    placeholder="NmPejabat..." required>
                            </div>
                            <div class="form-group row">
                                <label for="KdBranded" class="col-sm-3 control-label">KdBranded</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="KdBranded" name="KdBranded" aria-describedby="KdBranded" value=""
                                    placeholder="KdBranded...">
                            </div>
                            <div class="form-group row">
                                <label for="Sansos" class="col-sm-3 control-label">Sansos</label>
                                <select name="Sansos" id="Sansos" class="col-sm-6 form-control">
                                    @if(isset($datauser->Sansos))
                                    <option value="Y" @if($datauser->Kd_Bud=="Y") selected @endif>Ya</option>
                                    <option value="T" @if($datauser->Kd_Bud=="T") selected @endif>Tidak</option>
                                    @else
                                    <option value="Y">Ya</option>
                                    <option value="T">Tidak</option>
                                    @endif                                    
                                </select>
                                </div>
                            <div class="form-group row">
                                <label for="StatusKerja" class="col-sm-3 control-label">StatusKerja</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="StatusKerja" name="StatusKerja" aria-describedby="StatusKerja" value="" disabled
                                    placeholder="StatusKerja..." required>

                                </div>
                            <div class="form-group row">
                                <label for="Kd_Instansi" class="col-sm-3 control-label">Kd_Instansi</label>
                                <select name="Kd_Instansi" id="Kd_Instansi" class="col-sm-6 form-control">
                                        <option value="">Tidak DIpilih</option>
                                @foreach ($datainstansi as $data)    
                                    @if(isset($datauser->Kd_Instansi))
                                        <option value="{{$data->Kd_Instansi}}" @if($datainstansi==$data->Kd_Instansi) selected @endif>{{$data-Kd_Instansi}}-{{$data->Nm_Instansi}}</option>
                                @else
                                        <option value="{{$data->Kd_Instansi}}" @if($datainstansi==$data->Kd_Instansi) selected @endif>{{$data->Nm_Instansi}}</option>
                                    @endif
                                @endforeach             
                                </select>
                             </div>
                            <div class="form-group row">
                                <label for="EmployeeSubGrup" class="col-sm-3 control-label">EmployeeSubGrup</label>
                                <select name="EmployeeSubGrup" id="EmployeeSubGrup" class="col-sm-6 form-control">
                                    @if(isset($datauser->EmployeeSubGrup))
                                    <option value="AA" @if(substr($datauser->EmployeeSubGrup,-2)=="AA") selected @endif>Karpim</option>
                                    <option value="BA" @if(substr($datauser->EmployeeSubGrup,-2)=="BA") selected @endif>Karpel</option>
                                    <option value="CA" @if(substr($datauser->EmployeeSubGrup,-2)=="CA") selected @endif>OJT/CKP Eksternal</option>
                                    <option value="CC" @if(substr($datauser->EmployeeSubGrup,-2)=="CC") selected @endif>PKWT</option>
                                    <option value="CP" @if(substr($datauser->EmployeeSubGrup,-2)=="CP") selected @endif>PKWT Setara Karpim</option>
                                    <option value="DB" @if(substr($datauser->EmployeeSubGrup,-2)=="DB") selected @endif>Direktur</option>
                                    <option value="DC" @if(substr($datauser->EmployeeSubGrup,-2)=="DC") selected @endif>SEVP</option>
                                    <option value="EA" @if(substr($datauser->EmployeeSubGrup,-2)=="EA") selected @endif>Komisaris Utama</option>
                                    <option value="EB" @if(substr($datauser->EmployeeSubGrup,-2)=="EB") selected @endif>Anggota Komisaris</option>
                                    @else
                                    <option value="AA">Karpel</option>
                                    <option value="BA">Karpel</option>
                                    <option value="CA">OJT/CKP Eksternal</option>
                                    <option value="CC">PKWT</option>
                                    <option value="CP">PKWT Setara Karpim</option>
                                    <option value="DB">Direktur</option>
                                    <option value="DC">SEVP</option>
                                    <option value="EA">Komisaris Utama</option>
                                    <option value="EB">Anggota Komisaris</option>
                                    @endif                                    
                                </select>                                    
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

//TAMBAH DATA    
    $('.tambahdata').click(function(e){

        $(document).ready(function() {
            $('#Kd_Instansi').prop('disabled', true);
            $('#Kd_BagianAdd').prop('disabled', true);
            $('#Kd_AfdAdd').prop('disabled', true);          
            $('#Kd_UnitAdd').on('click',function(){
                var kode_kebun = $(this).val();
                console.log(kode_kebun);
                if (kode_kebun == "00") {
                    $.ajax ({
                        url:'../masterdata/kodekebun/' +kode_kebun,
                        type: 'GET',
                        data: {
                            '_token' : '{{ csrf_token() }}'
                        },
                        dataType : 'json',
                        success: function(data) {
                            if(data) {
                                $('#Kd_BagianAdd').prop('disabled', false);
                                $('#Kd_AfdAdd').prop('disabled', false);
                                $('#Kd_BagianAdd').empty();
                                $('#Kd_AfdAdd').empty();
                                $('#Kd_AfdAdd').append('<option value=""> Tidak Dipilih </option>');
                                $('#Kd_BagianAdd').append('<option value=""> Tidak Dipilih </option>');
                                $.each(data, function(key, datauser) {
                                    $('select[name="Kd_BagianAdd"]').append (
                                        '<option value ="'+ datauser.Kd_Bagian + '">' + datauser.Kd_Bagian + " - " + datauser.Nm_Bagian + '</option>'
                                    );
                                });
                            } else {
                                $('#Kd_BagianAdd').empty();
                            }
                        } 
                    });
                } else if(kode_kebun != "00"){
                    $.ajax ({
                        url:'../masterdata/kodeafdeling/' +kode_kebun,
                        type: 'GET',
                        data: {
                            '_token' : '{{ csrf_token() }}'
                        },
                        dataType : 'json',
                        success: function(data) {
                            if(data) {
                               
                                $('#Kd_BagianAdd').val("00");
                                $('#Kd_BagianAdd').prop('disabled', true);
                                $('#Kd_AfdAdd').prop('disabled', false);
                                $('#Kd_AfdAdd').empty();
                                $('#Kd_AfdAdd').append('<option value=""> Tidak Dipilih </option>');
                                $.each(data, function(key, datauser) {
                                    $('select[name="Kd_AfdAdd"]').append (
                                        '<option value ="'+ datauser.Kd_Afd + '">' + datauser.Kd_Afd + " - " + datauser.Nm_Afd + '</option>'
                                    );
                                });
                            } else {
                                $('#Kd_AfdAdd').empty();
                            }
                        } 
                    });
                }
            });
        });

        $(document).ready(function() {          
            $('#Kd_BagianAdd').on('click',function(){
                var kode_bagian = $(this).val();
                console.log(kode_bagian);
                if (kode_bagian != "00") {
                    $.ajax ({
                        url:'../masterdata/kodebagian/' +kode_bagian,
                        type: 'GET',
                        data: {
                            '_token' : '{{ csrf_token() }}'
                        },
                        dataType : 'json',
                        success: function(data) {
                            if(data) {
                                $('#Kd_AfdAdd').append('<option value=""> Tidak Dipilih </option>');
                                $.each(data, function(key, datausersubbagian) {
                                    $('select[name="Kd_AfdAdd"]').append (
                                        '<option value ="'+ datausersubbagian.Kd_Afd + '">' + datausersubbagian.Kd_Afd + ' - ' + datausersubbagian.Nm_Afd + '</option>'
                                    );
                                });
                            } else {
                                $('#Kd_AfdAdd').empty();
                            }
                        } 
                    });
                } 
            });
        });

        $(document).ready(function() {          
            $('#Kd_Mutasi').on('click',function(){
                var kode_mutasi = $(this).val();
                console.log(kode_mutasi);
                if (kode_mutasi == "T") {
                    $('#Kd_Instansi').prop('disabled', false);
                    $('#StatusKerja').val("T");
                }
                else if (kode_mutasi != "T") {
                    $('#Kd_Instansi').prop('disabled', true);
                    if ((kode_mutasi == "P") || (kode_mutasi == "R") || (kode_mutasi == "D") || (kode_mutasi == "L")) {
                            $('#StatusKerja').val("K");
                    }
                    else if (kode_mutasi == "C") {
                            $('#StatusKerja').val("C");
                    }                 
                    else if (kode_mutasi == "M") {
                            $('#StatusKerja').val("M");
                    }                 
                    else if (kode_mutasi == "N") {
                            $('#StatusKerja').val("N");
                    }                 
                }
            });
        });

        console.log(modaladddata);
        $('.modaladddata').remove();
        $('.modaleditdata').remove();
        $('body').append(modaladddata);
        $('#exampleModal').modal('show');
    })

 //EDIT DATA   
    $('.editdata').click(function(e){

        $(document).ready(function() {
            $('#Kd_Instansi').prop('disabled', true);
            $('#Kd_BagianEdit').prop('disabled', true);
            $('#Kd_AfdEdit').prop('disabled', true);          
            $('#Kd_UnitEdit').on('click',function(){
                var kode_kebun = $(this).val();
                console.log(kode_kebun);
                if (kode_kebun == "00") {
                    $.ajax ({
                        url:'../masterdata/kodekebun/' +kode_kebun,
                        type: 'GET',
                        data: {
                            '_token' : '{{ csrf_token() }}'
                        },
                        dataType : 'json',
                        success: function(data) {
                            if(data) {
                                $('#Kd_BagianEdit').prop('disabled', false);
                                $('#Kd_AfdEdit').prop('disabled', false);
                                $('#Kd_BagianEdit').empty();
                                $('#Kd_AfdEdit').empty();
                                $('#Kd_AfdAdd').append('<option value=""> Tidak Dipilih </option>');
                                $('#Kd_BagianEdit').append('<option value=""> Tidak Dipilih </option>');
                                $.each(data, function(key, datauser) {
                                    $('select[name="Kd_BagianEdit"]').append (
                                        '<option value ="'+ datauser.Kd_Bagian + '">' + datauser.Kd_Bagian + " - " + datauser.Nm_Bagian + '</option>'
                                    );
                                });
                            } else {
                                $('#Kd_BagianEdit').empty();
                            }
                        } 
                    });
                } else if(kode_kebun != "00"){
                    $.ajax ({
                        url:'../masterdata/kodeafdeling/' +kode_kebun,
                        type: 'GET',
                        data: {
                            '_token' : '{{ csrf_token() }}'
                        },
                        dataType : 'json',
                        success: function(data) {
                            if(data) {
                                
                                $('#Kd_BagianEdit').val("00");
                                $('#Kd_BagianEdit').prop('disabled', true);
                                $('#Kd_AfdEdit').prop('disabled', false);
                                $('#Kd_AfdEdit').empty();
                                $('#Kd_AfdEdit').append('<option value=""> Tidak Dipilih </option>');
                                $.each(data, function(key, datauser) {
                                    $('select[name="Kd_AfdEdit"]').append (
                                        '<option value ="'+ datauser.Kd_Afd + '">' + datauser.Kd_Afd + " - " + datauser.Nm_Afd + '</option>'
                                    );
                                });
                            } else {
                                $('#Kd_AfdEdit').empty();
                            }
                        } 
                    });
                }
            });
        });

        $(document).ready(function() {          
            $('#Kd_BagianEdit').on('click',function(){
                var kode_bagian = $(this).val();
                console.log(kode_bagian);
                if (kode_bagian != "00") {
                    $.ajax ({
                        url:'../masterdata/kodebagian/' +kode_bagian,
                        type: 'GET',
                        data: {
                            '_token' : '{{ csrf_token() }}'
                        },
                        dataType : 'json',
                        success: function(data) {
                            if(data) {
                                $('#Kd_AfdEdit').append('<option value=""> Tidak Dipilih </option>');
                                $.each(data, function(key, datausersubbagian) {
                                    $('select[name="Kd_AfdEdit"]').append (
                                        '<option value ="'+ datausersubbagian.Kd_Afd + '">' + datausersubbagian.Kd_Afd + " - " + datausersubbagian.Nm_Afd + '</option>'
                                    );
                                });
                            } else {
                                $('#Kd_AfdEdit').empty();
                            }
                        } 
                    });
                } 
            });
        });

        $(document).ready(function() {          
            $('#Kd_Mutasi').on('click',function(){
                var kode_mutasi = $(this).val();
                console.log(kode_mutasi);
                if (kode_mutasi == "T") {
                    $('#Kd_Instansi').prop('disabled', false);
                    $('#StatusKerja').val("T");
                }
                else if (kode_mutasi != "T") {
                    $('#Kd_Instansi').prop('disabled', true);
                    if ((kode_mutasi == "P") || (kode_mutasi == "R") || (kode_mutasi == "D") || (kode_mutasi == "L")) {
                            $('#StatusKerja').val("K");
                    }
                    else if (kode_mutasi == "C") {
                            $('#StatusKerja').val("C");
                    }                 
                    else if (kode_mutasi == "M") {
                            $('#StatusKerja').val("M");
                    }                 
                    else if (kode_mutasi == "N") {
                            $('#StatusKerja').val("N");
                    }                 
                }
            });
        });

        $('.modaladddata').remove();
        $('.modaleditdata').remove();
        $('body').append(modaleditdata);
        
        
        var id = $(this).attr('id');
        console.log(id);
        $.ajax({
            url: "{{url('/masterdata/get_data_sdm08')}}/"+id,
            type: "GET",
            dataType: "json",
            success: function(response) {
            // Populate the modal with the data from the response
            // For example, if you have an input field with id "name" in the modal:
                $('#NoId').val(response.NoId);
                $('#NPP').val(response.NPP);
                $('#Kd_Mutasi').val(response.Kd_Mutasi);
                $('#Kd_UnitEdit').val(response.Kd_Unit);
                $('#Kd_BagianEdit').val(response.Kd_Bagian);
                $('#Kd_AfdEdit').val(response.Kd_Afd);
                $('#Kd_Bud').val(response.Kd_Bud);
                $('#Kd_Jabatan').val(response.Kd_Jabatan);
                $('#Bom').val(response.Bom);
                $('#TMT').val(response.TMT);
                $('#No_SK').val(response.No_SK);
                $('#Tgl_SK').val(response.Tgl_SK);
                $('#Jns_Mutasi').val(response.Jns_Mutasi);
                $('#NmPejabat').val(response.NmPejabat);
                $('#KdBranded').val(response.KdBranded);
                $('#Sansos').val(response.Sansos);
                $('#StatusKerja').val(response.StatusKerja);
                $('#Kd_Instansi').val(response.Kd_Instansi);
                $('#EmployeeSubGrup').val(response.EmployeeSubGrup);
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