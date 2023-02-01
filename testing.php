<!DOCTYPE html>
<html>

<head>
    <title>CRUD Petani Kode</title>
    <link rel="icon" href="http://www.petanikode.com/favicon.ico" />
</head>

<body>

    <?php
    // --- koneksi ke database
    $koneksi = mysqli_connect("localhost", "root", "", "data") or die(mysqli_error());
    // --- Fngsi tambah data (Create)
    function tambah($koneksi)
    {

        if (isset($_POST['btn_simpan'])) {
            $idBuku = $_POST['idBuku'];
            $kategori = $_POST['kategori'];
            $namaBuku = $_POST['namaBuku'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $penerbit = $_POST['penerbit'];

            if (!empty($idBuku) && !empty($kategori) && !empty($namaBuku) && !empty($harga) && !empty($stok) && !empty($penerbit)) {
                $sql = "INSERT INTO buku (idBuku, kategori, namaBuku, harga, stok, penerbit) VALUES('" . $idBuku . "','" . $kategori . "','" . $namaBuku . "','" . $harga . "','" . $stok . "','" . $penerbit . "')";
                $simpan = mysqli_query($koneksi, $sql);
                if ($simpan && isset($_GET['aksi'])) {
                    if ($_GET['aksi'] == 'create') {
                        header('location: testing.php');
                    }
                }
            } else {
                $pesan = "Tidak dapat menyimpan, data belum lengkap!";
            }
        }
        ?>
        <form action="" method="POST">
            <fieldset>
                <legend>
                    <h2>Tambah data</h2>
                </legend>
                <label>Id Buku <input type="text" name="idBuku" /></label> <br>
                <label>Kategori <input type="text" name="kategori" /></label> <br>
                <label>Nama Buku <input type="text" name="namaBuku" /></label><br>
                <label>harga <input type="number" name="harga" /></label> <br>
                <label>Stok <input type="number" name="stok" /></label> <br>
                <label>Penerbit <input type="text" name="penerbit" /></label> <br>
                <br>
                <label>
                    <input type="submit" name="btn_simpan" value="Simpan" />
                    <input type="reset" name="reset" value="Besihkan" />
                </label>
                <br>
                <p>
                    <?php echo isset($pesan) ? $pesan : "" ?>
                </p>
            </fieldset>
        </form>
        <?php
    }
    // --- Tutup Fngsi tambah data
// --- Fungsi Baca Data (Read)
    function tampil_data($koneksi)
    {
        $sql = "SELECT * FROM buku";
        $query = mysqli_query($koneksi, $sql);

        echo "<fieldset>";
        echo "<legend><h2>Data Panen</h2></legend>";

        echo "<table border='1' cellpadding='10'>";
        echo "<tr>
            <th>idBuku</th>
            <th>Kategori</th>
            <th>Nama Buku</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Penerbit</th>
            <th>Opsi</th>
          </tr>";

        while ($data = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td>
                    <?php echo $data['idBuku']; ?>
                </td>
                <td>
                    <?php echo $data['kategori']; ?>
                </td>
                <td>
                    <?php echo $data['namaBuku']; ?>
                </td>
                <td>
                    <?php echo $data['harga']; ?>
                </td>
                <td>
                    <?php echo $data['stok']; ?>
                </td>
                <td>
                    <?php echo $data['penerbit']; ?>
                </td>
                <td>
                    <a
                        href="testing.php?aksi=update&idBuku=<?php echo $data['idBuku']; ?>&kategori=<?php echo $data['kategori']; ?>&namaBuku=<?php echo $data['namaBuku']; ?>&harga=<?php echo $data['harga']; ?>&stok=<?php echo $data['stok']; ?>&penerbit=<?php echo $data['penerbit']; ?>">Ubah</a>
                    |
                    <a href="testing.php?aksi=delete&idBuku=<?php echo $data['idBuku']; ?>">Hapus</a>
                </td>
            </tr>
            <?php
        }
        echo "</table>";
        echo "</fieldset>";
    }
    // --- Tutup Fungsi Baca Data (Read)
// --- Fungsi Ubah Data (Update)
    function ubah($koneksi)
    {
        // ubah data
        if (isset($_POST['btn_ubah'])) {
            $idBuku = $_POST['idBuku'];
            $kategori = $_POST['kategori'];
            $namaBuku = $_POST['namaBuku'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $penerbit = $_POST['penerbit'];

            if (!empty($idBuku) && !empty($kategori) && !empty($namaBuku) && !empty($harga) && !empty($stok) && !empty($penerbit)) {
                $sql_update = "UPDATE buku SET kategori='$kategori', namaBuku='$namaBuku', harga='$harga', stok='$stok', penerbit='$penerbit' where idBuku='$idBuku'";
                $update = mysqli_query($koneksi, $sql_update);
                if ($update && isset($_GET['aksi'])) {
                    if ($_GET['aksi'] == 'update') {
                        header('location: testing.php');
                    }
                }
            } else {
                $pesan = "Data tidBukuak lengkap!";
            }
        }

        // tampilkan form ubah
        if (isset($_GET['idBuku'])) {
            ?>
            <a href="testing.php"> &laquo; Home</a> |
            <a href="testing.php?aksi=create"> (+) Tambah Data</a>
            <hr>

            <form action="" method="POST">
                <fieldset>
                    <legend>
                        <h2>Ubah data</h2>
                    </legend>
                    <label>Id Buku<input type="text" name="idBuku" value="<?php echo $_GET['idBuku'] ?>" /></label><br>
                    <label>Kategori<input type="text" name="kategori" value="<?php echo $_GET['kategori'] ?>" /></label> <br>
                    <label>Nama Buku<input type="text" name="namaBuku" value="<?php echo $_GET['namaBuku'] ?>" /></label><br>
                    <label>Harga<input type="number" name="harga" value="<?php echo $_GET['harga'] ?>" /></label> <br>
                    <label>Stok<input type="number" name="stok" value="<?php echo $_GET['stok'] ?>" /></label><br>
                    <label>Penerbit<input type="text" name="penerbit" value="<?php echo $_GET['penerbit'] ?>" /></label>
                    <br>
                    <br>
                    <label>
                        <input type="submit" name="btn_ubah" value="Simpan Perubahan" /> atau <a
                            href="testing.php?aksi=delete&idBuku=<?php echo $_GET['idBuku'] ?>"> (x) Hapus data ini</a>!
                    </label>
                    <br>
                    <p>
                        <?php echo isset($pesan) ? $pesan : "" ?>
                    </p>

                </fieldset>
            </form>
            <?php
        }

    }
    // --- Tutup Fungsi Update
// --- Fungsi Delete
    function hapus($koneksi)
    {
        if (isset($_GET['idBuku']) && isset($_GET['aksi'])) {
            $idBuku = $_GET['idBuku'];
            $sql_hapus = "DELETE FROM buku WHERE idBuku='$idBuku'";
            $hapus = mysqli_query($koneksi, $sql_hapus);

            if ($hapus) {
                if ($_GET['aksi'] == 'delete') {
                    header('location: testing.php');
                }
            }
        }

    }
    // --- Tutup Fungsi Hapus
// ===================================================================
// --- Program Utama
    if (isset($_GET['aksi'])) {
        switch ($_GET['aksi']) {
            case "create":
                echo '<a href="testing.php"> &laquo; Home</a>';
                tambah($koneksi);
                break;
            case "read":
                tampil_data($koneksi);
                break;
            case "update":
                ubah($koneksi);
                tampil_data($koneksi);
                break;
            case "delete":
                hapus($koneksi);
                break;
            default:
                echo "<h3>Aksi <i>" . $_GET['aksi'] . "</i> tidak ada!</h3>";
                tambah($koneksi);
                tampil_data($koneksi);
        }
    } else {
        tambah($koneksi);
        tampil_data($koneksi);
    }
    ?>
</body>

</html>