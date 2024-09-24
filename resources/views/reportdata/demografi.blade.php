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

</style>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>
<div class="card shadow mb-4">
    
        <div class="card-body row" style="font-size: 0.85em;">
            <div class="col-md-5">           
                <div class="form-group row">
                    <label for="namasearch" class="col-md-2 control-label" style="text-align: left"><strong>Tanggal Transaksi :</strong></label>
                        <input type="date" class="col-sm-7 form-control form-control-user"
                        id="TglTransaksi" name="TglTransaksi" aria-describedby="TglTransaksi" value="{{$searchtanggal}}"
                        placeholder="Tgl. Transaksi..." required>
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
<div class="row">

    <!-- Pending Requests Card Example -->
    

    <!-- Pending Requests Card Example -->
    
</div>

<div class="row">
    <div class="col-xl-6 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">PENDIDIKAN</h6>
                
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div id="column_chart"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">GRADE</h6>
                
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div id="column_grading"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">USIA</h6>
                
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div id="column_usia"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">GENDER</h6>
                
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div id="column_gender"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">UNIT KERJA</h6>
                
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div id="column_unit"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">GENDER</h6>
                
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div id="column_gender"></div>
            </div>
        </div>
    </div>
</div>
                        

<!-- DASHBOARD DOKUMEN -->
<!--
<div class="row">
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
            <a href="{{url('/')}}/dokumen/perizinan_expired">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text font-weight-bold text-primary text-uppercase mb-1">
                            PERIZINAN AKAN BERAKHIR</div>
                        <div class="h1 mb-0 font-weight-bold text-gray-800">{{isset($dataperizinanexpired)?$dataperizinanexpired:''}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <a href="{{url('/')}}/dokumen/sertifikasi_expired">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text font-weight-bold text-success text-uppercase mb-1">
                            SERTIFIKASI AKAN BERAKHIR</div>
                        <div class="h1 mb-0 font-weight-bold text-gray-800">{{isset($datasertifikasiexpired)?$datasertifikasiexpired:''}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>



    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <a href="{{url('/')}}/dokumen/perjanjiankerjasama_expired">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text font-weight-bold text-warning text-uppercase mb-1">
                            PERJANJIAN KERJASAMA AKAN BERAKHIR</div>
                            <div class="h1 mb-0 font-weight-bold text-gray-800">{{isset($dataperjanjiankerjasamaexpired)?$dataperjanjiankerjasamaexpired:''}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <a href="{{url('/')}}/dokumen/mou_expired">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text font-weight-bold text-info text-uppercase mb-1">
                            MOU AKAN BERAKHIR</div>
                            <div class="h1 mb-0 font-weight-bold text-gray-800">{{isset($datamouexpired)?$datamouexpired:''}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-box fa-2x text-gray-300"></i>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
</div>
-->

<div class="card shadow mb-4">
    <img src="{{url('/')}}/kebunteh.jpg" style="width: 100%; height: auto;">
    <!-- <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">REGION</h6>
    </div>
    <div class="card-body">
        <p>Informasi total region dalam database stakeholder. Terdapat 8 region yaitu, Region 1, Region 2, Region 3, Region 4, Region 5, Region 6, Region 7 dan Region 8</p>
    </div> -->
</div>
<!-- <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">STAKEHOLDER</h6>
    </div>
    <div class="card-body">
        <p>Informasi total data Instansi/Stakeholder keseluruhan region yang ada dalam database</p>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-warning">KATEGORI</h6>
    </div>
    <div class="card-body">
        <p>Informasi total persentase data Stakeholder Governance atau Non Governance dari keseluruhan total data</p>
    </div>
</div> -->



<script>
    $('.nav_sdm').addClass('active');
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>






<script type="text/javascript">
    $('.cari').click(function(){
    //TglTransaksi = $('#TglTransaksi').find(":selected").val();
    TglTransaksi = $('#TglTransaksi').val();
    $.cookie("TglTransaksi", TglTransaksi, { expires : 3600 });
    location.reload();
    });
    $('.cancelsearch').click(function(){
        $.cookie("TglTransaksi", "", { expires : 3600 });
        location.reload();
    })
</script>

<script>
        Highcharts.chart('column_chart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Pendidikan (Karyawan Tetap)',
            },
            yAxis: {
                title: {
                    text: 'Jml. Karyawan'
                }
            },

            xAxis: {
                categories: <?= json_encode($column_pendidikan['categories']) ?>
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                }
            },

            series: [{
                    name: 'SD',
                    data: <?= json_encode($column_pendidikan['data']) ?>
                },
                {
                    name: 'SMP',
                    //color: '#FF530D',
                    data: <?= json_encode($column_pendidikan['data2']) ?>
                           
                },
                {
                    name: 'SMA',
                    //color: '#FF530D',
                    data: <?= json_encode($column_pendidikan['data3']) ?>
                           
                },
                {
                    name: 'D1',
                    //color: '#FF530D',
                    data: <?= json_encode($column_pendidikan['data4']) ?>
                           
                },
                {
                    name: 'D2',
                    //color: '#FF530D',
                    data: <?= json_encode($column_pendidikan['data5']) ?>
                           
                },
                {
                    name: 'D3',
                    //color: '#FF530D',
                    data: <?= json_encode($column_pendidikan['data6']) ?>
                           
                },
                {
                    name: 'S1',
                    //color: '#FF530D',
                    data: <?= json_encode($column_pendidikan['data7']) ?>
                           
                },
                {
                    name: 'S2',
                    //color: '#FF530D',
                    data: <?= json_encode($column_pendidikan['data8']) ?>
                           
                },
                {
                    name: 'S3',
                    //color: '#FF530D',
                    data: <?= json_encode($column_pendidikan['data9']) ?>
                           
                }
            ],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    </script>

<script>
        Highcharts.chart('column_grading', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grading',
            },
            yAxis: {
                title: {
                    text: 'Jml. Karyawan'
                }
            },

            xAxis: {
                categories: <?= json_encode($column_grading['categories']) ?>
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                }
            },

            series: [{
                    name: 'NG',
                    data: <?= json_encode($column_grading['data']) ?>
                },
                {
                    name: '6',
                    //color: '#FF530D',
                    data: <?= json_encode($column_grading['data2']) ?>
                           
                },
                {
                    name: '7',
                    //color: '#FF530D',
                    data: <?= json_encode($column_grading['data3']) ?>
                           
                },
                {
                    name: '8',
                    //color: '#FF530D',
                    data: <?= json_encode($column_grading['data4']) ?>
                           
                },
                {
                    name: '9',
                    //color: '#FF530D',
                    data: <?= json_encode($column_grading['data5']) ?>
                           
                },
                {
                    name: '10',
                    //color: '#FF530D',
                    data: <?= json_encode($column_grading['data6']) ?>
                           
                },
                {
                    name: '11',
                    //color: '#FF530D',
                    data: <?= json_encode($column_grading['data7']) ?>
                           
                },
                {
                    name: '12',
                    //color: '#FF530D',
                    data: <?= json_encode($column_grading['data8']) ?>
                           
                },
                {
                    name: '13',
                    //color: '#FF530D',
                    data: <?= json_encode($column_grading['data9']) ?>
                           
                },
                {
                    name: '14',
                    //color: '#FF530D',
                    data: <?= json_encode($column_grading['data10']) ?>
                           
                },
                {
                    name: '15',
                    //color: '#FF530D',
                    data: <?= json_encode($column_grading['data11']) ?>
                           
                },
                {
                    name: '16',
                    //color: '#FF530D',
                    data: <?= json_encode($column_grading['data12']) ?>
                           
                },
                {
                    name: '17',
                    //color: '#FF530D',
                    data: <?= json_encode($column_grading['data13']) ?>
                           
                },
                {
                    name: '18',
                    //color: '#FF530D',
                    data: <?= json_encode($column_grading['data14']) ?>
                           
                },
                {
                    name: '19',
                    //color: '#FF530D',
                    data: <?= json_encode($column_grading['data15']) ?>
                           
                },
                {
                    name: '20',
                    //color: '#FF530D',
                    data: <?= json_encode($column_grading['data16']) ?>
                           
                },
                {
                    name: '21',
                    //color: '#FF530D',
                    data: <?= json_encode($column_grading['data17']) ?>
                           
                },
                {
                    name: '22',
                    //color: '#FF530D',
                    data: <?= json_encode($column_grading['data18']) ?>
                           
                }
            ],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    </script>

<script>
        Highcharts.chart('column_usia', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Usia',
            },
            yAxis: {
                title: {
                    text: 'Jml. Karyawan'
                }
            },

            xAxis: {
                categories: <?= json_encode($column_usia['categories']) ?>
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                }
            },

            series: [{
                    name: '<26',
                    data: <?= json_encode($column_usia['data']) ?>
                },
                {
                    name: '26-30',
                    //color: '#FF530D',
                    data: <?= json_encode($column_usia['data2']) ?>
                           
                },
                {
                    name: '31-35',
                    //color: '#FF530D',
                    data: <?= json_encode($column_usia['data3']) ?>
                           
                },
                {
                    name: '36-40',
                    //color: '#FF530D',
                    data: <?= json_encode($column_usia['data4']) ?>
                           
                },
                {
                    name: '41-45',
                    //color: '#FF530D',
                    data: <?= json_encode($column_usia['data5']) ?>
                           
                },
                {
                    name: '46-50',
                    //color: '#FF530D',
                    data: <?= json_encode($column_usia['data6']) ?>
                           
                },
                {
                    name: '>50',
                    //color: '#FF530D',
                    data: <?= json_encode($column_usia['data7']) ?>
                           
                }
            ],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    </script>

<script>
        Highcharts.chart('column_gender', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Gender',
            },
            yAxis: {
                title: {
                    text: 'Jml. Karyawan'
                }
            },

            xAxis: {
                categories: <?= json_encode($column_gender['categories']) ?>
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                }
            },

            series: [{
                    name: 'L',
                    data: <?= json_encode($column_gender['data']) ?>
                },
                {
                    name: 'P',
                    //color: '#FF530D',
                    data: <?= json_encode($column_gender['data2']) ?>
                           
                }
            ],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    </script>
    <script>
        Highcharts.chart('column_unit', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Unit Kerja',
            },
            yAxis: {
                title: {
                    text: 'Jml. Karyawan'
                }
            },

            xAxis: {
                categories: <?= json_encode($column_unit['categories']) ?>
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                }
            },

            series: [{
                    name: 'Kanpus',
                    data: <?= json_encode($column_unit['data']) ?>
                },
                {
                    name: 'Distrik',
                    //color: '#FF530D',
                    data: <?= json_encode($column_unit['data2']) ?>
                           
                },
                {
                    name: 'Kebun',
                    //color: '#FF530D',
                    data: <?= json_encode($column_unit['data3']) ?>
                           
                },
                {
                    name: 'Pabrik',
                    //color: '#FF530D',
                    data: <?= json_encode($column_unit['data4']) ?>
                           
                },
                {
                    name: 'Penugasan',
                    //color: '#FF530D',
                    data: <?= json_encode($column_unit['data5']) ?>
                           
                },
                {
                    name: 'MBT',
                    //color: '#FF530D',
                    data: <?= json_encode($column_unit['data6']) ?>
                           
                },
                {
                    name: 'CDT',
                    //color: '#FF530D',
                    data: <?= json_encode($column_unit['data7']) ?>
                           
                }
            ],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    </script>
@endsection