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
    <div class="wrapper-heading container d-flex justidy-content-center align-items-start flex-column mb-5">
        <h1>
        <?php echo ucfirst(get_the_title());?>
        </h1>
   <?php
            $user = wp_get_current_user();
            $current_user = wp_get_current_user();
            $username = $current_user->user_login;
            $role = $current_user->roles[0];  //untuk mengambil value role pada table user
            // echo 'Hallo ' . ucfirst($username) . ' From ' . ucfirst($role) . '.';
            
            $home_url = home_url();
            // echo $home_url;
            
            // Mendapatkan halaman saat ini
            $current_page = $_SERVER['REQUEST_URI'];
            
            if ($role == "administrator") {
                // Jika peran pengguna adalah "administrator", tampilkan tombol "Dashboard Administrator" di semua halaman
                echo "<a href='$home_url/wp-admin/' class='border-white search-btn text-white'>Dashboard Administrator</a>";
            } elseif ($role == "it" && strpos($current_page, "it") !== false) {
                // Jika peran pengguna adalah "it" dan halaman yang dibuka adalah "it", tampilkan tautan "Create Post" untuk "it"
                $page = "it";
                echo "<a href='$home_url/wp-admin/post-new.php?post_type=$page' class='border-white search-btn text-white'>Create Post</a>";
            } elseif ($role == "hrd" && strpos($current_page, "hrd") !== false) {
                // Jika peran pengguna adalah "hrd" dan halaman yang dibuka adalah "hrd", tampilkan tautan "Create Post" untuk "hrd"
                $page = "hrd";
                echo "<a href='$home_url/wp-admin/post-new.php?post_type=$page' class='border-white search-btn text-white'>Create Post</a>";
            } elseif ($role == "engineering" && strpos($current_page, "engineering") !== false) {
                // Jika peran pengguna adalah "engineering" dan halaman yang dibuka adalah "engineering", tampilkan tautan "Create Post" untuk "engineering"
                $page = "engineering";
                echo "<a href='$home_url/wp-admin/post-new.php?post_type=$page' class='border-white search-btn text-white'>Create Post</a>";
            } elseif ($role == "sales" && strpos($current_page, "sales") !== false) {
                // Jika peran pengguna adalah "sales" dan halaman yang dibuka adalah "sales", tampilkan tautan "Create Post" untuk "sales"
                $page = "sales";
                echo "<a href='$home_url/wp-admin/post-new.php?post_type=$page' class='border-white search-btn text-white'>Create Post</a>";
            } else {
                // Tidak ada tautan
                echo ""; 
            }
    ?>



        
    </div>
    <section class="page">
        <div class=" container-fluid text-light container ">
            <!-- Konten yang dihilangkan hanya ketika bukan halaman login -->
            <h1 class=" p-0 text-start m-text">Most View</h1>

            <div class="mostview">
            <?php
                // Mendapatkan nama kategori dari halaman yang sedang ditampilkan
                $current_page_slug = get_query_var('pagename');
                $category_name = sanitize_title($current_page_slug);
                $args02 = array(
                    'post_type' => 'other', // Replace 'your_custom_post_type' with your actual custom post type slug
                    'posts_per_page' => 3, // To retrieve all posts, set this to -1
                );

                $popular_posts = new WP_Query($args02);
                $post_count = 0; // Counter untuk menghitung jumlah postingan yang sudah dirender  
                if ($popular_posts->have_posts()):
                    while ($popular_posts->have_posts() && $post_count < 4): // Batasi hingga 4 postingan
                        $popular_posts->the_post();
                        ?>
                        
                              <div class="mostview-card">
                                <a class="mostviewHome" href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('thumbnail', array('class' => 'img-fluid')); ?>
                                    <?php else : ?>
                                        <?php 
                                            $image = get_field('post-image'); // Mengambil nilai gambar dari ACF
                                            if ($image): // Memeriksa apakah ada gambar yang tersedia
                                        ?>
                                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image); ?>" class="img-fluid" />
                                        <?php else: // Jika tidak ada gambar yang tersedia ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/programmer.jpeg" alt="img" class="img-fluid" />
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <p class="mostviewCaption text-center text-light">
                                        <?php the_title(); ?>
                                    </p>
                                </a>
                            </div>


                        <?php
                        $post_count++; // Tambahkan counter setiap kali sebuah postingan dirender
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>

            <br><br><br>

            <div class="container">
    <?php
    // WP_Query arguments
    $args = array(
        'post_type' => 'other', // Replace 'your_custom_post_type' with your actual custom post type slug
        'posts_per_page' => -1, // To retrieve all posts, set this to -1
    );

    // The Query
    $query = new WP_Query($args);

    // Initialize an array to store posts based on categories
    $posts_by_category = array();

    // The Loop
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            // Get the category for the current post
            $kategori = get_field('kategori');
            // Check if the category exists in the array, if not, create a new array key for it
            if (!isset($posts_by_category[$kategori])) {
                $posts_by_category[$kategori] = array();
            }
            // Store the current post in the array based on its category
            $posts_by_category[$kategori][] = $post;
        }

        // Output posts by category
        foreach ($posts_by_category as $kategori => $posts) {
            echo '<div class="row justify-content-center">';
            echo '<div class="col-md-12">';
            echo "<div class=' btn btn-light mb-3'>" . $kategori . '</div>'; // Output the category as the section title
            echo '<div class="row">';
            // Output each post within this category
            foreach ($posts as $post) {
                setup_postdata($post); ?>
                <div class="col-md-3 mb-3">
                   <div class="mostview-card">
                        <a class="mostviewHome" href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('thumbnail', array('class' => 'img-fluid')); ?>
                            <?php else : ?>
                                <?php 
                                    $image = get_field('post-image'); // Mengambil nilai gambar dari ACF
                                    if ($image): // Memeriksa apakah ada gambar yang tersedia
                                ?>
                                    <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image); ?>" class="img-fluid" />
                                <?php else: // Jika tidak ada gambar yang tersedia ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/programmer.jpeg" alt="img" class="img-fluid" />
                                <?php endif; ?>
                            <?php endif; ?>
                            <p class="mostviewCaption text-center text-light">
                                <?php the_title(); ?>
                            </p>
                        </a>
                    </div>

                </div>
            <?php }
            echo '</div>'; // Close the row
            echo '</div>'; // Close the column
            echo '</div>'; // Close the container
        }
    } else {
        // no posts found
    }
    /* Restore original Post Data */
    wp_reset_postdata();
    ?>
</div> <!-- /.container -->



            





            <?php
            if (have_posts()):
                while (have_posts()):
                    the_post(); ?>
                    <?php //the_content(); ?>
                <?php endwhile;
            endif;
            ?>
        </div>
    </section>

    <?php get_footer();
} // Tutup blok kondisi 
?>



