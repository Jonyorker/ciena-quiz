<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Anonymous_Quiz extends CI_Migration {

        public function up()
        {
            $fields = array(
        		'anonymous' => array(
        			'type' => 'BOOLEAN',
        			'null' => TRUE,
        			)
			);
			$this->dbforge->add_column('quiz', $fields);
        }

        public function down()
        {
                $this->dbforge->drop_table('answer');
        }
}