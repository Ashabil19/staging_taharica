<?php get_header('secondary') ?>
<div class="wrapper-heading container d-flex justify-content-center align-items-center flex-column mb-5">
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Divisi</th>
                    <th scope="col">Mulai Cuti</th>
                    <th scope="col">Akhir Cuti</th>
                    <th scope="col">Lama Cuti</th>
                    <th scope="col">Alasan Cuti</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Informasi koneksi ke database
                $host = 'localhost'; // Sesuaikan dengan host database Anda
                $username = 'ashabil'; // Sesuaikan dengan username database Anda
                $password = 'taharica2024'; // Sesuaikan dengan password database Anda
                $database = 'staging_eknowledge'; // Sesuaikan dengan nama database Anda

                // Membuat koneksi
                $koneksi = new mysqli($host, $username, $password, $database);

                // Memeriksa apakah koneksi berhasil
                if ($koneksi->connect_error) {
                    die("Koneksi gagal: " . $koneksi->connect_error);
                }

                // Query untuk mengambil data dari tabel wp_cuti
                $query = "SELECT * FROM wp_cuti";

                // Melakukan eksekusi query
                $result = $koneksi->query($query);

                // Memeriksa apakah query mengembalikan hasil
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<th scope="row">' . $row['id'] . '</th>';
                        echo '<td>' . $row['nama_karyawan'] . '</td>';
                        echo '<td>' . $row['divisi'] . '</td>';
                        echo '<td>' . date('d-m-Y', strtotime($row['mulai_cuti'])) . '</td>';
                        echo '<td>' . date('d-m-Y', strtotime($row['akhir_cuti'])) . '</td>';
                        echo '<td>' . $row['jumlah_hari'] . '  Hari' . '</td>';
                        echo '<td>' . $row['alasan_cuti'] . '</td>';
                        echo '</tr>';
                        // echo " <div class='d-flex justify-content-center align-items-center'>
                        //             <div id='data-submited' class='alert alert-success alert-dismissible fade show' style='width:50%;'>Upload Success</div>
                        //         </div>"
                    }
                } else {
                    echo "Tidak ada data ditemukan.";
                }

                // Menutup koneksi
                $koneksi->close();
                ?>

            </tbody>
        </table>

    </div>
</div>

<?php
// Memeriksa apakah ada data baru yang gagal disubmit
// if (isset($_GET['submit']) && $_GET['submit'] === 'failed') {
//     echo "
//    ";
// }
?>

<?php get_footer() ?>

<script>
    // Fungsi untuk menutup alert setelah beberapa detik
    setTimeout(function() {
        var userAlert = document.getElementById('data-submited');
        if (userAlert !== null) {
            userAlert.remove();
        }
    }, 3000); // 3000 milidetik = 3 detik
</script>
