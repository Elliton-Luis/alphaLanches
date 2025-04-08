<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>
<body>
    <h1>Olá, {{ $dados['name'] }}</h1>
    <p>Para acessar sua conta no AlphaLanches, use o email cadastrado e a seguinte senha: {{ $dados['password'] }}</p>
</body>
</html>
