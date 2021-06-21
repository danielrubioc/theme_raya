var page = 2;
jQuery(function($){
	$('.misha_loadmore').click(function(){ 
		var button = $(this),
		    data = {
			'action': 'loadmore',
			'query': misha_loadmore_params.posts, // that's how we get params from wp_localize_script() function
			'page' : misha_loadmore_params.current_page
		}; 
		$.ajax({
			url : misha_loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Cargando...'); // change the button text, you can also add a preloader image
			},
			success : function( data ){ 
				if( data ) { 
                    $('.row-posts').find(".col-md-6:last").after(data);
                    button.text( 'Cargar más notas' ).prev();
					//button.text( 'More posts' ).prev().before(data); // insert new posts 
					misha_loadmore_params.current_page++; 
					if ( misha_loadmore_params.current_page == misha_loadmore_params.max_page ) 
						button.remove(); // if last page, remove the button
  
				} else {
					button.remove(); // if no data, remove the button as well
				}
			}
		});
	});

	$(function() {
		var path = window.location.href;  
		$('.nav-link').each(function() { 
			if (this.href === path) {
				$(this).addClass('active');
			}
	   });
	});
	  
});

