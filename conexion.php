<?php




// Realizando una consulta SQL
$query = 'select * from bots order by id';


$connect = pg_connect("host=ec2-54-163-240-54.compute-1.amazonaws.com port=5432 dbname=d97hqd0uu802gp user=vxoxyrownzuzgx password=0669e05248eea11fe4bdc6d93f82de2248a0dd9a9345ee09215f6f4d2d393862") or die('No se ha podido conectar: ' . pg_last_error());;
//conectarse a una base de datos llamada "mary" en el host "sheep" con el nombre de usuario y password

if (!$connect) {
  echo "Ocurrió un error.\n";
  exit;
}

$result = pg_query($connect, "select * from bots order by id");
if (!$result) {
  echo "Ocurrió un error.\n";
  exit;
}

while ($row = pg_fetch_row($result)) {
  echo "bots: $row[0] 
  echo "<br/>\n";
}

// Liberando el conjunto de resultados
pg_query($query);

// Cerrando la conexión
pg_close($connect);


?>
