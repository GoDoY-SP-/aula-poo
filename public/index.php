<?php
// Composer
require __DIR__ . '/../vendor/autoload.php';

// Action Menu
$actionExibir = (isset($_REQUEST['actEx'])) ? trim($_REQUEST['actEx']) : 'home';

// Ordenação
$pgOrdem = (isset($_REQUEST['pgOrd']) && $_REQUEST['pgOrd']) ? $_REQUEST['pgOrd'] : 'ASC';

// Lista de Clientes
$clienteServico = new \SoNAula\Servico\ClienteServico();
$clientesLista = $clienteServico->obterClientes($pgOrdem);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aula POO - School of Net</title>

    <!-- #### Twitter Bootstrap 3.3.6 #### -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- #### Fim - Twitter Bootstrap 3.3.6 #### -->
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<!-- Header Menu -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">SoN - Aula POO</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="menu-home active"><a href="/">Home</a></li>
                <li class="dropdown menu-drop-clientes">
                    <a href="#" class="dropdown-toggle menu-drop-clientes" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="menu-clientes"><a href="/index.php?actEx=clientes">Clientes</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<!-- Conteúdo -->
<div class="container">

    <?php if ($actionExibir == "home") : ?>
        <!-- HOME -->
        <div class="jumbotron">
            <h1>Aula POO - Orientação a Objetos</h1>
            <p>Este curso aborda as principais técnicas e conceitos de Orientação a Objetos, buscando trazer sempre o
                que há de mais novo no PHP para que você possa trabalhar de forma profissional e efetiva.</p>
        </div>
    <?php elseif ($actionExibir == "clientes") : ?>
        <!-- CLIENTES -->
        <div class="page-header">
            <h1>Clientes</h1>
        </div>
        <table class="table table-responsive table-striped table-hover">
            <thead>
            <tr>
                <th>
                    <a href="/index.php?actEx=clientes&pgOrd=<?= ($pgOrdem == 'ASC') ? 'DESC' : 'ASC' ?>">
                        ID <button type="button" class="btn btn-xs btn-link"><i class="glyphicon <?= ($pgOrdem == 'ASC') ? 'glyphicon-sort-by-attributes' : 'glyphicon glyphicon-sort-by-attributes-alt' ?>" aria-hidden="true"></i></button>
                    </a>
                </th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($clientesLista) : ?>
                <?php foreach ($clientesLista as $cliente) : ?>
                    <tr>
                        <td><?= $cliente->getId() ?></td>
                        <td><?= $cliente->getNome() ?></td>
                        <td><?= $cliente->getCpf() ?></td>
                        <td>
                            <a class="btn btn-xs"
                               data-toggle="modal"
                               data-target="#modalVisualizar"
                               data-cliente-id="<?= $cliente->getId() ?>"
                               data-cliente-nome="<?= $cliente->getNome() ?>"
                               data-cliente-cpf="<?= $cliente->getCpf() ?>"
                               data-cliente-endereco="<?= $cliente->getEndereco() ?>"
                               data-cliente-bairro="<?= $cliente->getBairro() ?>"
                               data-cliente-cidade="<?= $cliente->getCidade() ?>"
                               data-cliente-estado="<?= $cliente->getEstado() ?>">
                                <i class="glyphicon glyphicon-eye-open"></i> Visualizar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nenhum registro encontrado.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>

        <!-- MODAL Dados -->
        <div id="modalVisualizar" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Dados do Cliente</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-responsive borderless">
                            <tbody>
                            <tr>
                                <th width="1"><span class="pull-right">ID:</span></th>
                                <td><span id="modal-cliente-id"></span></td>
                            </tr>
                            <tr>
                                <th><span class="pull-right">Nome:</span></th>
                                <td><span id="modal-cliente-nome"></span></td>
                            </tr>
                            <tr>
                                <th><span class="pull-right">CPF:</span></th>
                                <td><span id="modal-cliente-cpf"></span></td>
                            </tr>
                            <tr>
                                <th><span class="pull-right">Endereço:</span></th>
                                <td><span id="modal-cliente-endereco">xx</span></td>
                            </tr>
                            <tr>
                                <th><span class="pull-right">Bairro:</span></th>
                                <td><span id="modal-cliente-bairro"></span></td>
                            </tr>
                            <tr>
                                <th><span class="pull-right">Cidade:</span></th>
                                <td><span id="modal-cliente-cidade"></span></td>
                            </tr>
                            <tr>
                                <th><span class="pull-right">Estado:</span></th>
                                <td><span id="modal-cliente-estado"></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    <?php else: ?>
        <!-- NOT FOUND -->
        <div class="jumbotron">
            <h2>Aula POO - Orientação a Objetos</h2>
            <h2><em>404</em></h2>
            <p>Página não encontrada</p>
        </div>
    <?php endif; ?>

</div><!-- /.container -->

<div class="clearfix"></div>

<!-- Footer -->
<footer>
    <div class="container-fluid text-center">
        <hr>
        <small class="text-muted">&copy; 2016 &raquo; Danilo Godoy</small>
    </div>
</footer>

<!-- #### Twitter Bootstrap 3.3.6 #### -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- #### Fim - Twitter Bootstrap 3.3.6 #### -->
<script>
    $(document).ready(function () {
        // Limpar a ativação de menus
        $('li[class*="menu"]').removeClass("active");

        // Desativar os dropdown
        $('a[class*="menu"]').removeAttr("aria-expanded", "false");

        // Ativar o dropdown
        $('a.menu-<?=$actionExibir?>').attr("aria-expanded", "true");
        $('li.menu-drop-<?=$actionExibir?>').addClass("active");

        // Ativar menu atual
        $('li.menu-<?=$actionExibir?>').addClass("active");

        // Ao ativar modal de visualização de cliente
        $('#modalVisualizar').on('show.bs.modal', function (event) {
            // Botão visualizar (clicado)
            var button = $(event.relatedTarget);

            var id = button.data('cliente-id');
            var nome = button.data('cliente-nome');
            var cpf = button.data('cliente-cpf');
            var endereco = button.data('cliente-endereco');
            var bairro = button.data('cliente-bairro');
            var cidade = button.data('cliente-cidade');
            var estado = button.data('cliente-estado');

            // modal
            var modal = $(this);

            // setar dados
            modal.find('#modal-cliente-id').html(id);
            modal.find('#modal-cliente-nome').html(nome);
            modal.find('#modal-cliente-cpf').html(cpf);
            modal.find('#modal-cliente-endereco').html(endereco);
            modal.find('#modal-cliente-bairro').html(bairro);
            modal.find('#modal-cliente-cidade').html(cidade);
            modal.find('#modal-cliente-estado').html(estado);
        });

    });
</script>

</body>
</html>