<footer class="padding-top-15">
	<div class="container">
		<div class="col-lg-3">
			<?php if(is_active_sidebar('about')):?>
                <?php dynamic_sidebar('about')?>
            <?php endif; ?>  
		</div>
		<div class="col-lg-3">
			<?php if(is_active_sidebar('thong-tin-lien-he')):?>
                <?php dynamic_sidebar('thong-tin-lien-he')?>
            <?php endif; ?>  
		</div>
		<div class="col-lg-3">			
			<div class="container-huongdan">
				<h3>Hướng dẫn</h3>
				<div>
				<?php     
                $args = array( 
                    'menu'              => '', 
                    'container'         => '', 
                    'container_class'   => '', 
                    'container_id'      => '', 
                    'menu_class'        => 'huongdan', 
                    'menu_id'           => 'huong-dan', 
                    'echo'              => true, 
                    'fallback_cb'       => 'wp_page_menu', 
                    'before'            => '', 
                    'after'             => '', 
                    'link_before'       => '', 
                    'link_after'        => '', 
                    'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',  
                    'depth'             => 3, 
                    'walker'            => '', 
                    'theme_location'    => 'huong-dan' 
                );
                wp_nav_menu($args);
                ?>   
                <div class="clr"></div>	
				</div>
			</div>			
		</div>
		<div class="col-lg-3">
			<?php if(is_active_sidebar('fanpage')):?>
                <?php dynamic_sidebar('fanpage')?>
            <?php endif; ?>  
		</div>
	</div>
</footer>
<div class="modal fade" id="modal-alert-add-cart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>        
      </div>
      <div class="modal-body">
        
      </div>      
    </div>
  </div>
</div>