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
                            <h5 class="card-title fw-semibold mb-4">Update Peminjaman</h5>
                            @if ($countStatusTersedia !== 0)
                            <p class="card-title fw-light mb-4 p-2 bg-danger rounded-3 text-white">Ada <strong class="fw-bold">{{ $countStatusTersedia }} piring</strong> yang menunggu persetujuanmu</p>
                            @endif
                        </div>
                        @if ($countSiapDikembalikan !== 0)
                        <p class="fs-4 text-center mb-4 p-2 bg-success rounded-3 text-white"><strong class="fw-bold">{{ $countSiapDikembalikan }} piring</strong> Sudah siap Dikembalikan</p>
                        @endif
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($peminjamanPirings as $peminjaman)
                                        <tr class="{{ $peminjaman->actual_return_date === NULL ? '' :
                                            ($peminjaman->return_date < $peminjaman->actual_return_date ? 'bg-danger text-light' : 'bg-success text-light') }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $peminjaman->user->username }}</td>
                                            <td>{{ $peminjaman->piring_catalogue->nama_piring }}</td>
                                            <td>
                                                <form action="/update-status-peminjaman/{{ $peminjaman->id }}"
                                                    method="post">
                                                    @csrf
                                                    @method('POST')

                                                    <div class="input-group">
                                                        <select class="form-control" name="status">
                                                            <option value="Tersedia" {{ $peminjaman->status ==
                                                                'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                                            <option value="Sedang Dipinjam" {{ $peminjaman->status ==
                                                                'Sedang Dipinjam' ? 'selected' : '' }}>Sedang
                                                                Dipinjam</option>
                                                            <option value="Siap Dikembalikan" {{ $peminjaman->status ==
                                                                'Siap Dikembalikan' ? 'selected' : ''
                                                                }}>Siap Dikembalikan</option>
                                                            <option value="Sudah Dikembalikan" {{ $peminjaman->status ==
                                                                'Sudah Dikembalikan' ? 'selected' : ''
                                                                }}>Sudah Dikembalikan</option>
                                                        </select>
                                                    </div>
                                            </td>
                                            <td>{{ $peminjaman->piring_catalogue->harga_sewa }}</td>
                                            <td>{{ $peminjaman->rent_date }}</td>
                                            <td>{{ $peminjaman->return_date }}</td>
                                            <td>{{ $peminjaman->actual_return_date ?? 'N/A' }}</td>
                                            <td>
                                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                                </form>
                                            </td>
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
<script>
    let table = new DataTable('#myTable', {
        responsive: true
    });
</script>
@endsection
