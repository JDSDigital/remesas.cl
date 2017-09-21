/*jslint browser: true*/
/*global $, jQuery, Modernizr, google, _gat*/
/*jshint strict: true */



/*************** COLORS TO BE ERASED WHEN INSTALLING THE THEME ***********/

$(document).ready(function() {  

	"use strict";


	var $colorsHTML =
	'<div class="styleSwitcher">' +
	'<a href="#" id="showHideSwitcher"><i class="icon-cog"></i></a>' +
	'<div id="switcherContent">' +
	'<h1>style switcher</h1><ul class="switcher">' +
	'<li><a href="css/orange.css" style="background:#F86D18">Orange</a></li>' +
	'<li><a href="css/yellow.css" style="background:#FFCC00">Yellow</a></li>' +
	'<li><a href="css/sea-green.css" style="background:#3CB6B6">Sea green</a></li>' +
	'<li><a href="css/green.css" style="background:#A4C618">Green</a></li>' +
	'<li><a href="css/blue.css" style="background:#136597">Dark blue</a></li>' +
	'<li><a href="css/light.css" style="background:#44BCDD">Light blue</a></li>' +
	'<li><a href="css/pink.css" style="background:#F897F5">Pink</a></li>' +
	'<li><a href="css/coffee.css" style="background:#A38757">Coffee</a></li>' +
	'<li><a href="css/red.css" style="background:#E44832">Red</a></li>' +
	'<li><a href="css/dark.css" style="background:#555">Purple</a></li>' +
	'</ul>' + 
	'<a href="#" class="btnSwitcher full">Fullwidth</a>' +
	'<a href="#" class="btnSwitcher box">Boxed</a>' +
	'</div>' +

    /*'<ul class="switcher dark">' +
    '<li><a href="css/dark-orange.css" style="background:#F86D18">Dark Orange</a></li>' +
    '<li><a href="css/dark-yellow.css" style="background:#FFCC00">Dark Yellow</a></li>' +
    '<li><a href="css/dark-sea-green.css" style="background:#3CB6B6">Dark Sea green</a></li>' +
    '<li><a href="css/dark-green.css" style="background:#A4C618">Dark Green</a></li>' +
    '<li><a href="css/dark-blue.css" style="background:#136597">Dark Dark blue</a></li>' +
    '<li><a href="css/dark-light.css" style="background:#44BCDD">Dark Light blue</a></li>' +
    '<li><a href="css/dark-pink.css" style="background:#F897F5">Dark Pink</a></li>' +
    '<li><a href="css/dark-coffee.css" style="background:#A38757">Dark Coffee</a></li>' +
    '<li><a href="css/dark-red.css" style="background:#E44832">Dark Red</a></li>' +
    '<li><a href="css/dark-purple.css" style="background:#C44AD0">Dark Black &amp; white</a></li>' +			
    '</ul>' +*/

    '<div class="headerSwitcher">' +
    '<select name="header" class="header">' +
    '<option value="noselection">Select header</option>' +
    '<option value="">header style 1</option>' +
    '<option value="header1">header style 2</option>' +
    '<option value="header2">header style 3</option>' +
    '<option value="header3">header style 4</option>' +
    '<option value="header4">header style 5</option>' +
    '<option value="header5">header style 6</option>' +	
    '</select>' +
    '</div>' +

    '</div>'; 

    $("body").append($colorsHTML);  

    var s = document.createElement("script");
    s.type = "text/javascript";
    s.src = "js-plugin/jquery-cookie/jquery.cookie.js";
    $("body").append(s);  


    if($.cookie("css")) {
    	$("#colors").attr("href",$.cookie("css"));
    }

    if($.cookie("bodyStyle")) {
    	$("body").attr('id', $.cookie("bodyStyle"));
    }  

    if($.cookie("header")) {
    	$("body").attr('class', $.cookie("header"));
    }  


    $(".switcher li a").click(function() { 
    	$("#colors").attr("href",$(this).attr("href"));
    	$.cookie("css",$(this).attr("href"));
    	return false;
    });




    $('.styleSwitcher .btnSwitcher').click(function (e) {
    	var $id;
    	if($(this).hasClass('full')){
    		$id= '';
    	}else{

    		$id= 'boxedLayout';
    	}

    	$("body").attr('id', $id);

    	$.cookie("bodyStyle", $id);
    	e.preventDefault();
    });


    $(".header").change(function() { 

    	if( $(this).val() != 'noselection'){

    		$("body").attr('class', $(this).val());
    		$.cookie("header",$(this).val());
    	}

    });


    $('#showHideSwitcher').click(function(e) { 
    	if($('.styleSwitcher').css('left') === '-170px'){
    		$('.styleSwitcher').animate(
    			{'left':0},
    			300, 'easeOutQuart',function() {
                // stuff to do after animation is complete
            });

    	}else{
    		$('.styleSwitcher').animate(
    			{'left':-170},
    			300, 'easeInQuart',function() {
                // stuff to do after animation is complete
            });
    	}

    	e.preventDefault();
    });
});

/*************** COLORS TO BE ERASED WHEN INSTALLING THE THEME ***********/

/*************** GOOGLE ANALYTICS ***********/
/*************** REPLACE WITH YOUR OWN UA NUMBER ***********/
window.onload = function () { "use strict"; gaSSDSLoad(""); }; //load after page onload
/*************** REPLACE WITH YOUR OWN UA NUMBER ***********/




var isMobile = false;
var isDesktop = false;


$(window).on("load resize",function(e){

		initializeMainMenu();

		//mobile detection
		if(Modernizr.mq('only all and (max-width: 767px)') ) {
			isMobile = true;
		}else{
			isMobile = false;
		}


		//tablette and mobile detection
		if(Modernizr.mq('only all and (max-width: 1024px)') ) {
			isDesktop = false;
		}else{
			isDesktop = true;
		}
});



/*
|--------------------------------------------------------------------------
| DOCUMENT READY
|--------------------------------------------------------------------------
*/  
$(document).ready(function() {


	"use strict";



	if( $("ul#og-grid").length){
		Grid.init();
	};

	 /*
    |--------------------------------------------------------------------------
    |  form placeholder for IE
    |--------------------------------------------------------------------------
    */
    if(!Modernizr.input.placeholder){

    	$('[placeholder]').focus(function() {
    		var input = $(this);
    		if (input.val() == input.attr('placeholder')) {
    			input.val('');
    			input.removeClass('placeholder');
    		}
    	}).blur(function() {
    		var input = $(this);
    		if (input.val() == '' || input.val() == input.attr('placeholder')) {
    			input.addClass('placeholder');
    			input.val(input.attr('placeholder'));
    		}
    	}).blur();
    	$('[placeholder]').parents('form').submit(function() {
    		$(this).find('[placeholder]').each(function() {
    			var input = $(this);
    			if (input.val() == input.attr('placeholder')) {
    				input.val('');
    			}
    		})
    	});

    }	

    /*
    |--------------------------------------------------------------------------
    | MAGNIFIC POPUP
    |--------------------------------------------------------------------------
    */


    if( $("a.image-link").length){

    	$("a.image-link").click(function (e) {

    		var items = [];

    		items.push( { src: $(this).attr('href')  } );

    		if($(this).data('gallery')){

    			var $arraySrc = $(this).data('gallery').split(',');

    			$.each( $arraySrc, function( i, v ){
    				items.push( {
    					src: v 
    				});
    			});     
    		}

    		$.magnificPopup.open({
    			type:'image',
    			mainClass: 'mfp-fade',
    			items:items,
    			gallery: {
    				enabled: true 
    			}
    		});

    		e.preventDefault();
    	});

    }



    if( $("a.image-iframe").length){
    	$('a.image-iframe').magnificPopup({type:'iframe',mainClass: 'mfp-fade'});
    }

    
    /*
    |--------------------------------------------------------------------------
    | TOOLTIP
    |--------------------------------------------------------------------------
    */

    $('.tips').tooltip({placement:'top'});

    
    
    /*
    |--------------------------------------------------------------------------
    | COLLAPSE
    |--------------------------------------------------------------------------
    */

    $('.accordion').on('show hide', function(e){
    	$('.accordion-toggle').removeClass('active');
    	$(e.target).siblings('.accordion-heading').find('.accordion-toggle').addClass('active');
    	$(e.target).siblings('.accordion-heading').find('.accordion-toggle i').toggleClass('icon-plus icon-minus', 200);

    });

    /*
    |--------------------------------------------------------------------------
    | CONTACT
    |--------------------------------------------------------------------------
    */   
    $('.slideContact').click(function(e){

    	if ( $(window).width() >= 800){

    		$('#contact').slideToggle('normal', 'easeInQuad',function(){

    			$('#contactinfoWrapper').css('margin-left', 0);
    			$('#mapSlideWrapper').css('margin-left', 3000);
    			$('#contactinfoWrapper').fadeToggle();


    		});
    		$('#closeContact').fadeToggle(); 
    		return false;

    	}else{

    		return true;

    	}
    	e.preventDefault();
    });
    
    
    $('#closeContact').click(function(e){


    	$('#contactinfoWrapper').fadeOut('normal', 'easeInQuad',function(){
    		$('#contactinfoWrapper').css('margin-left', 0);
    		$('#mapSlideWrapper').css('margin-left', 3000);
    	});

    	$('#contact').slideUp('normal', 'easeOutQuad');

    	$(this).fadeOut();

    	e.preventDefault();

    });
    



    
    
    /* MAP */
    $('#mapTrigger').click(function(e){


    	$('#mapSlideWrapper').css('display', 'block');
    	initialize('mapWrapper');

    	$('#contactinfoWrapper, #contactinfoWrapperPage').animate({
    		marginLeft:'-2000px' 
    	}, 400, function() {}); 


    	$('#mapSlideWrapper').animate({
    		marginLeft:'25px' 
    	}, 400, function() {});  

    	appendBootstrap();

    	e.preventDefault();
    });



    appendBootstrap();
    
    
    
    $('#mapTriggerLoader').click(function(e){


    	$('#mapSlide').css('display', 'block');

    	$('#contactSlide').animate({
    		marginLeft:'-2000px' 
    	}, 400, function() {}); 


    	$('#mapSlide').animate({
    		marginLeft:'0' 
    	}, 400, function() {
    		$('#contactSlide').css('display', 'none');
    	});  


    	appendBootstrap();

    	e.preventDefault();
    });
    
    
    $('#mapReturn').click(function(e){
        //$('#mapWrapper').css('margin-bottom', '3em');
        
        $('#contactSlide').css('display', 'block');
        $('#mapSlide').animate({
        	marginLeft:'3000px' 
        }, 400, function() {});       
        

        $('#contactSlide').animate({
        	marginLeft:'0' 
        }, 400, function() {
        	$('#mapSlide').css('display', 'none');
        }); 

        e.preventDefault();
    }); 

    /*
    |--------------------------------------------------------------------------
    | OWL CAROUSEL
    |--------------------------------------------------------------------------
    */




    if($('#carouselWorks1').length){   

    	$("#carouselWorks1").owlCarousel({
    		singleItem:true,
    		navigation:true,
    		navigationText:['<i class="icon-left-open"></i>','<i class="icon-right-open"></i>']
    	});

    }
    
    if($('#carouselWorks3').length){   

    	$("#carouselWorks3").owlCarousel(
    	{
    		items:3,
    		navigation:true,
    		navigationText:['<i class="icon-left-open"></i>','<i class="icon-right-open"></i>']
    	});

    }
    if($('#carouselWorks6').length){ 

    	$("#carouselWorks6").owlCarousel(
    	{
    		items:6,
    		navigation:true,
    		mouseDrag:false,
    		navigationText:['<i class="icon-left-open"></i>','<i class="icon-right-open"></i>']
    	});

    }

    if($('#homeCarousel').length){

    	$("#homeCarousel").owlCarousel(
    	{
    		items:1,
    		navigation:false,
    		singleItem: true,
    		transitionStyle: "backSlide",
    		autoPlay:4000,

    	});

    }


    
    /*
    |--------------------------------------------------------------------------
    | FLEXSLIDER
    |--------------------------------------------------------------------------
    */ 
    if($('#flexHome').length){

    	$('#flexHome').flexslider({
    		animation: "slide",
    		controlNav:true,
    		directionNav:false, 
    		touch: true,
    		direction: "vertical"

    	});    
    }


    if($('.flexFullScreen').length){

    	$('.flexFullScreen').flexslider({
    		animation: "slide",
    		controlNav: true,
    		directionNav: true,
    		slideshow: true,
    		touch: true,
    		prevText: '<i class="icon-left-open"></i>',           
    		nextText: '<i class="icon-right-open"></i>',   
    		start: function(slider){
    			setTimeout("animateTxt("+slider.currentSlide+", 'in')", 100);  
    		},
    		before: function(slider){
    			setTimeout("animateTxt("+slider.currentSlide+")", 100);  
    		},
    		after: function(slider){
    			setTimeout("animateTxt("+slider.currentSlide+", 'in')", 100);  
    		} 
    	});

    }   


    
    /*
    |--------------------------------------------------------------------------
    | LAYERSLIDER
    |--------------------------------------------------------------------------
    */ 
    if($('#layer-slider').length){
    	$('#layerslider').layerSlider({
    		skinsPath : 'js-plugin/layerslider/layerslider/skins/',
    		skin : 'fullwidth',
    		autoStart : true,
    		thumbnailNavigation : 'disabled',
    		hoverPrevNext : false,
    		responsiveUnder : 1170,
    		sublayerContainer :1140

    	});
    }

    if($('#layer-slider-blog').length){
    	$('#layerslider').layerSlider({
    		skinsPath : 'js-plugin/layerslider/layerslider/skins/',
    		skin : 'borderlesslight',
    		autoStart : true,
    		thumbnailNavigation : 'disabled',
    		hoverPrevNext : false,
    		responsiveUnder : 1170,
    		sublayerContainer :1140


    	});
    }

    /*
    |--------------------------------------------------------------------------
    | CAMERA SLIDER
    |--------------------------------------------------------------------------
    */ 
    if($('.camera_wrap').length){

    	jQuery('.camera_wrap').camera({
    		thumbnails: true,
    		pagination: true,
    		height:'35%',
    		fx:'simpleFade'
    	});

    }

    if($('.camera_wrap_nonav').length){

    	jQuery('.camera_wrap_nonav').camera({
    		pagination: false,
    		thumbnails: true,
    		height:'70%'
    	});

    }  
    if($('.camera_wrap_nothumb').length){

    	jQuery('.camera_wrap_nothumb').camera({
    		pagination: true,
    		thumbnails: false,
    		height:'40%'
    	});

    }  

    /*
    |--------------------------------------------------------------------------
    | CAMERA SLIDER
    |--------------------------------------------------------------------------
    */ 






    /*
    |--------------------------------------------------------------------------
    | MAIN ROLLOVER EFFECTS
    |--------------------------------------------------------------------------
    */     

    if($('.imgHover').length){

    	$('.imgHover article').hover(
    		function () {

    			var $this=$(this);

    			var fromTop = ($('.imgWrapper', $this).height()/2 - $('.iconLinks', $this).height()/2);
    			$('.iconLinks', $this).css('margin-top',fromTop);

				$('.mask', this).css('width', $('.imgWrapper', this).width());

    			if($('.pinBox').length){

    				$('.mediaHover', $this).height($('.imgWrapper', $this).height() + 15);   
    				$('.mask', this).css('height', $('.imgWrapper', this).height() + 15);


    				

    			}else{

    				$('.mediaHover', $this).height($('.imgWrapper', $this).height());   

    				$('.mask', this).css('height', $('.imgWrapper', this).height());


    			}

    			$('.mask', this).css('margin-top', 0);

    			$('.mask', this).stop(1).show().css('opacity',0).animate({opacity :1},200, function() {

    				$('.iconLinks', $this).css('display', 'block');
    				if(Modernizr.csstransitions) {
    					$('.iconLinks a').addClass('animated');


    					$('.iconLinks a', $this).removeClass('flipOutX'); 
    					$('.iconLinks a', $this).addClass('bounceInDown'); 

    				}else{

    					$('.iconLinks', $this).stop(true, false).fadeIn('fast');
    				}


    			});



    		},function () {

    			var $this=$(this);


    			$('.mask', this).stop(1).show().animate({marginTop: $('.imgWrapper', $this).height()},200, function() {

    				if(Modernizr.csstransitions) {
    					$('.iconLinks a', $this).removeClass('bounceInDown'); 
    					$('.iconLinks a', $this).addClass('flipOutX'); 

    				}else{
    					$('.iconLinks', $this).stop(true, false).fadeOut('fast');
    				}

    			});

    		});
}



    /*
    |--------------------------------------------------------------------------
    | ROLLOVER BTN
    |--------------------------------------------------------------------------
    */ 

    $('.socialIcon').hover(
    	function () {
    		$(this).stop(true, true).addClass('socialHoverClass', 300);
    	},
    	function () {
    		$(this).removeClass('socialHoverClass', 300);
    	});





    $('.tabs li, .accordion h2').hover(
    	function () {
    		$(this).stop(true, true).addClass('speBtnHover', 300);
    	},
    	function () {
    		$(this).stop(true, true).removeClass('speBtnHover', 100);
    	});



    /*
    |--------------------------------------------------------------------------
    | ALERT
    |--------------------------------------------------------------------------
    */ 
    $('.alert').delegate('button', 'click', function() {
    	$(this).parent().fadeOut('fast');
    });
    
    
    /*
    |--------------------------------------------------------------------------
    | CLIENT
    |--------------------------------------------------------------------------
    */   
    
    if($('.colorHover').length){
    	var array =[];
    	$('.colorHover').hover(

    		function () {

    			array[0] = $(this).attr('src');
    			$(this).attr('src', $(this).attr('src').replace('-off', ''));

    		}, 

    		function () {

    			$(this).attr('src', array[0]);

    		});
    }



    /*
    |--------------------------------------------------------------------------
    | Rollover boxIcon
    |--------------------------------------------------------------------------
    */ 
    if($('.boxIcon').length){

    	$('.boxIcon').hover(function() {
    		var $this = $(this);

    		$this.css('opacity', '1');   
            //$this.find('.boxContent>p').stop(true, false).css('opacity', 0);
            $this.addClass('hover');
            $('.boxContent>p').css('bottom', '-50px');
            $this.find('.boxContent>p').stop(true, false).css('display', 'block');

            $this.find('.iconWrapper i').addClass('triggeredHover');    

            $this.find('.boxContent>p').stop(true, false).animate({
            	'margin-top': '0px'},
            	300, function() {
            // stuff to do after animation is complete
        });


        }, function() {
        	var $this = $(this);
        	$this.removeClass('hover');

        	$this.find('.boxContent>p').stop(true, false).css('display', 'none');
        	$this.find('.boxContent>p').css('margin-top', '250px');
        	$this.find('.iconWrapper i').removeClass('triggeredHover'); 


        });   
    }   






    $('#quoteTrigger').click(function (e) {

        //$("#quoteWrapper").scrollTop(0);

        if(!$('#quoteFormWrapper').is(':visible')){
        	$('html, body').animate({scrollTop: $("#quoteWrapper").offset().top}, 300);
        }

        var $this = $(this);


        $('#quoteFormWrapper').slideToggle('fast', function() {

        	$this.text($('#quoteFormWrapper').is(':visible') ? "Close form" : "I have a project");

        });


        e.preventDefault();
    });



/*
|--------------------------------------------------------------------------
| SHARRRE
|--------------------------------------------------------------------------
*/
if($('#shareme').length){

	$('#shareme').sharrre({

		share: {
			googlePlus: true,
			facebook: true,
			twitter: true,
			linkedin: true
		},

		buttons: {
			googlePlus: {size: 'tall', annotation:'bubble'},
			facebook: {layout: 'box_count'},
			twitter: {count: 'vertical'},
			linkedin: {counter: 'top'}
		},

		enableHover: false,
		enableCounter: false,
		enableTracking: true,
      //url:'document.location.href'
  });
} 



/*
|--------------------------------------------------------------------------
| ROLL OVER PreviewTrigger
|--------------------------------------------------------------------------
*/
if($('.previewTrigger').length){

	$('.mask').css('height', $('.previewTrigger').height());
	$('.mask').css('width', $('.previewTrigger').width());
    // $('.mask', this).css('top', $('.previewTrigger', this).width());
    // $('.mask', this).css('left', $('.previewTrigger', this).width());

    $('.previewTrigger').hover(function() {

    	var $this = $(this);

    	$this.children('.mask').fadeIn('fast');

    	if(Modernizr.csstransitions) {
    		$('.iconWrapper', $this).addClass('animated');
    		$('.iconWrapper', $this).css('display', 'block');
    		$('.iconWrapper', $this).removeClass('flipOutX'); 
    		$('.iconWrapper', $this).addClass('bounceInDown'); 
    	}else{
    		$('.iconWrapper', $this).stop(true, false).fadeIn('fast');
    	}

    }, function() {

    	var $this = $(this); 

    	$this.children('.mask').fadeOut('fast');

    	if(Modernizr.csstransitions) {
    		$('.iconWrapper', $this).removeClass('bounceInDown'); 
    		$('.iconWrapper', $this).addClass('flipOutX');
    		$('.iconWrapper', $this).css('display', 'none');
    		$('.iconWrapper', $this).removeClass('animated');
    	}else{
    		$('.iconWrapper', $this).stop(true, false).fadeOut('fast');
    	}

    });
}





/*
|--------------------------------------------------------------------------
| PORTFOLIO SHEET SYSTEM
|--------------------------------------------------------------------------
*/
// PAGE SLIDE
/*$(".portfolioSheet").pageslide({
    direction: "left",
    modal: true,
    iframe: false,
    speed: "250"
});*/


/*
|--------------------------------------------------------------------------
| AUTOCLOSE BOOSTRAP MENU
|--------------------------------------------------------------------------
*/
// $('.nav a').on('click', function(){
//     $(".navbar-toggle").click();
// });






//END DOCUMENT READY   
});



/*
|--------------------------------------------------------------------------
| EVENTS TRIGGER AFTER ALL IMAGES ARE LOADED
|--------------------------------------------------------------------------
*/
$(window).load(function() {

	"use strict";
    
    /*
    |--------------------------------------------------------------------------
    | PRELOADER
    |--------------------------------------------------------------------------
    */ 
    $('#status').fadeOut(); // will first fade out the loading animation
    $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
    $('body').delay(350).css({'overflow':'visible'});




    /*
    |--------------------------------------------------------------------------
    | ISOTOPE USAGE FILTERING
    |--------------------------------------------------------------------------
    */ 
    if($('.isotopeWrapper').length){

    	var $container = $('.isotopeWrapper');
    	var $resize = $('.isotopeWrapper').attr('id');
        // initialize isotope
        
        $container.isotope({
        	layoutMode: 'sloppyMasonry',
        	itemSelector: '.isotopeItem',
            resizable: false, // disable normal resizing
            masonry: {
            	columnWidth: $container.width() / $resize
            }     
        });
        var rightHeight = $('#works').height();
        $('#filter a').click(function(){


        	$('#works').height(rightHeight);
        	$('#filter a').removeClass('current');


        	$(this).addClass('current');
        	var selector = $(this).attr('data-filter');
        	$container.isotope({
        		filter: selector,
        		animationOptions: {
        			duration: 1000,
        			easing: 'easeOutQuart',
        			queue: false
        		}
        	});
        	return false;
        });
        
        
        $(window).smartresize(function(){
        	$container.isotope({
                // update columnWidth to a percentage of container width
                masonry: {
                	columnWidth: $container.width() / $resize
                }
            });
        });
        

    }  


    /**PROCESS ICONS**/
    $('.iconBoxV3 a').hover(function() {

    	if(Modernizr.csstransitions) {

    		$(this).stop(false, true).toggleClass( 'hover', 150);
    		$('i', this).css('-webkit-transform', 'rotateZ(360deg)');
    		$('i', this).css('-moz-transform', 'rotateZ(360deg)');
    		$('i', this).css('-o-transform', 'rotateZ(360deg)');
    		$('i', this).css('transform', 'rotateZ(360deg)'); 

    	}else{

    		$(this).stop(false, true).toggleClass( 'hover', 150);

    	}  

    }, function() {

    	if(Modernizr.csstransitions) {
    		$(this).stop(false, true).toggleClass( 'hover', 150);
    		$('i', this).css('-webkit-transform', 'rotateZ(0deg)');
    		$('i', this).css('-moz-transform', 'rotateZ(0deg)');
    		$('i', this).css('-o-transform', 'rotateZ(0deg)');
    		$('i', this).css('transform', 'rotateZ(0deg)'); 

    	}else{

    		$(this).stop(false, true).toggleClass( 'hover', 150);
    	}  

    });

    if($('.scrollMenu').length){


    	if($('.localscroll').length){   

    		/*if($('.header3').length || $('.header5').length || $('.header6').length){
    			$offset = ;
    		}else{
    			$offset = 100;
    		}*/


    		$('.localscroll').localScroll({
    			lazy: true,
    			offset: {
    				top:  -100
    			}
    		});

    	}


    }


    if (isDesktop === true && $('section[id^="paralaxSlice"]').length )
    {

    	$(window).stellar({
    		horizontalScrolling: false,
    		responsive:true
    	});
    }


//END WINDOW LOAD
});

/*
|--------------------------------------------------------------------------
| FUNCTIONS
|--------------------------------------------------------------------------
*/



/* CONTACT FROM */

jQuery(function() {
	"use strict";
	if( jQuery("#contactfrm").length ){

		jQuery("#contactfrm").validate({
        // debug: true,
        errorPlacement: function(error, element) {
        	error.insertBefore( element );
        },
        submitHandler: function(form) {
        	jQuery(form).ajaxSubmit({
        		target: ".result"
        	});
        },
        onkeyup: false,
        onclick: false,
        rules: {
        	name: {
        		required: true,
        		minlength: 3
        	},
        	email: {
        		required: true,
        		email: true
        	},
        	phone: {
        		required: true,
        		minlength: 10,
        		digits:true
        	},
        	comment: {
        		required: true,
        		minlength: 10,
        		maxlength: 350
        	}
        }
    });
	}

	if( jQuery("#projectQuote").length){

		jQuery("#projectQuote").validate({
        // debug: true,
        errorPlacement: function(error, element) {
        	error.insertBefore(element);
        },
        submitHandler: function(form) {
        	jQuery(form).ajaxSubmit({
        		target: ".quoteResult"
        	});
        },
        onkeyup: false,

        
        rules: {
        	name: {
        		required: true,
        		minlength: 3
        	},
        	email: {
        		required: true,
        		email: true
        	},
        	company: {
        		required: true,
        		minlength: 2
        	},
        	quoteType:{
        		required: true
        	},
        	comment: {
        		required: true,
        		minlength: 10,
        		maxlength: 350
        	}

        }
    });



	}

});

/* CONTACT FROM */

/* FLEXSLIDER INNER INFO CUSTOM ANIMATION */
function animateTxt(curSlide, action){
	"use strict";
	if(action === 'in'){
		var i = 0;
		var animaDelay = 0;

		$('.slideN'+curSlide+':not([class*=clone])>.caption').css('display', 'block');

		$('.slideN'+curSlide+':not([class*=clone])>.caption>div').each(function( ) {
			if(Modernizr.csstransitions) { 

				$(this).css('-webkit-animation-delay', animaDelay+'s');
				$(this).css('-moz-animation-delay', animaDelay+'s');
				$(this).css('-0-animation-delay', animaDelay+'s');
				$(this).css('-ms-animation-delay', animaDelay+'s');
				$(this).css('animation-delay-delay', animaDelay+'s');

				$(this).show().addClass('animated').addClass($(this).attr('data-animation'));


                // $(this).show('slow', function() {
                //     $(this).addClass('animated').addClass($(this).attr('data-animation'));
                // });


	}else{
		var timing;
		$('.slideN'+curSlide+':not([class*=clone])>.caption>div').hide();
		if (i === 0){timing = 0;}else if(i === 1){timing = 300;} else{ timing = 300 * i;}
		$(this).delay(timing).fadeIn('fast');
	}
	i++;
	animaDelay = animaDelay+0.2;


});

	}else{
		var j = 0;
		$('.slideN'+curSlide+':not([class*=clone])>.caption').css('display', 'none');

		$('.slideN'+curSlide+':not([class*=clone])>.caption>div').each(function( ) {
			if(Modernizr.csstransitions) { 

				$(this).removeClass($(this).attr('data-animation')).removeClass('animated').hide();

			}else{
				$(this).hide();
			}
			j++;
		});
	}

}



/* MAIN MENU (submenu slide and setting up of a select box on small screen)*/
function initializeMainMenu() {

	"use strict";
	var $mainMenu = $('#mainMenu').children('ul');

	//var action0 = (isMobile === false)?'mouseenter':'click';
	//var action1 = (isMobile === false)?'mouseleave':'click';

	if(Modernizr.mq('only all and (max-width: 767px)') ) {


			// Responsive Menu Events
			var addActiveClass = false;

			$("#mainMenu li.primary a, #mainMenu li.dropdownSubmenu a").unbind('click');
			$mainMenu.unbind('mouseenter mouseleave');

			$("#mainMenu li.primary>a, #mainMenu li.dropdownSubmenu>a").on("click", function(e) {
				
				e.preventDefault();


				addActiveClass = $(this).parent("li").hasClass("Nactive");
				$("li", $mainMenu).removeClass("Nactive");

				if(!addActiveClass) {
					$(this).parents("li").addClass("Nactive");
				}else{
					$(this).parent().parent('li').addClass("Nactive");
				}

				return;
				
			});

		}else{


			$("li", $mainMenu).removeClass("Nactive");
			$('a', $mainMenu).unbind('click');

			$mainMenu.on('mouseenter', 'li', function() {


				var $this = $(this),
				$subMenu = $this.children('ul');


				if( $subMenu.length ){
					$this.addClass('hover').stop();
				}else {

					if($this.parent().is($(':gt(1)', $mainMenu))){

						$this.stop(false, true).fadeIn('slow');

					}
				}


				if($this.parent().is($(':gt(1)', $mainMenu))){

					$subMenu.stop(true, true).fadeIn(200,'easeInOutQuad'); 
					$subMenu.css('left', $subMenu.parent().outerWidth(true));


				}else{

					$subMenu.stop(true, true).fadeIn(200,'easeInOutQuad'); 

				}


			}).on('mouseleave','li', function() {


				var $nthis = $(this),
				$subMenu = $nthis.children('ul');

				if($nthis.parent().is($(':gt(1)', $mainMenu))){

	            //$nthis.children('ul').stop(false, true).css('left', 130).css('opacity', 0).css('display', 'none');
	            $nthis.children('ul').hide();
	            $nthis.children('ul').css('left', 0);


	        }else{

	        	$nthis.removeClass('hover').children('ul').stop(false, true).hide();
	        }
	        
	        if( $subMenu.length ){$nthis.removeClass('hover');}


	    });

		}
	}


/*
|--------------------------------------------------------------------------
| GOOGLE MAP
|--------------------------------------------------------------------------
*/

function appendBootstrap() {
	"use strict";
	if($('#mapWrapper').length){
		var script = document.createElement("script");
		script.type = "text/javascript";
		script.src = "http://maps.google.com/maps/api/js?sensor=false&callback=initialize";
		document.body.appendChild(script);
	}
}    




function initialize(id) {
	"use strict";
	var image = 'images/icon-map.png';

	var overlayTitle = 'Agencies';

	var locations = [
        //point number 1
        ['Madison Square Garden', '4 Pennsylvania Plaza, New York, NY'],

        //point number 2
        ['Best town ever', 'Santa Cruz', 36.986021, -122.02216399999998],

        //point number 3 
        ['Located in the Midwestern United States', 'Kansas'],

        //point number 4
        ['I\'ll definitly be there one day', 'Chicago', 41.8781136, -87.62979819999998] 
        ];

        /*** DON'T CHANGE ANYTHING PASSED THIS LINE ***/
        id = (id === undefined) ? 'mapWrapper' : id;

        var map = new google.maps.Map(document.getElementById(id), {
        	mapTypeId: google.maps.MapTypeId.ROADMAP,
        	scrollwheel: false,
        	zoomControl: true,
        	zoomControlOptions: {
        		style: google.maps.ZoomControlStyle.LARGE,
        		position: google.maps.ControlPosition.LEFT_CENTER
        	},
        	streetViewControl:true,
        	scaleControl:false,
        	zoom: 14,
        	styles:[
        	{
        		"featureType": "water",
        		"stylers": [
        		{
        			"color": "#6196AD"
        		},
        		]
        	},
        	{
        		"featureType": "road",
        		"elementType": "geometry.fill",
        		"stylers": [
        		{
        			"color": "#FCFFF5"
        		},
        		]
        	},
        	{
        		"featureType": "road",
        		"elementType": "geometry.stroke",
        		"stylers": [
        		{
        			"color": "#808080"
        		},
        		{
        			"lightness": 54
        		}
        		]
        	},
        	{
        		"featureType": "landscape.man_made",
        		"elementType": "geometry.fill",
        		"stylers": [
        		{
        			"color": "#dde1d4"
        		}
        		]
        	},
        	{
        		"featureType": "poi.park",
        		"elementType": "geometry.fill",
        		"stylers": [
        		{
        			"color": "#73AB7D"
        		}
        		]
        	},
        	{
        		"featureType": "road",
        		"elementType": "labels.text.fill",
        		"stylers": [
        		{
        			"color": "#767676"
        		}
        		]
        	},
        	{
        		"featureType": "road",
        		"elementType": "labels.text.stroke",
        		"stylers": [
        		{
        			"color": "#ffffff"
        		}
        		]
        	},
        	{
        		"featureType": "road.highway",
        		"elementType": "geometry.fill",
        		"stylers": [
        		{
        			"color": "#7e7341"
        		}
        		]
        	},

        	{
        		"featureType": "landscape.natural",
        		"elementType": "geometry.fill",
        		"stylers": [
        		{
        			"visibility": "on"
        		},
        		{
        			"color": "#dee6e6"
        		}
        		]
        	},
        	{
        		"featureType": "poi.park",
        		"stylers": [
        		{
        			"visibility": "on"
        		}
        		]
        	},
        	{
        		"featureType": "poi.sports_complex",
        		"stylers": [
        		{
        			"visibility": "on"
        		}
        		]
        	},
        	{
        		"featureType": "poi.medical",
        		"stylers": [
        		{
        			"visibility": "on"
        		}
        		]
        	},
        	{
        		"featureType": "poi.business",
        		"stylers": [
        		{
        			"visibility": "simplified"
        		}
        		]
        	}
        	]

        });

var myLatlng;
var marker, i;
var bounds = new google.maps.LatLngBounds();
var infowindow = new google.maps.InfoWindow({ content: "loading..." });

for (i = 0; i < locations.length; i++) { 


	if(locations[i][2] !== undefined && locations[i][3] !== undefined){
		var content = '<div class="infoWindow">'+locations[i][0]+'<br>'+locations[i][1]+'</div>';
		(function(content) {
			myLatlng = new google.maps.LatLng(locations[i][2], locations[i][3]);

			marker = new google.maps.Marker({
				position: myLatlng,
				icon:image,  
				title: overlayTitle,
				map: map
			});

			google.maps.event.addListener(marker, 'click', (function() {
				return function() {
					infowindow.setContent(content);
					infowindow.open(map, this);
				};

			})(this, i));

			if(locations.length > 1){
				bounds.extend(myLatlng);
				map.fitBounds(bounds);
			}else{
				map.setCenter(myLatlng);
			}

		})(content);
	}else{

		var geocoder   = new google.maps.Geocoder();
		var info   = locations[i][0];
		var addr   = locations[i][1];
		var latLng = locations[i][1];

		(function(info, addr) {

			geocoder.geocode( {

				'address': latLng

			}, function(results) {

				myLatlng = results[0].geometry.location;

				marker = new google.maps.Marker({
					position: myLatlng,
					icon:image,  
					title: overlayTitle,
					map: map
				});
				var $content = '<div class="infoWindow">'+info+'<br>'+addr+'</div>';
				google.maps.event.addListener(marker, 'click', (function() {
					return function() {
						infowindow.setContent($content);
						infowindow.open(map, this);
					};
				})(this, i));

				if(locations.length > 1){
					bounds.extend(myLatlng);
					map.fitBounds(bounds);
				}else{
					map.setCenter(myLatlng);
				}
			});
		})(info, addr);

	}
}
}







/* ANALYTICS */
function gaSSDSLoad (acct) {
	"use strict";  
	var gaJsHost = (("https:" === document.location.protocol) ? "https://ssl." : "http://www."),
	pageTracker,
	s;
	s = document.createElement('script');
	s.src = gaJsHost + 'google-analytics.com/ga.js';
	s.type = 'text/javascript';
	s.onloadDone = false;
	function init () {
		pageTracker = _gat._getTracker(acct);
		pageTracker._trackPageview();
	}
	s.onload = function () {
		s.onloadDone = true;
		init();
	};
	s.onreadystatechange = function() {
		if (('loaded' === s.readyState || 'complete' === s.readyState) && !s.onloadDone) {
			s.onloadDone = true;
			init();
		}
	};
	document.getElementsByTagName('head')[0].appendChild(s);
}




jQuery(function($){
	"use strict";
	if($('#superSizedSlider').length){

		$('#superSizedSlider').height($(window).height());

		$.supersized({

                    // Functionality
                    slideshow               :   1,          // Slideshow on/off
                    autoplay                :   1,          // Slideshow starts playing automatically
                    start_slide             :   1,          // Start slide (0 is random)
                    stop_loop               :   0,          // Pauses slideshow on last slide
                    random                  :   1,          // Randomize slide order (Ignores start slide)
                    slide_interval          :   12000,      // Length between transitions
                    transition              :   1,          // 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
                    transition_speed        :   1000,       // Speed of transition
                    new_window              :   1,          // Image links open in new window/tab
                    pause_hover             :   0,          // Pause slideshow on hover
                    keyboard_nav            :   1,          // Keyboard navigation on/off
                    performance             :   1,          // 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
                    image_protect           :   1,          // Disables image dragging and right click with Javascript

                    // Size & Position                         
                    min_width               :   0,          // Min width allowed (in pixels)
                    min_height              :   0,          // Min height allowed (in pixels)
                    vertical_center         :   1,          // Vertically center background
                    horizontal_center       :   1,          // Horizontally center background
                    fit_always              :   0,          // Image will never exceed browser width or height (Ignores min. dimensions)
                    fit_portrait            :   1,          // Portrait images will not exceed browser height
                    fit_landscape           :   0,          // Landscape images will not exceed browser width

                    // Components                           
                    slide_links             :   'blank',    // Individual links for each slide (Options: false, 'num', 'name', 'blank')
                    thumb_links             :   0,          // Individual thumb links for each slide
                    thumbnail_navigation    :   0,          // Thumbnail navigation
                    slides                  :   [           // Slideshow Images
                    {image : './images/slider/super/supersized-1.jpg', title : '<h1>We are creative kitties<br /><a href="#works" class="btn btn-primary">learn more</a></h1>', thumb : '', url : ''},

                    {image : './images/slider/super/supersized-2.jpg', title : '<h1>We build beautiful websites<br /><a href="#works" class="btn btn-primary">check our portfolio</a></h1>', thumb : '', url : ''},

                    {image : './images/slider/super/supersized-3.jpg', title : '<h1>That\'s how we like it<br /><a href="#works" class="btn btn-primary">call us</a></h1>', thumb : '', url : ''}
                    ],

                    // Theme Options               
                    progress_bar            :   0,          // Timer for each slide                         
                    mouse_scrub             :   0
                    
                });
}
});





