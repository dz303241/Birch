jQuery(document).ready(function($) {
	$blocks = $(".posts");
	$blocks.imagesLoaded(function(){
		$blocks.masonry({
			itemSelector: '.post-container'
		});
		$(".post-container").fadeIn();
	});
	$(document).ready( function() { setTimeout( function() { $blocks.masonry(); }, 500); });
	$(window).resize(function () {
		$blocks.masonry();
	});

	$(".nav-toggle").on("click", function(){
		$(this).toggleClass("active");
		$(".nav").slideToggle();
	});

	$(window).resize(function() {
		if ($(window).width() > 1000) {
			$(".nav-toggle").removeClass("active");
			$(".nav").hide();
		}
	});

});
