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
<h1 class="h3 mb-2 text-gray-800">Detail Data Karyawan</h1>
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
            <div class="col-md-2">           
                <div class="form-group row">
                    <label for="namasearch" class="col-md-12 control-label" style="text-align: right"><strong>Nama Karyawan</strong></label>
                </div>
            </div>
            <div class="col-md-3">           
                <div class="form-group row">
                    <select name="namasearch" id="namasearch" class="col-sm-6 form-control">
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
            <button type="submit" name="submit" class="btn btn-outline-success float-right btn-sm cari" style="margin-right: 10px;"><i class="fas fa-fw fa-filter"></i> Filter </button>
        </div>
    
</div>

<div class="card shadow mb-4">
        
        <div class="card-body">
            <div class="row" style="font-size: 0.85em;">
                <div class="col-md-8">
                <div class="form-group row">
                    <label for="region" class="col-md-2 control-label">NPP</label>
                    <label for="region" class="col-sm-6 control-label"> : @foreach($datasdm01_cari as $key) {{$key->NPP}} @endforeach</label>
                </div>
                <div class="form-group row">
                    <label for="region" class="col-md-2 control-label">Reg. SAP</label>
                    <label for="region" class="col-sm-6 control-label"> : @foreach($datasdm01_cari as $key) {{$key->RegSAP}} @endforeach</label>
                </div>
                <div class="form-group row">
                    <label for="region" class="col-md-2 control-label">Nama</label>
                    <label for="region" class="col-sm-6 control-label"> : @foreach($datasdm01_cari as $key) {{$key->Nama}} @endforeach</label>
                </div>
                <div class="form-group row">
                    <label for="region" class="col-md-2 control-label">Gelar Depan</label>
                    <label for="region" class="col-sm-6 control-label"> : @foreach($datasdm01_cari as $key) {{$key->GlrDepan}} @endforeach</label>
                </div>
                <div class="form-group row">
                    <label for="region" class="col-md-2 control-label">Gelar Blkng</label>
                    <label for="region" class="col-sm-6 control-label"> : @foreach($datasdm01_cari as $key) {{$key->GlrBelakang}} @endforeach</label>
                </div>
                <div class="form-group row">
                    <label for="region" class="col-md-2 control-label">Tgl. Lahir</label>
                    <label for="region" class="col-sm-6 control-label"> : @foreach($datasdm01_cari as $key) {{$key->TglLahir}} @endforeach</label>
                </div>
                <div class="form-group row">
                    <label for="region" class="col-md-2 control-label">Kota Lahir</label>
                    <label for="region" class="col-sm-6 control-label"> : @foreach($datasdm01_cari as $key) {{$key->KotaLahir}} @endforeach</label>
                </div>
                <div class="form-group row">
                    <label for="region" class="col-md-2 control-label">Jenis Kelamin</label>
                    <label for="region" class="col-sm-6 control-label"> : @foreach($datasdm01_cari as $key) {{$key->JenisKelamin}} @endforeach</label>
                </div>
                <div class="form-group row">
                    <label for="region" class="col-md-2 control-label">Alamat</label>
                    <label for="region" class="col-sm-6 control-label"> : @foreach($datasdm01_cari as $key) {{$key->Alamat}} @endforeach</label>
                </div>
                <div class="form-group row">
                    <label for="region" class="col-md-2 control-label">Telepon</label>
                    <label for="region" class="col-sm-6 control-label"> : @foreach($datasdm01_cari as $key) {{$key->NoTelp}} @endforeach</label>
                </div>
                <div class="form-group row">
                    <label for="region" class="col-md-2 control-label">Email</label>
                    <label for="region" class="col-sm-6 control-label"> : @foreach($datasdm01_cari as $key) {{$key->Email}} @endforeach</label>
                </div>
                <div class="form-group row">
                    <label for="region" class="col-md-2 control-label">Sosial Media</label>
                    <label for="region" class="col-sm-6 control-label"> : @foreach($datasdm01_cari as $key) {{$key->Sosmed}} @endforeach</label>
                </div>
                </div>
                <div class="col-md-4">
                @foreach($datasdm01_cari as $key)
                    <img src="{{ asset('fotokaryawan/'. $key->Foto)}}" height="400px" width="300px" alt="" srcset="">
                    @endforeach
                </div>
            </div>
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
            <h1 class="h5 mb-2 text-gray-800">Data Keluarga</h1>
 
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align:center">NAMA</th>
                            <th style="text-align:center">HUBUNGAN</th>
                            <th style="text-align:center">TGL LAHIR</th>
                            <th style="text-align:center">JENIS KELAMIN</th>
                            <th style="text-align:center">GOL. DARAH</th>
                            <th style="text-align:center">AGAMA</th>
                            <th style="text-align:center">TK. PENDIDIKAN</th>

                        </tr>
                    </thead>
                    <tbody style='font-size: 0.85em;'>
                        <?php $i = 1; ?>
                        @foreach($datasdm02 as $key)
                        <tr>
                            <td ><a href="{{url('/masterdata/form_kebun_detail')}}/{{$key->NIK}}"><i class="fas fa-fw fa-search"></i></a> {{$key->Nama}}</td>
                            <td style="text-align:center">{{$key->Hubungan}}</td>
                            <td style="text-align:center">{{$key->TglLahir}}</td>
                            <td style="text-align:center">{{$key->JenisKelamin}}</td>
                            <td style="text-align:center">{{$key->GolDarah}}</td>
                            <td style="text-align:center">{{$key->Agama}}</td>
                            <td style="text-align:center">{{$key->TKPendidikan}}</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
              </form>
        </div>
    </div>   

    
    
    <div class="card shadow mb-4">
        
        <div class="card-body">
            <form action="{{url('/masterdata/sdm03')}}" method="get">              
            @csrf
            <!-- <a href="{{url('/dash/form_stakeholder_add')}}">
                <button class="btn btn-primary btn-rounded add_user">
                <i class="fas fa-fw fa-plus"></i> Tambah Data
                </button>
            </a> -->
            <h1 class="h5 mb-2 text-gray-800">Data Pendidikan</h1>
            
            <br><br>   
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align:center">PENDIDIKAN</th>
                            <th style="text-align:center">NAMA</th>
                            <th style="text-align:center">KOTA</th>
                            <th style="text-align:center">STAT AKREDITASI</th>
                            <th style="text-align:center">TAHUN</th>
                            <th style="text-align:center">NO. IJAZAH</th>
                            <th style="text-align:center">TGL. IJAZAH</th>
                            
                        </tr>
                    </thead>
                    <tbody style='font-size: 0.85em;'>
                        <?php $i = 1; ?>
                        @foreach($datasdm03 as $key)
                        <tr>
                            <td style="text-align:center">{{$key->Pendidikan}}</td>
                            <td style="text-align:center">{{$key->Nama}}</td>
                            <td style="text-align:center">{{$key->Kota}}</td>
                            <td style="text-align:center">{{$key->StatAkreditasi}}</td>
                            <td style="text-align:center">{{$key->Tahun}}</td>
                            <td style="text-align:center">{{$key->NoIjasah}}</td>
                            <td style="text-align:center">{{$key->TglIjasah}}</td>                       
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
              </form>
        </div>
    </div>  
    
    <div class="card shadow mb-4">
        
        <div class="card-body">
            <form action="{{url('/masterdata/sdm04')}}" method="get">              
            @csrf
            <!-- <a href="{{url('/dash/form_stakeholder_add')}}">
                <button class="btn btn-primary btn-rounded add_user">
                <i class="fas fa-fw fa-plus"></i> Tambah Data
                </button>
            </a> -->
            <h1 class="h5 mb-2 text-gray-800">Data Pelatihan</h1>
            
            <br><br>   
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align:center">PELATIHAN</th>
                            <th style="text-align:center">NAMA</th>
                            <th style="text-align:center">KOTA</th>
                            <th style="text-align:center">TAHUN</th>
                            <th style="text-align:center">NO. SERTIFIKAT</th>
                            <th style="text-align:center">TGL. SERTIFIKAT</th>
                            
                        </tr>
                    </thead>
                    <tbody style='font-size: 0.85em;'>
                        <?php $i = 1; ?>
                        @foreach($datasdm04 as $key)
                        <tr>
                            <td style="text-align:center"> {{$key->Pelatihan}}</td>
                            <td style="text-align:center">{{$key->Nama}}</td>
                            <td style="text-align:center">{{$key->Kota}}</td>
                            <td style="text-align:center">{{$key->Tahun}}</td>
                            <td style="text-align:center">{{$key->NoSertifikat}}</td>
                            <td style="text-align:center">{{$key->TglSertifikat}}</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
              </form>
        </div>
    </div>  

    <div class="card shadow mb-4">
        
        <div class="card-body">
            <form action="{{url('/masterdata/sdm08')}}" method="get">              
            @csrf
            <!-- <a href="{{url('/dash/form_stakeholder_add')}}">
                <button class="btn btn-primary btn-rounded add_user">
                <i class="fas fa-fw fa-plus"></i> Tambah Data
                </button>
            </a> -->
            <h1 class="h5 mb-2 text-gray-800">Data Riwayat Jabatan</h1>
            
            <br><br>   
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align:center">JABATAN</th>
                            <th style="text-align:center">TMT</th>
                            <th style="text-align:center">ADMINISTRATIF</th>                         
                        </tr>
                    </thead>
                    <tbody style='font-size: 0.85em;'>
                        <?php $i = 1; ?>
                        @foreach($output_sdm08 as $key)
                        <tr>
                            <td style="text-align:left"> {{$key->jabatan}}</td>
                            <td style="text-align:center">{{$key->TMT}}</td>
                            <td style="text-align:center">{{$key->administratif}}</td>                                                                                                        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
              </form>
        </div>
    </div>  

    <div class="card shadow mb-4">
        
        <div class="card-body">
            <form action="{{url('/masterdata/sdm16')}}" method="get">              
            @csrf
            <!-- <a href="{{url('/dash/form_stakeholder_add')}}">
                <button class="btn btn-primary btn-rounded add_user">
                <i class="fas fa-fw fa-plus"></i> Tambah Data
                </button>
            </a> -->
            <h1 class="h5 mb-2 text-gray-800">Data Golongan PHDP</h1>
            
            <br><br>   
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align:center">GOL</th>
                            <th style="text-align:center">TMT</th>                         
                            <th style="text-align:center">No. SK</th>
                            <th style="text-align:center">Tgl. SK</th>                          
                        </tr>
                    </thead>
                    <tbody style='font-size: 0.85em;'>
                        <?php $i = 1; ?>
                        @foreach($output_sdm16 as $key)
                        <tr>
                            <td style="text-align:center">{{$key->Golongan}}</td>
                            <td style="text-align:center">{{$key->TMT}}</td>                                                                                    
                            <td style="text-align:center">{{$key->NoSK}}</td>                                                                                    
                            <td style="text-align:center">{{$key->TglSK}}</td>                                                                                    
                            
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
                url:'../reportdata/kodekebun/' +kode_kebun,
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

    $("#namasearch").select2({ width: '100%' });
    $('.cari').click(function(){
        var kebun = $('#kebun').find(":selected").val();
        namasearch = $('#namasearch').find(":selected").val();

        $.cookie("kebun", kebun, { expires : 3600 });
        $.cookie("namasearch", namasearch, { expires : 3600 });
        location.reload();
    });
    $('.cancelsearch').click(function(){
        $.cookie("kebun", "", { expires : 3600 });
        $.cookie("namasearch", "", { expires : 3600 });
        location.reload();
    })
    // $('.nav_sdm').addClass('active');

    
</script>
@endsection