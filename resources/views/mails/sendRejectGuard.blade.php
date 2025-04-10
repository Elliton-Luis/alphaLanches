<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>
<body>
    <h1>Olá, {{ $dados['name'] }}</h1>
    <br>
    <strong>Motivo da Rejeição:</strong>
    <p> {{ $dados['message'] }}</p>
</body>
</html>
