<?php

$conexao = mysqli_connect('localhost', 'root', '');
$banco = mysqli_select_db($conexao,'form');

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = mysqli_query($conexao, "select * from usuarios where email = '$email' and senha = '$senha'");

if (mysqli_num_rows($sql) <= 0) {
    header ('Location: erro.html');
}

else {
    session_start();
    $result = $sql->fetch_array();

    $_SESSION['email'] = $result['email'];
    $_SESSION['nome'] = $result['nome'];
    $_SESSION['senha'] = $result['senha'];
    $_SESSION['foto'] = $result['foto'];

    header ('Location: perfil.php');
}

?>