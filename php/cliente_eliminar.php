<?php
    $client_id_del = limpiar_cadena($_GET['client_id_del']);

    //Verificar cliente
    $veri_cliente = conexion();
    $veri_cliente = $veri_cliente->query("SELECT cliente_id FROM cliente WHERE cliente_id = '$client_id_del'");
    if ($veri_cliente->rowCount() == 1) {

        //Verificar categoria tenga productos registrados
        $veri_servicio = conexion();
        $veri_servicio = $veri_servicio->query("SELECT cliente_id FROM servicio WHERE cliente_id = '$client_id_del' LIMIT 1");

        if ($veri_servicio->rowCount() <= 0) {
            $eliminar_cliente = conexion();
            $eliminar_cliente = $eliminar_cliente->prepare("DELETE FROM cliente WHERE cliente_id = :id");

            $eliminar_cliente->execute([":id" => $client_id_del]);

            if ($eliminar_cliente->rowCount() == 1) {
                echo '
                    <div class="notification is-success is-light">
                        <strong>Categoría eliminada!</strong><br>
                        Los datos del cliente han sido eliminados
                    </div>
                ';
                
            } else {
                echo '
                    <div class="notification is-danger is-light">
                        <strong>Ocurrio un error inesperado!</strong><br>
                        No se puede eliminar el cliente, por favor intente nuevamente
                    </div>
                ';
            }

            $eliminar_cliente = null;
        } else {
            echo '
                <div class="notification is-danger is-light">
                    <strong>Ocurrio un error inesperado!</strong><br>
                    No se puede eliminar el cliente ya que tiene servicios registrados
                </div>
            ';
        }
        $veri_servicio = null;
        
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                El Cliente que intenta eliminar no existe!
            </div>
        ';
    }
    $veri_cliente = null;
    