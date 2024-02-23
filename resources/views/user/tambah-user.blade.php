@extends('layouts.setup')

@section('content')

@include('layouts.sidebar')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat">
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor HP</label>
                        <input type="number" class="form-control" name="no_hp" id="no_hp" oninput="validatePhoneNumber(this)">
                        <span id="no_hp_error" class="text-danger"></span>
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
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @error('username')
        toastr.error('Username user wajib diinputkan.👨');
    @enderror
    @error('email')
        toastr.error('Email user wajib diinputkan.👨');
    @enderror
    @error('password')
        toastr.error('Password user wajib diinputkan.👨');
    @enderror
</script>

<script>
    function validatePhoneNumber(input) {
        var phoneNumber = input.value;
        phoneNumber = phoneNumber.replace(/\D/g, '');
        if (/^\d+$/.test(phoneNumber)) {
            document.getElementById('no_hp_error').innerText = '';
        } else {
            document.getElementById('no_hp_error').innerText = 'Isian harus berupa angka';
        }
    }
</script>

@endsection
