<?php

  get_header(  );

while (have_posts()) {

  the_post(); 
  pageBanner();
  ?>



    <div class="container container--narrow page-section">

      <!-- 
        Check to see if the page has a parent page. If it has a parent
        page then display the metabox below, else omit displaying the
        metabox
       -->

      <?php 
        /* get the parent of the current if one exists assign
          assign it to the variable $theParent
        */
        $theParent = wp_get_post_parent_id(get_the_ID());
        if ( $theParent ) {
          
      ?>

        <div class="metabox metabox--position-up metabox--with-home-link">
          
          <a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent) ?>">
            <i class="fa fa-home" aria-hidden="true"></i> 
            <?php echo get_the_title($theParent) ?>
          </a> 
          <span class="metabox__main"> <?php the_title(); ?> </span>
  
        </div>
          
          
        <?php  } ?>

     

      <?php 

      /*
      Use $testArray variable from above test to see
      the current page has any children
      */
      $testArray = get_pages(array(
        'child_of' => get_the_ID()
      ));
      
      if ($theParent or $testArray ) { ?>

      <!--
       if $testArray or $theParent does not equal false then it
       means that this page either has child pages, or this page's parent
       has child page(s), so display the menu of child pages link below
      -->
      
      <div class="page-links">
        <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent); ?></a></h2>
        <ul class="min-list">

       
          <?php 

            if ($theParent) {
              /* If this is a child page assign the ID of its
              parent to $findChildrenOf variable 
              */
              $findChildrenOf = $theParent;
            } else {
              /* If this is a parent page assign the ID this page
               to $findChildrenOf variable 
              */
              $findChildrenOf = get_the_ID();
            }
            
              /* Use the $findChildrenOf variable from above to find
                  and genarate links to child pages
              */
            wp_list_pages(
              array(
                'title_li' => NULL,
                'child_of' =>$findChildrenOf ,
                'sort_column' => 'menu_order'
              )
            );
          ?>
        </ul>
       
      </div>

      <?php } ?>


      <div class="generic-content__page">
         <?php the_content(); ?>
      </div>

     

    </div>




  <?php 

}

  get_footer();

?>