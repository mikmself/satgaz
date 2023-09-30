@extends('dashboard.master.main')
@section('title','Data User')
@section('content')
<section class="section">
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-content p-2">
                    <div class="d-flex justify-content-end">
                        <a href="{{route('create-user')}}" class="btn btn-primary m-2">Tambah</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>NAMA</th>
                                    <th>EMAIL</th>
                                    <th>TELEPHONE</th>
                                    <th>LEVEL</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td class="text-bold-500">{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td class="text-bold-500">{{$user->telephone}}</td>
                                    <td>{{$user->level}}</td>
                                    <td class="d-flex justify-content-between">
                                        <form action="{{route('edit-user',$user->id)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-warning">Edit</button>
                                        </form>
                                        <form action="{{route('delete-user',$user->id)}}" method="POST">
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
