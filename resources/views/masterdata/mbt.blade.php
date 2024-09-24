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
<h1 class="h3 mb-2 text-gray-800">INPUT MBT KARPEL</h1>
    <div class="card shadow mb-4">
    <form class="form-bordered " method="POST" action="generatembt" enctype="multipart/form-data">
    @csrf 
        <div class="card-body row" style="font-size: 0.85em;">
   
            <div class="col-md-5">           
                <div class="form-group row">
                    <label for="TglTransaksi" class="col-md-3 control-label" style="text-align: left"><strong>TMT :</strong></label>
                        <input type="date" class="col-sm-3 form-control form-control-user"
                        id="TglTransaksi" name="TglTransaksi" aria-describedby="TglTransaksi" value="{{$searchtanggal}}"
                        placeholder="Tgl. Transaksi..." required>
                </div>
                <div class="form-group row">
                    <label for="NoSK" class="col-md-3 control-label" style="text-align: left"><strong>Nomor SK :</strong></label>
                        <input type="text" class="col-sm-7 form-control form-control-user"
                        id="NoSK" name="NoSK" aria-describedby="NoSK" value="{{$searchnosk}}"
                        placeholder="Nomor SK ..." required>
                </div> 
                <div class="form-group row">
                    <label for="TglSK" class="col-md-3 control-label" style="text-align: left"><strong>Tanggal SK :</strong></label>
                        <input type="date" class="col-sm-3 form-control form-control-user"
                        id="TglSK" name="TglSK" aria-describedby="TglSK" value="{{$searchtglsk}}"
                        placeholder="Tgl. SK ..." required>
                </div>                               
                <div class="form-group row">
                    <label for="NmPejabat" class="col-md-3 control-label" style="text-align: left"><strong>Nama Pejabat :</strong></label>
                        <input type="text" class="col-sm-7 form-control form-control-user"
                        id="NmPejabat" name="NmPejabat" aria-describedby="NmPejabat" value="{{$searchnmpejabat}}"
                        placeholder="Nama Pejabat ..." required>
                </div> 
                <div class="panel-body button_action">
                            <button class="btn btn-primary btn-rounded">SIMPAN</button>
                </div> 
                <div class="panel-body" id="errorMessage"> 
                            
                </div>                               
            </div>
             
        </form>  
        </div>

    
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        
        <div class="card-body">
            <form action="{{url('/masterdata/mbt')}}" method="get">              
            
            <br><br>   
            <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align:center">NPP</th>

                            <th style="text-align:center">KD_MUTASI</th>
                            <th style="text-align:center">KD_JABATAN</th>
                            <th style="text-align:center">TMT</th>
                            <th style="text-align:center">NO_SK</th>
                            <th style="text-align:center">TGL_SK</th>
                            <th style="text-align:center">NM_PEJABAT</th>
                            <th style="text-align:center">EMPLOYEESUBGRUP</th>
                            <!-- <th style="text-align:center">AKSI</th> -->
                        </tr>
                    </thead>
                    <tbody style='font-size: 0.85em;'>

                        @foreach($dataallusers as $key)
                        <tr>
                            <td style="text-align:center">{{$key->NPP}}</td>
                            
                            <td style="text-align:center">{{$key->Kd_Mutasi}}</td>
                            <th style="text-align:center">{{$key->Kd_Jabatan}}</th>
                            <th style="text-align:center">{{$key->TMT}}</th>
                            <th style="text-align:center">{{$key->No_SK}}</th>
                            <th style="text-align:center">{{$key->Tgl_SK}}</th>
                            <th style="text-align:center">{{$key->NmPejabat}}</th>
                            <th style="text-align:center">{{$key->EmployeeSubGrup}}</th>
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

    $('.cari').click(function(){

        $searchtanggal = $('#TglTransaksi').find(":selected").val();
        $searchnosk = $('#NoSK').find(":selected").val();
        $searchtglsk = $('#TglSK').find(":selected").val();
        $searchnmpejabat = $('#NmPejabat').find(":selected").val();

        $.cookie("TglTransaksi", $searchtanggal, { expires : 3600 });
        $.cookie("NoSK", $searchnosk, { expires : 3600 });
        $.cookie("TglSK", $searchtglsk, { expires : 3600 });
        $.cookie("NmPejabat", $searchnmpejabat, { expires : 3600 });
        location.reload();
    });
    $('.cancelsearch').click(function(){
        $.cookie("TglTransaksi", "", { expires : 3600 });
        $.cookie("NoSK", "", { expires : 3600 });
        $.cookie("TglSK", "", { expires : 3600 });
        $.cookie("NmPejabat", "", { expires : 3600 });

        location.reload();
    })    


    // $('.nav_sdm').addClass('active');
</script>
@endsection