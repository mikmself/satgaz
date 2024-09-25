@extends('dashboard.master.main')
@section('title', 'Tambah Data Discount')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<section id="basic-vertical-layouts">
    <div class="row match-height">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('index-discount') }}" class="btn btn-fark m-2">Kembali</a>
                    </div>
                    <div class="card-body">
                        <form class="form form-vertical" method="POST" action="{{ route('store-discount') }}">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="selectadmin">Admin</label>
                                            <select class="form-control selectadmin" name="admin_id" id="selectadmin">
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <input type="text" id="name" class="form-control" name="name"
                                                placeholder="Masukkan Nama Diskon">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="code">Kode</label>
                                            <input type="text" id="code" class="form-control" name="code"
                                                   placeholder="Masukkan Kode Diskon">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="discount">Besar</label>
                                            <input type="number" min="1" id="discount" class="form-control" name="discount"
                                                   placeholder="Masukkan Besar Diskon Dalam Persen">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="limit">Limit</label>
                                            <input type="number" min="1" id="limit" class="form-control" name="limit"
                                                   placeholder="Masukkan Limit Diskon">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="expired">Kadaluarsa</label>
                                            <input type="date" min="1" id="expired" class="form-control" name="expired"
                                                   placeholder="Masukkan Kadaluarsa Diskon">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.selectadmin').select2();
    });
</script>
@endsection
