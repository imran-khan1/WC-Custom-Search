<?php
/*
Plugin Name: WC Custom Search
Plugin URI: http://imran1.com
Description: WooCommerce Custom Search Form
Version: 1.0.0
Author: Imran Khan
Author URI: http://imran1.com
*/


/**
 *  Save custom attributes as post's meta data as well so that we can use in sorting and searching
 */
 
        add_action( 'save_post', 'save_woocommerce_attr_to_meta' );
        function save_woocommerce_attr_to_meta( $post_id ) {
            echo $_REQUEST['attribute_names'];
                // Get the attribute_names .. For each element get the index and the name of the attribute
                // Then use the index to get the corresponding submitted value from the attribute_values array.
          
 
    foreach( $_REQUEST['attribute_names'] as $index => $value ) {
                update_post_meta( $post_id, $value, $_REQUEST['attribute_values'][$index] );
            
        }
}
/************ End of Sorting ***************************/


/* WooCommerce Search */

//Disable woocommerce to redirect to single page
add_filter( 'woocommerce_redirect_single_search_result', '__return_false' );


add_action( 'pre_get_posts', 'advanced_search_query' );
function advanced_search_query( $query ) {
    
    
  

    if ( isset( $_REQUEST['search'] ) && $_REQUEST['search'] == 'advanced' && ! is_admin() && $query->is_search && $query->is_main_query() ) {

               
                 //posts table queries
                 $query->set('posts_per_page', 2);
                 $query->set( 'post_type', 'product' );
                 $query->set( 'post_status', 'publish' );
            
    
         
        //post meta table queries
        if($_REQUEST['pa_color'] !="")
        {
                            $color = array(
                                'key'     => 'pa_color', // assumed your meta_key is 'car_model'
                                'value' => ':"'.$_REQUEST['pa_color'].'";', // finds models that matches 'model' from the select field\
                                'compare' => 'like'
                            );
        }
        
        if($_REQUEST['pa_size'] !="")
        {                    
                         $size = array(
                                'key'     => 'pa_size', // assumed your meta_key is 'car_model'
                                'value' => ':"'.$_REQUEST['pa_size'].'";', // finds models that matches 'model' from the select field\
                                'compare' => 'like'
                            );
        }
                            
        $meta_query = array(
                            $color,
                            $size
                            
                        );   

               
        $query->set( 'meta_query', $meta_query );
        
        
        
        
        return $query;
        
      }
      
       
      
   
    }


add_action('template_include', 'advanced_search_template');
function advanced_search_template( $template ) {
  if ( isset( $_REQUEST['search'] ) && $_REQUEST['search'] == 'advanced' && is_search() ) {
     $t = locate_template('product-searchform.php');
     if ( ! empty($t) ) {
         $template = $t;
     }
  }
  return $template;
}