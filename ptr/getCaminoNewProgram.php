<?php
require_once 'src/classes/controlCamino.class.php';
require_once 'src/classes/nodo.class.php';
require_once 'src/classes/controlTotem.class.php';

$inicio=$_GET["inicio"];
$meta=$_GET["meta"];
if (isset ($_GET['id']))$idTienda=$_GET['id'];
else $idTienda=null;
if (isset ($_GET['foto']))$foto=$_GET['foto'];
else $foto="vacio.jpg";
$totem = controlTotem::getTotem($inicio);
//var_dump( $totem);

?>
<html>
<script type="text/javascript" src="src/js/caminoMasCorto/pathfinding-browser.js"></script>
<script src="src/js/caminoMasCorto/gMatrix1.js"></script>
<script src="src/js/caminoMasCorto/gMatrix2.js"></script>
<script src="src/js/jquery-1.7.1.min.js"></script>
<script src="src/js/mapa/Three.js"></script>
<script src="src/js/mapa/Detector.js"></script>
<script src="src/js/mapa/Stats.js"></script>
<script src="src/js/mapa/Tween.js"></script>
<script type='text/javascript' src='src/js/mapa/dat.gui.js'></script>
<script src="src/js/mapa/Curve.js"></script>
<script src="src/js/mapa/TubeGeometry.js"></script>
<script src="src/js/mapa/ExtrudeGeometry.js"></script>
<script src="src/js/mapa/pp/ShaderExtras.js"></script>
		<script src="src/js/mapa/pp/EffectComposer.js"></script>
		<script src="src/js/mapa/pp/RenderPass.js"></script>
		<script src="src/js/mapa/pp/BloomPass.js"></script>
		<script src="src/js/mapa/pp/ShaderPass.js"></script>
		<script src="src/js/mapa/pp/MaskPass.js"></script>
		<script src="src/js/mapa/pp/SavePass.js"></script>
<head>

		<title>Multiplataforma | Módulo WebGL</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
</head>

<body style="overflow:hidden">
<script>
generaMapa(calculaCamino());
//alert(generaCamino("440_160-291_151","2"));
//calculaCamino();

function calculaCamino()
{
	/*
	 * 1 define inicioActual, metaFinal ,caminoParcial=null y caminoMasCorto=null
	 * 2 Si metaFinal->getpiso() == inicioActual->getpiso()
	 * 	-> metaActual=metafinal
	 * 	Sino
	 * 	-> metaActual= getCambiadorPisoMasCercano(inicioActual)
	 * 3 Calcula camino -> caminoParcial=calculaCamino(inicioActual,metaActual)
	 * 4 Si metaFinal=metaActual
	 * 	-> Si caminoMasCorto != null
	 * 		-> return caminoMasCorto
	 * 	-> Sino
	 * 		-> return caminoParcial
	 * 	Sino
	 * 	-> inicioActual = metaActual
	 * 	-> caminoMasCorto = caminoMasCorto."<separador>".caminoParcial
	 * 	-> vuelvo a 2
	 */
	<?php 
				$inicioOriginal = controlCamino::getNodo($inicio);
				$metaFinal = controlCamino::getNodo($meta);
	?>
	function caminoObj(id,camino,largo,idnodo)
	{
		this.id=id;
		this.camino=camino;
		this.largo=largo;
		this.idnodo=idnodo;
	}
	var cpisos = new Array();
	var pisoInicioOriginal= "<?php echo $inicioOriginal->getpiso();?>";
	var pisoMetaFinal= "<?php echo $metaFinal->getpiso();?>";
	var coorInicioOriginal="<?php echo $inicioOriginal->getcoordenadaReal();?>";
	var coorMetaFinal= "<?php echo $metaFinal->getcoordenadaReal();?>";
	var coorMetaActual="";
	var metaActual="";
	var caminoParcial="";
	var direccion="";
	var cambiadores="";
	var pisoInicioActual=pisoInicioOriginal;
	var coorInicioActual = coorInicioOriginal;
	//alert(coorMetaFinal + "->metafinal " + pisoMetaFinal + "->pisoFinal"); 
	$.ajaxSetup({async: false});
	while(true)
	{
		if(pisoMetaFinal==pisoInicioActual)
		{
			coorMetaActual=coorMetaFinal;
			/*********************************************************************/
			//alert(pisoInicioActual + " pisoActual;" + coorMetaActual + " metaActual");
			//alert(coorInicioActual+"-"+coorMetaActual+" "+pisoInicioActual);
			camino=generaCamino(coorInicioActual+"-"+coorMetaActual,pisoInicioActual);
			//alert(pisoInicioActual + " pisoActual;" +coorInicioActual+ " inicioActual;" + coorMetaActual + " metaActual;" + camino + " camino;"); 
			var cami="";
			for (var i = 0; i < camino.length; i++)
			{
				for(var k=0;k<camino[i].length;k++)
				{
					if(i==0&&k==0)cami=camino[i][k];
					else
					{
						if(k%2==0)cami=cami+"-"+camino[i][k];
						else cami=cami+"_"+camino[i][k];
					}
				
				}
			}
			caminoParcial=caminoParcial+"*"+pisoInicioActual+"*"+cami;
			//alert(caminoParcial + "<- camino; metaFinal-> " + coorMetaFinal  );
			return caminoParcial;
			/*********************************************************************/
		}
		else
		{
			if(pisoInicioActual<pisoMetaFinal)
			{
				//alert("por aqui");
				//alert(cambiadores);
				//alert("pisoInicioActual "+pisoInicioActual);
				//alert(pisoMetaFinal);
				$.get("getCambiadoresPiso.php", { piso: pisoInicioActual ,direccion:"sube"},
						   function(data){
					   		//	alert("del get "+data);
					   			cambiadores=data;
					   			
					   			//alert("cambiadores del get "+ cambiadores); 
					   			//alert("cambiadores largo "+ cambiadores.length);
				});
				//alert("inicio cambiadores "+cambiadores);
			///	alert(cambiadores[0]);
				cambiadores=cambiadores.split(";");
			//	alert("cambiadores->"+cambiadores);
				//alert(cambiadores.length+" tamaño cambiadores");
				for (var l = 0; l < cambiadores.length; l++) 
				{
					//alert(cambiadores[l]);
					//alert(l);
					//alert(coorInicioActual+"-"+cambiadores[l]+"->piso->"+pisoInicioActual);
					camino = generaCamino(coorInicioActual+"-"+cambiadores[l],pisoInicioActual);
					//alert("camino->"+camino);
					for (var i = 0; i < camino.length; i++)
					{
						for(var k=0;k<camino[i].length;k++)
						{
							if(i==0&&k==0)cami=camino[i][k];
							else
							{
								if(k%2==0)cami=cami+"-"+camino[i][k];
								else cami=cami+"_"+camino[i][k];
								//alert(cami);
							}
						}
						
					}
					camin=cami.split("-"); 
					cpisos[i]=new caminoObj(i,cami,cami.length,camin.slice(-1));
				}
				cpisos.sort(function(a,b){return a.largo - b.largo;});
				//alert (cpisos[0].camino + " cpisos");
				caminoParcial=caminoParcial+"*"+pisoInicioActual+"*"+cpisos[0].camino;
				//alert(caminoParcial+"->camino "+cpisos[0].idnodo);
				//alert("caminoParcial "+caminoParcial);
			//	alert(cpisos[0].idnodo + "idnodo cpisos " + cpisos[0].camino+ "--"+cpisos[0].id);
				$.get("getPisoPorCoorReal.php", { coor: ""+cpisos[0].idnodo ,direccion:"sube",piso:pisoInicioActual},
						   function(data){
					   			//alert(data+" ->data de coorpisoreal");
					   			data=data.split(";");
					   			coorInicioActual=data[0];
					   			pisoInicioActual=data[1];
					   });
				
				//alert(pisoInicioActual + " pisoActual" + coorMetaActual + " metaActual" + coorInicioActual + " coorInicioActual");
			}
			else
			{
				$.get("getCambiadoresPiso.php", { piso: pisoInicioActual ,direccion:"baja"},
						   function(data){
					   		//	alert("en baja-> "+ data);
					   			cambiadores=data;
					   });
				cambiadores=cambiadores.split(";");
				for (var l = 0; l < cambiadores.length; l++) 
				{
					camino= generaCamino(coorInicioActual+"-"+cambiadores[l],pisoInicioActual);
				//	alert(camino);
					for (var i = 0; i < camino.length; i++)
					{
						for(var k=0;k<camino[i].length;k++)
						{
							if(i==0&&k==0)cami=camino[i][k];
							else
							{
								if(k%2==0)cami=cami+"-"+camino[i][k];
								else cami=cami+"_"+camino[i][k];
							}
						}
					}
					camin=cami.split("-"); 
				//	alert(cami);
					cpisos[i]=new caminoObj(i,cami,cami.length,camin.slice(-1));
				}
				cpisos.sort(function(a,b){return a.largo - b.largo;});
				caminoParcial=caminoParcial+"*"+pisoInicioActual+"*"+""+cpisos[0].camino;
			//	alert(caminoParcial+" caminoParcial en baja");
				$.get("getPisoPorCoorReal.php", { coor: ""+cpisos[0].idnodo ,direccion:"baja",piso:pisoInicioActual},
						   function(data){
					   		//	alert(data);
					   			data=data.split(";");
					   			coorInicioActual=data[0];
					   			pisoInicioActual=data[1];
					   });
			}
			
			
		}
		
		
	}
	
}

function generaCamino(data,piso)
{
	//alert(data + "<-data piso-> "+piso );
	var data=data.split("-");
	//console.log(data);
	for (var i = 0; i < data.length; i++) 
	{
		o = data[i].split("_");				// fragmenta cada fragmento de camino
		o[0] = parseInt(o[0]);					// convierte a num y asigna al primer slot del fragmento
		o[1] = parseInt(o[1]);					// convierte a num y asigna al segundo slot del fragmento
		data[i] = o;							// reemplaza fragmento continuo por uno fragmentado
	};
	//alert(data + " <-data");

	var camino = [];
	// PASOS

	// LLEGA DESDE HTML
	// idTienda
	// pos incio 								// 39 > 360, 199					// 40, 29
	// pos destino								// 55 > 439, 157

	// grilla original de a 1					// grilla de a 10					// grilla de a 5 (doble)
	// x | 155 - 476							// 16 - 47 -> 31					// 63 (+1, contando los 5 extra)
	// y | 109 -> 0								// 11 - 34 -> 24					// 47 (+1, contando los 5 extra)


	// MAQUINA CALCULA Y DEVUELVE CAMINO
	// coords deben ser (from up to down) > invertir Y
	//alert(piso+"->piso en camino");
	if(piso=="1")
		{
		//alert("en piso 1");
		var matrix = gMatrix1();
		//alert(matrix);
		//var grid = new PF.Grid(63, 47, matrix);
		var grid = new PF.Grid(248, 208, matrix);
		//alert(grid);	
		/*var grosor="5";
		var alt="47";*/
	//	var grosor="2";
	//	var alt="170";
		
		}
	if(piso=="2")
		{
		var matrix = gMatrix2();
		//alert(matrix);
		var grid = new PF.Grid(250, 151, matrix);
	//	var grosor="2";
	//	var alt="116";
		
		}
	
	/*
	function convHaMatrix (p) 
	{
		p.x = Math.round((p.x)/grosor);						// (Ex - slot0) / 5
		p.y = alt - Math.round((p.y)/grosor);					// total - (Ey - slot0) / 5 > para invertir Y
	}	

	function convDeMatrix (v) 
	{
		v[0] = (v[0]*grosor)+160;
		v[1] = ((alt-v[1])*grosor)+109;
		return v;	
	}*/
	//alert(matrix);
	
	//	alert(grid);
	
	var finder = new PF.JumpPointFinder({allowDiagonal: true});
	//alert(finder);
	//console.log(finder);
	dataA = 
	{
		x 	: data[0][0],
		y	: data[0][1]
	}

	dataB = {
		x 	: data[1][0],
		y	: data[1][1]
	}
	//convHaMatrix(dataA);
	//convHaMatrix(dataB);
	//alert(dataA+" dataA "+dataB+" dataB");
	//alert(dataA.x+" "+ dataA.y+" "+dataB.x+" "+dataB.y);
	//console.log(dataB);
	//	alert(dataA.x +"dataAx "+ dataA.y +" dataAy "+  dataB.x +"dataBx "+ dataB.y +" dataBy ");
	//alert(grid);
	var caminoRaw = finder.findPath(dataA.x, dataA.y, dataB.x, dataB.y, grid);
	//alert(caminoRaw);
	for (var i = 0; i < caminoRaw.length; i++) 
	{
		entrada = caminoRaw[i];
		camino.push(entrada);
	};
	return camino;
}

function generaMapa(camino)
{
	// PHP
	// idTienda
	var idTienda = '<?php echo $idTienda; ?>';
	var orientacionTotem = '<?php echo $totem->getorientacion(); ?>';
	//alert(orientacionTotem);
	//console.log(typeof(idTienda));
	// camino
	//var camino=camino.split("-");
	var camino=camino.split("*");
	/*for (var i = 0; i < camino.length; i++) {
		o = camino[i].split("_");
        o[0] = parseInt(o[0]);
        o[1] = parseInt(o[1]);
        camino[i] = o;
	};*/
	//console.log(camino);
	for (var j = 0; j < camino.length; j=j+2) {
		camino[j]=camino[j].split("-");

		for (var i = 0; i < camino[j].length; i++) {
			o = camino[j][i].split("_");				// fragmenta cada fragmento de camino
	        o[0] = 156 + parseInt(o[0])*1;					// convierte a num y asigna al primer slot del fragmento	//160
	        o[1] = 340 - parseInt(o[1])*1;					// convierte a num y asigna al segundo slot del fragmento	//339
	        camino[j][i] = o;							// reemplaza fragmento continuo por uno fragmentado
		};
	};
	if ( ! Detector.webgl ) Detector.addGetWebGLMessage();

	var SCREEN_WIDTH = window.innerWidth;
	var SCREEN_HEIGHT = window.innerHeight;

	var container,stats;

	var camera, scene, loaded;
	var renderer;

	var mesh, zmesh, geometry;

	var windowHalfX = 450; //window.innerWidth / 2;
	var windowHalfY = 450; //window.innerHeight / 2;

	//var slotCam = { x: 0, y: 0, z:0 };
	var slotCam = new THREE.Vector3( 0, 0, 0 );														// slot Nº1 : posición cámara misma
	var slotTar = new THREE.Vector3( 0, 0, 0 );														// slot Nº2 : posición target

	var tween;

	var cam00	= [];
	var cam01	= [];																				// datos pos cam: inicial
	var cam02	= [];																				// datos pos cam: planta piso
	var dB1 	= [cam00, cam01, cam02];															// datos pos cam gral

	var tar00	= [];
	var tar01	= [];																				// datos pos target: inicial
	var tar02	= [];																				// datos pos target: planta piso
	var dB2 	= [tar00, tar01, tar02];															// datos pos target gral

	var rutap	= [];																				// array pelotas
	var colores = {
		cActivoColor 	: "#ffae23",
		cPasivoColor 	: "#ffae23",
		cPasivoAmb 		: "#ffae23",
		cPisoColor 		: "#ffae23",
		cLuzAmb 		: "#ffae23",
		cLuzDirec 		: "#ffae23"
	}

	var sRutaBase, sRutaOn;

	

	var activo, pasivo;
	var matPisoA, matPisoB;
	var piso_1 = new THREE.Object3D();
	var piso_2 = new THREE.Object3D();
	var piso_1s = new THREE.Object3D();
	var piso_T = new THREE.Object3D();

	var slotPiso1 = { y: 0, o: 1 };
	var slotPiso2 = { y: 0, o: 0 };
	var slotPiso1s = { y: 0, o: 0 };

	var slotPuntero = {x: 100, y: 100};
	//var xA = [];// [ 200, 475, 470 ];
	//var yA = [];// [ 100, 50, 120 ];
	var slotHud = {o: 0};
	var nVueltas = 0;

	//var tramoA, tramoV, tramoB;
	var tramos = [];
	var tramosVec = [];
	var huds = [];
	var pasos = 0;

	var totem = { piso: 1, pos: 0, rot: 0 };

	var mTiendaSel; //, coordMedio;

	var composer, effectFXAA;

	var clock = new THREE.Clock();


	var targetRotation = targetElevation = 0;
	var targetElevation = 40;
	var targetRotationOnMouseDown = targetElevationOnMouseDown = 0;

	var mouseX = mouseY = 0;
	var mouseXOnMouseDown = mouseYOnMouseDown = 0;

	var btns = 0;

	var mTotem;

	//var windowHalfX = window.innerWidth / 2;
	//var windowHalfY = window.innerHeight / 2;

	document.addEventListener( 'keydown', onKeyDown, false );
	
	document.addEventListener( 'mousedown', onDocumentMouseDown, false );
	document.addEventListener( 'touchstart', onDocumentTouchStart, false );
	document.addEventListener( 'touchmove', onDocumentTouchMove, false );

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

		//controls.minDistance = radius * 1.1;
		//controls.maxDistance = radius * 100;

		//renderer.setClearColor( loaded.bgColor, loaded.bgAlpha );

		//camera.position.x = 360;
		//camera.position.y = 60;
		//camera.position.z = -140;
		//camera.lookAt( scene.position );
		//camera.lookAt( new THREE.Vector3( 309, 1, -201 ) );


		var ambient = new THREE.AmbientLight( 0x666666 );
		scene.add( ambient );

		var directionalLight = new THREE.DirectionalLight( 0xcccccc );
		//directionalLight.position.set( 0, 0, 1 ).normalize();
		scene.add( directionalLight );

		var plight = new THREE.PointLight( 0xcccccc, 1, 1000 ); 
		plight.position.set( 314, -60, -272 );
		scene.add( plight );

		


		// ASIGNANDO PISOS
		//var localesPiso1 = [2,3,4,5,6,7,10,13,15,16,17,18,19,20,21,22,25,26,28,32,35,45,46,47,48,49,52,54,55,56,57,61,64,65,66,69,73,76,77,81,82,83,85,86,87,88,90,94,95,98,99,101,102,104,105,107,108,110,111,114,116,117,120,122,126,127,128,129,130,133,136,137,138,140,143,144,145,150,151,152,153,154,156,158,159,160,162,163,165,166,168,169,170,173,175,176,177,181,183,184,185,187,188,191,195,198,201,203,205,206,208,209,210,211,212,215,217,222,223,224,225,227,228,229,230,231,232,233,234,235,236,237,238,239,241,242,243,244];
		var localesPiso1 = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217];
		var localesPiso2 = [218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269,270,271,272,273,274,275,276,277,278,279,280,281,282,283,284,285,286,287,288,289,290,291,292,293,294,295,296,297,298,299,300,301,302,303,304,305,306,307,308,309,310,311,312,313,314,315,316,317,318,319,320,321,322,323,324,325,326,327,328,329,330,331,332,333,334,335,336,337,338,339,340,341];
		//var localesPiso1s = [24,51,58,59,60,80,96,109,112,123,125,135,137,149,178,180,189,190,196,198,216,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269];
		//var cambiadores = ["a01","a02","a03","a04","a05","e01","e02","e03","e04","e05","m02","m03","m04","m05","m06","m07","m08","m09","m10","m11","m12","m13","m14","m15","m16"];

		var mBoulevard = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,32,33,34,35,36,37,38,39,40];
		var mTerrazas  = [47,48,49,50,51,52,53,54,55,70,71,72];
		var mAutoplaza = [56,57,58,59,60,61,62,63,64,65,66,67,68,69];
		var mAires 	   = [129,130,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,207,208,209,210,211,212,213,214,215,216];
		var mComidas   = [218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239];

		for (var l = 0; l < localesPiso1.length; l++) {

			for (var i = 0; i < scene.__objects.length; i++) {

				if ( scene.__objects[i].name == localesPiso1[l].toString() ) {
					//console.log("objeto "+i+" tiene la iD = "+localesPiso1[l]);
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "Piso1" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "Piso_gral" ){
					piso_1.add(scene.__objects[i]);
				/*}else if ( scene.__objects[i].name == "Totem_nvo" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "iAutoplaza.001" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "iAutoplaza.003" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "calles" ){
					piso_1.add(scene.__objects[i]);

				}else if ( scene.__objects[i].name == "estacionamientos1" ){
					piso_1.add(scene.__objects[i]);*/
				}else if ( scene.__objects[i].name == "v_01" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_02" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_03" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_04" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_05" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_06" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_07" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_08" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_09" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_10" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_11" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_12" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_13" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_14" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_15" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_16" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_17" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_18" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_19" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_20" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_21" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_22" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_23" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_24" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_25" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_26" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_27" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_28" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_29" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_30" ){
					piso_1.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "estacionamientos" ){
					piso_1.add(scene.__objects[i]);
				};
			};

			
		};

		for (var l = 0; l < localesPiso2.length; l++) {

			for (var i = 0; i < scene.__objects.length; i++) {

				if ( scene.__objects[i].name == localesPiso2[l].toString() ) {
					//console.log("objeto "+i+" tiene la iD = "+localesPiso2[l]);
					piso_2.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "Piso2" ){
					piso_2.add(scene.__objects[i]);
				/*}else if ( scene.__objects[i].name == "banos" ){
					piso_2.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "terraza" ){
					piso_2.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "iAutoplaza.002" ){
					piso_2.add(scene.__objects[i]);*/
				}else if ( scene.__objects[i].name == "v_31" ){
					piso_2.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_32" ){
					piso_2.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_33" ){
					piso_2.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_34" ){
					piso_2.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_35" ){
					piso_2.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_36" ){
					piso_2.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_37" ){
					piso_2.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_38" ){
					piso_2.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_39" ){
					piso_2.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_40" ){
					piso_2.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "v_41" ){
					piso_2.add(scene.__objects[i]);
				};
			};

			
		};


		/*for (var l = 0; l < localesPiso1s.length; l++) {

			for (var i = 0; i < scene.__objects.length; i++) {

				if ( scene.__objects[i].name == localesPiso1s[l].toString() ) {
					//console.log("objeto "+i+" tiene la iD = "+localesPiso1[l]);
					piso_1s.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "piso_subt" ){
					piso_1s.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "estacionamientos" ){
					piso_1s.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "peceras" ){
					piso_1s.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "e_azul" ){
					piso_1s.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "e_cyan" ){
					piso_1s.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "e_cyan2" ){
					piso_1s.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "e_grises" ){
					piso_1s.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "e_rojos" ){
					piso_1s.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "e_verdes" ){
					piso_1s.add(scene.__objects[i]);
				}else if ( scene.__objects[i].name == "iAutoplaza" ){
					piso_1s.add(scene.__objects[i]);
				};
			};

			
		};*/


		/*for (var l = 0; l < cambiadores.length; l++) {

			for (var i = 0; i < scene.__objects.length; i++) {

				if ( scene.__objects[i].name == cambiadores[l].toString() ) {
					scene.__objects[i].visible = false;
				};
			};			
		};*/


		
		//piso_1.add(scene.__objects[156]);
		
		scene.add(piso_1);
		scene.add(piso_2);
		//scene.add(piso_1s);
		scene.add(piso_T);

		// MATERIALES
		activo 		= new THREE.MeshLambertMaterial( { color: 0x2186ba, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 1 } );
		//pasivo = new THREE.MeshLambertMaterial( { color: 0xff0000, ambient: 0xff0000} );
		//pasivo = new THREE.MeshPhongMaterial( { color: 0xA3A3A3, shading: THREE.FlatShading , ambient: 0xffffff } ); //, opacity: 0.2, transparent: false } ); //, wireframe: true } );
		pasivo 		= new THREE.MeshLambertMaterial( { color: 0x989795, ambient: 0xffffff, shading: THREE.FlatShading, transparent: false, opacity: 1 } );
		pisoColor 	= new THREE.MeshLambertMaterial( { color: 0xe1dcd5, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 1 } );

		pisoColor1 	= new THREE.MeshLambertMaterial( { color: 0xCCC9C4, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 1 } );

		//tiendas
		sFalabella 	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tFalabella.jpg' ), transparent: false, opacity: 1 } ); //, ambient: 0x000000 } );
		sParis 		= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tParis.jpg' ), transparent: false, opacity: 1 } );
		sRipley 	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tRipley.jpg' ), transparent: false, opacity: 1 } );
		sHomecenter	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tHomecenter.jpg' ), transparent: false, opacity: 1 } );
		sStaIsabel	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tStaIsabel.jpg' ), transparent: false, opacity: 1 } );

		sEstac	 	= new THREE.MeshLambertMaterial( { color: 0x97E8EB, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 1 } );
		sBoulevard 	= new THREE.MeshLambertMaterial( { color: 0x67e1ad, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 1 } );
		sTerrazas 	= new THREE.MeshLambertMaterial( { color: 0xffae23, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 1 } ); //ffae23
		sAutoplaza 	= new THREE.MeshLambertMaterial( { color: 0x03579F, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 1 } );
		sAires 		= new THREE.MeshLambertMaterial( { color: 0x919191, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 1 } );
		

		matPisoA = [activo, pasivo, pisoColor, pisoColor1, sFalabella, sParis, sRipley, sHomecenter, sStaIsabel, sEstac, sBoulevard, sTerrazas, sAutoplaza, sAires];

		activo2		= new THREE.MeshLambertMaterial( { color: 0x2186ba, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );
		//pasivo = new THREE.MeshLambertMaterial( { color: 0xff0000, ambient: 0xff0000} );
		//pasivo = new THREE.MeshPhongMaterial( { color: 0xA3A3A3, shading: THREE.FlatShading , ambient: 0xffffff } ); //, opacity: 0.2, transparent: false } ); //, wireframe: true } );
		pasivo2		= new THREE.MeshLambertMaterial( { color: 0x989795, ambient: 0xffffff, shading: THREE.FlatShading, transparent: false, opacity: 0 } );
		pisoColor2 	= new THREE.MeshLambertMaterial( { color: 0xe1dcd5, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );

		//tiendas
		sFalabella2	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tFalabella.jpg' ), transparent: false, opacity: 0 } ); //, ambient: 0x000000 } );
		sParis2		= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tParis.jpg' ), transparent: false, opacity: 0 } );
		sRipley2 	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tRipley.jpg' ), transparent: false, opacity: 0 } );
		sJohnson 	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tJohnson.jpg' ), transparent: false, opacity: 0 } );

		sE_Azul 	= new THREE.MeshLambertMaterial( { color: 0x888BBE, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );
		sE_Cyan 	= new THREE.MeshLambertMaterial( { color: 0x97E8EB, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );
		sE_Gris 	= new THREE.MeshLambertMaterial( { color: 0x919191, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );
		sE_Rojo 	= new THREE.MeshLambertMaterial( { color: 0xF25252, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );
		sE_Verde 	= new THREE.MeshLambertMaterial( { color: 0x9BFC9D, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );

		sComidas 	= new THREE.MeshLambertMaterial( { color: 0xFFD307, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );
		sBoulevard0	= new THREE.MeshLambertMaterial( { color: 0x67e1ad, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );

		matPisoB = [activo2, pasivo2, pisoColor2, sFalabella2, sParis2, sRipley2, sJohnson, sE_Azul, sE_Cyan, sE_Gris, sE_Rojo, sE_Verde, sComidas, sBoulevard0];

		// Totem

		for (var i = 0; i < scene.__objects.length; i++) {
			if ( scene.__objects[i].name == "Totem_nvo" ) {
				//console.log("objeto "+i+" se llama Totem");
				//console.log(scene.__objects[i]);
			};
		};

		mTotem = scene.__objects[0];
		sTotem	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tTotem.jpg' ) } ); //, transparent: true, opacity: 1 } );
		mTotem.material = sTotem;
		mTotem.position.x = camino[2][0][0];
		mTotem.position.y = 2;
		mTotem.position.z = -camino[2][0][1];
		//console.log(mTotem.position.x);
		//console.log(mTotem.position);
		piso_T.add( mTotem );

		if (totem.piso == 1) {
			//console.log(piso_1.children);
			var o=piso_1.children.length;
			for (i=0; i<o; i++){
				
				//if( scene.__objects[i].name === "160" ) {
				if( piso_1.children[i].name === idTienda ) {
					piso_1.children[i].material = activo;
					mTiendaSel = piso_1.children[i];
				}else if( piso_1.children[i].name === "Piso1" ){
			 		piso_1.children[i].material = pisoColor;
			 	}else if( piso_1.children[i].name === "131" ){
			 		piso_1.children[i].material = sFalabella;
			 	}else if( piso_1.children[i].name === "92" ){
			 		piso_1.children[i].material = sParis;
			 	}else if( piso_1.children[i].name === "91" ){
			 		piso_1.children[i].material = sRipley;

			 	}else if( piso_1.children[i].name === "217" ){
			 		piso_1.children[i].material = sHomecenter;
			 	}else if( piso_1.children[i].name === "31" ){
			 		piso_1.children[i].material = sStaIsabel;

			 	}else if( piso_1.children[i].name === "Piso_gral" ){
			 		piso_1.children[i].material = pisoColor1;
			 	}else if( piso_1.children[i].name === "estacionamientos" ){
			 		piso_1.children[i].material = sEstac;
			 	}else{
			 		piso_1.children[i].material = pasivo;
				}

			}

			var o=piso_2.children.length;
			for (i=0; i<o; i++){
				
				//if( scene.__objects[i].name === "160" ) {
				if( piso_2.children[i].name === idTienda ) {
					piso_2.children[i].material = activo2;
					mTiendaSel = piso_2.children[i];
				}else if( piso_2.children[i].name === "Piso2" ){
			 		piso_2.children[i].material = pisoColor2;
			 	}else if( piso_2.children[i].name === "285" ){
			 		piso_2.children[i].material = sFalabella2;
			 	}else if( piso_2.children[i].name === "256" ){
			 		piso_2.children[i].material = sParis2;
			 	}else if( piso_2.children[i].name === "255" ){
			 		piso_2.children[i].material = sRipley2;
			 	}else if( piso_2.children[i].name === "272" ){
			 		piso_2.children[i].material = sJohnson;
			 	}else{
			 		piso_2.children[i].material = pasivo2;
				}

				piso_2.children[i].visible = false;

			}

			/*var o=piso_1s.children.length;
			for (i=0; i<o; i++){
				
				//if( scene.__objects[i].name === "160" ) {
				if( piso_1s.children[i].name === idTienda ) {
					piso_1s.children[i].material = activo2;
					mTiendaSel = piso_1s.children[i];
				}else if( piso_1s.children[i].name === "piso_subt" ){
			 		piso_1s.children[i].material = pisoColor2;
			 	}else if( piso_1s.children[i].name === "163.2" ){
			 		piso_1s.children[i].material = sParis2;
			 	}else if( piso_1s.children[i].name === "183.2" ){
			 		piso_1s.children[i].material = sRipley2;

			 	}else if( piso_1s.children[i].name === "e_azul" ){
			 		piso_1s.children[i].material = sE_Azul;
			 	}else if( piso_1s.children[i].name === "e_grises" ){
			 		piso_1s.children[i].material = sE_Gris;
			 	}else if( piso_1s.children[i].name === "e_cyan" ){
			 		piso_1s.children[i].material = sE_Cyan;
			 	}else if( piso_1s.children[i].name === "e_cyan2" ){
			 		piso_1s.children[i].material = sE_Cyan;
			 	}else if( piso_1s.children[i].name === "e_rojos" ){
			 		piso_1s.children[i].material = sE_Rojo;
			 	}else if( piso_1s.children[i].name === "e_verdes" ){
			 		piso_1s.children[i].material = sE_Verde;

			 	}else{
			 		piso_1s.children[i].material = pasivo2;
				}

				piso_1s.children[i].visible = false;

			}*/

			for (var l = 0; l < mBoulevard.length; l++) {
				for (var i = 0; i < scene.__objects.length; i++) {
					if ( scene.__objects[i].name == mBoulevard[l].toString() ) {
						scene.__objects[i].material = sBoulevard;
					};
				};
			};

			for (var l = 0; l < mTerrazas.length; l++) {
				for (var i = 0; i < scene.__objects.length; i++) {
					if ( scene.__objects[i].name == mTerrazas[l].toString() ) {
						scene.__objects[i].material = sTerrazas;
					};
				};
			};

			for (var l = 0; l < mAutoplaza.length; l++) {
				for (var i = 0; i < scene.__objects.length; i++) {
					if ( scene.__objects[i].name == mAutoplaza[l].toString() ) {
						scene.__objects[i].material = sAutoplaza;
					};
				};
			};

			for (var l = 0; l < mAires.length; l++) {
				for (var i = 0; i < scene.__objects.length; i++) {
					if ( scene.__objects[i].name == mAires[l].toString() ) {
						scene.__objects[i].material = sAires;
					};
				};
			};

			for (var l = 0; l < mComidas.length; l++) {
				for (var i = 0; i < scene.__objects.length; i++) {
					if ( scene.__objects[i].name == mComidas[l].toString() ) {
						scene.__objects[i].material = sComidas;
					};
				};
			};


			/*for (var i = 0; i < scene.__objects.length; i++) {
				if ( scene.__objects[i].name == "estacionamientos" ) {
					scene.__objects[i].material = sE_Verde;
				};
			};*/


		}else{
		//
		};
		// RECORRIDO
		//var planeMaterial =  new THREE.MeshLambertMaterial( { color: 0xF5A331 } ); //, ambient: 0xDEDEDE} );
        //var planeMaterial =  new THREE.MeshBasicMaterial( { color: 0xF5A331 } );
        var planeMaterial =  new THREE.MeshBasicMaterial( { color: 0x2186ba, transparent: false, opacity: 1 } );
        //console.log(camino);		        
        //if (camino[camino.length-1] == "") {pisos = pisos-1};
        if (camino[camino.length-1] == "") {camino.pop();};
        pisos = camino.length-1
        //pisos = pisos / 2;
        //console.log(camino);
        for (var j = 1; j <= pisos; j=j+2) {
        	//console.log(camino[j+1]);
        	// ARMAR arregloVec
        	pisoAc = camino[j]-1;
	        if (camino[3]==2) {
	        	pisoK = pisoAc*40;
	        } else if (camino[3]==-1){
	        	pisoK = pisoAc*20;
	        } else{
	        	pisoK = pisoAc*40;
	        };
	        var arregloVec = [];

	        for (var i = 0; i < camino[j+1].length; i++) {
	        	// convierte a Vector
	        	vecTemp = new THREE.Vector3( camino[j+1][i][0], pisoK, -camino[j+1][i][1] );

	        	// add vector a arreglo gral
	        	arregloVec.push(vecTemp);
	        };

	        
	        // CREA TUBO
	        var curva = new THREE.SplineCurve3( arregloVec );
	        var gTramoA = new THREE.TubeGeometry(curva, 40, 0.4, 5, false, true);	//( path, segments, radius, segmentsRadius, closed, debug )
	        tramo = new THREE.Mesh( gTramoA, planeMaterial );
	        tramo.position.y = 2;

	        tramos.push(tramo);
      		piso_T.add( tramo );
      		tramo.visible = false;


      		// CAMBIO PISO
	        if (camino[j+2]) {
	        	tramoV = new THREE.Mesh( new THREE.CylinderGeometry( 0.4, 0.4, 40, 32, 32 ), planeMaterial);	//( radiusTop, radiusBottom, height, segmentsRadius, segmentsHeight, openEnded )
          		tramoV.position = arregloVec[arregloVec.length-1];
          		if (camino[3] == 2) {
          			tramoV.position.y = 22; // 20
          		} else{
          			tramoV.position.y = -18; // -20
          		};
          		
          		tramos.push(tramoV);
          		piso_T.add( tramoV );
          		tramoV.visible = false;
	        };
	        // PUNTERO
      		var xA = [];
      		var yA = [];

      		var temp = [];

      		// xA / yA
      		for (var i = 0; i < camino[j+1].length; i++) {
      			xA.push(camino[j+1][i][0]);
      			yA.push(-camino[j+1][i][1]);
      		};

      		temp.push(xA);
      		temp.push(yA);

      		tramosVec.push(temp);
        };
  		// PUNTERO
  		puntero = new THREE.Mesh(new THREE.SphereGeometry(1.4), new THREE.MeshBasicMaterial({ color: 0x0E374D }) ); 
  		scene.add( puntero );
  		//puntero.position = arregloVec[0];
  		puntero.position.x = camino[2][0][0];
  		puntero.position.z = -camino[2][0][1];
  		puntero.position.y = 2;
  		puntero.visible = false;

  		slotPuntero.x = camino[2][0][0];
  		slotPuntero.y = -camino[2][0][1];
  		// HUDs

  		/*// distancia total
  		var dtotal = 0;

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
        	punteroVec = curvaA.getPointAt(punteroCurve);
        	pelota = new THREE.Mesh(new THREE.SphereGeometry(0.8), sRutaBase); //era 0.8
        	//pelota = new THREE.Mesh( new THREE.CylinderGeometry( 1, 1, 6, 32, 32 ), sRutaBase);
        	pelota.position = punteroVec;
        	//pelota.rotation = curvaA.getTangentAt(punteroCurve);
        	scene.add( pelota );
        	//console.log(punteroVec);
        	rutap.push(pelota);

        };*/
        // CAMARAS
        coordDestino = camino[2][camino[2].length-1];
        coordInicio = camino[2][0];
        coordMedio = new THREE.Vector3( (coordInicio[0]+coordDestino[0])/2, -15, -(coordInicio[1]+coordDestino[1])/2 );

        if (camino[3]) {
			coordDestinoB = camino[4][camino[4].length-1];
	        coordInicioB = camino[4][0];
	        coordMedioB = new THREE.Vector3( (coordInicioB[0]+coordDestinoB[0])/2, -15, -(coordInicioB[1]+coordDestinoB[1])/2 );
		};
        // camaras
        //cam01	= [slotCam.x, slotCam.y, slotCam.z];
		//cam02	= [coordMedio.x , 380, coordMedio.z];
		desv1 = Math.abs( (coordMedio.x-coordInicio[0])*1.5 );

		if (camino[3]) {
			desv2 = Math.abs( (coordMedioB.x-coordInicioB[0])*1.5 );
			//console.log(desv1);
			//console.log(desv2);
			desvMayor = Math.max(desv1,desv2);
		};
		dB1[1]	= [coordMedio.x + Math.abs( (coordMedio.x-coordInicio[0])*1.5 ), 155, coordMedio.z];					// pos cam: plano medio > x = medio + ( 1.5*(pto medio - inicio) )
		dB1[2]	= [coordMedio.x , 450, coordMedio.z];																	// pos cam: plano gral
		dB1[3]	= [coordInicio[0] + 10 , 4, -coordInicio[1]];
		if (camino[3]) {
			dB1[4]	= [coordMedioB.x + desvMayor, 155, coordMedioB.z];
		};
		
		if (camino[3] && parseInt(camino[3]) == 2) {
			dB1[5]	= [224 , 49, -44];
		} else if (camino[3] && parseInt(camino[3]) == -1) {
			dB1[5]	= [224 , 15, -44];
		};

		if (camino[3]) {
			dB1[6]	= [dB1[5][0]+184 , dB1[5][1]+83, -44];
		} else {
			dB1[6]	= dB1[1];
		};
		//dB1[5]	= [224 , 49, -44];																						// [192 , 127, 70];
		//dB1[6]	= [dB1[5][0]+184 , dB1[5][1]+83, -44];

		dB2[1]	= [coordMedio.x, coordMedio.y, coordMedio.z];															// pos tar: pto medio ruta
		dB2[2]	= [309 , 1, -201];																						// pos tar: pto medio escena
		dB2[3]	= [coordInicio[0] - 10 , 2, -coordInicio[1]];
		if (camino[3]) {
			dB2[4]	= [coordMedioB.x, coordMedioB.y, coordMedioB.z];
		};
		
		dB2[5]	= [309 , 1, -201];

		// asignando camara inicial
		n = 3;

		// poblado de slots					 																			// inicia slot camera con pos 01 > actual (para tween)
        slotCam.x = dB1[n][0];
        slotCam.y = dB1[n][1];
        slotCam.z = dB1[n][2];

        slotTar.x = dB2[n][0];
        slotTar.y = dB2[n][1];
        slotTar.z = dB2[n][2];

        // pos cam 01 																									// asigna pos cam inicial 
        camera.position.x = slotCam.x;										
        camera.position.y = slotCam.y;
        camera.position.z = slotCam.z;
        camera.lookAt( slotTar );

        /*gCilFlecha1 = new THREE.CylinderGeometry( 1, 1, 12, 32, 32 );
		mCilFlechaA = new THREE.Mesh( gCilFlecha1, new THREE.MeshBasicMaterial({ color: 0xff0000 }) );
		mCilFlechaA.position = coordMedio;
		scene.add( mCilFlechaA );*/



        // LINEAS + HUD
        

        //var iHudEsc01 = THREE.ImageUtils.loadTexture( 'src/images/mapa/esc01.png' );   
        
		/*var mLineaInicio = new THREE.Geometry()
		mLineaInicio.vertices.push( new THREE.Vector3( 360, 2, -199 ) );
		mLineaInicio.vertices.push( new THREE.Vector3( 360, 50, -199 ) );

        var lineaInicio = new THREE.Line( mLineaInicio, sLineas );
		scene.add( lineaInicio );	*/

		// LOGOS INICIO Y FINAL

		//var sLineas = new THREE.LineBasicMaterial( { color: 0xff0000, opacity: 1, linewidth: 2 } );
        var iHudInicio = THREE.ImageUtils.loadTexture( 'src/images/mapa/hudInicio.png' );
        var iHudDestino = THREE.ImageUtils.loadTexture( 'src/img/logos/tiendas/<?php echo $foto;?>' );

        var spHudInicio = new THREE.Sprite( { map: iHudInicio, useScreenCoordinates: false, color: 0xffffff } );
		spHudInicio.scale.x = 0.06; // era 0.12
		spHudInicio.scale.y = 0.06;
		spHudInicio.position.set( camino[2][0][0]-4, 6, -camino[2][0][1]-2 ); //( camino[2][0], 10, -camino[2][2] )
		scene.add( spHudInicio );
		huds.push(spHudInicio);

		//console.log(camino[2][0][0]+", "+-camino[2][0][1])

		var spHudDestino = new THREE.Sprite( { map: iHudDestino, useScreenCoordinates: false, color: 0xffffff } );
		spHudDestino.scale.x = 0.042; // era 0.084
		spHudDestino.scale.y = 0.035;  // 0.07
		//spHudDestino.position.set( mTiendaSel.position.x, 10, mTiendaSel.position.z );

		if (camino[3] == -1) {
			spHudDestino.position.set( camino[4][camino[4].length-1][0], 10, -camino[4][camino[4].length-1][1] );
		} else {
			spHudDestino.position.set( mTiendaSel.position.x, 10, mTiendaSel.position.z );
		};
				
		scene.add( spHudDestino );
		spHudDestino.visible = false;
		huds.push(spHudDestino);

		/*mTotem.position.x = camino[2][0][0];
		mTotem.position.y = 0;
		mTotem.position.z = -camino[2][0][1];*/
		//camino[4][camino[4].length-1];

		/*var mLineaDestino = new THREE.Geometry()
		mLineaDestino.vertices.push( mTiendaSel.position );
		mLineaDestino.vertices.push( new THREE.Vector3( mTiendaSel.position.x, 50, mTiendaSel.position.z ) );

        var lineaDestino = new THREE.Line( mLineaDestino, sLineas );
		scene.add( lineaDestino );*/

		// LOGOS CAMINOS Y ESCALERAS

		var iHudInsCa = THREE.ImageUtils.loadTexture( 'src/images/mapa/inCa.png' );
        var iHudInsCb = THREE.ImageUtils.loadTexture( 'src/images/mapa/inCb.png' );
        var iHudInsS = THREE.ImageUtils.loadTexture( 'src/images/mapa/inS.png' );
        var iHudInsBa = THREE.ImageUtils.loadTexture( 'src/images/mapa/inBa.png' );

		var spHudInsCa = new THREE.Sprite( { map: iHudInsCa, useScreenCoordinates: true, color: 0xffffff } );
		spHudInsCa.scale.x = 0.57;
		spHudInsCa.scale.y = 0.1;
		//spHudInsCa.opacity = 0.5;
		spHudInsCa.position.set( 450, 800, 0 );
		scene.add( spHudInsCa );
		spHudInsCa.visible = false;
		huds.push(spHudInsCa);

		var spHudInsCb = new THREE.Sprite( { map: iHudInsCb, useScreenCoordinates: true, color: 0xffffff } );
		spHudInsCb.scale.x = 0.57;
		spHudInsCb.scale.y = 0.1;
		spHudInsCb.position.set( 450, 800, 0 );
		scene.add( spHudInsCb );
		spHudInsCb.visible = false;
		huds.push(spHudInsCb);

		var spHudInsS = new THREE.Sprite( { map: iHudInsS, useScreenCoordinates: true, color: 0xffffff } );
		spHudInsS.scale.x = 0.57;
		spHudInsS.scale.y = 0.1;
		spHudInsS.position.set( 450, 800, 0 );
		scene.add( spHudInsS );
		spHudInsS.visible = false;
		huds.push(spHudInsS);

		var spHudInsBa = new THREE.Sprite( { map: iHudInsBa, useScreenCoordinates: true, color: 0xffffff } );
		spHudInsBa.scale.x = 0.57;
		spHudInsBa.scale.y = 0.1;
		spHudInsBa.position.set( 450, 800, 0 );
		scene.add( spHudInsBa );
		spHudInsBa.visible = false;
		huds.push(spHudInsBa);

		// BOTONES
		var iHudBt1 = THREE.ImageUtils.loadTexture( 'src/images/mapa/btn_01.png' );
		var iHudBt2 = THREE.ImageUtils.loadTexture( 'src/images/mapa/btn_02.png' );
		var iHudBt3 = THREE.ImageUtils.loadTexture( 'src/images/mapa/btn_03.png' );

		var spHudBt1 = new THREE.Sprite( { map: iHudBt1, useScreenCoordinates: true, alignment: THREE.SpriteAlignment.topLeft } );
		spHudBt1.position.set( 300, 20, 0 );
		spHudBt1.scale.x = 0.6;
		spHudBt1.scale.y = 0.684;
		spHudBt1.visible = false;
		scene.add( spHudBt1 );
		huds.push(spHudBt1);

		var spHudBt2 = new THREE.Sprite( { map: iHudBt2, useScreenCoordinates: true, alignment: THREE.SpriteAlignment.topLeft } );
		spHudBt2.position.set( 400, 20, 0 );
		spHudBt2.scale.x = 0.6;
		spHudBt2.scale.y = 0.684;
		spHudBt2.visible = false;
		scene.add( spHudBt2 );
		huds.push(spHudBt2);

		var spHudBt3 = new THREE.Sprite( { map: iHudBt3, useScreenCoordinates: true, alignment: THREE.SpriteAlignment.topLeft } );
		spHudBt3.position.set( 500, 20, 0 );
		spHudBt3.scale.x = 0.6;
		spHudBt3.scale.y = 0.684;
		spHudBt3.visible = false;
		scene.add( spHudBt3 );
		huds.push(spHudBt3);

		// ICONOS ESCALERAS Y ASCENSORES
		var iHudEsc01 = THREE.ImageUtils.loadTexture( 'src/images/mapa/_esc01.png' );
		var iHudAs = THREE.ImageUtils.loadTexture( 'src/images/mapa/elevador.png' );

		/*var spHudEsc01 = new THREE.Sprite( { map: iHudEsc01, useScreenCoordinates: false, color: 0xffffff } );
		spHudEsc01.scale.x = 0.1;
		spHudEsc01.scale.y = 0.1;
		spHudEsc01.position.set( 175, 10, -158 );
		scene.add( spHudEsc01 );*/

		// piso 1
		esc101 = [120,84,1];
		esc102 = [126,102,1];
		esc103 = [126,106,1];
		esc104 = [126,118,1];
		esc105 = [169,140,1];
		esc106 = [174,141,1];
		esc107 = [169,109,1];
		esc108 = [179,104,2]; //172,104,2
		esc109 = [169,98,1];
		esc110 = [169,68,1];
		esc111 = [182,58,1];
		esc112 = [203,53,1];
		esc113 = [227,74,1];
		esc114 = [229,88,1];
		esc115 = [222,98,1];
		escalas01 = [esc101, esc102, esc103, esc104, esc105, esc106, esc107, esc108, esc109, esc110, esc111, esc112, esc113, esc114, esc115];

		for (var j = 0; j < escalas01.length-1; j++) {
			//escalas01[j]
			for (var i = 0; i < escalas01[j].length-1; i++) {
				escalas01[j][0];
				escalas01[j][1];

				if (escalas01[j][2] == 2) {
					imagen = iHudAs;
				}else{
					imagen = iHudEsc01;
				};

				var spHudEsc01 = new THREE.Sprite( { map: imagen, useScreenCoordinates: false, color: 0xffffff } );
				spHudEsc01.scale.x = 0.025; // 0.05
				spHudEsc01.scale.y = 0.025;
				spHudEsc01.position.set( 156 + parseInt(escalas01[j][0])*1, 5, -(340 - parseInt(escalas01[j][1])*1) );
				scene.add( spHudEsc01 );
				piso_1.add( spHudEsc01 );
				matPisoA.push(spHudEsc01);
			};
		};

		// piso 2
		esc201 = [120,83,1];
		esc202 = [127,101,1];
		esc203 = [127,105,1];
		esc204 = [126,118,1];
		esc205 = [169,139,1];
		esc206 = [173,140,1];
		esc207 = [168,108,1];
		esc208 = [179,103,2];
		esc209 = [169,98,1];
		esc210 = [168,67,1];
		esc211 = [182,53,1];
		esc212 = [203,51,1];
		esc213 = [226,73,1];
		esc214 = [229,86,1];
		esc215 = [221,97,1];

		escalas02 = [esc201, esc202, esc203, esc204, esc205, esc206, esc207, esc208, esc209, esc210, esc211, esc212, esc213, esc214, esc215];

		for (var j = 0; j < escalas02.length-1; j++) {
			//escalas02[j]
			for (var i = 0; i < escalas02[j].length-1; i++) {
				escalas02[j][0];
				escalas02[j][1];

				if (escalas02[j][2] == 2) {
					imagen = iHudAs;
				}else{
					imagen = iHudEsc01;
				};

				var spHudEsc02 = new THREE.Sprite( { map: imagen, useScreenCoordinates: false, color: 0xffffff } );
				spHudEsc02.scale.x = 0.025;
				spHudEsc02.scale.y = 0.025;
				spHudEsc02.position.set( 156 + parseInt(escalas02[j][0])*1, 45, -(340 - parseInt(escalas02[j][1])*1) );
				scene.add( spHudEsc02 );
				piso_2.add( spHudEsc02 );
				spHudEsc02.visible = false;
				matPisoB.push(spHudEsc02);
			};
		};

		// piso -1
		/*esc001 = [140,93,1];
		esc002 = [121,90,1];
		esc003 = [105,83,2];
		esc004 = [98,88,1];
		esc005 = [43,73,2];
		esc006 = [49,61,1];
		esc007 = [60,40,1];
		esc008 = [98,59,1];
		escalas01s = [esc001, esc002, esc003, esc004, esc005, esc006, esc007, esc008];

		for (var j = 0; j < escalas01s.length-1; j++) {
			//escalas01s[j]
			for (var i = 0; i < escalas01s[j].length-1; i++) {
				escalas01s[j][0];
				escalas01s[j][1];

				if (escalas01s[j][2] == 2) {
					imagen = iHudAs;
				}else{
					imagen = iHudEsc01;
				};

				var spHudEsc00 = new THREE.Sprite( { map: imagen, useScreenCoordinates: false, color: 0xffffff } );
				spHudEsc00.scale.x = 0.05;
				spHudEsc00.scale.y = 0.05;
				spHudEsc00.position.set( 156 + parseInt(escalas01s[j][0])*1, -40, -(340 - parseInt(escalas01s[j][1])*1) );
				scene.add( spHudEsc00 );
				piso_1s.add( spHudEsc00 );
				spHudEsc00.visible = false;
				matPisoB.push(spHudEsc00);
			};
		};*/

		// LOGOS UNIDADES DE SERVICIO
		var iHudUni1 = THREE.ImageUtils.loadTexture( 'src/images/mapa/logo_bulevard.png' );

		var spHudUni1 = new THREE.Sprite( { map: iHudUni1, useScreenCoordinates: false, color: 0xffffff } );
		spHudUni1.scale.x = 0.06; // era 0.12
		spHudUni1.scale.y = 0.06;
		spHudUni1.position.set( 185, 15, -260 );
		scene.add( spHudUni1 );
		piso_1.add( spHudUni1 );
		matPisoA.push(spHudUni1);
		

		/*var spHudUni1b = new THREE.Sprite( { map: iHudUni1, useScreenCoordinates: false, color: 0xffffff } );
		spHudUni1b.scale.x = 0.06; // 0.12
		spHudUni1b.scale.y = 0.06;
		spHudUni1b.position.set( 196, 15, -224 );
		scene.add( spHudUni1b );
		piso_1.add( spHudUni1b );
		matPisoA.push(spHudUni1b);*/

		/*var spHudUni1c = new THREE.Sprite( { map: iHudUni1, useScreenCoordinates: false, color: 0xffffff } );
		spHudUni1c.scale.x = 0.12;
		spHudUni1c.scale.y = 0.12;
		spHudUni1c.position.set( 196, -30, -224 );
		scene.add( spHudUni1c );
		spHudUni1c.visible = false;
		piso_1s.add( spHudUni1c );
		matPisoB.push(spHudUni1c);*/


		var iHudUni2 = THREE.ImageUtils.loadTexture( 'src/images/mapa/logo_terrazas.png' );

		var spHudUni2 = new THREE.Sprite( { map: iHudUni2, useScreenCoordinates: false, color: 0xffffff } );
		spHudUni2.scale.x = 0.06;
		spHudUni2.scale.y = 0.06;
		spHudUni2.position.set( 255, 15, -245 );
		scene.add( spHudUni2 );
		piso_1.add( spHudUni2 );
		matPisoA.push(spHudUni2);


		var iHudUni3 = THREE.ImageUtils.loadTexture( 'src/images/mapa/logo_comidas.png' );

		var spHudUni3 = new THREE.Sprite( { map: iHudUni3, useScreenCoordinates: false, color: 0xffffff } );
		spHudUni3.scale.x = 0.06;
		spHudUni3.scale.y = 0.06;
		spHudUni3.position.set( 280, 60, -240 );
		scene.add( spHudUni3 );
		spHudUni3.visible = false;
		piso_2.add( spHudUni3 );
		matPisoB.push(spHudUni3);


		var iHudUni4 = THREE.ImageUtils.loadTexture( 'src/images/mapa/logo_autoplaza.png' );

		var spHudUni4 = new THREE.Sprite( { map: iHudUni4, useScreenCoordinates: false, color: 0xffffff } );
		spHudUni4.scale.x = 0.06;
		spHudUni4.scale.y = 0.06;
		spHudUni4.position.set( 240, 15, -210 );
		scene.add( spHudUni4 );
		piso_1.add( spHudUni4 );
		matPisoA.push(spHudUni4);
		

		// apagando textos - v04i3

		/*scene.__objects[262].visible = false;
		scene.__objects[27].visible = false;
		scene.__objects[166].visible = false;
		scene.__objects[26].visible = false;*/

		//spHudInsCb.visible = false;
		//huds.push(spHudUni1);

		/*sHudA = new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, color: 0xe1dcd5, ambient: 0x000000, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/esc01.png' ), transparent: true, opacity: 1, blending: THREE.NormalBlending } );
  		mHudA = new THREE.Mesh(new THREE.PlaneGeometry(10,10), sHudA );
  		mHudA.position.x = camino[2][0][0]-5;
  		mHudA.position.z = -camino[2][0][1]-10;
  		mHudA.position.y = 0;
  		mHudA.rotation.y = Math.PI/2;
  		scene.add( mHudA );*/

  		//huds.push(sHudA);

		/*var spHudEsc01 = new THREE.Sprite( { map: iHudEsc01, useScreenCoordinates: false, color: 0xffffff } );
		spHudEsc01.scale.x = 0.084;
		spHudEsc01.scale.y = 0.07;
		spHudEsc01.position.set( mTiendaSel.position.x, 2, mTiendaSel.position.z );		
		scene.add( spHudEsc01 );
		spHudEsc01.affectedByDistance  = true;
		spHudEsc01.mergeWith3D = true;
		huds.push(spHudEsc01);*/

		// flechas
		/*sFlechas = new THREE.MeshLambertMaterial( { color: 0xff0000 , ambient: 0xff0000 } );

		gCilFlecha1 = new THREE.CylinderGeometry( 2, 2, 6, 32, 32 );
		mCilFlechaA = new THREE.Mesh( gCilFlecha1, sFlechas);
		mCilFlechaA.position.set( 360, 5, -199 );
		scene.add( mCilFlechaA );

		gCilFlecha2 = new THREE.CylinderGeometry( 4, 0, 2, 32, 32 );
		mCilFlechaA1 = new THREE.Mesh( gCilFlecha2, sFlechas);
		mCilFlechaA1.position.set( 360, 1, -199 );
		scene.add( mCilFlechaA1 );*/


		/*indice = 0.8;
		var tan = curvaA.getTangentAt(indice);

        gCilFlecha3 = new THREE.CylinderGeometry( 1, 1, 6, 32, 32 );
        mCilFlechaA2 = new THREE.Mesh( gCilFlecha3, sFlechas);

        ubicacion = curvaA.getPointAt(indice);
        mCilFlechaA2.position = ubicacion;
        mCilFlechaA2.rotation = tan;
        scene.add( mCilFlechaA2 );*/


		// DEBUGGING

		//var gui = new DAT.GUI({ height : 5 * 32 - 1 });
		//gui = new dat.GUI();

		/*gui.add( slotCam, 'x', -200, 650 ).onChange( function() {
			camera.position.x = slotCam.x;
		});

		gui.add( slotCam, 'y', -200, 650 ).onChange( function() {
			camera.position.y = slotCam.y;
		});

		gui.add( slotCam, 'z', -200, 400 ).onChange( function() {
			camera.position.z = slotCam.z;
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
		});*/

		/*gui.addColor(colores, 'cActivoColor').onChange( function(value) {
			mTerrazas.color.setHex( value.replace("#", "0x") );
		});*/

		//gui.close();
		
		//console.log(mTiendaSel.position);
		//console.log(camera.position);
		//console.log(rutap.length);

		// COMPOSER
		//renderer.autoClear = false;

		renderTargetParameters = { minFilter: THREE.LinearFilter, magFilter: THREE.LinearFilter, format: THREE.RGBFormat, stencilBuffer: false };
		//renderTarget = new THREE.WebGLRenderTarget( SCREEN_WIDTH, SCREEN_HEIGHT, renderTargetParameters );
		renderTarget = new THREE.WebGLRenderTarget( 900, 900, renderTargetParameters );

		/*effectFXAA = new THREE.ShaderPass( THREE.ShaderExtras[ "fxaa" ] );
		//effectFXAA.uniforms[ 'resolution' ].value.set( 1 / SCREEN_WIDTH, 1 / SCREEN_HEIGHT );
		effectFXAA.uniforms[ 'resolution' ].value.set( 1 / 900, 1 / 900 );*/

		//effectVignette = new THREE.ShaderPass( THREE.ShaderExtras[ "vignette" ] );
		//effectVignette.uniforms[ 'offset' ].value = 0.4;
		//effectVignette.uniforms[ 'darkness' ].value = 0.85;

		/*hblur = new THREE.ShaderPass( THREE.ShaderExtras[ "horizontalTiltShift" ] );
		vblur = new THREE.ShaderPass( THREE.ShaderExtras[ "verticalTiltShift" ] );
		var bluriness = 4;
		hblur.uniforms[ 'h' ].value = bluriness / 900;
		vblur.uniforms[ 'v' ].value = bluriness / 900;
		hblur.uniforms[ 'r' ].value = vblur.uniforms[ 'r' ].value = 0.5;*/

		colorCorrection = new THREE.ShaderPass( THREE.ShaderExtras[ "colorCorrection" ] );
		//colorCorrection.uniforms[ 'powRGB' ].value = new THREE.Vector3( 2, 1.8, 1.8 ) ;  //powRGB, mulRGB
		colorCorrection.uniforms[ 'powRGB' ].value = new THREE.Vector3( 1, 0.85, 0.85 ) ;
		//colorCorrection.uniforms[ 'mulRGB' ].value = new THREE.Vector3( 1, 1.1, 1.1 ) ; 

		composer = new THREE.EffectComposer( renderer, renderTarget );
		var renderModel = new THREE.RenderPass( scene, camera );
		//effectFXAA.renderToScreen = true;
		//effectVignette.renderToScreen = true;
		//vblur.renderToScreen = true;
		colorCorrection.renderToScreen = true;
		//colorify.renderToScreen = true;
		//screenfx.renderToScreen = true;

		composer = new THREE.EffectComposer( renderer, renderTarget );
		composer.addPass( renderModel );
		//composer.addPass( effectFXAA );
		
		//composer.addPass( hblur );
		//composer.addPass( vblur );
		composer.addPass( colorCorrection );
		//composer.addPass( effectVignette );

		//
		pasos = 1;
		if (pasos == 1) {																	// PASO 1
			animarCam(  dB1[1][0], dB1[1][1], dB1[1][2], 1500, 3000 );						// anim camara: 03 Tótem > cam01 (centro tramo A)
			animarTar(  dB2[1][0], dB2[1][1], dB2[1][2], 1500, 3000 );

		};

		//console.log(camino);

	}

	// ANIMAR CAMARA

	function animarCam( px, py, pz, d, t ) {

		tween = new TWEEN.Tween(slotCam)
			.to({x: px, y: py, z: pz}, t)
			.delay(d)
			//.easing(TWEEN.Easing.Cubic.InOut)
			.easing(TWEEN.Easing.Cubic.InOut)
			.onUpdate(function (){
				camera.position.x = slotCam.x;
				camera.position.y = slotCam.y;
				camera.position.z = slotCam.z;
			})
			.onComplete(function(){
				if (pasos == 1) {															// PASO 2
					tramos[0].visible = true;												// tuboA visible
					puntero.visible = true;													// puntero visible
					animarPuntero(tramosVec[0][0], tramosVec[0][1], 5000);					// anima puntero tramoA
					/*animarHudA( 1, 2000 );*/
					if (camino[3]) {
						huds[3].visible = true;
						pasos = 2;
					} else {
						huds[2].visible = true;
						huds[1].visible = true;
						pasos = 6;
					};
				}else if (pasos == 3){														// PASO 4
					tramos[1].visible = true;												// tramo Vertical visible
					huds[0].visible = false;												// hud Ca no visible
					if (camino[3]==2) {
						huds[4].visible = true;												// hud Sube visible
						animarPiso1( -40, 0, 3000 );										// anim cambio de piso 2
						animarPiso2( -45, 1, 3000 );
					} else if (camino[3]==-1){
						huds[5].visible = true;												// hud Baja visible
						animarPiso1( 40, 0, 3000 );											// anim cambio de piso -1
						//animarPiso1s( 45, 1, 3000 );
					};
					
					pasos = 4;
				}else if (pasos == 5){														// PASO 6
					huds[2].visible = true;													// hud Cb visible
					huds[1].visible = true;													// hud logo tienda visible
					animarPuntero(tramosVec[1][0], tramosVec[1][1], 5000);					// anim puntero: tramoB
					pasos = 6;
				}else if (pasos == 7){														// PASO 8
					//huds[6].visible = huds[7].visible = huds[8].visible = true;				// hud Cb visible
					huds[6].color = new THREE.Color( 0xdddddd );
					huds[6].opacity = 1
					huds[7].color = huds[8].color = new THREE.Color( 0xffffff );
					huds[7].opacity = huds[8].opacity = 0.6;
					//huds[6].material.color.setHSV( 0.5 * Math.random(), 0.8, 0.9 );
					btns = 1;
					pasos = 8;
				};
			})
		tween.start();

	}

	// ANIMAR TARGET
	function animarTar( px, py, pz, d, t ) {
		tween = new TWEEN.Tween(slotTar)
			.to({x: px, y: py, z: pz}, t)
			.delay(d)
			.easing(TWEEN.Easing.Cubic.InOut)
			/*.onUpdate(function (){
				camera.position.x = slotCam.x;
				camera.position.y = slotCam.y;
				camera.position.z = slotCam.z;

				slotTar.x = dB2[n][0];
		        slotTar.y = dB2[n][1];
		        slotTar.z = dB2[n][2];
			})*/
			.onComplete(function(){
				//
			})
		tween.start();

	}


	// ANIMAR PISOS
	function animarPiso1( ny, no, t ) {
		if (no == 1) {
			for (var i = 0; i < piso_1.children.length; i++) {
				piso_1.children[i].visible = true;
			};
		};

		tween = new TWEEN.Tween(slotPiso1)
			.to({y: ny, o: no}, t)
			.easing(TWEEN.Easing.Cubic.InOut)
			.onUpdate(function (){
				piso_1.position.y = slotPiso1.y;
				for (var i = 0; i < matPisoA.length; i++) {
					matPisoA[i].opacity = slotPiso1.o;
				};
				piso_T.position.y = slotPiso1.y;											// animar piso_T
				//console.log(o);
			})
			.onComplete(function (){
				if (no == 0) {
					for (var i = 0; i < piso_1.children.length; i++) {
						piso_1.children[i].visible = false;
					};
				};

				if (pasos == 4) {															// PASO 5
					tramos[2].visible = true;												// tubo B visible
					tramos[0].visible = false;												// tubo A no visible
					tramos[1].visible = false;												// tubo V no visible
					huds[4].visible = false;												// apaga huds S y Ba
					huds[5].visible = false;
					animarCam(  dB1[4][0], dB1[4][1], dB1[4][2], 0, 4000  );				// anim camara: cam05 > cam04 (centro tramo B)
					animarTar(  dB2[4][0], dB2[4][1], dB2[4][2], 0, 4000  );
					pasos = 5;
				}else if (pasos == 3){
					//
				};
			})
		tween.start();
	}

	function animarPiso2( ny, no, t ) {
		if (no == 1) {
			for (var i = 0; i < piso_2.children.length; i++) {
				piso_2.children[i].visible = true;
			};
		};

		tween = new TWEEN.Tween(slotPiso2)
			.to({y: ny, o: no}, t)
			.easing(TWEEN.Easing.Cubic.InOut)
			.onUpdate(function (){
				piso_2.position.y = slotPiso2.y;
				for (var i = 0; i < matPisoB.length; i++) {
					matPisoB[i].opacity = slotPiso2.o;
				};
				//console.log(o);
			})
			.onComplete(function (){
				if (no == 0) {
					for (var i = 0; i < piso_2.children.length; i++) {
						piso_2.children[i].visible = false;
					};
				};
			})
		tween.start();
	}

	/*function animarPiso1s( ny, no, t ) {
		if (no == 1) {
			for (var i = 0; i < piso_1s.children.length; i++) {
				piso_1s.children[i].visible = true;
			};
		};

		mTotem.visible = false;

		tween = new TWEEN.Tween(slotPiso2)
			.to({y: ny, o: no}, t)
			.easing(TWEEN.Easing.Cubic.InOut)
			.onUpdate(function (){
				piso_1s.position.y = slotPiso2.y;
				for (var i = 0; i < matPisoB.length; i++) {
					matPisoB[i].opacity = slotPiso2.o;
				};
				//console.log(o);
			})
			.onComplete(function (){
				if (no == 0) {
					for (var i = 0; i < piso_1s.children.length; i++) {
						piso_1s.children[i].visible = false;
					};
				};
			})
		tween.start();
	}*/


	// ANIMAR PUNTERO
	function animarPuntero( xA, yA, t ) {
		// nVueltas
		tween = new TWEEN.Tween(slotPuntero)
			.interpolation( TWEEN.Interpolation.CatmullRom )
			.to({x: xA, y: yA}, t)

			.easing(TWEEN.Easing.Sinusoidal.InOut) // Cubic.InOut
			.onUpdate(function (){
				puntero.position.x = slotPuntero.x;
				puntero.position.z = slotPuntero.y;
			})
			.onComplete(function (){
				nVueltas = nVueltas + 1;
				if (nVueltas < 1) {
					slotPuntero.x = 360; //arregloVec[0].x;
  					slotPuntero.y = -199; //arregloVec[0].z;
					puntero.position.x = slotPuntero.x;
					puntero.position.z = slotPuntero.y;
					animarPuntero( 5000 );
				}else if (pasos == 2){														// PASO 3
					huds[3].visible = false;
					animarCam(  dB1[5][0], dB1[5][1], dB1[5][2], 0, 5000 );					// anim camara: cam01 > cam05 (de lado)
					pasos = 3;
				}else if (pasos == 6){														// PASO 7
					huds[2].visible = false;												// hud no Cb visible
					//console.log("ok");
					if (camino[3]) {
						tramos[1].visible = tramos[2].visible = true;						// tubo B visible
					};
					//tramos[2].visible = true;												// tubo B visible
					//tramos[0].visible = true;												// tubo A visible
					tramos[0].visible = true;												// tubo V visible
					animarCam(  dB1[6][0], dB1[6][1], dB1[6][2], 0, 3000 );
					for (var i = 0; i < matPisoA.length; i++) {
						matPisoA[i].opacity = 1;
					};
					for (var i = 0; i < piso_1.children.length; i++) {
						piso_1.children[i].visible = true;
					};

					huds[6].visible = huds[7].visible = huds[8].visible = true;				// prender btns
					pasos = 7;
					//console.log(dB2[4]);
				};
			})
		tween.start();
	}

	// ANIMAR TARGET
	function animarHudA( o, t ) {
		tween = new TWEEN.Tween(slotHud)
			.to({o: o}, t)
			.easing(TWEEN.Easing.Cubic.InOut)
			.onUpdate(function (){
				huds[0].opacity = slotHud.o;
			})
			.onComplete(function(){
				//
			})
		tween.start();
	}

	//
	function onDocumentMouseDown( event ) {
		event.preventDefault();

		document.addEventListener( 'mousemove', onDocumentMouseMove, false );
		document.addEventListener( 'mouseup', onDocumentMouseUp, false );
		document.addEventListener( 'mouseout', onDocumentMouseOut, false );

		mouseXOnMouseDown = event.clientX - windowHalfX;
		mouseYOnMouseDown = event.clientY - windowHalfY;
		targetRotationOnMouseDown = targetRotation;
		targetElevationOnMouseDown = targetElevation;

	}

	function onDocumentMouseMove( event ) {

		mouseX = event.clientX - windowHalfX;
		mouseY = event.clientY - windowHalfY;

		targetRotation = targetRotationOnMouseDown + ( mouseX - mouseXOnMouseDown ) * 0.02;
		targetElevation = targetElevationOnMouseDown + ( mouseY - mouseYOnMouseDown ) * 0.02;
		//console.log("MouseDown ok");
	}

	function onDocumentMouseUp( event ) {

		document.removeEventListener( 'mousemove', onDocumentMouseMove, false );
		document.removeEventListener( 'mouseup', onDocumentMouseUp, false );
		document.removeEventListener( 'mouseout', onDocumentMouseOut, false );

		

	}

	function onDocumentMouseOut( event ) {

		document.removeEventListener( 'mousemove', onDocumentMouseMove, false );
		document.removeEventListener( 'mouseup', onDocumentMouseUp, false );
		document.removeEventListener( 'mouseout', onDocumentMouseOut, false );
	}

	function onDocumentTouchStart( event ) {

		if ( event.touches.length == 1 ) {

			event.preventDefault();

			mouseXOnMouseDown = event.touches[ 0 ].pageX - windowHalfX;
			mouseYOnMouseDown = event.touches[ 0 ].pageY - windowHalfY;
			targetRotationOnMouseDown = targetRotation;
			targetElevationOnMouseDown = targetElevation;
		}
	}

	function onDocumentTouchMove( event ) {

		if ( event.touches.length == 1 ) {

			event.preventDefault();

			mouseX = event.touches[ 0 ].pageX - windowHalfX;
			mouseY = event.touches[ 0 ].pageY - windowHalfY;
			targetRotation = targetRotationOnMouseDown + ( mouseX - mouseXOnMouseDown ) * 0.05;
			targetElevation = targetElevationOnMouseDown + ( mouseY - mouseYOnMouseDown ) * 0.05;

			if (mouseYOnMouseDown < -160) {
			if (mouseXOnMouseDown > -140 && mouseXOnMouseDown < -70) {
				//console.log(mouseXOnMouseDown);
				btns = 1;
				huds[6].color = new THREE.Color( 0xdddddd );
				huds[6].opacity = 1
				huds[7].color = huds[8].color = new THREE.Color( 0xffffff );
				huds[7].opacity = huds[8].opacity = 0.6;
				
			} else if (mouseXOnMouseDown > -70 && mouseXOnMouseDown < 70) {
				btns = 2;
				huds[7].color = new THREE.Color( 0xdddddd );
				huds[7].opacity = 1
				huds[6].color = huds[8].color = new THREE.Color( 0xffffff );
				huds[6].opacity = huds[8].opacity = 0.6;

				// reiniciar
				n = 3;
		        slotCam.x = dB1[n][0];
		        slotCam.y = dB1[n][1];
		        slotCam.z = dB1[n][2];

		        slotTar.x = dB2[n][0];
		        slotTar.y = dB2[n][1];
		        slotTar.z = dB2[n][2];

		        camera.position.x = slotCam.x;										
		        camera.position.y = slotCam.y;
		        camera.position.z = slotCam.z;
		        camera.lookAt( slotTar );

		        slotPuntero.x = camino[2][0][0];
  				slotPuntero.y = -camino[2][0][1];

				pasos = 1
				//huds[6].visible = huds[7].visible = huds[8].visible = false;
				huds[1].visible = false;

				puntero.visible = false;	
				tramos[0].visible = false;

				if (camino[3]) {

					tramos[1].visible = tramos[2].visible = false;						// tubo B visible
					for (var i = 0; i < matPisoA.length; i++) {
						matPisoA[i].opacity = slotPiso1.o = 1;
					};

					for (var i = 0; i < matPisoB.length; i++) {
						matPisoB[i].opacity = slotPiso2.o = 0;
					};

					if (camino[3]==2) {
						//animarPiso1( -40, 0, 3000 );										// anim cambio de piso 2
						
						//animarPiso2( -45, 1, 3000 );
						piso_2.position.y = slotPiso2.y = 0;

					} else if (camino[3]==-1){
						//animarPiso1( 40, 0, 3000 );											// anim cambio de piso -1
						piso_1s.position.y = slotPiso1s.y = 0;
						//animarPiso1s( 45, 1, 3000 );
					};
				};

				piso_1.position.y = piso_T.position.y = slotPiso1.y = 0;

				for (var i = 0; i < piso_2.children.length; i++) {
					piso_2.children[i].visible = false;
				};

				for (var i = 0; i < piso_1s.children.length; i++) {
					piso_1s.children[i].visible = false;
				};
				
				

				//piso_1.position.y = slotPiso1.y;
				


				animarCam(  dB1[1][0], dB1[1][1], dB1[1][2], 0, 3000 );
				animarTar(  dB2[1][0], dB2[1][1], dB2[1][2], 0, 3000 );
	
			} else if (mouseXOnMouseDown > 70 && mouseXOnMouseDown < 140) {
				btns = 3;
				huds[8].color = new THREE.Color( 0xdddddd );
				huds[8].opacity = 1;
				huds[6].color = huds[7].color = new THREE.Color( 0xffffff );
				huds[6].opacity = huds[7].opacity = 0.6;

				animarCam(  dB1[2][0], dB1[2][1], dB1[2][2], 0, 2000 );
			};
		};

		}
	}
	

	function onKeyDown ( event ) {

		//var vel = 50

		switch( event.keyCode ) {

			case 78: // /*N*/
				//code
				//animarCam(  dB1[1][0], dB1[1][1], dB1[1][2], 2000  );
				//piso_2.position.y=0;
				animarPiso1( -40, 0, 2000 );
				animarPiso2( -45, 1, 2000 );
				break;
			
			case 53: // /*5*/
				//code
				//piso_1.position.y=20;
				animarCam(  dB1[5][0], dB1[5][1], dB1[5][2], 0, 2000 );
				break;

			case 50: // 2
				//code
				//animarCam( [0, 200, 1, 2000] );
				//animarCam(  dB1[2][0], dB1[2][1], dB1[2][2], 2000 );
				animarCam(  dB1[2][0], dB1[2][1], dB1[2][2], 0, 2000 );
				//piso1.position.y=0;
				break;

			case 49: // 1
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

				animarCam(  dB1[1][0], dB1[1][1], dB1[1][2], 0, 2000  );

				break;

			case 37: // izq
				animarCam(  dB1[3][0], dB1[3][1], dB1[3][2], 500 );
				break;

			case 39: // der
				//code
				//piso_2.position.y=20;
				animarPiso1( 0, 1, 2000 );
				animarPiso2( 0, 0, 2000 );
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


		//var timer = Date.now() * 0.0001;

		//var time = Date.now();
		/*var time = clock.getElapsedTime();
		var looptime = 10 * 1000; // era 5 > más rápido
		var t = (time % looptime) / looptime;*/
		//n = t.charAt(2)
		


		//camera.lookAt( scene.position );
		//camera.lookAt( new THREE.Vector3( 309, 1, -201 ) );

		// Rig camara
		//camera.lookAt( rutap[rigCam].position );					// -- > actualiza target
		//camera.lookAt( coordMedio );								// pos target cam01: punto medio del rec
		//camera.position.set(rigCam.x, 125, rigCam.z);

		camera.lookAt( slotTar );

		if (pasos == 8 && btns == 1) {
			//camera.position.x += ( mouseX - camera.position.x ) * .05;
			//camera.position.y += ( - mouseY - camera.position.y ) * .05;

			if (camino[3]) {
				if (camino[3]==-1) {
		        	n = 2;
		        }else{
		        	n = -2;
		        }
				
			}else{														// PASO 3
				n = 2;
			};

			targetElevation 	= Math.max(targetElevation, n);
			targetElevation 	= Math.min(targetElevation,15);
			camera.position.y += ( targetElevation*12 - camera.position.y  ) * 0.05;

			//camera.position.x += ( (Math.cos( targetRotation ) * camera.position.x) - camera.position.x ) * 0.05;
			//camera.position.z += ( (Math.sin( targetRotation ) * camera.position.z) - camera.position.z ) * 0.05;

			if (camino[3]) {
				m = 4;
			}else{														// PASO 3
				m = 1;
			};


			camera.position.x += (( dB2[m][0] + (Math.cos( targetRotation/5.5 ) * 100) ) - camera.position.x ) * 0.05;
			camera.position.z += (( dB2[m][2] + (Math.sin( targetRotation/5.5 ) * 100) ) - camera.position.z ) * 0.05;

			slotCam.x = camera.position.x;
			slotCam.y = camera.position.y;
			slotCam.z = camera.position.z;
			//console.log( targetRotation );
			//camera.position.y = Math.min(camera.position.y, 0);

			/*if (mouseXOnMouseDown > -140 && mouseXOnMouseDown < -70) {
				console.log(mouseXOnMouseDown);
			} else{
				//
			};*/

		};
		
		//console.log(mouseXOnMouseDown);



		renderer.render( scene, camera );
		//renderer.autoUpdateObjects = true;
		//composer.render( 0.1 );

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
		renderer.setClearColorHex(0xf4f4f4, 1);
		//renderer.antialias = true;
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

		loader.load( "src/js/mapa/v06h.js", callbackFinished );
		
	}
}
</script>
<div id="progress">
			<span id="message"></span>
			<center>
				<div id="progressbar" class="shadow"><div id="bar" class="shadow"></div></div>
				<div id="start" class="disabled"></div>
			</center>
		</div>
		<!-- <div id="huds" z-index="100">
			<ul id="btns">
				<li>
					<img src="src/images/mapa/inCa.png" width="120" height = "120">
				</li>

				<li>
					<img src="src/images/mapa/inCa.png" width="120" height = "120">
				</li>
			</ul>
		</div> -->

	</body>
</html>
