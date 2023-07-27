<?php
    require_once "main.php";

    $id = limpiar_cadena($_POST['cliente_id']);

    //Verificar cliente
    $veri_cliente = conexion();
    $veri_cliente = $veri_cliente->query("SELECT * FROM cliente WHERE cliente_id = '$id'");

    if ($veri_cliente->rowCount() <= 0 ) {
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                El Cliente no existe
            </div>
        ';
        exit();
    } else {
        $datos = $veri_cliente->fetch();
    }
    $veri_cliente = null;

    //Almacenamiento de datos
    $nombre = limpiar_cadena($_POST['cliente_nombre']);
    $dni = limpiar_cadena($_POST['cliente_dni']);
    $direccion = limpiar_cadena($_POST['cliente_direccion']);
    $marca = limpiar_cadena($_POST['cliente_marca']);
    $modelo = limpiar_cadena($_POST['cliente_modelo']);

    //Verificar campos obligatorios
    //Verificar campos obligatorios
    if ($nombre == "") {
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }
    if ($dni == "") {
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }
    if ($direccion == "") {
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }
    if ($marca == "") {
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }
    if ($modelo == "") {
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    //Verificar nombre

    if ($nombre!= $datos['cliente_nombre']) {
        $veri_nombre = conexion();
        $veri_nombre = $veri_nombre->query("SELECT cliente_nombre FROM cliente WHERE cliente_nombre ='$nombre'");
        if ($veri_nombre->rowCount() > 0) {
            echo '
                <div class="notification is-danger is-light">
                    <strong>Ocurrio un error inesperado!</strong><br>
                    El Cliente ingresado ya existe
                </div>
            ';
            exit();
    
        }
        $veri_nombre = null; //Cerrar conexion
    }

    //Actualizacion de datos
    $actualizar_cliente = conexion();
    $actualizar_cliente = $actualizar_cliente->prepare("UPDATE cliente SET cliente_nombre = :nombre, cliente_dni = :dni, cliente_direccion = :direccion, cliente_marca = :marca, cliente_modelo = :modelo WHERE cliente_id = :id");

    $marcadores = [
        ":nombre" => $nombre,
        ":dni" => $dni,
        ":direccion" => $direccion,
        ":marca" => $marca,
        ":modelo" => $modelo,
        ":id" => $id
    ];

    if ($actualizar_cliente->execute($marcadores)) {
        echo '
            <div class="notification is-success is-light">
                <strong>Cliente actualizado!</strong><br>
                El Cliente ha sido actualizado con exito
            </div>
        ';
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el cliente, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_cliente = null;

