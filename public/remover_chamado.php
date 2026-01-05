<?php

  require_once '../private/validador_acesso.php';

  // só aceitar POST
  if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: consultar_chamado.php');
    exit;
  }

  if(!isset($_POST['index']) || !is_numeric($_POST['index'])) {
    header('Location: consultar_chamado.php?remover=erro');
    exit;
  }

  $index = intval($_POST['index']);

  // ler todos os chamados (mantendo linhas como estão)
  $arquivo = fopen('../private/arquivo.hd', 'r');
  $chamados = array();

  while(!feof($arquivo)) {
    $registro = fgets($arquivo);
    $chamados[] = $registro;
  }

  fclose($arquivo);

  if(!isset($chamados[$index])) {
    header('Location: consultar_chamado.php?remover=erro');
    exit;
  }

  $chamado_dados = explode('#', $chamados[$index]);

  // validar permissões: admin (perfil_id == 1) pode remover qualquer, usuário só o próprio
  if($_SESSION['perfil_id'] != 1 && $_SESSION['id'] != $chamado_dados[0]) {
    header('Location: consultar_chamado.php?remover=negado');
    exit;
  }

  // remover o registro
  unset($chamados[$index]);

  // reescrever arquivo mantendo a ordem/linhas restantes
  $arquivo = fopen('../private/arquivo.hd', 'w');
  foreach($chamados as $linha) {
    // escrever exatamente o conteúdo das linhas restantes
    if($linha !== null) {
      fwrite($arquivo, $linha);
    }
  }

  fclose($arquivo);

  header('Location: consultar_chamado.php?remover=sucesso');
  exit;

?>