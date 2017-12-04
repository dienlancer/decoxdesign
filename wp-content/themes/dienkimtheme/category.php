<?php get_header();     ?>
     <div class="container margin-top-15">
         <div class="col-lg-9 no-padding">
            <?php get_template_part("loop","category"); ?>
         </div>
         <div class="col-lg-3 no-padding-right">
            <?php if(is_active_sidebar('right-col')):?>
                <?php dynamic_sidebar('right-col')?>
            <?php endif; ?>  
         </div>
     </div>
    <?php get_footer(); ?>
    <?php wp_footer();?>
</body>
</html>