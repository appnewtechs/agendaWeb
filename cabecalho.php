<?php
verificaUsuario();
?>
<html>

<head>
    <!-- <meta charset="UTF-8"> -->
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title>Newtech</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $base_url; ?>/img/favicon.png">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/estilo.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/index.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/multiselect.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/popup.css">
    <link rel='stylesheet' href='<?php echo $base_url; ?>/js/fullcalendar/fullcalendar.print.min.css' media='print' />
    <link rel='stylesheet' href='<?php echo $base_url; ?>/js/fullcalendar/fullcalendar.css' />
    <link rel='stylesheet' href='<?php echo $base_url; ?>/table/css/defaultTheme.css' />
    <link rel='stylesheet' href='<?php echo $base_url; ?>/multipledates/jquery-ui.multidatespicker.css' />
    <script src='<?php echo $base_url; ?>/js/fullcalendar/lib/moment.min.js'></script>
    <script src="<?php echo $base_url; ?>/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo $base_url; ?>/js/jquery-ui.min.js"></script>
    <script src="<?php echo $base_url; ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo $base_url; ?>/js/jquery.tablesorter.min.js"></script>
    <script src="<?php echo $base_url; ?>/js/scripts.js"></script>
    <script src="<?php echo $base_url; ?>/js/jquery.multi-select.js"></script>
    <script src="<?php echo $base_url; ?>/js/jquery.mask.min.js"></script>
    <script src="<?php echo $base_url; ?>/js/bootbox.min.js"></script>
    <script src="<?php echo $base_url; ?>/js/alert.js"></script>
    <script src='<?php echo $base_url; ?>/js/fullcalendar/fullcalendar.js'></script>
    <script src='<?php echo $base_url; ?>/js/fullcalendar/locale/pt-br.js'></script>
    <script src='<?php echo $base_url; ?>/js/popup.js'></script>
    <script src="<?php echo $base_url; ?>/js/date.js"></script>
    <script src="<?php echo $base_url; ?>/js/jquery.validate.js"></script>
    <script src="<?php echo $base_url; ?>/multipledates/jquery-ui.multidatespicker.js"></script>
    <script src="<?php echo $base_url; ?>/datepick/js/jquery.plugin.js"></script>
    <script src="<?php echo $base_url; ?>/datepick/js/jquery.datepick.js"></script>
    <script src="<?php echo $base_url; ?>/datepick/js/jquery.datepick-pt-BR.js"></script>
    <script src="<?php echo $base_url; ?>/table/jquery.fixedheadertable.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/datepick/css/smoothness.datepick.css">
    <script src="<?php echo $base_url; ?>/js/autosize.min.js"></script>
</head>
<script>
    $(document).ready(function() {
        var url = window.location;
        var urlSTR = window.location.pathname;
        // console.log(urlSTR);
        if (urlSTR.search('admin') != -1) {
            $('.nav-item.dropdown.admin').addClass('active');
        }
        if (urlSTR.search('cadastros') != -1) {
            $('.nav-item.dropdown.cadastros').addClass('active');
        }
        if (urlSTR.search('perfil') != -1) {
            $('.nav-item.dropdown.perfil').addClass('active');
        }
        if (urlSTR.search('financeiro') != -1) {
            $('.nav-item.dropdown.financeiro').addClass('active');
        }

        $('ul.nav a[href="' + url + '"]').parent().addClass('active');
        $('ul.nav a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');

    });
    <?php
    function chamacampo_fundo($id, $conexao)
    {
        $consulta_cliente = mysqli_query($conexao, "SELECT telafundo FROM telas WHERE id='$id'") or die(mysqli_error());
        $n_cliente = mysqli_fetch_array($consulta_cliente);

        return utf8_encode($n_cliente['telafundo']);
    }

    $array_fundo = explode('/', $_SERVER['REQUEST_URI']);

    $fundo = $array_fundo[2];

    switch ($fundo) {
        case 'home.php':
            $fundo = '' . chamacampo_fundo(1, $conexao);
            break;
        case 'admin':
            $fundo = '../' . chamacampo_fundo(2, $conexao);
            break;
        case 'cadastros':
            $fundo = '../' . chamacampo_fundo(3, $conexao);
            break;
        case 'eventos':
            $fundo = '../' . chamacampo_fundo(4, $conexao);
            break;
    }
    $usuarioLogado = buscaUsuario($conexao, $_SESSION["login"]);
    $isCliente = verificaUsuarioCliente($conexao, $usuarioLogado["id_usuario"]);
    ?>

    //alert('<?php echo $fundo; ?>');
</script>


<!-- <body style="overflow: auto!important;min-width: 1240px!important; background-image: url('<?php echo $fundo; ?>'); background-size: cover;"> -->

<body style="overflow: auto!important; background-image: url('<?php echo $fundo; ?>'); background-size: cover;">
    <div class="luz"></div>
    <div class="popup">
        <div class="titulopopup">
            <!-- <div class="col-md-10">
            <span class="">titulo</span>
        </div>
        <div class="col-md-2">
            <a href="javascript:void(0);" onClick="fecharpopup(); return false;">FECHAR</a>
        </div> -->
            <div class="modal-header">
                <a onClick="fecharpopup(); return false;" type="button" class="close" aria-label="Close"><span aria-hidden="true">×</span></a>
                <h4 class="modal-title tpopup" id="exampleModalLabel"></h4>
            </div>
        </div>
        <div class="conteudopopup">Conteudo popup</div>
    </div>
    <!-- <div class="navbar navbar-default navbar-fixed-top sombra--menor" style="min-width: 1240px!important;"> -->
    <div class="navbar navbar-default navbar-fixed-top sombra--menor">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand logotipo" rel="Monster">
                    <img src="<?php echo $base_url; ?>/img/logo-new.png">
                </a>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    <?php if (empty($isCliente)) { ?>
                    <li><a href="<?php echo $base_url; ?>/home.php">Home</a></li>
                    <?php

                }
                foreach (array_unique($_SESSION["rotina"]) as $key => $value) {
                    switch ($value) {
                        case '1':
                            ?>
                    <li class="nav-item dropdown admin">
                        <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink">Admin</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="<?php echo $base_url; ?>/admin/usuarios.php">Usuário</a>
                            <a class="dropdown-item" href="<?php echo $base_url; ?>/admin/perfil.php">Perfil</a>
                            <a class="dropdown-item" href="<?php echo $base_url; ?>/admin/aniversario.php">Aniversariantes</a>
                            <a class="dropdown-item" href="<?php echo $base_url; ?>/admin/telalogin.php">Tela de Login</a>
                            <a class="dropdown-item" href="<?php echo $base_url; ?>/admin/telahome.php?id=1">Tela Home</a>
                            <a class="dropdown-item" href="<?php echo $base_url; ?>/admin/telahome.php?id=2">Tela Admin</a>
                            <a class="dropdown-item" href="<?php echo $base_url; ?>/admin/telahome.php?id=3">Tela Cadastros</a>
                            <a class="dropdown-item" href="<?php echo $base_url; ?>/admin/telahome.php?id=6">Tela Agendas</a>
                        </div>
                    </li>
                    <?php
                    break;
                case '2':
                    ?>
                    <li class="nav-item dropdown cadastros">
                        <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink">Cadastros</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="<?php echo $base_url; ?>/cadastros/cliente.php">Clientes</a>
                            <a class="dropdown-item" href="<?php echo $base_url; ?>/cadastros/tipo-cliente.php">Tipo de Cliente</a>
                            <a class="dropdown-item" href="<?php echo $base_url; ?>/cadastros/empresa.php">Empresas</a>
                            <a class="dropdown-item" href="<?php echo $base_url; ?>/cadastros/tipo-empresa.php">Tipo de Empresa</a>
                            <a class="dropdown-item" href="<?php echo $base_url; ?>/cadastros/trabalho.php">Tipo de Trabalho</a>
                            <a class="dropdown-item" href="<?php echo $base_url; ?>/cadastros/linha-produto.php">Linha de Produto</a>
                            <!-- <a class="dropdown-item" href="<?php echo $base_url; ?>/cadastros/contato.php">Contatos</a> -->
                        </div>
                    </li>
                    <?php
                    break;
                case '3':
                    ?> <li><a href="<?php echo $base_url; ?>/eventos/agenda.php">Agendas</a></li>
                    <?php
                    break;
            }
        }
        ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item dropdown perfil">
                        <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink">
                            <?php
                            echo $_SESSION["login"] . " ";

                            if (strlen($_SESSION["imagem"]) > 0) {
                                echo '<img height="20px" class="user-logo" aria-hidden="true" src="' . $base_url . $_SESSION["imagem"] . '" />';
                            } else {
                                echo '<i class="fa fa-user-circle-o" aria-hidden="true"></i>';
                            }
                            ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="<?php echo $base_url; ?>/perfil/editarperfil.php">Perfil</a>
                            <a class="dropdown-item" data-toggle="modal" data-target=".bs-sobre-modal-sm">Sobre</a>
                            <a class="dropdown-item" href="<?php echo $base_url; ?>/logout.php">Sair</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div><!-- container acaba aqui -->
    </div>

    <!-- MODAL SOBRE -->
    <div class="modal fade bs-sobre-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Sobre</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="alert alert-info label-info text-capitalize text-center col-xs-12 col-sm-12 col-md-12 col-lg-12">Newtech - Versão 1.0</div>
                                </div>
                                <div class="row">
                                    <div class="alert alert-success label-info text-capitalize text-center col-xs-12 col-sm-12 col-md-12 col-lg-12">Desenvolvimento: <a href="http://newtechs.com.br/" target="blank">NewTech</a></div>
                                </div>
                                <div class="row">
                                    <div class="alert alert-info text-capitalize text-center col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <h6>Contato: (11) 4081-1925 | contato@newtechs.com.br</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FIM MODAL -->
    <div class="container">
        <div class="principal"> 