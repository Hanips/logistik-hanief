@if (Auth::user()->role == 'Manager')
    @extends('layouts.index')

    @section('title_page', 'Notifications')

    @section('content')
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Notifications</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active">Dashboard</div>
                            <div class="breadcrumb-item">Notifications</div>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="activities">
                                    @foreach ($notification_list as $items)
                                        <div class="activity">
                                            <div class="activity-icon bg-primary text-white shadow-primary">
                                                <i class="fas fa-bell"></i>
                                            </div>
                                            <div class="activity-detail">
                                                <div class="mb-2">
                                                    <span class="text-job text-primary">{{ Carbon\Carbon::parse($items->created_at)->diffForHumans() }}</span>
                                                    <span class="bullet"></span>
                                                    @if ($items->notification_status == 0)
                                                        <span class="text-job text-warning">Belum Dilihat</span>
                                                    @elseif($items->notification_status == 1)
                                                        <span class="text-job text-success">Dilihat</span>
                                                    @endif
                                                    <div class="float-right dropdown">
                                                        <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu">
                                                            <div class="dropdown-title">Opsi</div>
                                                            <a data-card-id="{{ $items->id }}" href="#" class="dropdown-item read-notif has-icon"><i class="fas fa-eye"></i> Tandai Telah Dilihat</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p>{{ $items->notification_content }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <script>
            const readNotif = document.querySelectorAll('.read-notif');
            readNotif.forEach(button => {
                button.addEventListener('click', function() {
                    const cardId = button.dataset.cardId;
                    fetch(`/readnotif/${cardId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        Notiflix.Notify.success("Data Berhasil Diperbarui", {
                            timeout: 3000
                        });
                        location.reload();
                    })
                    .catch(error => {
                        Notiflix.Notify.failure('Error:', error);
                    });
                });
            });
        </script>
    @endsection
@else
    @include('layouts.access_denied')
@endif