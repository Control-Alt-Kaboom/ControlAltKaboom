<?php
# ----------------------------------------------------------------------------------------
# EDUGUIDEPRO- DataBase Abstraction
# FILE: environment/classes/database/mkDB.class.php
# VERS: 1.0
# DESC: Basic DB Abstraction Libray
# ----------------------------------------------------------------------------------------

class mkDB {

public static $init = false;
public static $con = false;
public  static $dbuser, $dbpass, $dbhost, $dbname, $errlvl, $lastsql;
public static $queryLog;
public static $queryCache;
# ----------------------------------------------------------------------------------------
# -=- METHOD: initialize
# ----------------------------------------------------------------------------------------
public static function initialize($force = false)    {
    if(self::$init == true && $force ==false) return true;
    self::$init     = true;
    self::$errlvl   = 1;

    self::$dbuser   = constant("DB_USER");
    self::$dbpass   = constant("DB_PASS");
    self::$dbhost   = constant("DB_HOST");
    self::$dbname   = constant("DB_NAME");


    self::connect();
} #END method.initialize


# ----------------------------------------------------------------------------------------
# -=- METHOD: connect
# ----------------------------------------------------------------------------------------
private static function connect($dbname=false) {


//    control::dump(mysqli_connect_errno());
//    
//
//    if(!self::$con || mysqli_connect_errno()):
//        self::$con = mysqli_connect(self::$dbhost, self::$dbuser, self::$dbpass, self::$dbname);
//        //control::dump(self::$con);
//    endif;        
    //self::$con = false;
    if(self::$con == false):
        self::$con = mysqli_connect(self::$dbhost, self::$dbuser, self::$dbpass, self::$dbname);
    endif;
//    print "Connection:<br/>";
//    control::dump(mysqli_connect_error());    
//if (!self::$con || mysqli_connect_errno()):
//    control::dump("Connect failed: %s\n", mysqli_connect_error());
//    exit();
//endif;
        
//    self::dump(mysqli_connect(self::$dbhost, self::$dbuser, self::$dbpass));
//    if(!self::$con) self::$con = mysqli_connect(self::$dbhost, self::$dbuser, self::$dbpass);
//    self::$con = mysqli_connect(self::$dbhost, self::$dbuser, self::$dbpass);
//    if (!self::$con):
        
    if (!self::$con || mysqli_errno() > 0):
        self::dump(mysqli_error());
        self::dump(mysqli_errno(self::$con));
        self::dump(mysqli_error(self::$con));
        self::dump($con);
        die(self::dump(self::get_error()));
        return false;//$this->get_error();
    else:        
        //self::$con = $con;
        //control::dump(self::$con);
        //return self::select_db(self::$dbname);
    endif;    
} # END method.connect

# ----------------------------------------------------------------------------------------
# -=- METHOD: select_db
# ----------------------------------------------------------------------------------------
private static function select_db( $db_name = false ) {
    self::$dbname = ($db_name != false) ? $db_name : self::$dbname;
    $status = mysqli_select_db(self::$con, $db_name );
    return (!$status) ? self::get_error() : array('code' => 1, 'value' => true);
} #END method.select_db



# ----------------------------------------------------------------------------------------
# -=- METHOD: get_error
# ----------------------------------------------------------------------------------------
private static function get_error( $message = false )   {
    if ( !is_resource(self::$con) ):
        $err_num = 0; 
        $err_msg = "Could not establish database connection";
    elseif ( $message != false ):
        $err_num = 0; 
        $err_msg = $message;
    else:
        $err_num = mysqli_errno(self::$con); 
        $err_msg = mysqli_error(self::$con);
    endif;
    $error = "MYSQL: {$err_msg} (errcode:{$err_num})";
    if ( self::$errlvl == 1 ):
        $return['code']     = 0;
        $return['error']    = $error;
        $return['value']    = false;
        return $return;
    else:
        die("{$error}");
        exit;
    endif;
} #END method.get_error

# ----------------------------------------------------------------------------------------
# -=- METHOD: numrows
# ----------------------------------------------------------------------------------------
private static function numrows( $res = false ) {
    self::initialize();
    if ( $res != '' && $res != false):
        $numrows = mysqli_num_rows( $res );
        if ($numrows != ''):
            $return['code']     = 1;
            $return['value']    = $numrows;
            $return['sql']      = self::$lastsql;
            return $return;
        endif;
    endif;
    return self::get_error();  
} #END method.numrows

public static function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}


# ----------------------------------------------------------------------------------------
# -=- METHOD: query
# ----------------------------------------------------------------------------------------
public static function query( $sql = false , $options=false, $nocache=false) {
    self::initialize();
    if ( $sql == false ) return self::get_error( "No Query to exec" );

    //self::$queryCache = false;
    // Check if the cache exists for this file
    $nocache=true;
//    if( isset(self::$queryCache[$sql])  && ($nocache !== true || $options == "insert_id")): 
//        return self::$queryCache[$sql];
//    endif;
    $logSize = count(self::$queryLog);
    self::$queryLog[$logSize] = array(self::microtime_float(),$sql, '');
    $result = mysqli_query( self::$con, $sql );
    self::$queryLog[$logSize][2] = self::microtime_float();
    self::$queryLog[$logSize][3] = self::$queryLog[$logSize][2]-self::$queryLog[$logSize][0];
    
    if ( $result != '' ):
        if($options == "insert_id") $return['insert_id'] = mysqli_insert_id(self::$con);
        $return['code']     = 1;
        $return['value']    = $result;
        //$return['error'] = mysqli_error();
        //$numrows            = self::numrows($result);
        $return['numrows']  = $result->num_rows;//$numrows['value'];

    else:
        $return = self::get_error();
    endif;
    self::$lastsql      = $sql;
    self::$queryCache[$sql] = $return;
    $return['sql']      = self::$lastsql;
    return $return;
        
} #END method.query

# ----------------------------------------------------------------------------------------
# -=- METHOD: executeOne
# ----------------------------------------------------------------------------------------
public static function executeOne( $sql = false , $options=false, $nocache=false) {
    self::initialize();
    if ( $sql == false ) return self::get_error( "No Query to exec" );

    $res = self::query($sql);
    if($res['code'] == 1 && $res['numrows'] >= 1):
      $row = self::fassoc($res['value']);
      return $row['value'];
    endif;
    return false;
}



# ----------------------------------------------------------------------------------------
# -=- METHOD: fassoc
# ----------------------------------------------------------------------------------------
public static function fassoc( $res = false ) {
    self::initialize();
    if ( $res != '' && $res != false ):
        $row = mysqli_fetch_assoc( $res );  
        //control::dump($row);
        if ($row != ''):
            $return['code']     = 1;
            $return['value']    = $row;
            $return['sql']      = self::$lastsql;
            return $return;
        else:
            return false;
        endif;
    endif;
    return self::get_error();  
} #END method.fassoc



public static function fassoc_string( $res = false )   {

    self::initialize();
    if ( $res != '' && $res != false ):
        $row = mysqli_fetch_row( $res );  
        $numrows_res = self::numrows($res);
        $numrows = $numrows_res['value'];
        if($numrows >= 1):
            $rowdata = array();
            do {
               $rowdata[] = $row[0];
            }  while($row = mysqli_fetch_row( $res ));

                   
            $return['code']     = 1;
            $return['value']    = implode(',',$rowdata);
            $return['numrows']  = $numrows;
            $return['sql']      = self::$lastsql;
            
            return $return;
        else:
            $return['code']     = 1;
            $return['numrows']  = 0;
            $return['value']    = false;
            $return['sql']      = self::$lastsql;
            return $return;
        endif;
    else:
        return false;                                    
                                    
    endif;
    return self::get_error();  
    

        
}

# ----------------------------------------------------------------------------------------
# -=- METHOD: frow
# ----------------------------------------------------------------------------------------
public static function frow( $res = false ) {
    self::initialize();
    if ( $res != '' && $res != false ):
        $row = mysql_fetch_row( $res );  
        if ($row != ''):
            $return['code']     = 1;
            $return['value']    = $row;
            $return['sql']      = self::$lastsql;
            return $return;
        else:
            return false;
        endif;
    endif;
    return self::get_error();  
} #END method.frow


# ----------------------------------------------------------------------------------------
# -=- METHOD: executeOne
# ----------------------------------------------------------------------------------------
public static function executeSingle( $sql = false) {
    self::initialize();
    $res = self::query($sql);
    if($res['code'] == 1 && $res['numrows'] >= 1):
        $row = self::frow($res['value']);
        return $row['value'][0];
    else:
        print "in es";
        return false;
    endif;

} #END method.executeOne



# ----------------------------------------------------------------------------------------
# -=- METHOD: executeString
# ----------------------------------------------------------------------------------------
public static function executeString( $sql = false, $escapeResult=true) {
    self::initialize();
    $res = self::query($sql);
    if($res['code'] == 1 && $res['numrows'] >= 1):
        $row = self::frow($res['value']);
        do  {
            $ret[] = ($escapeResult == true) ? "\"{$row['value'][0]}\"" : $row['value'][0];            
        }   while($row = self::frow($res['value']));

        return implode(",",$ret);
    else:
        return false;
    endif;

} #END method.executeString


# ----------------------------------------------------------------------------------------
# -=- METHOD: executeAll
# ----------------------------------------------------------------------------------------
public static function executeAll( $sql = false ) {
    self::initialize();
    $res = self::query($sql);
    if($res['code'] == 1 && $res['numrows'] >= 1):
        $row = self::fassoc($res['value']);
        do  {
            $ret[] = $row['value'];            
        }   while($row = self::fassoc($res['value']));
        return $ret;
    else:
        return false;
    endif;

} #END method.executeAll


# ----------------------------------------------------------------------------------------
# -=- METHOD: getKey
# ----------------------------------------------------------------------------------------
public static function getKey($table) {
  
  self::initialize();
  $sql = "SHOW KEYS FROM {$table} WHERE Key_name = 'PRIMARY'";
  $row = self::executeOne($sql);
  return $row['Column_name'];
  
}  


# ----------------------------------------------------------------------------------------
# Helpers
# ----------------------------------------------------------------------------------------
public static function dump( $d ) {print "<pre>" .print_r($d,true) . "</pre>";} 




} #END class.DB

?>
