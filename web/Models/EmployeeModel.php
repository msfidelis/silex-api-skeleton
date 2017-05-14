<?php

namespace App\Models;

use App\System\Model;

/**
 * Exemplo simples de Model da API
 * @email msfidelis01@gmail.com
 * @author Matheus Fidelis
 */
class EmployeeModel extends Model 
{

  /**
   * Tabela da entidade
   * @var type
   */
  private $table = "employee";

  /**
   * Método de insert com o Query Builder
   * @param array $data
   * @return type
   */
  public function insert(array $data) 
  {
    $newEmployee = $this->DBInsert($this->table, $data);
     if ($newEmployee) {
       return $this->findEmployeeByID($newEmployee);
     }
  }

  /**
   * Exemplo de select pelo ID efetuado utilizando o Query Builder
   * @param type $id
   * @return type
   */
  public function findEmployeeByID($id) 
  {
    if ($id) {
      $query = $this->newQuery();
      $query->select('*')
          ->from($this->table)
          ->where("id = {$id}");
      return $this->execute($query)->fetch();
    }
  }

  /**
   * Exemplo de full table scan utilizando o Query Builder
   * @param type $fields
   * @return type
   */
  public function findAll($fields = array("*")) 
  {
    $query = ($this->newQuery())
    ->select($fields)
        ->from($this->table);

    $result = $this->execute($query);
    return $result->fetchAll();
  }

  /**
   * Exemplo de Update
   * @param type $id
   * @param array $data
   */
  public function update($id, array $data) 
  {
     $where = array(
       'id' => (int) $id
     );
     $update = $this->DBUpdate($this->table, $data, $where);

     if ($update) {
       return $this->findEmployeeByID($id);
     } else {
       return false;
     }
    
  }

  /**
   * Exemplo de delete
   * @param type $id
   * @return type
   */
  public function delete($id) 
  {
    if (is_int($id)) {
      $query = $this->newQuery();
      $query->delete($this->table)
          ->where("id = {$id}");
      return $this->execute($query);
    }
  }

}
