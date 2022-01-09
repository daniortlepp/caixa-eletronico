<?php
namespace Moovin\Job\Backend;

require_once 'ContaBancaria.php';

/**
 * Classe Conta Poupança
 *
 * @author Daniela Ortlepp <danyortlepp@gmail.com>
 */
class ContaPoupanca extends ContaBancaria {

	protected $limiteSaque = 1000; /** float */

	protected $taxaOperacao = 0.8; /** float */

	/**
	 * Método que retorna o valor limite para saque da Conta Poupança
	 *
	 * @return float
	 */
	public function getLimiteSaque(){
		return $this->limiteSaque;
	}

	/**
	 * Método que retorna o valor da taxa de operação da Conta Poupança
	 *
	 * @return float
	 */
	public function getTaxaOperacao(){
		return $this->taxaOperacao;
	}

	/**
     * Método de retorno dos dados da Conta Poupança
     *
     * @return array
     */
    public function toArray() {
    	$contaBancaria = new ContaBancaria;

		$data['nomeTitular'] = $contaBancaria->getNomeTitular();
		$data['cpfTitular'] = $contaBancaria->getCpfTitular();
		$data['numeroConta'] = $contaBancaria->getNumeroConta();
		$data['agencia'] = $contaBancaria->getAgencia();
		$data['limiteSaque'] = $this->limiteSaque;
		$data['taxaOperacao'] = $this->taxaOperacao;
		
        return $data;
    }
}