<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Concessionária Teste REST</title>

        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

        <!-- Theme style -->
        <link rel="stylesheet" href="css/AdminLTE.css">

        <!-- AdminLTE Skins -->
        <link rel="stylesheet" href="css/skins/skin-green.css">

        <!-- Jquery Impromtu CSS -->
        <link rel="stylesheet" href="js/jQuery-Impromptu-master/src/jquery-impromptu.css"/>

        <!-- DataTables -->
        <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

        <!-- JS -->
        <script type="text/javascript" src="js/jquery-2.2.3.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
        <script type="text/javascript" src="js/jQuery-Impromptu-master/src/jquery-impromptu.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

        <script type="text/javascript">

            var funcao;

            $(document).ready(function () {

                $("#btnSalvar").hide();
                $("#btnCancelar").hide();

                $("#btnExcluirCodigo").click(function (event) {
                    event.preventDefault();
                    excluir($("#excluirCodigo").val());
                });

                $("#btnAlterarCodigo").click(function (event) {
                    event.preventDefault();
                    alterar($("#alterarCodigo").val());
                });

                $("#btnConsultarCodigo").click(function (event) {
                    event.preventDefault();
                    consultar($("#consultarCodigo").val());
                });

                $("#btnListarAnoModelo").click(function (event) {
                    event.preventDefault();
                    listarAnoModelo($("#listarAno").val(), $("#listarModelo").val())($("#consultarCodigo").val());
                });


                getTodos();

            });

        </script>
    </head>

    <!-- Fim da Head -->

    <body class="skin-green">
        <!-- Inicio da Navbar -->
        <header class="main-header">
            <a href="#" class="logo">
                <span class="logo-lg"><b>Concessionária</b></span>
            </a>

            <nav class="navbar navbar-static-top">

            </nav>
        </header>
        <!-- Fim da Navbar -->




        <!-- Main content -->
        <section class="content">

            <section class="col-lg-7 connectedSortable">
                <!-- Box Inserir Carro -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Inserir Carro</h3>
                    </div>

                    <div class="box-body">

                        <form action="#" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label for="codigo" class="col-sm-1 control-label">Código</label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" id="codigo">
                                </div>

                                <label for="marca" class="col-sm-1 control-label">Marca</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="marca">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="modelo" class="col-sm-1 control-label">Modelo</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="modelo">
                                </div>
                                <label for="ano" class="col-sm-1 control-label">Ano</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="ano" placeholder="yyyy">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="potencia" class="col-sm-1 control-label">Potência</label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" id="potencia">
                                </div>
                                <label for="carga" class="col-sm-1 control-label">Carga</label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" id="carga">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="complemento" class="col-sm-2 control-label">Complemento</label>
                                <div class="col-sm-10">
                                    <textarea id="complemento" class="form-control"  rows="1" placeholder=""></textarea>
                                </div>
                            </div>
                        </form>

                        <button id="btnInserir" onclick="inserir()" class="btn btn-primary btn-sm">Inserir</button>
                        <button id="btnSalvar" onclick="salvarAlteracao()" class="btn btn-success btn-sm">Salvar</button>
                        <button id="btnCancelar" onclick="cancelarAlteracao()" class="btn btn-danger btn-sm">Cancelar</button>


                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->
            </section>

            <section class="col-lg-5 connectedSortable">
                <!-- Box Outras Opções -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Outras Opções</h3>
                    </div>

                    <div class="box-body">

                        <form action="#" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label for="excluirCodigo" class="col-sm-4 control-label">Excluir por código</label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" id="excluirCodigo">
                                </div>
                                <button id="btnExcluirCodigo" class="btn btn-primary btn-sm">Excluir</button>
                            </div>
                            <div class="form-group">
                                <label for="alterarCodigo" class="col-sm-4 control-label">Alterar por código</label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" id="alterarCodigo">
                                </div>
                                <button id="btnAlterarCodigo" class="btn btn-primary btn-sm">Alterar</button>
                            </div>
                            <div class="form-group">
                                <label for="consultarCodigo" class="col-sm-4 control-label">Consultar por código</label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" id="consultarCodigo">
                                </div>
                                <button id="btnConsultarCodigo" class="btn btn-primary btn-sm">Consultar</button>
                            </div>
                            <div class="form-group">
                                <label for="listarAno" class="col-sm-4 control-label">Listar por Ano e Modelo</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="listarAno" placeholder="Ano">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="listarModelo" placeholder="Modelo">
                                </div>
                                <button id="btnListarAnoModelo" class="btn btn-primary btn-sm" value="Listar">Listar</button>
                            </div>
                        </form>

                        <p align="center">
                            <button id="btnLimpar" onclick="limparFiltros()" class="btn btn-danger btn-sm">Limpar Filtros</button>

                        </p>

                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->
            </section>

        </section>

        <div class="col-xs-12">
            <div class="box">


                <div class="box-body table-responsive no-padding">
                    <table id="carsTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Ano</th>
                                <th>Potência</th>
                                <th>Carga</th>
                                <th>Complemento</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
