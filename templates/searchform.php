<form role="search" method="get" class="search-form block-search form-inline" action="<?php echo home_url('/'); ?>">
  <div class="input-group">
    <input type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" class="search-field form-control" placeholder="<?php _e('Search', 'roots'); ?> <?php bloginfo('name'); ?>">
    <label class="hide"><?php _e('Search for:', 'roots'); ?></label>
    <span class="input-group-btn">
      <button type="submit" class="btn btn-primary-very-light search-button"><span class="fa fa-search">  </span> <?php _e('Search', 'roots'); ?></button>
    </span>
  </div>
</form>
 