<?php
use projetos\caixaeletronico

$contasCadastradas = array(
   array("id" => 1, "nomeTitular" => "Daniela Ortlepp", "cpfTitular" => "12345678910", "numeroConta" => "78070420", "agencia" => "0001", "tipoConta" => "CC", "saldo" => 0),
   array("id" => 2, "nomeTitular" => "Ester da Rocha", "cpfTitular" => "40451677900", "numeroConta" => "68906087", "agencia" => "0001", "tipoConta" => "CC", "saldo" => 100),
   array("id" => 3, "nomeTitular" => "Nicole Baptista", "cpfTitular" => "41410853675", "numeroConta" => "59062305", "agencia" => "0001", "tipoConta" => "CP", "saldo" => 50),
   array("id" => 4, "nomeTitular" => "Yago Diogo Moraes", "cpfTitular" => "40957398514", "numeroConta" => "69314579", "agencia" => "0001", "tipoConta" => "CC", "saldo" => 0),
   array("id" => 5, "nomeTitular" => "Pedro Henrique Farias", "cpfTitular" => "72357610590", "numeroConta" => "14031750", "agencia" => "0001", "tipoConta" => "CP", "saldo" => 20),
   array("id" => 6, "nomeTitular" => "Amanda Costa", "cpfTitular" => "00696761866", "numeroConta" => "11225649", "agencia" => "0001", "tipoConta" => "CP", "saldo" => 0),
);

/**
 * Função para buscar a conta pelo número
 */
function buscarConta($numeroConta, $array) {
   foreach ($array as $key => $val) {
       if ($val['numeroConta'] === $numeroConta) {
           return $key;
       }
   }
   return null;
}

/*
Contas cadastradas detalhadas para facilitar a usabilidade do sistema:

Nome do Titular: Daniela Ortlepp
CPF do Titular: 12345678910
Número da conta: 78070420
Agência: 0001
Tipo da conta: Conta Corrente
Saldo inicial: R$ 0,00

Nome do Titular: Ester da Rocha
CPF do Titular: 40451677900
Número da conta: 68906087
Agência: 0001
Tipo da conta: Conta Corrente
Saldo inicial: R$ 100,00

Nome do Titular: Nicole Baptista
CPF do Titular: 41410853675
Número da conta: 59062305
Agência: 0001
Tipo da conta: Conta Poupança
Saldo inicial: R$ 50,00

Nome do Titular: Yago Diogo Moraes
CPF do Titular: 40957398514
Número da conta: 69314579
Agência: 0001
Tipo da conta: Conta Corrente
Saldo inicial: R$ 0,00

Nome do Titular: Pedro Henrique Farias
CPF do Titular: 72357610590
Número da conta: 14031750
Agência: 0001
Tipo da conta: Conta Poupança
Saldo inicial: R$ 20,00

Nome do Titular: Amanda Costa
CPF do Titular: 00696761866
Número da conta: 11225649
Agência: 0001
Tipo da conta: Conta Poupança
Saldo inicial: R$ 0,00

*/
