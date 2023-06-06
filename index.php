<?php get_header(); ?>
<div class="hero">
  <div class="header-center">
    <div class="column1">
      <?php //the logo , hero image and about us section
      if (function_exists('the_custom_logo')) {
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id);
      }
      ?>
      <img src="<?php echo $logo[0]; ?>" alt="Logo" class="hero-logo">
    </div>
    <div class="column2">
      <div class="hero-content">
        <h1>About Us</h1>
        <p><?php the_content(); ?></p>
      </div>
    </div>
  </div>
  <!-- the scroll button section-->
  <div style="text-align: center;">
    <button class="scroll-button" onclick="scrollToSection()">Casino Hotels</button>
  </div>
</div>
  <!-- the dynamic date section-->
<div id="target-section">
  <?php
  $current_date = date('Y-m-d');
  echo '<p class="dynamic-date">Current date is: ' . $current_date . '</p>';
  ?>
<!-- the table section-->
  <table>
    <thead>
      <tr>
        <th>Title</th>
        <th>Thumbnail</th>
        <th>Score</th>
        <th>Address</th>
        <th>External URL</th>
        <th>Rating</th>
        <th>Read Review</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $args = array(
        'category_name' => 'hotels',
        'post_type' => 'post',
        'meta_key' => 'score',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'posts_per_page' => 10,
      );

      $query = new WP_Query($args);
      //the loop wwhich read the posts of hotels category
      if ($query->have_posts()) {
        while ($query->have_posts()) {
          $query->the_post();
          $score = get_field('score');
      ?>
          <tr>
            <td><?php the_title(); ?></td>
            <td><!-- feature image as thumbnail-->
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('thumbnail'); ?>
              <?php endif; ?>
            </td>
            <td>
              <div class="progress-bar" data-score="<?php echo esc_attr($score); ?>"></div>
            </td>
            <td><?php the_field('address') ?></td>
            <td><a href="<?php the_field('externalurl') ?>">Read Review</a></td>
            <td>
              <?php
              /* 
              the rating star, for having that you should install the pluging of ACF star rating, 
              I put it in file and I used the code of follwing refrence
              https://wpdevdesign.com/acf-star-rating-in-wordpress/ 
              */
              $rating = get_field('rating');

              if ($rating) {
                $average_stars = round($rating * 2) / 2;
                $drawn = 5;

                echo '<div class="star-rating">';

                for ($i = 0; $i < floor($average_stars); $i++) {
                  $drawn--;
                  echo '<svg aria-hidden="true" data-prefix="fas" data-icon="star" class="svg-inline--fa fa-star fa-w-18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/></svg>';
                }

                if ($rating - floor($average_stars) === 0.5) {
                  $drawn--;
                  echo '<svg aria-hidden="true" data-prefix="fas" data-icon="star-half-alt" class="svg-inline--fa fa-star-half-alt fa-w-17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 536 512"><path fill="currentColor" d="M508.55 171.51L362.18 150.2 296.77 17.81C290.89 5.98 279.42 0 267.95 0c-11.4 0-22.79 5.9-28.69 17.81l-65.43 132.38-146.38 21.29c-26.25 3.8-36.77 36.09-17.74 54.59l105.89 103-25.06 145.48C86.98 495.33 103.57 512 122.15 512c4.93 0 10-1.17 14.87-3.75l130.95-68.68 130.94 68.7c4.86 2.55 9.92 3.71 14.83 3.71 18.6 0 35.22-16.61 31.66-37.4l-25.03-145.49 105.91-102.98c19.04-18.5 8.52-50.8-17.73-54.6zm-121.74 123.2l-18.12 17.62 4.28 24.88 19.52 113.45-102.13-53.59-22.38-11.74.03-317.19 51.03 103.29 11.18 22.63 25.01 3.64 114.23 16.63-82.65 80.38z"/></svg>';
                }

                for ($i = 0; $i < $drawn; $i++) {
                  echo '<svg aria-hidden="true" data-prefix="far" data-icon="star" class="svg-inline--fa fa-star fa-w-18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z"/></svg>';
                }

                echo '</div>';
              }
              ?>
            </td>
            <td><a href="<?php the_permalink(); ?>">View this casino hotel post</a></td>
          </tr>
        <?php
          }
        } else {
          echo '<tr><td colspan="7">No posts found.</td></tr>';
        }

        wp_reset_postdata();
        ?>
        </tbody>
      </table>
    </div>

    <?php get_footer(); ?>
  </body>

  </html>
