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
    <h1 class="h3 mb-2 text-gray-800"> DETAIL SERTIFIKASI</h1>
    <p class="mb-4">PT Perkebunan Nusantara I</p>     
    <div class="card shadow mb-4">   
        <div class="card-body">    
            <!-- --------------------------------------------------------------------------------------- -->
            <form action="{{url('/dokumen/sertifikasi')}}" method="get">              
            @csrf
                    <style>
                        .form-group {
                            margin-bottom: 0.5rem!important;
                        }
                        .form-control {
                            font-size: 1.1em!important;
                        }
                    </style>
                    <div class="row" style="font-size: 0.85em;">
                        <div class="col-md-6">
                        <div class="form-group row">
                                <label for="kebun" class="col-sm-3 control-label">Nama Kebun</label>
                                <label for="kebun" class="col-sm-6 control-label"> : {{isset($datauser->nama_kebun)?$datauser->nama_kebun:''}}</label>
                            </div>
                            <div class="form-group row">
                                <label for="region" class="col-sm-3 control-label">Region</label>
                                <label for="region" class="col-sm-6 control-label"> : {{isset($datauser->regional)?$datauser->regional:''}}</label>
                            </div>                                                  
                        </div>
                    </div>
                    <div class="card shadow mb-4">
        
        <div class="card-body">       
            <br><br>   
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style='font-size: 0.85em;'>
                            <th style="text-align:center">No</th>
                            <th style="text-align:center">Nama Sertifikasi</th>
                            <th style="text-align:center">Nomor Sertifikasi</th>
                            <th style="text-align:center">Tanggal Mulai</th>
                            <th style="text-align:center">Tanggal Berakhir</th>
                            <th style="text-align:center">Dokumen</th>
                            <th style="text-align:center">Aksi</th>
                            
                        </tr>
                    </thead>
                    <tbody style='font-size: 0.85em;'>
                        <?php $i = 1; ?>
                        @foreach($m_sertifikasi as $keysertifikasi)
                            <?php 
                                $tgl_start = "-";
                                $tgl_end = "-";
                                $dokumen_str = '-';
                                $nama_sertifikasi = '-';
                                $nomor = '-';
                                foreach($sertifikasi as $dokumen){
                                    
                                        
                                    if($dokumen->id_sertifikasi == $keysertifikasi->id){
                                        $tgl_start = date('Y-m-d', strtotime($dokumen->tanggal_start));
                                        $tgl_end = date('Y-m-d', strtotime($dokumen->tanggal_end));
                                        $dokumen_str = $dokumen->dokumen;
                                        $nama_sertifikasi = $dokumen->nama_sertifikasi;
                                        $nomor = $dokumen->nomor;
                                    }
                                }
                            ?>
                        <tr>
                            <td>{{$i++}}</td>
                            <td style="text-align:center">{{$keysertifikasi->nama}}</td>
                            <td style="text-align:center">{{$nomor}}</td>
                            <td style="text-align:center">{{$tgl_start}}</td>
                            <td style="text-align:center">{{$tgl_end}}</td>
                            <td style="text-align:center">{{$dokumen_str}}</td>
                            @if($nomor!="-")                      
                            <td style="text-align:center">
                                <btn class="btn btn-warning btn-sm editdata" id="{{$nomor}}"><i class="fas fa-fw fa-edit"></i></btn>
                                </a>
                            </td>
                            @else     
                            <td style="text-align:center">
                                <btn class="btn btn-warning btn-sm tambahdata" id="{{$keysertifikasi->id}}"><i class="fas fa-fw fa-plus"></i></btn>
                                </a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
                
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-success float-right">
                    Kembali
                    </button>
                </div>
              </form>
        </div>
    </div>
    <div class="modaladddata">
        <div class="card shadow mb-4 modal modalpopup" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding:15px;">    
            <div class="card-body ">  
                <h1 class="h3 mb-2 text-gray-800"> Tambah Data Sertifikasi</h1>
                <br>
            
                <form action="{{url('/dokumen/storesertifikasi')}}" method="post">
                    @csrf
                
                    <div class="row" style="font-size: 0.85em;">
                        <div class="col-md-6">
                            <input type="hidden" name="id_sertifikasi" id="id_sertifikasi" required="required" value="">
                            <input type="hidden" name="region" id="region" required="required" value="{{isset($datauser->regional)?$datauser->regional:''}}">
                            <input type="hidden" name="kebun" id="kebun" required="required" value="{{isset($datauser->nama_kebun)?$datauser->nama_kebun:''}}">
                            <input type="hidden" name="provinsi" id="provinsi" required="required" value="{{isset($datauser->provinsi)?$datauser->provinsi:''}}">
                            <input type="hidden" name="kabupaten" id="kabupaten" required="required" value="{{isset($datauser->kabupaten)?$datauser->kabupaten:''}}">
                            <div class="form-group row">
                                <label for="nama_sertifikasi" class="col-sm-3 control-label">Nama Sertifikasi</label>
                                <input type="text" class="col-sm-6 form-control form-control-user"
                                    id="nama_sertifikasi" name="nama_sertifikasi" aria-describedby="nama_sertifikasi" value="" readonly="readonly"
                                    placeholder="Nama Sertifikasi..." required>
                            </div>
                            <div class="form-group row">
                                <label for="nomor" class="col-sm-3 control-label">Nomor Sertifikasi</label>
                                <input type="text" class="col-sm-6 form-control form-control-user"
                                    id="nomor" name="nomor" aria-describedby="nomor" value=""
                                    placeholder="Nomor..." required>
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_start" class="col-sm-3 control-label">Tanggal Mulai</label>
                                <input type="date" class="col-sm-6 form-control form-control-user"
                                    id="tanggal_start" name="tanggal_start" aria-describedby="tanggal_start" value=""
                                    placeholder="Tanggal Mulai..." required>
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_end" class="col-sm-3 control-label">Tanggal Berakhir</label>
                                <input type="date" class="col-sm-6 form-control form-control-user"
                                    id="tanggal_end" name="tanggal_end" aria-describedby="tanggal_end" value=""
                                    placeholder="Tanggal Berakhir..." required>
                            </div>
                            <div class="form-group row">
                                <label for="dokumen" class="col-sm-3 control-label">Link Dokumen</label>
                                <input type="text" class="col-sm-6 form-control form-control-user"
                                    id="dokumen" name="dokumen" aria-describedby="dokumen" value=""
                                    placeholder="Link Dokumen..." required>
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
        <div class="card shadow mb-4 modal modalpopup" id="editdataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding:15px;">   
            <div class="card-body ">  
                <h1 class="h3 mb-2 text-gray-800"> Edit Data Perizinan</h1>
                <br>
            
                <form action="{{url('/dokumen/updatesertifikasi')}}" method="post">
                    <input type="hidden" name="id" id="id" required="required" 
                        value="">
                    @csrf
                
                    <div class="row" style="font-size: 0.85em;">
                        <div class="col-md-6">
                            <input type="hidden"  name="id_sertifikasi" id="id_sertifikasi" required="required" value="">
                            <input type="hidden" name="region" id="region" required="required" value="{{isset($datauser->regional)?$datauser->regional:''}}">
                            <input type="hidden" name="kebun" id="kebun" required="required" value="{{isset($datauser->nama_kebun)?$datauser->nama_kebun:''}}">
                            <input type="hidden" name="provinsi" id="provinsi" required="required" value="{{isset($datauser->provinsi)?$datauser->provinsi:''}}">
                            <input type="hidden" name="kabupaten" id="kabupaten" required="required" value="{{isset($datauser->kabupaten)?$datauser->kabupaten:''}}">
                            <div class="form-group row">
                                <label for="nama_sertifikasi" class="col-sm-3 control-label">Nama Sertifikasi</label>
                                <input type="text" class="col-sm-6 form-control form-control-user"
                                    id="nama_sertifikasi" name="nama_sertifikasi" aria-describedby="nama_sertifikasi" value="" readonly="readonly"
                                    placeholder="Nama Sertifikasi..." required>
                            </div>
                            <div class="form-group row">
                                <label for="nomor" class="col-sm-3 control-label">Nomor Sertifikasi</label>
                                <input type="text" class="col-sm-6 form-control form-control-user"
                                    id="nomor" name="nomor" aria-describedby="nomor" value=""
                                    placeholder="Nomor..." required>
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_start" class="col-sm-3 control-label">Tanggal Mulai</label>
                                <input type="date" class="col-sm-6 form-control form-control-user"
                                    id="tanggal_start" name="tanggal_start" aria-describedby="tanggal_start" value=""
                                    placeholder="Tanggal Mulai..." required>
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_end" class="col-sm-3 control-label">Tanggal Berakhir</label>
                                <input type="date" class="col-sm-6 form-control form-control-user"
                                    id="tanggal_end" name="tanggal_end" aria-describedby="tanggal_end" value=""
                                    placeholder="Tanggal Berakhir..." required>
                            </div>
                            <div class="form-group row">
                                <label for="dokumen" class="col-sm-3 control-label">Link Dokumen</label>
                                <input type="text" class="col-sm-6 form-control form-control-user"
                                    id="dokumen" name="dokumen" aria-describedby="dokumen" value=""
                                    placeholder="Link Dokumen..." required>
                            </div>                                                               
                        </div>
                    </div>
                    
                    <!-- /.card-body -->
                    <div class="card-footer modal-footer">
                        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="submit" class="btn btn-success float-right"><i class="fas fa-fw fa-edit"></i> Edit </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    var modaladddata = $('.modaladddata').detach();
    var modaleditdata = $('.modaleditdata').detach();

    @if($errors->any())
        Swal.fire({
            title: "Error",
            text: "@foreach ($errors->all() as $error){{ $error }},@endforeach",
            icon: "error"
        });
        
    @endif
    @if(session('suksesdelete'))
        Swal.fire({
            title: "Data ini telah dihapus!",
            text: "Berhasil.",
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
            title: "Apakah anda yakin ingin menghapus data?",
            text: "Anda tidak dapat mengembalikan data kembali!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Hapus",
            cancelButtonText: "Kembali"
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    });
    $('.tambahdata').click(function(e){
        var id = $(this).attr('id');
        console.log(modaladddata);
        $('.modaladddata').remove();
        $('.modaleditdata').remove();
        $('body').append(modaladddata);
        $.ajax({
                url: "{{url('/dokumen/get_data_sertifikasi_belumada')}}/"+id,
                type: "GET",
                dataType: "json",
                success: function(response) {
                // Populate the modal with the data from the response
                // For example, if you have an input field with id "name" in the modal:
                    
                    $('#id_sertifikasi').val(response.id);
                    $('#jenis_sertifikasi').val(response.jenis_sertifikasi);
                    $('#nama_sertifikasi').val(response.nama);
                    $('#exampleModal').modal('show');
                // Repeat this for other fields you want to populate in the modal
                },
                error: function(xhr, status, error) {
                console.log(xhr.responseText);
                }
            });
    })

    $('.editdata').click(function(e){
        var id = $(this).attr('id');
        console.log(id);
            $('.modaladddata').remove();
            $('.modaleditdata').remove();
            $('body').append(modaleditdata);
      
            $.ajax({
                url: "{{url('/dokumen/get_data_sertifikasi')}}/"+id,
                type: "GET",
                dataType: "json",
                success: function(response) {
                // Populate the modal with the data from the response
                // For example, if you have an input field with id "name" in the modal:
                    
                    $('#id').val(response.id);
                    $('#id_sertifikasi').val(response.id_sertifikasi);
                    $('#region').val(response.region);
                    $('#kebun').val(response.kebun);
                    $('#provinsi').val(response.provinsi);
                    $('#kabupaten').val(response.kabupaten);
                    $('#nama_sertifikasi').val(response.nama_sertifikasi);
                    $('#nomor').val(response.nomor);
                    $('#tanggal_start').val(response.tanggal_start);
                    $('#tanggal_end').val(response.tanggal_end);
                    $('#dokumen').val(response.dokumen);
                    $('#editdataModal').modal('show');
                // Repeat this for other fields you want to populate in the modal
                },
                error: function(xhr, status, error) {
                console.log(xhr.responseText);
                }
            });
        
    });
    

    
    // $('.nav_sdm').addClass('active');
</script>
@endsection