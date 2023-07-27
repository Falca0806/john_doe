<?php
    $servi_id_del = limpiar_cadena($_GET['servi_id_del']);

    //Verificar servicio
    $veri_servi = conexion();
    $veri_servi = $veri_servi->query("SELECT servicio_id FROM servicio WHERE servicio_id = '$servi_id_del'");
    if ($veri_servi->rowCount() == 1) {

        $eliminar_servicio = conexion();
        $eliminar_servicio = $eliminar_servicio->prepare("DELETE FROM servicio WHERE servicio_id = :id");

        $eliminar_servicio->execute([":id" => $servi_id_del]);

        if ($eliminar_servicio->rowCount() == 1) {
            echo '
                <div class="notification is-success is-light">
                    <strong>Servicio eliminado!</strong><br>
                    Los datos del servicio han sido eliminados
                </div>
            ';
            
        } else {
            echo '
                <div class="notification is-danger is-light">
                    <strong>Ocurrio un error inesperado!</strong><br>
                    No se pudo eliminar el servicio, por favor intente nuevamente
                </div>
            ';
        }

        $eliminar_servicio = null;
    }
    $veri_servi = null;
    