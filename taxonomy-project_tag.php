<?php get_header(); ?>

<div class="container">
   
<div class="projects-arvhive-page-grid-wrapper">
   <h3 class="archive-title"><?php echo get_the_archive_title() ?></h3>
      <div class="projects-grid-wrapper">
         <div class="projects-grid">
         <?php if(have_posts()){ ?>
               <?php while(have_posts()){ 
                  the_post(  )  ?>

            <?php get_template_part( '/includes/projectsloop' ); ?>

            <?php } ?>
            <?php 
               echo "<div class='projects-pagination'>";
               echo njengah_numeric_pagination();
               echo "</div>";
            ?>
            <?php }
            else{
               echo "<p class='no-projects-archive'>No projects found.<p>";
            }
                ?>
         </div>
   
      </div>

      <div class="project-sidebar-wrapper">
               
      
      </div>
   </div>
         </div>
</div>
<?php get_footer( ); ?>