/**	
	* Template Name: Intensely
	* Version: 1.0	
	* Template Scripts
	* Author: MarkUps
	* Author URI: http://www.markups.io/

	Custom JS
	
	1. SEARCH BOX SLIDE
	2. HOVER DROPDOWN MENU
	3. BOOTSTRAP ACCORDION
	4. SKILL PROGRESS BAR
	5. MIXIT SLIDER
	6. FANCYBOX
	7. MAIN SLIDER (SLICK SLIDER)
	8. LOGIN MODAL WINDOW
	9. COUNTER
	10. TESTIMONIAL SLIDER (SLICK SLIDER)
	11. CLIENTS BRAND SLIDER (SLICK SLIDER) 
	12. SCROLL TOP BUTTON
	13. PRELOADER 
	14. WOW ANIMATION	
	
**/

jQuery(function($){

	/* ----------------------------------------------------------- */
	/*  1. SEARCH BOX SLIDE
	/* ----------------------------------------------------------- */ 

	jQuery('#search-icon').click(function(e){
		e.preventDefault();
     	jQuery('.header-top').slideToggle(500);     
  	});
	
			
	/* ----------------------------------------------------------- */
	/*  2. HOVER DROPDOWN MENU
	/* ----------------------------------------------------------- */ 
	
	// for hover dropdown menu
  	jQuery('ul.nav li.dropdown').hover(function() {
      jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(200);
    }, function() {
      jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(200);
    });

  	/* ----------------------------------------------------------- */
	/*  3. BOOTSTRAP ACCORDION
	/* ----------------------------------------------------------- */ 
	
	jQuery('#accordion .panel-collapse').on('shown.bs.collapse', function () {
	jQuery(this).prev().find(".fa").removeClass("fa-plus-square").addClass("fa-minus-square");
	});
	
	//The reverse of the above on hidden event:
	
	jQuery('#accordion .panel-collapse').on('hidden.bs.collapse', function () {
	jQuery(this).prev().find(".fa").removeClass("fa-minus-square").addClass("fa-plus-square");
	});	

	/* ----------------------------------------------------------- */
	/*  4. SKILL PROGRESS BAR
	/* ----------------------------------------------------------- */ 

	jQuery('.progress .progress-bar').progressbar({
		display_text: 'center', percent_format: function(p) {return p + ' %';}});

	/* ----------------------------------------------------------- */
	/*  5. MIXIT SLIDER
	/* ----------------------------------------------------------- */  	

	jQuery(function(){
	    jQuery('#mixit-container').mixItUp();
	});
		
	/* ----------------------------------------------------------- */
	/*  6. FANCYBOX 
	/* ----------------------------------------------------------- */

	jQuery(document).ready(function() {
		jQuery(".fancybox").fancybox();
	});	 

	/* ----------------------------------------------------------- */
	/*  7. MAIN SLIDER (SLICK SLIDER)
	/* ----------------------------------------------------------- */
    
	jQuery('.main-slider').slick({
		dots: true,
		infinite: true,
		speed: 1000,
		delay:1000,
		autoplay: true,
		accessibility: false,
		fade: true,
 		//onmouseover: stop,
 		cssEase: 'linear'
		
	});

	/* ----------------------------------------------------------- */
	/*  8. LOGIN MODAL WINDOW
	/* ----------------------------------------------------------- */

	jQuery("#signup-btn").on('click', function(e){
		jQuery('#signup-content').show();
		jQuery('#login-content').hide();
		e.preventDefault();		
	});

	jQuery("#login-btn").on('click', function(e){
		jQuery('#login-content').show();
		jQuery('#signup-content').hide();
		e.preventDefault();
				
	});

	/* ----------------------------------------------------------- */
	/*  9. COUNTER
	/* ----------------------------------------------------------- */ 

	  jQuery('.counter').counterUp({
            delay: 10,
            time: 1000
        });

	/* ----------------------------------------------------------- */
	/*  10. TESTIMONIAL SLIDER (SLICK SLIDER)
	/* ----------------------------------------------------------- */   

	jQuery('.testimonial-slider').slick({
		dots: true,
		infinite: true,
		speed: 500,
		autoplay: true,		
		cssEase: 'linear'
	});


	/* ----------------------------------------------------------- */
	/*  11. CLIENTS BRAND SLIDER (SLICK SLIDER)
	/* ----------------------------------------------------------- */   

	jQuery('.clients-brand-slide').slick({
	  dots: false,
	  infinite: false,
	  speed: 300,
	  slidesToShow: 4,
	  slidesToScroll: 4,
	  autoplay: true,	
	  responsive: [
	    {
	      breakpoint: 1024,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 3,
	        infinite: true,
	        dots: true
	      }
	    },
	    {
	      breakpoint: 600,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 2
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	    // You can unslick at a given breakpoint now by adding:
	    // settings: "unslick"
	    // instead of a settings object
	  ]
	});

	/* ----------------------------------------------------------- */
	/*  12. SCROLL TOP BUTTON
	/* ----------------------------------------------------------- */

	//Check to see if the window is top if not then display button

	jQuery(window).scroll(function(){
	    if (jQuery(this).scrollTop() > 300) {
	      jQuery('.scrollToTop').fadeIn();
	    } else {
	      jQuery('.scrollToTop').fadeOut();
	    }
	});	   
	   
	//Click event to scroll to top

	jQuery('.scrollToTop').click(function(){
	    jQuery('html, body').animate({scrollTop : 0},800);
	    return false;
	});

	/* ----------------------------------------------------------- */
	/*  13. PRELOADER 
	/* ----------------------------------------------------------- */ 
	
	jQuery(window).load(function() { // makes sure the whole site is loaded
      jQuery('#status').fadeOut(); // will first fade out the loading animation
      jQuery('#preloader').delay(100).fadeOut('slow'); // will fade out the white DIV that covers the website.
      jQuery('body').delay(100).css({'overflow':'visible'});
    })

   
	/* ----------------------------------------------------------- */
	/*  14. WOW ANIMATION
	/* ----------------------------------------------------------- */ 

	wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        live:         true,
        callback:     function(box) {
          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init(); 
	
});