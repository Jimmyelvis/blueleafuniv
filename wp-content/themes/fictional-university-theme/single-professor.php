<?php 

  get_header();

  while(have_posts()) {
    the_post(); 
    pageBanner();

    ?>
   


    <div class="container container--narrow page-section">

         <div class="generic-content">
           <div class="row group">

             <div class="one-third">
               <?php the_post_thumbnail('professorPortrait'); ?>
             </div>

             <div class="two-thirds">

               <?php 

                  $likeCount = new WP_Query(array(
                    'post_type' => 'like',
                    'meta_query' => array(
                      array(
                        'key' => 'liked_professor_id',
                        'compare' => '=',
                        'value' => get_the_ID()
                      )
                    )

                  ));

                  $existStatus = 'no';

                  if (is_user_logged_in()) {

                    $existQuery = new WP_Query(array(
                      'author' => get_current_user_id(),
                      'post_type' => 'like',
                      'meta_query' => array(
                        array(
                          'key' => 'liked_professor_id',
                          'compare' => '=',
                          'value' => get_the_ID()
                        )
                      )
  
                    ));
  
                    if ($existQuery->found_posts) {
                      $existStatus = 'yes';
                    }

                  }


               
               ?>

               <span class="like-box" data-like="<?php echo $existQuery->posts[0]->ID ?>" data-professor="<?php the_ID(); ?>"  data-exists="<?php echo $existStatus; ?>">
                  <i class="fa fa-heart-o" aria-hidden="true"></i>
                  <i class="fa fa-heart" aria-hidden="true"></i>
                  <span class="like-count">
                    <?php echo $likeCount->found_posts; ?>
                  </span>
               </span>
               <?php the_content(); ?>
             </div>

           </div>
         </div>
      
   
          <?php 

              /*
                Get the field 'related_programs, and assign it to $relatedPrograms
                If there's a value present for $relatedPrograms then that means
                that this professor has a related program, and we can display it below
              */

              $relatedPrograms = get_field('related_programs');

            
             if ($relatedPrograms) {

              echo '<hr class="section-break">';
              echo '<h2 class="headline headline--medium">Subject(s) Taught</h2>';
              echo '<ul class="link-list min-list">';

              foreach($relatedPrograms as $program) { ?>

                <li class="program-card__list-item">

                  <a class="program-card" href="<?php echo get_the_permalink($program); ?>">

                  <img class="program-card__image" src="<?php echo get_the_post_thumbnail_url($program, 'professorLandscape') ?>">


                    <span class="program-card__name">
                      <?php echo get_the_title($program); ?>
                    </span>
                  </a>
                </li>

              <?php }

              echo '</ul>';

             }

              
          ?>


    </div>
    

    
  <?php }

  get_footer() 
?>