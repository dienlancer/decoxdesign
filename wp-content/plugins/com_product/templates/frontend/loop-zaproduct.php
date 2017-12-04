<div class="page-right padding-bottom-15">
    <?php 
    $meta_key = "_zendvn_sp_zaproduct_";                   
    global $zController,$zendvn_sp_settings;    
    $vHtml=new HtmlControl();    
    /* begin load config contact */
    $width=$zendvn_sp_settings["product_width"];    
    $height=$zendvn_sp_settings["product_height"];    
    $width_thumbnail=$width/5;
    $height_thumbnail=$height/5;  
    $contacted_phone=$zendvn_sp_settings['contacted_phone'];
    $email_to=$zendvn_sp_settings['email_to'];
    $address=$zendvn_sp_settings['address'];
    $to_name=$zendvn_sp_settings['to_name'];
    $telephone=$zendvn_sp_settings['telephone'];
    $website=$zendvn_sp_settings['website'];
    $opened_time=$zendvn_sp_settings['opened_time'];
    $opened_date=$zendvn_sp_settings['opened_date'];
    $contaced_name=$zendvn_sp_settings['contacted_name'];
    $product_number=$zendvn_sp_settings["product_number"];
    /* end load config contact */
    $term_slug='';
    $the_query=$wp_query;
    $post_id=0;
    if($the_query->have_posts()){
        while ($the_query->have_posts()) {
            $the_query->the_post();                            
            $post_id=$the_query->post->ID;                                             
            $permalink=get_the_permalink($post_id);                    
            $title=get_the_title($post_id);                    
            $excerpt='';
            $excerpt=get_post_meta($post_id,$meta_key."intro",true);   
            $excerpt=substr($excerpt, 0,250) . '...';                 
            $content=get_the_content($post_id);        
            $arrPicture=array();
            $featureImg=wp_get_attachment_url(get_post_thumbnail_id($post_id));        
            $featureImg=$vHtml->getFileName($featureImg);
            $product_image=$featureImg;
            $small_img=$width.'x'.$height.'-'.$featureImg;                    
            $small_img=site_url( '/wp-content/uploads/'.$small_img, null ) ; 
            $large_img=site_url( '/wp-content/uploads/'.$featureImg, null ) ; 
            $term = wp_get_object_terms( $post_id,  'za_category' );                    
            $term_name=$term[0]->name;
            $term_slug=$term[0]->slug;
            $product_code=get_post_meta( $post_id,$meta_key.'product_code', true );
            $intro=get_post_meta( $post_id, $meta_key . 'intro', true );
            $price=get_post_meta( $post_id, $meta_key . 'price', true );            
            $sale_price=get_post_meta( $post_id, $meta_key . 'sale_price', true );                
            if(!empty($price)){
                $product_price=$price;    
                $price =$vHtml->fnPrice($price);
            }
            else{
                $price =0;
            }
            if(!empty($sale_price)){
                $product_price=$sale_price;    
                $sale_price =$vHtml->fnPrice($sale_price);        
            }
            else{
                $sale_price =0;        
            }
            $arrPicture = get_post_meta($post_id, $meta_key . 'img-url', true);
            $arrPicture[]=$large_img;         
            $count_view_post=get_post_meta( $post_id, $meta_key . 'count_view_post', true );           
            $count  =   0;
            $count  =   (int)$count_view_post;                
            $count++;        
            update_post_meta($post_id, $meta_key . 'count_view_post', $count);
            ?>
            <h3 class="page-title h-title"><?php echo $title; ?></h3>
            <div class="box-product-detail">                
                <?php echo $content; ?>
            </div>            
            <?php
        }
        wp_reset_postdata();  
    }
    ?>  
</div>
