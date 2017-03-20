<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170319193757 extends AbstractMigration {
    
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) {
        $usersTable = $schema->createTable('users');
        $usersTable->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement'=>true]);
        $usersTable->addColumn('user', 'string', ['length' => 50]);
        $usersTable->addColumn('pass', 'string', ['length' => 50]);
        $usersTable->addColumn('token', 'string', ['length' => 100]);
        $usersTable->setPrimaryKey(['id']);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema){
        $schema->dropTable('users');

    }
}
