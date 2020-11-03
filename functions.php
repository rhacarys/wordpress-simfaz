<?php //Estilos, scripts e ações básicas
function custom_theme_assets() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'css', get_template_directory_uri() . '/assets/css/core.css');
    
    wp_enqueue_script( 'scipts', get_template_directory_uri() . '/assets/js/scripts.js');
    wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'custom_theme_assets' );

add_filter( 'show_admin_bar', '__return_false' );

add_theme_support( 'custom-logo' );
?>


<?php //Menu principal e ícones flutuantes
function register_my_menus() {
    register_nav_menus(
      array(
        'header-menu' => __( 'Menu Principal' ),
        'login-link-menu' => __( 'Link para Login' ),
        'whatsapp-link-menu' => __( 'Conexão com o Whatsapp' ),
        'social-networks-menu' => __( 'Redes Sociais' )
        )
    );
}
add_action( 'init', 'register_my_menus' );

//Adiciona a checkbox para sinalizar que o menu terá a keyword "beta"
function my_wp_nav_menu_item_custom_fields( $item_id, $item, $depth, $args ) {
	$is_beta = (bool) get_post_meta( $item_id, 'is_beta', true );
 
	wp_nonce_field( 'nav_menu_edit', 'nav_menu_is_beta' );
	?>
	<div>
		<input
			type="checkbox"
			class="nav-menu-is-beta"
			name="nav-menu-is-beta[<?php echo $item_id; ?>]"
			id="nav-menu-is-beta-for-<?php echo $item_id; ?>"
			<?php checked( '1', $is_beta ); ?>
			value="1">
		<label for="nav-menu-is-beta-for-<?php echo $item_id; ?>">
			<?php _e( 'beta', 'text-domain'); ?>
		</label>
	</div>
	<?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'my_wp_nav_menu_item_custom_fields', 10, 4 );

function my_wp_update_nav_menu_item( $menu_id, $menu_item_db_id ) {
	if ( ! isset( $_POST['nav_menu_is_beta'] ) || ! wp_verify_nonce( $_POST['nav_menu_is_beta'], 'nav_menu_edit' ) ) {
		return;
	}
 
	$is_beta = ( ! empty( $_POST['nav-menu-is-beta'][ $menu_item_db_id ] ) && '1' === $_POST['nav-menu-is-beta'][ $menu_item_db_id ] );
	update_post_meta( $menu_item_db_id, 'is_beta', $is_beta );
}
add_action( 'wp_update_nav_menu_item', 'my_wp_update_nav_menu_item', 10, 2 );

function my_nav_menu_css_class( $classes, $item, $args = array(), $depth = 0 ) {
	$is_beta = (bool) get_post_meta( $item->ID, 'is_beta', true );
	if ( $is_beta ) {
		$classes[] = 'beta';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'my_nav_menu_css_class', 10, 4 );
?>


<?php //Campos personalizados nas páginas
add_filter( 'rwmb_meta_boxes', 'main_template_register_meta_boxes' );

function main_template_register_meta_boxes( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'      => esc_html__( 'Fields do Template Principal', 'online-generator' ),
        'id'         => 'main-template',
        'post_types' => ['page'],
        'priority'   => 'high',
        'autosave'   => true,
        'fields'     => [
            [
                'type'        => 'text',
                'id'          => $prefix . 'section_title',
                'placeholder' => "T\xc3\x8dTULO",
                'desc'        => "T\xc3\xadtulo da p\xc3\xa1gina, preferencialmente em letras mai\xc3\xbasculas",
                'name'        => "T\xc3\xadtulo",
                'size' => 200,
            ],
            [
                'type' => 'textarea',
                'id'   => $prefix . 'section_description',
                'name' => "Descri\xc3\xa7\xc3\xa3o",
                'desc' => "Subt\xc3\xadtulo, pode conter links",
            ],
            [
                'type'             => 'image',
                'id'               => $prefix . 'section_image',
                'name'             => esc_html__( 'Background', 'online-generator' ),
                'max_file_uploads' => 1,
                'force_delete'     => true,
            ],
            [
                'type' => 'text',
                'id'   => $prefix . 'section_next',
                'name' => "Pr\xc3\xb3xima P\xc3\xa1gina",
                'desc' => "Slug da pr\xc3\xb3xima p\xc3\xa1gina, por exemplo \"socioambiental\"",
                'size' => 200,
            ],
        ],
    ];

    return $meta_boxes;
}
?>