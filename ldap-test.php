<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
       <title>PHP ACTIVE DIRECTORY SEARCH</title>
       <script type="text/javascript" src="js/jquery.js"></script>
       <script type="text/javascript" src="js/effects.core.js"></script>
       <script type="text/javascript" src="js/effects.highlight.js"></script>
       <script type="text/javascript" src="js/botr.embedcode.js"></script>
       <style type="text/css">
        body {
            width: 780px;
            margin:10px auto 0 auto;
            padding: 0;
            color: BLACK;
            background-color: #d9e5f2;
            font: 12px/16px Arial, sans-serif;
            font-size: 16px;
            font-style: bold;
        }
        
        small {
            color: #333;
            font-style: italic;
            font-size: 12px;
        }
        fieldset {
            background-color: grey;
            padding: 8px 0 8px 10px;
            border:0;
            margin-bottom: 1px;
        }
        input, select, button {
            margin: 5px 0;
            display: block;
            float: left;
            width: 480px;
            border: 2px solid #CCC;
            padding: 3px 0px;
        }
        label {
            line-height: 32px;
            display: block;
            float: left;
            clear: left;
            width: 180px;
        }
        #button, fieldset small { 
            display: block;
            clear: both;
            margin-left: 180px;
            background-color: black;
            color:white;
            font-style:bold;
            width: 240px;
        }

        #buttonValue{
            display: block;
            background-color: black;
            color:white;
            font-style:bold;
            width:240px;
            
        }

        h1{color:black;}
        h3, h5{color: red;text-align: center;}
    </style>
    </head>
    <body> 
        <h1>WELCOME TO PHP ACTIVE DIRECTORY SEARCH</h1>
        <h3>STEP 1: Please login with your Ciena's Credential.</h3>
        <form method="post">
            <fieldset>
                <label>Username:</label> <input id="username" type="text" name="username" required /> 
                <label>Password:</label> <input id="password" type="password" name="password" required />  
                <label>Search User By Email:</label> <input id="searchUser" type="text" name="searchUser" required />
                <input id="button" type="submit" name="reset" value="LOGIN" />
                <input id="buttonValue" type="reset" value="CLEAR">
            </fieldset>
        </form>
        <?php
            session_start();
            if(isset($_POST['username']) && isset($_POST['password'])){
                $_SESSION['username'] = $_POST['username'];                

                $username = $_POST['username'];
                $password = $_POST['password'];
                $ldaprdn = 'ciena' . "\\" . $username;
                $adServer = "vawdc01.ciena.com";
                $ldap = ldap_connect($adServer);
                ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
                ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);


                $searchUser = $_POST['searchUser'];
                echo 'Searching for: ' .$searchUser;
                $searchUser = substr($searchUser,0,strrpos($searchUser,'@'));
                


                $bind = @ldap_bind($ldap, $ldaprdn, $password);
                $filter="(sAMAccountName=$searchUser)";
                $result = ldap_search($ldap,"dc=CIENA,dc=COM",$filter);
                ldap_sort($ldap,$result,"sn");
                $info = ldap_get_entries($ldap, $result);
                for ($i=0; $i<$info["count"]; $i++)
                {
                    if($info['count'] > 1)
                        break;
                    echo "<p>You are accessing <strong> ". $info[$i]["sn"][0] .", " . $info[$i]["givenname"][0] ."</strong><br /> (" . $info[$i]["samaccountname"][0] .")</p>\n";
                    echo '<pre>';
                    var_dump($info);
                    echo '</pre>';
                    $userDn = $info[$i]["distinguishedname"][0]; 
                }
                @ldap_close($ldap);              
            } 
        ?>  
    </body>
</html>



