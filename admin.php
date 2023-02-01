<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- css tambahan -->
    <link rel="stylesheet" href="tampilan.css">

    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="judul">
            <h2>Daftar Buku</h2>
        </div>
        <div class="pencarian">
            <button class="btn btn-primary">Tambah Data</button>
            <form method="GET" action="admin.php" style="text-align: end;">
                <label>Kata Pencarian : </label>
                <input type="text" name="kata_cari" value="<?php if (isset($_GET['kata_cari'])) {
                    echo $_GET['kata_cari'];
                } ?>" />
                <button type="submit">Cari</button>
            </form>
        </div>

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

            //jika kita klik cari, maka yang tampil query cari ini
            if (isset($_GET['kata_cari'])) {
                //menampung variabel kata_cari dari form pencarian
                $kata_cari = $_GET['kata_cari'];

                //jika hanya ingin mencari berdasarkan kode_produk, silahkan hapus dari awal OR
                //jika ingin mencari 1 ketentuan saja query nya ini : SELECT * FROM produk WHERE kode_produk like '%".$kata_cari."%' 
                $query = "SELECT * FROM buku WHERE namaBuku like '%" . $kata_cari . "%' OR namaBuku like '%" . $kata_cari . "%' ORDER BY idBuku ASC";
            } else {
                //jika tidak ada pencarian, default yang dijalankan query ini
                $query = "SELECT * FROM buku ORDER BY idBuku ASC";
            }


            $result = mysqli_query($koneksi, $query);

            if (!$result) {
                die("Query Error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            }
            //kalau ini melakukan foreach atau perulangan
            while ($hasil = mysqli_fetch_assoc($result)) {
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>
</body>

</html>