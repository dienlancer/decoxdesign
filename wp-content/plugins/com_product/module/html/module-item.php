<?php 
global $zController,$zendvn_sp_settings;
$vHtml=new HtmlControl();
$contacted_phone=$zendvn_sp_settings['contacted_phone'];
$email_to=$zendvn_sp_settings['email_to'];
$address=$zendvn_sp_settings['address'];
$to_name=$zendvn_sp_settings['to_name'];
$telephone=$zendvn_sp_settings['telephone'];
$website=$zendvn_sp_settings['website'];
$opened_time=$zendvn_sp_settings['opened_time'];
$opened_date=$zendvn_sp_settings['opened_date'];
$contacted_name=$zendvn_sp_settings['contacted_name'];
$width=$zendvn_sp_settings["product_width"];    
$height=$zendvn_sp_settings["product_height"];      
$post_meta_key = "_zendvn_sp_post_";
$page_meta_key = "_zendvn_sp_page_";
$product_meta_key = "_zendvn_sp_zaproduct_";
if(!empty($instance['item_id'])){
	$arrItemID=explode(",",$instance["item_id"]);
	if(count($arrItemID) > 0){
		if($instance["status"]=='active'){		
			switch ($instance["position"]) {				
				case "featured-article-widget":

				$args = array(
					'post__in' => $arrItemID,
					'post_type' => 'page'
				);			 
				$query = new WP_Query($args);		
				if($query->have_posts()){
					$k=1;
                	$post_count=$query->post_count;
					while ($query->have_posts()) {
						$query->the_post();		
						$post_id=$query->post->ID;							
						$permalink=get_the_permalink($post_id);
						$title=get_the_title($post_id);
						$excerpt=get_post_meta($post_id,$page_meta_key."intro",true);
						$featureImg=wp_get_attachment_url(get_post_thumbnail_id($post_id));		   
						$featureImg=$vHtml->getFileName($featureImg);
						$featureImg=site_url('/wp-content/uploads/'.$featureImg ,null );  
						?>
						<div class="relative amazon">
							<h3 class="featured-title"><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></h3>
							<div class="margin-top-15"><?php echo $excerpt; ?></div>
							<div class="featured-img-absolute"><img src="<?php echo $featureImg; ?>" /></div>							
						</div>														
						<?php						
					}
					wp_reset_postdata();  
				}
				break;				
				case "hot-news-widget":					
				$args = array(
					'post__in' => $arrItemID,
					'post_type' => 'post'
				);			 
				$query = new WP_Query($args);		
				if($query->have_posts()){
					$k=1;
                	$post_count=$query->post_count;
					while ($query->have_posts()) {
						$query->the_post();		
						$post_id=$query->post->ID;							
						$permalink=get_the_permalink($post_id);
						$title=get_the_title($post_id);
						$excerpt=get_post_meta($post_id,$post_meta_key."intro",true);
						$featureImg=wp_get_attachment_url(get_post_thumbnail_id($post_id));		   
						$featureImg=$vHtml->getFileName($featureImg);
						$featureImg=site_url('/wp-content/uploads/'.$featureImg ,null );  
						?>
						<div class="col-lg-3">
							<div class="relative">
								<a href="<?php echo $permalink; ?>"><img src="<?php echo $featureImg; ?>" /></a>
								<div class="hot-news-title">
									
								</div>
							</div>
						</div>																	
						<?php
						if($k%4 ==0 || $k==$post_count){
							echo '<div class="clr"></div>';
						}
						$k++;
					}
					wp_reset_postdata();  
				}
				break;						
				case "partner-widget":	
				?>					
				<script type="text/javascript" language="javascript">
					jQuery(document).ready(function(){
						jQuery(".owl-carousel-partner").owlCarousel({
							autoplay:false,                    
							loop:true,
							margin:10,                        
							nav:true,                                            
							responsiveClass:true,
							responsive:{
								0:{
									items:1,
									nav:true
								},
								600:{
									items:6,
									nav:false
								},
								1000:{
									items:6,
									nav:true,
									loop:false
								}
							}
						})
					});                
				</script>
				<div class="margin-top-15 gechome">
					<section class="slider">
						<div class="owl-carousel owl-carousel-partner owl-theme">
							<?php
							$args = array(
								'post__in' => $arrItemID,
								'post_type' => 'post'
							);			 
							$query = new WP_Query($args);							
							if($query->have_posts()){
								while ($query->have_posts()) {
									$query->the_post();		
									$post_id=$query->post->ID;							
									$permalink=get_the_permalink($post_id);
									$title=get_the_title($post_id);
									$excerpt=get_post_meta($post_id,$post_meta_key."intro",true);
									$featureImg=wp_get_attachment_url(get_post_thumbnail_id($post_id));
									$featureImg=$vHtml->getFileName($featureImg);									
									$featureImg=site_url( '/wp-content/uploads/'.$featureImg, null ) ; 								
									?>
									<div class="items">
										<div><center><a href="<?php echo $permalink; ?>"><img src="<?php echo $featureImg; ?>" /></a></center></div>                 
									</div>   
									<?php
								}
								wp_reset_postdata();  
							}
							?>														
						</div>
					</section>
				</div>    				
				<?php		
				break;			
						
			case "sale-product-widget":	
			?>					
			<section class="slider">
				<div class="owl-carousel owl-carousel-product-sale-featured owl-theme">
					<?php
					$args = array(
						'post__in' => $arrItemID,
						'post_type' => 'zaproduct'
					);			 
					$query = new WP_Query($args);		
					if($query->have_posts()){
						while ($query->have_posts()) {
							$query->the_post();		
							$post_id=$query->post->ID;							
							$permalink=get_the_permalink($post_id);
							$title=get_the_title($post_id);
							$excerpt=get_post_meta($post_id,$product_meta_key."intro",true);
							$featureImg=wp_get_attachment_url(get_post_thumbnail_id($post_id));
		                    $featureImg=$vHtml->getFileName($featureImg);
		                    $featureImg=$width.'x'.$height.'-'.$featureImg;                    
		                    $featureImg=site_url( '/wp-content/uploads/'.$featureImg, null ) ; 
		                    $price=get_post_meta( $post_id, $product_meta_key . 'price', true );
		                    $sale_price=get_post_meta( $post_id, $product_meta_key . 'sale_price', true );        
		                    if(empty($price)){
		                    	$price='Liên hệ';
		                    }else{
		                    	$price ='<span class="price-regular">'.$vHtml->fnPrice($price).' đ</span>';
		                    }
		                    if(empty($sale_price)){
		                    	$sale_price='Liên hệ';
		                    }else{
		                    	$sale_price=$vHtml->fnPrice($sale_price) . ' đ';
		                    }
							?>
							<div class="items">
								<div class="box-product">
									<div class="product-img"><center><figure><a href="<?php echo $permalink; ?>"><img src="<?php echo $featureImg; ?>" alt="" /></a></figure></center></div>									
									<div class="box-product-title"><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></div>
									<div class="box-product-general-price">
										<div class="box-product-price">
											<div class="col-lg-6 no-padding"><center><span class="sale-price"><?php echo $price; ?></span></center></div>
											<div class="col-lg-6"><center><span class="first-price"><?php echo $sale_price; ?></span></center></div>
											<div class="clr"></div>
										</div>                                
									</div>
									<div class="box-product-general-button">
										<div class="box-product-button">
											<div class="col-lg-8 no-padding"><a href="javascript:void(0)" data-toggle="modal" data-target="#modal-alert-add-cart" onclick="addToCart(<?php echo $post_id; ?>);" class="add-cart">Thêm vào giỏ hàng</a></div>
											<div class="col-lg-4"><a href="<?php echo $permalink; ?>" class="add-cart"><i class="fa fa-search-plus" aria-hidden="true"></i></a></div>
											<div class="clr"></div>
										</div>                                
									</div>                            
								</div>                        
							</div>   
							<?php
						}
						wp_reset_postdata();  
					}
					?>														
				</div>
			</section>
			<?php		
			break;	
			case "featured-product-widget":	
			?>		
			<section class="slider">
				<div class="owl-carousel owl-carousel-product-sale-featured owl-theme">
					<?php
					$args = array(
						'post__in' => $arrItemID,
						'post_type' => 'zaproduct'
					);			 
					$query = new WP_Query($args);		
					if($query->have_posts()){
						while ($query->have_posts()) {
							$query->the_post();		
							$post_id=$query->post->ID;							
							$permalink=get_the_permalink($post_id);
							$title=get_the_title($post_id);
							$excerpt=get_post_meta($post_id,$product_meta_key."intro",true);
							$featureImg=wp_get_attachment_url(get_post_thumbnail_id($post_id));
		                    $featureImg=$vHtml->getFileName($featureImg);
		                    $featureImg=$width.'x'.$height.'-'.$featureImg;                    
		                    $featureImg=site_url( '/wp-content/uploads/'.$featureImg, null ) ; 
		                    $price=get_post_meta( $post_id, $product_meta_key . 'price', true );
		                    $sale_price=get_post_meta( $post_id, $product_meta_key . 'sale_price', true );        
		                    if(empty($price)){
		                    	$price='Liên hệ';
		                    }else{
		                    	$price ='<span class="price-regular">'.$vHtml->fnPrice($price).' đ</span>';
		                    }
		                    if(empty($sale_price)){
		                    	$sale_price='Liên hệ';
		                    }else{
		                    	$sale_price=$vHtml->fnPrice($sale_price) . ' đ';
		                    }
							?>
							<div class="items">
								<div class="box-product">
									<div class="product-img"><center><figure><a href="<?php echo $permalink; ?>"><img src="<?php echo $featureImg; ?>" alt="" /></a></figure></center></div>									
									<div class="box-product-title"><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></div>
									<div class="box-product-general-price">
										<div class="box-product-price">
											<div class="col-lg-6 no-padding"><center><span class="sale-price"><?php echo $price; ?></span></center></div>
											<div class="col-lg-6"><center><span class="first-price"><?php echo $sale_price; ?></span></center></div>
											<div class="clr"></div>
										</div>                                   
									</div>
									<div class="box-product-general-button">
										<div class="box-product-button">
											<div class="col-lg-8 no-padding"><a href="javascript:void(0)" data-toggle="modal" data-target="#modal-alert-add-cart" onclick="addToCart(<?php echo $post_id; ?>);" class="add-cart">Thêm vào giỏ hàng</a></div>
											<div class="col-lg-4"><a href="<?php echo $permalink; ?>" class="add-cart"><i class="fa fa-search-plus" aria-hidden="true"></i></a></div>
											<div class="clr"></div>
										</div>                                
									</div>                            
								</div>                        
							</div>   
							<?php
						}
						wp_reset_postdata();  
					}
					?>														
				</div>
			</section>
			<?php		
			break;			
			case "rau-sach-widget":		
			echo '<div class="product-sale-shop">';		
			$args = array(
				'post__in' => $arrItemID,
				'post_type' => 'zaproduct'
			);					
			$query = new WP_Query($args);		
			if($query->have_posts()){
				$k=1;
                $post_count=$query->post_count;
				while ($query->have_posts()) {
					$query->the_post();		
					$post_id=$query->post->ID;							
					$permalink=get_the_permalink($post_id);
					$title=get_the_title($post_id);
					$excerpt=get_post_meta($post_id,$product_meta_key."intro",true);
					$featureImg=wp_get_attachment_url(get_post_thumbnail_id($post_id));
					$featureImg=$vHtml->getFileName($featureImg);
					$featureImg=$width.'x'.$height.'-'.$featureImg;                    
					$featureImg=site_url( '/wp-content/uploads/'.$featureImg, null ) ; 
					$price=get_post_meta( $post_id, $product_meta_key . 'price', true );
					$sale_price=get_post_meta( $post_id, $product_meta_key . 'sale_price', true );        
					$str_price='';
					$sale_price_des='';
					$regular_price='';
					if(!empty($price)){						
						$sale_price_des=$vHtml->fnPrice($price);								
					}
					if(!empty($sale_price)){				
						$regular_price ='<span class="price-regular">'.$vHtml->fnPrice($price).' đ</span>';										
						$sale_price_des=$vHtml->fnPrice($sale_price);						
					}
					$sale_price_des='<span class="price-sale">'.$sale_price_des. ' đ'.'</span>' ;					
					$str_price=$regular_price . '&nbsp;&nbsp;' . $sale_price_des ;
					?>
					<div class="col-lg-3 no-padding-right">
						<div class="box-product">
							<div class="product-img"><center><figure><a href="<?php echo $permalink; ?>"><img src="<?php echo $featureImg; ?>" alt="" /></a></figure></center>
								<div class="box-product-add-to-cart">
									<div class="them-vao-gio-hang">
									<a href="javascript:void(0)" data-toggle="modal" data-target="#modal-alert-add-cart" onclick="addToCart(<?php echo $post_id; ?>);" ><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Thêm vào giỏ</a>									
									</div>
								</div>								
							</div>								
							<div class="box-product-title"><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></div>
							<div class="box-product-star">								
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>								
							</div>
							<div class="box-product-general-price margin-top-5">
								<center><?php echo $str_price; ?></center>								                    
							</div>							                     
						</div>           
					</div>					             				
					<?php
					if($k%4 ==0 || $k==$post_count){
						echo '<div class="clr"></div>';
					}
					$k++;
				}
				wp_reset_postdata();  
			}	
			echo '</div>';			
			break;													
			case "customer-widget":		
			?>
			<div class="twitter">
				<div class="container">
					<script type="text/javascript" language="javascript">
						jQuery(document).ready(function(){
							jQuery(".owl-carousel-customer").owlCarousel({
								autoplay:false,                    
								loop:true,
								margin:10,                        
								nav:true,                                            
								responsiveClass:true,
								responsive:{
									0:{
										items:1,
										nav:true
									},
									600:{
										items:1,
										nav:false
									},
									1000:{
										items:1,
										nav:true,
										loop:false
									}
								}
							})
						});                
					</script>
					<div class="owl-carousel owl-carousel-customer owl-theme">
						<?php 
						$args = array(
							'post__in' => $arrItemID,
							'post_type' => 'post'
						);			 
						$query = new WP_Query($args);							
						if($query->have_posts()){
							while ($query->have_posts()) {
								$query->the_post();		
								$post_id=$query->post->ID;							
								$permalink=get_the_permalink($post_id);
								$title=get_the_title($post_id);
								$excerpt=get_post_meta($post_id,$post_meta_key."intro",true);
								$content=get_the_content($post_id);        
								$featureImg=wp_get_attachment_url(get_post_thumbnail_id($post_id));
								$featureImg=$vHtml->getFileName($featureImg);									
								$featureImg=site_url( '/wp-content/uploads/'.$featureImg, null ) ; 								
								?>
								<div class="user-info-blog-comment">
									<div class="user-comment-info">
										<div class="col-xs-4 no-padding"><img src="<?php echo $featureImg; ?>" /></div>
										<div class="col-xs-8 no-padding-right">
											<div><?php echo $title; ?></div>
											<div><?php echo $excerpt; ?></div>
										</div>
										<div class="clr"></div>
									</div>
									<div class="comment margin-top-15">
										
					<?php echo $content; ?>
				
									</div>
								</div> 
								<?php
							}
							wp_reset_postdata();  
						}				
						?>
					</div>
				</div>				
			</div>			
			<?php					
			break;			
			case 'category-article-widget':
			$args = array(
				'post__in' => $arrItemID,
				'post_type' => 'post'
			);			 
			$query = new WP_Query($args);		
			if($query->have_posts()){
				while ($query->have_posts()) {
					$query->the_post();		
					$post_id=$query->post->ID;							
					$permalink=get_the_permalink($post_id);
					$title=get_the_title($post_id);
					$excerpt=get_post_meta($post_id,$product_meta_key."intro",true);
					$featureImg=wp_get_attachment_url(get_post_thumbnail_id($post_id));
					$featureImg=$vHtml->getFileName($featureImg);					
					$featureImg=site_url( '/wp-content/uploads/'.$featureImg, null ) ; 					
					?>
					<div class="product-index">
						<div class="col-lg-4 no-padding">
							<center><figure><a href="<?php echo $permalink; ?>"><img src="<?php echo $featureImg; ?>" /></a></figure></center>
						</div>
						<div class="col-lg-8 no-padding-right">
							<div class="margin-top-15"><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></div>							
						</div>
						<div class="clr"></div>
					</div>      
					<?php
				}
				wp_reset_postdata();  
			}			
			break;	
			case 'category-product-widget':
			$args = array(
				'post__in' => $arrItemID,
				'post_type' => 'zaproduct'
			);			 
			$query = new WP_Query($args);		
			if($query->have_posts()){
				while ($query->have_posts()) {
					$query->the_post();		
					$post_id=$query->post->ID;							
					$permalink=get_the_permalink($post_id);
					$title=get_the_title($post_id);
					$excerpt=get_post_meta($post_id,$product_meta_key."intro",true);
					$featureImg=wp_get_attachment_url(get_post_thumbnail_id($post_id));
					$featureImg=$vHtml->getFileName($featureImg);
					$featureImg=$width.'x'.$height.'-'.$featureImg;                    
					$featureImg=site_url( '/wp-content/uploads/'.$featureImg, null ) ; 
					$price=get_post_meta( $post_id, $product_meta_key . 'price', true );
					$sale_price=get_post_meta( $post_id, $product_meta_key . 'sale_price', true );        
					if(empty($price)){
						$price='Liên hệ';
					}else{
						$price ='<span class="price-regular">'.$vHtml->fnPrice($price).' đ</span>';
					}
					if(empty($sale_price)){
						$sale_price='Liên hệ';
					}else{
						$sale_price=$vHtml->fnPrice($sale_price) . ' đ';
					}
					?>
					<div class="product-index">
						<div class="col-lg-4 no-padding">
							<center><figure><a href="<?php echo $permalink; ?>"><img src="<?php echo $featureImg; ?>" /></a></figure></center>
						</div>
						<div class="col-lg-8 no-padding-right">
							<div class="margin-top-15"><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></div>
							<div class="product-index-status"><?php echo $sale_price; ?></div>
						</div>
						<div class="clr"></div>
					</div>       
					<?php
				}
				wp_reset_postdata();  
			}			
			break;	
			case "thiet-bi-ve-sinh-widget":		
			case "chung-cu-widget":					
			case "biet-thu-widget":					
			case "khach-san-widget":					
			case "nha-lien-ke-widget":					
			case "nha-pho-widget":					
			case "van-phong-widget":					
			case "phong-khach-widget":					
			case "phong-ngu-widget":					
			case "phong-bep-widget":					
			case "phong-an-widget":					
			case "phong-tre-em-widget":		
			case "thiet-ke-noi-that-phong-widget":
			case "thi-cong-noi-that-widget":
			case "kien-thuc-nha-dep-widget":						
			?>
			<script type="text/javascript" language="javascript">
				jQuery(document).ready(function(){
					jQuery(".owl-carousel-equipment").owlCarousel({
						autoplay:false,                    
						loop:true,
						margin:0,                        
						nav:true,                                            
						responsiveClass:true,
						responsive:{
							0:{
								items:1,
								nav:true
							},
							600:{
								items:1,
								nav:false
							},
							1000:{
								items:4,
								nav:true,
								loop:false
							}
						}
					})
				});                
			</script>
			<div class="owl-carousel owl-carousel-equipment owl-theme">
			<?php			
			$args = array(
				'post__in' => $arrItemID,
				'post_type' => 'post'
			);					
			$query = new WP_Query($args);		
			if($query->have_posts()){
				$k=1;
                $post_count=$query->post_count;
				while ($query->have_posts()) {
					$query->the_post();		
					$post_id=$query->post->ID;							
					$permalink=get_the_permalink($post_id);
					$title=get_the_title($post_id);			
					$excerpt=get_post_meta($post_id,$post_meta_key."intro",true);		
					$featureImg=wp_get_attachment_url(get_post_thumbnail_id($post_id));
					$featureImg=$vHtml->getFileName($featureImg);					
					$featureImg=site_url( '/wp-content/uploads/'.$featureImg, null ) ; 					
					?>
					
					<div class="box-product">
						<div class="product-img"><center><figure><a href="<?php echo $permalink; ?>"><img src="<?php echo $featureImg; ?>" alt="" /></a></figure></center>

						</div>									
						<div class="box-product-title margin-top-15"><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></div>				
						<div class="margin-top-5 excerpt"><?php echo substr($excerpt, 0,100).'...'; ?></div>
						<div class="readmore-left margin-top-5"><a href="<?php echo $permalink; ?>">Xem thêm...</a><div class="clr"></div></div>
					</div>           
									             				
					<?php					
				}
				wp_reset_postdata();  
			}	
			?>
			</div>
			<?php	
			break;	
		}
	}
}	
}
?>






