@extends('layouts.setup')

@section('content')

@include('layouts.sidebar')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
                                        <form action="/tambah-piring/store" method="post">
                                            @csrf
                                            <p class="mb-3 fw-bold text-dark fs-5">Buat Piring Baru</p>
                                            <input type="text" class="form-control" name="nama_piring">
                                            <input type="text" class="form-control" name="deskripsi_piring">
                                            <select class="js-example-basic-multiple" name="states[]" multiple="multiple">
                                                <option value="AL">Alabama</option>
                                                <option value="WY">Wyoming</option>
                                              </select>
                                            <input type="text" class="form-control" name="harga_sewa">
                                            <input type="text" class="form-control" name="image">
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
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
@endsection
