<?php
require 'banco.php';

$codigo = null;
if (!empty($_GET['codigo'])) {
    $codigo = $_REQUEST['codigo'];
    
    if (null == $codigo) {
        header("Location: index.php");
        exit();
    }
}

if (!empty($_POST)) {
    $nomeErro = null; 
    $enderecoErro = null; 
    $telefoneErro = null; 
    $emailErro = null;
    $idadeErro = null;

    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $idade = $_POST['idade'];

    // Validação
    $validacao = true;
    if (empty($nome)) {
        $nomeErro = 'Por favor, digite o nome!';
        $validacao = false;
    }
    
    if (empty($email)) {
        $emailErro = 'Por favor, digite o email!';
        $validacao = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErro = 'Por favor, digite um email válido!';
        $validacao = false;
    }

    if (empty($endereco)) {
        $enderecoErro = 'Por favor, digite o endereço!';
        $validacao = false;
    }

    if (empty($telefone)) {
        $telefoneErro = 'Por favor, digite o telefone!';
        $validacao = false;
    }

    if (empty($idade)) {
        $idadeErro = 'Por favor, preencha o campo idade!';
        $validacao = false;
    }

    // Atualizar dados
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "UPDATE tb_alunos SET nome = ?, endereco = ?, telefone = ?, email = ?, idade = ? WHERE codigo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $endereco, $telefone, $email, $idade, $codigo));
        
        Banco::desconectar();
        header("Location: index.php");
        exit();
    }
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM tb_alunos WHERE codigo = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($codigo));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    
    $nome = $data['nome'];
    $endereco = $data['endereco'];
    $telefone = $data['telefone'];
    $email = $data['email'];
    $idade = $data['idade'];
    
    Banco::desconectar();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFNGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <title>Atualizar Contato</title>
</head>
<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="card">
                <div class="card-header">
                    <h3 class="well">Atualizar Contato</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="update.php?codigo=<?php echo $codigo ?>" method="post">
                        <div class="form-group <?php echo !empty($nomeErro) ? 'has-error' : ''; ?>">
                            <label class="control-label">Nome</label>
                            <div class="controls">
                                <input name="nome" class="form-control" size="50" type="text" placeholder="Nome" value="<?php echo !empty($nome) ? $nome : ''; ?>">
                                <?php if (!empty($nomeErro)): ?>
                                    <span class="text-danger"><?php echo $nomeErro; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo !empty($enderecoErro) ? 'has-error' : ''; ?>">
                            <label class="control-label">Endereço</label>
                            <div class="controls">
                                <input name="endereco" class="form-control" size="80" type="text" placeholder="Endereço" value="<?php echo !empty($endereco) ? $endereco : ''; ?>">
                                <?php if (!empty($enderecoErro)): ?>
                                    <span class="text-danger"><?php echo $enderecoErro; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo !empty($telefoneErro) ? 'has-error' : ''; ?>">
                            <label class="control-label">Telefone</label>
                            <div class="controls">
                                <input name="telefone" class="form-control" size="50" type="text" placeholder="Telefone" value="<?php echo !empty($telefone) ? $telefone : ''; ?>">
                                <?php if (!empty($telefoneErro)): ?>
                                    <span class="text-danger"><?php echo $telefoneErro; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo !empty($emailErro) ? 'has-error' : ''; ?>">
                            <label class="control-label">E-mail</label>
                            <div class="controls">
                                <input name="email" class="form-control" size="50" type="text" placeholder="E-mail" value="<?php echo !empty($email) ? $email : ''; ?>">
                                <?php if (!empty($emailErro)): ?>
                                    <span class="text-danger"><?php echo $emailErro; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo !empty($idadeErro) ? 'has-error' : ''; ?>">
                            <label class="control-label">Idade</label>
                            <div class="controls">
                                <input name="idade" class="form-control" size="10" type="number" placeholder="Idade" value="<?php echo !empty($idade) ? $idade : ''; ?>">
                                <?php if (!empty($idadeErro)): ?>
                                    <span class="text-danger"><?php echo $idadeErro; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <a class="btn btn-danger" href="index.php">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
