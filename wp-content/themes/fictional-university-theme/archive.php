<?php 
get_header(); 
pageBanner(array(
  'title' => get_the_archive_title(),
  'subtitle' => get_the_archive_description()
));
?>

<div class="container container--narrow page-section">

  <?php 
  
    while(have_posts()) {
      the_post(); ?>

      <div class="post-item">

          <div class="thumbnail">
            <img class="program-card__image" src="<?php the_post_thumbnail_url('professorLandscape') ?>">
          </div>


            <h3 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

            <div class="metabox">
                <p>
                BY - <?php the_author_posts_link(); ?> on | <?php the_time('D n/j/Y'); ?> </p>
                
                <P> in <?php echo get_the_category_list(', '); ?> </p>
            </div>

            <div class="generic-content">
              <?php the_excerpt(); ?>
              <a class="btn btn--frontpage" href="<?php the_permalink(); ?>">MORE</a>
            </div>

      </div>
      


  <?php } echo paginate_links(); ?>


</div>



<?php get_footer();



?>