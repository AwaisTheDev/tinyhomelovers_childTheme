<?php
/**
 * Template Name: Favourite Posts
 */


 if(is_user_logged_in()){
   $posts = get_user_favorites($user_id = null, $site_id = null, $filters = null);

   if(empty($posts)){
        echo "<div><p>You have not favourite posts</p></div>";
   }

   foreach($posts as $post_id){
       $post = get_post( $post_id );
       echo $post->post_title;
   }

   
 }




