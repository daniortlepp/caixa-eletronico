<?php
namespace Moovin\Job\Backend;

require_once 'ContaBancaria.php';

/**
 * Classe Conta Corrente
 *
 * @author Daniela Ortlepp <danyortlepp@gmail.com>
 */
class ContaCorrente extends ContaBancaria {

	protected $limiteSaque = 600; /** float */

	protected $taxaOperacao = 2.5; /** float */

	/**
	 * Método que retorna o valor limite para saque da Conta Corrente
	 *
	 * @return float
	 */
	public function getLimiteSaque(){
		return $this->limiteSaque;
	}

	/**
	 * Método que retorna o valor da taxa de operação da Conta Corrente
	 *
	 * @return float
	 */
	public function getTaxaOperacao(){
		return $this->taxaOperacao;
	}

	/**
     * Método de retorno dos dados da conta corrente
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