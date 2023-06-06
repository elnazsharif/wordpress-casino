<!DOCTYPE html>
<html>
<head>
  <title><?php wp_title(); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script>
    // JavaScript function to scroll smoothly to the target section
    function scrollToSection() {
      var targetSection = document.getElementById("target-section");
      targetSection.scrollIntoView({ behavior: 'smooth' });
    }
  </script>
</head>
<body>
  <header>
    <?php wp_head(); ?>
  </header>
