<body>
	<div id="workplace">
		<h1>Servicios</h1>
		<div id="add"></div>
		<div id="tabla"></div>
		<div id="pager"></div>
	</div>
</body>
<script>
	var aid;
	var opt_estado = [{id:'',value:''},{id:1,value:'Alta'},{id:2,value:'Baja'}];
	var dt_serv = webix.ui({
		container:"tabla",
	    view:"datatable",
	    id:'dt_serv',
		editable:true,
		editaction:"dblclick",
		autoheight:true,
		select:'row',
		url:'<?=base_url('produccion/getServicios')?>',
	    columns:[
	        { id:"id",width:50,header:["No",{content:"textFilter"}]},
	        { id:"nombre",editor:"text",header:["Nombre",{content:"textFilter"}],fillspace:true},
	        { id:"descripcion",editor:"popup",header:["Descripcion",{content:"textFilter"}],fillspace:true},
	        { id:"status",editor:"richselect",options:opt_estado,header:['Estado',{content:'selectFilter'}]},
	    ],
	    rules:{
        	nombre:function(val){
				return webix.rules.isNotEmpty(val.trim());
			},
			descripcion:function(val){
				return webix.rules.isNotEmpty(val.trim());	
			},
    	},
	    on:{
    		onAfterEditStop:function(){
				var data = this.getItem(aid);
				if(this.validate()){
					webix.ajax().post('<?= base_url('produccion/saveServicios')?>',data,function(result){
						var resp  = JSON.parse(result)
						if(resp.status){
							webix.message({type:"default", text:"Guardado correcto"});
							$$("dt_serv").load('<?=base_url('produccion/getServicios')?>');
						}else{
							webix.message({type:"error", text:"error al guardar"});
						}
					});
				}else {webix.message({type:"error", text:"error campo vacio"});
						$$("dt_serv").load('<?=base_url('produccion/getServicios')?>');
						this.clearValidation();
					}
    		},
    		onItemDblClick:function(item){
				aid = item;
			},
    	},
    	pager:{
        container:"pager",
        size:8,
        group:5
    	},
	});
	var agregar = webix.ui({
	    container:"add",
	    id:"addBtn",
	    view:"button",
	    label:"<span class='webix_icon fa-icon fa-plus-circle'></span><span class='text'>Agregar</span>",
	    type:"htmlbutton",
	    height:40,
	    width:100,
	    align:"center",
	    click:function(){$$("win2").show();}
	});
	
var frm = {
			view:"form",
			id:'frm',
			borderless:true,
			elements: [
				{ view:"text", label:'Nombre', name:"nombre" },
				{ view:"text", label:'Descripcion', name:"descripcion" },
				{ view:"button", value: "Guardar", click:function(){
					if (this.getParentView().validate()){ //validate form
                        guardar();
                    }
					else
						webix.message({ type:"error", text:"Campos invalidos" });
				}},
				{view:"button",value:"Cancelar",click:function(){
					this.getTopParentView().hide();
				}},
			],
			rules:{
				"nombre":webix.rules.isNotEmpty,
				"descripcion":webix.rules.isNotEmpty
			},
			elementsConfig:{
				labelPosition:"top",
			}
		};
webix.ui({
            view:"window",
            id:"win2",
            width:300,
            position:"center",
            modal:true,
            head:"Agregar un servicio",
            body:webix.copy(frm)
        });
function guardar(){
	var data = $$("frm").getValues();
	webix.ajax().post('<?= base_url('produccion/saveServicios')?>',data,function(result){
        var resp  = JSON.parse(result)
        if(resp.status){    
            webix.message("Guardado");
            $$("dt_serv").load('<?=base_url('produccion/getServicios')?>');
            $$("win2").hide(); //hide window
            $$("frm").clearValidation();
            $$("frm").clear();
        }else webix.alert("Valio keso");
    });
}
</script>
</html>