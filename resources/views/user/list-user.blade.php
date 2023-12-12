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
            /* Atur margin bottom untuk elemen pencarian label */
        }
    </style>
</head>

<body>
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
                <div class="card shadow mb-4">
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table table-bordered border-primary" id="myTable" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
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
                                            User
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/edit-user/{{ $datauser->id }}"
                                                class="text-decoration-none">Edit</a>
                                            <a href="/delete-user/{{ $datauser->id }}"
                                                class="text-decoration-none">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="py-6 px-6 text-center">
                                <p class="mb-0 fs-4">Design and Developed by Readteracy</p>
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

    <!-- Include Bootstrap JavaScript -->


    <script>
        $(document).ready( function () {
        $('#myTable').DataTable({
            responsive: true, // Aktifkan responsif
            lengthMenu: [10, 25, 50, 100], // Opsi tampilan entri
            searching: true // Aktifkan atau nonaktifkan pencarian
            // Tambahan konfigurasi lainnya
        });
    });
    </script>

    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>