<?php

$database = @mysql_connect('localhost', 'root', 'S33gull');
if (!$database) {
	exit('<p>Unable to connect to the database server at this time. </p>');
} 
if (!@mysql_select_db('cms-speedie')) {
	exit('<p>Unable to connect to the database at this time.</p>');
}

?>