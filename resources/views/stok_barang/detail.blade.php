@extends('layouts.index')
@section('title_page', 'Detail Stok Barang')
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('adminpage/modules/datatables/datatables.min.css') }}">
    @endpush
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Stok Barang</h1>
                <div class="section-header-breadcrumb">
                    @if (Auth::user()->role == 'Manager')
                        <div class="breadcrumb-item active"><a href="{{ url('/') }}">Dashboard</a></div>
                    @endif
                    <div class="breadcrumb-item"><a href="{{ url('/stok-barang') }}">Data Stok Barang</a></div>
                    <div class="breadcrumb-item">Detail Stok Barang</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Detail Stok Barang</h4>
                            </div>
                            <div class="card-body">
                                <div class="row-md-4">
                                    <div class="row align-items-center mb-4">
                                        <div class="col-md-4">
                                            <label for="kode_barang" class="form-label">Kode Barang</label>
                                            <input class="form-control" value="{{ $stokBarang->kode_barang }}" id="kode_barang" type="text" placeholder="Kode Barang" disabled />
                                        </div>
                                    
                                        <div class="col-md-4">
                                            <label for="quantity" class="form-label">Quantity</label>
                                            <input class="form-control" value="{{ $stokBarang->quantity }}" id="quantity" type="text" placeholder="Quantity" disabled />
                                        </div>
                                    
                                        <div class="col-md-4">
                                            <label for="status" class="form-label">Status Stok</label>
                                            <div>
                                                @if ($stokBarang->quantity < 100)
                                                    <div class="badge badge-danger">Stok Rendah</div>
                                                @else
                                                    <div class="badge badge-success">Stok Cukup</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <!-- Transaksi Terakhir -->
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Transaksi Terakhir</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-striped">
                                                        @if ($transaksiTerakhir->isEmpty())
                                                            <p class="text-center">Tidak ada transaksi pada barang ini</p>
                                                        @else
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Jenis Transaksi</th>
                                                                    <th>Kode Barang</th>
                                                                    <th>Quantity</th>
                                                                    <th>Tujuan/Asal</th>
                                                                    <th>Tanggal</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($transaksiTerakhir as $index => $transaksi)
                                                                    <tr>
                                                                        <td>{{ $index + 1 }}</td>
                                                                        <td>
                                                                            @if ($transaksi->jenis == 'Masuk')
                                                                                <div class="badge badge-success">Masuk</div>
                                                                            @else
                                                                                <div class="badge badge-danger">Keluar</div>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $transaksi->kode_barang }}</td>
                                                                        <td>{{ $transaksi->quantity }}</td>
                                                                        <td>
                                                                            @if ($transaksi->jenis == 'Masuk')
                                                                                {{ $transaksi->origin }}
                                                                            @else
                                                                                {{ $transaksi->destination }}
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $transaksi->tanggal->format('d-m-Y') }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        @endif
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-left">
                                    <a href="{{ url('/stok-barang/') }}" class="btn btn-primary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
