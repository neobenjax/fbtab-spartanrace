<link rel="stylesheet" href="<?php echo $fullPath?>assets/css/normalize.css">
<link rel="stylesheet" href="<?php echo $fullPath?>assets/css/main.css">
<script src="<?php echo $fullPath?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
<!--link rel="stylesheet" href="<?php echo $fullPath?>assets/css/jquery-ui.css"-->
<!--script src='https://www.google.com/recaptcha/api.js'></script-->


<!-- Codigos de redimension para evitar brincos en aspecto visual al redimensionar  -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo $fullPath;?>assets/js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
<!--script src="<?php echo $fullPath;?>assets/js/vendor/jquery-ui.min.js"></script-->
<!-- Add fancyBox -->
<!--link rel="stylesheet" href="<?php echo $fullPath;?>assets/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" /-->
<!--script type="text/javascript" src="<?php echo $fullPath;?>assets/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script-->
<script type="text/javascript" src="<?php echo $fullPath;?>assets/js/jquery.validate.js"></script>
<!--script src="//connect.facebook.net/en_US/all.js"></script-->
<script src="https://use.typekit.net/air0aiw.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>

<script type="text/javascript">
	//DOCUMENT READY GLOBAL
	var FULLPATH = "<?php echo $fullPath?>",
	PAGINA = "<?php echo $pagina?>",
	SUBPAGINA = "<?php echo $subpagina?>",
	CATEGORIA = "<?php echo $categoria?>";

	$(document).on('keypress','[type="number"]',function(event){
	    if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
	        event.preventDefault();
	    }
	});

	/*$('#edad').keypress(function(event){
		console.log(event.which);
	    if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
	        event.preventDefault();
	    }
	});*/

	$(document).ready(function(){
		// VALIDA FORMULARIO DE REGISTRO

      $("#formRegistro").validate({

	        rules: {
	            // simple rule, converted to {required:true}
	            nombre: "required",
	            edad: {
		            	required: true,
		            	number: true,
		            	min:16,
		            	max:99
	            	},
	            e_mail: {
	                  required: true,
	                  email: true
	            }

	          },
	          messages: {
	                nombre:"Debes introducir tu nombre",
	                e_mail:{
	                        required: 'Debes ingresar tu correo electrónico',
	                        email: 'Debes ingresar un correo electrónico válido'
	                },
	                edad:{
	                        required: 'Debes ingresar tu edad',
	                        min: "Tu edad debe ser mayor a 15 años",
	                        max: "Tu edad debe ser creíble",
	                        number:"Solo números"
	                }
	          },
	          errorPlacement: function(error, element) {
	                error.appendTo(element.parent());
	          }



	    });

      	$("#formRegistro").submit(function(){

      		if($("#formRegistro").valid())
      		{	
	      		$.ajax({
	                    url: FULLPATH+'Controllers/functions.php',
	                    type:"POST",
	                    data: $( this ).serialize()+ "&act=addUser",
	                    success: function(data){
	                    	console.log(data);

	                        data = data.replace(/(\r\n|\n|\r)/gm,"").trim();

	                        if (data == '-1')
	                        {
	                            $('#errorMsg').html('El correo ya se encuentra registrado.');
	                        }
	                        else if (data == '0')
	                        {
	                            $('#errorMsg').html('Ha ocurrido un error inesperado.');
	                        }
	                        else if (data == '1')
	                        {
	                            $('#formRegistro')[0].reset();
	                            $('#errorMsg').html('Gracias por registrarte!');
	                        }
	                        else
	                        {
	                            $('#formRegistro')[0].reset();
	                            $('#errorMsg').html('Gracias por registrarte!');
	                        }


	                    },
	                    error: function(XMLHttpRequest, textStatus, errorThrown) {
	                        $('#errorMsg').html('Ha ocurrido un error inesperado');
	                        //alert("Status: " + textStatus); alert("Error: " + errorThrown);
	                    }
	                });

      		}
	        
      		return false;
      	});


	});

	function alertaFancy(titulo,mensaje,btnOk){
			contenidoMensaje = '<div class="contenedorAlertas"><div class="plecaTitulo">'+titulo+'</div><div class="textoAlerta">'+mensaje+'</div><div class="TXT_CENTER accionesConfirmLayer"><a href="#" class="btn border BG_BLANCO NEGRO cierreFancy">'+btnOk+'</a></div></div>';
			$.fancybox({padding:0,content:contenidoMensaje,closeBtn : false,modal:true});
	}

	$(document).on('click','.cierreFancy',function(event){
					event.preventDefault();
					$.fancybox.close();
	});


	function confirmFancy(titulo,mensaje,btnOk,btnCancel,inversa){
			if(!inversa)
					contenidoMensaje = '<div class="contenedorAlertas"><div class="plecaTitulo">'+titulo+'</div><div class="textoAlerta">'+mensaje+'</div><div class="TXT_LEFT accionesConfirmLayer"><a href="'+btnCancel.enlace+'" class="btn border BG_BLANCO NEGRO cierreFancy" id="no">'+btnCancel.texto+'</a><a href="'+btnOk.enlace+'" class="btn border_NEGRO BG_NEGRO BLANCO confirm F_RIGHT" id="si">'+btnOk.texto+'</a></div></div>';
			else
					contenidoMensaje = '<div class="contenedorAlertas"><div class="plecaTitulo">'+titulo+'</div><div class="textoAlerta">'+mensaje+'</div><div class="TXT_LEFT"><a href="'+btnOk.enlace+'" class="btn BG_NEGRO BLANCO confirm" id="si">'+btnOk.texto+'</a><a href="'+btnCancel.enlace+'" class="btn BG_NEGRO BLANCO cierreFancy" id="no">'+btnCancel.texto+'</a></div></div>';
			$.fancybox({padding:0,content:contenidoMensaje,closeBtn : false,modal:true,wrapCSS : 'customCloseLayer'});
	}
	function setCookie(cname, cvalue, exdays) {
			var d = new Date();
			d.setTime(d.getTime() + (exdays*24*60*60*1000));
			var expires = "expires="+d.toUTCString();
			document.cookie = cname + "=" + cvalue + "; " + expires;
	}

	function getCookie(cname) {
			var name = cname + "=";
			var ca = document.cookie.split(';');
			for(var i=0; i<ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0)==' ') c = c.substring(1);
					if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
			}
			return "";
	}

	function checkCookie(cname) {
			var cook = getCookie(cname);
			if (cook != "") {
					return cook;
			} else {
					return '';
			}
	}

	function isInt(value) {
	  var x;
	  if (isNaN(value)) {
	    return false;
	  }
	  x = parseFloat(value);
	  return (x | 0) === x;
	}

</script>