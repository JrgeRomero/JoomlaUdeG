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
	var ultimofiltro = "QuitResearch01";
	var componenteLetraActual = null;
	jQuery(".sprocket-lists-portrait").hide();


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
	- Para que el filtro identifique los recursos y sus propiedades de búsqueda se tiene que agregar la siguiente linea por cada una:

	lista_atributos_bd.push("<nombre base de datos>%<area conocimiento 1>%<area... 2>%<area... 3%<area... 4>%<area... 5>%<lenguaje>%<tipo>");

	Como se puede observar, dentro del paréntesis existen ocho campos separados por "%", los cuales describen la información especifica a la que hace referencia y se deberán sustituir con la información necesaria.
	
	- En el primer campo se deberá escribir el nombre de la base de datos EXACTAMENTE como se encuentra en la lista original (contando caracteres especiales).

	- Los siguientes 5 campos pertenecen a las áreas del conocimiento a las cuales una base de datos o recurso informativo puede pertenecer, los campos se completan con número.
	
	A continuacion se describen los codigos de las areas del conocimiento:
	1 = FISICA, MATEMATICAS Y CIENCIAS DE LA TIERRA
	2 = BIOLOGIA Y QUIMICA
	3 = MEDICINA Y SALUD
	4 = HUMANIDADES Y DE LA CONDUCTA
	5 = SOCIALES Y ECONOMICAS
	6 = BIOTECNOLOGIA Y AGROPECUARIAS
	7 = INGENIERIA E INDUSTRIA
	
	Si una base de datos no se quiere relacionar a algún área del conocimiento o si sólo se requieren menos de los cinco campos disponibles se completan con 0 los sobrantes.

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

	// ************* LISTADO DE BASES DE DATOS CON SUS ATRIBUTOS PARA FILTRARLOS *******************

	//Bases de datos especializadas
	/*lista_atributos_bd.push("ABI/INFORM Collection%5%0%0%0%0%3%1");
	lista_atributos_bd.push("ACLAND ANATOMY%3%0%0%0%0%3%1");
	lista_atributos_bd.push("ACS Publications%2%0%0%0%0%2%1");
	lista_atributos_bd.push("Alliance of Crop, Soil, and Envirorement Science Societies%7%0%0%0%0%2%1");
	lista_atributos_bd.push("ASCE %7%0%0%0%0%2%1");
	lista_atributos_bd.push("Association for Computing Machinery%7%0%0%0%0%2%1");
	lista_atributos_bd.push("BioOne%2%0%0%0%0%2%1");
	lista_atributos_bd.push("Chemical Abstracts Service%2%0%0%0%0%2%1");
	lista_atributos_bd.push("ClinicalKey%3%0%0%0%0%2%1");
	lista_atributos_bd.push("Emerging Markets Information Service%5%0%0%0%0%3%1");
	lista_atributos_bd.push("Enferteca%3%0%0%0%0%1%1");
	lista_atributos_bd.push("Global Plants%2%6%0%0%0%2%3");
	lista_atributos_bd.push("IEEE Xplore%7%0%0%0%0%2%1");
	lista_atributos_bd.push("Inspec Direct%1%7%0%0%0%2%2");
	lista_atributos_bd.push("IOPscience%3%6%0%0%0%2%1");
	lista_atributos_bd.push("IQOM%5%0%0%0%0%1%1");
	lista_atributos_bd.push("Knovel%7%0%0%0%0%2%1");
	lista_atributos_bd.push("MathScinet%1%0%0%0%0%3%3");
	lista_atributos_bd.push("NANO%1%2%6%7%0%2%1");
	lista_atributos_bd.push("NNNConsult%3%0%0%0%0%1%1");
	lista_atributos_bd.push("OECD iLibrary%5%0%0%0%0%2%1");
	lista_atributos_bd.push("OvidSP MEDLINE%3%0%0%0%0%2%2");
	lista_atributos_bd.push("Patents Collection%5%7%0%0%0%3%1");
	lista_atributos_bd.push("Power Speak%4%0%0%0%0%3%3");
	lista_atributos_bd.push("Royal Society of Chemistry%1%2%0%0%0%2%1");
	lista_atributos_bd.push("Society for Industrial and Applied Mathematics%1%0%0%0%0%1%1");
	lista_atributos_bd.push("SPIE%1%6%0%0%0%2%1");
	lista_atributos_bd.push("Ulrichsweb%4%5%6%0%0%1%1");
	lista_atributos_bd.push("Up To Date%3%0%0%0%0%2%1");
	lista_atributos_bd.push("v|lex%5%0%0%0%0%1%1");
	lista_atributos_bd.push("World Newspaper Archive-Latin American%4%5%7%3%0%3%1");

	
	//Bases de datos multidisciplinarias
	lista_atributos_bd.push("Academic One File Unique%1%2%4%5%0%2%3");
	lista_atributos_bd.push("Annual Reviews%1%3%5%0%0%2%1");
	lista_atributos_bd.push("Bibliocolabora%1%2%4%5%0%1%1");
	lista_atributos_bd.push("CABI Suite%1%2%6%0%0%2%3");
	lista_atributos_bd.push("Cambridge Collection%3%5%0%0%0%2%1");
	lista_atributos_bd.push("EbscoHost Web%0%0%0%0%0%3%1");
	lista_atributos_bd.push("Emerald%5%0%0%0%0%2%3");
	lista_atributos_bd.push("Global eJournal Library%2%3%4%5%6%2%1");
	lista_atributos_bd.push("Global Issues in Context%3%5%0%0%0%2%1");
	lista_atributos_bd.push("Informe Académico%3%5%7%0%0%1%3");
	lista_atributos_bd.push("Ingenta connect%1%2%4%6%7%2%3");
	lista_atributos_bd.push("ISI Web of Knowledge (Web of Science, Current Contents Connect, Biological Abstracts)%4%5%0%0%0%2%2");
	lista_atributos_bd.push("JSTOR%4%5%0%0%0%2%3");
	lista_atributos_bd.push("Lippincott Williams & Wilkins%3%0%0%0%0%2%1");
	lista_atributos_bd.push("Ocenet Universitas%1%3%4%5%7%1%1");
	lista_atributos_bd.push("Oxford University Press%1%2%3%4%5%2%1");
	lista_atributos_bd.push("ProQuest Dissertations & Theses%3%4%5%7%0%3%3");
	lista_atributos_bd.push("Royal Society Publishing%1%2%0%0%0%2%1");
	lista_atributos_bd.push("Sage Journals%1%3%4%6%0%2%1");
	lista_atributos_bd.push("ScienceDirect%3%5%0%0%0%2%3");
	lista_atributos_bd.push("Scopus%3%4%5%7%0%2%2");
	lista_atributos_bd.push("Sitios Fuente%2%3%4%5%0%1%3");
	lista_atributos_bd.push("Taylor and Francis Journals%1%2%6%7%4%2%1");
	lista_atributos_bd.push("Springer Link%1%2%3%5%0%2%1");
	lista_atributos_bd.push("Springer Materials%1%2%7%0%0%2%1");
	lista_atributos_bd.push("Wiley%1%2%4%5%0%2%1");

	//Revistas electrónicas
	lista_atributos_bd.push("American Institute of Physics %1%0%0%0%0%2%1");
	lista_atributos_bd.push("American Mathematical Society Journals %1%0%0%0%0%2%1");
	lista_atributos_bd.push("American Physical Society physics %1%0%0%0%0%2%1");
	lista_atributos_bd.push("Chicago University Press%1%2%4%5%6%2%1");
	lista_atributos_bd.push("Drug Metabolism%2%3%0%0%0%2%1");
	lista_atributos_bd.push("EBSCO EJS%0%0%0%0%0%3%1");
	lista_atributos_bd.push("Global Jurist%5%0%0%0%0%2%1");
	lista_atributos_bd.push("Journal of Teaching in Physical Education%1%0%0%0%0%2%1");
	lista_atributos_bd.push("Nature%1%3%6%0%0%2%1");
	lista_atributos_bd.push("Plant Cell%2%0%0%0%0%2%1");
	lista_atributos_bd.push("Proceedings of the National Academy of Sciences of the United States of America%1%2%5%0%0%2%1");
	lista_atributos_bd.push("Proceso%4%5%0%0%0%1%1");
	lista_atributos_bd.push("Science Online%1%2%6%0%0%2%1");
	lista_atributos_bd.push("The Journal of the American Medical Association%3%0%0%0%0%2%1");
	lista_atributos_bd.push("The MIT Press Journals%4%5%7%0%0%2%1");

	//Libros electrónicos
	lista_atributos_bd.push("ASCE%7%0%0%0%0%2%1");
	lista_atributos_bd.push("Biblioteca Digital Alfaomega%5%7%0%0%0%1%1");
	lista_atributos_bd.push("Biblioteca Virtual Pearson%1%2%5%7%0%1%1");
	lista_atributos_bd.push("Bibliotechnia%3%4%7%0%0%1%1");
	lista_atributos_bd.push("Books In Print%1%3%4%5%6%2%2");
	lista_atributos_bd.push("CABI e-Books%2%6%0%0%0%2%1");
	lista_atributos_bd.push("Cengage Biblioteca Virtual%1%5%7%0%0%1%1");
	lista_atributos_bd.push("Digitalia%3%4%5%7%0%1%1");
	lista_atributos_bd.push("e-libro%1%3%5%7%0%1%1");
	lista_atributos_bd.push("Ebookenciclo%1%4%0%0%0%1%1");
	lista_atributos_bd.push("eBooks Collection%5%7%0%0%0%3%1");
	lista_atributos_bd.push("Editorial Medica Panamericana%2%3%0%0%0%1%1");
	lista_atributos_bd.push("Emerald eBook Series Collections%0%0%0%0%5%2%1");
	lista_atributos_bd.push("Eureka Medica Panamericana%3%0%0%0%0%1%1");
	lista_atributos_bd.push("Gale Virtual Reference Library%3%4%5%7%0%1%1");
	lista_atributos_bd.push("Librisite%0%0%0%0%0%1%1");
	lista_atributos_bd.push("Manual Moderno%3%4%0%0%0%1%1");
	lista_atributos_bd.push("McGraw Hill%7%0%0%0%0%1%1");
	lista_atributos_bd.push("MyiLibrary%4%5%6%7%0%2%1");
	lista_atributos_bd.push("OVID Books%3%0%0%0%0%1%1");
	lista_atributos_bd.push("OVID Español%3%0%0%0%0%1%1");
	lista_atributos_bd.push("Ra-Ma de la U%5%7%0%0%0%1%1");
	lista_atributos_bd.push("Science Direct Freedom Collection%3%5%0%0%0%2%3");
	lista_atributos_bd.push("Taylor and Francis CRCnetBASE%1%2%7%0%0%2%1");
	lista_atributos_bd.push("UNWTO Elibrary%5%0%0%0%0%3%1");
	lista_atributos_bd.push("World eBooks Library%4%0%0%0%0%2%1");*/

	//alert(lista_atributos_bd.length);
	
	function buscarAtributos(titulo){
		var encontrado = 0;
		for(var a = 0; a < lista_atributos_bd.length && encontrado == 0; a++){
			var partes = lista_atributos_bd[a].split("%");
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
		}
		return encontrado;
	}
		
	function buscar(cadena){
		//document.getElementById('bloquebusqueda').innerHTML=cadena;
		var valor_area = document.getElementById('boxareaconocimiento').value;
		var valor_idioma = document.getElementById('boxidioma').value;
		var valor_tipo = document.getElementById('boxtipo').value;
		//alert(valor_area);
		codigofinal = "";
		resultadoencontrado = 0;
		var contador = 0;
		codigofinal = codigofinal+"<div class=\"module-surround\"><div class=\"module-title colortitulos-ri\"><h2 class=\"title\"></h2></div><div class=\"module-content\"><div class=\"sprocket-lists-portrait\"><ul class=\"sprocket-lists-portrait-container\" data-lists-items=\"\">";
		for(var i = 0; i<=rows.length-2;i++){
			var textrow = rows[i].innerHTML;
			textrow = textrow.replace("opacity: 0; height: 0px;","opacity: 1; height: auto;");
			textrow = textrow.replace("<div class=\"sprocket-lists-portrait-item\"","<div class=\"sprocket-lists-portrait-item desplegadiv\"");
			textrow = textrow.replace("<h4 class=\"sprocket-lists-portrait-title\">","<h4 id=\"nombrebd"+contador+"\" class=\"sprocket-lists-portrait-title\">");
			textrow = textrow.replace("<a class=\"btn btn-info btn-mini\"","<a id=\"enlace"+contador+"\" class=\"btn btn-info\"");
			textrow = textrow.replace("<span class=\"portrait-image\">","<span id=\"imagenbd"+contador+"\" class=\"portrait-image\">");
			//document.write(textrow);
			if(cadena == "QuitResearch01"){
				if(componenteLetraActual != null){
					componenteLetraActual.removeClass("botonesfiltroActivo");
					componenteLetraActual.addClass("botonesfiltro");
					componenteLetraActual = null;
				}
				jQuery("#quitaresearch").hide();
				codigofinal = codigofinal+"<li id=\"fila"+contador+"\" class=\"active desplegarow\" >"+textrow+"</li>";
				resultadoencontrado = 1;
				contador++;
				ultimofiltro = "QuitResearch01";
				if((filtroarea == 0) && (filtroidioma == 0) && (filtrotipo == 0)){
					document.getElementById('boxareaconocimiento').selectedIndex = "0";
					document.getElementById('boxidioma').selectedIndex = "0";
					document.getElementById('boxtipo').selectedIndex = "0";
				}
			}
			else if(cadena == "#"){
				if((textrow.indexOf("Ir a 0")!=-1)||(textrow.indexOf("Ir a 1")!=-1)||(textrow.indexOf("Ir a 2")!=-1)||(textrow.indexOf("Ir a 3")!=-1)||(textrow.indexOf("Ir a 4")!=-1)||(textrow.indexOf("Ir a 5")!=-1)||(textrow.indexOf("Ir a 6")!=-1)||(textrow.indexOf("Ir a 7")!=-1)||(textrow.indexOf("Ir a 8")!=-1)||(textrow.indexOf("Ir a 9")!=-1)){
					jQuery("#quitaresearch").show();
					codigofinal = codigofinal+"<li id=\"fila"+contador+"\" class=\"active desplegarow\">"+textrow+"</li>";
					resultadoencontrado = 1;
					contador++;
					ultimofiltro = ""+cadena;
				}
			}
			//else if((textrow.indexOf("Ir a "+cadena)!=-1)||(textrow.indexOf("Ir a "+cadena.toLowerCase())!=-1)){  ----- Validación anterior por medio del boton
			else if((textrow.indexOf("portrait-title\">\n\t\t\t\t\t"+cadena)!=-1)||(textrow.indexOf("portrait-title\">\n\t\t\t\t\t"+cadena.toLowerCase())!=-1)){
				jQuery("#quitaresearch").show();
				codigofinal = codigofinal+"<li id=\"fila"+contador+"\" class=\"active desplegarow\">"+textrow+"</li>";
				resultadoencontrado = 1;
				contador++;
				ultimofiltro = ""+cadena;
        		}
      		}
		if(resultadoencontrado == 0){
			codigofinal = codigofinal+"<p><strong>No se encontradon resultados en la b&uacute;squeda.</strong></p>";
			jQuery("#quitaresearch").show();
		}
		codigofinal = codigofinal+"</ul></div></div></div>";
		document.getElementById('bloquebusqueda').innerHTML=codigofinal;
		

		//AGREGAR ENLACES A TITULOS E IMAGENES
		for(var i = 0; i<=rows.length-2;i++){
			console.log("NameButton:"+jQuery("#enlace"+i).text());
			if(jQuery("#enlace"+i).text() == ""){
				console.log("Sin boton");
			}
			else{
				jQuery("#enlace"+i).text(jQuery("#nombrebd"+i).text());
				console.log(jQuery("#nombrebd"+i).text());
				jQuery("#nombrebd"+i).text("");
				jQuery("#enlace"+i).appendTo("#nombrebd"+i);
				jQuery("#enlace"+i).removeClass("btn");
				jQuery("#enlace"+i).removeClass("btn-info");
				//jQuery("#enlace"+i).addClass("sprocket-lists-portrait-title");
				jQuery("#enlace"+i).addClass("titlesBD");

				//var textoimagen = jQuery("#imagenbd"+i).html();
				//jQuery("#imagenbd"+i).before(jQuery("#enlace"+i).clone());
				//jQuery("#enlace"+i+":first").text("");
				//console.log(textoimagen);
				//jQuery("#imagenbd"+i+"").replaceWith("<span id=\"imagenbd"+i+"\" class=\"portrait-image\">"+jQuery("#enlace"+i+":first").append(textoimagen)+"</span>");
				//jQuery("#imagenbd"+i+"").text("");
				//jQuery("#imagenbd"+i+"").html(jQuery("#enlace"+i+":first"));
			}
		}
		console.log(rows.length-2+" rows");
		//console.log(textoimagen);

		for(var j = 0; (j < contador) && (ultimofiltro != "QuitResearch01"); j++){
			var titulo = jQuery("#nombrebd"+j).text();
			if(buscarAtributos(titulo) == 1){
				//buscarAtributos(titulo);
				if((""+valor_area == ""+bdtemp.area1) || (""+valor_area == ""+bdtemp.area2) || (""+valor_area == ""+bdtemp.area3) || (""+valor_area == ""+bdtemp.area4) || (""+valor_area == ""+bdtemp.area5) || (""+valor_area == "empty")){
				}
				else if(ultimofiltro != "QuitResearch01"){
					jQuery("#fila"+j).hide();
				}
				if((""+valor_idioma == ""+bdtemp.lenguaje) || (""+valor_idioma == "empty")){
				}
				else if(ultimofiltro != "QuitResearch01"){
					jQuery("#fila"+j).hide();
				}
				if((""+valor_tipo == ""+bdtemp.tipo) || (""+valor_tipo == "empty")){
				}
				else if(ultimofiltro != "QuitResearch01"){
					jQuery("#fila"+j).hide();
				}
			}
		}
		if((filtroarea == 1) || (filtroidioma == 1) || (filtrotipo == 1)){
			jQuery("#quitaresearch").show();
			for(var j = 0; j < contador; j++){
				//alert("enter");
				var titulo = jQuery("#nombrebd"+j).text();
				if(buscarAtributos(titulo) == 1){
					//buscarAtributos(titulo);
					if((""+valor_area == ""+bdtemp.area1) || (""+valor_area == ""+bdtemp.area2) || (""+valor_area == ""+bdtemp.area3) || (""+valor_area == ""+bdtemp.area4) || (""+valor_area == ""+bdtemp.area5) || (""+valor_area == "empty")){
					}
					else {
						jQuery("#fila"+j).hide();
					}
					if((""+valor_idioma == ""+bdtemp.lenguaje) || (""+valor_idioma == "empty")){
					}
					else {
						jQuery("#fila"+j).hide();
					}
					if((""+valor_tipo == ""+bdtemp.tipo) || (""+valor_tipo == "empty")){
					}
					else {
						jQuery("#fila"+j).hide();
					}
				}
			}
		}
		filtroarea = 0;
		filtroidioma = 0;
		filtrotipo = 0;
		//alert("Name:"+t.toUpperCase());
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
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('#');blockLetter(this);\"># </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('A');blockLetter(this);\">A </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('B');blockLetter(this);\">B </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('C');blockLetter(this);\">C </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('D');blockLetter(this);\">D </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('E');blockLetter(this);\">E </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('F');blockLetter(this);\">F </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('G');blockLetter(this);\">G </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('H');blockLetter(this);\">H </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('I');blockLetter(this);\">I </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('J');blockLetter(this);\">J </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('K');blockLetter(this);\">K </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('L');blockLetter(this);\">L </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('M');blockLetter(this);\">M </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('N');blockLetter(this);\">N </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('O');blockLetter(this);\">O </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('P');blockLetter(this);\">P </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('Q');blockLetter(this);\">Q </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('R');blockLetter(this);\">R </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('S');blockLetter(this);\">S </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('T');blockLetter(this);\">T </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('U');blockLetter(this);\">U </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('V');blockLetter(this);\">V </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('W');blockLetter(this);\">W </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('X');blockLetter(this);\">X </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('Y');blockLetter(this);\">Y </a>");
	document.write("<a class=\"botonesfiltro\" onclick=\"javascript:buscar('Z');blockLetter(this);\">Z </a>");
	document.write("<div style=\"display:none;\">Filtrar por: <select id=\"boxareaconocimiento\" onchange=\"javascript:if(ultimofiltro != 'QuitResearch01'){buscar(''+ultimofiltro);}else{filtroarea=1;buscar('QuitResearch01');}\"><option value=\"empty\">- &Aacute;rea del conocimiento -</option><option value=\"1\">F&iacute;sica, Matem&aacute;ticas y Ciencias de la Tierra</option><option value=\"2\">Biolog&iacute;a y Qu&iacute;mica</option><option value=\"3\">Medicina y Salud</option><option value=\"4\">Humanidades y de la Conducta</option><option value=\"5\">Sociales y Econ&oacute;micas</option><option value=\"6\">Biotecnolog&iacute;a y Agropecuarias</option><option value=\"7\">Ingenier&iacute;a e Industria</option></select>&nbsp;");
	document.write("<select id=\"boxidioma\" onchange=\"javascript:if(ultimofiltro != 'QuitResearch01'){buscar(''+ultimofiltro);}else{filtroidioma=1;buscar('QuitResearch01');}\"><option value=\"empty\">- Idioma -</option><option value=\"1\">Español</option><option value=\"2\">Ingl&eacute;s</option><option value=\"3\">Español e Ingl&eacute;s</option></select>&nbsp;");
	document.write("<select id=\"boxtipo\" onchange=\"javascript:if(ultimofiltro != 'QuitResearch01'){buscar(''+ultimofiltro);}else{filtrotipo=1;buscar('QuitResearch01');}\"><option value=\"empty\">- Tipo -</option><option value=\"1\">Texto completo</option><option value=\"2\">Referencial</option><option value=\"3\">Texto completo y Referencial</option></select>&nbsp;");
	document.write("<br>");
	document.write("</div>");
	document.write("<a id=\"quitaresearch\" class=\"botonquitarbusqueda\" onclick=\"javascript:filtroarea=0;filtroidioma=0;filtrotipo=0;buscar('QuitResearch01')\"><b>Quitar filtros</b></a>");
	document.write("<div id=\"bloquebusqueda\"></div></div>");
	buscar('QuitResearch01');
	

	jQuery( document ).ready(function() {
    		console.log( "ready!" );
		buscar('QuitResearch01');
	});
	/*jQuery("#bloquebusqueda").mouseover(function(e){
    		var li1 = e.target.parentNode;
		var textclicrow = "";
		textclicrow = document.getElementById(''+li1.id).innerHTML;
		textclicrow = textclicrow.replace("opacity: 1; height: 40px;","opacity: 1; height: auto;");
		document.getElementById(''+li1.id).innerHTML = textclicrow;*/
		/*jQuery("#"+li.id).mouseover(function(e){
    			var li2 = e.target.parentNode;
			var textclicrow = "";
			textclicrow = document.getElementById(''+li.id).innerHTML;
			textclicrow = textclicrow.replace("opacity: 1; height: auto;","opacity: 1; height: 40px;");
			document.getElementById(''+li.id).innerHTML = textclicrow;
			//alert(document.getElementById(''+li.id).innerHTML);
		});*/
	//});
	

