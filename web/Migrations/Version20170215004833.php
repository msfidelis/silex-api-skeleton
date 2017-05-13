<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
* Auto-generated Migration: Please modify to your needs!
*/
class Version20170215004833 extends AbstractMigration {
  /**
  * @param Schema $schema
  */
  public function up(Schema $schema) {
    $siteTable = $schema->createTable('company');
    $siteTable->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement'=>true]);
    $siteTable->addColumn('name', 'string', ['length' => 50]);
    $siteTable->addColumn('age', 'integer', ['length' => 11]);
    $siteTable->addColumn('salary', 'float', ['length' => 11, 'scale' => 2, 'default' => 0.00]);
    $siteTable->setPrimaryKey(['id']);
  }

  /**
  * @param Schema $schema
  */
  public function down(Schema $schema) {
    $schema->dropTable('company');
  }
}
