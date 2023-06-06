<?php get_header(); ?>
<div class="hero">
  <h2><?php the_title(); ?></h2>
</div>
<div id="primary">
  <main id="main" class="site-main" role="main">
    <?php
    // content of page.
    while (have_posts()) : the_post();
    ?>
      <?php the_post_thumbnail('thumbnail'); ?>
      <div class="content-box">
        <?php the_content(); ?>
        <div class="address"><?php the_field('address'); ?></div>
        <a href="<?php the_field('externalurl'); ?>">Read Review</a>
      </div>
      <?php
      // comment section.
      if (comments_open() || get_comments_number()) :
      ?>
        <div class="comments-box">
          <?php comments_template(); ?>
        </div>
      <?php
      endif;
      ?>
    <?php endwhile; ?>
  </main>
</div>
<?php get_footer(); ?>
