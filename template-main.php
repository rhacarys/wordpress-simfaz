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
        <div class="data pad-left">
          <div class="title"><?php echo $title; ?></div>
          <div class="description"><?php echo $description; ?></div>
        </div>  
      </div>
    </div>

    <div class="col-2">
      <div class="data pad-right">
        <?php the_content(); ?>
      </div>
    </div>

    <?php if ($next_page) { // Se existir próxima página, exibir o botão com a setinha pra baixo ?> 
        <div class="button-next-page">
          <a class="link" href="<?php echo site_url( $next_page ); ?>"></a>
        </div>

    <?php } else {?>
        <div class="pad-left social-menu"> <!-- Botões de Redes Sociais -->
            <?php
            $social_menu = get_term(get_nav_menu_locations()['social-networks-menu'], 'nav_menu') -> name;
            $links = wp_get_nav_menu_items( $social_menu );
            foreach ($links as $link) {  // Itera manualmente nos itens do menu social ?> 
                <div class="social-button">
                    <a href="<?php echo $link->url; ?>" title="Acesse nosso <?php echo $link->title; ?>"
                    class="social-icon <?php echo $link->title; ?>" target="_blank"></a>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    
  <?php endwhile; ?>
</div><!-- site-content -->

<?php get_footer(); ?>