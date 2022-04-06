databases = new Array();
var text_html = "";
var main_url = "https://wdg.biblio.udg.mx/Mod_Tutoriales/";
//var main_url = "";

$( document ).ready(function() {

	cargaContenido();
	
	
	$("a.enlaceTuto").click(function(){
		//alert(this.id);
		$("#"+this.id+" > .tutoDialog").toggle();
		//cargarTutoriales(this.id);
	});
});

function cargaContenido(){
	var data = "";
	var posData = 0;
	
	fetch(main_url+"Data.txt")
		.then(res => res.text())
		.then(content => {
		
	data = content.split(/\n/);
		for(;posData < data.length;){
			if(data[posData].trim() == "NEW_BD"){
				console.log("Nueva base");
				posData = nuevaBaseTutos(posData,data);
				console.log("SALE:"+data[posData]);
				posData--;
			}
			posData++;
		}
		printContent();
		filtraSeccionesTutos();
	});
}

function nuevaBaseTutos(posData,data){
	posData++;
	var nombre = "";
	var categoria = "";
	var url_logo = "";
	var guias = "";
	var manuales = "";
	var videos = "";
	var capacitaciones = "";
	
	var cadena_separadora = "*";
	var cadena_rename = "rename";
	var cadena_order_list = "ol";
	var cadena_unorder_list = "ul";
	var cadena_icon = "icon";
	
	var order_list = false;
	var unorder_list = false;
	
	var style_list_line = false;
	var url_icon_tutos = "icons/icon_tutos.png";
	var url_icon_guide = "icons/icon_guide.png";
	var url_icon_manual = "icons/icon_manual.png";
	var url_icon_video = "icons/icon_video.png";
	var url_icon_caps = "icons/icon_caps.png";
	
	while(posData < data.length && data[posData].trim() != "NEW_BD"){
		switch(data[posData].trim()){
			case "INFO":
				posData++;
				posData = jumpRows(data,posData);
				//console.log(data[posData]);
				var info = data[posData].split(cadena_separadora);
				nombre = ""+info[0].trim();
				categoria = ""+info[1].trim();
				url_logo = "../../images/logosBD/"+info[2].trim();
				console.log(nombre);
				posData++;
				posData = jumpRows(data,posData);
				posData--;
				text_html += "<div class='registro db_"+categoria+"'><div class='area_logoT'><div class='center'><img class='img_logoT' src='"+url_logo+"'/></div></div><div class='area_files'><div id='"+nombre+"' class='titulodb'>"+nombre+"</div>";
			break;
			case "TUTOS":
				posData = readFileType(data,posData,"TUTOS",cadena_separadora,cadena_rename,cadena_order_list,cadena_unorder_list,cadena_icon,order_list,unorder_list,style_list_line,main_url+url_icon_tutos);
			break;
			case "GUIDE":
				posData = readFileType(data,posData,"GUIDE",cadena_separadora,cadena_rename,cadena_order_list,cadena_unorder_list,cadena_icon,order_list,unorder_list,style_list_line,main_url+url_icon_guide);
			break;
			case "MANUAL":
				posData = readFileType(data,posData,"MANUAL",cadena_separadora,cadena_rename,cadena_order_list,cadena_unorder_list,cadena_icon,order_list,unorder_list,style_list_line,main_url+url_icon_manual);
			break;
			case "VIDEO":
				posData = readFileType(data,posData,"VIDEO",cadena_separadora,cadena_rename,cadena_order_list,cadena_unorder_list,cadena_icon,order_list,unorder_list,style_list_line,main_url+url_icon_video);
			break;
			case "CAPS":
				posData = readFileType(data,posData,"CAPS",cadena_separadora,cadena_rename,cadena_order_list,cadena_unorder_list,cadena_icon,order_list,unorder_list,style_list_line,main_url+url_icon_caps);
			break;
		}
		posData++;
	}
	
	text_html += "</div></div>";
	databases.push(text_html);
	text_html = "";
	console.log("Out");
	return posData;
}

function jumpRows(data,posData){
	while(data[posData].trim() == "" || posData == data.length){
			posData++;
	}
	return posData;
}

function readFileType(data,posData,type,cadena_separadora,cadena_rename,cadena_order_list,cadena_unorder_list,cadena_icon,order_list,unorder_list,style_list_line,url_icon){
	var tipo_actual = type;
	var filetype = "";
	posData++;
	posData = jumpRows(data,posData);
	console.log(data[posData]);
	console.log(data[posData].startsWith(cadena_rename));
	if(data[posData].startsWith(cadena_rename)){ //Renombrar
		var titulo = data[posData].split(cadena_rename);
		if(data[posData].indexOf("put_icon") > -1){
			var split = titulo[1].split("*");
			filetype += "<div class='area_"+type+"'><img class='img_logoS' src='"+url_icon+"'/>&nbsp;<div class='section'><color_title_"+type+">"+split[split.length-2].trim()+"</color_title_"+type+"></div><br>";
		}
		else{
			filetype += "<div class='area_"+type+"'><div class='section'><color_title_"+type+">"+titulo[1].trim()+"</color_title_"+type+"></div><br>";
		}
		posData++;
	}
	else{
		if(type == "TUTOS")
			filetype += "<div class='area_"+type+"'><color_title_"+type+">Tutoriales</color_title_"+type+"><br>";
		else if(type == "GUIDE")
			filetype += "<div class='area_"+type+"'><color_title_"+type+">Guías</color_title_"+type+"><br>";
		else if(type == "MANUAL")
			filetype += "<div class='area_"+type+"'><color_title_"+type+">Manuales</color_title_"+type+"><br>";
		else if(type == "VIDEO")
			filetype += "<div class='area_"+type+"'><color_title_"+type+">Videos</color_title_"+type+"><br>";
		else if(type == "CAPS")
			filetype += "<div class='area_"+type+"'><color_title_"+type+">Capacitaciones</color_title_"+type+"><br>";
	}
	posData = jumpRows(data,posData);
	if(data[posData].startsWith(cadena_unorder_list)){ //lista sin orden
		unorder_list = true;
		if(data[posData].indexOf("icon") > -1){
			filetype += "<ul style='list-style-image: url("+url_icon+");'>";
		}
		else if(data[posData].indexOf("line") > -1){
			filetype += "<ul style='list-style:none; list-style-type: none;'>";
			style_list_line = true;
		}
		else if(data[posData].indexOf("point") > -1){
			filetype += "<ul style='list-style-type: circle;'>";
		}
		else if(data[posData].indexOf("box") > -1){
			filetype += "<ul style='list-style-type: square;'>";
		}
		else if(data[posData].indexOf("none") > -1){
			filetype += "<ul style='list-style-type: none;'>";
		}
		else{
			filetype += "<ul>";
		}
		posData++;
	}
	else if(data[posData].startsWith(cadena_order_list)){ //lista con orden
		order_list = true;
		filetype += "<ol>";
		posData++;
	}
	while(tipo_actual == type){
		posData = jumpRows(data,posData);
		console.log("ROW:"+data[posData]);
		if(data[posData].trim() == "TUTOS" || data[posData].trim() == "GUIDE" || data[posData].trim() == "MANUAL" || data[posData].trim() == "VIDEO" || data[posData].trim() == "CAPS" || data[posData].trim() == "NEW_BD" || data[posData].trim() == "END_FILE"){
			tipo_actual = "";
			posData--;
		}
		else{
			var regfiletype = data[posData].split(cadena_separadora);
			if(unorder_list == true || order_list == true){
				filetype += "<li>";
			}
			if(style_list_line == true && type == "VIDEO" && data[posData].indexOf("_localv") > -1){
				filetype += "<a_local class='enlacetuto "+type+"' style='text-decoration:none;' onclick='javascript:loadVideoTuto(\""+main_url+"video/"+regfiletype[1].trim()+"\");'>-&nbsp;"+regfiletype[0].trim()+"</a_local><br>";
			}
			else if(type == "VIDEO" && data[posData].indexOf("_localv") > -1){
				filetype += "<a_local class='enlacetuto "+type+"' style='text-decoration:none;' onclick='javascript:loadVideoTuto(\""+main_url+"video/"+regfiletype[1].trim()+"\");'>"+regfiletype[0].trim()+"</a_local><br>";
			}
			else if(style_list_line == true)
				filetype += "<a class='enlacetuto "+type+"' style='text-decoration:none;' href='"+regfiletype[1].trim()+"' target='_blank'>-&nbsp;"+regfiletype[0].trim()+"</a><br>";
			else
				filetype += "<a class='enlacetuto "+type+"' style='text-decoration:none;' href='"+regfiletype[1].trim()+"' target='_blank'>"+regfiletype[0].trim()+"</a><br>";
			if(unorder_list == true || order_list == true){
				filetype += "</li>";
			}
		}
		posData++;
		posData = jumpRows(data,posData);
		if(data[posData].trim() != "" && data[posData].indexOf("*") == -1){
			tipo_actual = "";
			posData--;
		}
		console.log("Length:"+data.length);
		console.log("Pos:"+posData);
	}
	if(unorder_list == true){
		regfiletype += "</ul>";
	}
	else if(order_list == true){
		regfiletype += "</ol>";
	}
	filetype += "</div>";
	console.log(""+type+":"+filetype);
	text_html += filetype;
	return posData;
}

function printContent(){
	var htmlt = "";
	for(var i=0; i < databases.length; i++ ){
		htmlt += databases[i];
	}
	$("#text").html(htmlt);
}

//FILTROS

function filtraSeccionesTutos(){
	var valor_seccion = document.getElementById('boxseccion').value;
	if(valor_seccion == -1){
		$(".registro").show();
	}
	else if(valor_seccion == 0){
		$(".registro").hide();
		$(".db_BD-ESP").show();
	}
	else if(valor_seccion == 1){
		$(".registro").hide();
		$(".db_BD-MULT").show();
	}
	else if(valor_seccion == 2){
		$(".registro").hide();
		$(".db_REVISTA-ELECTRONICA").show();
	}
	else if(valor_seccion == 3){
		$(".registro").hide();
		$(".db_LIBROS-ELECTRONICOS").show();
	}
	else if(valor_seccion == 4){
		$(".registro").hide();
		$(".db_OBRAS-DE-CONSULTA").show();
	}
	else if(valor_seccion == 5){
		$(".registro").hide();
		$(".db_REC-LIBRES").show();
	}
	else if(valor_seccion == 6){
		$(".registro").hide();
		$(".db_BD-PRUEBA").show();
	}
}

function filtraTutoriales(){
	$(".area_TUTOS").toggle();
}

function filtraGuias(){
	$(".area_GUIDE").toggle();
}

function filtraManuales(){
	$(".area_MANUAL").toggle();
}

function filtraVideos(){
	$(".area_VIDEO").toggle();
}

function filtraCaps(){
	$(".area_CAPS").toggle();
}

function buscarDBTutos(){
	var search = document.getElementById("search_dbtuto").value;
	console.log(search);
	if(search.trim() != ""){
		$(".registro").hide();
		$(".registro").each(function(index) {
			console.log(index + ": " + $(this).text());
			var reg = $(this).text();
			var lower = reg.toLowerCase();
			var searchlow = search.toLowerCase();
			if(lower.indexOf(searchlow) > -1 ){
				$(this).show();
			}
		});
	}
	else{
		filtraSeccionesTutos();
	}
}

//Video Player
function cerrarVideoPlayer(){
	$(".close_player").hide();
	$("#tutos_player").hide();
	var video = document.getElementById("player");
	video.pause();
    video.currentTime = 0;
}

function loadVideoTuto(url) {
	console.log("VIDEO"+$( window ).width());
	if($( window ).width() < 1024){
		$("#tutos_player").css("width","280px");
	}
    var video = document.getElementById("player");
    var sources = video.getElementsByTagName("source");
    sources[0].src = url;
    video.load();
	$(".close_player").show();
	$("#tutos_player").show();
    video.currentTime = 0;
	video.play();
}