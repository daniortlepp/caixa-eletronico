# Sistema de Caixa Eletrônico

Sistema simples do funcionamento de um caixa eletrônico em PHP

### Istalação e como usar

Primeiramente, você deve copiar o repositório para o seu computador:
```zsh
  foo@bar:~$ git clone https://github.com/daniortlepp/caixa-eletronico.git
```
Para iniciar você deve instalar as dependências:
```zsh
  foo@bar:~$ composer install
```
Após a instalação, você pode executar o sistema através do comando:
```zsh
  foo@bar:~$ php main.php
```

### Sobre o sistema

O sistema consiste em três operações básicas:

- Depósito: você deve informar um número de conta e um valor para realizar um depósito.
- Saque: você deve informar um valor para realizar o saque da conta informada acima.
- Transferência: você deve informar um número de conta de destino e um valor para retirar o valor da conta informada no início e trasnferir para a conta de destino.

No arquivo **dados.php** você encontra as contas cadastradas para executar as operações.

