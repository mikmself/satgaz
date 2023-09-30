@extends('pages.master.main')
@section('title','Bayar Pelunasan')
@section('content')
    <form method="POST" action="{{route('store-repayment')}}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <input type="hidden" name="id" value="{{$id}}">
        <div class="container mt-5 bg-white p-5">
            <h2>Upload Bukti Pembayaran  Pelunasan</h2>
            <div class="mb-3">
                <img src="#" id="image-preview" class="img-fluid" alt="Preview Image" style="display: none" width="200">
            </div>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="repayment" class="form-label">Choose an Image</label>
                    <input type="file" class="form-control" id="repayment" name="repayment" accept="image/*" onchange="previewImage()">
                </div>
                <button type="submit" class="btn btn-primary">Upload Image</button>
            </form>
        </div>
    </form>
    <script>
        function previewImage() {
            var repaymentInput = document.getElementById('repayment');
            var imagePreview = document.getElementById('image-preview');

            if (repaymentInput.files && repaymentInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(repaymentInput.files[0]);
            }
        }
    </script>
@endsection
