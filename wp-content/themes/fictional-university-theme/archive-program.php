<?php 
get_header(); 
pageBanner(array(
  'title' => 'All The Programs',
  'subtitle' => 'There is something for everyone. Have a look around.'
));
?>


<div class="container container--narrow page-section">

  <ul class="program-cards">

      <?php 
      
        while(have_posts()) {
          the_post(); ?>

            <li class="program-card__list-item">
              <a class="program-card" href="<?php the_permalink(); ?>">
                <img class="program-card__image" src="<?php the_post_thumbnail_url('professorLandscape') ?>">
                <span class="program-card__name"><?php the_title(); ?></span>
              </a>
            </li>
           
            <!-- <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <li>
              <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape') ?>">
            </li> -->


      <?php } echo paginate_links(); ?>

  </ul>

  <hr class="section-break">




</div>



<?php get_footer();



?>