<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <title>WEB</title>
</head>

<body>
    <div class="container">
        <!-- Start Navbar -->
        <nav class="navbar navbar-light bg-light">
            <form class="container-fluid justify-content-center">
                <button class="btn btn-outline-success me-2" type="button">
                    Home
                </button>
                <button onClick="location.href='admin.php'" class="btn btn-outline-success me-2" type="button">
                    Admin
                </button>
                <button class="btn btn-outline-success me-2" type="button">
                    Pengadaan
                </button>
                <a class="btn btn-primary" href="">Link</a>
            </form>
        </nav>
        <!-- End Navbar -->

        <br>
        <br>

        <!-- Start Data -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID Buku</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Nama Buku</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <?php
            $koneksi = mysqli_connect("localhost", "root", "", "data");

            // tes koneksi
            if (mysqli_connect_errno()) {
                echo "Koneksi database gagal : " . mysqli_connect_error();
            }

            $ambil = mysqli_query($koneksi, "select * from buku");
            $result = array();
            while ($tampung = mysqli_fetch_array($ambil)) {
                $result[] = $tampung; //result dijadikan array 
            }
            //selanjutnya result array di foreach
            foreach ($result as $hasil) {

                ?>

                <tbody>
                    <tr>
                        <td>
                            <?php echo $hasil['idBuku']; ?>
                        </td>
                        <td>
                            <?php echo $hasil['kategori']; ?>
                        </td>
                        <td>
                            <?php echo $hasil['namaBuku']; ?>
                        </td>
                        <td>
                            <?php echo $hasil['harga']; ?>
                        </td>
                        <td>
                            <?php echo $hasil['stok']; ?>
                        </td>
                        <td>
                            <?php echo $hasil['penerbit']; ?>
                        </td>
                        <td>
                            <a class="btn btn-warning" href="edit.php?id=<?php echo $hasil['idBuku']; ?>">Edit</a>
                            <a class="btn btn-danger" href="hapus.php?id=<?php echo $hasil['idBuku']; ?>">HAPUS</a>
                        </td>
                    </tr>
                    <?php
            }
            ?>
            </tbody>
        </table>
        <!-- End Data -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>