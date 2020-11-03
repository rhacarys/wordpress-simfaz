<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo( 'name' ); ?></title>
    <?php wp_head() ?>
</head>

<body <?php body_class(); ?>>

    <div class="container full-height"> <!-- Container Global -->
        <header class="site-header"> <!-- Cabeçalho -->
            <a href="<?php echo home_url(); ?>" class="site-logo"> <!-- Logo do Site -->
                <?php 
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                if ( has_custom_logo() ) {
                        echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                } else {
                        echo get_bloginfo( 'name' );
                } 
                ?>
            </a>
            
            <div class="site-menu-toggler"> <!-- Toggler para o Menu Responsivo -->
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>

            <div class="site-menu"> <!-- Menu Principal do Site -->
                <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>

                <?php // Busca o link para o botão de login, nos menus de navegação
                $login_link_menu = get_term(get_nav_menu_locations()['login-link-menu'], 'nav_menu') -> name;
                $link = array_shift(wp_get_nav_menu_items( $login_link_menu ));
                if ($link) { ?>
                    <div class="user-menu"> <!-- Botão de Login do Usuário -->
                        <a href="<?php echo $link->url; ?>" title="<?php echo $link->title; ?>"
                        class="user-icon" target="_blank"></a>
                    </div>
                <?php } ?>
            </div>

            <?php // Busca o link para o Whatsapp, nos menus de navegação
            $whatsapp_link_menu = get_term(get_nav_menu_locations()['whatsapp-link-menu'], 'nav_menu') -> name;
            $wpp = array_shift(wp_get_nav_menu_items( $whatsapp_link_menu ));
            if ($wpp) { ?>
                <div class="wpp-menu"> <!-- Botão do Whatsapp -->
                    <a href="<?php echo $wpp->url; ?>" title="<?php echo $wpp->title; ?>"
                        class="wpp-icon" target="_blank"></a>
                </div>
            <?php } ?>
        </header>