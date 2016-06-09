<?php

$funcao = $_POST['funcao'];

switch ($funcao) {

    case "inserir":
        inserir();
        break;
    case "alterar":
        alterar();
        break;
    case "excluir":
        excluir();
        break;
    case "consultar":
        consultar();
        break;
    case "getTodos":
        getTodos();
        break;
    case "salvarAlteracoes":
        salvarAlteracoes();
        break;
    case "listarAnoModelo":
        listarAnoModelo();
        break;
}

function inserir() {
    if (isset($_POST["codigo"])) {
        $codigoCarro = $_POST['codigo'];
    }

    if (isset($_POST["marca"])) {
        $marcaCarro = $_POST['marca'];
    }

    if (isset($_POST["modelo"])) {
        $modeloCarro = $_POST['modelo'];
    }

    if (isset($_POST["ano"])) {
        $anoCarro = $_POST['ano'];
    }

    if (isset($_POST["potencia"])) {
        $potenciaCarro = $_POST['potencia'];
    }

    if (isset($_POST["carga"])) {
        $cargaCarro = $_POST['carga'];
    }

    if (isset($_POST["complemento"])) {
        $complementoCarro = $_POST['complemento'];
    }

    $carro = array(
        "codigo" => $codigoCarro,
        "marca" => $marcaCarro,
        "modelo" => $modeloCarro,
        "ano" => $anoCarro,
        "potencia" => $potenciaCarro,
        "carga" => $cargaCarro,
        "complemento" => $complementoCarro
    );

    $json = json_encode($carro);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Trabalho-SD-2/rest/carro/inserirCarro");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $result = curl_exec($ch);

    echo $result;
}

function alterar() {

    echo "ALTERAR";
}

function excluir() {

    if (isset($_POST["codigo"])) {
        $codigo = $_POST['codigo'];
    }

    $url = "http://localhost:8080/Trabalho-SD-2/rest/carro/excluirCarro";
    $curl = curl_init($url . "/{$codigo}");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));

    $result = curl_exec($curl);

    echo $result;
}

function consultar() {

    if (isset($_POST["valor"])) {
        $valor = $_POST['valor'];
    }

    $carros = file_get_contents("http://localhost:8080/Trabalho-SD-2/rest/carro/consultaCodigo/" . $valor);

    echo $carros;
}

function getTodos() {

    //Busca todos os carros do banco de dados

    $carros = file_get_contents("http://localhost:8080/Trabalho-SD-2/rest/carro/getTodos");

    echo $carros;
}

function listarAnoModelo() {
    
    if (isset($_POST["ano"])) {
        $ano = $_POST['ano'];
    }
    
    if (isset($_POST["modelo"])) {
        $modelo = $_POST['modelo'];
    }
    
    $parametros = array(
        "ano" => $ano,
        "modelo" => $modelo,
    );

    $json = json_encode($parametros);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Trabalho-SD-2/rest/carro/listarAnoModelo");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $result = curl_exec($ch);

    echo $result;
}

function salvarAlteracoes() {

    if (isset($_POST["codigo"])) {
        $codigo = $_POST['codigo'];
    }

    if (isset($_POST["marca"])) {
        $marcaCarro = $_POST['marca'];
    }

    if (isset($_POST["modelo"])) {
        $modeloCarro = $_POST['modelo'];
    }

    if (isset($_POST["ano"])) {
        $anoCarro = $_POST['ano'];
    }

    if (isset($_POST["potencia"])) {
        $potenciaCarro = $_POST['potencia'];
    }

    if (isset($_POST["carga"])) {
        $cargaCarro = $_POST['carga'];
    }

    if (isset($_POST["complemento"])) {
        $complementoCarro = $_POST['complemento'];
    }

    $curl = curl_init("http://localhost:8080/Trabalho-SD-2/rest/carro/alterarCarro/" . $codigo);
    $data = array(
        'marca' => $marcaCarro,
        'modelo' => $modeloCarro,
        'ano' => $anoCarro,
        'carga' => $cargaCarro,
        'potencia' => $potenciaCarro,
        'complemento' => $complementoCarro
    );
    
    $json = json_encode($data);
    
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_POSTFIELDS, $json);

    $response = curl_exec($curl);
    
    echo $response;
}
?>

