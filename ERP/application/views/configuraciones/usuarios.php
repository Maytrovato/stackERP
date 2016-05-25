<body>
	<div id="workplace">
		
		<h1>Usuarios</h1>
		<div id="form_1" style="float: left; box-shadow: 0px 1px 5px 0px #888888; margin:20px;"></div>
		<div id="form_2" style="float: left; box-shadow: 0px 1px 5px 0px #888888; margin:20px;"></div>
		
	</div>
</body>
<script type="text/javascript">
	webix.ready(function()
	{
		webix.markup.init();

		webix.ui(
		{	
			view: "form",
			container: "form_1",
			width:500,
			rows:[
			{
				view:"label", label:"<b>Configurar usuario</b>"
			},
			{
				view:"richselect", 
				label: "Empleado",				
				name:"empleado",
				value:1, 
				options:[ 
					{ id:1, value:"Banana" },
					{ id:2, value:"Papaya" }, 
					{ id:3, value:"Apple" }
				]
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








		// CAMBIAR CONTRASEÑA
		webix.ui(
		{
			id: "form_cambiar_pass",
			hidden: true,
			width:500,
			view: "form",
			container: "form_2",			
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



	});  // FIN DE WEBIX.READY
</script>
</html>