@extends('layouts.setup')

@section('content')

@include('layouts.sidebar')

<div class="body-wrapper">
    @include('layouts.header')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title fw-semibold mb-4">Tambah User</h5>
                    <a class="btn btn-info" href="{{ route('admin.listuser') }}">Kembali</a>
                </div>
                <form action="{{ route('dashboard.admin.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat">
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor HP</label>
                        <input type="text" class="form-control" name="no_hp" id="no_hp">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" name="gender" id="gender">
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="profile_pic" class="form-label">Foto Profil</label>
                        <input type="file" class="form-control" name="profile_pic" id="profile_pic" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="is_admin" class="form-label">Role</label>
                        <select class="form-select" name="is_admin" id="is_admin">
                            <option value="0">Customer</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <button class="btn btn-success btn-md" type="submit">Tambah User</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection