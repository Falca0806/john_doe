<?php

    $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

    $tabla = "";

    if (isset($busqueda) && $busqueda != "") {
        $consulta_datos = "SELECT * FROM cliente WHERE  cliente_nombre LIKE '%$busqueda%' ORDER BY cliente_nombre ASC LIMIT $inicio, $registros";

        $consulta_total = "SELECT COUNT(cliente_id) FROM cliente WHERE cliente_nombre LIKE '%$busqueda%'";
        
    } else {
        $consulta_datos = "SELECT * FROM cliente ORDER BY cliente_nombre ASC LIMIT $inicio, $registros";

        $consulta_total = "SELECT COUNT(cliente_id) FROM cliente";
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
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Dirección</th>
                    <th>Marca</th>
                    <th>Modelo</th>
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
            <tr class="has-text-centered" >
                <td>'. $contador .'</td>
                <td>'. $rows['cliente_nombre'] .'</td>
                <td>'. $rows['cliente_dni'] .'</td>
                <td>'. $rows['cliente_direccion'] .'</td>
                <td>'. $rows['cliente_marca'] .'</td>
                <td>'. $rows['cliente_modelo'] .'</td>
                <td>
                    <a href="index.php?vista=client_update&client_id_up='. $rows['cliente_id'] .'" class="button is-info is-rounded is-small">Actualizar</a>
                </td>
                <td>
                    <a href="'. $url . $pagina . ' &client_id_del='. $rows['cliente_id'] .'" class="button is-danger is-rounded is-small">Eliminar</a>
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
                <td colspan="7">
                    No hay registros en el sistema
                </td>
            </tr>
            ';
        }
        
        
    }
    
    
    $tabla .= '</tbody></table></div>';

    if ($total >= 1 && $pagina <= $n_paginas) {
        $tabla .= '
        <p class="has-text-right">Mostrando categorias <strong>'. $pag_inicio .'</strong> al <strong>'. $pag_final .'</strong> de un <strong>total de '. $total .'</strong></p>
        ';
    }
    $conexion = null;
    echo $tabla;

    //Paginador
    if ($total >= 1 && $pagina <= $n_paginas) {
        echo paginador_tablas($pagina, $n_paginas,$url, 7);
    }