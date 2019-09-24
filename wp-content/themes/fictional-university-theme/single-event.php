<?php 

  get_header();

  while(have_posts()) {
    the_post(); 
    pageBanner();

    ?>
  

    <div class="container container--narrow page-section">

          <div class="metabox metabox--position-up metabox--with-home-link">

            <p>

              <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); ?>"><i class="fa fa-home"
                  aria-hidden="true"></i> Events Home
              </a> 
              
              <span class="metabox__main">
                <?php the_title() ?>
              </span>

            </p>

          </div>


          <div class="generic-content">
            <?php the_content(); ?>
            
          </div>

          <?php 

              $relatedPrograms = get_field('related_programs');

            
             if ($relatedPrograms) {

              echo '<hr class="section-break">';
              echo '<h2 class="headline headline--medium">Related Program(s)</h2>';
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