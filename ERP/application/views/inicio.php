<body>	
	<div id="workplace">
		
		<h1 style="float: left;"class="fa fa-arrow-circle-left">&nbsp;</h1> <!-- Estoy dentro del workplace -->
		<h2 style="float: left;">Por aquí</h2>

	
	</div>	
</body>
<script type="text/javascript">
	webix.ready(function(){
		webix.markup.init();


		webix.ui({
				view:"window",
				height:190,
			    width:600,
			    head:"BIENVENIDO A STACK ERP",
			    //position:"center",
			    position:function(state){ 
			        state.left = 440; //fixed values
			        state.top = 200;
			        state.width -=60; //relative values
			        state.height +=60;
			    },
				body:{
					cols:[					
					{
						rows:[
						{height: 30},
						{
							cols: [
							{width: 100},
							{
								template:"<img class='logo_big' src='<?= base_url('assets/imgs/isotipo.png') ?> '>", 
								css: "fondo", 
								height: 150,
								align: "center"
							},
							
							]
						},
						{
							view:"label", label:"Para comenzar a trabajar seleccione un módulo a su izquierda",
							align: "center"							
						}]
					}]
				}
			}).show();


	});	
</script>

</html>