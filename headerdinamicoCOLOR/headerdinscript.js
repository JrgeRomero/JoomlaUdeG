var expandido = 0; //--- VARIABLE QUE CONTROLA SI EL HEADER DINÁMICO ESTÁ O NO EXPANDIDO -----

//--- MUESTRA Y OCULTA EL HEADER DINÁMICO PARA ESCRITORIO Y MÓVILES -----
$(document).ready(function(){
	$(window).scroll(function(){
		expandido = 0;
		if($(this).scrollTop() > 200 && $(window).width() <= 900){
			$('headerD').addClass('headerdinmovil');
			$('headerD').addClass('headerdin');
			$('#rt-top').addClass('quitarheader');
			//$('#rt-header').addClass('quitarheader');
			$('#rt-header').addClass('ajustarbanner');
			$('menuMovilJM').addClass('ocultarmenujm');
			$('#rt-showcase').removeClass('ajustarbanner');
		}
		else if($(window).width() > 900 && $(this).scrollTop() < 200){
			$('headerD').removeClass('headerdinmovil');
			$('headerD').removeClass('headerdin');
			$('#rt-top').removeClass('quitarheader');
			$('#rt-header').removeClass('quitarheader');
			$('#rt-header').removeClass('ajustarbanner');
			$('#rt-showcase').removeClass('ajustarbanner');

		}
		else if($(this).scrollTop() > 200 && $(window).width() > 900){
			$('headerD').addClass('headerdin');
			$('#rt-top').addClass('quitarheader');
			$('#rt-header').addClass('quitarheader');
			$('#rt-header').addClass('ajustarbanner');
			$('#rt-showcase').addClass('ajustarbanner');
		}
		else{
			$('headerD').removeClass('headerdinmovil');
			$('headerD').removeClass('headerdin');
			$('#rt-top').removeClass('quitarheader');
			$('#rt-header').removeClass('quitarheader');
			$('#rt-header').removeClass('ajustarbanner');
			$('menuMovilJM').removeClass('ocultarmenujm');
			$('headerD').css({height:'0px'});
		}
		if($(this).scrollTop() > 200 && $(window).width() <= 1245){
			$('headerD').css({height:'50px'});
		}
		else if($(this).scrollTop() > 200 && $(window).width() > 1245){
			$('headerD').css({height:'50px'});
		}
	});
});

//--- AJUSTA EL HEADER DINÁMICO DEPENDIENDO LA RESOLUCION -----
function expandirHeaderDinamico(){
	if(expandido == 1){
		$('headerD').animate({height:'50px'});
		expandido = 0;
	}
	else if($(window).width() > 950 && $(window).width() <= 1245 && $(this).scrollTop() > 200 && expandido == 0){
		$('headerD').animate({height:'100px'});
		expandido = 1;
	}
	else if($(window).width() > 480 && $(window).width() <= 950 && $(this).scrollTop() > 200 && expandido == 0){
		$('headerD').animate({height:'150px'});
		expandido = 1;
	}
	else if($(window).width() > 348 && $(window).width() <= 480 && $(this).scrollTop() > 200 && expandido == 0){
		$('headerD').animate({height:'200px'});
		expandido = 1;
	}
	else if($(window).width() > 290 && $(window).width() <= 348 && $(this).scrollTop() > 200 && expandido == 0){
		$('headerD').animate({height:'250px'});
		expandido = 1;
	}
	else if($(window).width() <= 290 && $(this).scrollTop() > 200){
		$('headerD').animate({height:'330px'});
		expandido = 1;
	}
}