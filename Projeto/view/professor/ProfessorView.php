<?php $professores = $_REQUEST['professores']; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Professores</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Atenção!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseja realmente excluir este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close-modal">Voltar</button>
                    <button type="button" class="btn btn-danger" id="delete-button">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userDeleted" tabindex="-1" aria-labelledby="userDeletedLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="userDeletedLabel">Parabéns</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Usuário deletado com sucesso!
                </div>
            </div>
        </div>
    </div>


    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/' . FOLDER . '/view/navbar.php'; ?>
    <div class="container">
        <div class="row text-center">
            <h2>Semana da acessibilidade</h2>

            <div class="text-center">
                <img class="img-fluid" src="https://lupanews.com.br/wp-content/uploads/2020/10/img-20191002-wa0017.jpg" alt="Oferece uma representação visual inclusiva, abrangendo diversas formas de habilidades e necessidades especiais">
            </div>
            <br>
            <a href="/<?PHP echo FOLDER; ?>/?controller=Professor&acao=salvar" class="btn btn-success">Cadastrar professor</a>
            <br>
            <br>
            <table class="table table-secondary table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Idade</th>
                        <th scope="col">Ações</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($professores as $id => $professorAtual) { ?>
                        <tr>
                            <td><?php
                                $id++;
                                echo $id; ?></td>
                            <td><?php echo $professorAtual['nome']; ?></td>
                            <td><?php echo $professorAtual['idade']; ?></td>
                            <td>
                                <a href="/<?php echo FOLDER; ?>?controller=Professor&acao=editar&id=<?php echo $professorAtual['id']; ?>" class="btn btn-success">Editar</a>
                                <!-- <a href="/<?php echo FOLDER; ?>?controller=Professor&acao=excluir&id=<?php echo $professorAtual['id']; ?>" class="btn btn-danger">Excluir</a> -->
                                <button type="button" class="btn btn-danger select-user-to-delete" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-id="<?php echo $professorAtual['id']; ?>">
                                    Excluir
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
        <script>
            $("#delete-button").on("click", function() {
                let idUsuario = $(this).attr('data-id');

                let url = "/<?php echo FOLDER; ?>/?controller=Professor&acao=excluir&id=" + idUsuario;
                $.get(url, function(data) {
                    $("#close-modal").click();
                    var myModal = new bootstrap.Modal(document.getElementById('userDeleted'))
                    myModal.show();

                });
                console.log("O usuario que sera deletado é: " + idUsuario);
            });

            $("#userDeleted").on("hidden.bs.modal", function() {
                location.reload();
            });

            $(".select-user-to-delete").on("click", function() {

                $("#delete-button").attr("data-id", $(this).attr('data-id'));
                console.log("O usuário selecionou o estudante que quer deletar");
            });
        </script>

</body>

</html>