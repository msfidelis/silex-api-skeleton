<?php

namespace App\Models;

use App\System\Model;

/**
 * Exemplo simples de Model da API
 * @email msfidelis01@gmail.com
 * @author Matheus Fidelis
 */
class CompanyModel extends Model {

  /**
   * Tabela da entidade
   * @var type 
   */
  private $table = "COMPANY2";

  /**
   * Método de insert com o Query Builder
   * @param array $data
   * @return type
   */
  public function insert(array $data) {
    $queryInsert = $this->newQuery();
    $queryInsert->insert($this->table)
        ->values($data);
    return $this->execute($queryInsert);
  }

  /**
   * Exemplo de select pelo ID efetuado utilizando o Query Builder
   * @param type $id
   * @return type
   */
  public function findEmployeeByID($id) {
    if ($id) {
      $query = $this->newQuery();
      $query->select('*')
          ->from($this->table)
          ->where("id = {$id}");
      return $this->execute($query)[0];
    }
  }

  /**
   * Exemplo de full table scan utilizando o Query Builder
   * @param type $fields
   * @return type
   */
  public function findAll($fields = array("*")) {
    $query = ($this->newQuery())
    ->select($fields)
        ->from($this->table);
    return $this->execute($query);
  }

  /**
   * Exemplo de Update 
   * @param type $id
   * @param array $data
   */
  public function update($id, array $data) {
     $where = array(
       'id' => (int) $id
     );
     return $this->DBUpdate($this->table, $data, $where);
  }

  /**
   * Exemplo de delete
   * @param type $id
   * @return type
   */
  public function delete($id) {
    if (is_int($id)) {
      $query = $this->newQuery();
      $query->delete($this->table)
          ->where("id = {$id}");
      return $this->execute($query);
    }
  }

}
