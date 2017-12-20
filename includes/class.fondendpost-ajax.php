<?php

/**
 * All public facing functions
 */

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * @package IM_Fontend_Post
 * @subpackage IM_Fontend_Post_Ajax
 * @author Al Imran Akash <alimranakash.bd@gmail.com>
 */
if( ! class_exists( 'IM_Fontend_Post_Ajax' ) ) :

class IM_Fontend_Post_Ajax {

    public function im_fontend_post() {
        $post_title         = $_POST[ 'post_title' ];
        $post_cat           = $_POST[ 'post_cat' ];
        $post_desc          = $_POST[ 'post_desc' ];
        $post_type          = $_POST[ 'post_type' ];
        $post_status        = $_POST[ 'post_status' ];

        $cat_id = get_cat_ID( $post_cat );
        if( $cat_id == 0 ) {
            $cat_name = array( 'cat_name' => $post_cat );
            wp_insert_category( $cat_name );
        }
        $post_arr = array(
            'post_title'    => $post_title,
            'post_content'  => $post_desc,
            'post_type'     => $post_type,
            'post_status'   => $post_status,
            'post_author'   => get_current_user_id(),
            'tax_input'     => array(
                'category'     => $cat,
            ),
        );
        $post_id = wp_insert_post( $post_arr );
        wp_set_post_terms( $post_id, array( $cat_id), 'category' );

        wp_die( 'Success Post' );
    }  
}

endif;