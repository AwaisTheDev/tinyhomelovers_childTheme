
<?php  
   global $post;
   $photos_query = get_post_meta( get_the_ID(), 'gallery_data', true );
   $project_area = get_post_meta( get_the_ID(), 'project-total-area', true );
   $project_bedrooms = get_post_meta( get_the_ID(), 'project-bedrooms', true );
   $project_bathrooms = get_post_meta( get_the_ID(), 'project-bathrooms', true );
   $project_architect = get_post_meta( get_the_ID(), 'project-architects', true );
?>
<div class="project-card">
<a href="<?php echo the_permalink(  ) ?>">
<h2 class="project-archive-title"><?php echo the_title();?></h2>
<div class="project-images">
   <div class="project-main-image">
      <?php the_post_thumbnail(); ?>
   </div>
   <div class="project-archive-gallery">
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
</a>

<div class="project-content">
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

   <div class="project-archive-footer">
      <div class="project-fav-button">
         <?php the_favorites_button(get_the_ID() ); ?>
      </div>
      <a href="<?php echo the_permalink( ); ?>">Read More >></a>
   </div>

</div>

</div>
