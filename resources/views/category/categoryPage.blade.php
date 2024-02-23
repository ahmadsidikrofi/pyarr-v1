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
                                <h5 class="card-title fw-semibold mb-4">Daftar Kategori Piring</h5>
                                <a class="btn btn-info" href="/tambah-kategori">Tambah Kategori</a>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <table id="myTable" class="display">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori Piring</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $x = 1 ?>
                                            @foreach ($kategoris as $kategori)
                                                <tr>
                                                    <td>{{ $x++ }}</td>
                                                    <td>{{ $kategori->jenis_bahan }}</td>
                                                    <td>
                                                        <a href="/edit-kategori/{{ $kategori->slug }}" class="btn btn-success btn-sm">Edit Kategori</a>
                                                        <a href="/delete/kategori/{{ $kategori->slug }}" class="btn btn-danger btn-sm">Hapus Kategori</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script> --}}
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    let table = new DataTable('#myTable', {
        responsive: true
    });
</script>

<script>
    @if (Session::has('updateKategori'))
        toastr.success("Kategori berhasil diubah📖")
    @endif
</script>
<script>
    @if (Session::has('hapusKategori'))
        toastr.error("Kategori Terhapus 🗑️")
    @endif
</script>
@endsection
