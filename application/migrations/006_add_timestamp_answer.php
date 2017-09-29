<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_timestamp_answer extends CI_Migration {

        public function up()
        {
                $fields = array(
                        'timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
                        );
                        $this->dbforge->add_column('answer', $fields);
        }

        public function down()
        {

        }
}