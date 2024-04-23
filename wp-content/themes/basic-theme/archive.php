<?php get_header('secondary'); ?>

<section class="">
    

        

        <?php get_template_part('includes/section', 'archive')?>

        <!-- kode ini untuk pagination Button yang lebih simple  -->
        <?php previous_posts_link();?>
        <?php next_posts_link();?>

        <?php 
            // kode ini dibuat untuk pagination yang menampilkan jumlah page yang ada 
            // global $wp_query;

            // $big= 999999999;

            // echo paginate_links(array(
            //     'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big)  ) ),
            //     'format' => '?paged=%#%',
            //     'current' => max(1, get_query_var('paged') ),
            //     'total' => $wp_query->max_num_pages)

            //      );
        ?>
        

</section>
 

  <?php get_footer()  ?>