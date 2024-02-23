@extends('layouts.setup')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
		@if (Auth::user()->is_admin === 1)
		@include('dashboardAdmin')
		@endif
		<div class="container-fluid">
			<form action="/" role="search" class="mb-5">
				<div class="d-flex gap-2 align-items-center justify-content-center">
					<input type="search" name="search" placeholder="Cari piring disini..." class="form-control w-50">
					<button class="btn btn-success" value="{{ request('search') }}">Cari</button>
				</div>
			</form>
			<div class="row">
				@foreach ($allPiring as $piring)
				<div class="col-sm-6 col-xl-3">
					<div class="card overflow-hidden rounded-2">
						<div class="position-relative">
                            <p class="text-dark p-1 px-3 m-2 text-white bg-primary rounded-3 fw-bold" style="position: absolute; ">
                                {{ implode('-', $piring->categories->pluck('jenis_bahan')->toArray()) }}
                            </p>
                            <div >
                                @if (Auth::user()->is_admin === 1)
                                <a href="/edit-piring/{{ $piring->slug }}" ><img src="../assets/images/{{ $piring->image }}"
                                    class="card-img-top rounded-3" alt="..."></a>
                                    <a href="/delete-piring/{{ $piring->slug }}"
                                        class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i
                                            class="ti ti-trash fs-4"></i>
                                    </a>
                                @else
                                <a href="/detail-piring/{{ $piring->slug }}"><img
                                        src="../assets/images/{{ $piring->image }}" class="card-img-top rounded-3"
                                        alt="..."></a>
                                @endif
                            </div>

						</div>
						<div class="card-body pt-3 p-4">
							<h6 class="fw-semibold fs-4">
								@if (Auth::user()->is_admin === 1)
								<a href="/edit-piring/{{ $piring->slug }}">{{ $piring->nama_piring }}</a>
								@elseif (Auth::user()->is_admin === 0)
								<a href="/detail-piring/{{ $piring->slug }}">{{ $piring->nama_piring }}</a>
								@endif
							</h6>
							<div class="d-flex align-items-center justify-content-between">
								<h6 class="fw-semibold fs-4 mb-0">
									<span class="ms-2 fw-normal text-muted fs-3">
										{!! Str::length($piring->deskripsi_piring) > 50 ?
                                            Str::substr($piring->deskripsi_piring, 0, 100) . "..." :
                                            $piring->deskripsi_piring
                                        !!}
									</span>
								</h6>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if (Session::has('berhasilLogin'))
        toastr.success("Selamat Datang Di BNSP Mahasiswa📖")
    @endif
</script>
<script>
    @if (Session::has('tambahPiring'))
        toastr.success("Piring berhasil ditambahkan 🍽️🍽️")
    @endif
</script>
<script>
    @if (Session::has('editPiring'))
        toastr.success("Piring berhasil diubah 🍽️🍽️")
    @endif
</script>
<script>
    @if (Session::has('hapusPiring'))
        toastr.warning("Piring berhasil dihapus 🍽️🍽️")
    @endif
</script>
@endsection
