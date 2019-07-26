<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
    <input class="form-control mr-sm-2" value="<?php echo get_search_query() ?>" name="s" id="s" type="search" placeholder="Search" aria-label="Search">
    <button type="submit" id="searchsubmit" class="btn btn-primary hidden"></button>
    <span class="close-search-input"></span>
</form>