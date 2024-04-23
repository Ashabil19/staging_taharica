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
                        <label class="control-label" for="mulaiCuti">Tanggal Mulai</label>
                        <input class="form-control" id="mulaiCuti" name="mulaiCuti"  type="date"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label" for="akhirCuti">Tanggal Berakhir</label>
                        <input class="form-control" id="akhirCuti" name="akhirCuti"  type="date"/>
                    </div>
                </div>

                <p id="selisih-tanggal"></p>
                
                <div class="form-row">
                    <div class="col-md-12">
                        <label class="control-label " for="alasanCuti">Alasan Cuti</label>
                        <textarea name="alasanCuti" class="form-control" id="alasanCuti" cols="30" rows="4"></textarea>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary mt-3" name="submit">Submit</button>
            </form>
        </div>
    </div>






    
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

        // Memeriksa apakah nilai-nila form telah diset
        if(isset($_POST['namaKaryawan'], $_POST['divisi'], $_POST['nomorTelpon'], $_POST['mulaiCuti'], $_POST['akhirCuti'], $_POST['alasanCuti'])) {
            // Mengambil nilai dari form
            $namaKaryawan = $_POST['namaKaryawan'];
            $divisi = $_POST['divisi'];
            $nomorTelpon = $_POST['nomorTelpon'];
            $mulaiCuti = $_POST['mulaiCuti'];
            $akhirCuti = $_POST['akhirCuti'];
            $alasanCuti = $_POST['alasanCuti'];

            // Menghitung jumlah hari cuti
            $selisihWaktu = abs(strtotime($akhirCuti) - strtotime($mulaiCuti));
            $selisihHari = ceil($selisihWaktu / (60 * 60 * 24) + 1 );

            // Query untuk menyimpan data cuti ke dalam tabel
            $query = "INSERT INTO wp_cuti (nama_karyawan, divisi, nomor_telpon, mulai_cuti, akhir_cuti, alasan_cuti, jumlah_hari) VALUES ('$namaKaryawan', '$divisi', '$nomorTelpon', '$mulaiCuti', '$akhirCuti', '$alasanCuti', $selisihHari)";

            // Melakukan eksekusi query
            $result = $koneksi->query($query);
            
            // Jika query berhasil dieksekusi


            if($result) {
                echo "    
                <div class='d-flex justify-content-center align-items-center'>
                    <div id='data-submited' class='alert alert-success alert-dismissible fade show' style='width:50%;'>Data berhasil di submit</div>
                </div>
              ";
             // Arahkan pengguna ke halaman dbizin
                header('Location: ' . $home_url );
                 exit; // Pastikan untuk keluar dari skrip setelah menggunakan header()
            } else {
                echo "          
                <div class='d-flex justify-content-center align-items-center'>
                    <div id='data-submited' class='alert alert-danger alert-dismissible fade show' style='width:50%;'>Gagal Submit</div>
                </div>";
                echo "Terjadi kesalahan saat menyimpan data cuti: " . $koneksi->error;
            }
        } else {
            // Jika nilai form tidak diset, tampilkan pesan kesalahan
            // echo "Form isian tidak lengkap.";
        }

        // Menutup koneksi
        $koneksi->close();
    ?>









    <script>
        const tanggalMulai = document.getElementById('mulaiCuti');
        const tanggalAkhir = document.getElementById('akhirCuti');
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
