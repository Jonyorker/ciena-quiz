<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Ldap {

        public function is_localhost() {
          return $_SERVER['HTTP_HOST'] == 'localhost:8888';
        }

        public function get_ldap_rdn($username) {
          if ($this->is_localhost()) {
            return "uid=$username,dc=example,dc=com";
          }

          return 'ciena' . "\\" . $username;
        }

        public function get_ldap_server() {
          if ($this->is_localhost()) {
            return "ldap.forumsys.com";
          }
          else {
            return "onwvdc06.ciena.com";
          }
        }

        public function get_base_dn() {
          if ($this->is_localhost()) {
            return "dc=example,dc=com";
          }

          return "dc=CIENA,dc=COM";
        }

        public function getPasswordKey($username) {
          $password_key = 'm9Ofsqo67brN*Bb_5X(ae234B86z3j0hUG#L6349@V/58(12/Rrtsyr/*6m';
          return $username.$password_key;
        }

        public function ldap_login($username, $password) {  
          $ldap = ldap_connect($this->get_ldap_server());
          ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
          ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

          if ($username && $password && $bind = ldap_bind($ldap, $this->get_ldap_rdn($username), $password)) {
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $username . '@ciena.com';
            $_SESSION['password'] = openssl_encrypt($password, 'aes256', $this->getPasswordKey($username));

            header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

            return true;
          }
          else {
            echo "Invalid username or password";
            
            // added for testing
            echo 'var username : '.$username;
            echo 'var password : '.$password;
            echo 'var bind : '.$bind;
            echo 'var ldap : '.$ldap;
            echo 'var get_ldap_rdn : '.$this->get_ldap_rdn($username);

          }
          
          return false;
        }

        public function ldap_search_user($user_email = null) {
          if ($user_email) {
            $ldap = ldap_connect(get_ldap_server());
            ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

            $username = $_SESSION['username'];
            $password = openssl_decrypt($_SESSION['password'], 'aes256', getPasswordKey($username));

            if ($username && $password && $bind = ldap_bind($ldap, get_ldap_rdn($username), $password)) {
              
              $result = ldap_search($ldap, get_base_dn(),"(mail=$user_email)");
              
              $info = ldap_get_entries($ldap, $result);
              ldap_close($ldap);

              $output = array();

              if ($info['count'] > 0) {
                for ($i = 0; $i < $info['count']; $i++) {
                  $output[$i]['cn'] = $info[$i]['cn'][0];
                  $output[$i]['last_name'] = $info[$i]['sn'][0];
                  $output[$i]['first_name'] = $info[$i]['givenname'][0];
                  $output[$i]['email'] = $info[$i]['mail'][0];
                  $output[$i]['position'] = $info[$i]['title'][0];
                  $output[$i]['location'] = $info[$i]['physicaldeliveryofficename'][0];
                  $output[$i]['functional_group'] = $info[$i]['description'][0];
                  $output[$i]['manager_dn'] = $info[$i]['manager'][0];

                  preg_match('/CN=(\w.*?)\\\\\,\s(\w.*?),/', $info[$i]['manager'][0], $matches);

                  $output[$i]['manager'] = $matches ? $matches[1] . ', ' . $matches[2] : null;
                }
              }

              return $output;
            }
          }

          return null;
        }

        public function ldap_get_email_from_cn($user_cn = null) {
          if ($user_cn) {
            $ldap = ldap_connect(get_ldap_server());
            ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

            $username = $_SESSION['username'];
            $password = openssl_decrypt($_SESSION['password'], 'aes256', getPasswordKey($username));

            if ($username && $password && $bind = ldap_bind($ldap, get_ldap_rdn($username), $password)) {
              
              $result = ldap_search($ldap, get_base_dn(),"(cn=$user_cn)");
              
              $info = ldap_get_entries($ldap, $result);
              ldap_close($ldap);

              return $info[0]['mail'][0];
            }
          }

          return null;
            
        }
      }