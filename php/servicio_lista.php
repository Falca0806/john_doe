<?php

    $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
    $tabla = "";

    $campos = "servicio.servicio_id, servicio.servicio_nombre, servicio.servicio_precio, servicio.fecha_orden, servicio.cliente_id, cliente.cliente_nombre, cliente.cliente_dni, cliente.cliente_marca, cliente.cliente_modelo";

    if (isset($busqueda) && $busqueda != "") {

        $consulta_datos = "SELECT $campos FROM servicio INNER JOIN cliente ON servicio.cliente_id=cliente.cliente_id  WHERE  servicio_nombre LIKE '%$busqueda%' OR cliente_nombre LIKE '%$busqueda%' LIMIT $inicio, $registros";

        $consulta_total = "SELECT COUNT(servicio_id) FROM servicio WHERE servicio_nombre LIKE '%$busqueda%' OR cliente_nombre LIKE '%$busqueda%'";
        
    } else {
        $consulta_datos = "SELECT $campos FROM servicio INNER JOIN cliente ON servicio.cliente_id=cliente.cliente_id ORDER BY servicio_id ASC LIMIT $inicio, $registros";

        $consulta_total = "SELECT COUNT(servicio_id) FROM servicio";
    }

    $conexion = conexion();

    $datos = $conexion->query($consulta_datos);
    $datos = $datos->fetchAll();
    
    $total = $conexion->query($consulta_total);
    $total = (int) $total->fetchColumn();

    $n_paginas = ceil( $total / $registros);

    $tabla .= '
        <div class="table-container">
            <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                <thead>
                <tr class="has-text-centered">
                    <th>#</th>
                    <th>Servicio</th>
                    <th>Vehículo</th>
                    <th>Cliente</th>
                    <th>DNI</th>
                    <th>Fecha</th>
                    <th>Precio</th>
                    <th colspan="2">Opciones</th>
                </tr>
                </thead>
                <tbody>
    ';

    if ($total >= 1 && $pagina <= $n_paginas) {
        $contador = $inicio + 1;
        $pag_inicio = $inicio + 1;
        foreach ($datos as $rows) {
            $tabla .='
                <td>'. $contador .'</td>
                <td>'. substr($rows['servicio_nombre'], 0, 20) .'</td>
                <td>'. substr($rows['cliente_marca']. '-' . $rows['cliente_modelo'], 0, 20) .'</td>
                <td>'. $rows['cliente_nombre'] .'</td>
                <td>'. $rows['cliente_dni'] .'</td>
                <td>'. $rows['fecha_orden'] .'</td>
                <td>'. $rows['servicio_precio'] .' $</td>
                <td>
                    <a href="'. $url . $pagina . ' &servi_id_del='. $rows['servicio_id'] .'" class="button is-danger is-rounded is-small">Eliminar</a>
                </td>
                <td>
                    <a href="report_servicio.php?id= ' .$rows['servicio_id'] .'" class="button is-primary is-rounded is-small">PDF</a>
                </td>
            </tr>
            ';
            $contador ++;
        }

        $pag_final = $contador - 1;
    } else {
        if ($total >= 1) {
            $tabla .= '
            <tr class="has-text-centered" >
                <td colspan="6">
                    <a href="'. $url .' 1" class="button is-link is-rounded is-small mt-2 mb-2">
                        Haga clic acá para recargar el listado
                    </a>
                </td>
            </tr>
            ';
        } else {
            $tabla .= '
            <tr class="has-text-centered" >
                <td colspan="10">
                    No hay registros en el sistema
                </td>
            </tr>
            ';
        }
        
        
    }
    
    
    $tabla .= '</tbody></table></div>';

    if ($total >= 1 && $pagina <= $n_paginas) {
        $tabla .= '
        <p class="has-text-right">Mostrando servicios <strong>'. $pag_inicio .'</strong> al <strong>'. $pag_final .'</strong> de un <strong>total de '. $total .'</strong></p>
        ';
    }
    $conexion = null;
    echo $tabla;

    //Paginador
    if ($total >= 1 && $pagina <= $n_paginas) {
        echo paginador_tablas($pagina, $n_paginas,$url, 7);
    }