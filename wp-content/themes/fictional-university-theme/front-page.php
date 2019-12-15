<?php get_header(); ?>


  <div class="hero-slider">

     <!-- Custom slider for the home page. Query the database to see 
          if any slides has been created from the dashboard, if yes then
        display them -->

    <?php 
      $homepageSlides = new WP_Query(array(
        'post_type' => 'slider',
        'orderby' => 'slide_order',
        'order' => 'ASC',
      ));

      while ($homepageSlides->have_posts()) { 
        $homepageSlides->the_post();
      ?>

        <div class="hero-slider__slide" 
        style="background-image: url(
          <?php 
              $slideImage = get_field('slider_image'); 
              echo $slideImage; 
          ?>
          );">
          <div class="hero-slider__interior container t-center">
            <div class="hero-slider__overlay">
              <h1 class="headline headline--large t-center"><?php the_field('slide_heading'); ?></h1>
              <p class="t-center">
                <?php the_field('slide_content'); ?>
              </p>

              
              <!-- Check to see if an user entered any value in the ACF 
              'slide_button_label' field if yes then check to see if a user 
              has entered any value in the 'slide_link' field, if yes
              add that value to the a tag attribute, else default to #
              as the attr, then display the button -->

              <?php if (get_field('slide_button_label')) { ?>

                  <a 
                    <?php 
                      if (get_field('slide_link')) { ?>
                       
                       href="<?php the_field('slide_link') ?>" 
                     
                     <?php } else { ?>

                      href="#" 
                     
                     <?php } ?>
                    
                    class="btn btn--frontpage">
                    
                      <?php 
                        the_field('slide_button_label') 
                      ?>
                  </a>

              <?php } ?>


            </div>
          </div>
        </div>

      <?php } wp_reset_postdata() ?>

   
  </div>

 

  <div class="selling-point">

      <div class="selling-point__one">

          <img src="<?php bloginfo('template_url'); ?>/images/grad-hat.png" alt="">

          <h3>POPULAR COURSES</h3>

          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti assumenda ea nam minima veniam consectetur quam qui voluptate illo natus?</p>
      </div>

      <div class="selling-point__two">

          <img src="<?php bloginfo('template_url'); ?>/images/books.png" alt="">

          <h3>Modern Library</h3>

          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti assumenda ea nam minima veniam consectetur quam qui voluptate illo natus?</p>
      </div>

      <div class="selling-point__three">

          <img src="<?php bloginfo('template_url'); ?>/images/person.png" alt="">

          <h3>Qualified Teachers</h3>

          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti assumenda ea nam minima veniam consectetur quam qui voluptate illo natus?</p>
      </div>
      

  </div>

  <div class="aboutUs" style="background-image: url( <?php echo get_theme_file_uri('/images/aboutUs.jpg') ?> );">

      <div class="container">

        <h3>ABOUT US</h3>
  
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam consectetur veniam labore at sit sequi amet. Nostrum exercitationem et eaque expedita hic voluptatum quidem alias, officia possimus ducimus aut id labore aliquid architecto laudantium a magnam vel natus, nemo eum ullam soluta. Earum ea maxime similique beatae quo! Officia explicabo maiores tenetur! Autem molestias dolores assumenda nihil nemo nisi, porro at. Eius culpa, expedita, ratione ex vitae enim laboriosam quidem est suscipit voluptas laudantium sed, perferendis possimus esse? Ut asperiores alias repudiandae odit,
        </p> 
          
        <p> 
          sit explicabo suscipit obcaecati. Minima eos magnam et aut dolorem iure dolor odio tenetur tempore excepturi nihil, ea incidunt quis esse vel? Animi voluptate blanditiis odit suscipit ad repudiandae porro eum quisquam consequatur expedita, aut ipsam explicabo nulla enim sapiente, aperiam minima, dolores voluptatibus labore! Maxime a eius cumque debitis accusantium numquam quis omnis? Maiores expedita accusamus necessitatibus sint exercitationem at culpa, delectus commodi, distinctio aliquam omnis.
        </p>

      </div>


  </div>

  <div class="upcomingEvents">

      <h3>UP COMING <span class="secHalfofWord">EVENTS</span> </h3>

      <div class="events container">

            <!-- Check the database for any upcoming events and only
          display events that have not occured yet. If the date has already passed
            then the event gets moved to the archive page.-->

            <?php 
              $today = date('Ymd');
              $homepageEvents = new WP_Query(array(
                'posts_per_page' => 3,
                'post_type' => 'event',
                'meta_key' => 'event_date',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'meta_query' => array(
                  array(
                    'key' => 'event_date',
                    'compare' => '>=', 
                    'value' => $today,
                    'type' => 'numeric'
                  )
                )

              ));

              while ($homepageEvents->have_posts()) {
                $homepageEvents->the_post();
                get_template_part('template-parts/content', 'frontpageevent');
              } 

              ?>
          

      </div>
      

     
        
        <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event') ?>" class="btn btn--univdarkblue">View All Events</a></p>

  </div>

  <div class="fromtheBlogs">

  <h3>FROM OUR<span class="secHalfofWord"> BLOGS</span> </h3>
      
        <!-- Check the database for any blog posts and display  
              links to three of the most recent ones
      -->

     
       <div class="blogs container">

       <?php 
              $pastblogevents = new WP_Query(array(
                'posts_per_page' => 3,
                'post_type' => 'post'

              ));

              while ($pastblogevents->have_posts()) {
                $pastblogevents->the_post();
                ?>

                <div class="column">
                  <!-- Post-->
                  <div class="post-module hover">
                    <!-- Thumbnail-->
                    <div class="thumbnail">
                     
                      <img src="<?php the_post_thumbnail_url('professorLandscape') ?>" />
                    </div>
                    <!-- Post Content-->
                    <div class="post-content">

                      <h1 class="title"><?php the_title(); ?></h1>
                      <h2 class="sub_title">By | <?php the_author_posts_link(); ?> </h2>
                      <p><?php the_excerpt(); ?></p>

                    </div>

                    <a class="btn btn--frontpage" href="<?php the_permalink(); ?>">MORE</a>

                  </div>
                </div>

              <?php  }  ?>
         
        

       </div>

  </div>

 
  <div class="subscribe">

      <div class="container">
            
          <div class="subscribemsg">
              <p>Subscribe to our newsletter</p>    
          </div>

          <div class="subscribeInput">
               <form action="#">
                    
                    <input type="text" class="subscribeform" placeholder="YOUR EMAIL">

                     <a class="btn--subscribe">SUBSCRIBE</a> 

               </form>
          </div>

      </div>

  </div>




<?php  get_footer(); ?>


