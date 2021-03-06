<?php
if (!isset($_SESSION)) {
	session_start();
}

require_once("../class/conexao.php");

$image = $_FILES['foto_usuario']['name'];
//Diretório da imagem
$target = "../imagens/";
$temp = explode(".", $_FILES["foto_usuario"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);

$primeiro_nome = mysqli_real_escape_string($conexao, ucfirst($_POST['primeiro_nome']));
$ultimo_nome = mysqli_real_escape_string($conexao, ucfirst($_POST['ultimo_nome']));
$cpf = mysqli_real_escape_string($conexao, trim($_POST['cpf']));
$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$apelido = mysqli_real_escape_string($conexao, ucfirst($_POST['apelido']));
$foto_usuario = mysqli_real_escape_string($conexao, trim($_POST['foto_usuario']));
$senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));
$conf_senha = $_POST['conf_senha'];
$rua = mysqli_real_escape_string($conexao, trim($_POST['rua']));

if ($image == '') {
	$newfilename = 'usuario.jpg';
}

if ($senha != $conf_senha) {
	$_SESSION['senhas_diferentes'] = true;
	header("Location: ../view/cadastro.php?nome=$primeiro_nome&sobrenome=$ultimo_nome&cpf=$cpf&apelido=$apelido&email=$email");
	exit;
}

if (empty($primeiro_nome) or empty($ultimo_nome) or empty($cpf) or empty($email) or empty($apelido) or empty($senha) or empty($rua)) {
	$_SESSION['falta_info'] = true;
	header("Location: ../view/cadastro.php?nome=$primeiro_nome&sobrenome=$ultimo_nome&cpf=$cpf&apelido=$apelido&email=$email");
	exit;
}

$sql = "select count(*) as total from usuarios where cpf = '$cpf' and fk_id_tipo = 3 or email = '$email' and fk_id_tipo = 3";
$result = mysqli_query($conexao, $sql);
$row_ban = mysqli_fetch_assoc($result);

if($row_ban['total'] == 1) {
	$_SESSION['ban'] = true;
	header("Location: ../view/cadastro.php?nome=$primeiro_nome&sobrenome=$ultimo_nome&cpf=$cpf&apelido=$apelido&email=$email");
	exit;
}

$sql = "select count(*) as total from usuarios where cpf = '$cpf'";
$result = mysqli_query($conexao, $sql);
$row_cpf = mysqli_fetch_assoc($result);

if($row_cpf['total'] == 1) {
	$_SESSION['cpf_existe'] = true;
	header("Location: ../view/cadastro.php?nome=$primeiro_nome&sobrenome=$ultimo_nome&cpf=$cpf&apelido=$apelido&email=$email");
	exit;
}


$sql = "select count(*) as total from usuarios where email = '$email'";
$result = mysqli_query($conexao, $sql);
$row_email = mysqli_fetch_assoc($result);

if($row_email['total'] == 1) {
	$_SESSION['email_existe'] = true;
	header("Location: ../view/cadastro.php?nome=$primeiro_nome&sobrenome=$ultimo_nome&cpf=$cpf&apelido=$apelido&email=$email");
	exit;
}

if (strlen($senha) < 4) {
	$_SESSION['senha_caracteres'] = true;
	header("Location: ../view/cadastro.php?nome=$primeiro_nome&sobrenome=$ultimo_nome&cpf=$cpf&apelido=$apelido&email=$email");
	exit;
}


$sql = "select count(*) as total from usuarios where apelido = '$apelido'";
$result = mysqli_query($conexao, $sql);
$row_apelido = mysqli_fetch_assoc($result);

if($row_apelido['total'] == 1) {
	$_SESSION['apelido_existe'] = true;
	header("Location: ../view/cadastro.php?nome=$primeiro_nome&sobrenome=$ultimo_nome&cpf=$cpf&apelido=$apelido&email=$email");
	exit;
}


$sql = "insert into usuarios(nome_completo, foto_usuario, apelido, email, cpf, senha, fk_id_rua_user, fk_id_tipo) values ('$primeiro_nome $ultimo_nome', '$newfilename', '$apelido', '$email', '$cpf', '$senha', $rua, 2);";

if($conexao->query($sql) === TRUE) {

	move_uploaded_file($_FILES['foto_usuario']['tmp_name'], $target.$newfilename);
	$_SESSION['status_cadastro'] = true;
}

$conexao->close();

header('Location: ../view/telaLogin.php');
exit;

?>