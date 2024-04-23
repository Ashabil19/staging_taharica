<?php if (have_posts()): while(have_posts()): the_post(); ?> 

    <p class="">
        <?php echo get_the_date('d F Y');?> <!-- Fungsi bawaan WP untuk mengambil Tanggal bulan dan tahun --> 
    </p >
    <p>Author : 
        <?php 
            $fname = get_the_author_meta('first_name'); 
            $lname = get_the_author_meta('last_name');
            echo $fname .' '. $lname; 
        ?>
    </p>
    <!-- Bagian untuk menampilkan konten artikel -->
    <?php 
        the_content(); 
        
        // Mengambil semua gambar yang ada di dalam konten artikel
        // $content = get_the_content();
        // $doc = new DOMDocument();
        // @$doc->loadHTML($content);
        // $xpath = new DOMXPath($doc);
        // $imgs = $xpath->query("//img");
        
        // // Menampilkan semua gambar yang ada di dalam konten artikel
        // foreach ($imgs as $img) {
        //     echo '<img src="' . $img->getAttribute("src") . '" alt="' . $img->getAttribute("alt") . '" class="img-fluid">';
        // }
    ?>
    

<?php endwhile; else: endif;?>
