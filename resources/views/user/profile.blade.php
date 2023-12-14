<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
<!-- MDB -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

<style>
    input[readonly] {
        background-color: #c4c4c4;
        /* color: #fff; */
        border-radius: 10px;
    }

    .img-wrap {
        position: relative;
        display: inline-block;
        font-size: 0;
    }

    .img-wrap .close {
        position: absolute;
        top: 2px;
        right: 2px;
        z-index: 100;
        background-color: #f85555;
        padding: 10px 8px 8px;
        color: #000;
        font-weight: bold;
        cursor: pointer;
        opacity: .2;
        text-align: center;
        font-size: 22px;
        line-height: 10px;
        border-radius: 50%;
    }

    .img-wrap:hover .close {
        opacity: 1;
        transition: ease-in 1s;
        transform: translate(9px);
    }
</style>

<body>
    <section class="" style="background-color: #3f3f3f;">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <a href="/" class="btn btn-primary mb-3 align-items-center">Kembali ke Dashboard</a>
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4" data-aos="fade-up">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item active fs-1 fw-semibold mx-auto" aria-current="page">Profile</li>

                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4" data-aos="zoom-in-right">
                        <form action="/profile/{{ Auth::user()->id }}/profile-picture" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body text-center">
                                @if (Auth::user()->profile_pic == null)
                                <div class="img-wrap">
                                    <span class="close">
                                        <a href="/Readteracy/account/{{ Auth::user()->id }}/delete/profile-picture">
                                            <i class="bi bi-trash2"
                                                style="font-size: 1.5rem; color: rgb(255, 255, 255);">
                                            </i>
                                        </a>
                                    </span>
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->username) }}&background=random&color=28a745"
                                        alt="avatar" class="rounded-circle img-fluid" style="width: 150px;"
                                        id="image_preview">
                                </div>
                                @else
                                <div class="img-wrap">
                                    <span class="close">
                                        <a href="/Readteracy/account/{{ Auth::user()->id }}/delete/profile-picture">
                                            <i class="bi bi-trash3"
                                                style="font-size: 1.5rem; color: rgb(255, 255, 255);"></i>
                                        </a>
                                    </span>
                                    <img src="/assets/images/profile/{{ Auth::user()->profile_pic }}" alt="avatar"
                                        class="rounded-circle" width="200" height="200" id="image_preview">
                                </div>
                                @endif
                                <div class="col mt-3">
                                    <label for="profile_pic" class="btn btn-dark"><i class="fa-solid fa-upload"></i>
                                        Pilih gambar</label>
                                    <input type="file" name="profile_pic" class="form-control" id="profile_pic"
                                        style="display: none;">
                                    <button class="btn btn-primary mt-3" name="updatePic">Ubah Gambar</button>
                                    <hr>
                                </div>
                                <h5 class="my-3">{{ Auth::user()->username }}</h5>

                                <div class="d-flex justify-content-center gap-1">
                                    <p class="text-muted">
                                        @if (Auth::user()->is_admin === 0)
                                    <p class="text-muted mb-4">Member</p>
                                    @else
                                    <p class="text-muted mb-4">Admin</p>
                                    @endif
                                    </p>
                                    <span class="fw-semibold" style="color: #711DB0">{{ Auth::user()->gender }}</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8" data-aos="zoom-in-left">
                    <div class="card mb-4">
                        <form action="/profile/update" method="post">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Name</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-control" id="nameInput" type="text"
                                            value="{{ Auth::user()->username }}" name="username" readonly>
                                    </div>
                                    <div class="col offset-sm-3">
                                        <a class="btn btn-dark rounded-4" id="nameButton"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Email</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-control" id="emailInput" type="text"
                                            value="{{ Auth::user()->email }}" readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Mobile</p>
                                    </div>
                                    <div class="col-sm-4">
                                        @if (Auth::user()->no_hp === null)
                                        <input class="form-control" id="no_hpInput" type="text"
                                            placeholder="No hp tidak tercantum" name="no_hp" inputmode="numeric"
                                            readonly>
                                        @else
                                        <input class="form-control" id="no_hpInput" type="text"
                                            value="{{ Auth::user()->no_hp }}" name="no_hp" inputmode="numeric" readonly>
                                        @endif
                                    </div>
                                    <div class="col offset-sm-3">
                                        <a class="btn btn-dark rounded-4" id="no_hpButton"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Address</p>
                                    </div>
                                    <div class="col-sm-4">
                                        @if (Auth::user()->alamat == null)
                                        <input class="form-control" id="alamatInput" type="text"
                                            placeholder="Belum memiliki alamat" name="alamat" readonly>
                                        @else
                                        <input class="form-control" id="alamatInput" type="text"
                                            value="{{ Auth::user()->alamat }}" name="alamat" readonly>
                                        @endif
                                    </div>
                                    <div class="col offset-sm-3">
                                        <a class="btn btn-dark rounded-4" id="alamatButton"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <button type="submit" name="updateProfile" class="btn btn-dark">Update
                                        Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mb-4 mb-md-0" data-aos="zoom-in-left">
                    <div class="card-body w-100">
                        <p class="mb-4"><span class="text-primary font-italic me-1">Mini History</span>of {{
                            Auth::user()->username }}</p>

                        @if ($peminjamanTerbaru->isEmpty())
                        <p>Belum ada barang yang dipinjam.</p>
                        @else
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Piring</th>
                                    <th>Status</th>
                                    <th>Harga</th>
                                    <th>Rent Date</th>
                                    <th>Actual Return Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjamanTerbaru as $peminjaman)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $peminjaman->user->username }}</td>
                                    <td>{{ $peminjaman->piring_catalogue->nama_piring }}</td>
                                    <td>{{ $peminjaman->status }}</td>
                                    <td>{{ $peminjaman->piring_catalogue->harga_sewa }}</td>
                                    <td>{{ $peminjaman->rent_date }}</td>
                                    <td>{{ $peminjaman->actual_return_date ?? 'Belum dikembalikan' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
                {{-- @if ($peminjaman->isEmpty())
                <div class="mb-0">
                    <h6 class="text-danger">Kamu belum meminjam buku apapun nih</h6>
                    <img data-aos="fade-up" data-aos-duration="70000" src="/img/emptyBook.gif" width="60px" height="60"
                        alt="">
                    <img data-aos="fade-up" data-aos-duration="1000000" src="/img/emptyBook.gif" width="130px"
                        height="120" alt="">
                    <img data-aos="fade-up" data-aos-duration="900000" src="/img/emptyBook.gif" width="90px" height="80"
                        alt="">
                </div>
                @else
                @foreach ($peminjaman as $borrow)
                <div class="row mb-2">
                    <p class="mb-1 fw-bold">{{ $borrow->judul }}</p>
                    <div class="col-xl-3">
                        <img src="/img/buku/{{ $borrow->image }}" width="80px" alt="">
                    </div>
                    <div class="col-xl-7">
                        <?php
                                            $sinopsis = $borrow->sinopsis;
                                            if (strlen($sinopsis) > 10) {
                                                $sinopsis = Str::substr($sinopsis, 0, 50) .'...';
                                                echo $sinopsis;
                                            }
                                            ?>
                        --}}
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>



    <script src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="/assets/js/profile.js"></script>
    <script src="/js/aos.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/plugins/ijabocrop/ijaboCropTool.min.js"></script>
    <script>
        AOS.init({
            duration: 800, // values from 0 to 3000, with step 50ms
        });
    </script>

    <script>
        $(document).on('click', '#change_pic_btn', function() {
            $('#profile_pic').click();
        });
    </script>
</body>