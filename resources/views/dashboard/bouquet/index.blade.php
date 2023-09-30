@extends('dashboard.master.main')
@section('title', 'Data Bouquet')
@section('content')
<section class="section">
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-content p-2">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('create-bouquet') }}" class="btn btn-primary m-2">Tambah</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bouquets as $bouquet)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $bouquet->image) }}" alt="{{ $bouquet->name }}"
                                             width="200">
                                    </td><td class="text-bold-500">{{ $bouquet->name }}</td>
                                    <td>{{ $bouquet->description }}</td>
                                    <td class="text-bold-500">{{ $bouquet->price }}</td>
                                    <td><a href="{{ route('edit-bouquet', $bouquet->id) }}"
                                           class="btn btn-warning">Edit</a></td>
                                    <td>
                                        <form action="{{ route('destroy-bouquet', $bouquet->id) }}" method="POST">
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
