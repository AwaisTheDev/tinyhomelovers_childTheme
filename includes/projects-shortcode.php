<?php

add_shortcode( 'projects_shortcode', 'aaprojects_shortcode_function' );


function aaprojects_shortcode_function($atts){
    

    $parameters = shortcode_atts( 
         array(
             'number_of_posts'=> 8,
             'grid_columns' => 3
         ), $atts);


    if(is_front_page()) {
        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
    }else {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }

    $args = array(
        'post_type'      => 'projects',
        'posts_per_page' => $parameters['number_of_posts'],
        'paged'=> $paged,
        'publish_status' => 'published',
        );
    $query = new WP_Query($args);

    $html= "";
    $html.= '<div class="projects-grid-wrapper">';
    $html.='<div class="projects-grid  cols'.$parameters['grid_columns'].'">';

     if( $query->have_posts()):  while( $query->have_posts()){ 
        $query->the_post(  )  ?>

                <?php  
                global $post;
                $photos_query = get_post_meta( get_the_ID(), 'gallery_data', true );
                $project_area = get_post_meta( get_the_ID(), 'project-total-area', true );
                $project_bedrooms = get_post_meta( get_the_ID(), 'project-bedrooms', true );
                $project_bathrooms = get_post_meta( get_the_ID(), 'project-bathrooms', true );
                $project_architect = get_post_meta( get_the_ID(), 'project-architects', true );
                
                $html.='<div class="project-card">
                        <a href="'.get_the_permalink( ).'">
                            <h2 class="project-archive-title">'. get_the_title() .'</h2>
                            <div class="project-images">
                                <div class="project-main-image">
                                '.get_the_post_thumbnail().'
                                </div>';

                $html.='<div class="project-archive-gallery">';

                if($photos_query!=""){
                        $url_array = $photos_query['image_url'];
                        $count = sizeof($url_array);
                        if($count > 2){
                            $count=2; 
                        }
                        for( $i=0; $i<$count; $i++ ){
                            
                            $html.='<div class="img_single_box">
                            <img class="gallery-img" src="' . $url_array[$i].'" alt=""/>
                            </div>';
                           
                        }
                    }
                
                $html.='</div>
                </div></a>';


                $html.='<div class="project-content">
                    <div class="project-archive-tags">';
                        $terms = get_the_terms( get_the_ID(  ), 'project_tag' ); 

                        // echo $terms;
                        if($terms!= null){
                            $html.="<ul>";
                            foreach($terms as $term) {

                            $html.="<li class='project-tags'> <a href=". get_term_link($term)." >".$term->name.'</a></li>';
                            }
                            $html.="</ul>";
                        }
                        
                    
                $html.='</div>';
                $html.='<div class="project-archive-related-information">
                    <ul class="related-informaion-list">
                        <li class="related-information-list-item">
                            <span class="project-list-image">
                            <img src="'.get_stylesheet_directory_uri()."/images/AREA.png".' " alt="" srcset="">
                            </span>
                            <span class="item-title">Area:</span>
                            <span class="item-information">'.$project_area.'</span>
                        </li>
                        <li class="related-information-list-item">
                            <span class="project-list-image">
                            <img src="'.get_stylesheet_directory_uri()."/images/bed.png".' " alt="" srcset="">
                            </span>
                            <span class="item-title">Bed(s):</span>
                            <span class="item-information">'.$project_bedrooms.'x</span>
                        </li>
                        <li class="related-information-list-item">
                            <span class="project-list-image">
                            <img src="'.get_stylesheet_directory_uri()."/images/bath.png".' " alt="" srcset="">
                            </span>
                            <span class="item-title">Bath(s):</span>
                            <span class="item-information">'.$project_bathrooms.'x</span>
                        </li>
                        <li class="related-information-list-item">
                            <span class="project-list-image">
                            <img src="'.get_stylesheet_directory_uri()."/images/architects.png".' " alt="" srcset="">
                            </span>
                            <span class="item-title">Architects:</span>
                            <span class="item-information">'.$project_architect.' </span>
                        </li>
                    </ul>
                </div>';

                $html.='<div class="project-archive-footer">
                    <div class="project-fav-button">
                    '.do_shortcode("[favorite_button post]").'
                    </div>
                    <a href="'. get_the_permalink( ).'">Read More >></a>
                </div>

                </div>

                </div>';

                    }    //ending while loop

                
                //$html.=njengah_numeric_pagination($query);

                endif; //ending if loop
           $html.='</div>';
                $html.="<div class='projects-pagination'>";
                $html.=njengah_numeric_pagination($query);
                $html.="</div>";
           $html.='</div>';

        wp_reset_postdata();
        return $html;
        
}