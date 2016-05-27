<body >
	<div id="workplace" sytle="height: 90%;">
		
		<h1>Usuarios</h1>
		
		<div id="table_usuarios"> </div>
		<div id="configurar_usuario" style="float: left; box-shadow: 0px 1px 5px 0px #888888; margin:20px;"></div>
		<div id="cambiar_contraseña" style="float: left; box-shadow: 0px 1px 5px 0px #888888; margin:20px;"></div>
		
	

	</div>
</body>
<script type="text/javascript">
	webix.ready(function()
	{
		webix.markup.init();


		var perfiles = "<?= base_url('configuraciones/getPerfiles')?>";
		var perfiles2 = <?= $perfiles?>;
		//console.log(perfiles);
		//alert(perfiles);

		var per = [
			{id: "1", value:"Administrador"},
			{id: "2", value:"Gerente"},
			{id: "3", value:"Empleado"},
		];

		var usu = [
			{id: "1", value:"maytro"},
			{id: "2", value:"kim"},
			{id: "3", value:"igno"},
			{id: "4", value:"castro"},
		];
		

		var sucu = [
			{id:"1", value: "1"}, 
			{id:"2", value: "2"}, 
			{id:"3", value: "3"}, 
			{id:"4", value: "4"}
		];



		tabla_usuarios = webix.ui(
		{
			container: "table_usuarios",
			view: "datatable",
			select:"row",
			editable:true,
			editaction:"dblclick",
			autoheight:true,
			columns: [
			{ id: "id", header: "No", width: 50},
			{ id: "Empleado", header: ["Empleado", {content:"textFilter"}], width: 200, fillspace: true},
			{ id: "Usuario", editor:"popup", header: ["Usuario", {content:"textFilter"}], width: 200, fillspace: true},
			//{ id: "Usuario", editor:"richselect", options: usu, header: ["Usuario", {content:"textFilter"}], width: 200, fillspace: true},
			{ id: "Perfil", editor:"richselect", options: perfiles2, header: ["Perfil", {content:"selectFilter"}], width: 200},
			{ id: "Sucursal", editor:"richselect", collection: sucu, header: ["Sucursal", {content:"selectFilter"}], width: 200, fillspace: true },
			{ id: "Estado", editor:"richselect", collection: ["0","1"], header: ["Estado", {content: "selectFilter"}], width: 100}
			],
			on:{
					onSelectChange:function(){
						var text = "Selected: "+tabla_usuarios.getSelectedId(true).join();
						webix.message(text);
					}
				},
				

			url: "<?= base_url('configuraciones/getUsuarios');?>"
		});



		// FORM CONFIGURAR USUARIO
		webix.ui(
		{	
			hidden: false	,
			view: "form",
			container: "configurar_usuario",
			width:500,
			rows:[
			{
				view:"label", label:"<b>Configurar usuario</b>"
			},
			{
				view:"combo", 
				label: "Empleado",				
				name:"empleado",
				placeholder: "Busque un empleado",
				options: <?= $empleados?>
			},
			{
				view:"richselect", 
				label: "Perfil",
				name:"perfil",
				value:1, 
				options:[ 
					{ id:1, value:"Banana" },
					{ id:2, value:"Papaya" }, 
					{ id:3, value:"Apple" }
				]
			},
			{
				view:"richselect", 
				label: "Sucursal",
				name:"sucursal",
				value:1, 
				options:[ 
					{ id:1, value:"Banana" },
					{ id:2, value:"Papaya" }, 
					{ id:3, value:"Apple" }
				]
			},
			{
				view:"text", 
				label: "Usuario",
				name:"usuario",	
				placeholder: "Escriba su nombre de usuario"			
			}, 
			{
				cols:[ 
				{
					view: "label", label: "Contraseña", width: 80
				},
				{
					view:"button", 
					label: "Cambiar contraseña",
					click:function(){
						webix.message('Cambiar contraseña');
						$$("form_cambiar_pass").show();
					} 						
				}]
			},			
			{
				cols:[ 
				{},
				{
					view:"button", 
					label: "Guardar",
					type: "form"
				},
				{
					view:"button", 
					label: "Cancelar",
					type: "danger"	
				}]
			}]
		});
		// FIN DE FORM CONFIGURAR USUARIO









		// FORM CAMBIAR CONTRASEÑA
		webix.ui(
		{
			id: "form_cambiar_pass",
			hidden: true,
			width:500,
			view: "form",
			container: "cambiar_contraseña",			
			rows:[
			{
				view:"label", label:"<b>Cambiar contraseña</b>"
			},
			{
				view:"text", 
				label: "Nueva ",
				
				name:"usuario",	
				placeholder: "Escriba su nueva contraseña"	
			},
			{
				view:"text", 
				label: "Repetir",
				name:"repetir",	
				placeholder: "Repita su nueva contraseña"	
			},
			{
				cols:[ 
				{},
				{
					view:"button", 
					label: "Guardar",
					type: "form"
				},
				{
					view:"button", 
					label: "Cancelar",
					type: "danger",
					click:function(){
						
						$$("form_cambiar_pass").clear();
						$$("form_cambiar_pass").hide();
					} 
				}]
			}]
		});
		// FIN DE FORM CAMBIAR CONTRASEÑA





	});  // FIN DE WEBIX.READY
</script>
</html>