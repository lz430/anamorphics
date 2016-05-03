<?php

$database = @mysql_connect('localhost', 'cms-twlewis-user', 'HwuUeuqsG.AT');
if (!$database) {
	exit('<p>Unable to connect to the database server at this time. </p>');
} 
if (!@mysql_select_db('cms-twlewis-dev')) {
	exit('<p>Unable to connect to the database at this time.</p>');
}

?>