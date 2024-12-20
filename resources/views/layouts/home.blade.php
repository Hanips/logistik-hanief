@if (Auth::user()->role == 'Manager')
    @extends('layouts.index')

    @section('title_page', 'Dashboard')

    @section('content')
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header d-flex justify-content-between">
                        <div class="title">
                            <h1>{{ __('Dashboard') }}</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="bg-primary">
                                    <div class="py-1"></div>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Barang Masuk Hari Ini</h4>
                                    </div>
                                    <div class="card-body py-2">
                                        <h5>{{ $barangMasuk }}</h5>
                                    </div>
                                    <div class="py-2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="bg-success">
                                    <div class="py-1"></div>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Barang Keluar Hari Ini</h4>
                                    </div>
                                    <div class="card-body py-2">
                                        <h5>{{ $barangKeluar }}</h5>
                                    </div>
                                    <div class="py-2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="bg-warning">
                                    <div class="py-1"></div>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Stok Rendah (Qty < 50)</h4>
                                    </div>
                                    <div class="card-body py-2">
                                        <h5>{{ $stokRendah }}</h5>
                                    </div>
                                    <div class="py-2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="bg-danger">
                                    <div class="py-1"></div>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4></h4>
                                    </div>
                                    <div class="card-body py-2">
                                        {{-- <h5>{{ $ }}</h5> --}}
                                    </div>
                                    <div class="py-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="row">
                                    <!-- Grafik Barang Masuk Harian -->
                                    <div class="col-xl-6">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <i class="fas fa-chart-bar me-1"></i>
                                                Barang Masuk Harian
                                            </div>
                                            <div class="card-body">
                                                <canvas id="barChartBarangMasuk" width="100%" height="40"></canvas>
                                            </div>
                                            <script>
                                                document.addEventListener("DOMContentLoaded", () => {
                                                    var tanggalLabels = [@foreach($masukHarian as $masuk) '{{ $masuk['tanggal'] }}', @endforeach];
                                                    
                                                    tanggalLabels = tanggalLabels.map(date => {
                                                        const [year, month, day] = date.split('-');
                                                        return `${day}-${month}-${year}`;
                                                    });
                    
                                                    var dataMasuk = [@foreach($masukHarian as $masuk) {{ $masuk['total'] }}, @endforeach];
                    
                                                    var ctx = document.getElementById('barChartBarangMasuk').getContext('2d');
                                                    var barChart = new Chart(ctx, {
                                                        type: 'bar',
                                                        data: {
                                                            labels: tanggalLabels,
                                                            datasets: [{
                                                                label: 'Jumlah Barang Masuk',
                                                                data: dataMasuk,
                                                                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                                                borderColor: 'rgba(54, 162, 235, 1)',
                                                                borderWidth: 1
                                                            }]
                                                        },
                                                        options: {
                                                            scales: {
                                                                y: {
                                                                    beginAtZero: true,
                                                                    ticks: {
                                                                        stepSize: 1, 
                                                                        callback: function(value) {
                                                                            return Number.isInteger(value) ? value : '';
                                                                        }
                                                                    }
                                                                }
                                                            },
                                                            plugins: {
                                                                legend: {
                                                                    display: true,
                                                                    position: 'top'
                                                                }
                                                            }
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    
                                    <!-- Grafik Barang Keluar Harian -->
                                    <div class="col-xl-6">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <i class="fas fa-chart-bar me-1"></i>
                                                Barang Keluar Harian
                                            </div>
                                            <div class="card-body">
                                                <canvas id="barChartBarangKeluar" width="100%" height="40"></canvas>
                                            </div>
                                            <script>
                                                document.addEventListener("DOMContentLoaded", () => {
                                                    var tanggalLabels = [@foreach($keluarHarian as $keluar) '{{ $keluar['tanggal'] }}', @endforeach];
                                                    
                                                    tanggalLabels = tanggalLabels.map(date => {
                                                        const [year, month, day] = date.split('-');
                                                        return `${day}-${month}-${year}`;
                                                    });
                    
                                                    var dataKeluar = [@foreach($keluarHarian as $keluar) {{ $keluar['total'] }}, @endforeach];
                    
                                                    var ctx = document.getElementById('barChartBarangKeluar').getContext('2d');
                                                    var barChart = new Chart(ctx, {
                                                        type: 'bar',
                                                        data: {
                                                            labels: tanggalLabels,
                                                            datasets: [{
                                                                label: 'Jumlah Barang Keluar',
                                                                data: dataKeluar,
                                                                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                                                                borderColor: 'rgba(255, 99, 132, 1)', 

                                                                borderWidth: 1
                                                            }]
                                                        },
                                                        options: {
                                                            scales: {
                                                                y: {
                                                                    beginAtZero: true,
                                                                    ticks: {
                                                                        stepSize: 1,
                                                                        callback: function(value) {
                                                                            return Number.isInteger(value) ? value : '';
                                                                        }
                                                                    }
                                                                }
                                                            },
                                                            plugins: {
                                                                legend: {
                                                                    display: true,
                                                                    position: 'top'
                                                                }
                                                            }
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    @endsection
@else
    @include('layouts.access_denied')
@endif
