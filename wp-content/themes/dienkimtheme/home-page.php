<?php 
	/*
	 Template Name: HomePage
	 */	 
     global $zendvn_sp_settings;
     $contacted_phone=$zendvn_sp_settings['contacted_phone'];
$email_to=$zendvn_sp_settings['email_to'];
$address=$zendvn_sp_settings['address'];
$to_name=$zendvn_sp_settings['to_name'];
$telephone=$zendvn_sp_settings['telephone'];
$website=$zendvn_sp_settings['website'];
$opened_time=$zendvn_sp_settings['opened_time'];
$opened_date=$zendvn_sp_settings['opened_date'];
$contaced_name=$zendvn_sp_settings['contacted_name'];
$facebook_url=$zendvn_sp_settings['facebook_url'];
$twitter_url=$zendvn_sp_settings['twitter_url'];
$google_plus=$zendvn_sp_settings['google_plus'];
$youtube_url=$zendvn_sp_settings['youtube_url'];
$instagram_url=$zendvn_sp_settings['instagram_url'];
$pinterest_url=$zendvn_sp_settings['pinterest_url'];   
     ?>
     <?php get_header();     ?>
     <div class="container margin-top-15">
         <div class="col-lg-9 no-padding">
            <?php if(is_active_sidebar('slideshow-widget')):?>
                <?php dynamic_sidebar('slideshow-widget')?>
            <?php endif; ?>   
         </div>
         <div class="col-lg-3 no-padding-right">
            <?php if(is_active_sidebar('right-col-widget')):?>
                <?php dynamic_sidebar('right-col-widget')?>
            <?php endif; ?>  
         </div>
     </div>
    <?php get_footer(); ?>
    <?php wp_footer();?>
</body>
</html>