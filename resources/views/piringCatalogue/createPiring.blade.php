@extends('layouts.setup')

@section('content')

@include('layouts.sidebar')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<div class="body-wrapper">
    @include('layouts.header')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title fw-semibold mb-4">Tambah Piring</h5>
                                <a class="btn btn-info" href="/">Kembali</a>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <form action="/tambah-piring/store" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="mb-3 text-primary">Nama Piring Baru</label>
                                                <input type="text" class="form-control" name="nama_piring">
                                            </div>

                                            <div class="mb-3">
                                                <label class="mb-3 text-primary">Deskripsi piring</label>
                                                <textarea name="deskripsi_piring" id="deskripsi_piring">
                                                </textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="mb-3 text-primary">Kategori bahan</label>
                                                <select class="form-control multiple-category" name="category[]" multiple="multiple">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->jenis_bahan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <label class="mb-3 text-primary">Harga sewa</label>
                                                <input type="text" class="form-control" name="harga_sewa">
                                            </div>
                                            <div class="d-block">
                                                {{-- <img id="image" class="rounded-4" src="/assets/images/{{ $editPiring->image }}" height="200"> --}}
                                                <img id="image" class="rounded-4" src="https://kodfun.github.io/Reels/ImagePreview/choose.png" height="200">
                                            </div>
                                            <input type="file" style="display: none;" id="input" name="image" class="form-control mt-2 bg-success text-white border-0">
                                            <label class="btn btn-dark rounded-3" for="input">Beri / Ubah foto piring</label>

                                            <button class="btn btn-success rounded-3 btn-md my-4 mx-4" type="submit">Simpan Piring Baru</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function($) {
        $('.multiple-category').select2();
    });
</script>
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
</script>
<script>
    let image = document.getElementById("image");
    let input = document.getElementById("input");

    input.onchange = (e) => {
    if (input.files[0]) image.src = URL.createObjectURL(input.files[0]);
    };
</script>

<script>
    @error('nama_piring')
            toastr.error('Nama piring harus terisi.📛');
    @enderror
    @error('deskripsi_piring')
            toastr.error('Deskripsi piring harus terisi.📜📜');
    @enderror
    @error('harga_sewa')
            toastr.error('Harga sewa piring harus terisi.💸');
    @enderror
    @error('image')
            toastr.error('Gambar piring harus diinputkan.🍽️🍽️');
    @enderror
</script>
@endsection
