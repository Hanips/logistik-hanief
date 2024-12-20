@extends('layouts.index')

@section('title_page', 'Data Barang Keluar')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('adminpage/modules/datatables/datatables.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <div class="title">
                    <h1>{{ __('Data Barang Keluar') }}</h1>
                </div>
                <div class="d-md-flex d-inline">
                    @if (Auth::user()->role != 'Staff')
                        <button class="btn btn-success mx-2 my-3 my-md-0" data-toggle="modal" data-target="#exportModal">
                            <i class="fas fa-file mx-1"></i> Export Barang Keluar
                        </button>
                    @endif
                    <div class="right-content">
                        <a href="{{ route('barang-keluar.create') }}" class="btn btn-primary">{{ __('+ Tambah Barang Keluar') }}</a>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Tabel Barang Keluar') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="datatables">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Jumlah</th>
                                        <th>Tujuan Barang</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($barangKeluar as $barang)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $barang->kode_barang }}</td>
                                            <td>{{ $barang->quantity }}</td>
                                            <td>{{ $barang->destination }}</td>
                                            <td>{{ $barang->tanggal_keluar->format('d M Y') }}</td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    {{-- <a class="btn btn-info btn-sm me-1" href="{{ route('barang-keluar.show', $barang->id) }}" title="Detail">
                                                        <i class="fa fa-eye"></i>
                                                    </a> --}}
                                                    @if (Auth::user()->role != 'Staff')
                                                        <div class="text-danger mx-2 cursor-pointer">
                                                            <button class="btn btn-danger btn-sm delete-button" data-barang-id="{{ $barang->id }}" title="Hapus">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada data barang keluar.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="exportModal">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Export Barang Keluar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-action" method="post" action="{{ route('barang-keluar.excel') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row pt-3 pb-1">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="start_date">Tanggal Mulai</label>
                                    <input type="date" id="start_date" class="form-control" name="start_date" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="finish_date">Tanggal Selesai</label>
                                    <input type="date" id="finish_date" class="form-control" name="finish_date" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Export Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('form-action').addEventListener('submit', function(event) {
                event.preventDefault();
                var startDate = new Date(document.getElementById('start_date').value);
                var finishDate = new Date(document.getElementById('finish_date').value);

                if (finishDate <= startDate) {
                    Notiflix.Notify.failure('Tanggal selesai harus lebih dari tanggal mulai');
                } else {
                    event.target.submit();
                }
            });
            document.addEventListener('DOMContentLoaded', function() {
                const deleteButtons = document.querySelectorAll('.delete-button');
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const barangId = button.getAttribute('data-barang-id');

                        Notiflix.Confirm.show('Konfirmasi', 'Apakah Anda yakin ingin menghapus data ini?', 'Ya', 'Batal',
                            function() {
                                fetch(`/barang-keluar/delete/${barangId}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            Notiflix.Notify.success('Data berhasil dihapus!', {
                                                timeout: 3000
                                            });
                                            location.reload();
                                        } else {
                                            Notiflix.Notify.failure(data.message, {
                                                timeout: 3000
                                            });
                                        }
                                    })
                                    .catch(error => {
                                        Notiflix.Notify.failure('Terjadi kesalahan saat menghapus data.', {
                                            timeout: 3000
                                        });
                                    });
                            });
                    });
                });
            });
        </script>
        <script src="{{ asset('adminpage/modules/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('adminpage/js/page/modules-datatables.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#datatables').dataTable();
            });
        </script>
    @endpush
@endsection
