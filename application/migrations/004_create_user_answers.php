<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_User_Answers extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'answer_id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'quiz_id' => array(
                                'type' => 'INT',
                                'null' => TRUE,
                        ),
                        'question_id' => array(
                                'type' => 'INT',
                                'null' => TRUE,
                        ),
                        'user_answer' => array(
                                'type' => 'INT',
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('answer_id', TRUE);
                $this->dbforge->create_table('answer');
        }

        public function down()
        {
                $this->dbforge->drop_table('answer');
        }
}