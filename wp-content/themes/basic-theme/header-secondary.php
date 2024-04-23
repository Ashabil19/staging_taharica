<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-S8m5swf/XK7ITX1TT/ZG+Hb9LZk+MIdT8zrKj9QzQoPio/W+HaGjtD0Ntq64s68s6Q1PKzQfLw8uXKd2TTSZSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title><?php bloginfo('name');?></title>

    <?php wp_head();?>
    
</head>
<body <?php body_class();?>>
 
<div class=" header-sec">
    <div class="user-container-sec">
        <a href="javascript:history.go(-1)" class="userIcon-sec">
                   <img src="<?php echo get_template_directory_uri(); ?>/assets/back-icon.png" alt="back" class="userInfo" />
                   
        </a>
    </div>
    <div class="landingPageHead flexbox">
        <?php get_search_form();?>

        <div class="hamburger-menu">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <nav class="menu">
        <div class="menu-toggle">
            <button class="close-menu">&times;</button>
        </div>
        <ul>
            <?php $home_url = home_url();?>
            <li><a href="<?php echo $home_url?>/">Home</a></li>
            <li><a href="<?php echo $home_url?>/it">IT</a></li>
            <li><a href="<?php echo $home_url?>/engineering">ENGINEERING</a></li>
            <li><a href="<?php echo $home_url?>/hr">HRD</a></li>
            <li><a href="<?php echo $home_url?>/hadist">HADIST</a></li>
               <li><a href="<?php echo $home_url?>/sales">SALES</a></li>
            <li><a href="<?php echo $home_url?>/other">OTHER</a></li>
            <li><a href="<?php echo $home_url?>/wp-admin/profile.php">Profile</a></li>
            <li>
                <?php
                    // Cek apakah pengguna sudah login
                    if ( is_user_logged_in() ) {
                        // Mendapatkan URL logout
                        $logout_url = wp_logout_url( home_url() ); // Redirect ke halaman utama setelah logout, Anda dapat mengubahnya sesuai kebutuhan
                    
                        // Output tombol logout
                        echo '<a class="btn btn-danger" href="' . esc_url( $logout_url ) . '">Logout</a>';
                    }
                ?>
            </li>
        </ul>
        </nav>
    </div>
   
</div>


<script type="text/javascript">
    document.querySelector('.hamburger-menu').addEventListener('click', function() {
  document.querySelector('.menu').classList.toggle('active');
});

document.querySelector('.close-menu').addEventListener('click', function() {
  document.querySelector('.menu').classList.remove('active');
});
</script>