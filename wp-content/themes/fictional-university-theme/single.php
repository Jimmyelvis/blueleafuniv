<?php 

  get_header();

  while(have_posts()) {
    the_post(); 
    pageBanner();

    ?>
  

    <div class="container container--narrow page-section">

          <div class="post-single">

            <div class="thumbnail">
              <img class="program-card__image" src="<?php the_post_thumbnail_url() ?>">
            </div>
  
            <div class="metabox metabox--position-up metabox--with-home-link">
  
              <p>
  
                <a class="metabox__blog-home-link" href="<?php echo site_url('/blog'); ?>"><i class="fa fa-home"
                    aria-hidden="true"></i> Blog Home
                </a> 
                
                <span class="metabox__main">Posted by
                  <?php the_author_posts_link(); ?> on <?php the_time('D n/j/Y - g:iA '); ?> in
                  <?php echo get_the_category_list(', '); ?>
                </span>
  
              </p>
  
            </div>

          </div>



          <div class="generic-content">
           <p> <?php the_content(); ?> </p>
          </div>

          <!-- <div class="postArthurSingle">
            <h3><?php the_author_posts_link(); ?> </h3>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio atque corporis deserunt. Fugit, quidem incidunt.</p>
          </div> -->

    </div>
    

    
  <?php }

  get_footer() 
?>