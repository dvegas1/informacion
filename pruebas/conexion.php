<?php

$dbconn = pg_connect("host=ec2-54-163-240-54.compute-1.amazonaws.com dbname=d97hqd0uu802gp user=vxoxyrownzuzgx password=0669e05248eea11fe4bdc6d93f82de2248a0dd9a9345ee09215f6f4d2d393862")
    or die('No se ha podido conectar: ' . pg_last_error());


// Realizando una consulta SQL
$query = 'select * from bots order by id';

$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

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

// Liberando el conjunto de resultados
pg_free_result($result);

// Cerrando la conexión
pg_close($dbconn);


?>