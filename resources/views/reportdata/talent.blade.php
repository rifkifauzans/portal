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
                    <label for="jabcari" class="col-md-4 control-label" style="text-align: right"><strong>JABATAN</strong></label>
                    <select name="jabcari" id="jabcari" class="col-sm-7 form-control">
                        <option value="">Pilih ...</option>
                    @foreach($datajab as $data)
                        @if($searchjab!="")                        
                            <option value="{{$data->nama_jab}}" @if($searchjab==$data->nama_jab) selected @endif>{{$data->nama_jab}}</option>                          
                        @else
                            <option value="{{$data->nama_jab}}">{{$data->nama_jab}}</option>
                        @endif
                    @endforeach 
                    </select>
                </div>
            </div>
            <div class="col-md-3"> 
                <div class="form-group row">
                    <label for="pendikcari" class="col-md-5 control-label" style="text-align: right"><strong>PENDIDIKAN</strong></label>
                    <select name="pendikcari" id="pendikcari" class="col-sm-7 form-control">

                    @if($searchpendik!="")
                        <option value="">Pilih..</option>
                        <option value="0" @if($searchpendik=="0") selected @endif>Tidak/Belum Sekolah</option>
                        <option value="1" @if($searchpendik=="1") selected @endif>SD/MI/Sederajat</option>
                        <option value="2" @if($searchpendik=="2") selected @endif>SMP/MTs/Sederajat</option>
                        <option value="3" @if($searchpendik=="3") selected @endif>SMA/MA/Sederajat</option>
                        <option value="4" @if($searchpendik=="4") selected @endif>D1</option>
                        <option value="5" @if($searchpendik=="5") selected @endif>D2</option>
                        <option value="6" @if($searchpendik=="6") selected @endif>D3</option>
                        <option value="7" @if($searchpendik=="7") selected @endif>S1/D4</option>
                        <option value="8" @if($searchpendik=="8") selected @endif>S2</option>
                        <option value="9" @if($searchpendik=="9") selected @endif>S3</option>
                    @else
                    <option value="">Pilih ...</option>
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
            <div class="col-md-3"> 
                <div class="form-group row">
                    <label for="makercari" class="col-md-5 control-label" style="text-align: right"><strong>MASA KERJA</strong></label>
                    <select name="makercari" id="makercari" class="col-sm-7 form-control">
                            <!-- <option value="">Pilih ...</option> -->
                    @if($searchmaker!="")
                        <option value="">Pilih..</option>
                        <option value="01" @if($searchmaker=="01") selected @endif>Dibawah 10 Tahun</option>
                        <option value="11" @if($searchmaker=="11") selected @endif>11 - 20 Tahun</option>
                        <option value="21" @if($searchmaker=="21") selected @endif>21 - 30 Tahun</option>
                        <option value="31" @if($searchmaker=="31") selected @endif>31 - 40 Tahun</option>
                        <option value="41" @if($searchmaker=="41") selected @endif>41 - 50 Tahun</option>
                        <option value="51" @if($searchmaker=="51") selected @endif>Diatas 50 Tahun</option>
                    @else
                        <option value="">Pilih ...</option>
                        <option value="01">Dibawah 10 Tahun</option>
                        <option value="11">11 - 20 Tahun</option>
                        <option value="21">21 - 30 Tahun</option>
                        <option value="31">31 - 40 Tahun</option>
                        <option value="41">41 - 50 Tahun</option>
                        <option value="51">Diatas 50 Tahun</option>
                    @endif


                            
                    </select>
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


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        
        <div class="card-body">
            <form action="{{url('/reportdata/talent')}}" method="get">              
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
                            <th style="text-align:center">REG</th>
                            <th style="text-align:center">NIK SAP</th>
                            <th style="text-align:center">NAMA</th>
                            <th style="text-align:center">NAMA JAB</th>
                            <th style="text-align:center">KD KBN</th>
                            <th style="text-align:center">GOl</th>
                            <th style="text-align:center">MK</th>
                            <th style="text-align:center">PERS GRADE</th>
                            <th style="text-align:center">PENDIDIKAN</th>
                            <th style="text-align:center">LAMA KERJA</th>
                        </tr>
                    </thead>
                    <tbody style='font-size: 0.85em;'>
                        <?php $i = 1; ?>
                        @foreach($dataallusers as $key)
                        <tr>
                            <td style="text-align:center">{{$key->REG}}</td>
                            <td style="text-align:center">{{$key->NIK_SAP}}</td>
                            <td style="text-align:center">{{$key->NAMA}}</td>
                            <td style="text-align:center">{{$key->NAMA_JAB}}</td>
                            <td style="text-align:center">{{$key->KD_KBN}}</td>
                            <td style="text-align:center">{{$key->GOL}}</td>
                            <td style="text-align:center">{{$key->MK}}</td>
                            <td style="text-align:center">{{$key->PERS_GRADE}}</td>
                            <td style="text-align:center">{{$key->KD_PEND}}</td>
                            <td style="text-align:center">{{$key->LAMAKERJA}}</td>
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
    //var namasearch;

    // $(document).ready(function() {
    //     var start = 0;
    //     var max = 57;
    //     var options = "";        
        
    //     for(var mk=start; mk<max; mk++){
    //         options += `<option value='${mk}'>${mk}</option>`;
    //     }    
    //     //document.getElementById("Tahun").innerHTML = options;
    //     // append placeholder
    //     $('#makercari').append(options);
    //     })

//     $(document).ready(function() {  
       
//     $('#kebuncari').on('click',function(){
//         var kode_kebun = $(this).val();
//         console.log(kode_kebun);
//         if (kode_kebun) {
//             $.ajax ({
//                 url:'../reportdata/kodekebun/' +kode_kebun,
//                 type: 'GET',
//                 data: {
//                     '_token' : '{{ csrf_token() }}'
//                 },
//                 dataType : 'json',
//                 success: function(data) {
//                     if(data) {
//                         $('#namasearch').empty();
//                         $.each(data, function(key, datauser) {
//                             $('select[name="namasearch"]').append (
//                                 '<option value ="'+ datauser.REG + '">' +
//                                 datauser.NAMA + '</option>'
//                             );
//                         });
//                     } else {
//                         $('#namasearch').empty();
//                     }
//                 } 
//             });
//         } 
//     });
// });

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

    // $("#namasearch").select2({ width: '100%' });
    $('.cari').click(function(){
        $searchjab = $('#jabcari').find(":selected").val();
        $searchpendik = $('#pendikcari').find(":selected").val();
        $searchmaker = $('#makercari').find(":selected").val();
 
        $.cookie("jabcari", $searchjab, { expires : 3600 });
        $.cookie("pendikcari", $searchpendik, { expires : 3600 });
        $.cookie("makercari", $searchmaker, { expires : 3600 });
        location.reload();
        // $.cookie("jabcari", "");
        // $.cookie("pendikcari", "");
        // $.cookie("makercari", "");
        // $.cookie("pendikcari", "", { expires : 3600 });
        // $.cookie("makercari", "", { expires : 3600 });       
    });
    $('.cancelsearch').click(function(){
        $.cookie("jabcari", "", { expires : 3600 });
        $.cookie("pendikcari", "", { expires : 3600 });
        $.cookie("makercari", "", { expires : 3600 });
        location.reload();
        
    })

    // $('.nav_sdm').addClass('active');

    
</script>
@endsection