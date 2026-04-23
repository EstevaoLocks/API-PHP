<?php
    header("Content-Type: application/json");

    $metodo = $_SERVER['REQUEST_METHOD'];

    // echo "Método da Requisição: " . $metodo;

    // CONTEÚDO
    // $usuarios = [
    //     ["id" => 1, "nome" => "Maria Souza", "email" => "maria@email.com"],
    //     ["id" => 2, "nome" => "João Silva", "email" => "joao@email.com"]
    // ];
    
    $arquivo = 'usuarios.json';

    if (!file_exists($arquivo)) {
        file_put_contents($arquivo, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
    $usuarios = json_decode(file_get_contents($arquivo), true);


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

            if (!isset($dados["id"]) || !isset($dados["nome"]) || !isset($dados["email"])){
                http_response_code(400);
                echo json_encode(["erro" => "Dados incompletos"], JSON_UNESCAPED_UNICODE);
                exit;
            }

            // Convertendo dados json para php
            $novoUsuario = [
                "id" => $dados["id"],
                "nome" => $dados["nome"],
                "email" => $dados["email"]
            ];

            // Adiciona usuários ao Array
            $usuarios[] = $novoUsuario;

            // Salva Array no arquivo Json
            file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            // Mensagem de sucesso
            echo json_encode(["mensagem" => "Usuário inserido com sucesso!", "usuarios" =>  $usuarios], JSON_UNESCAPED_UNICODE);


            // Adiciona um novo usuário a um usuário existente
            // array_push($usuarios, $novoUsuario);
            // echo json_encode('Usuário inserido com sucesso!');
            // print_r($usuarios);

            break;

        default:
            // echo "MÉTODO NÃO ENCONTRADO!";
            http_response_code(405); // Método não permitido
            break;
    }


    // echo json_encode($usuarios);

?>