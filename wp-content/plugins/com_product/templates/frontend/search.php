<?php get_header();     ?>
     <div class="container margin-top-15">
         <div class="col-lg-9 no-padding">
            <?php require_once PLUGIN_PATH . DS . "templates" . DS . "frontend". DS . "loop-search.php"; ?>
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