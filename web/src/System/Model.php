<?php
namespace App\System;

use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Classe abstrata do Model
 * Prove recursos de conexão compartilhados 
 * para todas as classes que precisam de conexão 
 * @documentacao "http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/query-builder.html"
 * @documentacao "https://media.readthedocs.org/pdf/doctrine-dbal/latest/doctrine-dbal.pdf"
 * @email msfidelis01@gmail.com
 * @author Matheus Fidelis
 */
abstract class Model {
  /**
   * Uma instância genérica do Query Builder
   * @var type object Query Builder
   */
	public static $query;
  
  /**
   * Uma instância das configurações de conexão do ORM
   * @var type 
   */
	public static $db;

  /**
   * Executa a query constrída pelo Query Builder do Doctrine
   * @param type $query string 
   * @param type $toArray define se o retorno será um Array ou um Objeto
   * @return type 
   */
	protected function execute($query, $toArray = True) {
		$return = self::$db->executeQuery($query)->fetchAll();
		if ($toArray) {
			return $return;
		} else {
			return (object) $return;
		}
	}

  /**
   * Sempre retorna uma nova instância do Query Builder
   * @return QueryBuilder
   */
	protected function newQuery() {
		return new QueryBuilder(self::$db);
	}

  /**
   * Método de delete nativo do Doctrine 
   * @param type $table tabela a ser trabalhada
   * @param array $where contêm os parâmetros do where
   * @return type boolean
   */
	protected function DBDelete($table, Array $where) {
		return self::$db->delete($table, $where);
	}

  /**
   * Método de insert nativo do Doctrine
   * @param type $table tabela a ser trabalhada
   * @param array $values array contendo o conteúdo a ser inserido
   * @return type boolean
   */
	protected function DBInsert($table, Array $values) {
		return self::$db->insert($table, $values);
	}

  /**
   * Método de update nativo do Doctrine
   * @param type $table tabela a ser trabalhada
   * @param array $values valores a serem atualizados
   * @param array $where array com as clausulas do Where
   * @return type boolean
   */
	protected function DBUpdate ($table, Array $values, Array $where ) {
		return self::$db->update($table, $values, $where); 
	}

}