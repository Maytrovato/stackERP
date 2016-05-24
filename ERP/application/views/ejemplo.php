<body>	
	<div id="workplace">
		
		<h1>Este es un titulo</h1> <!-- Estoy dentro del workplace -->
		<div id="kek"> </div> <!-- Estoy dentro del workplace -->
		<form>
			<label>Persona</label>
			<input type="text">

			<div data-view="button" data-width="150">Button</div>
			<div data-view="text" data-label="INPUT">123456789</div>
			<div data-view="label" data-label="Label chingon"></div>
			<div data-view="template" data-height="35"> My header</div>

		</form>
	</div>	
</body>
<script type="text/javascript">
	webix.ready(function(){
		webix.markup.init();


		webix.ui({
			view: "label", 
			label: "Esta es una prueba de div", 
			container: "kek"
		});


	});	
</script>

</html>