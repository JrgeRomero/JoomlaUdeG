if(!UDGMenuWidth)var UDGMenuWidth='970px';
var traerObjeto=function(objeto){try{if(typeof(objeto)=="object" || typeof(objeto)=="boolean"){return objeto;}else{return document.getElementById(objeto)}}catch(ex){}};
var traerContenido=function(objeto){try{return traerObjeto(objeto).innerHTML}catch(ex){}};
var insertar=function(objeto,html){try{return traerObjeto(objeto).innerHTML=html}catch(ex){}};
var insertarAtras=function(objeto,html){try{return traerObjeto(objeto).innerHTML=traerContenido(objeto)+html}catch(ex){}};
var insertarDelante=function(objeto,html){try{return traerObjeto(objeto).innerHTML=html+traerContenido(objeto)}catch(ex){}};
var elementoShow=function(objeto){try{traerObjeto(objeto).style.display="block"}catch(ex){}};
var elementoHide=function(objeto){try{traerObjeto(objeto).style.display="none"}catch(ex){}};
var TraerStyle=function(objeto, style) {
	element = traerObjeto(objeto);
    var value = element.style[style];
    if (!value && element.currentStyle) value = element.currentStyle[style];
    if (style == 'opacity') {
      if (value = (element.getStyle('filter') || '').match(/alpha\(opacity=(.*)\)/))
        if (value[1]) return parseFloat(value[1]) / 100;
      return 1.0;
    }
    if (value == 'auto') {
      if ((style == 'width' || style == 'height') && (element.getStyle('display') != 'none'))
        return element['offset' + style.capitalize()] + 'px';
      return null;
    }
    return value;
};
InsertarStyle=function(objeto, styles) {
	element = traerObjeto(objeto);
	var elementStyle = element.style, match;
	if (Object.isString(styles)) {
		element.style.cssText += ';' + styles;
		return styles.include('opacity') ?
		element.setOpacity(styles.match(/opacity:\s*(\d?\.?\d*)/)[1]) : element;
	}
	for (var property in styles)
	if (property == 'opacity') element.setOpacity(styles[property]);
	else
		elementStyle[(property == 'float' || property == 'cssFloat') ?
		(Object.isUndefined(elementStyle.styleFloat) ? 'cssFloat' : 'styleFloat') :
		property] = styles[property];
	return element;
};
var crearTag=function(){
	try{
		var html='<'+arguments[0],i=1,length=arguments.length;
		for (;i<length;i++){html+=' ' + arguments[i];}
		return html+"></"+arguments[0]+">";
	}catch(ex){}
};
var JSON2Object=function(json){try{return eval( "(" + json + ")" )}catch(ex){}};
var UDGMenuLlA=function(url,titulo){try{return '<li><a href="' + url + '">' + titulo + '</a></li>'}catch(ex){}};
var UDGMenuLlSpan=function(titulo){try{return '<li class="udg_menu_titulo">' + titulo + '</li>'}catch(ex){}};
var UDGMenuAcomodar=function(objeto){
	try{
		var topM=TraerStyle("udg_menu_principal_contenedor","top");
		var heightM=TraerStyle("udg_menu_principal_contenedor","height");
		if(!heightM && !topM)
		{
			var topM=traerObjeto("udg_menu_principal_contenedor").style.top;
			var heightM=traerObjeto("udg_menu_principal_contenedor").style.height;
			traerObjeto(objeto).style.top=(parseInt(topM)+parseInt(heightM));
		}
	}catch(ex){}
};
var UDGMenu=function(){
	try{
	/*
		objs = document.getElementsByTagName("body");
		for (var i=0; i<objs.length; i++){
			insertarAtras(objs[i],);
			insertarDelante(objs[i],crearTag('div','id="udg_menu_principal"'));
		}
		document.write(crearTag('link','href="http://www.udg.mx/menu/udg-menu.css" type="text/css" rel="stylesheet" media="all"'));
		document.write(crearTag('div','id="udg_menu_principal"'));
	*/
		insertarDelante('udg_menu_principal',crearTag('div','id="udg_menu_principal_contenedor"','style="width:'+UDGMenuWidth+';"'));
		insertarAtras('udg_menu_principal_contenedor',crearTag('ul','id="udg_menu_principal_ul"'));
		insertarAtras('udg_menu_principal_ul',crearTag('li','id="udg_menu_red_universidad_link"'));

		insertarAtras('udg_menu_red_universidad_link',crearTag('span','id="udg_menu_red_universidad_link_span"'));
		insertarAtras('udg_menu_red_universidad_link_span','Red universitaria');
		
		insertarAtras('udg_menu_red_universidad_link',crearTag('ul','id="udg_menu_red_universidad"'));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlSpan(''));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlA('http://www.udg.mx','Universidad de Guadalajara - www.udg.mx'));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlA('http://www.udg.mx/directorio','Directorio oficial'));
		
		insertarAtras('udg_menu_red_universidad',UDGMenuLlSpan('Centros universitarios temÃ¡ticos'));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlA('http://www.cuaad.udg.mx','CUAAD - Arte, Arquitectura y Dise&ntilde;o'));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlA('http://www.cucba.udg.mx','CUCBA - Ciencias Biol&oacute;gicas y Agropecuarias'));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlA('http://www.cucea.udg.mx','CUCEA - Ciencias Econ&oacute;mico Administrativas'));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlA('http://www.cucei.udg.mx','CUCEI - Ciencias Exactas e Ingenier&iacute;as'));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlA('http://www.cucs.udg.mx','CUCS - Ciencias de la Salud'));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlA('http://www.cucsh.udg.mx','CUCSH - Ciencias Sociales y Humanidades'));
		
		insertarAtras('udg_menu_red_universidad',UDGMenuLlSpan('Centros universitarios regionales'));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlA('http://www.cualtos.udg.mx','CUALTOS - Tepatitl&aacute;n de Morelos, Jalisco'));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlA('http://cuci.udg.mx','CUCI&Eacute;NEGA - Ocotl&aacute;n, Atotonilco, La Barca, Jalisco'));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlA('http://www.cuc.udg.mx','CUCOSTA - Puerto Vallarta, Tomatl&aacute;n, Jalisco'));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlA('http://www.lagos.udg.mx','CULAGOS - Lagos de Moreno, San Juan de los Lagos, Jalisco'));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlA('http://www.cucsur.udg.mx','CUCSUR - Autl&aacute;n de Navarro, Cihuatl&aacute;n, Jalisco'));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlA('http://www.cunorte.udg.mx','CUNORTE - Colotl&aacute;n, Jalisco'));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlA('http://www.cusur.udg.mx','CUSUR - Ciudad Guzm&aacute;n, Jalisco'));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlA('http://www.cuvalles.udg.mx','CUVALLES - Ameca, Jalisco'));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlA('http://www.cutonala.udg.mx','CUTONAL&Aacute; - Tonal&aacute;, Jalisco'));

		insertarAtras('udg_menu_red_universidad',UDGMenuLlSpan('Sistemas'));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlA('http://www.udgvirtual.udg.mx','UDG Virtual - Universidad virtual'));
		insertarAtras('udg_menu_red_universidad',UDGMenuLlA('http://www.sems.udg.mx','SEMS - Educaci&oacute;n media superior'));

		insertarAtras('udg_menu_principal_ul',crearTag('li','id="udg_menu_administracion_general_link"'));
		insertarAtras('udg_menu_administracion_general_link',crearTag('span','id="udg_menu_administracion_general_link_span"'));
		insertarAtras('udg_menu_administracion_general_link_span','Administraci&oacute;n y Gobierno');
		
		insertarAtras('udg_menu_administracion_general_link',crearTag('ul','id="udg_menu_administracion_general"'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.hcgu.udg.mx','Consejo General Universitario'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.rectoria.udg.mx','Rector&iacute;a General'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.vicerrectoria.udg.mx/','Vicerrector&iacute;a Ejecutiva'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.secgral.udg.mx/','Secretar&iacute;a General'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.contraloriageneral.udg.mx','Contralor&iacute;a General'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.abogadogeneral.udg.mx','Oficina del Abogado General'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.finanzas.udg.mx/','Finanzas'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlSpan('Coordinaciones'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.cga.udg.mx/','- Acad&eacute;mica'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.cgadm.udg.mx/','- Administrativa'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.comsoc.udg.mx/','- Comunicaci&oacute;n Social'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.escolar.udg.mx/','- Control Escolar'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.cgci.udg.mx/','- Cooperaci&oacute;n e Internacionalizaci&oacute;n'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.cei.udg.mx/','- Estudios Incorporados'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.cge.udg.mx/','- Extensi&oacute;n'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.patrimonio.udg.mx/','- Patrimonio'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.copladi.udg.mx/','- Planeaci&oacute;n y Desarrollo Institucional'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.cgrh.udg.mx/','- Recursos Humanos'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.seguridad.udg.mx/','- Seguridad Universitaria'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.cgsu.udg.mx/','- Servicios a Universitarios'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.cgti.udg.mx/','- Tecnolog&iacute;as de Informaci&oacute;n'));
		insertarAtras('udg_menu_administracion_general',UDGMenuLlA('http://www.transparencia.udg.mx/','- Transparencia'));

		insertarAtras('udg_menu_principal_ul',crearTag('li','id="udg_menu_otros_sitios_link"'));
		insertarAtras('udg_menu_otros_sitios_link',crearTag('span','id="udg_menu_otros_sitios_link_span"'));
		insertarAtras('udg_menu_otros_sitios_link_span','Otros sitios UdeG');
		/*insertarAtras('udg_menu_otros_sitios_link',crearTag('br'));*/

		insertarAtras('udg_menu_otros_sitios_link',crearTag('ul','id="udg_menu_otros_sitios"'));
		insertarAtras('udg_menu_otros_sitios',UDGMenuLlA('http://www.udg.mx/servicios/bibliotecas','Bibliotecas'));
		insertarAtras('udg_menu_otros_sitios',UDGMenuLlA('http://www.carteleraudg.medios.udg.mx/','Cartelera UDG'));
		insertarAtras('udg_menu_otros_sitios',UDGMenuLlA('http://cipv.cga.udg.mx/','CoordinaciÃ³n de Investigaci&oacute;n, Posgrado y Vinculaci&oacute;n'));
		insertarAtras('udg_menu_otros_sitios',UDGMenuLlA('http://www.cultura.udg.mx/','Cultura UDG'));
		insertarAtras('udg_menu_otros_sitios',UDGMenuLlA('https://www.fil.com.mx/','FIL - Feria Internacional del Cine en Guadalajara'));
		insertarAtras('udg_menu_otros_sitios',UDGMenuLlA('http://flip.cga.udg.mx/','FLIP - Foreign Languages Institutional Program'));
		insertarAtras('udg_menu_otros_sitios',UDGMenuLlA('http://fundacion.udg.mx/','Fundaci&oacute;n UDG'));
		insertarAtras('udg_menu_otros_sitios',UDGMenuLlA('http://www.gaceta.udg.mx/','Gaceta Universitaria'));
		insertarAtras('udg_menu_otros_sitios',UDGMenuLlA('http://leonesnegrosudg.mx','Leones Negros'));
		insertarAtras('udg_menu_otros_sitios',UDGMenuLlA('http://www.udg.mx/normatividad','Normatividad'));
		insertarAtras('udg_menu_otros_sitios',UDGMenuLlA('http://www.pregrado.udg.mx/','Portal de Programas Educativos de Pregrado'));
		insertarAtras('udg_menu_otros_sitios',UDGMenuLlA('http://www.radio.udg.mx/','Radio Universidad'));
		insertarAtras('udg_menu_otros_sitios',UDGMenuLlA('http://www.siiau.udg.mx','SIIAU'));
		insertarAtras('udg_menu_otros_sitios',UDGMenuLlA('http://www.udgtv.com/','TV UDG Canal 44'));
		insertarAtras('udg_menu_otros_sitios',UDGMenuLlA('http://www.udgusa.org','UDG Fundation USA'));
		

		insertarAtras('udg_menu_principal_ul',crearTag('li','id="udg-menu-logo"'));
		insertarAtras('udg-menu-logo',crearTag('a','href="http://www.udg.mx"','id="udg-menu-logo-link"','alt="Universidad de Guadalajara"'));
		//insertarAtras('udg-menu-logo-link',crearTag('img','id="logo-image"','alt="Universidad de Guadalajara"','src="http://www.udg.mx/menu/imagenes/udg-menu-logo.png"'));
		insertarAtras('udg-menu-logo-link',crearTag('img','id="logo-image"','alt="Universidad de Guadalajara"','src="https://wdg.biblio.udg.mx/menu_udg/menu_udgNEW/udg-menu-logo.png"'));

		traerObjeto('udg_menu_red_universidad_link').onmouseover=function(){UDGMenuAcomodar("udg_menu_red_universidad");elementoShow("udg_menu_red_universidad")};
		traerObjeto('udg_menu_red_universidad_link').onmouseout=function(){elementoHide("udg_menu_red_universidad")};
		traerObjeto('udg_menu_administracion_general_link').onmouseover=function(){UDGMenuAcomodar("udg_menu_administracion_general");elementoShow("udg_menu_administracion_general")};
		traerObjeto('udg_menu_administracion_general_link').onmouseout=function(){elementoHide("udg_menu_administracion_general")};
		traerObjeto('udg_menu_otros_sitios_link').onmouseover=function(){UDGMenuAcomodar("udg_menu_otros_sitios");elementoShow("udg_menu_otros_sitios")};
		traerObjeto('udg_menu_otros_sitios_link').onmouseout=function(){elementoHide("udg_menu_otros_sitios")};
	}catch(ex){}
};
var agregarEvento=function(objeto,actualEventName,responder){
	try{
		if (traerObjeto(objeto).addEventListener)
			traerObjeto(objeto).addEventListener(actualEventName, responder, false);
		else
			traerObjeto(objeto).attachEvent("on" + actualEventName, responder);
	}catch(ex){}
};
/*agregarEvento(window,'load',function(){UDGMenu()});*/
/*setTimeout( 'UDGMenu()', 5500);*/