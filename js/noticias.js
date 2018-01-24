function verNoticias(tipo){
	forma = document.forms[0];
	frame = document.getElementById('frmNormas');
    ruta = "";
	
	noticias = document.getElementById('lnkNoticias');
	ultimas = document.getElementById('lnkUltimas');
	inicio = document.getElementById('lnkInicio');
	
	noticias.setAttribute( 'className', 'link_blanco');
	noticias.setAttribute( 'class', 'link_blanco');
	ultimas.setAttribute( 'className', 'link_blanco');
	ultimas.setAttribute( 'class', 'link_blanco');
	inicio.setAttribute( 'className', 'link_blanco');
	inicio.setAttribute( 'class', 'link_blanco');
    //document.getElementById('lnkNoticias').setAttribute( 'class', 'link_blanco_sel');
	//forma.lnkNoticias.setAttribute( 'class', 'link_blanco_sel');
	//forma.document.lnkNoticias.setAttribute( 'class', 'link_blanco_sel');
	/*
	document.getElementById('lnkNoticias').setAttribute( 'class', 'link_blanco');
	document.getElementById('lnkUltimas').setAttribute( 'class', 'link_blanco');
	document.getElementById('lnkInicio').setAttribute( 'class', 'link_blanco');
	*/
	
	switch(tipo) {
		case 0:
			ruta = "../controles/indiceNormas.php?rec=0";
		break;
		case 1:
			ruta = "../controles/indiceNormas.php?noti=1";
			noticias.setAttribute( 'className', 'link_blanco_sel');
			noticias.setAttribute( 'class', 'link_blanco_sel');
		break;
		case 2:
			ruta = "../controles/indiceNormas.php?rec=1";
			ultimas.setAttribute( 'className', 'link_blanco_sel');
			ultimas.setAttribute( 'class', 'link_blanco_sel');
		break;
	}

	frame.src = ruta;
}

function verNoticiasOtro(){
	window.location = "principal.php?noti=1";
}

function verUltimasOtro(){
	window.location = "principal.php?rec=1";
}

