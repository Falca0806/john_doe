<div class="container is-fluid mb-2">
	<h1 class="title">Clientes</h1>
	<h2 class="subtitle">Nuevo Cliente</h2>
</div>

<div class="container pb-2 pt-2">

	<div class="form-rest mb-2 mt-2"></div>

	<form action="./php/cliente_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" >
		<h1 class="title has-text-centered">Datos del Cliente</h1>
		<div class="columns">
			
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="cliente_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>DNI</label>
				  	<input class="input" type="text" name="cliente_dni" pattern="[0-9]{7,8}" maxlength="8" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Direción</label>
				  	<input class="input" type="text" name="cliente_direccion" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required >
				</div>
		  	</div>
		</div>
		<h1 class="title has-text-centered">Datos del Vehículo</h1>
		<div class="columns">
		
		  	<div class="column">
		    	<div class="control">
					<label>Marca</label>
				  	<input class="input" type="text" name="cliente_marca" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Modelo</label>
				  	<input class="input" type="text" name="cliente_modelo" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required >
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>