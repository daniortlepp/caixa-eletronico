<?php

namespace Moovin\Job\Backend;

/**
 * Classe Conta Banc�ria
 *
 * @author Daniela Ortlepp <danyortlepp@gmail.com>
 */
class ContaBancaria {
	
	protected	$id;			/** integer */
	protected   $nomeTitular;	/** string */
	protected 	$cpfTitular;	/** string */
	protected   $numeroConta;	/** string */
	protected	$agencia;		/** string */
	protected	$tipoConta;		/** string */
	protected	$saldo;			/** float */

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getNomeTitular() {
		return $this->nomeTitular;
	}
	
	public function setNomeTitular($nomeTitular) {
		$this->nomeTitular = $nomeTitular;
	}

	public function getCpfTitular() {
		return $this->cpfTitular;
	}
	
	public function setCpfTitular($cpfTitular) {
		$this->cpfTitular = $cpfTitular;
	}
	
	public function getNumeroConta() {
		return $this->numeroConta;
	}
	
	public function setNumeroConta($numeroConta) {
		$this->numeroConta = $numeroConta;
	}
	
	public function getAgencia() {
		return $this->agencia;
	}
	
	public function setAgencia($agencia) {
		$this->agencia = $agencia;
	}

	public function getTipoConta() {
		return $this->tipoConta;
	}
	
	public function setTipoConta($tipoConta) {
		$this->tipoConta = $tipoConta;
	}

	public function getSaldo() {
		return $this->saldo;
	}
	
	public function setSaldo($saldo) {
		$this->saldo = $saldo;
	}

	public function getLimiteSaque($tipoConta) {
		if ($tipoConta == 'CC') return 600;
		else if ($tipoConta == 'CP') return 1000;
		else return 0;
	}

	public function getTaxaOperacao($tipoConta) {
		if ($tipoConta == 'CC') return 2.5;
		else if ($tipoConta == 'CP') return 0.8;
		else return 0;
	}
	
    /**
     * M�todo de retorno dos dados da conta banc�ria
     *
     * @return array
     */
    public function toArray() {
		$data['id'] = $this->getId();
		$data['nomeTitular'] = $this->getNomeTitular();
		$data['cpfTitular'] = $this->getCpfTitular();
		$data['numeroConta'] = $this->getNumeroConta();
		$data['agencia'] = $this->getAgencia();
		$data['tipoConta'] = $this->getTipoConta();
		$data['saldo'] = $this->getSaldo();
		$data['limiteSaque'] = $this->getLimiteSaque($this->getTipoConta());
		$data['taxaOperacao'] = $this->getTaxaOperacao($this->getTipoConta());
		
        return $data;
    }
}