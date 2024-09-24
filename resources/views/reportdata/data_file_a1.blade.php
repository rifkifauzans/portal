@extends('layouts.app')
@section('content')
<div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-pencil"></i>
            </div>
            <div class="media-body">
                <h4>
                </h4>
                <br>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="card shadow mb-4">
        
        <div class="card-body">
            <div class="row justify-content-left">

                <div class="panel panel-default formmasuk col-md-6">
                    <form class="form-bordered " method="POST" action="generatefilea1" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="panel-heading">
                        <h1 class="h5 mb-2 text-gray-800">Generate File A1</h1>
                            <p>Pilih tanggal generate. </p>
                            
                    </div><!-- panel-heading -->
                    
                    <div class="panel-body nopadding"> 

                    <div class="form-group">
                            <label class="col-sm-4 control-label">Tanggal</label>
                            <div class="col-sm-8">
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input type="date" class="form-control required" value="{{$tanggal}}" name="datepickergenerate" id="datepickergenerate">
                                </div><!-- input-group -->
                            </div>
                        </div>

                        <div class="panel-body button_action">
                            <button class="btn btn-primary btn-rounded addbkm">Generate</button>
                        </div> 
                        <div class="panel-body" id="errorMessage"> 
                            
                        </div> 
                    </div><!-- panel-body        -->
                    </form> 
                </div><!-- panel-->
            </div><!-- row -->
        </div>
        
    </div><!-- contentpanel -->

    <div class="card shadow mb-4">
        
        <div class="card-body">
            <div class="row justify-content-left">

                <div class="panel panel-default formmasuk col-md-6">
                    <form class="form-bordered " method="POST" action="exportfilea1" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="panel-heading">
                        <h1 class="h5 mb-2 text-gray-800">Export File A1 Karyawan Aktif</h1>
                            <p>Pilih tanggal export. </p>
                            
                    </div><!-- panel-heading -->
                    
                    <div class="panel-body nopadding"> 

                    <div class="form-group">
                            <label class="col-sm-4 control-label">Tanggal</label>
                            <div class="col-sm-8">
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input type="date" class="form-control required" value="{{date('Y-m-d')}}"  name="datepickerexport" id="datepickerexport">
                                </div><!-- input-group -->
                            </div>
                        </div>

                        <div class="panel-body button_action">
                            <button class="btn btn-success btn-rounded addbkm">Export</button>
                        </div> 
                        <div class="panel-body" id="errorMessage"> 
                            
                        </div> 
                    </div><!-- panel-body        -->
                    </form> 
                </div><!-- panel-->
            </div><!-- row -->
        </div>
        
    </div><!-- contentpanel -->

    <div class="card shadow mb-4">
        
        <div class="card-body">
            <div class="row justify-content-left">

                <div class="panel panel-default formmasuk col-md-6">
                    <form class="form-bordered " method="POST" action="exportfilea1_tidakaktif" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="panel-heading">
                        <h3 class="h5 mb-2 text-gray-800">Export File A1 Karyawan Tidak Aktif</h3>
                            <p>Pilih tanggal export. </p>
                            
                    </div><!-- panel-heading -->
                    
                    <div class="panel-body nopadding"> 

                    <div class="form-group">
                            <label class="col-sm-4 control-label">Tanggal</label>
                            <div class="col-sm-8">
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input type="date" class="form-control required" value="{{date('Y-m-d')}}"  name="datepickerexport" id="datepickerexport">
                                </div><!-- input-group -->
                            </div>
                        </div>

                        <div class="panel-body button_action">
                            <button class="btn btn-success btn-rounded addbkm">Export</button>
                        </div> 
                        <div class="panel-body" id="errorMessage"> 
                            
                        </div> 
                    </div><!-- panel-body        -->
                    </form> 
                </div><!-- panel-->
            </div><!-- row -->
        </div>
        
    </div><!-- contentpanel -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        @if($errors->any())
        Swal.fire({
            title: "Error",
            text: "@foreach ($errors->all() as $error){{ $error }},@endforeach",
            icon: "error"
        });
        
    @endif
    @if(session('sukses'))
        Swal.fire({
            title: "Sukses",
            text: "{{session('sukses')}}",
            icon: "success"
        });
    @endif
    </script>
@endsection