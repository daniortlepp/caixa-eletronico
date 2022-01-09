<?php

namespace Moovin\Job\Backend\Tests;

require_once 'dados.php';

use Moovin\Job\Backend;

/**
 * Teste unitário da classe Moovin\Job\Backend\CaixaEletronico
 */
class CaixaEletronicoTest extends \PHPUnit_Framework_TestCase {
    /** @var Backend\CaixaEletronico */
    protected $contaBancaria;
    protected $contaDestino;
    protected $caixaEletronico;

    /**
     * {@inheritdoc}
     */
    protected function setUp() {
        $this->contaBancaria = new Backend\ContaBancaria;
        $this->contaBancaria->setId(1);
        $this->contaBancaria->setNomeTitular('João da Silva');
        $this->contaBancaria->setCpfTitular('40451677900');
        $this->contaBancaria->setNumeroConta('44789963');
        $this->contaBancaria->setAgencia('0001');
        $this->contaBancaria->setTipoConta('CP');
        $this->contaBancaria->setSaldo(500);

        $this->contaDestino = new Backend\ContaBancaria;
        $this->contaDestino->setId(2);
        $this->contaDestino->setNomeTitular('Maria dos Santos');
        $this->contaDestino->setCpfTitular('65788942136');
        $this->contaDestino->setNumeroConta('24896652');
        $this->contaDestino->setAgencia('0001');
        $this->contaDestino->setTipoConta('CC');
        $this->contaDestino->setSaldo(0);

        $this->caixaEletronico = new Backend\CaixaEletronico();
    }

    public function testDeposito() {
        $deposito = $this->caixaEletronico->deposito($this->contaBancaria, 80);
        $this->assertEquals(580, $this->contaBancaria->getSaldo()); 
    }

    /**
     * @covers Moovin\Job\Backend\CaixaEletronico::taxaOperacao
     */
    public function testTaxaOperacao() {
        $this->assertEquals(0.8, $this->contaBancaria->getTaxaOperacao($this->contaBancaria->getTipoConta())); 
    }

    /**
     * @covers Moovin\Job\Backend\CaixaEletronico::saqueSaldoInsuficiente
     */
    public function testSaqueSaldoInsuficiente() {
        $this->assertEquals('Saldo insuficiente para realizar o saque', $this->caixaEletronico->saque($this->contaBancaria, 1000)['message']); 
    }

    /**
     * @covers Moovin\Job\Backend\CaixaEletronico::saqueLimiteExcedido
     */
    public function testSaqueLimiteExcedido() {
        $this->contaBancaria->setSaldo(2000);
        $this->assertEquals('O valor informado excedeu o limte de saque de sua conta', $this->caixaEletronico->saque($this->contaBancaria, 1500)['message']); 
    }

    /**
     * @covers Moovin\Job\Backend\CaixaEletronico::transferencia
     */
    public function testTransferencia() {
        $transferencia = $this->caixaEletronico->transferencia($this->contaBancaria, $this->contaDestino, 150);
        $this->assertEquals(true, $transferencia['success']); 
        $this->assertEquals(150, $this->contaDestino->getSaldo()); 
        $this->assertEquals(350, $this->contaBancaria->getSaldo()); 
    }
}
