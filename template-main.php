<?php
/*
 * Template Name: Template Principal
 * description: >-
  Page template with a huge title and detailed content
 */

get_header(); ?>

<div class="site-content full-height full-width desktop-flex">

  <?php while (have_posts()) : the_post(); ?>
    <?php
    $title = rwmb_meta('section_title');
    $description = rwmb_meta('section_description');
    $background = array_shift(rwmb_meta('section_image'));
    $next_page = rwmb_meta('section_next');
    ?>

    <div class="col-1">
      <div class="cover" style="background-image: url(<?php echo $background['full_url']; ?>);"></div>
      <div class="container vertical-center">
        <div class="data">
          <div class="title"><?php echo $title; ?></div>
          <div class="description"><?php echo $description; ?></div>
          <?php if ($next_page) { // Se existir próxima página, exibir o botão com o link ?> 
              <div class="button-next-page">
                <a class="link" href="<?php echo site_url( $next_page ); ?>"></a>
              </div>
          <?php } ?>
        </div>  
      </div>
    </div>

    <div class="col-2">
      <div class="spacer"></div>
      <div class="data">
        <?php the_content(); ?>
      </div>
    </div>
    
  <?php endwhile; ?>
</div><!-- site-content -->

<?php get_footer(); ?>