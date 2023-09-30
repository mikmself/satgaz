@extends('pages.master.main')
@section('title','Bayar DP')
@section('content')
    <form method="POST" action="{{route('store-dp')}}" enctype="multipart/form-data">
    @csrf
    @method('POST')
        <input type="hidden" name="id" value="{{$id}}">
        <div class="container mt-5 bg-white p-5">
            <h2>Upload Bukti Pembayaran  DP</h2>
            <div class="mb-3">
                <img src="#" id="image-preview" class="img-fluid" alt="Preview Image" style="display: none" width="200">
            </div>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="dp" class="form-label">Choose an Image</label>
                    <input type="file" class="form-control" id="dp" name="dp" accept="image/*" onchange="previewImage()">
                </div>
                <button type="submit" class="btn btn-primary">Upload Image</button>
            </form>
        </div>
    </form>
    <script>
        function previewImage() {
            var dpInput = document.getElementById('dp');
            var imagePreview = document.getElementById('image-preview');

            if (dpInput.files && dpInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(dpInput.files[0]);
            }
        }
    </script>
@endsection
