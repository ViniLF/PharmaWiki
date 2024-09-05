<?php

    if(isset($_POST['submit']))
    {
        // print_r('Nome: ' . $_POST['nome']);
        // print_r('<br>');
        // print_r('E-mail: ' . $_POST['email']);
        // print_r('<br>');
        // print_r('Telefone: ' . $_POST['telefone']);
        // print_r('<br>');
        // print_r('Data de nascimento: ' . $_POST['data_nascimento']);

        include_once('config.php');
        
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $data_nasc = $_POST['data_nascimento'];

        $result = mysqli_query($conexao, "INSERT INTO usuarios(nome, email, telefone, data_nasc) VALUES ('$nome', '$email', '$telefone', '$data_nasc')");
    }

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <title>Formulário | VF</title>

    <style>
        :root {
            --ciano-escuro: #006064;
            --ciano-claro: #00e5ff;
            --foco-input: dodgerblue;
        }

        * {
            font-family: "Open Sans", sans-serif;
        }

        body {
            background-image: linear-gradient(to right, var(--ciano-escuro), var(--ciano-claro));
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .box {
            color: white;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 25px;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        fieldset {
            border: 3px solid var(--foco-input);
        }

        legend {
            border: 1px solid var(--foco-input);
            padding: 5px;
            text-align: center;
            background-color: var(--foco-input);
            border-radius: 6px;
        }

        .inputBox {
            position: relative;
            margin-bottom: 20px;
        }

        .inputUser {
            background-color: transparent;
            border: none;
            border-bottom: 2px solid white;
            outline: none;
            color: #fff;
            font-size: 15px;
            width: 100%;
            padding: 8px 0;
            transition: border-bottom-color 0.3s;
        }

        .inputUser:focus {
            border-bottom-color: var(--foco-input);
        }

        .labelInput {
            position: absolute;
            top: 10px;
            left: 0;
            pointer-events: none;
            transition: 0.5s;
            color: #ffffff;
        }

        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput {
            top: -20px;
            font-size: 12px;
            color: var(--foco-input);
        }

        #data_nascimento {
            border: none;
            padding: 8px;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
        }

        #submit {
            background-image: linear-gradient(to right, #0190a0, var(--ciano-escuro));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }

        #submit:disabled {
            background: gray;
            cursor: not-allowed;
        }

        #submit:hover:not(:disabled) {
            background-image: linear-gradient(to right, #017f8d, #005255);
        }

    </style>
</head>
<body>
    <div class="box">
        <form action="formulario.php" method="POST" autocomplete="off">
            <fieldset>
                <legend><b>Formulário de Registro</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required aria-label="Nome completo">
                    <label for="nome" class="labelInput">Nome completo</label>
                </div>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required aria-label="E-mail">
                    <label for="email" class="labelInput">E-mail</label>
                </div>
                <div class="inputBox">
                    <input type="text" name="telefone" id="telefone" class="inputUser" required aria-label="Telefone">
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>
                <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                <input type="date" name="data_nascimento" id="data_nascimento" required>
                <br><br>
                <input type="submit" name="submit" id="submit" value="Enviar">
            </fieldset>
        </form>
    </div>
</body>
</html>
