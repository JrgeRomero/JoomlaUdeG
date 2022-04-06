//filterscriptwdg.js V2
	
	var filtro = document.querySelectorAll("div.sprocket-lists-portrait");
	var textlist = ""+filtro[0].innerHTML;
	var rows = filtro[0].querySelectorAll("li");
	var codigofinal = "";
	var resultadoencontrado = 0;
	var lista_atributos_bd = [];
	var filtroletra = 0;
	var filtroarea = 0;
	var filtroidioma = 0;
	var filtrotipo = 0;
	var letrafiltrada = "";
	var componenteLetraActual = null;
	var duracionanimacionshow = 400;
	filtro[0].hide();


	function AtributosBaseDatos(nombrebd, area1, area2, area3, area4, area5, lenguaje, tipo) {
		this.nombrebd = nombrebd;
		this.area1 = area1;
		this.area2 = area2;
		this.area3 = area3;
		this.area4 = area4;
		this.area5 = area5;
		this.lenguaje = lenguaje;
		this.tipo = tipo;
	}

	/* *****************************  INFO ********************************************************
	- Para que el filtro identifique los recursos y sus propiedades de búsqueda se crea un objeto automáticamente con las siguientes propiedades:

	lista_atributos_bd.push("<nombre base de datos>%<area conocimiento 1>%<area... 2>%<area... 3%<area... 4>%<area... 5>%<lenguaje>%<tipo>");

	Como se puede observar, dentro del paréntesis existen ocho campos separados por "%", los cuales describen la información especifica a la que hace referencia y se deberán sustituir con la información necesaria.
	
	- En el primer campo se deberá escribir el nombre de la base de datos EXACTAMENTE como se encuentra en la lista original (contando caracteres especiales).

	- Los siguientes 5 campos pertenecen a las áreas del conocimiento a las cuales una base de datos o recurso informativo puede pertenecer, los campos se completan con número.
	
	- El área de conocimiento se debe agregar en un <div class="areacon"><areas en numero separadas por ',' (máximo 5)></div> en el artículo de la base de datos
	
	A continuacion se describen los codigos de las areas del conocimiento:
	1 = FISICA, MATEMATICAS Y CIENCIAS DE LA TIERRA
	2 = BIOLOGIA Y QUIMICA
	3 = MEDICINA Y SALUD
	4 = HUMANIDADES Y DE LA CONDUCTA
	5 = SOCIALES Y ECONOMICAS
	6 = BIOTECNOLOGIA Y AGROPECUARIAS
	7 = INGENIERIA E INDUSTRIA
	
	Si una base de datos no se quiere relacionar a algún área del conocimiento o si sólo se requieren menos de los cinco campos disponibles se completan con 0 los sobrantes de forma automática.

	- El siguiente campo pertenece al lenguaje o idioma del recurso, se completa con número según corresponda:
	1 = Español
	2 = Inglés
	3 = Español e Inglés

	- El último campo pertenece al tipo de recurso, se completa con número según corresponda:
	1 = Texto Completo
	2 = Referencial
	3 = Texto Completo y Referencial

	*/
	
	
	var bdtemp = new AtributosBaseDatos(" "," "," "," "," "," "," "," ");

	function buscarAtributos(titulo,row){
		var encontrado = 0;
		var partes = lista_atributos_bd[row].split("%");
		if(titulo.toUpperCase().trim() == partes[0].toUpperCase().trim()){
			encontrado = 1;
			bdtemp.nombrebd = partes[0].trim();
			bdtemp.area1 = partes[1].trim();
			bdtemp.area2 = partes[2].trim();
			bdtemp.area3 = partes[3].trim();
			bdtemp.area4 = partes[4].trim();
			bdtemp.area5 = partes[5].trim();
			bdtemp.lenguaje = partes[6].trim();
			bdtemp.tipo = partes[7].trim();
		}
		else{
			bdtemp.nombrebd = "";
			bdtemp.area1 = "";
			bdtemp.area2 = "";
			bdtemp.area3 = "";
			bdtemp.area4 = "";
			bdtemp.area5 = "";
			bdtemp.lenguaje = "";
			bdtemp.tipo = "";
		}
		return encontrado;
	}
		
	function construir(cadena){
		var valor_area = document.getElementById('boxareaconocimiento').value;
		var valor_idioma = document.getElementById('boxidioma').value;
		var valor_tipo = document.getElementById('boxtipo').value;
		codigofinal = "";
		var contador = 0;
		codigofinal = codigofinal+"<div class=\"module-surround\"><div class=\"module-title colortitulos-ri\"><h2 class=\"title\"></h2></div><div class=\"module-content\"><div class=\"sprocket-lists-portrait\"><ul class=\"sprocket-lists-portrait-container\" data-lists-items=\"\">";
		for(var i = 0; i<=rows.length-2;i++){
			var textrow = rows[i].innerHTML;
			textrow = textrow.replace("opacity: 0; height: 0px;","opacity: 1; height: auto;");
			textrow = textrow.replace("<div class=\"sprocket-lists-portrait-item\"","<div class=\"sprocket-lists-portrait-item desplegadiv\"");
			textrow = textrow.replace("<h4 class=\"sprocket-lists-portrait-title\">","<h4 id=\"nombrebd"+contador+"\" class=\"sprocket-lists-portrait-title\">");
			textrow = textrow.replace("<a class=\"btn btn-info\"","<a id=\"enlace"+contador+"\" class=\"btn btn-info\"");
			textrow = textrow.replace("<span class=\"portrait-image\">","<span id=\"imagenbd"+contador+"\" class=\"portrait-image\">");
			if(cadena == "QuitResearch01"){
				jQuery("#quitaresearch").hide();
				codigofinal = codigofinal+"<li id=\"fila"+contador+"\" class=\"active desplegarow\" >"+textrow+"</li>";
				contador++;
				ultimofiltro = "QuitResearch01";
				if((filtroarea == 0) && (filtroidioma == 0) && (filtrotipo == 0)){
					document.getElementById('boxareaconocimiento').selectedIndex = "0";
					document.getElementById('boxidioma').selectedIndex = "0";
					document.getElementById('boxtipo').selectedIndex = "0";
				}
			}
      	}
		codigofinal = codigofinal+"<div id=\"sinresultados\"><p><strong>No se encontradon resultados en la b&uacute;squeda.</strong></p></div></ul></div></div></div>";
		document.getElementById('bloquebusqueda').innerHTML=codigofinal;
		jQuery("#sinresultados").hide();

		//AGREGAR ENLACES A TITULOS E IMAGENES
		for(var i = 0; i<=rows.length-2;i++){
			//console.log("RowButton:"+i+",NameButton:"+jQuery("#enlace"+i).text());
			if(jQuery("#enlace"+i).text() == ""){
				console.log("Sin boton");
			}
			else{
				jQuery("#enlace"+i).text(jQuery("#nombrebd"+i).text());
				//console.log(jQuery("#nombrebd"+i).text());
				jQuery("#nombrebd"+i).text("");
				jQuery("#enlace"+i).appendTo("#nombrebd"+i);
				jQuery("#enlace"+i).removeClass("btn");
				jQuery("#enlace"+i).removeClass("btn-info");
				//jQuery("#enlace"+i).addClass("sprocket-lists-portrait-title");
				jQuery("#enlace"+i).addClass("titlesBD");

				var textoimagen = jQuery("#imagenbd"+i).html();
				jQuery("#imagenbd"+i).before(jQuery("#enlace"+i).clone());
				jQuery("#enlace"+i+":first").text("");
				//console.log(textoimagen);
				jQuery("#imagenbd"+i+"").replaceWith("<span id=\"imagenbd"+i+"\" class=\"portrait-image\">"+jQuery("#enlace"+i+":first").append(textoimagen)+"</span>");
				jQuery("#imagenbd"+i+"").text("");
				jQuery("#imagenbd"+i+"").html(jQuery("#enlace"+i+":first"));
			}
		}
		//console.log(rows.length-2+" rows");
		//console.log(textoimagen);

		filtroarea = 0;
		filtroidioma = 0;
		filtrotipo = 0;
	}
	
	function buscar(cadena){
		resultadoencontrado = 0;
		jQuery("#quitaresearch").slideDown(duracionanimacionshow);
		jQuery("#sinresultados").hide();
		var valor_area = document.getElementById('boxareaconocimiento').value;
		var valor_idioma = document.getElementById('boxidioma').value;
		var valor_tipo = document.getElementById('boxtipo').value;
		
		if((filtroarea != 0 || filtroidioma != 0 || filtrotipo != 0 || letrafiltrada != "") && cadena != "QuitResearch01"){
			var titulo = "";
			for(var i = 0; i<=rows.length-2; i++){				
				titulo = jQuery("#nombrebd"+i).text();
				titulo = titulo.trim();
				//console.log(titulo);
				jQuery("#fila"+i).hide();
				
				if(letrafiltrada != ""){
					//BUSCAR POR SELECTORES CON LETRA O NUMERO ESPECIFICADO
					var textrow = rows[i].innerHTML;
					
					if(buscarAtributos(titulo,i) == 1){
						if(letrafiltrada == "#" && (((""+valor_area == ""+bdtemp.area1) || (""+valor_area == ""+bdtemp.area2) || (""+valor_area == ""+bdtemp.area3) || (""+valor_area == ""+bdtemp.area4) || (""+valor_area == ""+bdtemp.area5) || (""+valor_area == "empty"))
							&& ((""+valor_idioma == ""+bdtemp.lenguaje || ""+valor_idioma == "empty") || ( (""+valor_idioma == "1" || ""+valor_idioma == "2") && bdtemp.lenguaje == "3")) 
							&& ((""+valor_tipo == ""+bdtemp.tipo || ""+valor_tipo == "empty") || ( (""+valor_tipo == "1" || ""+valor_tipo == "2") && bdtemp.tipo == "3"))
							&& (((textrow.indexOf("Ir a 0")!=-1)||(textrow.indexOf("Ir a 1")!=-1)||(textrow.indexOf("Ir a 2")!=-1)||(textrow.indexOf("Ir a 3")!=-1)||(textrow.indexOf("Ir a 4")!=-1)||(textrow.indexOf("Ir a 5")!=-1)||(textrow.indexOf("Ir a 6")!=-1)||(textrow.indexOf("Ir a 7")!=-1)||(textrow.indexOf("Ir a 8")!=-1)||(textrow.indexOf("Ir a 9")!=-1))))){
								resultadoencontrado = 1;
								jQuery("#fila"+i).slideDown(duracionanimacionshow);
							}
						else if(((""+valor_area == ""+bdtemp.area1) || (""+valor_area == ""+bdtemp.area2) || (""+valor_area == ""+bdtemp.area3) || (""+valor_area == ""+bdtemp.area4) || (""+valor_area == ""+bdtemp.area5) || (""+valor_area == "empty"))
							&& ((""+valor_idioma == ""+bdtemp.lenguaje || ""+valor_idioma == "empty") || ( (""+valor_idioma == "1" || ""+valor_idioma == "2") && bdtemp.lenguaje == "3")) 
							&& ((""+valor_tipo == ""+bdtemp.tipo || ""+valor_tipo == "empty") || ( (""+valor_tipo == "1" || ""+valor_tipo == "2") && bdtemp.tipo == "3"))
							&& ((textrow.indexOf("portrait-title\">\n\t\t\t\t\t"+letrafiltrada)!=-1)||(textrow.indexOf("portrait-title\">\n\t\t\t\t\t"+letrafiltrada.toLowerCase()))!=-1)){
								resultadoencontrado = 1;
								jQuery("#fila"+i).slideDown(duracionanimacionshow);
							}
					}
				}
				else{
					//BUSCAR SOLO POR SELECTORES
					if(buscarAtributos(titulo,i) == 1){
						if(((""+valor_area == ""+bdtemp.area1) || (""+valor_area == ""+bdtemp.area2) || (""+valor_area == ""+bdtemp.area3) || (""+valor_area == ""+bdtemp.area4) || (""+valor_area == ""+bdtemp.area5) || (""+valor_area == "empty"))
							&& ((""+valor_idioma == ""+bdtemp.lenguaje || ""+valor_idioma == "empty") || ( (""+valor_idioma == "1" || ""+valor_idioma == "2") && bdtemp.lenguaje == "3")) 
							&& ((""+valor_tipo == ""+bdtemp.tipo || ""+valor_tipo == "empty") || ( (""+valor_tipo == "1" || ""+valor_tipo == "2") && bdtemp.tipo == "3"))){
								resultadoencontrado = 1;
								jQuery("#fila"+i).slideDown(duracionanimacionshow);
							}
					}
				}
			}
			if(resultadoencontrado == 0){
				console.log("Sin resultados");
				jQuery('#sinresultados').slideDown(duracionanimacionshow);
			}
		}
		else if((filtroarea == 0) && (filtroidioma == 0) && (filtrotipo == 0)){
			document.getElementById('boxareaconocimiento').selectedIndex = "0";
			document.getElementById('boxidioma').selectedIndex = "0";
			document.getElementById('boxtipo').selectedIndex = "0";
			letrafiltrada = "";
			jQuery("#quitaresearch").hide(duracionanimacionshow);
			if(cadena == "QuitResearch01"){
				componenteLetraActual.removeClass("botonesfiltroActivo");
				componenteLetraActual.addClass("botonesfiltro");
				componenteLetraActual = null;
				for(var i = 0; i<=rows.length-2; i++){
					jQuery("#fila"+i).slideDown(duracionanimacionshow);
				}
			}
		}
	}
	
	function buscarAlfaNum(cadena){
		jQuery("#quitaresearch").show();
		letrafiltrada = cadena;
		buscar('');
	}
	
	function createAreaConocimientoFilter(textrow, row){
		if(textrow.indexOf('class="areacon"')!=-1){
			//console.log("Atributo Area Conocimiento encontrado");
			var divElement = row.getElementsByClassName("areacon");
			var areatext = divElement[0].innerHTML.trim();
			var contador = 1;
			//Multiples areas
			if(areatext.indexOf(',')!=-1){
				var arrayareas = areatext.split(',');
				areatext = "";
				for(var i = 1;i <= arrayareas.length;i++){
					areatext = areatext + arrayareas[i-1];
					if(contador < arrayareas.length){
						areatext = areatext + "%";
						contador++;
					}
					else
						areatext = areatext;
				}
			}
			for(var i = 1;contador <= 5;i++){
				contador++;
				if(contador <= 5)
					areatext = areatext + "%0";
			}
			//console.log("AREA:"+areatext);
			return areatext;
		}
		return "0%0%0%0%0";
	}
	
	function createLangFilter(textrow){
		var spa = false;
		var eng = false;
		var spaeng = false;
		var lang = "0";
		if(textrow.indexOf('title="Español"')!=-1){
			//console.log("Atributo Español encontrado");
			spa = true;
			lang = "1";
		}
		if(textrow.indexOf('title="Inglés"')!=-1){
			//console.log("Atributo Inglés encontrado");
			eng = true;
			lang = "2";
		}
		if(spa == true && eng == true){
			lang = "3";		
		}
		return lang;
	}
	
	
	function createTypeFilter(textrow){
		var tc = false;
		var ref = false;
		var tyr = false;
		var type = "0";
		if(textrow.indexOf('title="Texto Completo"')!=-1){
			//console.log("Atributo Texto completo encontrado");
			tc = true;
			type = "1";
		}
		if(textrow.indexOf('title="Referencial"')!=-1){
			//console.log("Atributo Referencial encontrado");
			ref = true;
			type = "2";
		}
		if(tc == true && ref == true){
			type = "3";		
		}
		return type;
	}
	
	function createFilterObject(row){
		var textrow = row.innerHTML;
		var divtitle = row.getElementsByClassName("sprocket-lists-portrait-title");
		var nombrebd = divtitle[0].innerHTML.trim();
		var areascon = createAreaConocimientoFilter(textrow,row);
		var lenguaje = createLangFilter(textrow);
		var tipo = createTypeFilter(textrow);
		var filterStringObjtect = ""+nombrebd+"%"+areascon+"%"+lenguaje+"%"+tipo;
		//console.log("Object:"+filterStringObjtect);
		//lista_atributos_bd.push("ABI/INFORM Collection%5%0%0%0%0%3%1");
		lista_atributos_bd.push(filterStringObjtect);
	}
	
	//console.log("ROWS:"+rows.length);
	//console.log("ROW:"+rows[0].innerHTML);
	
	for(var i = 0; i<=rows.length-2; i++){
		createFilterObject(rows[i]);
	}
	
	function blockLetter(component){
		if(componenteLetraActual != null){
			componenteLetraActual.removeClass("botonesfiltroActivo");
			componenteLetraActual.addClass("botonesfiltro");
		}
		componenteLetraActual = component;
		component.removeClass("botonesfiltro");
		component.addClass("botonesfiltroActivo");
	}
	
	document.write("<div id=\"bloquefiltros\"><div>Filtrar por letra:</div>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('#');blockLetter(this);\"># </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('A');blockLetter(this);\">A </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('B');blockLetter(this);\">B </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('C');blockLetter(this);\">C </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('D');blockLetter(this);\">D </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('E');blockLetter(this);\">E </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('F');blockLetter(this);\">F </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('G');blockLetter(this);\">G </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('H');blockLetter(this);\">H </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('I');blockLetter(this);\">I </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('J');blockLetter(this);\">J </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('K');blockLetter(this);\">K </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('L');blockLetter(this);\">L </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('M');blockLetter(this);\">M </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('N');blockLetter(this);\">N </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('O');blockLetter(this);\">O </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('P');blockLetter(this);\">P </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('Q');blockLetter(this);\">Q </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('R');blockLetter(this);\">R </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('S');blockLetter(this);\">S </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('T');blockLetter(this);\">T </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('U');blockLetter(this);\">U </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('V');blockLetter(this);\">V </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('W');blockLetter(this);\">W </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('X');blockLetter(this);\">X </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('Y');blockLetter(this);\">Y </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscarAlfaNum('Z');blockLetter(this);\">Z </a>");
	document.write("<br>");	
	document.write("<div>Filtrar por: <select id=\"boxareaconocimiento\" onchange=\"javascript:filtroarea=1;buscar('');\"><option value=\"empty\">- &Aacute;rea del conocimiento -</option><option value=\"1\">F&iacute;sica, Matem&aacute;ticas y Ciencias de la Tierra</option><option value=\"2\">Biolog&iacute;a y Qu&iacute;mica</option><option value=\"3\">Medicina y Salud</option><option value=\"4\">Humanidades y de la Conducta</option><option value=\"5\">Sociales y Econ&oacute;micas</option><option value=\"6\">Biotecnolog&iacute;a y Agropecuarias</option><option value=\"7\">Ingenier&iacute;a e Industria</option></select>&nbsp;");
	document.write("<select id=\"boxespecialidad\" onchange=\"javascript:\"><option value=\"empty\">- Especialidad -</option></select>&nbsp;");
	document.write("<select id=\"boxidioma\" onchange=\"javascript:filtroidioma=1;buscar('');\"><option value=\"empty\">- Idioma -</option><option value=\"1\">Español</option><option value=\"2\">Ingl&eacute;s</option><option value=\"3\">Español e Ingl&eacute;s</option></select>&nbsp;");
	document.write("<select id=\"boxtipo\" onchange=\"javascript:filtrotipo=1;buscar('');\"><option value=\"empty\">- Tipo -</option><option value=\"1\">Texto completo</option><option value=\"2\">Referencial</option><option value=\"3\">Texto completo y Referencial</option></select>&nbsp;");
	document.write("<a id=\"quitaresearch\" class=\"botonquitarbusqueda\" onclick=\"javascript:filtroarea=0;filtroidioma=0;filtrotipo=0;buscar('QuitResearch01');\"><b>Quitar filtros</b></a>");
	document.write("</div>");
	document.write("<div id=\"bloquebusqueda\"></div></div>");
	

	jQuery( document ).ready(function() {
		construir('QuitResearch01');
	});