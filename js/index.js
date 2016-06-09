function inserir() {

    $("#codigo").removeClass("errado");
    $("#marca").removeClass("errado");
    $("#modelo").removeClass("errado");
    $("#ano").removeClass("errado");
    $("#potencia").removeClass("errado");
    $("#carga").removeClass("errado");
    $("#complemento").removeClass("errado");

    var count = 0;

    if ($("#codigo").val() == null || $("#codigo").val() == "") {
        $("#codigo").addClass("errado");
        count = count + 1;
    }

    if ($("#marca").val() == null || $("#marca").val() == "") {
        $("#marca").addClass("errado");
        count = count + 1;
    }

    if ($("#modelo").val() == null || $("#modelo").val() == "") {
        $("#modelo").addClass("errado");
        count = count + 1;
    }

    if ($("#ano").val() == null || $("#ano").val() == "") {
        $("#ano").addClass("errado");
        count = count + 1;
    }

    if ($("#potencia").val() == null || $("#potencia").val() == "") {
        $("#potencia").addClass("errado");
        count = count + 1;
    }

    if ($("#carga").val() == null || $("#carga").val() == "") {
        $("#carga").addClass("errado");
        count = count + 1;
    }

    if (count == 0) {
        funcao = "inserir";

        var codigo = $("#codigo").val();
        var marca = $("#marca").val();
        var modelo = $("#modelo").val();
        var ano = $("#ano").val();
        var potencia = $("#potencia").val();
        var carga = $("#carga").val();
        var complemento = $("#complemento").val();

        $.ajax({
            type: "POST",
            url: 'funcoes.php',
            data: {funcao: funcao, codigo: codigo, marca: marca, modelo: modelo, ano: ano,
                potencia: potencia, carga: carga, complemento: complemento},
            success: function (html) {
                var result = $.trim(html);
                console.log(result);
                if (result == "OK") {
                    alert("Carro Inserido com sucesso");

                    $("#carsTable").dataTable().fnClearTable();
                    $("#carsTable").dataTable().fnDestroy();

                    getTodos();
                    limparCampos();
                } else if (result == "existe") {
                    alert("Código já inserido no banco de dados. Tente outro código");
                } else {
                    alert("Erro na inserção");
                }
            }
        });

    } else {
        alert("Campos obrigatórios não preenchidos");
    }
}
;


function limparCampos() {

    $("#codigo").val("");
    $("#marca").val("");
    $("#modelo").val("");
    $("#ano").val("");
    $("#potencia").val("");
    $("#carga").val("");
    $("#complemento").val("");


}

function getTodos() {

    $.ajax({
        type: "POST",
        url: 'funcoes.php',
        data: {funcao: "getTodos"},
        success: function (html) {
            var test = jQuery.parseJSON(html);

            drawTable(test);

            $('#carsTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "pageLength": 3
            });






        }
    });

}


function alterar(codCarro) {

    funcao = "alterar";

    limparCampos();

    $.ajax({
        type: "POST",
        url: 'funcoes.php',
        data: {funcao: "consultar", valor: codCarro},
        success: function (html) {
            var test = jQuery.parseJSON(html);

            if (test == "existe") {
                alert("Não foi encontrado resultado com o parâmetro passado. Tente novamente.");

                $("#carsTable").dataTable().fnClearTable();
                $("#carsTable").dataTable().fnDestroy();

                getTodos();
            } else {
                $("#codigo").attr("readonly", "readonly");
                $("#codigo").css("background-color", "rgb(214, 214, 214)");

                $("#codigo").val(codCarro);

                $("#btnInserir").hide();

                $("#btnSalvar").show();
                $("#btnCancelar").show();

                $("#btnSalvar").attr("onclick", "salvarAlteracao()");
                $("#btnCancelar").attr("onclick", "cancelarAlteracao()");

                $("#select1").text("Alterar Carro");


                $("#marca").val(test.marca);
                $("#modelo").val(test.modelo);
                $("#ano").val(test.ano);
                $("#potencia").val(test.potencia);
                $("#carga").val(test.carga);
                $("#complemento").val(test.complemento);
            }
        }
    });
}
;


function salvarAlteracao() {

    $("#codigo").removeClass("errado");
    $("#marca").removeClass("errado");
    $("#modelo").removeClass("errado");
    $("#ano").removeClass("errado");
    $("#potencia").removeClass("errado");
    $("#carga").removeClass("errado");
    $("#complemento").removeClass("errado");

    var count = 0;

    if ($("#codigo").val() == null || $("#codigo").val() == "") {
        $("#codigo").addClass("errado");
        count = count + 1;
    }

    if ($("#marca").val() == null || $("#marca").val() == "") {
        $("#marca").addClass("errado");
        count = count + 1;
    }

    if ($("#modelo").val() == null || $("#modelo").val() == "") {
        $("#modelo").addClass("errado");
        count = count + 1;
    }

    if ($("#ano").val() == null || $("#ano").val() == "") {
        $("#ano").addClass("errado");
        count = count + 1;
    }

    if ($("#potencia").val() == null || $("#potencia").val() == "") {
        $("#potencia").addClass("errado");
        count = count + 1;
    }

    if ($("#carga").val() == null || $("#carga").val() == "") {
        $("#carga").addClass("errado");
        count = count + 1;
    }

    if (count == 0) {
        funcao = "salvarAlteracoes";

        var codigo = $("#codigo").val();
        var marca = $("#marca").val();
        var modelo = $("#modelo").val();
        var ano = $("#ano").val();
        var potencia = $("#potencia").val();
        var carga = $("#carga").val();
        var complemento = $("#complemento").val();

        $.ajax({
            type: "POST",
            url: 'funcoes.php',
            data: {funcao: funcao, codigo: codigo, marca: marca, modelo: modelo, ano: ano,
                potencia: potencia, carga: carga, complemento: complemento},
            success: function (html) {
                var result = $.trim(html);
                console.log(result);

                if (result == "OK") {
                    alert("Carro Alterado com sucesso");


                    window.location.reload(true);

                } else {
                    alert("Erro na alteração");
                }
            }
        });

    } else {
        alert("Campos obrigatórios não preenchidos");
    }

}

function cancelarAlteracao() {
    window.location.reload();

}

function excluir(codCarro) {

    funcao = "excluir";

    if (codCarro == null || codCarro == "") {
        alert("Código vazio. Por favor preencha e tente novamente");
    } else {

        $.prompt("Tem certeza que deseja excluir o carro de código " + codCarro + "?", {
            title: "Aviso",
            buttons: {"Sim": true, "Não": false},
            submit: function (e, v, m, f) {

                if (v == true) {
                    //Então deseja excluir, segue o fluxo de exclusão 
                    $.ajax({
                        type: "POST",
                        url: 'funcoes.php',
                        data: {funcao: funcao, codigo: codCarro},
                        success: function (html) {
                            var result = $.trim(html);
                            console.log(html);

                            if (result == "OK") {
                                alert("Carro Excluído com sucesso");

                                $("#carsTable").dataTable().fnClearTable();
                                $("#carsTable").dataTable().fnDestroy();

                                getTodos();
                                limparCampos();
                                $("#btnInserir").show();
                                $("#btnSalvar").hide();
                                $("#btnCancelar").hide();

                            } else if (result == "existe") {
                                alert("Código não encontrado para exclusão, tente novamente");
                            } else {
                                alert("Erro na exclusão");
                            }
                        }
                    });


                } else {

                    console.log(false);

                }



            }
        });


    }
}
;

function consultar(valor) {

    if (valor == null || valor == "") {
        alert("Código vazio. Por favor preencha e tente novamente");
    } else {

        funcao = "consultar";
        $.ajax({
            type: "POST",
            url: 'funcoes.php',
            data: {funcao: funcao, valor: valor},
            success: function (html) {
                var test = jQuery.parseJSON(html);

                if (test == "existe") {

                    alert("Não foi encontrado resultado com o parâmetro passado. Tente novamente.");

                    $("#carsTable").dataTable().fnClearTable();
                    $("#carsTable").dataTable().fnDestroy();

                    getTodos();

                } else {
                    $("#carsTable").dataTable().fnClearTable();
                    $("#carsTable").dataTable().fnDestroy();

                    drawRow(test);
                }
            }
        });
    }
}
;



function drawTable(data) {

    //$("#carsTable tr").remove();


    if (data.length > 1) {
        for (var i = 0; i < data.length; i++) {
            drawRow(data[i]);
        }

    } else if (data.length == 1) {

        drawRow(data[0]);
    }
}

function drawRow(rowData) {
    var row = $("<tr />")
    $("#carsTable").append(row);
    if (rowData.complemento == undefined) {
        rowData.complemento = "";
    }
    row.append($("<td id='" + rowData.codigo + "'>" + rowData.codigo + "</td>"));
    row.append($("<td>" + rowData.marca + "</td>"));
    row.append($("<td>" + rowData.modelo + "</td>"));
    row.append($("<td>" + rowData.ano + "</td>"));
    row.append($("<td>" + rowData.potencia + "</td>"));
    row.append($("<td>" + rowData.carga + "</td>"));
    row.append($("<td>" + rowData.complemento + "</td>"));
    row.append($("<td> \n\
                <input id=btnAlterar type=\"image\" src=\"images/update.png\" codigo=" + rowData.codigo + " onclick=\"alterar($(this).attr('codigo'))\"/> \n\
                <input id=btnExcluir type=\"image\" src=\"images/lixeira.png\" codigo=" + rowData.codigo + " onclick=\"excluir($(this).attr('codigo'))\"/> "));

}

function limparFiltros() {
    window.location.reload();
}

function listarAnoModelo(ano, modelo) {

    var count = 0;

    if ($("#listarAno").val() == null || $("#listarAno").val() == "") {
        count = 1;
    } else if ($("#listarModelo").val() == null || $("#listarModelo").val() == "") {
        count = 1;
    }

    if (count == 0) {


        funcao = "listarAnoModelo";

        $.ajax({
            type: "POST",
            url: 'funcoes.php',
            data: {funcao: funcao, ano: ano, modelo: modelo},
            success: function (html) {
                var result = $.trim(html);
                console.log(html);

                var test = jQuery.parseJSON(html);

                if (test == "existe") {

                    alert("Não foi encontrado resultado com os parâmetros passados. Tente novamente.");

                    $("#carsTable").dataTable().fnClearTable();
                    $("#carsTable").dataTable().fnDestroy();

                    getTodos();

                } else {

                    $("#carsTable").dataTable().fnClearTable();
                    $("#carsTable").dataTable().fnDestroy();
                    
                    drawTable(test);


                }
            }
        });

    } else {
        alert("Para pesquisar por Ano/Modelo é necessário preencher os dois campos.")
    }

}