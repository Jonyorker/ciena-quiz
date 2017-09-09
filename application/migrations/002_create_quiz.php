<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Quiz extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'quiz_id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'quiz_name' => array(
                                'type' => 'TEXT',
                        ),
                        'anonymous' => array(
                                'type' => 'INT',
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('quiz_id', TRUE);
                $this->dbforge->create_table('quiz');
        }

        public function down()
        {
                $this->dbforge->drop_table('quiz');
        }
}