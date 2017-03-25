<?php

namespace App\Models;

use App\System\Model;

use App\Models\Entity\User;
use App\Interfaces\Entity;

/**
 * Exemplo simples de um Model de usuário
 * @email msfidelis01@gmail.com
 * @author Matheus Fidelis
 */
class UserModel extends Model {

  /**
   * Tabela da entidade
   * @var type
   */
  private $table = "users";

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
   * Encontra um registro pelo ID
   * @param [type] $id
   * @return void
   */
  public function findrow($id) {
    $query = ($this->newQuery())
        ->select(['id', 'user', 'token', 'pass'])
        ->from($this->table)
        ->where("id = '$id'");
    $row = $this->execute($query);

    if ($row) {
        return $this->execute($query)[0];
    } else {
        return false;
    }
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

  public function save(Entity $user) {
    $newUser = $this->DBPersist($this->table, $user);

    if ($newUser) {
        return $this->findrow($newUser);
    }
  }

}
