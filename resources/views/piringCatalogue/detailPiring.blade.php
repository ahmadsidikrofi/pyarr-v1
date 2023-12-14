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
                                <h5 class="card-title fw-semibold mb-4">Edit Piring</h5>
                                <a class="btn btn-info" href="/">Kembali</a>
                            </div>
                            <div class="card">
                                <div class="card-header col-sm-3">
                                    <img src="/assets/images/{{ $detailPiring->image }}" width="200" height="200" class="rounded-5" alt="">
                                </div>
                                <div class="card-body col-sm-7">
                                    <div class="mb-3">
                                        <form action="/pinjam-piring/{{ $detailPiring->slug }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="piring_catalogue_id"
                                                value="{{ $detailPiring->piring_catalogue_id }}">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <div class="mb-3">
                                                <label class="mb-3 text-primary">Ubah nama piring</label>
                                                <input type="text" class="form-control" name="nama_piring" readonly
                                                    value="{{ $detailPiring->nama_piring }}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="mb-3 text-primary">Deskripsi piring</label>
                                                <input type="text" class="form-control" name="deskripsi_piring" readonly
                                                    value="{{ $detailPiring->deskripsi_piring }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="mb-3 text-primary">Kategori bahan</label>
                                                <h3 class="text-dark fs-4">
                                                    @foreach ( $detailPiring->categories as $currentCategory)
                                                    {{ $currentCategory->jenis_bahan }}
                                                    @endforeach
                                                </h3>
                                            </div>
                                            <div class="mb-4">
                                                <label class="mb-3 text-primary">Harga sewa</label>
                                                <input type="text" class="form-control" name="harga_sewa" readonly
                                                    value="{{ $detailPiring->harga_sewa }}">
                                            </div>

                                            @if ($totalPinjam >= 2)
                                                <button class="btn btn-success btn-md mb-3 rounded-3" disabled type="submit">Pinjam sekarang</button>
                                                <p class="p-2 bg-primary text-white fw-bold rounded-3 w-50">Peminjaman telah mencapai batas
                                                    Total peminjaman => {{ $totalPinjam }}
                                                </p>
                                            @else
                                                <p class="p-2 bg-primary text-white fw-bold rounded-3">Piring terpinjam : {{ $totalPinjam }}</p>
                                                <button class="btn btn-success btn-md" type="submit">Pinjam sekarang</button>
                                            @endif
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
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function($) {
        $('.multiple-category').select2();
    });
</script>
@endsection
