@extends('layouts.index')

@section('title_page', 'Tambah Barang Masuk')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Barang Masuk</h1>
                <div class="section-header-breadcrumb">
                    @if (Auth::user()->role == 'Manager')
                        <div class="breadcrumb-item active"><a href="{{ url('/') }}">Dashboard</a></div>
                    @endif
                    <div class="breadcrumb-item"><a href="{{ route('barang-masuk.index') }}">Data Barang Masuk</a></div>
                    <div class="breadcrumb-item">Tambah Barang Masuk</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Tambah Barang Masuk</h2>
                <p class="section-lead">Silakan isi formulir barang masuk di bawah ini.</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Form Tambah Barang Masuk</h4>
                            </div>
                            <form method="POST" action="{{ route('barang-masuk.store') }}" id="barangMasukForm">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="kode_barang" class="form-label">Kode Barang</label>
                                                <input class="form-control @error('kode_barang') is-invalid @enderror" name="kode_barang" value="{{ old('kode_barang') }}" id="kode_barang" type="text" placeholder="Kode Barang" required />
                                                @error('kode_barang')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="quantity" class="form-label">Jumlah</label>
                                                <input class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" id="quantity" type="number" placeholder="Jumlah Barang" required />
                                                @error('quantity')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="origin" class="form-label">Asal Barang</label>
                                                <input class="form-control @error('origin') is-invalid @enderror" name="origin" value="{{ old('origin') }}" id="origin" type="text" placeholder="Asal Barang" required />
                                                @error('origin')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                                                <input class="form-control @error('tanggal_masuk') is-invalid @enderror" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" id="tanggal_masuk" type="date" required />
                                                @error('tanggal_masuk')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-left">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                    <a href="{{ route('barang-masuk.index') }}" class="btn btn-danger">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', async function (event) {
                    event.preventDefault();
                    const formData = new FormData(form);
                    const url = form.getAttribute('action');
                    const method = form.getAttribute('method');
                    try {
                        const response = await fetch(url, {
                            method: method,
                            body: formData
                        });
                        const responseData = await response.json();
                        if (!response.ok) {
                            console.error('Error response:', responseData);
                            Notiflix.Notify.failure('Error: ' + (responseData.message || 'Terjadi kesalahan'), {
                                timeout: 3000
                            });
                        } else {
                            console.log('Success response:', responseData); 
                            Notiflix.Notify.success(responseData.message, {
                                timeout: 3000
                            });
                            location.href = '{{ route('barang-masuk.index') }}';
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        Notiflix.Notify.failure('Terjadi kesalahan dalam mengirim data.', {
                            timeout: 3000
                        });
                    }
                });
            });
        });
    </script>
    @endpush
@endsection
