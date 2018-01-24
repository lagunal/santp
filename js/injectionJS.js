var teclashift = false;

window.onload=function(e){

	cargarFunciones(e);
	
}

function cargarFunciones(e){
	form = document.forms[0];

	if(form){
		c = form.elements.length;
		activos = true;

		for (var i = 0; i < c; i++) {
			var e = form.elements[i];
			
			//if ((e.type == 'text' || e.type == 'password') && (!e.disabled)) {
			if ((e.type == 'text') || (e.type == 'textarea'))  {
		
				e.onkeyup = function (e){
					var e = window.event || e;
					if (e.keyCode==16)
						teclashift=false;
				}
				e.onkeydown = function(e){
					var e = window.event || e;
					if (e.keyCode==16)
						teclashift=true;
				
					ret = true;				

					if (teclashift)
						var caracteres = new Array(16,18,106,111,188,219,220,221,226,47,49,50,51,52,54,55);
					else
						var caracteres = new Array(16,18,106,219,220,221,226);
					
					c = caracteres.length;
					posicion = -1;

					for(i=0; i<c; i++)
						if (caracteres[i] == e.keyCode) 
							posicion = 1;
					if (posicion >= 0)
						ret = false;
					
					return ret;
				}
			}
		}
	}
}
