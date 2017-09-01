<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Question extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'question_id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'quiz_id' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'question_text' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'answer_a' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'answer_b' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'answer_c' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'answer_d' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'right_choice' => array(
                                'type' => 'INT',
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('question_id', TRUE);
                $this->dbforge->create_table('question');
        }

        public function down()
        {
                $this->dbforge->drop_table('question');
        }
}