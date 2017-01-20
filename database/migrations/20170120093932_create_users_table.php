<?php

use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    /**
     * Migrate Up
     */
    public function up()
    {
        $table = $this->table('users');
        $table->addColumn('username', 'string', array('limit' => 20))
              ->addColumn('email', 'string', array('limit' => 100))
              ->addColumn('password', 'string', array('limit' => 40))
              ->addColumn('first_name', 'string', array('limit' => 30))
              ->addColumn('last_name', 'string', array('limit' => 30))
              ->addColumn('created_at', 'datetime')
              ->addColumn('updated_at', 'datetime', array('null' => true))
              ->addIndex(array('username', 'email'), array('unique' => true))
              ->save();
    }

    /**
     * Migrate Down
     */
    public function down()
    {
        $this->dropTable('users');
    }
}
