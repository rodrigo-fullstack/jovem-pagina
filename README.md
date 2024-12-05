# Jovem Página - Desafio de Código

A Jovem Página é um site de ecommerce de livros voltado para jovens de 12 a 18 anos. Nós oferecemos diversos tipos de livros, como livros de ação, de comédia, de terror, de fantasia, de ficção científica, até de filosofia, política e os clássicos. Para ofertá-los, analisamos o perfil de vendedores de confiança, que irão disponibilizar os livros com um preço justo ajustado à média do mercado. Também, com a contratação de jornalistas, será oferecido notícias, tais como de autores, de novos livros, de eventos ou de premiações, para trazer maior informação para os jovens e desenvolver seus aspectos culturais e literários.

Esse projeto é um desafio proposto por nós da equipe do Future Dev, um grupo de alunos do SENAI Dendezeiros estudando juntos para desenvolver sites. 

Alguns critérios que estamos analisando atualmente é a estruturação da interface web da aplicação, cobrando conceitos como: 

- HTML: Tags Semânticas, imagens, links, etc.
- CSS: Estilização - Cores, Fontes, etc.
- CSS: Layout - Display Grid e Display Flex.

# Doc Requisitos

1. INTRODUÇÃO GERAL

A Jovem Página é um site de ecommerce de livros voltado para jovens de 12 a 18 anos. Nós ofereceremos diversos tipos de livros, tais como livros de ação, de comédia, de romance, de terror, e até de filosofia, política ou literatura clássica.

Sobre a oferta dos livros, serão ofertados, dessa forma, por meio de vendedores de confiança, com a confiança comprovada através da resposta de formulários e com entrevistas com analistas da empresa. Também, com relação aos preços, será definido um preço médio para cada livro que os vendedores poderão colocar, não podendo ultrapassar um limite máximo do preço do livro.

Também os jovens poderão visualizar notícias publicadas pelos nossos jornalistas com enfoque total em livros, para trazer maior interesse e informação para os usuários da plataforma, possibilitando saber sobre eventos, autores, novos livros e outros casos.

2. REQUISITOS FUNCIONAIS

A seguir estão os requisitos funcionais do projeto:

    O sistema deve fornecer uma interface de usuário intuitiva e moderna

    O sistema deve permitir o cadastro de novos usuários: email, senha e CPF

    O sistema deve permitir a autenticação de usuários da plataforma através de email e senha

    O sistema deve permitir a criação de anúncios de livros por vendedores de confiança, definindo descrição detalhada, imagem e sobre o autor, editora, edição e outras informações.

    O sistema deve permitir a publicação de livros por vendedores de confiança.

    O sistema deve aceitar por parte dos vendedores somente livros voltados para jovens de acordo com o catálogo definido na empresa,

    O sistema deve permitir aos usuários adicionar itens no carrinho

    O sistema deve permitir aos usuários realizar o pagamento de seus itens no carrinho

    O sistema deve permitir aos usuários utilizar os métodos de pagamento: Pix, Cartão de Crédito, Cartão de Débito e Boleto Bancário.

    O sistema deve permitir a entrega dos livros aos usuários mediante pagamento de frete

    O sistema deve permitir a avaliação dos livros comprados pelos usuários.

    O sistema deve cadastrar previamente os jornalistas com os dados fornecidos para a empresa.

    O sistema deve permitir aos jornalistas criar e publicar as notícias na plataforma.

    O sistema deve oferecer uma interface para os jornalistas criar e gerenciar suas notícias, visualizando informações como visualizações da notícia, curtidas e comentários.

    O sistema deve permitir aos usuários visualizar as notícias publicadas pelos jornalistas

    O sistema deve oferecer uma interface de administrador para gerenciar os anúncios dos vendedores e notícias dos jornalistas.

    O sistema deve permitir o cadastro e a autenticação dos administradores.

    O sistema deve manter documentado suas funcionalidades.

3. REQUISITOS NÃO FUNCIONAIS

Já sobre os requisitos não funcionais, tem-se o seguinte: 

    O cadastro do usuário no banco de dados deve ser feito em no máximo 5 segundos

    O acesso às paginas do sistema não deve demorar mais do que 20 segundos em períodos de operação normal

    O sistema deve consumir no máximo 200MB no navegador do usuário

    A interface web do sistema será construída através das ferramentas HTML, CSS e JS

    O BackEnd das autenticações e cadastro de dados do sistema será desenvolvido em PHP

    O BackEnd do sistema deve ser livre de SQL Injection e XSS Injection

    A senha dos usuários deve ser criptografada com o algoritmo md5

    O banco de dados será do tipo relacional construído com o SGBD MySQL

    O sistema deve garantir a segurança das transações com os métodos de pagamento Pix, Cartão de Crédito, Cartão de Débito e Boleto Bancário de acordo com a LGPD

    O sistema deve possibilitar execução no MacOS e Windows

    O sistema deve receber os dados dos jornalistas via formulário e realizar o cadastro no banco de dados MySQL

    Os jornalistas utilizarão a rota jovempagina/jornalistas/login para construção das matérias sobre os livros, onde serão autenticados solicitando seu login e senha.

 
4. ESCOPO DO PROJETO

O Escopo do Projeto, que inclui todos os seus entregáveis e não entregáveis, é o seguinte:

    Interface Web criada com HTML, CSS e JS

        Header

            LOGO

            Pesquisa de Produtos

            ENTRAR

            Notícias

            Ofertas em:

            Cupons

        Rodapé

            Home

            Sobre

            Equipe de Desenvolvedores

            Como vender na plataforma

            Termos de Privacidade

            Termos de Adesão

            LGPD

            Telefone

            Email

            Endereço

            FAQ

        Tela de Login: Permite os usuários acessarem a plataforma

            Digitação dos Dados do Cadastro: email ou telefone e senha

        Tela de Cadastro: Permite os usuários cadastrarem seus dados

            Digitação dos Dados como: email, telefone, CPF, etc.

        Tela Inicial:

            Moldura da Semana: Exibe as ofertas, lançamentos e notícias da semana

            Recomendação de Livros para o usuário

            Livros em Destaque Geral: Pode incluir ofertas

            Livros de Ação

            Livros de Terror

            Categorias

        Tela de Notícias: Poderá visualizar notícias sobre livros, eventos de livros, premiações e autores;

            Notícias Recomendadas para o Usuário

            Notícias em Destaque

            Notícias sobre Eventos

            Painel Lateral sobre Notícias

                Categorias de Notícias

                Eventos

                Premiações

                Autores

        Página de Produto Selecionado: Ao selecionar o produto, exibe o anúncio do vendedor

            Descrição Detalhada

            Avaliação dos Clientes

            Imagem do livro

            Livros Relacionados

        Tela de Carrinho de Compras: 

            Produtos no Carrinho com quantidade

            Botão de Finalizar Compra

            Valor total dos itens

        Tela de Perfil

        Tela de Criação de Anúncio de Livros: Permite os vendedores criar um anúncio de livro

        Tela do Formulário dos Jornalistas

        Tela de Login dos Jornalistas

        Tela de Criação de Notícias dos Jornalistas

        Tela dos Administradores do Sistema

    Sistema de Cadastro e Autenticação dos usuários comuns e vendedores realizado com PHP

        Cadastro realizando Insert no Banco de Dados

        Autenticação utilizando $_SESSION[]

        Implementar Segurança da Informação

    Sistema de Cadastro e Autenticação dos jornalistas desenvolvido em PHP

        Cadastro dos dados do formulário em tabela intermediária até ser aceito pela empresa

        Os pré-requisitos básico para o jornalista ser aceito é ter ensino superior completo e hábito de leitura constante

        A aceitação dos jornalistas se dará por meio de análise de currículo e entrevista presencial ou remota com os funcionários da empresa

        Criação da Rota jovempagina/jornalistas/login para autenticação dos jornalistas.