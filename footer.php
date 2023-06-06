<footer>
  <div>
    <?php // dynamic menu
    wp_nav_menu(
      array(
        'menu' => 'primary',
        'container' => '',
        'theme_location' => 'primary',
        'items_wrap' => '<nav id="collapseNav"><ul>%3$s</ul></nav>',
      )
    );
    ?>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
