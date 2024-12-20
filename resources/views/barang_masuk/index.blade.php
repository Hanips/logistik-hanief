@extends('layouts.index')

@section('title_page', 'Data Barang Masuk')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('adminpage/modules/datatables/datatables.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <div class="title">
                    <h1>{{ __('Data Barang Masuk') }}</h1>
                </div>
                <div class="d-md-flex d-inline">
                    @if (Auth::user()->role != 'Staff')
                        <button class="btn btn-success mx-2 my-3 my-md-0" data-toggle="modal" data-target="#exportModal">
                            <i class="fas fa-file mx-1"></i> Export Barang Masuk
                        </button>
                    @endif
                    <button class="btn btn-primary mx-2 my-3 my-md-0" data-toggle="modal" data-target="#importModal">
                        <i class="fas fa-file-import mx-1"></i> Import Barang Masuk
                    </button>                    
                    <div class="right-content">
                        <a href="{{ route('barang-masuk.create') }}" class="btn btn-primary">{{ __('+ Tambah Barang Masuk') }}</a>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Tabel Barang Masuk') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="datatables">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Jumlah</th>
                                        <th>Asal Barang</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($barangMasuk as $barang)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $barang->kode_barang }}</td>
                                            <td>{{ $barang->quantity }}</td>
                                            <td>{{ $barang->origin }}</td>
                                            <td>{{ $barang->tanggal_masuk->format('d M Y') }}</td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    {{-- <a class="btn btn-info btn-sm me-1" href="{{ route('barang-masuk.show', $barang->id) }}" title="Detail">
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
                                            <td colspan="6" class="text-center">Belum ada data barang masuk.</td>
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
                    <h5 class="modal-title">Export Barang Masuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-action" method="post" action="{{ route('barang-masuk.excel') }}">
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

    <div class="modal fade" tabindex="-1" role="dialog" id="importModal">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Barang Masuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-import" method="post" action="{{ route('barang-masuk.import') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file_excel">Pilih File Excel</label>
                            <input type="file" id="file_excel" class="form-control" name="file_excel" accept=".xlsx, .xls" required>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import Data</button>
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
            document.getElementById('form-import').addEventListener('submit', function(event) {
                event.preventDefault();

                const fileInput = document.getElementById('file_excel');
                const allowedExtensions = /(\.xlsx|\.xls)$/i;

                if (!fileInput.value) {
                    Notiflix.Notify.failure('Silakan pilih file untuk di-import.', { timeout: 3000 });
                    return;
                }

                if (!allowedExtensions.exec(fileInput.value)) {
                    Notiflix.Notify.failure('Format file tidak valid. Harus .xlsx atau .xls.', { timeout: 3000 });
                    return;
                }

                const formData = new FormData(event.target);
                const url = event.target.action;

                fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Notiflix.Notify.success(data.message, { timeout: 3000 });
                        location.reload();
                    } else {
                        Notiflix.Notify.failure(data.message, { timeout: 3000 });
                    }
                })
                .catch(error => {
                    Notiflix.Notify.failure('Terjadi kesalahan saat meng-import data.', { timeout: 3000 });
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                const deleteButtons = document.querySelectorAll('.delete-button');
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const barangId = button.getAttribute('data-barang-id');

                        Notiflix.Confirm.show('Konfirmasi', 'Apakah Anda yakin ingin menghapus data ini?', 'Ya', 'Batal',
                            function() {
                                fetch(`/barang-masuk/delete/${barangId}`, {
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
