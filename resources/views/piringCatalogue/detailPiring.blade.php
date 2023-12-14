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
                                <h5 class="card-title fw-semibold mb-4">Detail dari {{ $detailPiring->nama_piring }}</h5>
                                <a class="btn btn-info" href="/">Kembali</a>
                            </div>
                            <div class="card ">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-5">
                                            <div class="card-header">
                                                <div class="img-wrapper">
                                                    <p class="text-dark p-1 px-3 m-2 text-white bg-primary rounded-3 fw-bold" style="position: absolute; ">
                                                        {{ implode('-', $detailPiring->categories->pluck('jenis_bahan')->toArray()) }}
                                                    </p>
                                                    <img src="/assets/images/{{ $detailPiring->image }}" width="200" height="200" class="rounded-3" alt="">
                                                </div>
                                                <div class="my-4">
                                                    <form action="/pinjam-piring/{{ $detailPiring->slug }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="piring_catalogue_id"
                                                        value="{{ $detailPiring->piring_catalogue_id }}">
                                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                        @if ($totalPinjam >= 2)
                                                            <button class="btn btn-success btn-md mb-3 rounded-3" disabled type="submit">Pinjam sekarang</button>
                                                            <p class="p-2 bg-primary text-white fw-bold rounded-3">Total peminjaman {{ $totalPinjam }}  </p>
                                                            <p class="p-2 bg-danger text-white fw-bold rounded-3">Peminjaman telah mencapai batas. Silahkan kembalikan piring terlebih dahulu untuk menyewa lagi 🙏  </p>
                                                        @else
                                                            <p class="p-2 bg-primary text-white fw-bold rounded-3 w-75 fs-4">Piring terpinjam : {{ $totalPinjam }}</p>
                                                            <button class="btn btn-success btn-md rounded-3" type="submit">Pinjam sekarang</button>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3 ">
                                                <input type="hidden" name="piring_catalogue_id"
                                                    value="{{ $detailPiring->piring_catalogue_id }}">
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <div class="mb-3">
                                                    <label class="mb-3 text-primary">Nama piring</label>
                                                    <input type="text" class="form-control" name="nama_piring" readonly
                                                        value="{{ $detailPiring->nama_piring }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="mb-3 text-primary">Deskripsi piring</label>
                                                    {!! $detailPiring->deskripsi_piring !!}
                                                </div>
                                                <div class="mb-4">
                                                    <label class="mb-3 text-primary">Harga sewa</label>
                                                    <input type="text" class="form-control" name="harga_sewa" readonly
                                                        value="{{ $detailPiring->harga_sewa }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="disqus_thread"></div>
                                    <script>
                                        var disqus_config = function () {
                                        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                                        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                                        };

                                        (function() { // DON'T EDIT BELOW THIS LINE
                                        var d = document, s = d.createElement('script');
                                        s.src = 'https://website-r41nxqdwxx.disqus.com/embed.js';
                                        s.setAttribute('data-timestamp', +new Date());
                                        (d.head || d.body).appendChild(s);
                                        })();
                                    </script>

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
