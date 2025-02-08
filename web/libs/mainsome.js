var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

document.addEventListener( 'wpcf7mailsent', function( event ) {
     ym(ya_counter_id, 'reachGoal', "ORDER");
     console.log('order');
    var src_e = event.detail.id;
    var src_form = $("#" + src_e).find("form");
    
      //yaCounter50665042.reachGoal('credit-uznat');
      var lead_contact_name = $(src_form).find("input[name='iname']").val();
      var lead_title = "Заявка с сайта";
  	  var lead_phone = $(src_form).find("input[name='tel']").val();
      var lead_message = $(src_form).find("textarea[name='subj']").val();
      var lead_utm = $(src_form).find("input[name='utm_source']").val();
      var lead_town = $(".header-town-current").html();
      mydata = {
        "title" : lead_title,
        "tag" : "masterabyta.ru",
        "name" : lead_contact_name,
        "phone" : lead_phone,
        "message" : lead_message,
        "utm" : lead_utm,
        "town" : lead_town,
        "page" : window.location.href
      }
      // console.log(mydata);
      
      $.post('amo/index.html',mydata,
	  function(data){
      	// console.log(data)	;
      });
 
    

}, false );


if (!String.prototype.startsWith) {
  String.prototype.startsWith = function(searchString, position) {
    position = position || 0;
    return this.indexOf(searchString, position) === position;
  };
}

		function z7success() {
			$('.popform').hide();
			$('.popsuccess').show();
			$(".stickyform").removeClass("on");
			$(".stickytop").removeClass("on");
			sticky_form_complete = true;
		}
document.addEventListener( 'wpcf7mailsent', function( event ) {
       z7success();
}, false );


function initmobmenu(){

    	$('.popsvc .menu-item-has-children').addClass('hideul');
    	$('.popsvc .menu-item-has-children').append( "<span class='tgl'>></span>" );
    	// $('.popsvc .menu-item-has-children .tgl').click(function() {
    	// 	if ($(this).parent().hasClass('hideul')) {
    	// 	$('.popsvc .menu-item-has-children').addClass('hideul');
    	// 	$(this).parent().toggleClass('hideul');
    	// 	} else {
    	// 	$('.popsvc .menu-item-has-children').addClass('hideul');
    	// 	}
    	// });
    	$('.popsvc .menu-item-has-children').click(function() {
    		if ($(this).hasClass('hideul')) {
    		$('.popsvc .menu-item-has-children').addClass('hideul');
    		$(this).toggleClass('hideul');
    		} else {
    		$('.popsvc .menu-item-has-children').addClass('hideul');
    		}
    	});    	
}

var sm = 9,ss=59,sticky_form_complete=false;

    $(document).ready(function() {

    	setInterval(function(){
    		ss--;
    		if(ss<0){
    			sm--;
    			ss=59;
    		}
    		if(sm<0){
    			$(".stickyform").fadeOut();
    			// $(".stickyform-timer").fadeOut();
    			// $(".stickyform-timer-2").addClass("isphone");
    		}
    		let xss=ss;
    		if(ss.toString().length<2){
    			xss="0"+ss;
    		}
    		$(".stickyform-timer b").html(sm+":"+xss);
    		$(".stickyform-timer-2 b").html(sm+":"+xss);
    	},1000);

    	$(".stickyform-timer-2-text").click(function(){
    		$(".stickytop").addClass("on");
    	});

    	$(".stickytop-top-close").click(function(e){
    		$(".stickytop").removeClass("on");
    	})
		
		$(".textblock table").each(function(){
			// $(this).wrap("<div class='table-responsive'></div>");
		})

    	if(getUrlParameter('utm_source')){
    	    $("input[name='utm_source']").val(getUrlParameter('utm_source'));
    	} else {
    	    $("input[name='utm_source']").val('Не определено');
    	}

    	$(".newhead-email b").click(function(e){
    		window.location.href="mailto:info@masterabyta.ru";
    	})
		
    	initmobmenu();
    	$('#menu-item-53 > a').eq(0).click(function() { $("#menu-item-53").toggleClass('oupened'); });
		
		$("#menu-item-53 >  ul.sub-menu > li.menu-item-has-children > a ").click(function(e){
			
			var x = e.pageX - $(this).offset().left;
 			if(x>210){
				e.preventDefault();
				$("#menu-item-53 .sub-menu .sub-menu").hide();
				$(this).parent().children(".sub-menu").toggle();
			}
		});
		

		
        $('.reviewblock .carousel').slick({
            infinite: true,
            autoplay: true,
            autoplaySpeed: 4000,
            speed: 1000,
            slidesToShow: 3,
            slidesToScroll: 1,
       		dots: true,
    		prevArrow: false,
    		nextArrow: false,
		  	responsive: [
		      {
			      breakpoint: 1170,
			      settings: {
			        slidesToShow: 2,
			        slidesToScroll: 1,
			        infinite: true
			      }
			  },
			    {
			      breakpoint: 700,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 1,
			        infinite: true
			      }
			  }
			]
        });

        $('.galeryblock .carousel').slick({
            infinite: true,
            autoplay: true,
            autoplaySpeed: 4000,
            speed: 1000,
            slidesToShow: 4,
            slidesToScroll: 1,
        	dots: true,
    		prevArrow: false,
   			nextArrow: false,
		    responsive: [
			  {
			      breakpoint: 1170,
			      settings: {
			        slidesToShow: 2,
			        slidesToScroll: 2,
			        infinite: true
			      }
			  },
			  {
			      breakpoint: 700,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 1,
			        infinite: true
			      }
			  },
			]
        });

        $('.masters-slider').slick({
            infinite: true,
            autoplay: true,
            autoplaySpeed: 4000,
            prevArrow: $(".masters-slider-prev"),
            nextArrow: $(".masters-slider-next"),
            speed: 1000,
            slidesToShow: 3,
            slidesToScroll: 1,
       		dots: false,
    		prevArrow: false,
    		nextArrow: false,
		  	responsive: [
		      {
			      breakpoint: 1170,
			      settings: {
			        slidesToShow: 2,
			        slidesToScroll: 1,
			        infinite: true
			      }
			  },
			    {
			      breakpoint: 700,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 1,
			        infinite: true
			      }
			  }
			]
        });		        

        $(".masters-slider-prev").click(function(){
        	$(".masters-slider").slick("slickPrev");
        })

       $(".masters-slider-next").click(function(){
        	$(".masters-slider").slick("slickNext");
        })        

        $('[data-fancybox="gallery"]').fancybox({ });
    });

var metroTimer = false;


$(document).ready(function(){

	
	
	$("input[name=town]").val(js_town);
	$("input[name=domain]").val(js_domain);
	$("input[name=fpage]").val($("h1").eq(0).text().trim() + ` (${window.location.href})`);

	$(".towns-list").on("click",".town",function(e){
		e.preventDefault();
		window.location.href=$(this).data("town");
	})

	var town_search_timeout = null;


	$.get("wp-content/themes/z7_masterbyt/gettowns.html",function(data){
		$(data).appendTo(".towns-list");
	})

	$(".towns-search input").on("input",function(){
		var val = $(this).val().toLowerCase();
		console.log(val);
		if(val.length>1){
			var finded = false;
			$(".towns-list .town").each(function(){
				var this_town = $(this).text().toLowerCase();
				if(this_town.indexOf(val) >= 0){
					$(this).show();
					finded = true;
				} else {
					$(this).hide();
				}
			})
			if(finded = false){
				$(".towns-list .town").show();
			}
		} else {
			$(".towns-list .town").show();
		}
	})

	$("body").on("click",".town",function(e){
		e.preventDefault();
		if($(this).data("town")){
			window.location.href="https://"+$(this).data("town")+".masterabyta.ru";
		} else {
			window.location.href="index.html";
		}
	})	

	setInterval(function(){
		$(".newhead-mob-phone").toggleClass("animated tada");
	},1500)

	$('.scrollbar-inner').scrollbar();
	$(".header-town").click(function(){
		$(".popsvc").hide();
		$.fancybox.open({
			src:"#popup-towns",
			touch : false
		})
	})
	$(".metro-select").click(function(){
		$(".metro-list").toggle();
	})
	$("body").on("click",".metro-list-item",function(){
		var min = $(this).data("min");
		$(".metro-current").text($(this).text());
		$(".metro-list").toggle();
		$(".metro-select-wrap-right").html("≈ "+min+" минут");
	})
	$(".bigmenu ul > li > a").each(function(){
		var title = $(this).text();
		$(this).html('<div class="bigmenu-pic"></div><div class="bigmenu-text">'+title+'</div>');
	})
	$(".bigmenu ul > li.menu-item-has-children > a").click(function(e){
		e.preventDefault();
		$(this).parent().siblings().find(".sub-menu").hide();
		$(this).parent().find(".sub-menu").toggle();
	})
	$("body").click(function(event) { 
	  var $target = $(event.target);
	  if(!$target.closest('.bigmenu').length){
	    $(".bigmenu .sub-menu").hide();
	  }        
	});

	$("body").click(function(event) { 
	  var $target = $(event.target);
	  if(!$target.closest('.metro-select-wrap').length){
	    $(".metro-list").hide();
	  }        
	});	

	function loadStations(){
		$.get('/wp-content/themes/z7_masterbyt/metro.json',function(data){
			// var pst = JSON.parse(data);
			var arr = data['excerpt'].rendered.replace(/<\/?[^>]+(>|$)/g, "").split('\n');
			for(var i =0; i<arr.length; i++){
				var it = arr[i];
				var spl = it.split(',');
				var min = spl[1];
				var ttl = spl[0];
				// console.log(ttl);
				var item = '<div class="metro-list-item" data-min="'+min+'" data-title="'+ttl+'"></div>';
				$(".metro-list-list").append(item);
			}
			checkStations('');
		})
	}

	function checkStations(txt){
		$(".metro-list-item").each(function(){
			var thistxt = $(this).data("title");
			if(thistxt.trim().toLowerCase().startsWith(txt)){
				$(this).text(thistxt);
			} else {
				$(this).text('');
			}
		});
		if(txt==''){
			$(".metro-list-item").each(function(){
				$(this).text($(this).data("title"));
			})
		}
	}

	loadStations('');

	$(".metro-type").on("input",function(){
		clearTimeout(metroTimer);
		var txt = $(this).val().toLowerCase();
		metroTimer = setTimeout(function(){
			checkStations(txt);
		},150)
	})
})



$(window).on("scroll",function(){
	var y = $(window).scrollTop();
	if(y>0 && ((window.innerHeight + y) < document.body.offsetHeight)) {
		if(!sticky_form_complete){
			$(".stickyform").addClass("on");
		}
	} else {
		$(".stickyform").removeClass("on");
	}
})





$(document).ready(function(){
	$(".table-price:not(.noexpand)").each(function(){
	var i = 0, add_toggler = false;
	console.log("zzz");
	$(this).find("tr").each(function(){
		if(!$(this).find("th").length){
			i++;
			if(i>11){
				$(this).addClass("tohide hidden");
				add_toggler = true;
			}
		}
	});
	if(add_toggler){
		// $('<div class="price-toggler-wrap"><div class="price-toggler"><span>Показать все цены</span> <i class="fa fa-angle-down"></i></div></div>').insertAfter($(this));
		$('<div class="price-toggler-wrap"><div class="price-toggler"><span>Развернуть</span> <i class="fa fa-angle-down"></i></div></div>').insertAfter($(this));
	}
})

$("body").on("click",".price-toggler",function(){
	$(this).parent().prev().find("tr.tohide").toggleClass("hidden");
	
	

	$(this).toggleClass("on");
	if($(this).hasClass("on")){
		$(this).html('<div class="price-toggler-wrap"><div class="price-toggler"><span>Свернуть</span> <i class="fa fa-angle-up"></i></div></div>');
	} else {
		// $(this).html('<div class="price-toggler-wrap"><div class="price-toggler"><span>Показать все цены</span> <i class="fa fa-angle-down"></i></div></div>');
		$(this).html('<div class="price-toggler-wrap"><div class="price-toggler"><span>Развернуть</span> <i class="fa fa-angle-down"></i></div></div>');
	}
})	

})






$(document).ready(function(){
	$(".price-content h2").each(function(){
		$(this).addClass("blocktitle");
	})
})

$(document).ready(function() {
			$(".newhead-mob-menu-button").click(function(e) { 
				$('.newhead').addClass('clickmob');
			});
			$("a.servicesblock").click(function(e) { 
				$('.newhead').addClass('clickservice');
			});
			
			$("a.close").click(function(e) { 
				$('.newhead').removeClass('clickmob');
				$('.newhead').removeClass('clickservice');
			});
			
			$(".bigmenu ul > li.menu-item-has-children").click(function(e){
				if($(this).hasClass("open")){
					$(this).removeClass('open');
						} else {
							$(this).addClass('open');
						}
	
	
	
			
				$(this).parent().siblings().find(".sub-menu").addClass('hode');
				$(this).parent().find(".sub-menu").addClass('hode');
				
			})
			/*$('.bigmenu-text').click(function(e){
				$(this).addClass('clo');
				$(this).parent().parent().removeClass('open');
			})*/
			
			});