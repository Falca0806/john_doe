<div class="container is-fluid mb-6">
	<h1 class="title">Clientes</h1>
	<h2 class="subtitle">Actualizar Cliente</h2>
</div>

<div class="container pb-2 pt-2">
    <?php
        include "./include/btn_back.php";

        require_once "./php/main.php";

        $id = (isset($_GET['client_id_up'])) ? $_GET['client_id_up'] : 0 ;
        $id = limpiar_cadena($id);

        $veri_cliente = conexion();
        $veri_cliente = $veri_cliente->query("SELECT * FROM cliente WHERE cliente_id ='$id'");

        if ($veri_cliente->rowCount() > 0) {
            $datos = $veri_cliente->fetch();
    ?>
	<div class="form-rest 6 mt-6"></div>
	<form action="./php/cliente_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >
	<h1 class="title has-text-centered">Datos del Cliente</h1>
		<input type="hidden" name="cliente_id" value="<?php echo $datos['cliente_id']; ?>" required >
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="cliente_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required value="<?php echo $datos['cliente_nombre']; ?>">
				</div>
		  	</div>
		  	<div class="column">
			  <div class="control">
				  <label>DNI</label>
					<input class="input" type="text" name="cliente_dni" pattern="[0-9]{7,8}" maxlength="8" required value="<?php echo $datos['cliente_dni']; ?>">
			  </div>
			</div>
			<div class="column">
			  <div class="control">
				  <label>Direción</label>
					<input class="input" type="text" name="cliente_direccion" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required value="<?php echo $datos['cliente_direccion']; ?>">
			  </div>
			</div>
	  </div>
	  <h1 class="title has-text-centered">Datos del Vehículo</h1>
	  <div class="columns">
			<div class="column">
			  <div class="control">
				  <label>Marca</label>
					<input class="input" type="text" name="cliente_marca" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required value="<?php echo $datos['cliente_marca']; ?>">
			  </div>
			</div>
			<div class="column">
			  <div class="control">
				  <label>Modelo</label>
					<input class="input" type="text" name="cliente_modelo" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required value="<?php echo $datos['cliente_modelo']; ?>">
			  </div>
			</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Actualizar</button>
		</p>
	</form>


    <?php
        }else{
            include "./include/error_alert.php";
        }
        $veri_cliente = null;
    ?>
</div>