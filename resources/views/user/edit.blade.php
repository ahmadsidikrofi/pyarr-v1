@extends('layouts.setup')

@section('content')

@include('layouts.sidebar')

<div class="body-wrapper">
    @include('layouts.header')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title fw-semibold mb-4">Update User</h5>
                    <a class="btn btn-info" href="{{ route('admin.listuser') }}">Kembali</a>
                </div>
                <form action="{{ route('user.update', $user->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username"
                            value="{{ $user->username }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" value="{{ $user->alamat }}">
                    </div>

                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor HP</label>
                        <input type="text" class="form-control" name="no_hp" id="no_hp" value="{{ $user->no_hp }}">
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" name="gender" id="gender">
                            <option value="Pria" {{ $user->gender == 'Pria' ? 'selected' : '' }}>Pria</option>
                            <option value="Wanita" {{ $user->gender == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="is_admin" class="form-label">Role</label>
                        <select class="form-select" name="is_admin" id="is_admin">
                            <option value="0" {{ !$user->is_admin ? 'selected' : '' }}>Cutomer</option>
                            <option value="1" {{ $user->is_admin ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
