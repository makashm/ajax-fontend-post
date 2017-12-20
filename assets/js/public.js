$ = new jQuery.noConflict();

$( document ).ready(function() {

    // select2
    $('.post_status').select2({
        placeholder: "Select a Post Status",
        allowClear: true
    });
    // select2
    $('.post_type').select2({
        placeholder: "Select a Post Type",
        allowClear: true
    });

    // fontend_ajax_form
    $( '#fontend_ajax_form' ).submit( function( e ){
    	e.preventDefault();
    	var post_title 		= $( '#post_title' ).val()
    	var post_cat		= $( '#post_cat' ).val()
    	var post_desc 		= $( '#post_desc' ).val()
    	var post_type 		= $( '#post_type' ).val()
    	var post_status 	= $( '#post_status' ).val()

    	$.ajax({
    		type: 'POST',
    		url: ajaxurl,
    		data: {
    			action: 'im_fontend_post',
    			post_title: 	post_title,
    			post_cat: 		post_cat,
    			post_desc: 		post_desc,
    			post_type: 		post_type,
                post_status:    post_status,
    		},
    		success: function( data ){
    			alert( data )
    		},
    		error: function(){
    			alert('error')
    		}
    	})
    } )
});