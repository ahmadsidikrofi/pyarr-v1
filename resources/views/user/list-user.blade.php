<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <!-- Bootstrap CSS -->


    <!-- DataTables CSS with Bootstrap integration -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <style>
        /* Contoh CSS kustom untuk DataTables */
        #myTable_wrapper {
            padding: 20px;
            /* Atur padding wrapper */
        }

        #myTable_filter label {
            margin-bottom: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 25px;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('layouts.sidebar')
        <!-- Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('layouts.header')
            <!--  Header End -->

            <div class="container-fluid">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card shadow mb-4">
                    <div class="card-body ">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title fw-semibold mb-4">Daftar List User</h5>
                            <a class="btn btn-info" href="/tambah-user">Tambah User</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="myTable" width="100%">
                                <thead>
                                    <tr class="bg-info-subtle text-dark-light">
                                        <th scope="col">No</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allUsers as $datauser)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $datauser->username }}</td>
                                        <td>{{ $datauser->email }}</td>
                                        <td>
                                            @if ($datauser->is_admin)
                                            Admin
                                            @else
                                            Customer
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/edit-user/{{ $datauser->id }}"
                                                class="btn btn-primary text-white text-decoration-none">Edit</a>
                                            <button class="btn btn-danger" onclick="confirmDelete({{ $datauser->id }})">
                                                <i class="fas fa-trash-alt"></i>Delete
                                            </button>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="py-6 px-6 text-center">
                                <p class="mb-0 fs-4">Design and Developed by Pyarr</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Include jQuery and DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                responsive: true,
                lengthMenu: [10, 25, 50, 100],
                searching: true
            });
        });
    
        function confirmDelete(datauserId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You will not be able to recover this user!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteMyletter(datauserId);
                } else {
                    Swal.fire("Cancelled", "User is safe :)", "info");
                }
            });
        }
    
        function deleteMyletter(datauserId) {
            $.ajax({
                url: '/delete-user/' + datauserId,
                type: 'DELETE',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Adjusted to use a meta tag for CSRF token
                },
                success: function(response) {
                    console.log(response); // Log the response
                    if (response.success) { // Adjusted to check response.success directly
                        Swal.fire("Deleted!", response.message, "success")
                        .then(() => {
                            window.location.reload(); // Reload the page
                        });
                    } else {
                        Swal.fire("Success", response.message, "success");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error response:", xhr.responseText);
                    console.error("Status:", status);
                    console.error("Error:", error);
                    Swal.fire("Error", "Something went wrong. Please try again later.", "error");
                }
            });
        }
    </script>

    <!-- Include Bootstrap JavaScript -->

</body>

</html>