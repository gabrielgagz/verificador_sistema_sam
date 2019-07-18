<?php
////// Funcion PHP para la obtención del Dígito Verificador para el Sistema SAM 2000 ////
///// Por Gabriel A. Gomez - g.a.gomez@gmail.com //// 
///// Licencia: Apache 2.0 - https://www.apache.org/licenses/LICENSE-2.0 /////

// Obtenemos los datos de un formulario o como variable URL
$cuit = $_REQUEST['cuit'];
$periodo = $_REQUEST['periodo'];

// Armamos el codigo completo a procesar
$codigo_proceso = $cuit.$periodo;
// Sumamos las posiciones impares y las multiplicamos por 3
$codigo_impares = (($codigo_proceso[0] + $codigo_proceso[2] + $codigo_proceso[4] + $codigo_proceso[6] + $codigo_proceso[8] + $codigo_proceso[10] + $codigo_proceso[12] + $codigo_proceso[14] + $codigo_proceso[16]) * 3);
// Sumamos las posiciones pares
$codigo_pares = $codigo_proceso[1] + $codigo_proceso[3] + $codigo_proceso[5] + $codigo_proceso[7] + $codigo_proceso[9] + $codigo_proceso[11] + $codigo_proceso[13] + $codigo_proceso[15];
// Obtenemos el código menor para su posterior comparación 
$codigo_menor = ($codigo_impares + $codigo_pares);
// Obtenemos el código mayor. Acá utilizamos la funcion ceil() para redondearlo (FIXME)
$codigo_mayor = ceil($codigo_menor / 10) * 10;

// Si menor es igual a mayor, significa que la diferencia es 10. Por lo que el digito verificador es 9 (10 -1)
if ($codigo_menor == $codigo_mayor) {$verificador = "9"; } else {$verificador = ($codigo_mayor - $codigo_menor)-1;}

// Imprimimos el dígito verificador en pantalla
echo $verificador;
?>
