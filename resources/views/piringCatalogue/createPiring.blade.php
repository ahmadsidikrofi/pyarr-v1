@extends('layouts.setup')

@section('content')

@include('layouts.sidebar')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                                                <input type="text" class="form-control" name="deskripsi_piring">
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

                                            <div class="mb-3 mt-5">
                                                <label class="mb-3 text-primary">Foto piring</label>
                                                <input type="file" class="form-control" name="image">
                                            </div>

                                            <button class="btn btn-success btn-md my-4" type="submit">Simpan Piring Baru</button>
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
<script>
    $(document).ready(function($) {
        $('.multiple-category').select2();
    });
</script>
{{-- <script>
    jQuery(document).ready(function($) {
        $('.multiple-category').select2();
    });
</script> --}}
@endsection
