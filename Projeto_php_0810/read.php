<?php
require 'banco.php';

$id = null;
if (!empty($_GET['codigo'])) {
    $id = $_REQUEST['codigo'];
    
    if (null == $id) {
        header("Location: index.php");
        exit();
    } else {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "SELECT * FROM tb_alunos WHERE codigo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        
        Banco::desconectar();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Informações do Contato</title>
</head>
<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="card">
                <div class="card-header">
                    <h3 class="well">Informações do Contato</h3>
                </div>
                <div class="container">
                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">Nome</label>
                            <div class="controls">
                                <label class="form-control">
                                    <?php echo htmlspecialchars($data['nome']); ?>
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Endereço</label>
                            <div class="controls">
                                <label class="form-control disabled">
                                    <?php echo htmlspecialchars($data['endereco']); ?>
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Telefone</label>
                            <div class="controls">
                                <label class="form-control disabled">
                                    <?php echo htmlspecialchars($data['fone']); ?>
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Email</label>
                            <div class="controls">
                                <label class="form-control disabled">
                                    <?php echo htmlspecialchars($data['email']); ?>
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Idade</label>
                            <div class="controls">
                                <label class="form-control disabled">
                                    <?php echo htmlspecialchars($data['idade']); ?>
                                </label>
                            </div>
                        </div>
                        <br />
                        <div class="form-actions">
                            <a href="index.php" class="btn btn-primary">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
