<?php get_header(); ?>

<div class="container">
<div class="single-project-page-wrapper">
    <div class="single-project-wrapper">
    <?php while(have_posts( )): the_post(); ?>

    <div class="prject-top-content">
        <h2 class="project-title"><?php the_title( ); ?></h2>

        <?php
                  global $post;
                  $photos_query = get_post_meta( get_the_ID(), 'gallery_data', true );
                  $project_area = get_post_meta( get_the_ID(), 'project-total-area', true );
                  $project_bedrooms = get_post_meta( get_the_ID(), 'project-bedrooms', true );
                  $project_bathrooms = get_post_meta( get_the_ID(), 'project-bathrooms', true );
                  $project_architect = get_post_meta( get_the_ID(), 'project-architects', true );
        ?>

        <div class="project-share-links">
            <?php get_template_part( '/includes/sharepostlinks' ); ?>

            <div class="project-fav-button">
                <?php the_favorites_button(get_the_ID() ); ?>
            </div>
        </div>

        <div class="publish-date">
            <?php echo get_the_date( ); ?>
        </div>
    </div>
    <div class="project-images">
                  <div class="project-main-image">
                     <?php the_post_thumbnail(); ?>
                  </div>
                  <div class="project-archive-gallery" style="display:none;">
                  <?php 
                     
                     if($photos_query!=""){
                        $url_array = $photos_query['image_url'];
                        $count = sizeof($url_array);
                        if($count > 2){
                           $count=2; 
                        }
                        for( $i=0; $i<$count; $i++ ){
                           ?>		
                           <div class="img_single_box">
                              <img class="gallery-img" src="<?php echo $url_array[$i]; ?>" alt=""/>
                           </div>	
                           <?php 
                        }
                     }
                  ?>
                  </div>
               </div>
               <div class="project-archive-tags">
               <?php
                  $terms = get_the_terms( get_the_ID(  ), 'project_tag' ); 

                  // echo $terms;
                  if($terms!= null){
                     echo "<ul>";
                     foreach($terms as $term) {

                        echo "<li class='project-tags'> <a href=". get_term_link($term)." >".$term->name.'</a></li>';
                        }
                        echo "</ul>";
                  }
                  
               ?>
            </div>

               <div class="project-archive-related-information">
                     <ul class="related-informaion-list">
                        <li class="related-information-list-item">
                           <span class="project-list-image">
                              <img src="<?php echo get_stylesheet_directory_uri()."/images/AREA.png"; ?>" alt="" srcset="">
                           </span>
                           <span class="item-title">Area:</span>
                           <span class="item-information"><?php echo $project_area; ?></span>
                        </li>
                        <li class="related-information-list-item">
                           <span class="project-list-image">
                              <img src="<?php echo get_stylesheet_directory_uri()."/images/bed.png"; ?>" alt="" srcset="">
                           </span>
                           <span class="item-title">Bed(s):</span>
                           <span class="item-information"><?php echo $project_bedrooms; ?>x</span>
                        </li>
                        <li class="related-information-list-item">
                           <span class="project-list-image">
                              <img src="<?php echo get_stylesheet_directory_uri()."/images/bath.png"; ?>" alt="" srcset="">
                           </span>
                           <span class="item-title">Bath(s):</span>
                           <span class="item-information"><?php echo $project_bathrooms; ?>x</span>
                        </li>
                        <li class="related-information-list-item">
                           <span class="project-list-image">
                              <img src="<?php echo get_stylesheet_directory_uri()."/images/architects.png"; ?>" alt="" srcset="">
                           </span>
                           <span class="item-title">Architects:</span>
                           <span class="item-information"><?php echo $project_architect; ?></span>
                        </li>
                     </ul>
                  </div>

                  <div class="project-content">
                      <?php the_content(); ?>
                  </div>

                  <div class="single-post-paginaion">
                     <?php previous_post_link('%link',"< Previous Project") ?>
                     <?php next_post_link('%link',"Next Project >") ?>
                  </div>
                  

    <?php endwhile ?>
    </div>

    <div class="project-single-sidebar">
    <?php 

      global $post;
      $shortcode = get_post_meta( get_the_ID(), 'elementor_sidebar_shortcode', true );
      
      //echo apply_filters( 'the_content',"$shortcode");

      echo do_shortcode( $shortcode );
    
    ?>
    </div>

    </div>
</div>

<?php get_footer(); ?>