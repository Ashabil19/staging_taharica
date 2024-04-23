<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Custom CSS -->
     <link rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>css/main.css">
    <title><?php bloginfo('name');?></title>

    <?php wp_head();?>

</head>
<body <?php body_class();?>>
    <nav class="d-flex align-items-center justify-content-end p-4" style="gap:20px;">
        <?php
           $home_url = home_url();
            // Cek apakah pengguna sudah login
            if ( is_user_logged_in() ) {
                // Mendapatkan URL logout
                $logout_url = wp_logout_url( home_url() ); // Redirect ke halaman utama setelah logout, Anda dapat mengubahnya sesuai kebutuhan
            
                // Output tombol logout
                echo "<a class='btn btn-primary text-light' href='{$home_url}/izin/'>Pengajuan Izin</a>";
                echo "<a class='btn btn-primary text-light' href='{$home_url}/cuti/'>Pengajuan Cuti</a>";
                echo "<a class='btn btn-light' href='" . esc_url( $logout_url ) . "'>Logout</a>";
                echo '<a href="' . $home_url . '/wp-admin/profile.php" class="">';
                echo '<img src="' . get_template_directory_uri() . '/assets/icon-user.png" alt="img" class="img-fluid navigation-ball-user flexbox" />';
                echo '</a>';

        

            }
        ?>

    </nav>


                 