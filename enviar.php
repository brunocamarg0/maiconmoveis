<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $nome = strip_tags(trim($_POST["nome"]));
    $telefone = strip_tags(trim($_POST["telefone"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $cidade = strip_tags(trim($_POST["cidade"]));
    $tipo = strip_tags(trim($_POST["tipo"]));
    $ambientes = strip_tags(trim($_POST["ambientes"]));
    $mensagem = strip_tags(trim($_POST["mensagem"]));
    $captcha = strip_tags(trim($_POST["captcha"]));

    // VALIDAÇÃO SIMPLES (opcionalmente, adicione validação do captcha)
    if (empty($nome) || empty($email) || empty($mensagem)) {
        echo "Por favor, preencha os campos obrigatórios.";
        exit;
    }

    // CONFIGURAÇÕES DE E-MAIL
    $para = "brunocamargocontato@hotmail.com"; // 🔁 ALTERE para o seu e-mail real
    $assunto = "Novo pedido de orçamento - Bartzen";

    $conteudo = "Você recebeu uma nova solicitação de orçamento:\n\n";
    $conteudo .= "Nome: $nome\n";
    $conteudo .= "Telefone: $telefone\n";
    $conteudo .= "Email: $email\n";
    $conteudo .= "Cidade: $cidade\n";
    $conteudo .= "Tipo: $tipo\n";
    $conteudo .= "Ambientes: $ambientes\n";
    $conteudo .= "Mensagem:\n$mensagem\n";

    $headers = "From: $nome <$email>";

    if (mail($para, $assunto, $conteudo, $headers)) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar a mensagem. Tente novamente mais tarde.";
    }
}
?>
