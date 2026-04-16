<?php
    header("Content-Type: application/json");

    $metodo = $_SERVER['REQUEST_METHOD'];

    // echo "Método da Requisição: " . $metodo;

    // CONTEÚDO
    $usuarios = [
        ["id" => 1, "nome" => "Maria Souza", "email" => "maria@email.com"],
        ["id" => 2, "nome" => "João Silva", "email" => "joao@email.com"]
    ];


    switch ($metodo) {
        case 'GET':
            // echo "AQUI AÇÕES DO MÉTODO GET";

            // Converte para Json e retorna
            echo json_encode($usuarios);
            break;
        case 'POST':
            // echo "AQUI AÇÕES DO MÉTODO POST";

            $dados = json_decode(file_get_contents('php://input'), true);
            // print_r($dados);

            // Convertendo dados json para php
            $novoUsuario = [
                "id" => $dados["id"],
                "nome" => $dados["nome"],
                "email" => $dados["email"]
            ];

            // Adiciona um novo usuário a um usuário existente
            array_push($usuarios, $novoUsuario);
            echo json_encode('Usuário inserido com sucesso!');
            print_r($usuarios);

            break;
        default:
            echo "MÉTODO NÃO ENCONTRADO!";
            break;
    }


    // echo json_encode($usuarios);

?>