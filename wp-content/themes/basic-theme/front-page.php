<?php get_header();?>
    <div class="w-taharica">
    <div class="fullscreen taharica-bg">
        <div class="main d-flex justify-content-center align-items-center flex-column ">
            

            <section class="d-flex justify-content-start align-items-center flex-column  ">
                <h1 class="text-center text-light mb-custom heading-homepage rumah-toga">


  
                    Taharica <br> e-Knowledge 
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/toga.png" alt="toga" class="toga" />
                </h1>
  
                <?php get_search_form();?>
                <?php $home_url = home_url();?>
                <ul class="navigation-menu">
                    <li>
                        <a href="<?php echo $home_url ?>/it/" class="d-flex justify-content-center align-items-center flex-column">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/it-icon.png" alt="img" class="img-fluid navigation-ball flexbox" />
                            <p class="text-center mt-2 navigation-text">IT</p>

                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $home_url ?>/engineering/" class="d-flex justify-content-center align-items-center flex-column">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/engineering-icon.png" alt="img" class="img-fluid navigation-ball flexbox" />
                            <p class="text-center mt-2 navigation-text">Engineering</p>

                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $home_url ?>/hr/" class="d-flex justify-content-center align-items-center flex-column">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/hrd-icon.png" alt="img" class=" img-fluid navigation-ball flexbox" />
                            <p class="text-center mt-2 navigation-text">HR</p>

                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $home_url ?>/sales/" class="d-flex justify-content-center align-items-center flex-column">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/sales-icon.png" alt="img" class="img-fluid navigation-ball flexbox" />
                            <p class="text-center mt-2 navigation-text">Sales</p>

                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $home_url ?>/hadist/" class="d-flex justify-content-center align-items-center flex-column">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/hadist-icon.png" alt="img" class="img-fluid navigation-ball flexbox" />
                            <p class="text-center mt-2 navigation-text">Hadist</p>

                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $home_url ?>/other/" class="">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/other-icon.png" alt="img" class="img-fluid navigation-ball flexbox" />
                            <p class="text-center mt-2 navigation-text">Other</p>

                        </a>
                    </li>
                </ul>
            </section>
            <?php
                // Cek apakah pengguna sudah login
                if (is_user_logged_in()) {
                    // Dapatkan informasi pengguna
                    $current_user = wp_get_current_user();
                    $username = $current_user->user_login;
                    $role = $current_user->roles[0];
                
                    // Tampilkan komponen alert dengan informasi pengguna
                    echo '<div id="user-alert" class="alert alert-success alert-dismissible fade show fixed-top" role="alert">';
                    echo '<strong>Hallo ' . $username . '</strong> From ' . $role . '.';
                    echo '</div>';
                }
            ?>

            <section class="post-highlight gap-custom d-flex justify-content-center align-items-center">
                    <?php 
                   $args = array(
                    'post_type'      => array( 'it', 'hrd', 'engineering', 'sales' ), // Menampilkan post dari jenis post type: it, hrd, engineering, dan sales
                    'posts_per_page' => 4, // Menampilkan maksimal 4 post
                    'meta_key'       => 'post_views',
                    'orderby'        => 'meta_value_num',
                    'order'          => 'DESC'
                );
                        

                        $popular_posts = new WP_Query($args);
                        $post_count = 0; // Counter untuk menghitung jumlah postingan yang sudah dirender

                        if ($popular_posts->have_posts()) :
                            while ($popular_posts->have_posts() && $post_count < 4) : // Batasi hingga 4 postingan
                                $popular_posts->the_post();
                                $post_count++; // Tambahkan counter setiap kali sebuah postingan dirender
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
                        endwhile;
                        endif;
                        wp_reset_postdata();
                    ?>
            </section>
        </div>
    </div>
    </div>
                <!-- function Default Wordpress -->
                <?php //the_title();?>
                <?php //if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php //the_content(); ?>
                <?php //endwhile; else: endif; ?>
    <?php get_footer();?>
    <script type="text/javascript">
        // Fungsi untuk menutup alert setelah beberapa detik
        setTimeout(function() {
            var userAlert = document.getElementById('user-alert');
            if (userAlert !== null) {
                userAlert.remove();
            }
        }, 3000); // 3000 milidetik = 3 detik
    </script>