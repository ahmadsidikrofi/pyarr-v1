@extends('layouts.setup')

@section('content')

@include('layouts.sidebar')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<div class="body-wrapper">
    @include('layouts.header')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title fw-semibold mb-4">Semua piring {{ Auth::user()->username }}</h5>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($piringUser as $piring)
                                    <div class="col-sm-8 col-xl-3">
                                        <div class="card shadow-lg overflow-hidden rounded-2">
                                            <div class="position-relative">
                                                <p class="text-dark p-1 px-3 m-2 text-white bg-primary rounded-3 fw-bold" style="position: absolute; ">
                                                    {{ implode('-', $piring->piring_catalogue->categories->pluck('jenis_bahan')->toArray()) }}
                                                </p>
                                                <div >
                                                    <a href="/detail-piring/{{ $piring->piring_catalogue->slug }}"><img
                                                            src="../assets/images/{{ $piring->piring_catalogue->image }}" class="card-img-top rounded-3"
                                                            alt="..."></a>
                                                </div>
                                                <form action="/kembalikan-piring/{{ $piring->id }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="status" value="{{ $piring->status }}">
                                                    <button type="submit" class="btn btn-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i
                                                            class="ti ti-reload fs-4"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="card-body pt-3 p-3">
                                                <h6 class="fw-semibold fs-4">
                                                    <a href="/detail-piring/{{ $piring->piring_catalogue->slug }}">{{ $piring->piring_catalogue->nama_piring }}</a>
                                                </h6>
                                                @if ($piring->status === "Tersedia")
                                                    <p class="text-danger">Menunggu persetujuan admin</p>
                                                @elseif ($piring->status === "Siap Dikembalikan")
                                                    <p class="text-danger">Pengembalian akan diproses oleh admin</p>
                                                @elseif ($piring->status === "Sedang Dipinjam")
                                                    <p class="text-warning ">Sisa waktu peminjaman: <br>
                                                        <span class="fw-bold">{{ $sisaHari }} hari dan {{ $sisaJam }} jam</span>
                                                    </p>
                                                @endif
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h6 class="fw-semibold fs-4 mb-0">
                                                        <span class="fw-normal text-muted fs-3">
                                                            {!! Str::length($piring->piring_catalogue->deskripsi_piring) > 50 ?
                                                                Str::substr($piring->piring_catalogue->deskripsi_piring, 0, 100) . "..." :
                                                                $piring->piring_catalogue->deskripsi_piring
                                                            !!}
                                                        </span>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
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
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
    crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
    let table = new DataTable('#myTable', {
        responsive: true
    });
</script>
@endsection
