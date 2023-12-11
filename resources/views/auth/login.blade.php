@extends('layouts.setup')
@section('content')
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xl-5 ">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-center my-4 gap-1 align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" class="bi bi-stack" viewBox="0 0 16 16">
                                        <path
                                            d="m14.12 10.163 1.715.858c.22.11.22.424 0 .534L8.267 15.34a.598.598 0 0 1-.534 0L.165 11.555a.299.299 0 0 1 0-.534l1.716-.858 5.317 2.659c.505.252 1.1.252 1.604 0l5.317-2.66zM7.733.063a.598.598 0 0 1 .534 0l7.568 3.784a.3.3 0 0 1 0 .535L8.267 8.165a.598.598 0 0 1-.534 0L.165 4.382a.299.299 0 0 1 0-.535L7.733.063z" />
                                        <path
                                            d="m14.12 6.576 1.715.858c.22.11.22.424 0 .534l-7.568 3.784a.598.598 0 0 1-.534 0L.165 7.968a.299.299 0 0 1 0-.534l1.716-.858 5.317 2.659c.505.252 1.1.252 1.604 0l5.317-2.659z" />
                                    </svg>
                                    <span class="fw-bold fs-4">Pyarr</span>
                                </div>
                                <p class="text-center">Sewa piring dan gelas sesuai kebutuhan</p>
                                <form action="/login/store" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            aria-describedby="emailHelp">

                                        @if (session('wrongAuth'))
                                            <small>
                                                <strong class="text-danger mb-5">{{ session('wrongAuth') }}</strong>
                                                <br><br>
                                            </small>
                                        @endif
                                    </div>

                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input name="password" type="password" class="form-control" id="password">
                                        <i class="@error('password') is-invalid @enderror"></i>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                                </form>
                                <div class="d-flex align-items-center justify-content-center">
                                    <p class="fs-4 mb-0 fw-bold">Belum punya akun?</p>
                                    <a class="text-primary fw-bold ms-2" href="/register">Sign Up</a>
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <p class="fs-4 mb-0 fw-bold">Kamu lupa password?</p>
                                    <a class="text-primary fw-bold ms-2" href="/lupa-password">Ubah password</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
@endsection
