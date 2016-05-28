<body >
	<div id="workplace" sytle="height: 90%;">
		
		<h1>Usuarios</h1>
		
		<div id="opciones"></div>
		<div id="table_usuarios"></div>
		<div id="configurar_usuario" style="float: left; box-shadow: 0px 1px 5px 0px #888888; margin:20px;"></div>
		<div id="cambiar_contraseña" style="float: left; box-shadow: 0px 1px 5px 0px #888888; margin:20px;"></div>
		
	

	</div>
</body>
<script type="text/javascript">
	webix.ready(function()
	{
		webix.markup.init();


		//var perfiles = "<?= base_url('configuraciones/getPerfiles')?>";
		var perfiles = <?= $perfiles?>;



		// OPCIONES DE AGREGAR USUARIOS
		webix.ui(
		{
			container: "opciones",
			cols: [
			{},
			{
				view: "button", 
				label: "Agregar usuario",
				width: 150, 
				type: "iconButton",
				icon: "user-plus",
				click: function()
				{
					$$("window_config").show();
				}
				
			},
			{
				view: "button", 
				id: "button_change_pass",
				label: "Cambiar contraseña",
				width: 180, 
				disabled : true,
				type: "iconButton",
				icon: "lock",
				click: function()
				{	
					$$("window_change").show();
				}
				
			},

			]
		}); // FIN DE OPCIONES DE AGREGAR USUARIOS

		







		// TABLA DE USUARIOS
		tabla_usuarios = webix.ui(
		{
			view: "datatable",
			id: "table_usuarios",
			container: "table_usuarios",
			select:"row",
			editable:true,
			editaction:"dblclick",
			autoheight:true,
			columns: [
			{ id: "id", header: "No", width: 50},
			{ id: "Empleado", header: ["Empleado", {content:"textFilter"}], width: 200, fillspace: true},
			{ id: "Usuario", editor:"popup", header: ["Usuario", {content:"textFilter"}], width: 200, fillspace: true},
			//{ id: "Usuario", editor:"richselect", options: usu, header: ["Usuario", {content:"textFilter"}], width: 200, fillspace: true},
			{ id: "Perfil", editor:"richselect", options: perfiles, header: ["Perfil", {content:"selectFilter"}], width: 200},
			{ id: "Sucursal",  header: ["Sucursal", {content:"selectFilter"}], width: 200, fillspace: true },
			{ id: "Estado", editor:"richselect", options:  ["0","1"], header: ["Estado", {content: "selectFilter"}], width: 100}
			],
			on:{
					onSelectChange:function(){
						var text = "Selected: "+tabla_usuarios.getSelectedId(true).join();
						$$("button_change_pass").enable();
						webix.message(text);
					}
				},
			url: "<?= base_url('configuraciones/get_Usuarios');?>"
		}); // FIN DE TABLA USUARIOS





		// FORM CONFIGURAR USUARIO
		var form_configurar = {	
			id: "form_configurar_usuario",
			//hidden: true,
			view: "form",
			//container: "configurar_usuario",
			width:500,
			rows:[			
			{
				view:"combo", 
				label: "Empleado",				
				name:"empleado",
				labelWidth: 90,
				placeholder: "Escriba o seleccione un empleado",
				invalidMessage: "Debe seleccionar un empleado",
				required: true,
				validateEvent:"blur",
				options: <?= $empleados?>,
				on: 
				{
					'onChange':function(id)
					{
						webix.message(this.getValue());
					}
				}
			},
			{
				view:"richselect", 
				label: "Perfil",
				labelWidth: 90,
				name:"perfil",
				placeholder: "Seleccione un perfil de usuario",
				invalidMessage: "Debe seleccionar un perfil",
				required: true,
				validateEvent:"blur",
				options: <?= $perfiles?>,
				on: 
				{
					'onChange':function(id)
					{
						webix.message(this.getValue());
					}
				}
			},
			{
				view:"richselect", 
				label: "Sucursal",
				labelWidth: 90,
				name:"sucursal",
				placeholder: "Seleccione una sucursal",
				invalidMessage: "Debe seleccionar una sucursal",
				required: true,
				validateEvent:"blur",
				options:[ 
					{ id:1, value:"Banana" },
					{ id:2, value:"Papaya" }, 
					{ id:3, value:"Apple" }
				]
			},
			{
				view:"text", 
				label: "Usuario",
				labelWidth: 90,
				name:"username",	
				placeholder: "Escriba el nombre de usuario",
				invalidMessage: "Debe escribir un nombre de usuario",
				validate:"isNotEmpty", validateEvent:"key",
			}, 
			{ // CONTRASEÑA /////////////////////////////////
				view:"text", 
				type: "password",
				label: "Contraseña",
				labelWidth: 150,
				name:"password1",	
				placeholder: "Escriba su contraseña",
				invalidMessage: "Especifique una contraseña",
				validate:"isNotEmpty", validateEvent:"key",
			}, 
			{
				view:"text", 
				type: "password",
				id:"password2",
				label: "Repita contraseña",
				labelWidth: 150,
				//name:"password2",	
				placeholder: "Vuelva a escribir su contraseña",
				invalidMessage: "Confirme su contraseña",
				validate:"isNotEmpty", validateEvent:"key",
			}, // FIN DE CONTRASEÑA /////////////////////////////////			
			{
				cols:[ 
				{},
				{
					view:"button", 
					label: "Guardar",
					type: "form",
					click: function()
					{
						// PARA SACAR EL VALOR DE TRUE O FALSE
						//webix.message("Validación de forma: "+ this.getFormView().validate());
						var res = this.getFormView().validate();
						
						if (res)
						{
							webix.message({type:"default", text:"Campos en orden"});
							var data = $$("form_configurar_usuario").getValues();
							console.log(data);
							webix.ajax().sync().post("<?= base_url('configuraciones/nuevo_Usuario')?>", data, function callback(res)
							{
								if (res > 0) 
								{
									$$("form_configurar_usuario").clear();
									$$("form_configurar_usuario").clearValidation();
									$$("window_config").hide();

									$$('table_usuarios').load("<?= base_url('configuraciones/get_Usuarios');?>");
									webix.alert("Usuario guardado con éxito: "+res);

								}
							});
						}
						//webix.message({type:"error", text:"Validación de forma: "+ this.getFormView().validate()}); 
					}					
				},
				{
					view:"button", 
					label: "Cancelar",					
					click: function()
					{
						$$("form_configurar_usuario").clear();
						$$("form_configurar_usuario").clearValidation();
						$$("window_config").hide();
					}
				}] // FIN DE COLS DE BOTONES
			}], // FIN DE ROWS DEL FORM
			rules: {
				$obj:function(data){					
					//passwords must be equal
					if (data.password1 != $$("password2").getValue()){
						webix.message({type:"error", text:"Las contraseñas no coinciden"}); 
						return false;
					}
					return true;
				}
			}
		};// FIN DE FORM CONFIGURAR USUARIO








		// FORM CAMBIAR CONTRASEÑA
		var form_cambiar_contraseña = {
			id: "form_cambiar_pass",			
			width:500,
			view: "form",		
			rows:[			
			{ // CONTRASEÑA
				view:"text", 
				type: "password",
				label: "Contraseña",
				labelWidth: 150,
				name:"password3",
				validate:"isNotEmpty", validateEvent:"key",	
				placeholder: "Escriba su contraseña nueva"
			}, 
			{
				view:"text", 
				type: "password",
				label: "Repita contraseña",
				labelWidth: 150,
				name:"password4",	
				validate:"isNotEmpty", validateEvent:"key",
				placeholder: "Vuelva a escribir su contraseña"
			}, // FIN DE CONTRASEÑA
			{
				cols:[ 
				{},
				{
					view:"button", 
					label: "Guardar",
					type: "form",
					click: function()
					{
						var res = this.getFormView().validate();
						
						if (res)
						{
							webix.message({type:"form", text:"Campos en orden"});	
						}
						
					}
				},
				{
					view:"button", 
					label: "Cancelar",
					
					click:function(){
						
						$$("form_cambiar_pass").clear();
						$$("window_change").hide();
					} 
				}] // FIN DE COLS DE BOTONES
			}], // FIN DE ROWS DEL FORM
			rules: {
				$obj:function(data){
					//password must not be empty
					if (!data.password3){
						webix.message("Especifique una contraseña");
						return false;
					}
					//passwords must be equal
					if (data.password4 != data.password3){
						webix.message({type:"error", text:"Las contraseñas no coinciden"}); 
						return false;
					}
					return true;
				}
			}
		};// FIN DE FORM CAMBIAR CONTRASEÑA







		// WINDOW PARA CONFIGURAR USUARIO
		webix.ui(
		{
			id: "window_config",
			view:"window", move:false,
		    head:"Nuevo usuario", left:100, top:100, position: "center",
			body:webix.copy(form_configurar),
			modal: true		
		});
		// FIN DE WINDOW PARA CONFIGURAR USUARIO


		// WINDOW PARA CAMBIAR CONTRASEÑA
		webix.ui(
		{
			id: "window_change",
			view:"window", move:false,
		    head:"Cambiar contraseña", left:100, top:100, position: "center",
			body:webix.copy(form_cambiar_contraseña),
			modal: true		
		});
		// FIN DE WINDOW PARA CAMBIAR CONTRASEÑA




	});  // FIN DE WEBIX.READY
</script>
</html>