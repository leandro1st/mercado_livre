<?php 
	$connect = mysqli_connect("localhost", "root", "") or die("<center>Ocorreu um erro ao estabelecer conexão com nossos servidores! Por favor, tente mais tarde.</center>");
	$select_db = mysqli_select_db($connect, "mercado_livre") or die("<center>Ocorreu um erro ao estabelecer conexão com nosso Banco de Dados! Por favor, tente mais tarde.</center>");

	$kits = 'kits';
	$cod_athos = 'cod_athos';
	$nome = 'nome';
	$quantidade = 'quantidade';
	$preco = 'preco';
	$preco_total = 'preco_total';
	$ncm = 'ncm';
	$cest = 'cest';
	$kit_nome = 'kit_nome';
	$id_kit = 'id_kit';
?>