<?php
    require_once "main.php";

       //Almacenamiento de datos
   $nombre = limpiar_cadena($_POST['cliente_nombre']);
   $dni = limpiar_cadena($_POST['cliente_dni']);
   $direccion = limpiar_cadena($_POST['cliente_direccion']);
   $marca = limpiar_cadena($_POST['cliente_marca']);
   $modelo = limpiar_cadena($_POST['cliente_modelo']);

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

    //Verificar integridad de datos
    if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}",$nombre)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                El Nombre no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    //Verificar integridad de datos
    if (verificar_datos("[0-9]{7,8}",$dni)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                El DNI no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    //Verificar integridad de datos
    if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}",$direccion)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                La Dirección no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    //Verificar integridad de datos
    if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}",$marca)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                La Marca no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    //Verificar integridad de datos
    if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}",$modelo)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                El Modelo no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    

    //Verificar nombre
    $veri_nombre = conexion();
    $veri_nombre = $veri_nombre->query("SELECT cliente_nombre FROM cliente WHERE cliente_nombre ='$nombre'");
    if ($veri_nombre->rowCount() > 0) {
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                El Cliente ya existe!
            </div>
        ';
        exit();

    }
    $veri_nombre = null; //Cerrar conexion

    //Guardar datos
    $guardar_cliente = conexion();
    $guardar_cliente = $guardar_cliente->prepare("INSERT INTO cliente(cliente_nombre, cliente_dni, cliente_direccion, cliente_marca, cliente_modelo) VALUES(:nombre, :dni, :direccion, :marca, :modelo)");

    $marcadores = [
        ":nombre" => $nombre,
        ":dni" => $dni,
        ":direccion" => $direccion,
        ":marca" => $marca,
        ":modelo" => $modelo
    ];

    $guardar_cliente->execute($marcadores);

    if ($guardar_cliente->rowCount() == 1) {
        echo '
            <div class="notification is-success is-light">
                <strong>Cliente Registrado!</strong><br>
                El Cliente se registró con exito
            </div>
        ';
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>Ocurrio un error inesperado!</strong><br>
                No se puede registrar el cliente, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_cliente = null;
