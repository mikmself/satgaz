@extends('dashboard.master.main')
@section('title', 'Data Topping')
@section('content')
<section class="section">
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-content p-2">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('create-topping') }}" class="btn btn-primary m-2">Tambah</a>
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
                                @foreach ($toppings as $topping)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $topping->image) }}" alt="{{ $topping->name }}"
                                             width="200">
                                    </td><td class="text-bold-500">{{ $topping->name }}</td>
                                    <td>{{ $topping->description }}</td>
                                    <td class="text-bold-500">{{ $topping->price }}</td>
                                    <td><a href="{{ route('edit-topping', $topping->id) }}"
                                           class="btn btn-warning">Edit</a></td>
                                    <td>
                                        <form action="{{ route('destroy-topping', $topping->id) }}" method="POST">
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
