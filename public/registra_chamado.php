<?php

	session_start();

	//estamos trabalhando na montagem do texto
	$titulo = str_replace('#', '-', $_POST['titulo']);
	$categoria = str_replace('#', '-', $_POST['categoria']);
	$descricao = str_replace('#', '-', $_POST['descricao']);

	//implode('#', $_POST);

	$texto = $_SESSION['id'] . '#' . $titulo . '#' . $categoria . '#' . $descricao . PHP_EOL;


	//abrindo o arquivo
	$arquivo = fopen('../private/arquivo.hd', 'a');
	//escrevendo o texto
	$escreveu = fwrite($arquivo, $texto);
	//fechando o arquivo
	fclose($arquivo);

	//redirecionar com feedback
	if($escreveu !== false) {
		header('Location: abrir_chamado.php?cadastro=sucesso');
	} else {
		header('Location: abrir_chamado.php?cadastro=erro');
	}
?>