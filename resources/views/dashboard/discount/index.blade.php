@extends('dashboard.master.main')
@section('title', 'Data Discount')
@section('content')
<section class="section">
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-content p-2">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('create-discount') }}" class="btn btn-primary m-2">Tambah</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Creator</th>
                                    <th>Nama</th>
                                    <th>Code</th>
                                    <th>Diskon</th>
                                    <th>Limit</th>
                                    <th>Kadaluarsa</th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($discounts as $discount)
                                <tr>
                                    <td>{{ $discount->user->name }}</td>
                                    <td class="text-bold-500">{{ $discount->name }}</td>
                                    <td>{{ $discount->code }}</td>
                                    <td>{{ $discount->discount }}</td>
                                    <td>{{ $discount->limit }}</td>
                                    <td>{{ \Carbon\Carbon::parse($discount->expired)->diffForHumans() }}</td>
                                    <td><a href="{{ route('edit-discount', $discount->id) }}"
                                           class="btn btn-warning">Edit</a></td>
                                    <td>
                                        <form action="{{ route('destroy-discount', $discount->id) }}" method="POST">
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
