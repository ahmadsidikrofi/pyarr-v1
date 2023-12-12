@extends('layouts.setup')

@section('content')

@include('layouts.sidebar')
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
@endsection
