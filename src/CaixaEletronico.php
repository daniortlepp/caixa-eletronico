<?php

namespace Moovin\Job\Backend;

/**
 * Classe do Caixa Eletr�nico
 *
 * @author Daniela Ortlepp <danyortlepp@gmail.com>
 */
class CaixaEletronico {

    /**
     * M�todo de dep�sito
     *
     * @return json
     */
    public function deposito($contaBancaria, $valor) {
    	$saldoAnterior = $contaBancaria->getSaldo();
    	$contaBancaria->setSaldo($valor + $saldoAnterior);

        return (['success' => true, 'saldo' => $contaBancaria->getSaldo()]);
    }

    /**
     * M�todo de saque
     *
     * @return json
     */
    public function saque($contaBancaria, $valor) {
        if (!$this->verificaSaldo($contaBancaria->getSaldo(), $valor))
            return (['success' => false, 'message' => 'Saldo insuficiente para realizar o saque']);

       	if ($valor > $contaBancaria->getLimiteSaque($contaBancaria->getTipoConta()))
        	return (['success' => false, 'message' => 'O valor informado excedeu o limte de saque de sua conta que � de B$ ' . number_format($contaBancaria->getLimiteSaque($contaBancaria->getTipoConta()), 2, ',', '.')]);

        $saldoAtualizado = $contaBancaria->getSaldo() - $valor - $contaBancaria->getTaxaOperacao($contaBancaria->getTipoConta());
        $contaBancaria->setSaldo($saldoAtualizado);

        return (['success' => true, 'saldo' => $contaBancaria->getSaldo()]);
   }

   /**
     * M�todo de transfer�ncia
     *
     * @return json
     */
    public function transferencia($contaBancaria, $contaDestino, $valor) {
        if (!$this->verificaSaldo($contaBancaria->getSaldo(), $valor))
            return (['success' => false, 'message' => 'Saldo insuficiente para realizar a transfer�ncia']);

       	$saldoAtualizado = $contaBancaria->getSaldo() - $valor;
        $contaBancaria->setSaldo($saldoAtualizado);

        $saldoContaDestino = $contaDestino->getSaldo() + $valor;
        $contaDestino->setSaldo($saldoContaDestino);

        return (['success' => true, 'saldo' => $contaBancaria->getSaldo(), 'saldoContaDestino' => $contaDestino->getSaldo()]);
    }

    /**
     * Fun��o para verificar se a conta banc�ria tem saldo suficiente
     * 
     * @return boolean
     */
    public function verificaSaldo($saldo, $valor) {
        if ($saldo <= 0 || $saldo < $valor)
            return false;
        return true;
    }
}