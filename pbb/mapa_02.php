<?php
$idTienda=$_GET["id"];
//echo $msg;
$camino=$_GET["camino"];
//echo $camino;

?>

<html lang="en">
	<head>
		<title>Multiplataforma | Módulo WebGL</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
	</head>

	<body>
		<div id="progress">
			<span id="message">Cargando ...</span>

			<center>
				<div id="progressbar" class="shadow"><div id="bar" class="shadow"></div></div>
				<div id="start" class="disabled">Entrar</div>
			</center>
		</div>
		<script>
			// PHP
			// idTienda
			var idTienda = '<?php echo $idTienda; ?>';
			//console.log(typeof(idTienda));
			// camino
			var camino = '<?php echo $camino; ?>';
			var camino=camino.split("-");

			for (var i = 0; i < camino.length; i++) {
				o = camino[i].split("_");
		        o[0] = parseInt(o[0]);
		        o[1] = parseInt(o[1]);
		        camino[i] = o;
			};
			//console.log(camino);
			if ( ! Detector.webgl ) Detector.addGetWebGLMessage();

			var SCREEN_WIDTH = window.innerWidth;
			var SCREEN_HEIGHT = window.innerHeight;

			var container,stats;

			var camera, scene, loaded;
			var renderer;

			var mesh, zmesh, geometry;

			//var mouseX = 0, mouseY = 0;

			var windowHalfX = window.innerWidth / 2;
			var windowHalfY = window.innerHeight / 2;

			var position = { x: 120, y: 180, z:150 };
			var ruta 	= {coloruta: 0x47B17C}
			var tween;

			var s0 		= [];
			var cam01	= [100, 50, 100];			// inicial
			var cam02	= [0, 200, 1,];				// planta piso
			var dB 		= [s0, cam01, cam02];
			var rutap	= [];
			var colores = {
				cActivoColor 	: "#ffae23",
				cActivoAmb 		: "#ffae23",
				cPasivoColor 	: "#ffae23",
				cPasivoAmb 		: "#ffae23",
				cPisoColor 		: "#ffae23",
				cLuzAmb 		: "#ffae23",
				cLuzDirec 		: "#ffae23"
			}

			var tv = 0;
			var sRutaBase, sRutaOn;

			//document.addEventListener( 'mousemove', onDocumentMouseMove, false );
			document.addEventListener( 'keydown', onKeyDown, false );

			var activo, pasivo;
			//var piso1 = new THREE.Object3D();
			var mTiendaSel;

			prepare();
			animate();

			
			function init() {

				// SETEOS INICIALES
				scene = loaded.scene;
				//camera = loaded.currentCamera;
					
				//camera = new THREE.PerspectiveCamera( 65, window.innerWidth / window.innerHeight, 1, 4000 )
				camera = new THREE.PerspectiveCamera( 65, 900 / 900, 1, 4000 )

				//camera.aspect = window.innerWidth / window.innerHeight;
				camera.aspect = 900/ 900;
				camera.updateProjectionMatrix();

				//renderer.setClearColor( loaded.bgColor, loaded.bgAlpha );

				camera.position.x = 400;
				camera.position.y = 140;
				camera.position.z = -40;
				//camera.lookAt( scene.position );
				camera.lookAt( new THREE.Vector3( 309, 1, -201 ) );


				var ambient = new THREE.AmbientLight( 0x666666 );
				scene.add( ambient );

				var directionalLight = new THREE.DirectionalLight( 0xcccccc );
				//directionalLight.position.set( 0, 0, 1 ).normalize();
				scene.add( directionalLight );

				

				
				// MATERIALES
				activo = new THREE.MeshLambertMaterial( { color: 0xff0000 , shading: THREE.FlatShading, ambient: 0x000000 } );
				//pasivo = new THREE.MeshLambertMaterial( { color: 0xff0000, ambient: 0xff0000} );
				//pasivo = new THREE.MeshPhongMaterial( { color: 0xA3A3A3, shading: THREE.FlatShading , ambient: 0xffffff } ); //, opacity: 0.2, transparent: true } ); //, wireframe: true } );
				pasivo = new THREE.MeshLambertMaterial( { color: 0x989795, ambient: 0xffffff, shading: THREE.FlatShading } );
				pisoColor = new THREE.MeshLambertMaterial( { color: 0xe1dcd5 , shading: THREE.FlatShading , ambient: 0x000000 } );

				//tiendas
				sFalabella = new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tFalabella.jpg' ) } ); //, ambient: 0x000000 } );
				sHomecenter = new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tHomecenter.jpg' ) } );
				sLider = new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tLider.jpg' ) } );
				sParis = new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tParis.jpg' ) } );
				sRipley = new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tRipley.jpg' ) } );
				
				var o=scene.__objects.length;
				for (i=0; i<o; i++){
					
					//if( scene.__objects[i].name === "160" ) {
					if( scene.__objects[i].name === idTienda ) {
						scene.__objects[i].material = activo;
						mTiendaSel = scene.__objects[i];
					}else if( scene.__objects[i].name === "Piso" ){
				 		scene.__objects[i].material = pisoColor;

				 	}else if( scene.__objects[i].name === "82" ){
				 		scene.__objects[i].material = sFalabella;
				 	}else if( scene.__objects[i].name === "107" ){
				 		scene.__objects[i].material = sHomecenter;
				 	}else if( scene.__objects[i].name === "130" ){
				 		scene.__objects[i].material = sLider;
				 	}else if( scene.__objects[i].name === "163" ){
				 		scene.__objects[i].material = sParis;
				 	}else if( scene.__objects[i].name === "183" ){
				 		scene.__objects[i].material = sRipley;

					}else{
				 		scene.__objects[i].material = pasivo;
					}
					//scene.__objects[i].material.shading = THREE.FlatShading;
					//scene.__objects[i].material = pasivo;

				}

				// agrupando por pisos
				
        		/*scene.__objects[0].material = activo;
        		piso1.add(scene.__objects[5]);
        		
        		scene.__objects[1].material = activo;
        		piso1.add(scene.__objects[10]);
        		
        		scene.__objects[2].material = activo;
        		piso1.add(scene.__objects[15]);
        		
        		scene.__objects[3].material = activo;
        		piso1.add(scene.__objects[20]);*/
        		
        		//scene.add(piso1);


        		



        		// RECORRIDO

        		//var extrudeSettings = { amount: 200,  bevelEnabled: true, bevelSegments: 2, steps: 150 };
        		//extrudeSettings.bevelEnabled = false;

		        pisoK = 2;
		        var arregloVec = [];

		        // en bruto
		        /*var arregloBruto = [
		        	[460, pisoK, 155],
		        	[383, pisoK, 190],
		        	[360, pisoK, 199],
		        	[344, pisoK, 201],
		        	[259, pisoK, 201],
		        	[258, pisoK, 246],
		        	[252, pisoK, 260],
		        	[160, pisoK, 192],
		        	[170, pisoK, 187]
		        ];
		        
		        for (var i = 0; i < arregloBruto.length; i++) {
		        	// convierte a Vector
		        	vecTemp = new THREE.Vector3( arregloBruto[i][0], arregloBruto[i][1], -arregloBruto[i][2] );

		        	// add vector a arreglo gral
		        	arregloVec.push(vecTemp);
		        };*/

		        // desde afuera
		        for (var i = 0; i < camino.length; i++) {
		        	// convierte a Vector
		        	vecTemp = new THREE.Vector3( camino[i][0], pisoK, -camino[i][1] );

		        	// add vector a arreglo gral
		        	arregloVec.push(vecTemp);
		        };
		        
		        var arregloBruto = camino;
		        
		        



		        var extrudeBend = new THREE.SplineCurve3( arregloVec );


		        /*extrudeSettings.extrudePath = extrudeBend;

		        var tube = new THREE.TubeGeometry(extrudeSettings.extrudePath, 20, 0.8, 10, false, true);

		        var planeMaterial =  new THREE.MeshLambertMaterial( { color: 0xDEDEDE, ambient: 0xDEDEDE} );
          		var mesh = new THREE.Mesh( tube, planeMaterial );*/

          		//scene.add( mesh );



          		//pos = tube.path.getPointAt(2);
          		//pos = tube.path;
          		pos = extrudeBend;
          		//console.log(pos); // devuelve curve

          		var dtotal = 0;

          		// distancia total

          		for (var i = 0; arregloBruto.length-1 > i ; i++) {

		        	a1 = arregloBruto[i+1][0] - arregloBruto[i][0];
		        	a1 = Math.abs(a1);

		        	b1 = arregloBruto[i+1][1] - arregloBruto[i][1];
		        	b1 = Math.abs(b1);

		        	a2 = Math.pow(a1,2);
		        	b2 = Math.pow(b1,2);

		        	dparcial = Math.sqrt(a2+b2);
		        	dtotal = dtotal + dparcial;

		        	//console.log("distancia acumulada nodo "+i+": "+dtotal);
			        //console.log(dtotal);
		        	
		        };

		        // fórmula cant objetos
		        var separacion = 4;

		        var oTotal = (dtotal/separacion)+1;
		        oTotal = Math.round(oTotal);
		        sRutaBase = new THREE.MeshBasicMaterial({ color: 0xff0000 });
				sRutaOn   = new THREE.MeshBasicMaterial({ color: 0xfffc19 });

		        // distribución objetos
		        for (var i = 0; i < oTotal; i++) {
		        	punteroCurve = i/oTotal;
		        	punteroVec = extrudeBend.getPointAt(punteroCurve);
		        	pelota = new THREE.Mesh(new THREE.SphereGeometry(0.8), sRutaBase); //era 0.8
		        	pelota.position = punteroVec;
		        	scene.add( pelota );
		        	//console.log(punteroVec);
		        	rutap.push(pelota);

		        };


		        // LINEAS + HUD
		        var sLineas = new THREE.LineBasicMaterial( { color: 0xff0000, opacity: 1, linewidth: 40 } );
		        var iHudInicio = THREE.ImageUtils.loadTexture( 'src/images/mapa/hudInicio.png' );
		        var iHudDestino = THREE.ImageUtils.loadTexture( 'src/images/mapa/hudDestino.png' );
		        


				var mLineaInicio = new THREE.Geometry()
				mLineaInicio.vertices.push( new THREE.Vector3( 360, 2, -199 ) );
				mLineaInicio.vertices.push( new THREE.Vector3( 360, 50, -199 ) );

		        var lineaInicio = new THREE.Line( mLineaInicio, sLineas );
				scene.add( lineaInicio );		        

		        var spHudInicio = new THREE.Sprite( { map: iHudInicio, useScreenCoordinates: false, color: 0xffffff } );
				spHudInicio.scale.x = 0.1
				spHudInicio.scale.y = 0.05;
				spHudInicio.position.set( 360, 50, -199 );
				scene.add( spHudInicio );


				var mLineaDestino = new THREE.Geometry()
				mLineaDestino.vertices.push( mTiendaSel.position );
				mLineaDestino.vertices.push( new THREE.Vector3( mTiendaSel.position.x, 50, mTiendaSel.position.z ) );

		        var lineaDestino = new THREE.Line( mLineaDestino, sLineas );
				scene.add( lineaDestino );

				var spHudDestino = new THREE.Sprite( { map: iHudDestino, useScreenCoordinates: false, color: 0xffffff } );
				spHudDestino.scale.x = 0.1
				spHudDestino.scale.y = 0.05;
				spHudDestino.position.set( mTiendaSel.position.x, 50, mTiendaSel.position.z );
				scene.add( spHudDestino );







				// DEBUGGING

				//var gui = new DAT.GUI({ height : 5 * 32 - 1 });
				/*gui = new dat.GUI();

				gui.add( position, 'x', -200, 400 ).onChange( function() {
					camera.position.x = position.x;
				});

				gui.add( position, 'y', -200, 400 ).onChange( function() {
					camera.position.y = position.y;
				});

				gui.add( position, 'z', -200, 400 ).onChange( function() {
					camera.position.z = position.z;
				});*/

				/*gui.addColor(colores, 'cActivoColor').onChange( function(value) {
					activo.color.setHex( value.replace("#", "0x") );
				});

				gui.addColor(colores, 'cActivoAmb').onChange( function(value) {
					activo.ambient.setHex( value.replace("#", "0x") );
				});

				gui.addColor(colores, 'cPasivoColor').onChange( function(value) {
					pasivo.color.setHex( value.replace("#", "0x") );
				});

				gui.addColor(colores, 'cPasivoAmb').onChange( function(value) {
					pasivo.ambient.setHex( value.replace("#", "0x") );
				});

				gui.addColor(colores, 'cPisoColor').onChange( function(value) {
					pisoColor.color.setHex( value.replace("#", "0x") );
				});

				gui.addColor(colores, 'cLuzDirec').onChange( function(value) {
					activo.color.setHex( value.replace("#", "0x") );
				});

				gui.addColor(colores, 'cActivoColor').onChange( function(value) {
					activo.color.setHex( value.replace("#", "0x") );
				});*/

				//gui.close();

				
				//console.log(mTiendaSel.position);



			}


			// ANIMAR CAMARA

			function animarCam( px, py, pz, t ) {

				tween = new TWEEN.Tween(position)
					.to({x: px, y: py, z: pz}, t)
					.easing(TWEEN.Easing.Cubic.InOut)
					.onUpdate(updateCam);
				tween.start();

			}
			

			/*function onDocumentMouseMove(event) {

				mouseX = ( event.clientX - windowHalfX );
				mouseY = ( event.clientY - windowHalfY );

			}*/


			function onKeyDown ( event ) {

				//var vel = 50

				switch( event.keyCode ) {
	
					case 78: // /*N*/
						//code
						//animarCam(  dB[1][0], dB[1][1], dB[1][2], 2000  );
						//piso1.position.y=0;
						break;
					
					case 77: // /*M*/
						//code
						//piso1.position.y=20;
						break;

					case 38: // arriba
						//code
						//animarCam( [0, 200, 1, 2000] );
						animarCam(  dB[2][0], dB[2][1], dB[2][2], 2000 );
						//piso1.position.y=0;
						break;

					case 40: // abajo
						//code
						//console.log(scene.__objects[5].name);
						//console.log(scene.__objects.length);
						//scene.__objects[5].material = new THREE.MeshLambertMaterial( { color: 0xFF0000 , ambient: 0xFF0000} );

						/*var activo = new THREE.MeshLambertMaterial( { color: 0x00ff00, ambient: 0x00ff00} );
						var pasivo = new THREE.MeshLambertMaterial( { color: 0xff0000, ambient: 0xff0000} );

						if( scene.__objects[5].name == "hc_patios" ) {
							console.log("iguales");
							scene.__objects[5].material = activo;
						}else{
							console.log("distintos");
							scene.__objects[5].material = pasivo;
						}*/

						

						/*var o=scene.__objects.length;
						for (i=0; i<o; i++){
							
							if( scene.__objects[i].name === "hc_patio" ) {
								scene.__objects[i].material = activo;
							}else{
								scene.__objects[i].material = pasivo;
							}
						}*/

						animarCam(  dB[1][0], dB[1][1], dB[1][2], 2000  );

						break;

					case 37: // izq
						animarCam(  dB[2][0], dB[2][1], dB[2][2], 2000 );
						break;

					case 39: // der
						//code
						break;
					
				}

			}


			function animate() {

				requestAnimationFrame( animate );

				render();
				stats.update();

				TWEEN.update();

			}

			function render() {

				//camera.position.x += ( mouseX - camera.position.x ) * .001;
				//camera.position.y += ( - mouseY - camera.position.y ) * .001;

				var time = Date.now();
				var looptime = 5 * 1000;
				var t = (time % looptime) / looptime;
				//n = t.charAt(2)
				//console.log(t*10);

				tn  = Math.round(t*rutap.length);

				if (!tv) {tv = tn};

				if (tn != tv) {
					//console.log(tn);

					for (var i = 0; i < rutap.length; i++) {
						//rutap[i]
						if( i == tn ) {
							rutap[i].material = sRutaOn;
							//console.log(rutap[i].geometry);
							//console.log(rutap[i].scale);
							rutap[i].scale.set(2,2,2);
						}else{
							rutap[i].material = sRutaBase;
							rutap[i].scale.set(1,1,1);
						}
					};

					tv = tn;

				};

				//console.log(Math.round(t*10));


				//camera.lookAt( scene.position );
				camera.lookAt( new THREE.Vector3( 309, 1, -201 ) );

				renderer.render( scene, camera );

			}

			function updateCam() {

				camera.position.x = position.x;
				camera.position.y = position.y;
				camera.position.z = position.z;
				//camera.style.webkitTransform = 'rotate(' + Math.floor(position.rotation) + 'deg)';
				//camera.style.MozTransform = 'rotate(' + Math.floor(position.rotation) + 'deg)';
				//console.log("actualizando");

			}








			// INTERCAMBIA LA ESCENA

			function onStartClick() {

				$( "progress" ).style.display = "none";

				init();

			}


			// IDENTIFICADOR

			function $( id ) {

				return document.getElementById( id );

			}


			// PRELOADER

			function prepare() {

				container = document.createElement( 'div' );
				document.body.appendChild( container );

				//scene =  new THREE.Scene(),
				//camera = new THREE.PerspectiveCamera( 65, window.innerWidth / window.innerHeight, 1, 1000 )

				renderer = new THREE.WebGLRenderer();
				//renderer.setSize( SCREEN_WIDTH, SCREEN_HEIGHT );
				renderer.setSize( 900, 900 );
				renderer.setClearColorHex(0xF7F7F7, 1);
				//renderer.domElement.style.position = "absolute";
				//renderer.domElement.style.top = '50px';
				container.appendChild( renderer.domElement );

				stats = new Stats();
				stats.domElement.style.position = 'absolute';
				stats.domElement.style.top = '0px';
				stats.domElement.style.left = '0px';
				//stats.domElement.style.zIndex = 100;
				//container.appendChild( stats.domElement );


				//  UPDATE

				function handle_update( result, pieces ) {

					//refreshSceneView( result );
					//renderer.initWebGLObjects( result.scene );

					var m, material, count = 0;

					for ( m in result.materials ) {

						material = result.materials[ m ];
						if ( ! ( material instanceof THREE.MeshFaceMaterial ) ) {

							if( !material.program ) {

								//console.log(m);
								//renderer.initMaterial( material, result.scene.__lights, result.scene.fog );

								count += 1;
								if( count > pieces ) {

									//console.log("xxxxxxxxx");
									break;

								}

							}

						}

					}

				}


				var callbackProgress = function( progress, result ) {

					var bar = 250,
						total = progress.total_models + progress.total_textures,
						loaded = progress.loaded_models + progress.loaded_textures;

					if ( total )
						bar = Math.floor( bar * loaded / total );

					$( "bar" ).style.width = bar + "px";

					count = 0;
					for ( var m in result.materials ) count++;

					handle_update( result, Math.floor( count/total ) );

				}

				var callbackFinished = function( result ) {

					loaded = result;

					$( "message" ).style.display = "none";
					$( "progressbar" ).style.display = "none";
					$( "start" ).style.display = "block";
					$( "start" ).className = "enabled";

					//$( "progress" ).style.display = "none";
					//init();
					onStartClick();
					//animarFadeInicial();

					handle_update( result, 1 );

				}

				//$( "start" ).addEventListener( 'click', onStartClick, false );
				$( "progress" ).style.display = "block";

				var loader = new THREE.SceneLoader();
				loader.callbackProgress = callbackProgress;

				loader.load( "src/js/mapa/v04_19.js", callbackFinished );

			}
		</script>

	</body>
</html>

