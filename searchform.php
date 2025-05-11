<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form">
    <label>
        <input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search...', 'ainext' ); ?>" value="<?php echo get_search_query(); ?>" name="s" required>
    </label>
    <button type="submit" class="search-submit"><i class="ri-search-line"></i></button>
</form>