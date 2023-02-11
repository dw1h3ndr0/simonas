@extends('layouts.master')

@section('content')

<!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Progres Listing</h1>
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
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Realisasi</div>
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
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Capaian</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$data['capaian']}}%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{$data['capaian']}}%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
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
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Progres Listing Petugas</h6>                 
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="ProgresListingChart"></canvas>
                  </div>
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
                  <h6 class="m-0 font-weight-bold text-primary">Realisasi Listing Petugas</h6>                 
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="RealisasiListingChart"></canvas>
                  </div>
                </div>
              </div>
            </div>    
          </div>  

      
 @stop

 @push('scripts')

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
  <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
    // Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    // Chart.defaults.global.defaultFontColor = '#858796';
    
    var cDataListing = JSON.parse(`<?php echo $data_listing; ?>`);
    
    // Bar Chart Progres Listing
    var ctx = document.getElementById("ProgresListingChart");
    var myLineChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: cDataListing.label,
        datasets: [
        {
          label: "Selesai",
          data: cDataListing.selesai,
          backgroundColor: '#1cc88a',
          hoverBackgroundColor: '#17a673',
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        },
        {
          label: "Belum",
          data: cDataListing.belum,
          backgroundColor: '#36b9cc',
          hoverBackgroundColor: '#2c9faf',
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

    // Bar Chart Realisasi Listing
    var ctx = document.getElementById("RealisasiListingChart");
    var myLineChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: cDataListing.label,
        datasets: [
        {
          label: "Realisasi (%)",
          data: cDataListing.realisasi,
          backgroundColor: '#1cc88a',
          hoverBackgroundColor: '#17a673',
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
            stacked: false,
          },
          y: {
            stacked: false,
          },          
        },
        legend: {
          display: false
        },
      }
    });

  </script>
 @endpush