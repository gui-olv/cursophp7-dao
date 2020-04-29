<?php

require_once ("config.php");




$usuarios = new Usuario();
$usuarios->obterPorPk(1);

echo $usuarios

?>