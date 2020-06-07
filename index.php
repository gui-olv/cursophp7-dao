<?php

require_once ("config.php");



 
//Usuario por Pk 
//$usuarios = new Usuario();
//$usuarios->obterPorPk(1);
//echo $usuarios; // chama o metodo magico __toString e imprime 
 
//Lista de Usuarios 
//$lista =  Usuario:: listarUsuarios();
//echo json_encode($lista); // é uma lista de objetos 

 
//carregar lista que contenha no nome ...
//$search = Usuario::search("gui");
//echo json_encode($search);

// carregar lista que contenha no
//$login =  new Usuario();
//$login -> login("Guilherme","1234");
//echo login;

//Incluir Usuários 
//$usuario = new Usuario("Teste","12323%*");
//$usuario->incluir();
//echo $usuario;

//Alterar Usuario 
//$usuario = new Usuario();
//$usuario->obterPorPk(16);
//$usuario->alterar("Guilherme","9876");
//echo $usuario;

// DExcluir Usuario 
$usuario = new Usuario();
$usuario->obterPorPk(7);
$usuario->excluir();

echo $usuario;

?>