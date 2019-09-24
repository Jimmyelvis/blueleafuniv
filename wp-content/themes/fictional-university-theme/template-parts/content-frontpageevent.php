
<div class="frontpage-event-summary">

  <div class="frontpage-event-summary_top">

      <div class="left">

          <div class="frontpage-event-summary__date t-center" href="#">
              <span class="frontpage-event-summary__month">
                <?php
                  $eventDate = new DateTime(get_field('event_date'));
                  echo $eventDate->format('M');
                  // the_field('event_date');
                ?>
              </span>

              <span class="frontpage-event-summary__day">
                <?php echo $eventDate->format('d'); ?>
              </span>

          </div>

      </div>

      <div class="right">

          <div class="frontpage-event-summary__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </div>

          <div class="frontpage-event-summary__time">
            <h3>3:00pm</h3>
          </div>

      </div>

  </div>

  <div class="frontpage-event-summary_bottom">
      <div class="frontpage-event-summary__content">
          <p>
            <?php
            if (has_excerpt()) {
              echo get_the_excerpt();
            } else {
              echo wp_trim_words(get_the_content(), 18);
            }
            ?>
          </p>

          <a href="<?php the_permalink(); ?>" class="learnMore btn--babyblue">Learn more</a>

      </div>
  </div>


</div>

