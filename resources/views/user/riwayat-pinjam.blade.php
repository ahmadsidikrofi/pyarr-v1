@extends('layouts.setup')

@section('content')

@include('layouts.sidebar')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<div class="body-wrapper">
    @include('layouts.header')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title fw-semibold mb-4">Daftar Riwayat Peminjaman</h5>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <table id="myTable" class="display">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>User</th>
                                            <th>Piring</th>
                                            <th>Status</th>
                                            <th>Harga</th>
                                            <th>Rent Date</th>
                                            <th>Return Date</th>
                                            <th>Actual Return Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($peminjamanPirings as $peminjaman)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            @if ($peminjaman->user)
                                                <td>{{ $peminjaman->user->username }}</td>
                                            @else
                                                <td>User tidak ditemukan</td>
                                            @endif
                                            <td>{{ $peminjaman->piring_catalogue->nama_piring }}</td>
                                            <td>
                                                {{ $peminjaman->status }}
                                            </td>
                                            <td>{{ $peminjaman->piring_catalogue->harga_sewa }}</td>
                                            <td>{{ $peminjaman->rent_date }}</td>
                                            <td>{{ $peminjaman->return_date }}</td>
                                            <td>{{ $peminjaman->actual_return_date ?? 'N/A' }}</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="card-footer">
                                    <h5>Total Harga Sewa: Rp. {{ number_format($totalHarga, 0, ',', '.') }}</h5>
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
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>






<script>
    let table = new DataTable('#myTable', {
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'pdf', 'print'
        ]
    });
</script>
@endsection
