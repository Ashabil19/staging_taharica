<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">

        <input type="search" class="search-field" placeholder="Your Favorite" value="<?php echo get_search_query(); ?>" name="s" required />
        <button type="submit" class="border-white search-btn">Search!</button>
  
</form>
