<?php get_header(); ?>


  <div class="front-page-banner">

      <div class="front-page-banner__bg-image" style="background-image: url( <?php echo get_theme_file_uri('/images/studying.jpg') ?> );">
      </div>

      

      <div class="front-page-banner__content container t-center c-white">
            <h1 class="headline headline--large">
              <span class="headline headline--blueleaftxt"> BlueLeaf </span> University 
            </h1>
           
    
            <p>
              We provides always our best educational services for our all students and  always try to achieve our students trust and satisfaction
            </p>
            
            <a href="<?php echo get_post_type_archive_link('program'); ?>" class="btn btn--frontpage">Find Your Major</a>
        </div>


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
      

     

      
       <div class="blogs container">

       <?php 
              $today = date('Ymd');
              $pastblogevents = new WP_Query(array(
                'posts_per_page' => 3,
                'post_type' => 'post'

              ));

              while ($pastblogevents->have_posts()) {
                $pastblogevents->the_post();
                // get_template_part('template-parts/content', 'post');
                ?>

                <div class="column">
                  <!-- Post-->
                  <div class="post-module hover">
                    <!-- Thumbnail-->
                    <div class="thumbnail">
                      <!-- <div class="date">
                        <div class="day">27</div>
                        <div class="month">Mar</div>
                      </div> -->
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

  <!-- <div class="full-width-split group">
    <div class="full-width-split__one">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>

        <?php 
          $today = date('Ymd');
          $homepageEvents = new WP_Query(array(
            'posts_per_page' => 2,
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
            get_template_part('template-parts/content', 'event');
          } 

        ?>
     
        
        <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event') ?>" class="btn btn--blue">View All Events</a></p>

      </div>
    </div>
    <div class="full-width-split__two">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>

        <?php 

          $homepagePosts = new WP_Query(array(
            'posts_per_page' => 2
          ));
        
          while ($homepagePosts->have_posts()) {
            $homepagePosts->the_post(); ?>

            <div class="event-summary">
              <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
                <span class="event-summary__month"><?php the_time('M'); ?></span>
                <span class="event-summary__day"><?php the_time('d'); ?></span>  
              </a>
              <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p>
                  <?php 

                    if (has_excerpt()) {
                      echo get_the_excerpt();
                    }else{
                      echo wp_trim_words(get_the_content(), 18);
                    }
                  
                  ?> 
                
                  <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a>
                
                </p>
              </div>
            </div>
           

         <?php }  wp_reset_postdata(); 
        ?>

        


        
        <p class="t-center no-margin"><a href="<?php echo site_url('/blog'); ?> " class="btn btn--yellow">View All Blog Posts</a></p>
      </div>
    </div>
  </div> -->

 
  <div class="subscribe">

      <div class="container">
            
          <div class="subscribemsg">
              <p>Subscribe Newsletter for Get in Touch!</p>    
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


