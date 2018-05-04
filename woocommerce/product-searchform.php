<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>"><?php esc_html_e( 'Search for:', 'woocommerce' ); ?></label>
	<input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Search products&hellip;', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    
   <br/><br/> <label for="model" class=""><?php _e( 'Select a Category: ', 'textdomain' ); ?></label>
    
    
 <?php  
 

 
         if(isset($_REQUEST['product_cat']) && !empty($_REQUEST['product_cat']))
          {  $optselect=$_REQUEST['product_cat']; }
         else{  $optselect=0;  }
  
         $args = array(
                    'show_option_all' => esc_html__( 'All Categories', 'woocommerce' ),
                    'hierarchical' => 1,
                    'class' => 'cat',
                    'echo' => 1,
                    'value_field' => 'slug',
                    'selected' => $optselect
                );
          $args['taxonomy'] = 'product_cat';
          $args['name'] = 'product_cat';              
          $args['class'] = 'cate-dropdown hidden-xs';
          wp_dropdown_categories($args);
  ?>
  
  
  <br/><br/><label for="model" class=""><?php _e( 'Select a Color: ', 'textdomain' ); ?></label>
  
  <?php $categories = get_categories('taxonomy=pa_color');
 
  $select = "<select name='pa_color' id='pa_color' class='postform'>";
  $select.= "<option value=''>All Colors</option>";
 
 if(isset($_REQUEST['pa_color']) && !empty($_REQUEST['pa_color']))
          {  $opt_color =$_REQUEST['pa_color']; }
 
  foreach($categories as $category){
    if($category->count > 0){
           
        if($opt_color == $category->term_id ){$color_select = "selected";}
        else {$color_select = '';}
        
        $select.= "<option value='".$category->term_id ."' ".   $color_select . ">".$category->name."</option>";
    }
  }
 
  $select.= "</select>";
 
  echo $select;
  ?>
 </select>
 
 
 
 
 
  <br/><br/><label for="model" class=""><?php _e( 'Select a Size: ', 'textdomain' ); ?></label>
  
  <?php $categories = get_categories('taxonomy=pa_size');
 
  $select = "<select name='pa_size' id='pa_size' class='postform'>";
  $select.= "<option value=''>All Sizes</option>";
 
 if(isset($_REQUEST['pa_size']) && !empty($_REQUEST['pa_size']))
          {  $opt_size =$_REQUEST['pa_size']; }
 
  foreach($categories as $category){
    if($category->count > 0){
           
        if($opt_size == $category->term_id ){$size_select = "selected";}
        else {$size_select = '';}
        
        $select.= "<option value='".$category->term_id ."' ".   $size_select . ">".$category->name."</option>";
    }
  }
 
  $select.= "</select>";
 
  echo $select;
  ?>
 </select>
    
	<button type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>"><?php echo esc_html_x( 'Search', 'submit button', 'woocommerce' ); ?></button>
    <input type="hidden" name="search" value="advanced"/>
	<input type="hidden" name="post_type" value="product" />
    <input type="hidden" name="ps" value="ding" />
</form>
