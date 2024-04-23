<section class="pageSingle bg-white-custom"> 
    <div class="d-flex justify-content-center align-items-start pc-3  flex-wrap " style="height: auto;">
        <?php if (have_posts()): while(have_posts()): the_post(); ?> 
            <div class=" card m-3 p-3" style="max-width: 300px; height:auto;">
                <div class="card-body d-flex flex-column text-dark ">
				<?php 
                            // Menampilkan gambar-gambar yang ada di dalam konten artikel
                            $content = get_the_content();
                            $doc = new DOMDocument();
                            @$doc->loadHTML($content);
                            $xpath = new DOMXPath($doc);
                            $imgs = $xpath->query("//img");
                            
                            // Menampilkan semua gambar yang ada di dalam konten artikel
                            foreach ($imgs as $img) {
                                echo '<img class="mb-2 rounded" src="' . $img->getAttribute("src") . '" alt="' . $img->getAttribute("alt") . '" class="img-fluid">';
                            }
                        ?>
                        <h3 class="judul-article"> <?php the_title(); ?></h3>
                        <a href="<?php the_permalink();?>" class="comment-btn">Read More..</a>

              

                </div>
            </div>
        <?php endwhile; else: endif;?>
    </div>
</section>
