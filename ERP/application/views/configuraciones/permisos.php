<body >
	<div id="workplace" sytle="height: 90%;">
		
		<h1>Permisos</h1>
		<!-- ESTE ES UN EJEMPLO PARA EVA-->
		<!-- Botones de menú -->
		<div id="opciones"></div>

		<!-- Tabla -->
		<div id="table_permisos" ></div>

		<!-- Dialog de Nuevo Usuario -->
		<div id="configurar_usuario" style="float: left; box-shadow: 0px 1px 5px 0px #888888; margin:20px;"></div>

		<!-- Dialog para cambiar Pass -->
		<div id="cambiar_contraseña" style="float: left; box-shadow: 0px 1px 5px 0px #888888; margin:20px;"></div>


	</div>
</body>
<script type="text/javascript">
	

	webix.ready(function()
	{
		webix.markup.init();


		// OPCIONES DE AGREGAR PERFILES NUEVOS
		webix.ui(
		{
			container: "opciones",
			cols: [
			{},
			{
				view: "button", 
				label: "Agregar perfil",
				width: 150, 
				type: "iconButton",
				icon: "users",
				click: function()
				{
					$$("window_insert").show();
					//$$("window_insert").show(); Viejo
				}				
			}] // FIN DE COLS DE OPCIONES
		}); // FIN DE OPCIONES DE AGREGAR USUARIOS

		



		

		

		// TABLA DE USUARIOS
		//tabla_usuarios = webix.ui( VIEJO
		tabla_perfiles = webix.ui(
		{
			view: "datatable",
			id: "table_permisos",
			container: "table_permisos",
			select:"row",
			editable:true,
			editaction:"dblclick",
			autoheight:false,
			height: 450,	
			leftSplit:2,		
			columns: [
			{ id: "id", header:["No" , {content:"textFilter"}], width: 50},
			{ id: "perfil", header: ["Perfil", {content:"textFilter"}], adjust: true},	

			<? foreach ($perfiles as $perfil) { ?>
				
				{ id: "<?= $perfil->COLUMN_NAME ?>", editor:"richselect", options:  ["0","1"], header: ["<?= $perfil->COLUMN_NAME ?>", {content: "selectFilter"}], width: 100},		
			<? } ?>		 
			//{ id: "status", editor:"richselect", options:  ["0","1"], header: ["Estado", {content: "selectFilter"}], width: 100}
			],
			on:{
					onSelectChange:function(){
						var text = "Selected: "+tabla_perfiles.getSelectedId(true).join();
						//$$("button_change_pass").enable();				
						//webix.message("ID" +text);
					},
					onAfterEditStop:function(state, editor){
						// SÍ SE MODIFICÓ 
						console.log(state);
						console.log(editor);
						if(state.value != state.old)
						{
							if (state.value != "")
							{
								var data = {id: editor.row, field: editor.column, value: state.value };
						        //webix.message("El valor ha cambiado");
						        //webix.message("El campo es: " + editor.column);
						        //webix.message("El valor nuevo: " + state.value);
						        //webix.message("El ID es: " + editor.row); 
						        //console.log(editor);
						        //webix.ajax().sync().post("<?= base_url('configuraciones/editar_Usuario')?>", data, function callback(res) VIEJO
						        webix.ajax().sync().post("<?= base_url('configuraciones/editar_Perfil')?>", data, function callback(res)
								{
									if (res > 0) 
									{
										$$('table_permisos').load("<?= base_url('configuraciones/get_Perfiles');?>");
										webix.message("Cambios hechos con éxito ");
									}									
								}); // FIN DE AJAX
						    }
						    else 
						    {
						    	webix.message({type:"error", text: "El campo no puede quedar vacio"});
						    }
					    }  
		    		},
				},
				
			url: "<?= base_url('configuraciones/get_Perfiles');?>"
		}); // FIN DE TABLA USUARIOS





		// FORM CONFIGURAR USUARIO
		var form_insertar = {	
			id: "form_nuevo_perfil",
			//hidden: true,
			view: "form",
			//container: "configurar_usuario",
			width:500,
			rows:[			
			{
				view:"text", 
				label: "Perfil",
				labelWidth: 90,
				name:"perfil",	
				placeholder: "Escriba el nombre del perfil nuevo",
				invalidMessage: "Debe escribir un nombre para perfil",
				validate:"isNotEmpty", validateEvent:"key",
			}, 						
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
							//webix.message({type:"default", text:"Campos en orden"});
							var data = $$("form_nuevo_perfil").getValues();
							//console.log(data);
							webix.ajax().sync().post("<?= base_url('configuraciones/nuevo_Perfil')?>", data, function callback(res)
							{
								//webix.alert(res);
								if (res > 0) 
								{
									$$("form_nuevo_perfil").clear();
									$$("form_nuevo_perfil").clearValidation();
									$$("window_insert").hide();

									$$('table_permisos').load("<?= base_url('configuraciones/get_Perfiles');?>");
									//webix.alert("Usuario guardado con éxito: ");
									webix.alert({
									    title: "Éxito",
									    text: "Perfil guardado con éxito",									    
									});
								}
								else if (res <= 0) // NO TRAJO ID DE UNO NUEVO, YA EXISTE
								{
									webix.alert({
									    title: "Error",
									    text: "El perfil ya existe",
									    type:"alert-error"
									});
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
						$$("form_nuevo_perfil").clear();
						$$("form_nuevo_perfil").clearValidation();
						$$("window_insert").hide();
					}
				}] // FIN DE COLS DE BOTONES
			}], // FIN DE ROWS DEL FORM			
		};// FIN DE FORM CONFIGURAR USUARIO






		// WINDOW PARA CONFIGURAR USUARIO
		webix.ui(
		{
			id: "window_insert",
			view:"window", move:false,
		    head:"Nuevo perfil", left:100, top:100, position: "center",
			body:webix.copy(form_insertar),
			modal: true		
		});
		// FIN DE WINDOW PARA CONFIGURAR USUARIO







	});  // FIN DE WEBIX.READY
</script>
</html>