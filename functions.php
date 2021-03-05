<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function hello_elementor_child_enqueue_scripts() {
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		filemtime( get_stylesheet_directory() .'/style.css'),
		'all'
	);
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );


get_template_part( '/cpt' );
get_template_part( '/gallery_metabox' );
get_template_part( '/includes/projects-shortcode' );
get_template_part( '/includes/favourite_projects_shortcode' );


#STEP 1: Create the numeric WordPress pagination function 
 
function njengah_numeric_pagination($wp_query = null) {
 
	$html= "";
    // if( is_singular() )
    //     return;
 
    if( $wp_query ==null){
		global $wp_query;
	}
 
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
 
    //$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;

    if(is_front_page()) {
        $paged = (get_query_var('page')) ? absint( get_query_var('page')) : 1;
    }else {
        $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
    }
    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
	//$html= "";
    $html.='<div class="navigation"><ul>';
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
		$html.="<li>". get_previous_posts_link()." </li>";
        //printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
		$html.="<li". $class."><a href=".esc_url( get_pagenum_link( 1 ) )." >1</a></li>";
        //printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
			$html.='<li> - - - </li>';
			//echo '<li>…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';

		$html.="<li". $class."><a href=".esc_url( get_pagenum_link( $link ) )." >".$link."</a></li>";
        //printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
			$html.= "<li>…</li>";
            //echo '<li>…</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
		$html.="<li". $class."><a href=".esc_url( get_pagenum_link( $max ) )." >".$max."</a></li>";
        //printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link() )
		$html.="<li>".get_next_posts_link()."</li>";
        //printf( '<li>%s</li>' . "\n", get_next_posts_link() );
 
    
	$html.= "</ul></div>";
	//echo '</ul></div>' . "\n";

	return $html;

 
}


add_shortcode( 'projects_tags', 'aaproject_tags_shortcode' );

function aaproject_tags_shortcode(){

    $html = "";
    $terms = get_terms( array( 
        'taxonomy' => 'project_tag',
        'parent'   => 0,
        'hide_empty' => true
    ) );

    $html.= "<div class='project-tags'>";
    $html.="<ul>";
    foreach($terms as $term){
        $html.="<li>";
        $html.="<a href='".get_term_link( $term )."'>";
        $html.="$term->name";
        $html.="</a>";
        $html.="</li>";

    }
    $html.="</div>";
    $html.="</ul>";
    return $html;

}