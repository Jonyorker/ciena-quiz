<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_background_image extends CI_Migration {

        public function up()
        {
                $fields = array(
                        'background_img' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                                )
                        );
                        $this->dbforge->add_column('quiz', $fields);
        }

        public function down()
        {

        }
}