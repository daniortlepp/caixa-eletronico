<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once 'dados.php';

use projetos\caixaeletronico;


$caixaEletronico = new caixaeletronico\CaixaEletronico();

$contaDeposito = readline('Informe o número da sua conta para iniciar: ');
$contaPrimaria = buscarConta($contaDeposito, $contasCadastradas);

while ($contaPrimaria === null) {
    if ($contaPrimaria === null) {
		echo 'Essa conta não existe. Informe outra conta.' . PHP_EOL;
	}
	$contaDeposito = readline('Número da conta para depósito: ');
	$contaPrimaria = buscarConta($contaDeposito, $contasCadastradas);
}

$contaBancaria = new caixaeletronico\ContaBancaria;
$contaBancaria->setId($contasCadastradas[$contaPrimaria]['id']);
$contaBancaria->setNomeTitular($contasCadastradas[$contaPrimaria]['nomeTitular']);
$contaBancaria->setCpfTitular($contasCadastradas[$contaPrimaria]['cpfTitular']);
$contaBancaria->setNumeroConta($contasCadastradas[$contaPrimaria]['numeroConta']);
$contaBancaria->setAgencia($contasCadastradas[$contaPrimaria]['agencia']);
$contaBancaria->setTipoConta($contasCadastradas[$contaPrimaria]['tipoConta']);
$contaBancaria->setSaldo($contasCadastradas[$contaPrimaria]['saldo']);

echo 'Seja bem-vindo(a) ' . $contaBancaria->getNomeTitular() . '. O saldo atual da sua conta é de B$ ' . number_format($contaBancaria->getSaldo(), 2, ',', '.') . PHP_EOL;

$valorDeposito = readline('Valor para depósito: ');
while (!is_numeric($valorDeposito)) {
    if (!is_numeric($valorDeposito)) {
		echo 'O valor informado é inválido.' . PHP_EOL;
	}
	$valorDeposito = readline('Valor para depósito: ');
}
$deposito = $caixaEletronico->deposito($contaBancaria, $valorDeposito);

if ($deposito['success'])
	echo 'O saldo atualizado da sua conta bancária é de B$ ' . number_format($deposito['saldo'], 2, ',', '.') . PHP_EOL;
else
	echo 'Ocorreu um erro ao tentar realizar o depósito. Tente novamente.' . PHP_EOL;

$valorSaque = readline('Valor para saque: ');
while (!is_numeric($valorSaque)) {
    if (!is_numeric($valorSaque)) {
		echo 'O valor informado é inválido.' . PHP_EOL;
	}
	$valorSaque = readline('Valor para saque: ');
}
$saque = $caixaEletronico->saque($contaBancaria, $valorSaque);

if ($saque['success'])
	echo 'Você realizou um saque de B$ ' . number_format($valorSaque, 2, ',', '.') . '. A taxa para essa operação é de B$ ' . number_format($contaBancaria->getTaxaOperacao($contaBancaria->getTipoConta()), 2, ',', '.') . ' e o saldo atualizado da sua conta bancária é de B$ ' . number_format($saque['saldo'], 2, ',', '.') . PHP_EOL;
else
	echo $saque['message'] . PHP_EOL;

$contaTransferencia = readline('Número da conta para transferência: ');
$contaDestinatario = buscarConta($contaTransferencia, $contasCadastradas);

while ($contaDestinatario === null) {
    if ($contaDestinatario === null) {
		echo 'Essa conta não existe. Informe outra conta.' . PHP_EOL;
	}
	$contaTransferencia = readline('Número da conta para transferência: ');
	$contaDestinatario = buscarConta($contaTransferencia, $contasCadastradas);
}

$contaBancariaDestino = new caixaeletronico\ContaBancaria;
$contaBancariaDestino->setId($contasCadastradas[$contaDestinatario]['id']);
$contaBancariaDestino->setNomeTitular($contasCadastradas[$contaDestinatario]['nomeTitular']);
$contaBancariaDestino->setCpfTitular($contasCadastradas[$contaDestinatario]['cpfTitular']);
$contaBancariaDestino->setNumeroConta($contasCadastradas[$contaDestinatario]['numeroConta']);
$contaBancariaDestino->setAgencia($contasCadastradas[$contaDestinatario]['agencia']);
$contaBancariaDestino->setTipoConta($contasCadastradas[$contaDestinatario]['tipoConta']);
$contaBancariaDestino->setSaldo($contasCadastradas[$contaDestinatario]['saldo']);

$valorTransferencia = readline('Valor para transferência: ');
while (!is_numeric($valorTransferencia)) {
    if (!is_numeric($valorTransferencia)) {
		echo 'O valor informado é inválido.' . PHP_EOL;
	}
	$valorTransferencia = readline('Valor para transferência: ');
}
$transferencia = $caixaEletronico->transferencia($contaBancaria, $contaBancariaDestino, $valorTransferencia);

if ($transferencia['success'])
	echo 'Você realizou uma transferência de B$ ' . number_format($valorTransferencia, 2, ',', '.') . ' para a conta de ' . $contaBancariaDestino->getNomeTitular() . '. ' . PHP_EOL . 'O saldo atualizado da sua conta bancária é de B$ ' . number_format($transferencia['saldo'], 2, ',', '.') . ' e o saldo atualizado da conta de ' . $contaBancariaDestino->getNomeTitular() . ' é de B$ ' . number_format($transferencia['saldoContaDestino'], 2, ',', '.') . PHP_EOL;
else
	echo $transferencia['message'] . PHP_EOL;
