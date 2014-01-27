(function ($) {
	$( document ).ready(function() {
		//inicializamos el menu principal con el plugin responsive para darle soporte a tablets
		$("#navigation").children('.menu-responsive').attr('data-breakpoint', 800).flexNav({'hoverIntent': true});

		//social bar en el nodo
		if(window.innerWidth > 1150) {
			if($('.social-bar').length) {
				var socialBar = $('.social-bar');
				socialBar.addClass('social-bar-side');
				var socialBarBase = parseInt(socialBar.offset().top);
				if($(window).scrollTop() > socialBarBase) {
					var incremento = $(window).scrollTop - socialBarBase;
					socialBar.css('top', (incremento + 'px'));
				}
				$(window).scroll(function(){
					var scrollTop = $(window).scrollTop();
					if(scrollTop > socialBarBase) {
						var incremento = scrollTop - socialBarBase;
						socialBar.css('top', (incremento + 'px'));
					} else {
						socialBar.css('top', '0px');
					}
				});
			}
		}//fin social bar

		//ventana de login
		$('.login-icon').on('click', function(e){
			e.preventDefault();
			$('.login-form').slideToggle();
		});

		//fix columna contenido respecto a columna left-sidebar
		var doffset = parseFloat($('.destacamos').offset().top);
		var dheight = parseFloat($('.destacamos').css('height'));
		var dtotal = doffset + dheight;
		var lsboffset = parseFloat($('#left-sidebar').offset().top);
		var lsbheight = parseFloat($('#left-sidebar').css('height'));
		var lsbtotal = lsboffset + lsbheight;

		if(lsbtotal > dtotal) {
			var fixIncr = lsbtotal - dtotal;
			$('.destacamos').css('margin-bottom', fixIncr + 'px');
		}

		//especial grande
		if($('.especial-grande').length) {
			var especiaGrande = $('.especial-grande');
			especiaGrande.children('span').on('click', function(e) {
				e.preventDefault();
				especiaGrande.slideUp();
			});
		}

		//anuncio desplegable
		if($('.add-desplegable').length) {
			var addDesplegable = $('.add-desplegable');
			if(addDesplegable.children('.add-grande').html() != '') {
				addDesplegable.hover(
					function(){
						addDesplegable.children('.add-chica').css('display', 'none');
						addDesplegable.children('.add-grande').css('display', 'block');
					}
					,function(){
						addDesplegable.children('.add-grande').css('display', 'none');
						addDesplegable.children('.add-chica').css('display', 'block');
					});
			} else {
				addDesplegable.css('display', 'none');
			}
		}


	});
}(jQuery));