@extends('layouts.master')

@section('content')

<!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Target</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['totalTarget']}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-flag-checkered fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Realisasi Pencacahan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['totalRealisasi']}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Capaian Pencacahan</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$data['sampelCapaian']}}%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{$data['sampelCapaian']}}%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Realisasi Hari Ini</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['realisasiToday']}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <!-- Content Row -->
          <div class="row">
            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-3">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Listing</h6> 
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Listing:</div>
                      <a class="dropdown-item" href="{{ asset(route('listing.progres', [], false)) }}">Detail</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="ListingPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Selesai
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Proses
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Belum
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-3">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Pencacahan</h6> 
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Pencacahan:</div>
                      <a class="dropdown-item" href="{{ asset(route('sampel.progres', [], false)) }}">Detail</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="PencacahanPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Selesai
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Proses
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Belum
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-3">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Pengumpulan Dokumen</h6> 
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Pengumulan Dokumen:</div>
                      <a class="dropdown-item" href="{{ asset(route('dokumen.progres', [], false)) }}">Detail</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="DokumenPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Selesai
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Proses
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Belum
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Realisasi Pencacahan</h6>
                  
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Capaian Kegiatan</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Listing <span class="float-right">{{$data['listingCapaian']}}%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar 
                    @switch(true)
                        @case($data['listingCapaian'] < 20)
                            bg-danger
                            @break
                        @case($data['listingCapaian'] < 40)
                            bg-warning
                            @break
                        @case($data['listingCapaian'] < 60)
                            
                            @break
                        @case($data['listingCapaian'] < 80)
                            bg-info
                            @break   
                        @default
                            bg-success
                    @endswitch 
                    " role="progressbar" style="width: {{$data['listingCapaian']}}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                  </div><br>
                  <h4 class="small font-weight-bold">Pencacahan <span class="float-right">{{$data['sampelCapaian']}}%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar
                    @switch(true)
                        @case($data['sampelCapaian'] < 20)
                            bg-danger
                            @break
                        @case($data['sampelCapaian'] < 40)
                            bg-warning
                            @break
                        @case($data['sampelCapaian'] < 60)
                            
                            @break
                        @case($data['sampelCapaian'] < 80)
                            bg-info
                            @break   
                        @default
                            bg-success
                    @endswitch
                    " role="progressbar" style="width: {{$data['sampelCapaian']}}%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div> <br>
                  <h4 class="small font-weight-bold">Pengumpulan Dokumen <span class="float-right">{{$data['dokumenCapaian']}}%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar 
                    @switch(true)
                        @case($data['dokumenCapaian'] < 20)
                            bg-danger
                            @break
                        @case($data['dokumenCapaian'] < 40)
                            bg-warning
                            @break
                        @case($data['dokumenCapaian'] < 60)
                            
                            @break
                        @case($data['dokumenCapaian'] < 80)
                            bg-info
                            @break   
                        @default
                            bg-success
                    @endswitch
                    " role="progressbar" style="width: {{$data['dokumenCapaian']}}%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  {{-- <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                  <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div> --}}
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="row">
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Capaian Petugas</h6>                 
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="CapaianPetugasChart"></canvas>
                  </div>
                </div>
              </div>
            </div>    
          </div>         
 @stop

 @push('scripts')
  <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';


    var cData = JSON.parse(`<?php echo $dashboard; ?>`);

    // Pie Chart Listing
    var ctx = document.getElementById("ListingPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ["Selesai", "Proses", "Belum"],
        datasets: [{
          data: [cData.listingSelesai, cData.listingProses, cData.listingBelum],
          backgroundColor: ['#1cc88a', '#36b9cc', '#4e73df'],
          hoverBackgroundColor: ['#17a673', '#2c9faf', '#2e59d9'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 65,
      },
    });

    // Pie Chart Pencacahan
    var ctx = document.getElementById("PencacahanPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ["Selesai", "Proses", "Belum"],
        datasets: [{
          data: [cData.sampelSelesai, cData.sampelProses, cData.sampelBelum],
          backgroundColor: ['#1cc88a', '#36b9cc', '#4e73df'],
          hoverBackgroundColor: ['#17a673', '#2c9faf', '#2e59d9'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 65,
      },
    });


    // Pie Chart Pencacahan
    var ctx = document.getElementById("DokumenPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ["Selesai", "Proses", "Belum"],
        datasets: [{
          data: [cData.dokumenSelesai, cData.dokumenProses, cData.dokumenBelum],
          backgroundColor: ['#1cc88a', '#36b9cc', '#4e73df'],
          hoverBackgroundColor: ['#17a673', '#2c9faf', '#2e59d9'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 65,
      },
    });

    function number_format(number, decimals, dec_point, thousands_sep) {
      // *     example: number_format(1234.56, 2, ',', ' ');
      // *     return: '1 234,56'
      number = (number + '').replace(',', '').replace(' ', '');
      var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
          var k = Math.pow(10, prec);
          return '' + Math.round(n * k) / k;
        };
      // Fix for IE parseFloat(0.55).toFixed(0) = 0;
      s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
      if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
      }
      if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
      }
      return s.join(dec);
    }

    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: cData.labelArea,
        datasets: [{
          label: "Selesai Pencacahan",
          lineTension: 0.3,
          backgroundColor: "rgba(78, 115, 223, 0.05)",
          borderColor: "rgba(78, 115, 223, 1)",
          pointRadius: 3,
          pointBackgroundColor: "rgba(78, 115, 223, 1)",
          pointBorderColor: "rgba(78, 115, 223, 1)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
          pointHoverBorderColor: "rgba(78, 115, 223, 1)",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: cData.dataArea,
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{         
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              maxTicksLimit: 7
            }
          }],
          yAxes: [{
            ticks: {
              maxTicksLimit: 5,
              padding: 10,
              
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: false,
          mode: 'index',
          caretPadding: 10,
        }
      }
    });

  </script>

 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 <script>
   // Bar Chart Capaian Petugas
  var cDatax = JSON.parse(`<?php echo $dashboard; ?>`);
  var ctx = document.getElementById("CapaianPetugasChart");
  var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: cDatax.label,
      datasets: [
      {
        label: "Listing (%)",
        data: cDatax.realisasiListing,
        backgroundColor: '#1cc88a',
        hoverBackgroundColor: '#17a673',
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      },
      {
        label: "Pencacahan (%)",
        data: cDatax.realisasiSampel,
        backgroundColor: '#36b9cc',
        hoverBackgroundColor: '#2c9faf',
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      },
      {
        label: "Dokumen (%)",
        data: cDatax.realisasiDokumen,
        backgroundColor: '#4e73df',
        hoverBackgroundColor: '#2e59d9',
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }
      ],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      responsive: true,
      scales: {
        x: {
          stacked: true,
        },
        y: {
          stacked: true,
        },
      },
      legend: {
        display: false
      },
    }
  });

 </script>
 @endpush