@extends('layouts.setup')

@section('content')

@include('layouts.sidebar')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
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
                                <h5 class="card-title fw-semibold mb-4">Tambah Kategori Piring</h5>
                                <a class="btn btn-info" href="/show-category">Kembali</a>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <form action="/tambah-kategori/store" method="post">
                                            @csrf
                                            <p class="mb-3 fw-bold text-dark fs-5">Kategori Bahan Baru</p>
                                            <input type="text" class="form-control" name="jenis_bahan">
                                            <button class="btn btn-success btn-md my-4" type="submit">Tambah kategori</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if (Session::has('tambahKategori'))
        toastr.success("Kategori berhasil ditambahkan📖")
    @endif
</script>
@endsection
