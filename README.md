# PowerLine - Site Institucional

Um site institucional moderno e responsivo para a PowerLine, empresa especializada em soluções elétricas industriais.

## 📋 Sobre o Projeto

Este é um site de página única (SPA) desenvolvido para apresentar os serviços da PowerLine de forma profissional e atrativa. O projeto foi criado com foco em:

- Design moderno e responsivo
- Experiência do usuário otimizada
- Performance e acessibilidade
- Facilidade de manutenção

## 🚀 Tecnologias Utilizadas

- **HTML5**: Estrutura semântica e acessível
- **CSS3**: Estilos modernos com Flexbox e Grid
- **JavaScript**: Interatividade e animações suaves
- **Google Fonts**: Tipografia profissional (Inter)

## 📁 Estrutura do Projeto

```
site-powerline/
├── index.html          # Página principal
├── css/
│   └── style.css       # Estilos principais
├── js/
│   └── script.js       # JavaScript principal
├── images/             # Pasta para imagens
└── README.md           # Este arquivo
```

## 🎨 Seções do Site

### 1. Header/Navegação
- Logo da PowerLine
- Menu de navegação responsivo
- Menu hamburger para mobile

### 2. Hero Section
- Apresentação principal da empresa
- Call-to-action para serviços e contato
- Design impactante e profissional

### 3. Sobre a PowerLine
- Missão da empresa
- Experiência e credibilidade
- Estatísticas importantes (projetos, clientes, suporte)

### 4. Serviços
- Grid responsivo com 6 serviços principais:
  - Instalações Industriais
  - Manutenção Preventiva
  - Automação Industrial
  - Projetos Elétricos
  - Manutenção Corretiva
  - Laudos e Inspeções

### 5. Contato
- Informações de contato completas
- Formulário de solicitação de orçamento
- Validação de campos obrigatórios

### 6. Footer
- Links rápidos
- Informações de contato
- Copyright

## 🛠️ Como Executar o Projeto

### Pré-requisitos
- Navegador web moderno (Chrome, Firefox, Safari, Edge)
- Editor de código (VS Code recomendado)

### Execução Local
1. Clone ou baixe o projeto
2. Abra o arquivo `index.html` diretamente no navegador, ou
3. Use um servidor local (recomendado):

#### Opção 1: Live Server (VS Code)
- Instale a extensão "Live Server" no VS Code
- Clique com botão direito no `index.html`
- Selecione "Open with Live Server"

#### Opção 2: Python (se instalado)
```bash
# Python 3
python -m http.server 8000

# Python 2
python -m SimpleHTTPServer 8000
```
Acesse: `http://localhost:8000`

#### Opção 3: Node.js
```bash
npx http-server
```

## 📱 Responsividade

O site é totalmente responsivo e foi testado em:
- Desktop (1200px+)
- Tablet (768px - 1199px)
- Mobile (até 767px)

### Breakpoints Principais:
- `768px`: Tablet e mobile
- `480px`: Mobile pequeno

## 🎯 Funcionalidades

### JavaScript Implementado:
- ✅ Menu mobile responsivo
- ✅ Navegação suave entre seções
- ✅ Highlight automático do menu ativo
- ✅ Formulário de contato com validação
- ✅ Animações de entrada dos elementos
- ✅ Contadores animados nas estatísticas
- ✅ Header que muda com scroll
- ✅ Prevenção de scroll horizontal

### CSS Features:
- ✅ Variáveis CSS (Custom Properties)
- ✅ Grid e Flexbox layouts
- ✅ Animações e transições suaves
- ✅ Sistema de cores consistente
- ✅ Tipografia escalável
- ✅ Sombras e efeitos modernos

## 🎨 Paleta de Cores

```css
--primary-color: #1a365d    /* Azul escuro principal */
--secondary-color: #2d7dd2  /* Azul médio */
--accent-color: #f7b731     /* Amarelo/dourado */
--text-dark: #2d3748        /* Texto escuro */
--text-light: #718096       /* Texto claro */
--white: #ffffff            /* Branco */
--light-gray: #f7fafc       /* Cinza claro */
```

## 📝 Personalizações Futuras

### Próximos Passos Sugeridos:
1. **Imagens Reais**: Substituir placeholders por fotos da empresa
2. **Backend**: Integrar formulário com servidor/API
3. **SEO**: Adicionar meta tags e estrutura de dados
4. **Analytics**: Implementar Google Analytics
5. **Performance**: Otimizar imagens e recursos
6. **Acessibilidade**: Melhorar ARIA labels e navegação por teclado

### Possíveis Melhorias:
- Galeria de projetos realizados
- Depoimentos de clientes
- Blog/notícias do setor
- Certificações e parcerias
- Chat online
- Múltiplos idiomas

## 🔧 Manutenção

### Para Atualizar Conteúdo:
1. **Textos**: Edite diretamente no `index.html`
2. **Estilos**: Modifique `css/style.css`
3. **Funcionalidades**: Ajuste `js/script.js`
4. **Imagens**: Adicione na pasta `images/` e atualize referências

### Para Adicionar Novas Seções:
1. Adicione HTML na estrutura adequada
2. Crie estilos CSS correspondentes
3. Atualize navegação se necessário
4. Teste responsividade

## 👥 Divisão de Trabalho Sugerida

### Desenvolvedor A - Frontend/Design:
- Refinamento visual e UX
- Animações e interações
- Otimização de imagens
- Testes de responsividade

### Desenvolvedor B - Funcionalidades/Backend:
- Integração do formulário
- Validações avançadas
- SEO e performance
- Implementação de analytics

## 📞 Suporte

Para dúvidas sobre o código ou sugestões de melhorias, consulte:
- Documentação inline nos arquivos
- Comentários explicativos no código
- Este README.md

## 📄 Licença

Este projeto foi desenvolvido para uso exclusivo da PowerLine.

---

**PowerLine** - Soluções em Energia Elétrica ⚡
