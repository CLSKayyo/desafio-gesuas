<?php

require './classes/database.php';

$db = new DBController();

$users = $db->select('usuarios');