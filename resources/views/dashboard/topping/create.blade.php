@extends('dashboard.master.main')
@section('title', 'Tambah Data Topping')
@section('content')
<section id="basic-vertical-layouts">
    <div class="row match-height">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('index-topping') }}" class="btn btn-fark m-2">Kembali</a>
                    </div>
                    <div class="card-body">
                        <form class="form form-vertical" method="POST" action="{{ route('store-topping') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <input type="text" id="name" class="form-control" name="name"
                                                placeholder="Masukan Nama">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description">Deskripsi</label>
                                            <textarea id="description" class="form-control" name="description"
                                                placeholder="Masukan Deskripsi"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="price">Harga</label>
                                            <input type="text" id="price" class="form-control" name="price"
                                                placeholder="Masukan Harga">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="image">Gambar</label>
                                            <input type="file" id="image" class="form-control" name="image">
                                            <img id="image-preview" src="#"
                                                alt="Preview Gambar" style="max-width: 500px; margin-top: 10px;">
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

<script>
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');

    imageInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endsection
