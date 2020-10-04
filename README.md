# Controle de Medicamentos

Sistema *WEB* básico de controle de medicamentos desenvolvido em *PHP* com o *Framework Laravel 8.6*.

## Sobre

Este sistema é destinado para um controle pessoal de medicamentos (remédios) presentes, onde é possível saber:

- quais os que estão com prazos vencidos ou próximos do vencimento;
- como deve utilizar de acordo com o que foi prescrito pelo médico, sem a necessidade de armazenar uma enorme quantidade de receituários;
- as quantidades disponíveis presentes;
- breves descrições;
- as categorias associadas;
- empresas fabricantes.

Como se trata de uma versão inicial, é cabível muitas melhorias; abaixo segue uma lista não taxativa de algumas possibilidades:

- adiconar relatórios diversos;
- adicionar a possibilidade de visualizar apenas os inclusos pelo usuário com sessão ativa;
- visualizar quem adicionou e atualizou as informações;
- troca de idiomas na *UI*;
- enviar *SMS*, ou *e-mail*, ou qualquer outro tipo, quando houver vencidos ou perto de vencerem.
- inclusão de uma entidade para os emissores das prescrições dos medicamentos __\*__

>__\*__ O objetivo seria a exibição de várias prescrições, nos casos de remédios que tenham sido solicitados por mais de um profissional e para serem utilizados de maneiras distintas. 

### Motivação

A ideia do sistema partiu da atividade de conclusão da disciplina **Desenvolvimento de Aplicações _Web_ em _PHP_**, da Pós-Graduação em *Web* e *Mobile* do [IFPR (Campus Pinhais)](https://pinhais.ifpr.edu.br), no qual solicitava um sistema *WEB* em *PHP* que utilizasse conceitos do *Framework Laravel*.

Para a atividade foi solicitada a criação de um sistema de controle pessoal para um assunto qualquer; os sugeridos foram:

- Controle de séries assistidas;
- Controle de filmes assistidos;
- Controle de qualidade de vinhos degustados;
- Controle de compras no mercado;
- Controle de atividades domésticas.

Este deveria conter, no mínimo, as seguintes características:

| Solicitado | Foi atendido? |
| --- | --- |
| Contenha **CRUD** (Criação/Leitura/Atualização/Deleção) de entidades | Integralmente |
| Envolva pelo menos duas entidades (sem contar com o usuário) | Contando com o usuário foram inclusas quatro entidades |
| As entidades tenham pelo menos um tipo de relacionamento entre si | Possuem relacionamentos **1:N** e **N:N** |
| Contenha um módulo de autenticação de usuários que proteja apenas o acesso às funcionalidades de criação, atualização e deleção | Sim, apenas as funcionalidades de exibição e consulta ficam disponíveis publicamente |
| Algum tipo de validação de dados nos formulários | Há validações no *frontend* e no *backend* |

### Abordagem de desenvolvimento

O projeto foi desenvolvido sob o *Docker* (arquivo de configuração *Dockerfile*) e *docker-compose* (arquivo de configuração *docker-compose.yml*), onde todas as ferramentas utilizadas para o desenvolvimento do sistema estavam em contêineres; no diretório raiz estão os arquivos textos de configuração citados.

Para a base de dados foi utilizado o **SQLite**. Portanto, para a sua ativação, bastou comentar todas as linhas que iniciam com **DB\_**, no arquivo **_.env_** que se encontra na raiz do projeto, exceto **DB_CONNECTION**, onde o valor desta foi substituído por **sqlite**.

#### Versões das tecnologias utilizadas 

- **Docker** (Versão *19.03.8*);
- **Docker Compose** (Orquestrador de contêineres - versão *1.25.0*);
- **Nginx** (Servidor *WEB* - versão *1.19.2*);
- **PHP** (Versão 7.4);
- **Composer** (Gerenciador de pacotes *PHP* - versão *1.10.13*)
- **Laravel** (*Framework PHP* - versão *8.6*);
- **SQLite** (Versão *3.8.8*);
- **Bootstrap** (*JavaScript/CSS* - versões *3.3.7*);
- **JQuery** (versão *3.5.1*).

### Resumo para preparação de ambiente de execução

Após as instalações dos gerenciadores de contêineres, da configuração da base, faz-se necessário execução de alguns comandos do utilitário *Artisan* do *Laravel*:

1. Preparar toda a estrutura da base de dados: 
```sh
docker-compose exec app php artisan migrate:refresh
```

2. Realizar limpeza dos *caches* do *Laravel* *(Configuration cache, Route cache, Compiled views, Blade templates)*: 
```sh
docker-compose exec app php artisan optimize
```

3. **(Opcional)** Alimentar o banco com alguns dados de teste iniciais:
```sh
docker-compose exec app php artisan db:seed
```
