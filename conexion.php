<?php




// Realizando una consulta SQL
$query = 'select * from bots order by id';


$connect = pg_connect("host=ec2-54-163-240-54.compute-1.amazonaws.com port=5432 dbname=d97hqd0uu802gp user=vxoxyrownzuzgx password=0669e05248eea11fe4bdc6d93f82de2248a0dd9a9345ee09215f6f4d2d393862") or die('No se ha podido conectar: ' . pg_last_error());;
//conectarse a una base de datos llamada "mary" en el host "sheep" con el nombre de usuario y password


// Imprimiendo los resultados en HTML
echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

    $QUERYINSERT= ("INSERT INTO 'bots' ('uid', 'device', 'version', 'lati', 'longi', 'provider', 'phone', 'sdk', 'random') VALUES ('ide1', 'DASD', '5.5', '1.0', '$Longi', '1.0', '54546546546', '9.5', '555')");
	$result = pg_query($QUERYINSERT) or die('La consulta fallo: ' . pg_last_error());

// Liberando el conjunto de resultados
pg_free_result($result);

// Cerrando la conexión
pg_close($dbconn);


?>
