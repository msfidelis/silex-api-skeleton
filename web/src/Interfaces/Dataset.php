<?php
namespace App\Interfaces;
/**
 * Interface de Entidades Padrao
 * Deve conter a assinatura dos métodos necessários para
 * uma manipulação genérica de entidades
 */
interface Dataset {
  /**
  * Deve retornar um array contendo todas as propriedades da Entidade
  * @return [array] [Atributos da Classe]
  */
  public function getValues();
}
