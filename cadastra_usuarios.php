<?php
include "conexao.php";

$nome = $_POST['nome_app'];
$email = $_POST['email_app'];
$senha = $_POST['senha_app'];

$sql_verifica = "SELECT * FROM clientes WHERE email = :EMAIL";
$stmt = $PDO->prepare($sql_verifica);
$stmt->bindParam(':EMAIL', $email);
$stmt->execute();

if($stmt->rowCount() > 0) {

    $retornoApp = array("CADASTRO" => "EMAIL_ERROR");
} else {

    $sql_insert = "INSERT INTO clientes (nome, email, senha) VALUES (:NOME, :EMAIL, :SENHA )";
    $sql_retorna_id = "SELECT id FROM clientes ORDER BY ID DESC LIMIT 1";
    $stmt = $PDO->prepare($sql_insert);
    $stmt2 = $PDO->prepare( $sql_retorna_id);

    $stmt->bindParam(':NOME', $nome);
    $stmt->bindParam(':EMAIL', $email);
    $stmt->bindParam(':SENHA', $senha);

    if ($stmt->execute() && $stmt2->execute()) {
        
        $dados = $stmt2->fetch(PDO::FETCH_OBJ);
        $retornoApp = array("CADASTRO" => "SUCESSO", "ID"=>$dados->id);

    } else {

        $retornoApp = array("CADASTRO" => "ERRO");

    }
}

echo json_encode($retornoApp);
?>