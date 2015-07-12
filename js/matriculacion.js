
			function mates4(identificador){
				var identificador='#'+identificador;
				if(identificador=='#mat_b1'){
					$(identificador).html('<div><input name="MAT4" type="radio" value="MATA" onclick="infoMates4(this.value);">Matemát.A<br/><input name="MAT4" type="radio" value="MATB"  onclick="infoMates4(this.value);">Matemát.B</div>');
					$("#mat_b2").html("");	
				}else if(identificador=='#mat_b2'){
					$(identificador).html('<div><input name="MAT4" type="radio" value="MATA"  onclick="infoMates4(this.value);">Matemát.A<br/><input name="MAT4" type="radio" value="MATB" onclick="infoMates4(this.value);">Matemát.B</div>');
					$("#mat_b1").html("");
				}else{
					$("#mat_b1").html("");
					$("#mat_b2").html("");
				}		
			}
			
	
			function imprimirMatricula(){
			
				var codigo= $("#codigo").val();
				location.href="generaImpreso.php?matricula="+codigo;
			}

			function rellenarDatos(variable,id){
			  var id="#" + id;
              var input = $( id );
			  input.val( variable );
                     
			}
			
			
			function eligeModalidad(valor){
				var valor=valor;

				if(valor=='C'){
					var opcion="Biología y Geología;Dibujo Técnico I";
					$('#titulo3').html('Elige una opción<div id="optativas1"></div>');
					var tin='<li id="tin">Tecn. Industrial I</li>';
					$('#lista_optativas').append(tin);
				}else if(valor=='S' || valor=='H'){
					
					var opcion = "Economía;Griego I;Literatura Universal";
					$('#titulo3').html('Elige una opción<div id="optativas1"></div>');
					$('#tin').remove(tin);
				}
				
				var opcion = opcion.split(';');
				var num=opcion.length;
				alert(num);
					for (var i = 0; i < num; i++) {
						if (i==0){
						//$('#optativas1').append('<div id="separador"></div>');
						}
					rel= '<div id="excluye"><input type="radio" class="radio" id="opcion" name="opcion" value="'+i+'" onclick="autorizaopcion('+i+');">' + opcion[i] + '</div>';
					$('#optativas1').append(rel);
					}

			}
			
			function eligeModalidad_ca(valor){
				var valor=valor;
				$('#optativas1_ca').remove();

				if(valor=='C'){
					var opcion="Biología y Geología;Dibujo Técnico I";
					$('#titulo3_ca').html('Elige una opción<div id="optativas1_ca"></div>');
					var tin='<li id="tin">Tecn. Industrial I</li>';
					$('#lista_optativas_ca').append(tin);
				}else if(valor=='S' || valor=='H'){					
					var opcion = "Economía;Griego I;Literatura Universal";
					$('#titulo3_ca').html('Elige una opción<div id="optativas1_ca"></div>');
					$('#tin').remove(tin);
				}
				
				var opcion = opcion.split(';');
				var num=opcion.length;
					for (var i = 0; i < num; i++){
						if (i==0){
						//$('#optativas1').append('<div id="separador"></div>');
						}
					rel= '<div id="excluye"><input type="radio" class="radio" id="opcion" name="opcion" value="'+i+'" onclick="autorizaopcion('+i+');">' + opcion[i] + '</div>';
					$('#optativas1_ca').append(rel);
					}
			}
			
			function modalidadE4(valor,repetidor){
					var modalidad="<div id='opcion4'><div id='tit_opcionE4'><input type='radio' class='radio' id='b1' name='modalidad_ca' value='A1' onclick='mates4(\"B\");eligeModalidad(this.value);'>A1</div><ul><li>Matemáticas B</li><li>Biol. y Geol.</li><li>Física y Quím.</li><li>Francés</li></ul></div>";
					modalidad=modalidad + "<div id='opcion4'><div id='tit_opcionE4'><input type='radio' class='radio' id='b1' name='modalidad_ca' value='A2' onclick='mates4(\"B\");eligeModalidad(this.value);'>A2</div><ul><li>Matemáticas B</li><li>Biol. y Geol.</li><li>Física y Quím.</li><li>Informática</li></ul></div>";
					modalidad=modalidad + "<div id='opcion4'><div id='tit_opcionE4'><input type='radio' class='radio' id='b1' name='modalidad_ca' value='A3' onclick='mates4(\"B\");eligeModalidad(this.value);'>A3</div><ul><li>Matemáticas B</li><li>Biol. y Geol.</li><li>Física y Quím.</li><li>Tecnología</li></ul></div>";
					modalidad=modalidad + "<div id='opcion4'><div id='tit_opcionE4'><input type='radio' class='radio' id='b1' name='modalidad_ca' value='A4' onclick='mates4(\"B\");eligeModalidad(this.value);'>A4</div><ul><li>Matemáticas B</li><li>Física y Química</li><li>Informática</li><li>Tecnología</li></ul></div>";
					modalidad=modalidad + "<div id='opcion4'><div id='tit_opcionE4'><input type='radio' class='radio' id='b1' name='modalidad_ca' value='B1' onclick='mates4(\"mat_b1\");eligeModalidad(this.value);'>B1</div><ul><div id='mat_b1'></div><li>Latín</li><li>Francés</li><li>Informática</li></ul></div>";
					modalidad=modalidad + "<div id='opcion4'><div id='tit_opcionE4'><input type='radio' class='radio' id='b1' name='modalidad_ca' value='B2' onclick='mates4(\"mat_b2\");eligeModalidad(this.value);mates4();'>B2</div><ul><div id='mat_b2'></div><li>Latín</li><li>Música</li><li>Informática</li></ul></div>";
					modalidad=modalidad + "<div id='opcion4'><div id='tit_opcionE4'><input type='radio' class='radio' id='b1' name='modalidad_ca' value='C1' onclick='mates4(\"B\");eligeModalidad(this.value);'>C1</div><ul><li>Matemáticas A</li><li>Tecnología</li><li>Ed.Plástica y V.</li><li>Música</li></ul></div>";
					modalidad=modalidad + "<div id='opcion4'><div id='tit_opcionE4'><input type='radio' class='radio' id='b1' name='modalidad_ca' value='C2' onclick='mates4(\"B\");eligeModalidad(this.value);'>C2</div><ul><li>Matemáticas A</li><li>Tecnología</li><li>Ed.Plástica y V.</li><li>Informática</li></ul></div>";
					return modalidad;
			}
			
			function modalidadB2(bach){ //Al elegir la opción de 2ºBach muestra las materias.
				var bach= bach;
				if(bach=='B2HCS'){
					var modalidad="<div id='b2HCS'><div id='opcionb2'><div id='tit_OPCIONB2'><input type='radio' class='radio' id='b2' name='modalidadhcs' value='B2_1' onclick='b2(this.value);' required>Opción 1</div><ul><li>Lit. Universal</li><li>Latín II</li><li>Griego II</li></ul></div>";
					modalidad=modalidad + "<div id='opcionb2'><div id='tit_OPCIONB2'><input type='radio' class='radio' id='b2hcs' name='modalidadhcs' value='B2_2' onclick='b2(this.value);' required>Opción 2</div><ul><li>Hª del Arte</li><li>Latín II</li><li>Lit. Universal</li></ul></div>";
					modalidad=modalidad + "<div id='opcionb2'><div id='tit_OPCIONB2'><input type='radio' class='radio' id='b2hcs' name='modalidadhcs' value='B2_3' onclick='b2(this.value);' required>Opción 3</div><ul><li>Matem. CCSS II</li><li>Latín II</li><li>Lit. Universal</li></ul></div>";
					modalidad=modalidad + "<div id='opcionb2'><div id='tit_OPCIONB2'><input type='radio' class='radio' id='b2hcs' name='modalidadhcs' value='B2_4' onclick='b2(this.value);' required>Opción 4</div><ul><li>Hª del Arte</li><li>Econ. Empresa</li><li>Lit. Universal</li></ul></div>";
					modalidad=modalidad + "<div id='opcionb2'><div id='tit_OPCIONB2'><input type='radio' class='radio' id='b2hcs' name='modalidadhcs' value='B2_5' onclick='b2(this.value);' required>Opción 5</div><ul><li>Griego II</li><li>Econ. Empresa</li><li>Lit. Universal</li></ul></div>";
					modalidad=modalidad + "<div id='opcionb2'><div id='tit_OPCIONB2'><input type='radio' class='radio' id='b2hcs' name='modalidadhcs' value='B2_6' onclick='b2(this.value);' required>Opción 6</div><ul><li>Geografía</li><li>Econ. Empresa</li><li>Matem. CCSS II</li></ul></div>";
					modalidad=modalidad + "<div id='opcionb2'><div id='tit_OPCIONB2'><input type='radio' class='radio' id='b2hcs' name='modalidadhcs' value='B2_7' onclick='b2(this.value);' required>Opción 7</div><ul><li>Geografía</li><li>Latín II</li><li>Griego II</li></ul></div>";
					modalidad=modalidad + "<div id='opcionb2'><div id='tit_OPCIONB2'><input type='radio' class='radio' id='b2hcs' name='modalidadhcs' value='B2_8' onclick='b2(this.value);' required>Opcion 8</div><ul><li>Hª del Arte</li><li>Geografía</li><li>Econ. Empresa</li></ul></div>";
					modalidad=modalidad + "<div id='opcionb2'><div id='tit_OPCIONB2'><input type='radio' class='radio' id='b2hcs' name='modalidadhcs' value='B2_9' onclick='b2(this.value);' required>Opcion 9</div><ul><li>Griego II</li><li>Geografía</li><li>Econ. Empresa</li></ul></div>";
					modalidad=modalidad + "<div id='opcionb2'><div id='tit_OPCIONB2'><input type='radio' class='radio' id='b2hcs' name='modalidadhcs' value='B2_10' onclick='b2(this.value);' required>Opcion 10</div><ul><li>Hª del Arte</li><li>Latín II</li><li>Geografía</li></ul></div>";
					modalidad=modalidad + "<div id='opcionb2'><div id='tit_OPCIONB2'><input type='radio' class='radio' id='b2hcs' name='modalidadhcs' value='B2_11' onclick='b2(this.value);' required>Opcion 11</div><ul><li>Matem. CCSS II</li><li>Latín<li>Geografía</li></ul></div>";
					modalidad=modalidad + "<div id='opcionb2'><div id='tit_OPCIONB2'><input type='radio' class='radio' id='b2hcs' name='modalidadhcs' value='B2_12' onclick='b2(this.value);' required>Opcion 12</div><ul><li>Lit. Universal</li><li>Econ. Empresa</li><li>Mat. CCSS II</li></ul></div></div>";
					$('#modB2').html(modalidad);



					var fag='<li id="fag">Fundam. Admón y Gestión</li>';	
					$('#b2CT').hide();
					$('#b2HCS').show();
					$('#lista_optativas').show();
					$('#desaparecer_cs').show();
					
					$('#lista_optativas').append(fag);
					$('#tin').remove(tin);
					$('#qui').remove(qui);
					$('#geol').remove(geol);

				}else{
					var modalidad="<div id='b2CT'><div id='modalidadBachCT'><div id='tit_OPCIONB2'><input type='radio' class='radio' id='b2ct' name='modalidadct' value='B2_A' onclick='b2(this.value);' required>Opción 1</div><ul><li>Matemáticas II</li><li>Física</li><li>Dibujo Técnico II</li></ul></div>";
					modalidad=modalidad + "<div id='modalidadBachCT'><div id='tit_OPCIONB2'><input type='radio' class='radio' id='b2ct' name='modalidadct' value='B2_B' onclick='b2(this.value);' required>Opción 2</div><ul><li>Matemáticas II</li><li>Física</li><li>Electrotecnia</li></ul></div>";
					modalidad=modalidad + "<div id='modalidadBachCT'><div id='tit_OPCIONB2'><input type='radio' class='radio' id='b2ct' name='modalidadct' value='B2_C' onclick='b2(this.value);' required>Opción 3</div><ul><li>Matemáticas II</li><li>CTMA</li><li>Biología</li></ul></div>";
					modalidad=modalidad + "<div id='modalidadBachCT'><div id='tit_OPCIONB2'><input type='radio' class='radio' id='b2ct' name='modalidadct' value='B2_D' onclick='b2(this.value);' required>Opción 4</div><ul><li>Matemáticas II</li><li>Física</li><li>Biología</li></ul></div>";
					$('#modB2').html(modalidad);
					var geol='<li id="geol">Geología</li>';
					var qui='<li id="qui">Química</li>';
					var tin='<li id="tin">Tecn. Industrial II</li>';
					$('#b2HCS').hide();
					$('#b2CT').show();

					$('#lista_optativas').show();
					$('#desaparecer_cs').show();
					$('#fag').remove(fag);
					
					$('#lista_optativas').append(geol);
					$('#lista_optativas').prepend(qui);
					$('#lista_optativas').append(tin);
					//Eliminamos el check_anterior
					$('#b2hcs').prop('checked', false);
				}				
			}
			
			function obtenerDatos(){
				$.dobPicker({
					daySelector: '#dia', /* Required */
					monthSelector: '#mes', /* Required */
					yearSelector: '#anno', /* Required */
					minimumAge: 12, /* Optional */
					maximumAge: 25 /* Optional */
				  });

				  
				var codigo=$('.codigo').val();
				$.ajax({
					data: {"codigo" : codigo},
					type: "POST",
					dataType: "json",
					url: "./respuesta.php",
				})
				.done(function( data, textStatus, jqXHR ) {
					if(data.alumno[0].entregado=='S'){
						$('#error').html('<p>La matrícula ya ha sido entregada y no puede modificarse</p>');
					}else{
					
						if(data.alumno[0].success==false){
							$('#error').append('<p>La clave no es correcta.<br/>Por favor, vuelva a escribirla.</p>');
						}else{
							$('#wrapper').hide();
							$('#content').show();
							//1. Declaramos las variables.
							var curso = data.alumno[0].curso;
							var anombre = data.alumno[0].anombre;
							var codigo = data.alumno[0].codigo;
							var aapellidos = data.alumno[0].aapellidos;
							var adomicilio = data.alumno[0].adomicilio;
							var atelefono = data.alumno[0].atelefono;
							var repite = data.alumno[0].repetidor;
							var adni = data.alumno[0].adni;
							var nacionalidad = data.alumno[0].nacionalidad;
							var acp = data.alumno[0].acp;
							var lug_nac = data.alumno[0].lug_nac;
							var prov_nac = data.alumno[0].prov_nac;
							var pais_nac = data.alumno[0].pais_nac;
							
							
											
							var mnombre = data.alumno[0].mnombre;
							var mapellidos = data.alumno[0].mapellidos;
							var mdni = data.alumno[0].mdni;
							var mdomicilio = data.alumno[0].mdomicilio;
							var mcp = data.alumno[0].mcp;
							var mtelefono_f = data.alumno[0].mtelefono_f;
							var mtelefono_m = data.alumno[0].mtelefono_m;
							var memail= data.alumno[0].memail;
							
							var pnombre = data.alumno[0].pnombre;
							var papellidos = data.alumno[0].papellidos;
							var pdni = data.alumno[0].pdni;
							var pdomicilio = data.alumno[0].pdomicilio;
							var pcp = data.alumno[0].pcp;
							var ptelefono_f = data.alumno[0].ptelefono_f;
							var ptelefono_m = data.alumno[0].ptelefono_m;
							var pcp = data.alumno[0].pcp;
							var pemail= data.alumno[0].pemail;
							
							rellenarDatos(acp,'aCP')
							rellenarDatos(nacionalidad,'nacionalidad');
							rellenarDatos(lug_nac,'lug_nac');
							rellenarDatos(prov_nac,'prov_nac');
							rellenarDatos(pais_nac,'pais_nac');
							
							rellenarDatos(mnombre,'mnombre');
							rellenarDatos(mapellidos,'mapellidos');
							rellenarDatos(mdni,'mDNI');
							rellenarDatos(mdomicilio,'mdomicilio');
							rellenarDatos(mcp,'mCP');
							rellenarDatos(mtelefono_m,'mTELEFONO_M');
							rellenarDatos(mtelefono_f,'mTELEFONO_F');
							rellenarDatos(memail,'memail');
							
							
							rellenarDatos(pnombre,'pnombre');
							rellenarDatos(papellidos,'papellidos');
							rellenarDatos(pdomicilio,'pdomicilio');
							rellenarDatos(pdni,'pDNI');
							rellenarDatos(pcp,'pCP');
							rellenarDatos(ptelefono_m,'pTELEFONO_M');
							rellenarDatos(ptelefono_f,'pTELEFONO_F');
							rellenarDatos(pemail,'pemail');
							
							if(curso=='N'){
								var elcurso="1º de ESO";
							}else if(curso=='E1'){
								var elcurso="2º de ESO";
								var elcurso_ca="1º de ESO";
							}else if(curso=='E2'){
								var elcurso="3º de ESO";
								var elcurso_ca="2º de ESO";
							}else if(curso=='E3'){
								var elcurso="4º de ESO";
								var elcurso_ca="3º de ESO";
							}else if(curso=='E4'){
								var elcurso="1º Bachillerato";
								var elcurso_ca="4º de ESO";
							}else if(curso=='B1'){
								var elcurso="2º Bachillerato";
								var elcurso_ca="1º de Bachillerato";
							}
							//Nos aseguramos que el curso se envía:
							$('#curso').val(curso);
							$('#codigo').val(codigo);
							
							$('#curso_actual').html(elcurso);
							//alert(elcurso);
							
							//REllenamos los datos del formulario que ya figuran en la BD.
							rellenarDatos(anombre,'anombre');
							rellenarDatos(aapellidos,'aapellidos');
							rellenarDatos(adomicilio,'adomicilio');
							rellenarDatos(atelefono,'atelefono');
							rellenarDatos(adni,'aDNI');
							
							
							
							//
							//
							//Empezamos con las ASIGNATURAS
							//
							
												
							//var asignaturas = data.alumno[0].materias;
							var optativas1 = data.alumno[0].optativas1;
							var optativas1_ca = data.alumno[0].optativas1_ca;
							//var optativas2 = data.alumno[0].optativas2;
							
							if (curso=='E3'){
								var modalidad="<div id='opcion4'><div id='tit_opcionE4'><input type='radio' class='radio' id='b1' name='modalidad' value='A1' onclick='mates4(\"B\");eligeModalidad(this.value);'>A1</div><ul><li>Matemáticas B</li><li>Biol. y Geol.</li><li>Física y Quím.</li><li>Francés</li></ul></div>";
								modalidad=modalidad + "<div id='opcion4'><div id='tit_opcionE4'><input type='radio' class='radio' id='b1' name='modalidad' value='A2' onclick='mates4(\"B\");eligeModalidad(this.value);'>A2</div><ul><li>Matemáticas B</li><li>Biol. y Geol.</li><li>Física y Quím.</li><li>Informática</li></ul></div>";
								modalidad=modalidad + "<div id='opcion4'><div id='tit_opcionE4'><input type='radio' class='radio' id='b1' name='modalidad' value='A3' onclick='mates4(\"B\");eligeModalidad(this.value);'>A3</div><ul><li>Matemáticas B</li><li>Biol. y Geol.</li><li>Física y Quím.</li><li>Tecnología</li></ul></div>";
								modalidad=modalidad + "<div id='opcion4'><div id='tit_opcionE4'><input type='radio' class='radio' id='b1' name='modalidad' value='A4' onclick='mates4(\"B\");eligeModalidad(this.value);'>A4</div><ul><li>Matemáticas B</li><li>Física y Química</li><li>Informática</li><li>Tecnología</li></ul></div>";
								modalidad=modalidad + "<div id='opcion4'><div id='tit_opcionE4'><input type='radio' class='radio' id='b1' name='modalidad' value='B1' onclick='mates4(\"mat_b1\");eligeModalidad(this.value);'>B1</div><ul><div id='mat_b1'></div><li>Latín</li><li>Francés</li><li>Informática</li></ul></div>";
								modalidad=modalidad + "<div id='opcion4'><div id='tit_opcionE4'><input type='radio' class='radio' id='b1' name='modalidad' value='B2' onclick='mates4(\"mat_b2\");eligeModalidad(this.value);mates4();'>B2</div><ul><div id='mat_b2'></div><li>Latín</li><li>Música</li><li>Informática</li></ul></div>";
								modalidad=modalidad + "<div id='opcion4'><div id='tit_opcionE4'><input type='radio' class='radio' id='b1' name='modalidad' value='C1' onclick='mates4(\"B\");eligeModalidad(this.value);'>C1</div><ul><li>Matemáticas A</li><li>Tecnología</li><li>Ed.Plástica y V.</li><li>Música</li></ul></div>";
								modalidad=modalidad + "<div id='opcion4'><div id='tit_opcionE4'><input type='radio' class='radio' id='b1' name='modalidad' value='C2' onclick='mates4(\"B\");eligeModalidad(this.value);'>C2</div><ul><li>Matemáticas A</li><li>Tecnología</li><li>Ed.Plástica y V.</li><li>Informática</li></ul></div>";
								$('#modalidad').append(modalidad);
							}
							if (curso=='E2'){
								var modalidad="<div id='opcion3'>";
								modalidad=modalidad + "<input type='radio' class='radio' id='MAC' name='modalidad' value='MAC' onclick='infoMates3(this.value);'>Matemáticas Académicas";
								modalidad=modalidad + "<br/><input type='radio' class='radio' id='MAP' name='modalidad' value='MAP' onclick='infoMates3(this.value);'>Matemáticas Aplicadas";
								modalidad=modalidad + "</div><br/>";
								$('#modalidad').append(modalidad);
							}

							if (curso=='E4'){
								var modalidad="<div id='opcionb1'><div id='tit_opcion'><input type='radio' class='radio' id='b1' name='modalidad' value='H' onclick='eligeModalidad(this.value);'>Humanidades</div><ul><li>Latín</li><li>Historia M. Contemporáneo</li></ul></div></div><div id='opcionb1'><div id='tit_opcion'><input type='radio' class='radio' id='b1' name='modalidad' value='S' onclick='eligeModalidad(this.value);'>Ciencias Sociales</div><ul><li>Matemáticas CCSS</li><li>Historia M. Contemporáneo</li></ul></div></div><div id='opcionb1'><div id='tit_opcion'><input type='radio' class='radio' id='b1' name='modalidad' value='C' onclick='eligeModalidad(this.value);'>Ciencias</div><ul><li>Matemáticas I</li><li>Física y Química</li></ul></div></div>";
								$('.asignaturas').css("height", "55em");
								$('#modalidad').append(modalidad);
							}
							
							if (curso=='B1'){
								$('#desaparecer').hide();
								$('#lista_optativas').hide();
								$('#desaparecer_cs').hide();

								$('.asignaturas').css("height", "55em");
								var modalidad="<div id='modalidadBach'>";
								modalidad=modalidad + "<input type='radio' class='radio' id='HCS' name='modalidad' value='B2HCS' onclick='modalidadB2(this.value);' required>Humanidades y Ciencias Sociales";
								modalidad=modalidad + "<br/><input type='radio' class='radio' id='CT' name='modalidad' value='B2TC' onclick='modalidadB2(this.value);' required>Ciencia y Tecnología";
								modalidad=modalidad + "</div><br/>";
								modalidad=modalidad + "<div id='modB2'></div>"
								$('#modalidad').append(modalidad);

							}					
							var optativas1 = optativas1.split(';');
							for (var i = 0; i < optativas1.length; i++) {
								optativa= '<li>' + optativas1[i] + '</li>';
								$('#lista_optativas').append(optativa);
							}                    
							$('#optativas1').append('<label for="opt1[]" class="error">Por favor marque 2 opciones</label>'); 		
												
							
							//if(curso=='N' || curso=='E2' || curso=='E3' || curso=='E4' || curso=='B1'){
								
								if(curso=='E3'){
									$('.asignaturas').css("height", "45em");
								}
								
								if(curso=='N' || curso=='E1' ||curso=='E2' || curso=='E3' || curso=='E4' || curso=='B1'){
									$('#titulo3').append('Elige una opción');
									if(curso=='N' || curso=='E1' ||curso=='E2' || curso=='E3'){

									var religion = data.alumno[0].rel;
									religion = religion.split(';');

									for (var i = 0; i < religion.length; i++) {
										if (i==0){
											$('#optativas1').append('<div id="separador"></div>');
										}
										rel= '<div id="excluye"><input type="radio" class="radio" id="religion" name="religion" value="'+i+'" onclick="autorizaReligion('+i+');">' + religion[i] + '</div>';
										$('#optativas1').append(rel);
									}
										$('#optativas1').append('<label for="religion" class="error">Por favor marque una opción</label>');
								}
							//	}	
								
								$('#reserva2').append('El Centro se reserva la opción de que curse <b>Recuperación de Matemáticas</b> o <b>Recuperación de Lengua</b>');
								
								if(repite=='S'){
									if(curso=='E3'){
										var modalidad_ca="<div id='opcion3'>";
										modalidad_ca=modalidad_ca + "<input type='radio' class='radio' id='MAC' name='modalidad_ca' value='MAC' onclick='infoMates3(this.value);'>Matemáticas Académicas";
										modalidad_ca=modalidad_ca + "<br/><input type='radio' class='radio' id='MAP' name='modalidad_ca' value='MAP' onclick='infoMates3(this.value);'>Matemáticas Aplicadas";
										modalidad_ca=modalidad_ca + "</div><br/>";
										$('#modalidad_ca').append(modalidad_ca);	
									}
									if(curso=='E4'){
										var modalidad_ca=modalidadE4(); 
										$('.asignaturas').css("height", "45em");
										$('#modalidad_ca').append(modalidad_ca);
									}	

									if(curso=='B1'){
										var tag='optativas1_ca';
										var modalidad_ca="<div id='opcionb1'><div id='tit_opcion'><input type='radio' class='radio' id='b1' name='modalidadB1' value='H' onclick='eligeModalidad_ca(this.value);'>Humanidades</div><ul><li>Latín I</li><li>Historia M. Contemporáneo</li></ul></div></div><div id='opcionb1'><div id='tit_opcion'><input type='radio' class='radio' id='b1' name='modalidadB1' value='S' onclick='eligeModalidad_ca(this.value);'>Ciencias Sociales</div><ul><li>Matemáticas CCSS</li><li>Historia M. Contemporáneo</li></ul></div></div><div id='opcionb1'><div id='tit_opcion'><input type='radio' class='radio' id='b1' name='modalidadB1' value='C' onclick='eligeModalidad_ca(this.value);'>Ciencias</div><ul><li>Matemáticas I</li><li>Física y Química</li></ul></div></div>";
										$('.asignaturas').css("height", "50em");
										$('#modalidad_ca').append(modalidad_ca);
									}	
									
									//
									//Si el ALUMNO REPITE MOSTRAMOS EL FORMULARIO DEL CURSO ANTERIOR.
									//
																
									$("#invisible").show();
									$('#curso_ca').html(elcurso_ca);
									var optativas1_ca = optativas1_ca.split(';');
									
									for (var i = 0; i < optativas1_ca.length; i++) {
										optativa_ca= '<li>' + optativas1_ca[i] + '</li>';
										$('#lista_optativas_ca').append(optativa_ca);
									}

									var religion_ca = data.alumno[0].rel_ca;
									$('#titulo3_ca').append('Elige una opción');
									var religion_ca = religion_ca.split(';');
									for (var i = 0; i < religion_ca.length; i++) {
										if (i==0){
											$('#optativas1_ca').append('<div id="separador"></div>');
										}
										rel_ca= '<div id="excluye"><input type="radio" class="radio" id="religion" name="religion_ca" value="'+i+'" onclick="autorizaReligion('+i+');">' + religion_ca[i] + '</div>';
										$('#optativas1_ca').append(rel_ca);
									}
									$('#optativas1_ca').append('<label for="religion" class="error">Por favor marque una opción</label>');
									$('#reserva_ca2').append('El Centro se reserva la opción de que curse <b>Recuperación de Matemáticas</b> o <b>Recuperación de Lengua</b>');
								}
							}              

							if ( console && console.log ) {
								console.log( "La solicitud se ha completado correctamente." );
							}
						}
					}
				})
				.fail(function( jqXHR, textStatus, errorThrown ) {
					if ( console && console.log ) {
						console.log( "La solicitud ha fallado: " +  textStatus);
					}
				});
			}
			
			function autorizaReligion(autorizacion){
				if (autorizacion==0){$("#aut_religion").show()}else{$("#aut_religion").hide()}
			}
			
			function listado2(){
				
				var nn='';
				$( "ul.seleccion_ca li" ).text(function( index, value ) {
					nn+= "#" + value;
				});				
				$('#orden_optativas_ca').val(nn);
				//alert(nn);
			}
			

            $(function()
			{
				var form = $("#matriculacion").show();
				$('.seleccion_ca').sortable();
				$('.seleccion').sortable();
				$('.manejador').sortable({
					handle: 'span'
				});
				$('.lista_optativas').sortable({
					connectWith: '.seleccion'
				});
				$('.lista_optativas_ca').sortable({
					connectWith: '.seleccion_ca'
				})
				$('.exclude').sortable({
					items: ':not(.disabled)'
				});
				
				
				$(".codigo").focus(function() {
					$(".pass-icon").css("left","-48px");
				});
				$(".codigo").blur(function() {
					$(".pass-icon").css("left","0px");
				});

				jQuery.validator.addMethod("optativas", function (value, element) {
					if ($('ul.lista_optativas li').length > 0){
						return true;
					} else {
					return false;
					};
				}, "No debe quedar ninguna materia en este espacio");				


				$( "#matriculaForm" ).submit(function( event ) {				

					if ($('ul.lista_optativas_ca li').length > 0){
						$('#aviso_optativas2_ca').show();
						event.preventDefault();
					}else{
						var nn='';
						$( "ul.seleccion_ca li" ).text(function( index, value ) {
							nn+= "#" + value;
						});
						$('#orden_optativas').val(nn);
					}
					
					if ($('ul.lista_optativas li').length > 0){
						$('#aviso_optativas2').show();
						event.preventDefault();
					}else{
						var n='';
						$( "ul.seleccion li" ).text(function( index, value ) {
							n+= "#" + value;
						});
						$('#orden_optativas').val(n);
					}
					 
					// Ponemos aquí lo que queremos que haga después de validar y antes de enviar los datos
					
					//event.preventDefault();
				});
				jQuery.validator.addMethod("fecha_nac", function(value, element) {
					// value: dd/mm/yyyy
					if(/^\d\d\/\d\d\/\d\d\d\d/i.test(value)) {
					// check valid date
						var year = substr(value, 6, 4);
						var month = substr(value, 3, 2);
						var day = substr(value, 0, 2);
						if (month == 2) {
							if (day == 29) {
								if (year % 4 != 0 || year % 100 == 0 && year % 400 != 0) {
									var errors = {};
									errors[element.name] = jQuery.format('El mes de febrero del año {0} tiene 28 días como máximo.', new Array(year));
									this.showErrors(errors);
								}
							}
							else if (day > 28) {
								var errors = {};
								errors[element.name] = jQuery.format('El mes de febrero del año {0} tiene 28 días como máximo.', new Array(year));
								this.showErrors(errors);
							}
						}
						else if (month == 4 || month == 6 || month  == 9 || month == 11) {
							if (day > 30) {
								var errors = {};
								errors[element.name] = 'El mes entrado tiene 30 días como máximo.';
								this.showErrors(errors);
							}
						}
						else {
							if (day > 31) {
								var errors = {};
								errors[element.name] = 'El mes entrado tiene 31 días como máximo.';
								this.showErrors(errors);
							}
						}
 
						var today = new Date();
						today.setHours(23);
						today.setMinutes(59);
						today.setSeconds(59);
						var new_epoch = new Date('2000', '0', '1');
						var entered_date = new Date(year, month - 1, day, 23, 59, 59);
						if ((entered_date > today) || (entered_date < new_epoch)) {
							var errors = {};
							errors[element.name] = 'Por favor, introduzca una fecha entre el 01/01/2000 y hoy (formato: dd/mm/aaaa).';
							this.showErrors(errors);
						}
						else {
							this.hideErrors();
							return true;
						}
					}
					else {
						var errors = {};
						errors[element.name] = 'Por favor, introduzca una fecha entre el 01/01/2000 y hoy (formato: dd/mm/aaaa).';
						this.showErrors(errors);
					}
					return true;
				});
				
				$("#matriculaForm").validate({
					rules: {
						aapellidos: {
						required: true
						},
						anombre: {
							required: true,
							minlength: 3
						},
						adomicilio: {
							required: true,
						},
						atelefono: {
							required: false,
							number: true
						},
						opt_1: {
							required: true,
							minlength: 2,
							maxlength: 2
						},
						religion: {
							required: true
						},
						religion_ca: {
							required: true
						},
						modalidad: {
							required: true
						},
						modalidad_ca: {
							required: true
						},
						auth_paracetamol: "required",
						auth_sanitaria: "required",
						auth_fotos: "required",
						agree: "required"
						},
						messages: {
							auth_fotos:{
								required: "Por favor, marque una de las opciones"
							},
							auth_sanitaria:{
								required: "Por favor, marque una de las opciones"
							},auth_paracetamol:{
								required: "Por favor, marque una de las opciones"
							},
							anombre: {
								required:"Por favor, escribe tu nombre"
							},
							aapellidos: {
							required:"Por favor, escribe tus tus apellidos"
							},
							adirección: {
								required: "Por favor, escribe tu dirección"
							},
							aCP: {
								required: "Por favor, indique el Código Postal",
								minlength: 5,
								maxlength: 5
							},
							agree: "Es obligatorio aceptar el Reglamento de Régimen Interno "	
						},
						 invalidHandler: function(event, validator) {
								error();
						  }
					});
				
				/*
				nicnumber: {
					selectnic: true,
					required: true
				}
				*/
				$("input[name=religion]").change(function () {	 
					aut_religion=$(this).val();
					if (aut_religion==0){$("#aut_religion").show()}else{$("#aut_religion").hide()}
				});				
			});
			
//ALERTAS
			
			function infoMates3(mates){
				if(mates=='MAP'){
					var txt='<b>Las Matemáticas orientadas a las enseñanzas aplicadas</b> están enfocadas a los estudiantes que pretendan realizar un <b>módulo de Formación Profesional.</b>';
				}else{
					var txt='<b>Las Matemáticas orientadas a las enseñanzas académicas</b>, que están dirigidas a alumnos que quieran estudiar <b>Bachillerato</b>';
				}
				alertify.alert(txt, function () {
				});
			}

			function infoMates4(mates){
				if(mates=='MATA'){
					var txt='<b>Las Matemáticas A </b> están enfocadas a los estudiantes que pretendan incorporarse al mundo laboral';
				}else{
					var txt='<b>Las Matemáticas B </b>están dirigidas a alumnos que quieran estudiar <b>Bachillerato</b> tanto en su opción de Ciencias como de Ciencias Sociales';
				}
				alertify.alert(txt, function () {
				});
			}
			function error(){
				var txt='<b>Aviso</b><br/>Hay errores en el formulario. Repáselo, estarán señalados con color rojo';
				alertify.alert(txt, function () {
				});
			}
			
			function esperaFechasMatricula(){
				
				
			}
