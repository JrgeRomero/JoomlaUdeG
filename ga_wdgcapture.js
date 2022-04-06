function captureBD(type,bdreceive,CU,CARR){
	var BD = bdreceive;
	//alert('Registrando en GA,'+CU+','+CARR+','+BD);
	ga('send','event',type,'click',BD);
	ga('send','event',BD,'click', CU.concat("-",CARR));
}