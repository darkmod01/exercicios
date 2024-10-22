<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"> <!-- Aqui vai o CSS -->
    <title>Document</title>
</head>
<body>
    <section class="vh-180">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="jumbotron">
                    <!-- Cabeçalho de página -->
                    <div class="row">
                        <h2>AULA DE POE - CRUD <span class="badge text-bg-secondary">v 1.0.0 SENAI - Aula PBC</span></h2>
                    </div>
                </div>
                <!-- Aqui o conteúdo do Banco -->
                <div class="row">
                    <a class="btn btn-success" href="create.php">Add</a>
                    <!-- Aqui entram os dados da tabela -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">NOME</th>
                                <th scope="col">ENDEREÇO</th>
                                <th scope="col">TELEFONE</th>
                                <th scope="col">E-MAIL</th>
                                <th scope="col">IDADE</th>
                                <th scope="col">AÇÃO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'banco.php';
                            $pdo = Banco::conectar();
                            $sql = "SELECT * FROM tb_alunos ORDER BY codigo DESC"; // Correção na consulta SQL
                            foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<th scope="row">' . $row['codigo'] . '</th>';
                                echo '<td>' . $row['name'] . '</td>';
                                echo '<td>' . $row['endereco'] . '</td>';
                                echo '<td>' . $row['fone'] . '</td>';
                                echo '<td>' . $row['email'] . '</td>';
                                echo '<td>' . $row['idade'] . '</td>';
                                echo '<td width="7">';
                                echo '<a class="btn btn-primary" href="read.php?id=' . $row['codigo'] . '">Info</a>';
                                echo '<a class="btn btn-warning" href="update.php?id=' . $row['codigo'] . '">Alterar</a>';
                                echo '<a class="btn btn-danger" href="delete.php?id=' . $row['codigo'] . '">Excluir</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                            Banco::desconectar();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <div class="d-flex flex-column flex-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
        <div class="text-white mb-3 mb-md-0">
            Copyright 2024. All rights reserved.
        </div>
    </div>
</body>
</html>
