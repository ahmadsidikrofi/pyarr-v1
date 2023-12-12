@extends('layouts.setup')

@section('content')
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('layouts.sidebar')
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('layouts.header')
            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->
                @if (Auth::user()->is_admin === 1)
                    @include('dashboardAdmin')
                @endif
                    <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-semibold mb-4">All Users</h5>
                                <div class="table-responsive">
                                    <table class="table text-nowrap mb-0 align-middle">
                                        <thead class="text-dark fs-4">
                                            <tr>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Username</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Email</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Is Admin</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Picture</h6>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $allUsers as $user )
                                                <tr>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">{{ $user->username }}</h6>
                                                        <span class="fw-normal">Web Designer</span>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-1">{{ $user->email }}</h6>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        @if ($user->is_admin === 0 )
                                                            <p class="mb-0 fw-normal">Member</p>
                                                        @elseif ($user->is_admin === 1)
                                                            <p class="mb-0 fw-normal">Admin</p>
                                                        @endif
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <img src="/assets/images/profile/{{ $user->profile_pic }}" alt="" width="35" height="35"
                                                            class="rounded-circle">
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-xl-3">
                            <div class="card overflow-hidden rounded-2">
                                <div class="position-relative">
                                    <a href="/edit-material/"><img
                                            src="../assets/images/"
                                            class="card-img-top rounded-3" alt="..."></a>
                                    <a href="/delete-material/"
                                        class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-trash fs-4"></i>
                                    </a>
                                </div>
                                <div class="card-body pt-3 p-4">
                                    <h6 class="fw-semibold fs-4">
                                        <a href="/edit-material/">asdasd</a>
                                    </h6>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="fw-semibold fs-4 mb-0">
                                            <span
                                                class="ms-2 fw-normal text-muted fs-3">
                                            </span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-6 px-6 text-center">
                    <p class="mb-0 fs-4">Design and Developed by Readteracy</p>
                </div>
            </div>
        </div>
    </div>
@endsection
