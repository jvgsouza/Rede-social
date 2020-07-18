<?PHP

$conexao = mysqli_connect('localhost','root','');
$banco = mysqli_select_db($conexao,'form');
 
$name = $_POST['user'];
$senha = $_POST['senha'];
$email = $_POST['email'];
$foto = $_FILES["foto"];

$testemail = mysqli_query($conexao, "select * from usuarios where email = '$email'");

if (mysqli_num_rows($testemail) > 0) {
	header ('Location: erroemail.html');
}

else{
if (!empty($foto["name"])){
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
 
        	$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
 
        	$caminho_imagem = "imagens/" . $nome_imagem;
 
			move_uploaded_file($foto["tmp_name"], $caminho_imagem);
		
			$sql = mysqli_query($conexao, "INSERT INTO usuarios (nome, senha, email, foto) VALUES ('$name', '$senha', '$email', '$nome_imagem')") or die("Erro ao cadastrar usuário!");
		
            header ('Location: suces.html');
        }
	}
?>

