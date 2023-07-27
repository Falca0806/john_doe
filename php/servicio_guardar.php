<?php
require_once "../include/session_start.php";
    require_once "main.php";

    //Almacenamiento de datos
    $servicio = limpiar_cadena($_POST['servicio_nombre']);
    $precio = limpiar_cadena($_POST['servicio_precio']);
    $cliente = limpiar_cadena($_POST['cliente_servicio']);



    //Verificar campos obligatorios
    if ($servicio == "" || $precio == "" ||  $cliente == "" ) {
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    //Verificar integridad de datos
    //Nombre
    if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{5,100}",$servicio)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                El Nombre del Servicio no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    //precio
    if (verificar_datos("[0-9.]{1,25}",$precio)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                El Precio no coincide con el formato solicitado
            </div>
        ';
        exit();
    }


    //Verificar cliente
    $veri_cliente = conexion();
    $veri_cliente = $veri_cliente->query("SELECT cliente_id FROM cliente WHERE cliente_id ='$cliente'");
    if ($veri_cliente->rowCount() <= 0) {
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                El Cliente seleccionado no existe
            </div>
        ';
        exit();

    }
    $veri_cliente = null; //Cerrar conexion

    //Guardar datos
    $guardar_ser = conexion();
    $guardar_ser = $guardar_ser->prepare("INSERT INTO servicio(servicio_nombre, servicio_precio, cliente_id, usuario_id) VALUES(:servicio, :precio, :cliente, :usuario)");

    $marcadores = [
        ":servicio" => $servicio,
        ":precio" => $precio,
        ":cliente" => $cliente,
        ":usuario" => $_SESSION['id']
    ];

    $guardar_ser->execute($marcadores);

    if ($guardar_ser->rowCount() == 1) {
        echo '
            <div class="notification is-success is-light">
                <strong>Servicio Registrado!</strong><br>
                El Servicio se registró con exito
            </div>
        ';
        
    } else {

        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                No se puede registrar el servicio, por favor intente nuevamente
            </div>
        ';
    }

    $guardar_ser = null;