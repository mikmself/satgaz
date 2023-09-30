@extends('dashboard.master.main')
@section('title', 'Data Notifications')
@section('content')
<section class="section">
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-content p-2">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('create-notification') }}" class="btn btn-primary m-2">Tambah</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Konten</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notifications as $notification)
                                <tr>
                                    <td class="text-bold-500">{{ $notification->title }}</td>
                                    <td>{{ $notification->content }}</td>
                                    <td class="d-flex justify-content-between">
                                        <a href="{{ route('edit-notification', $notification->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form action="{{ route('destroy-notification', $notification->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
