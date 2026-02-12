# 🚀 PowerLine - Guia de Deploy e Hospedagem

Este guia contém todas as instruções necessárias para hospedar o site da PowerLine em produção.

## 📋 Pré-requisitos

### Servidor Web
- **Apache 2.4+** ou **Nginx 1.18+**
- **PHP 7.4+** (recomendado PHP 8.0+)
- **SSL Certificate** (Let's Encrypt recomendado)
- **Domínio configurado** (ex: powerline.com.br)

### Extensões PHP Necessárias
```bash
- php-curl
- php-json
- php-mbstring
- php-openssl
- php-session
```

## 🔧 Configuração do Servidor

### 1. Upload dos Arquivos
Faça upload de todos os arquivos para o diretório raiz do seu domínio:
```
/public_html/ (ou /www/ ou /htdocs/)
├── index.html
├── contact.php
├── config.php
├── .htaccess
├── 404.html
├── css/
├── js/
├── images/
└── README.md
```

### 2. Configurar Permissões
```bash
# Arquivos
find . -type f -exec chmod 644 {} \;

# Diretórios
find . -type d -exec chmod 755 {} \;

# PHP executável
chmod 644 contact.php

# Log file (se necessário)
touch contact_logs.txt
chmod 666 contact_logs.txt
```

### 3. Configurar Email (config.php)
Edite o arquivo `config.php` e configure:

```php
// Configurações de Email SMTP
define('SMTP_HOST', 'mail.seudominio.com.br'); // SMTP do seu provedor
define('SMTP_PORT', 587); // Porta SMTP
define('SMTP_USERNAME', 'seu-email@exemplo.com'); // Email real
define('SMTP_PASSWORD', 'SUA_SENHA_AQUI'); // Senha do email
define('TO_EMAIL', 'seu-email@exemplo.com'); // Email de destino

// Google Analytics
define('GA_MEASUREMENT_ID', 'G-XXXXXXXXXX'); // Seu ID do GA

// WhatsApp e Telefone
define('WHATSAPP_NUMBER', '5500000000000'); // Número real
define('PHONE_NUMBER', '+5500000000000'); // Telefone real
```

### 4. Configurar Google Analytics
1. Acesse [Google Analytics](https://analytics.google.com)
2. Crie uma nova propriedade para o site da PowerLine
3. Copie o ID de medição (formato: G-XXXXXXXXXX)
4. Substitua `GA_MEASUREMENT_ID` no `config.php` e `index.html`

### 5. Configurar SSL (HTTPS)
```bash
# No .htaccess, descomente as linhas:
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

## 🔒 Configurações de Segurança

### Headers de Segurança
O arquivo `.htaccess` já inclui headers de segurança básicos:
- X-Content-Type-Options
- X-Frame-Options
- X-XSS-Protection
- Referrer-Policy

### Proteção de Arquivos
- `config.php` - Bloqueado via .htaccess
- `contact_logs.txt` - Bloqueado via .htaccess
- `.htaccess` - Auto-protegido

### Rate Limiting
- 30 segundos entre envios de formulário
- Máximo 50 emails por IP por dia
- Proteção contra spam automático

## 📧 Configuração de Email

### Opção 1: SMTP do Provedor de Hospedagem
```php
define('SMTP_HOST', 'mail.seudominio.com.br');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'seu-email@exemplo.com');
define('SMTP_PASSWORD', 'senha_do_email');
```

### Opção 2: Gmail SMTP
```php
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'seu-email@exemplo.com');
define('SMTP_PASSWORD', 'app_password_do_gmail'); // Não a senha normal!
```

**Importante**: Para Gmail, use App Password, não a senha normal da conta.

## 📱 Configuração do WhatsApp

### Atualizar Números
Substitua `5511999999999` pelo número real da PowerLine em:
- `config.php`
- `index.html` (links WhatsApp)
- `404.html`

### Formato do Número
- **Correto**: `5511999999999` (país + DDD + número)
- **Incorreto**: `11999999999` (sem código do país)

## 🌐 DNS e Domínio

### Configurações DNS Recomendadas
```
A     @           123.456.789.123  (IP do servidor)
A     www         123.456.789.123  (IP do servidor)
CNAME mail        mail.provedor.com.br
MX    @           10 mail.provedor.com.br
```

### Redirecionamento www
O `.htaccess` está configurado para funcionar com ou sem www.

## 📊 Monitoramento e Analytics

### Google Analytics Events
O site já está configurado para rastrear:
- Cliques no WhatsApp
- Cliques no telefone
- Interesse em serviços
- Envios de formulário
- Interações de emergência

### Logs de Contato
Os envios de formulário são registrados em `contact_logs.txt` para auditoria.

## 🚀 Checklist de Deploy

### Antes do Deploy
- [ ] Configurar `config.php` com dados reais
- [ ] Atualizar números de WhatsApp e telefone
- [ ] Configurar Google Analytics ID
- [ ] Testar formulário de contato localmente

### Durante o Deploy
- [ ] Upload de todos os arquivos
- [ ] Configurar permissões corretas
- [ ] Ativar SSL/HTTPS
- [ ] Configurar redirecionamento www

### Após o Deploy
- [ ] Testar site completo
- [ ] Testar formulário de contato
- [ ] Verificar emails chegando
- [ ] Testar links WhatsApp
- [ ] Verificar Google Analytics
- [ ] Testar responsividade mobile
- [ ] Verificar velocidade do site

## 🔧 Troubleshooting

### Formulário não envia emails
1. Verificar configurações SMTP no `config.php`
2. Verificar se PHP mail() está funcionando
3. Verificar logs do servidor
4. Testar com email diferente

### Google Analytics não funciona
1. Verificar se o ID está correto
2. Verificar se o código está no `<head>`
3. Aguardar até 24h para dados aparecerem

### Site lento
1. Verificar se compressão GZIP está ativa
2. Otimizar imagens
3. Verificar cache do navegador
4. Considerar CDN

### Erro 500
1. Verificar permissões dos arquivos
2. Verificar logs de erro do Apache/PHP
3. Verificar sintaxe do `.htaccess`
4. Verificar configurações PHP

## 📞 Suporte

Para dúvidas técnicas sobre o deploy:
1. Verificar logs do servidor
2. Consultar documentação do provedor de hospedagem
3. Testar em ambiente de desenvolvimento primeiro

## 🔄 Atualizações Futuras

Para atualizar o site:
1. Fazer backup dos arquivos atuais
2. Fazer backup do `config.php` (configurações)
3. Upload dos novos arquivos
4. Restaurar configurações personalizadas
5. Testar funcionamento

---

**PowerLine - Elétrica Inteligente** ⚡  
Site pronto para produção!
