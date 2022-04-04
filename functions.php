<?php 

function cidw_4w4_enqueue(){
    //wp_enqueue_style('style_css', get_stylesheet_uri());
    wp_enqueue_style('cidw-4w4-le-style', get_template_directory_uri() . '/style.css', array(), filemtime(get_template_directory() . '/style.css'), false);

    wp_enqueue_style('cidw-4w4-google-font',"https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Poppins:wght@300;400;500&family=Roboto&display=swap", false);
}

add_action("wp_enqueue_scripts", "cidw_4w4_enqueue");

/* -------------------------------------------------- Enregistré le menu */
function cidw_4w4_register_nav_menu(){
    register_nav_menus( array(
        'menu_principal' => __( 'Menu principal', 'cidw_4w4' ),
        'menu_footer'  => __( 'Menu footer', 'cidw_4w4' ),
        'footer_colonne'  => __( 'Menu footer colonne', 'cidw_4w4' ),
        'menu_cours'  => __( 'Menu cours', 'cidw_4w4' ),
        'menu_accueil'  => __( 'Menu accueil', 'cidw_4w4' )
    ) );
}
add_action( 'after_setup_theme', 'cidw_4w4_register_nav_menu', 0 );

/* --- */

function prefix_nav_description($item_output, $item) {
    if (!empty($item->description)) {
        $item_output = str_replace($args->link_after . '</a>',
        '<hr><span class="menu-item-description">' . $item->description . '</span>' . '</a>',
        $item_output);
    }
    return $item_output;
}

add_filter('walker_nav_menu_start_el', 'prefix_nav_description', 10, 3);

/* ---------------------------------------------------------------------- filtré les choix du menu principal */

function cidw_4w4_filtre_choix_menu($obj_menu){
    //var_dump($obj_menu);
    foreach($obj_menu as $cle => $value)
    {
       // print_r($value);
       //$value->title = substr($value->title,0,7);
       $value->title = wp_trim_words($value->title,3,"...");
       // echo $value->title . '<br>';
    }
    return $obj_menu;
}
add_filter("wp_nav_menu_objects","cidw_4w4_filtre_choix_menu");

/* --------------------------------------------------------------------  add_theme_support() */

function cidw_4w4_add_theme_support() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
        'height' => 100,
        'width'  => 100,
    ) );
}

add_action('after_setup_theme', 'cidw_4w4_add_theme_support');

/* -------------------------------------------------------------------- Enregistrement du sidebar */

add_action( 'widgets_init', 'my_register_sidebars' );

function my_register_sidebars() {
    register_sidebar( array(
        'id'          =>  'footer_colonne_1' ,
        'name'            => __( 'footer colonne 1' ),
        'description'   => __( 'Ce sidebar s\'affiche dans une colonne du pied de page' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'id'          =>  'footer_colonne_2' ,
        'name'            => __( 'footer colonne 2' ),
        'description'   => __( 'Ce sidebar s\'affiche dans une colonne du pied de page' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'id'          =>  'footer_colonne_3' ,
        'name'            => __( 'footer colonne 3' ),
        'description'   => __( 'Ce sidebar s\'affiche dans une colonne du pied de page' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'id'          =>  'footer_ligne_1' ,
        'name'            => __( 'footer ligne 1' ),
        'description'   => __( 'Ce sidebar s\'affiche dans une ligne du pied de page' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}

?>