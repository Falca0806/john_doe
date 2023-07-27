<div class="container is-fluid mb-6">
	<h1 class="title">Servicio</h1>
	<h2 class="subtitle">Nuevo Servicio</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
        require_once "./php/main.php";

    ?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/servicio_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data" >
		<div class="columns">
            <div class="column">
		    	<div class="control">
					<label>Servicio</label>
				  	<input class="input" type="text" name="servicio_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{5,100}" maxlength="100" required >
				</div>
		  	</div>
			<div class="column">
		    	<div class="control">
					<label>Precio</label>
				  	<input class="input" type="text" name="servicio_precio" pattern="[0-9.]{1,25}" maxlength="25" required >
				</div>
		  	</div>
		</div>
		<div class="columns">

		</div>
		<div class="columns">
			<div class="column">
				<label>Cliente</label><br>
		    	<div class="select is-rounded">
				  	<select name="cliente_servicio" >
				    	<option value="" selected="" >Seleccione una opción</option>
				    	
                        <?php
                            $clientes = conexion();
                            $clientes = $clientes->query("SELECT * FROM cliente");
                            if ($clientes->rowCount() > 0) {
                                $clientes = $clientes->fetchAll();
                                foreach ($clientes as $row ) {
                                    echo '<option value="'. $row['cliente_id'] .'" >'. $row['cliente_nombre'] .'</option>';
                                }
                            }
                            $clientes = null;
                        ?>
				  	</select>
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>