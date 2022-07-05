# SUPE

Integração com a API do SUPE para abertura de processos.

## Tabela de erros

O sistema emitirá apenas códigos de erros. Para saber mais, consulte a tabela a seguir:

| Código | Descrição                          | Cenário                                              |
|--------|------------------------------------|------------------------------------------------------|
| 11xxx  | Recebimento de dados inválidos.    | Quando um formato ou tipo de dado não é válido.      |
| 12xxx  | Recebimento de dados obrigatórios. | Quando um dado não existe ou não foi preenchido.     |
| 13xxx  | Banco de dados.                    | Quando uma consulta ao banco de dados retorna vazia. |
| 14xxx  | Parâmetros da URL.                 | Quando um parâmetro inválido é informado na URL.     |

| Código | Descrição                           | Cenário                                                            |
|--------|-------------------------------------|--------------------------------------------------------------------|
| 11001  | invalido_tamanho_arquivo            | O arquivo excedeu o tamanho máximo permitido: 10MB.                |
| 11002  | invalido_tipo_arquivo               | Somente arquivos: PDF, JPEG e PNG são permitidos.                  |
| 11003  | invalido_nomeInteressado            | nomeInteressado padrão inválido. Deve ser um texto (string).       |
| 11004  | invalido_tipoInteressado            | tipoInteressado padrão inválido. Deve ser um texto (string).       |
| 11005  | invalido_cpfCnpjInteressado         | cpfCnpjInteressado padrão inválido. Deve ser um texto (string).    |
| 11006  | invalido_origem                     | origem padrão inválido. Deve ser um texto (string).                |
| 11007  | invalido_codigoSecretaria           | codigoSecretaria padrão inválido. Deve ser um número (int).        |
| 11008  | invalido_codigoSetor                | codigoSetor padrão inválido. Deve ser um número (int).             |
| 11009  | invalido_codigoNatureza             | codigoNatureza padrão inválido. Deve ser um número (int).          |
| 11010  | invalido_tipoDocumento              | tipoDocumento padrão inválido. Deve ser um número (int).           |
| 11011  | invalido_anoProcesso                | anoProcesso padrão inválido. Deve ser um número (int).             |
| 11012  | invalido_numeroProcesso             | numeroProcesso padrão inválido. Deve ser um número (int).          |
| 11013  | invalido_codigoSecretariaDestino    | codigoSecretariaDestino padrão inválido. Deve ser um número (int). |
| 11014  | invalido_codigoSetorDestino         | codigoSetorDestino padrão inválido. Deve ser um número (int).      |
| 11015  | invalido_motivo                     | motivo padrão inválido. Deve ser um texto (string).                |
| 12001  | obrigatorio_nomeInteressado         | nomeInteressado não pode ficar em branco.                          |
| 12002  | obrigatorio_tipoInteressado         | tipoInteressado não pode ficar em branco.                          |
| 12003  | obrigatorio_cpfCnpjInteressado      | cpfCnpjInteressado não pode ficar em branco.                       |
| 12004  | obrigatorio_origem                  | origem não pode ficar em branco.                                   |
| 12005  | obrigatorio_codigoSecretaria        | codigoSecretaria não pode ficar em branco.                         |
| 12006  | obrigatorio_codigoSetor             | codigoSetor não pode ficar em branco.                              |
| 12007  | obrigatorio_codigoNatureza          | codigoNatureza não pode ficar em branco.                           |
| 12008  | obrigatorio_tipoDocumento           | tipoDocumento não pode ficar em branco.                            |
| 12009  | obrigatorio_usuario                 | usuario não pode ficar em branco.                                  |
| 12010  | obrigatorio_senha                   | senha não pode ficar em branco.                                    |
| 12011  | obrigatorio_hash                    | hash não pode ficar em branco.                                     |
| 12012  | obrigatorio_anoProcesso             | anoProcesso não pode ficar em branco.                              |
| 12013  | obrigatorio_numeroProcesso          | numeroProcesso não pode ficar em branco.                           |
| 12014  | obrigatorio_codigoSecretariaDestino | codigoSecretariaDestino não pode ficar em branco.                  |
| 12015  | obrigatorio_codigoSetorDestio       | codigoSetorDestino não pode ficar em branco.                       |
| 12016  | obrigatorio_motivo                  | motivo não pode ficar em branco.                                   |
| 13001  | invalido_login                      | usuário ou senha inválidos.                                        |
| 13002  | invalido_hash                       | hash inválida.                                                     |
| 13003  | invalido_token                      | token inválido ou expirado.                                        |
| 14001  | invalido_codigoSecretaria           | codigoSecretaria parâmetro inválido. Deve conter apenas números.   |
| 14002  | invalido_anoProcesso                | anoProcesso parâmetro inválido. Deve conter apenas números.        |
| 14003  | invalido_numeroProcesso             | numeroProcesso parâmetro inválido. Deve conter apenas números.     |
