<?php
header('Content-Type: application/json');
// Em produção, substituir '*' pelo domínio real (ex: 'https://seudominio.com')
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Configurações de email - USAR VARIÁVEIS DE AMBIENTE
$to_email = $_ENV['TO_EMAIL'] ?? "seu-email@exemplo.com";
$from_email = $_ENV['FROM_EMAIL'] ?? "noreply@exemplo.com";
$from_name = $_ENV['FROM_NAME'] ?? "PowerLine - Elétrica Inteligente";

// Verificar se é uma requisição POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
    exit;
}

// Obter dados do formulário
$input = json_decode(file_get_contents('php://input'), true);

// Se não for JSON, tentar $_POST
if (!$input) {
    $input = $_POST;
}

// Validar campos obrigatórios
$required_fields = ['nome', 'email', 'telefone'];
$missing_fields = [];

foreach ($required_fields as $field) {
    if (empty($input[$field])) {
        $missing_fields[] = $field;
    }
}

if (!empty($missing_fields)) {
    http_response_code(400);
    echo json_encode([
        'success' => false, 
        'message' => 'Campos obrigatórios não preenchidos: ' . implode(', ', $missing_fields)
    ]);
    exit;
}

// Sanitizar dados
$nome = filter_var(trim($input['nome']), FILTER_SANITIZE_STRING);
$empresa = filter_var(trim($input['empresa'] ?? ''), FILTER_SANITIZE_STRING);
$email = filter_var(trim($input['email']), FILTER_SANITIZE_EMAIL);
$telefone = filter_var(trim($input['telefone']), FILTER_SANITIZE_STRING);
$servico = filter_var(trim($input['servico'] ?? ''), FILTER_SANITIZE_STRING);
$mensagem = filter_var(trim($input['mensagem'] ?? ''), FILTER_SANITIZE_STRING);

// Validar email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email inválido']);
    exit;
}

// Validar telefone (formato brasileiro básico)
$telefone_clean = preg_replace('/[^0-9]/', '', $telefone);
if (strlen($telefone_clean) < 10 || strlen($telefone_clean) > 11) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Telefone inválido']);
    exit;
}

// Proteção contra spam - verificar se não está enviando muito rápido
session_start();
$current_time = time();
$last_submit = $_SESSION['last_submit'] ?? 0;

if (($current_time - $last_submit) < 30) { // 30 segundos entre envios
    http_response_code(429);
    echo json_encode(['success' => false, 'message' => 'Aguarde 30 segundos antes de enviar novamente']);
    exit;
}

// Mapear serviços
$servicos_map = [
    'instalacao' => 'Instalações Elétricas',
    'manutencao' => 'Manutenção Preventiva',
    'automacao' => 'Automação Industrial',
    'projetos' => 'Projetos Elétricos',
    'corretiva' => 'Manutenção Corretiva',
    'laudos' => 'Laudos e Inspeções',
    'chuveiros' => 'Chuveiros Elétricos',
    'tomadas' => 'Tomadas e Interruptores',
    'iluminacao' => 'Iluminação',
    'reparos' => 'Reparos em Geral',
    'emergencia' => 'Emergências 24h'
];

$servico_nome = $servicos_map[$servico] ?? $servico;

// Montar email HTML
$subject = "Nova Solicitação de Orçamento - PowerLine";

$html_body = "
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .header { background-color: #1a2332; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background-color: #f8fafc; }
        .info-box { background-color: white; padding: 15px; margin: 10px 0; border-left: 4px solid #FFA726; }
        .label { font-weight: bold; color: #1a2332; }
        .footer { background-color: #1a2332; color: white; padding: 15px; text-align: center; font-size: 12px; }
    </style>
</head>
<body>
    <div class='header'>
        <h2>⚡ PowerLine - Nova Solicitação de Orçamento</h2>
    </div>
    
    <div class='content'>
        <div class='info-box'>
            <p><span class='label'>Nome:</span> {$nome}</p>
            " . (!empty($empresa) ? "<p><span class='label'>Empresa:</span> {$empresa}</p>" : "") . "
            <p><span class='label'>Email:</span> {$email}</p>
            <p><span class='label'>Telefone:</span> {$telefone}</p>
            " . (!empty($servico_nome) ? "<p><span class='label'>Serviço:</span> {$servico_nome}</p>" : "") . "
        </div>
        
        " . (!empty($mensagem) ? "
        <div class='info-box'>
            <p class='label'>Mensagem:</p>
            <p>" . nl2br(htmlspecialchars($mensagem)) . "</p>
        </div>
        " : "") . "
        
        <div class='info-box'>
            <p><span class='label'>Data/Hora:</span> " . date('d/m/Y H:i:s') . "</p>
            <p><span class='label'>IP:</span> " . $_SERVER['REMOTE_ADDR'] . "</p>
        </div>
    </div>
    
    <div class='footer'>
        <p>PowerLine - Elétrica Inteligente</p>
        <p>Este email foi enviado automaticamente pelo site da PowerLine</p>
    </div>
</body>
</html>
";

// Headers do email
$headers = [
    'MIME-Version: 1.0',
    'Content-type: text/html; charset=UTF-8',
    'From: ' . $from_name . ' <' . $from_email . '>',
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion()
];

// Tentar enviar email
$mail_sent = mail($to_email, $subject, $html_body, implode("\r\n", $headers));

if ($mail_sent) {
    // Registrar último envio para controle de spam
    $_SESSION['last_submit'] = $current_time;
    
    // Log do envio (opcional)
    $log_entry = date('Y-m-d H:i:s') . " - Email enviado para: {$to_email} - Cliente: {$nome} ({$email})\n";
    file_put_contents('contact_logs.txt', $log_entry, FILE_APPEND | LOCK_EX);
    
    echo json_encode([
        'success' => true, 
        'message' => 'Solicitação enviada com sucesso! Entraremos em contato em breve.'
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'message' => 'Erro ao enviar solicitação. Tente novamente ou entre em contato por WhatsApp.'
    ]);
}
?>
