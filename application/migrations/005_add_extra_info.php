<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_extra_info extends CI_Migration {

        public function up()
        {
                $fields = array(
                        'extra_info' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                                )
                        );
                        $this->dbforge->add_column('question', $fields);
        }

        public function down()
        {

        }
}