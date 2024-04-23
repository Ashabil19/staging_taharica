<?php
// Periksa apakah URL saat ini adalah halaman login
if (strpos($_SERVER['REQUEST_URI'], '/login') !== false) {
    get_header('header');
    // Jika URL adalah halaman login, maka hanya menampilkan konten yang sesuai
    if (have_posts()):
        while (have_posts()):
            the_post();
            the_content();
        endwhile;
    else:
        // Jika tidak ada konten yang ditemukan
        echo "No content found.";
    endif;  
} else {
    // Jika URL bukan halaman login, tampilkan konten lengkap
    get_header('secondary');
?>
    <div class="wrapper-heading container d-flex justidy-content-center align-items-center flex-column mb-5">
        <div class="card p-5" style="width:800px;">
            <form class="text-dark" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="namaKaryawan">Nama Karyawan</label>
                        <input type="text" class="form-control" id="namaKaryawan" name="namaKaryawan">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="divisi">Divisi</label>
                        <select name="divisi" class="form-control">
                            <option value="" selected disabled>Pilih</option>
                            <option value="it">IT</option>
                            <option value="sales">Sales</option>
                            <option value="engineering">Engineering</option>
                            <option value="Purchasing">Purchasing</option>
                            <option value="finance">Finance</option>
                            <option value="director">director</option>
                            <option value="hrd">HRD</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-md-12">
                        <label class="control-label " for="nomorTelpon">Nomor Telpon</label>
                        <input type="number" name="nomorTelpon" class="form-control mb-2">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="control-label" for="mulaiIzin">Tanggal Mulai</label>
                        <input class="form-control" id="mulaiIzin" name="mulaiIzin"  type="date"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label" for="akhirIzin">Tanggal Berakhir</label>
                        <input class="form-control" id="akhirIzin" name="akhirIzin"  type="date"/>
                    </div>
                </div>
                <p id="selisih-tanggal"></p>                
                <div class="form-row">
                    <div class="col-md-12">
                        <label class="control-label  " for="alasan Izin">Alasan Izin</label>
                        <textarea name="alasan Izin" class="form-control mb-3" id="alasan Izin" cols="30" rows="4"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12">
                        <label class="control-label " for="dokumentasi">Dokumentasi</label>
                        <input class="form-control" id="akhirCuti" name="dokumentasi"  type="file"/>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3" name="submit">Submit</button>

            </form>
        </div>
    </div>






    
    <?php
    // Memeriksa apakah form telah disubmit
    if(isset($_POST['submit'])) {
        // Memeriksa apakah nilai-nilai form telah diset
        if(isset($_POST['namaKaryawan'], $_POST['divisi'], $_POST['nomorTelpon'], $_POST['mulaiIzin'], $_POST['akhirIzin'], $_POST['alasanIzin'], $_FILES['dokumentasi'])) {
            // Mengambil nilai dari form
            $namaKaryawan = $_POST['namaKaryawan'];
            $divisi = $_POST['divisi'];
            $nomorTelpon = $_POST['nomorTelpon'];
            $mulaiIzin = $_POST['mulaiIzin'];
            $akhirIzin = $_POST['akhirIzin'];
            $alasanIzin = $_POST['alasanIzin'];
            $dokumentasi = $_FILES['dokumentasi'];

            // Menghitung jumlah hari izin
            $selisihWaktu = abs(strtotime($akhirIzin) - strtotime($mulaiIzin));
            $selisihHari = ceil($selisihWaktu / (60 * 60 * 24) - 1);
            
            // Lakukan operasi atau penyimpanan data lainnya sesuai kebutuhan Anda di sini
            // Contoh: menyimpan data ke database

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

            // Query untuk menyimpan data izin ke dalam tabel wp_izin
            $query = "INSERT INTO wp_izin (nama_karyawan, divisi, nomor_telpon, mulai_izin, akhir_izin, alasan_izin, dokumentasi) 
                    VALUES ('$namaKaryawan', '$divisi', '$nomorTelpon', '$mulaiIzin', '$akhirIzin', '$alasanIzin', '$dokumentasi')";


            // Melakukan eksekusi query
            $result = $koneksi->query($query);



            // Jika query berhasil dieksekusi 
            if($result) {
                echo "<div id='data-submited'>Data berhasil di submit</div>";
      
            } else {
                echo "Terjadi kesalahan saat menyimpan data izin: " . $koneksi->error;
            }

            // Menutup koneksi
            $koneksi->close();
        } else {
            // Jika nilai form tidak diset, tampilkan pesan kesalahan
            echo "Form isian tidak lengkap.";
        }
    }
    ?>


    





<script>
        const tanggalMulai = document.getElementById('mulaiIzin');
        const tanggalAkhir = document.getElementById('akhirIzin');
        const selisihTanggalElemen = document.getElementById('selisih-tanggal');

        function hitungSelisihHari() {
            // Ambil nilai tanggal dari elemen input
            const tanggalMulaiValue = new Date(tanggalMulai.value);
            const tanggalAkhirValue = new Date(tanggalAkhir.value);

            // Validasi apakah kedua tanggal telah dipilih
            if (isNaN(tanggalMulaiValue) || isNaN(tanggalAkhirValue)) {
                // Jika salah satu atau kedua tanggal tidak valid, kosongkan elemen <p>
                selisihTanggalElemen.textContent = "";
                return;
            }

            // Hitung selisih waktu dalam milidetik antara dua tanggal
            const selisihWaktu = Math.abs(tanggalAkhirValue - tanggalMulaiValue + 1) ;

            // Hitung jumlah hari dalam selisih waktu
            const selisihHari = Math.ceil(selisihWaktu / (1000 * 60 * 60 * 24));

            // Tampilkan hasilnya di elemen <p>
            selisihTanggalElemen.textContent = "Lama Cuti : " + selisihHari + " Hari";
        }

        // Panggil fungsi hitungSelisihHari() saat nilai input berubah
        tanggalMulai.addEventListener('change', hitungSelisihHari);
        tanggalAkhir.addEventListener('change', hitungSelisihHari);



                // Fungsi untuk menutup alert setelah beberapa detik
                setTimeout(function() {
            var userAlert = document.getElementById('data-submited');
            if (userAlert !== null) {
                userAlert.remove();
            }
        }, 3000); // 3000 milidetik = 3 detik
    </script>
<?php
} 
?>
