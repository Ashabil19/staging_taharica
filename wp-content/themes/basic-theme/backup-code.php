<h1 class="">MostView</h1>
        <section class="post-highlight gap-custom d-flex justify-content-center align-items-center">
            <?php
            // Mendapatkan kategori saat ini dari URL
            $current_category_slug = get_query_var('category_name');

            // Buat argument query untuk menampilkan postingan populer berdasarkan kategori yang sesuai
            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => 4,
                'meta_key'       => 'post_views',
                'orderby'        => 'meta_value_num',
                'order'          => 'DESC',
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => $current_category_slug,
                    ),
                ),                                                                                                                                                                                                 
            );
            // Jalankan WP_Query dengan argument yang telah dibuat
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
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/programmer.jpeg" alt="gambar" class="img-fluid" />
                            <?php endif; ?>
                            <p class="mostviewCaption text-center"><?php the_title(); ?></p>
                        </a>
                    </div>
            <?php
                endwhile;
            else :
                // Tampilkan pesan jika tidak ada postingan populer dalam kategori
                echo '<p>No popular posts in this category.</p>';
            endif;
            wp_reset_postdata();
            ?>
        </section>
