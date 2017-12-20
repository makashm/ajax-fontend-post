<?php 

if( ! function_exists( 'pri' ) ) :
function pri( $data ) {
    echo '<pre>';
    if( is_object( $data ) || is_array( $data ) ) {
        print_r( $data );
    }
    else {
        var_dump( $data );
    }
    echo '</pre>';
}
endif;

if( ! function_exists( 'im_get_template' ) ) :
function im_get_template( $file_name ) {
	ob_start();
	include_once dirname( IMFILE ) . "/templates/{$file_name}.php";
	$content = ob_get_contents();
	ob_clean();

	return $content;
}

endif;

/**
 * Function to get option value
 *
 * @param string $section 'option_name' key of wp_options table
 * @param string $field field name; array key of $section value
 * @param mix $default the default value
 * @return mix $value option value
 */
if( ! function_exists( 'wpp_get_option' ) ) :
function wpp_get_option( $section, $field = null, $default = null ) {
    $section = get_option( $section );
    
    // if no $field is given, return whole array
    if( is_null( $field ) ) {
        return $section;
    }

    $value = isset( $section[ $field ] ) ? $section[ $field ] : $default;
    return $value;
}
endif;