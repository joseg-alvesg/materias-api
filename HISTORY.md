projeto iniciado a partir do template padrão do laravel atráves do composer.

a partir disso foram desenvolvidos um layout com header e footer 
para agilizar o processo de desenvolvimento das outras telas
e uma camada controller.

Não tinha muito conhecimento sobre os padrões de projeto em php,
como seria um desenvolvimento simples optei por utilizar apenas a model e controller
pulando a camada de serviço que conheço dos padrões em javascript por exemplo.

Segui com as rotas solicitadas concluidas no segundo dia de desenvolvimento,
então dicidir finalizar o crud dentro do mesmo controller (app/Http/Controllers/MateriasController.php),
é possivel encontrar os metodos:

- index
- materia
- create
- edit
- delete
- imageUpload (private)
- store
- update
- materiasByUser

as rotas diponiveis são:

- / - GET (tela inicial)
- /materias/create - GET (form de criação)
- /materias/store - POST (envia os dados do form)
- /materias/edit/{id} - Get (form de edição de materia)
- /materias/update - POST (recebe os dados do form de edição)
- /materias/delete/{id} - GET (apaga uma materia)
- /materias/{id} - GET (exibe a materia completa)
- /user/dash - GET (exibe um dashboard com as materias de determinado usuario)

depois de ter concluido o crud decidi fazer algumas validações para renderização condicional das materias
e para atualização das materias com um pouco mais de criterio,
onde apenas o usuario criador do post consegue deletar a materia

por fim ainda sobrando algum tempo, optei por criar alguns testes de integração (tests/Feature/integration/),
pra ter um pouco mais de segurança com o db, enquanto desenvolvia os testes notei algumas
alterações que poderiam ser feitas pra garantir mais segurança a aplicação,
foram validações simples mas já podem ser uteis para um mvp.

Os testes estão rodando no db principal logo acredito que não se deva rodar testes
em produção.

Pensei também em criar testes unitarios para verificar a funcionalidade de cada metodo separadamente,
mas tive alguns problemas com a execução.

ainda teria bastante coisa a se fazer como, criar mais uma camada para desacoplar alguns
metodos da controller por exemplo, incrementar os testes para validações mais robustas,
intensificar o nivel das validações e a forma de retorno delas para serem mais claras e terem mais cobertura.

Todas as alterações podem ser acompanhadas a partir do git e dentro do READE.me coloquei modos de uso.

Utilizei também além das bibliotecas já disponiveis com o laravel, a jetstream que faz parte da familia,
disponivel justamente para gerenciar de forma rapida o login de usuarios e manuteção do perfil individual,
a decisão em adicionar a jetstream foi principalmente a praticidade, pois é uma biblioteca simples, facil de usar
e bem completa pra proposta.
