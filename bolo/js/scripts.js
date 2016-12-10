(function ($, root, undefined) {
	
	$(function () {
		
		'use strict';
		function anim_isotope()
		{
			// isotope
			$('.filter_name .my_btn').on('click', function()
			{
				$('.filter_name .my_btn').removeClass('active');
				$(this).addClass('active');
			});
			$('.gird').isotope({
				itemSelector: '.grid-item',
	  			layoutMode: 'fitRows'
			});
			$('.filter_name > li').on('click', function(){
				var cat = '.' + $(this).text();
				$('.grid').isotope({ filter: ((cat == '.all') ? '*' : cat)});
			});
			
		}
		if($('.homepage').length || $("#page_portfolio").length)
		{
			// isotope
			anim_isotope();
		}
		// Home page only
		if($('.homepage').length)
		{
			// map
			$('.close').on('click', function()
			{
				$(this).parent().css('display', 'none');
				$('.carousel-inner').css('display', 'none');
			})
		}
	});

})(jQuery, this);
