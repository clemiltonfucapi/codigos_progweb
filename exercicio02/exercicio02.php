<?php

require_once('classes/Cliente.php');

echo "<h1>Lista de Clientes JSON:</h1>";
echo Cliente::getList();

$c1 = new Cliente;
$c1->loadById(2);
//método to string
echo "<h1>Cliente carregado:</h1>";
//__toString()
echo $c1;


$c2 = new Cliente;
//setData($nome, $cpf, $email, $senha, $cidade, $estado, $celular)
$c2->setData('Martin Henrico','558.832.336-00','mhenrico@gmail.com','o3IdsesH1Y','João Pessoa','PB','(83) 98535-7336');
$c2->insert();
echo "<h1>Cliente inserido!</h1>";



$c3 = Cliente::search("Martin Henrico");
$c3->setCidade("Campina Grande");
$c3->update();
echo  "<h1>Cliente atualizado!</h1>";

/*
$nome, $cpf, $email, $senha, $cidade, $estado, $celular
*/



?>
