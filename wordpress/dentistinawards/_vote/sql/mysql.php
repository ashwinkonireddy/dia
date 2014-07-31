<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Class mysql
 */
class mysql
{

    const SMART_FORMS_ENTRY = 'wp_rednao_smart_forms_entry';
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pass = "ashwin";
    private $db_name = "wordpress";
    private $con = null;

    /**
     * @return bool
     */
    public function connect()
    {
        if (!$this->con) {
            $myconn = @mysql_connect($this->db_host, $this->db_user, $this->db_pass);
            if ($myconn) {
                $seldb = @mysql_select_db($this->db_name, $myconn);
                if ($seldb) {
                    $this->con = true;
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    /**
     * @return bool
     */
    public function disconnect()
    {
        if($this->con)
        {
            if(@mysql_close())
            {
                $this->con = false;
                return true;
            }
            else
            {
                return false;
            }
        }
    }

    public function getDentist($id)
    {
        $sql = "SELECT data as data FROM ".self::SMART_FORMS_ENTRY." WHERE reference_id = '".$id."' AND form_id = 1";
        $query = @mysql_query($sql);

        if($query)
        {
            if(!mysql_num_rows($query))
            {
                return false;
            }
            $result = mysql_fetch_array($query,MYSQL_ASSOC);
            $result = json_decode($result['data']);
            $result = $result->rnField1->firstName . " ". $result->rnField1->lastName;
        }
        else
        {
            return false;
        }

        return $result;
    }
}
