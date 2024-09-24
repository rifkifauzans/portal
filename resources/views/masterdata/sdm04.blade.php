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
<h1 class="h3 mb-2 text-gray-800">Master Data SDM04</h1>
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
            <form action="{{url('/masterdata/sdm04')}}" method="get">              
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
                            <th style="text-align:center">PELATIHAN</th>
                            <th style="text-align:center">NAMA</th>
                            <th style="text-align:center">KOTA</th>
                            <th style="text-align:center">TAHUN</th>
                            <th style="text-align:center">NO. SERTIFIKAT</th>
                            <th style="text-align:center">TGL. SERTIFIKAT</th>
                            <th style="text-align:center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody style='font-size: 0.85em;'>
                        <?php $i = 1; ?>
                        @foreach($dataallusers as $key)
                        <tr>
                            <td ><a href="{{url('/masterdata/form_kebun_detail')}}/{{$key->NoId}}"><i class="fas fa-fw fa-search"></i></a> {{$key->Pelatihan}}</td>
                            <td style="text-align:center">{{$key->Nama}}</td>
                            <td style="text-align:center">{{$key->Kota}}</td>
                            <td style="text-align:center">{{$key->Tahun}}</td>
                            <td style="text-align:center">{{$key->NoSertifikat}}</td>
                            <td style="text-align:center">{{$key->TglSertifikat}}</td>
                            <td style="text-align:center" width="100">
                                <btn class="btn btn-warning btn-sm editdata" id="{{$key->NoId}}"><i class="fas fa-fw fa-edit"></i></btn>
                                <a href="{{url('/masterdata/deletesdm04')}}/{{$key->NoId}}">
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
            <h1 class="h3 mb-2 text-gray-800"> Tambah Data Pendidikan</h1>
            <br>
            <form action="{{url('/masterdata/storesdm04')}}" enctype="multipart/form-data" method="post">
            @csrf        
                    <div class="row" style="font-size: 0.85em;">
                    <div class="col-md-5">   
                        <input type="hidden"  name="NPP" id="NPP" required="NPP" value="{{$searchnama}}">                    
                            <div class="form-group row">
                                <label for="Pelatihan" class="col-sm-3 control-label">Pelatihan</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Pelatihan" name="Pelatihan" aria-describedby="Pelatihan" value=""
                                    placeholder="Pelatihan..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Nama" class="col-sm-3 control-label">Nama</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Nama" name="Nama" aria-describedby="Nama" value=""
                                    placeholder="Nama..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Kota" class="col-sm-3 control-label">Kota</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Kota" name="Kota" aria-describedby="Kota" value=""
                                    placeholder="Kota..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Tahun" class="col-sm-3 control-label">Tahun</label>
                                <select name="Tahun" id="Tahun" class="col-sm-6 form-control">
                                    <option value="">Pilih ...</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="NoSertifikat" class="col-sm-3 control-label">No. Sertifikat</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NoSertifikat" name="NoSertifikat" aria-describedby="NoSertifikat" value=""
                                    placeholder="NoSertifikat..." required>
                            </div>
                            <div class="form-group row">
                                <label for="TglSertifikat" class="col-sm-3 control-label">Tgl. Sertifikat</label>
                                <input type="date" class="col-sm-7 form-control form-control-user"
                                    id="TglSertifikat" name="TglSertifikat" aria-describedby="TglSertifikat" value=""
                                    placeholder="TglSertifikat..." required>
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
            <h1 class="h3 mb-2 text-gray-800"> Edit Data SDM04</h1>
            <br>
            
            <form action="{{url('/masterdata/updatesdm04')}}" enctype="multipart/form-data" method="post">
            @csrf
            
            <div class="row" style="font-size: 0.85em;">
                        <div class="col-md-5">    
                        <input type="hidden" name="NoId" id="NoId" required="NoId" value="">
                        <input type="hidden" name="NPP" id="NPP" required="NPP" value="">                       
                        <div class="form-group row">
                                <label for="Pelatihan" class="col-sm-3 control-label">Pelatihan</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Pelatihan" name="Pelatihan" aria-describedby="Pelatihan" value=""
                                    placeholder="Pelatihan..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Nama" class="col-sm-3 control-label">Nama</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Nama" name="Nama" aria-describedby="Nama" value=""
                                    placeholder="Nama..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Kota" class="col-sm-3 control-label">Kota</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="Kota" name="Kota" aria-describedby="Kota" value=""
                                    placeholder="Kota..." required>
                            </div>
                            <div class="form-group row">
                                <label for="Tahun" class="col-sm-3 control-label">Tahun</label>
                                <select name="Tahun" id="Tahun" class="col-sm-6 form-control">
                                    <option value="">Pilih ...</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="NoSertifikat" class="col-sm-3 control-label">No. Sertifikat</label>
                                <input type="text" class="col-sm-7 form-control form-control-user"
                                    id="NoSertifikat" name="NoSertifikat" aria-describedby="NoSertifikat" value=""
                                    placeholder="NoSertifikat..." required>
                            </div>
                            <div class="form-group row">
                                <label for="TglSertifikat" class="col-sm-3 control-label">Tgl. Sertifikat</label>
                                <input type="date" class="col-sm-7 form-control form-control-user"
                                    id="TglSertifikat" name="TglSertifikat" aria-describedby="TglSertifikat" value=""
                                    placeholder="TglSertifikat..." required>
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
        
        $(document).ready(function() {
        var start = 1900;
        var now = new Date().getFullYear();
        var options = "";        
        
        for(var year=now; year>=start; year--){
            options += `<option value='${year}'>${year}</option>`;
        }    
        //document.getElementById("Tahun").innerHTML = options;
        // append placeholder
         $('#Tahun').append(options);
        })

        console.log(modaladddata);
        $('.modaladddata').remove();
        $('.modaleditdata').remove();
        $('body').append(modaladddata);
        $('#exampleModal').modal('show');
    })

    $('.editdata').click(function(e){

        $(document).ready(function() {
        var start = 1900;
        var now = new Date().getFullYear();
        var options = "";        
        
        for(var year=now; year>=start; year--){
            options += `<option value='${year}'>${year}</option>`;
        }    
        //document.getElementById("Tahun").innerHTML = options;
        // append placeholder
        $('#Tahun').append(options);
        })

        $('.modaladddata').remove();
        $('.modaleditdata').remove();
        $('body').append(modaleditdata);
        
        
        var id = $(this).attr('id');
        console.log(id);
        $.ajax({
            url: "{{url('/masterdata/get_data_sdm04')}}/"+id,
            type: "GET",
            dataType: "json",
            success: function(response) {
            // Populate the modal with the data from the response
            // For example, if you have an input field with id "name" in the modal:
                $('#NoId').val(response.NoId);
                $('#NPP').val(response.NPP);
                $('#Pelatihan').val(response.Pelatihan);
                $('#Nama').val(response.Nama);
                $('#Kota').val(response.Kota);
                $('#Tahun').val(response.Tahun);               
                $('#NoSertifikat').val(response.NoSertifikat);
                $('#TglSertifikat').val(response.TglSertifikat);
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