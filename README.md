# Primeiro projeto criado sozinho

Por volta de janeiro de 2020 durante minhas ferias criei esse sistema de apontamento de horas em PHP, pois estava estudando programação web 
a 4 meses e queria ter uma noção de como funciona um sistema, queria entender porque usar POO, o porque das boas praticas e etc...

No fim, consegui criar esse Sistema que basicamente serve para realizar apontamentos de hora (entrada, almoço e saida).

O sistema tem 2 tipos de perfis.
#### Perfil padrão que tem acesso apenas ao painel do proprio usuario e as funções de:

- Marcar horario(entrada, almoço e saida)
- Solicitar uma correção(caso o usuario tenha esquecido de registrar seu horario no momento da volta do almoço por exemplo)
- Verificar o seu historico (correções solicitadas, correções aprovadas e correções reprovadas)
- Verificar a quantidade de horas trabalhadas por mes ou por dia e a quantidade de horas esperadas para o mes corrente

#### Administrador vai ter acesso a todas as funções citadas acima porém para todos os usuarios do sistema e também tera acesso as seguintes funções:

- Gerar Relatorios mensais dos usuarios, com todos os horarios de cada dia, quantidade de horas esperadas para o mès e quantidade de horas trabalhadas no mês.

- Ter acesso a um painel com todas as solicitações de correção de horario feitas pelos usuarios.
- Aprovar ou recusar uma correção de horario.
- Criar novos usuarios

O sistema foi escrito quase 100% em PHP pois na epoca não conhecia quase nada de javascript, utilizei javascript somente para algumas mensagens na tela.

Foi utilizado mysql para guardar todos os dados,e a senha do usuarios é convertida em um hash md5 para assegurar a privacidade dos usuario(hoje em dia sei que hashs md5 são faceis de quebrar e que metodos mais seguros como token JWT existem)
