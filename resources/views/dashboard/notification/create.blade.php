@extends('dashboard.master.main')
@section('title', 'Tambah Data Notification')
@section('content')
<section id="basic-vertical-layouts">
    <div class="row match-height">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('index-notification') }}" class="btn btn-fark m-2">Kembali</a>
                    </div>
                    <div class="card-body">
                        <form class="form form-vertical" method="POST" action="{{ route('store-notification') }}">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="title">Judul</label>
                                            <input type="text" id="title" class="form-control" name="title"
                                                placeholder="Masukkan Judul">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="content">Konten</label>
                                            <textarea id="content" class="form-control" name="content"
                                                placeholder="Masukkan Konten"></textarea>
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
@endsection
