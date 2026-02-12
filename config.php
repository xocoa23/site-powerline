<?php
/**
 * PowerLine - Configurações do Sistema
 * CONFIGURAÇÃO SEGURA - SEM CREDENCIAIS HARDCODED
 */

// Configurações de Email - USAR VARIÁVEIS DE AMBIENTE
define('SMTP_HOST', $_ENV['SMTP_HOST'] ?? 'smtp.gmail.com');
define('SMTP_PORT', $_ENV['SMTP_PORT'] ?? 587);
define('SMTP_USERNAME', $_ENV['SMTP_USERNAME'] ?? '');
define('SMTP_PASSWORD', $_ENV['SMTP_PASSWORD'] ?? '');
define('SMTP_SECURE', $_ENV['SMTP_SECURE'] ?? 'tls');

// Emails de destino - USAR VARIÁVEIS DE AMBIENTE
define('TO_EMAIL', $_ENV['TO_EMAIL'] ?? '');
define('FROM_EMAIL', $_ENV['FROM_EMAIL'] ?? '');
define('FROM_NAME', $_ENV['FROM_NAME'] ?? 'PowerLine - Elétrica Inteligente');

// Configurações de Segurança - USAR VARIÁVEIS DE AMBIENTE
define('RECAPTCHA_SITE_KEY', $_ENV['RECAPTCHA_SITE_KEY'] ?? '');
define('RECAPTCHA_SECRET_KEY', $_ENV['RECAPTCHA_SECRET_KEY'] ?? '');

// Configurações do Google Analytics - USAR VARIÁVEIS DE AMBIENTE
define('GA_MEASUREMENT_ID', $_ENV['GA_MEASUREMENT_ID'] ?? '');

// Configurações de Rate Limiting
define('RATE_LIMIT_SECONDS', 30);
define('MAX_DAILY_EMAILS', 50);

// Configurações de Log
define('ENABLE_LOGGING', true);
define('LOG_FILE', 'contact_logs.txt');

// Configurações de Desenvolvimento/Produção
define('ENVIRONMENT', $_ENV['ENVIRONMENT'] ?? 'development');
define('DEBUG_MODE', ENVIRONMENT === 'development');

// Configurações de Banco de Dados - USAR VARIÁVEIS DE AMBIENTE
define('DB_HOST', $_ENV['DB_HOST'] ?? '');
define('DB_NAME', $_ENV['DB_NAME'] ?? '');
define('DB_USER', $_ENV['DB_USER'] ?? '');
define('DB_PASS', $_ENV['DB_PASS'] ?? '');

// Configurações de WhatsApp - USAR VARIÁVEIS DE AMBIENTE
define('WHATSAPP_NUMBER', $_ENV['WHATSAPP_NUMBER'] ?? '');

// Configurações de Telefone - USAR VARIÁVEIS DE AMBIENTE
define('PHONE_NUMBER', $_ENV['PHONE_NUMBER'] ?? '');

// Timezone
date_default_timezone_set('America/Sao_Paulo');

// Função para debug (apenas em desenvolvimento)
function debug_log($message) {
    if (DEBUG_MODE) {
        error_log('[PowerLine Debug] ' . $message);
    }
}

// Função para validar configurações
function validate_config() {
    $errors = [];
    
    if (!filter_var(TO_EMAIL, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'TO_EMAIL inválido';
    }
    
    if (!filter_var(FROM_EMAIL, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'FROM_EMAIL inválido';
    }
    
    if (empty(SMTP_HOST)) {
        $errors[] = 'SMTP_HOST não configurado';
    }
    
    return $errors;
}

// Validar configurações na inicialização
if (DEBUG_MODE) {
    $config_errors = validate_config();
    if (!empty($config_errors)) {
        debug_log('Erros de configuração: ' . implode(', ', $config_errors));
    }
}
?>
