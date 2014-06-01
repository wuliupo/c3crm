<?php
/**
 * SAE Mysql����
 * 
 * ֧�����ӷ���
 *
 * @author Easychen <easychen@gmail.com>
 * @version $Id$
 * @package sae
 *
 */
/**
 * Sae Mysql Class
 *
 * 
 * <?php
 * $mysql = new SaeMysql();
 *
 * $sql = "SELECT * FROM `user` LIMIT 10";
 * $data = $mysql->getData( $sql );
 * $name = strip_tags( $_REQUEST['name'] );
 * $age = intval( $_REQUEST['age'] );
 * $sql = "INSERT  INTO `user` ( `name` , `age` , `regtime` ) VALUES ( '"  . $mysql->escape( $name ) . "' , '" . intval( $age ) . "' , NOW() ) ";
 * $mysql->runSql( $sql );
 * if( $mysql->errno() != 0 )
 * {
 *     die( "Error:" . $mysql->errmsg() );
 * }
 * 
 * $mysql->closeDb();
 * @package sae
 * @author EasyChen
 * 
 */ 
class SaeMysql 
{
    /**
     * ���캯�� 
     *    
     * @param bool $do_replication �Ƿ�֧�����ӷ��룬true:֧�֣�false:��֧�֣�Ĭ��Ϊtrue 
     * @return void
     * @author EasyChen
     */
    function __construct( $do_replication = true )
    {
        //set default charset as utf8
        $this->charset = 'UTF8';
        $this->do_replication = $do_replication;
    }
    /**
     * ���õ�ǰ���ӵ��ַ��� , �����ڷ�������֮ǰ��������
     *
     * @param string $charset �ַ���,��GBK,GB2312,UTF8
     * @return void
     */
    public function setCharset( $charset )
    {
        return $this->set_charset( $charset );
    }
    /**
     * ͬsetCharset,��ǰ����
     *
     * @param string $charset 
     * @return void
     * @ignore
     */
    public function set_charset( $charset )
    {
        $this->charset = $charset;
    }
    /**
     * ����Sql���,�����ؽ����
     *
     * @param string $sql 
     * @return mysqli_result|bool
     */
    public function runSql( $sql )
    {
        return $this->run_sql( $sql );
    }
    /**
     * ͬrunSql,��ǰ����
     *
     * @param string $sql 
     * @return bool
     * @author EasyChen
     * @ignore
     */
    public function run_sql( $sql )
    {
        $this->last_sql = $sql;
        $dblink = $this->db_write();
        if ($dblink === false) {
            return false;
        }
        $ret = mysqli_query( $dblink, $sql );
        $this->save_error( $dblink );
        return $ret;
    }
    /**
     * ����Sql,�Զ�ά���鷽ʽ���ؽ����
     *
     * @param string $sql 
     * @return array �ɹ��������飬ʧ��ʱ����false
     * @author EasyChen
     */
    public function getData( $sql )
    {
        return $this->get_data( $sql );
    }
    /**
     * ͬgetData,��ǰ����
     *
     * @ignore
     */
    public function get_data( $sql )
    {
        $this->last_sql = $sql;
        $data = Array();
        $i = 0;
        $dblink = $this->do_replication ? $this->db_read() : $this->db_write();
        if ($dblink === false) {
            return false;
        }
        $result = mysqli_query( $dblink , $sql );
        $this->save_error( $dblink );
        if (is_bool($result)) {
            return $result;
        } else {
            while( $Array = mysqli_fetch_array( $result, MYSQL_ASSOC ) )
            {
                $data[$i++] = $Array;
            }
        }
        mysqli_free_result($result); 
        if( count( $data ) > 0 )
            return $data;
        else
            return NULL;    
    }
    /**
     * ����Sql,�����鷽ʽ���ؽ������һ����¼
     *
     * @param string $sql 
     * @return array �ɹ��������飬ʧ��ʱ����false
     * @author EasyChen
     */
    public function getLine( $sql )
    {
        return $this->get_line( $sql );
    }
    /**
     * ͬgetLine,��ǰ����
     *
     * @param string $sql 
     * @return array
     * @author EasyChen
     * @ignore
     */
    public function get_line( $sql )
    {
        $data = $this->get_data( $sql );
        if ($data) {
            return @reset($data);
        } else {
            return false;
        }
    }
    /**
     * ����Sql,���ؽ������һ����¼�ĵ�һ���ֶ�ֵ
     *
     * @param string $sql 
     * @return mixxed �ɹ�ʱ����һ��ֵ��ʧ��ʱ����false
     * @author EasyChen
     */
    public function getVar( $sql )
    {
        return $this->get_var( $sql ); 
    } 
    /**
     * ͬgetVar,��ǰ����
     *
     * @param string $sql 
     * @return array
     * @author EasyChen
     * @ignore
     */
    public function get_var( $sql )
    {
        $data = $this->get_line( $sql );
        if ($data) {
            return $data[ @reset(@array_keys( $data )) ];
        } else {
            return false;
        }
    }
    /**
     * ͬmysqli_affected_rows����
     *
     * @return int �ɹ���������,ʧ��ʱ����-1
     * @author Elmer Zhang
     */
    public function affectedRows()
    {
        $result = mysqli_affected_rows( $this->db_write() );
        return $result;
    }
    /**
     * ͬmysqli_last_id����
     *
     * @return int �ɹ�����last_id,ʧ��ʱ����false
     * @author EasyChen
     */
    public function lastId()
    {
        return $this->last_id();
    }
    /**
     * ͬlastId,��ǰ����
     *
     * @return int
     * @author EasyChen
     * @ignore
     */
    public function last_id()
    {
        $result = mysqli_insert_id( $this->db_write() );
        return $result;
    }
    /**
     * �ر����ݿ�����
     *
     * @return bool
     * @author EasyChen
     */
    public function closeDb()
    {
        return $this->close_db();
    }
    /**
     * ͬcloseDb,��ǰ����
     *
     * @return bool
     * @author EasyChen
     * @ignore
     */
    public function close_db()
    {
        if( isset( $this->db_read ) )
            @mysqli_close( $this->db_read );
        if( isset( $this->db_write ) )
            @mysqli_close( $this->db_write );
    }
    /**
     *  ͬmysqli_real_escape_string
     *
     * @param string $str 
     * @return string
     * @author EasyChen
     */
    public function escape( $str )
    {
        if( isset($this->db_read) ) {
            $db = $this->db_read;
        } elseif( isset($this->db_write) ) {
            $db = $this->db_write;
        } else {
            $db = $this->db_read();
        }
        return mysqli_real_escape_string( $db , $str );
    }
    /**
     * ���ش�����
     * 
     *
     * @return int
     * @author EasyChen
     */
    public function errno()
    {
        return     $this->errno;
    }
    /**
     * ���ش�����Ϣ
     *
     * @return string
     * @author EasyChen
     */
    public function error()
    {
        return $this->error;
    }
    /**
     * ���ش�����Ϣ,error�ı���
     *
     * @return string
     * @author EasyChen
     */
    public function errmsg()
    {
        return $this->error();
    }
    /**
     * @ignore
     */
    private function connect( $is_master = true )
    {
		global $dbconfig;
        if( $is_master ) {
			$host = $dbconfig['db_server'];
		}
        else {
			$host = $dbconfig['db_server'];
		}
        $db = mysqli_init();
        mysqli_options($db, MYSQLI_OPT_CONNECT_TIMEOUT, 5);
		$port = substr($dbconfig['db_port'],1);
        if( !mysqli_real_connect( $db, $host , $dbconfig['db_username'] , $dbconfig['db_password'] , $dbconfig['db_name'] , $port ) )
        {
            $this->error = mysqli_connect_error();
            $this->errno = mysqli_connect_errno();
            return false;
        }
        mysqli_set_charset( $db, $this->charset);
        return $db;
    }
    /**
     * @ignore
     */
    private function db_read()
    {
        if( isset( $this->db_read ) )
        {
            return $this->db_read;
        }
        else
        {
            if( !$this->do_replication ) return $this->db_write();
            else
            {
                $this->db_read = $this->connect( false );
                return $this->db_read;
            }
        }
    }
    /**
     * @ignore
     */
    private function db_write()
    {
        if( isset( $this->db_write ) )
        {
            return $this->db_write;
        }
        else
        {
            $this->db_write = $this->connect( true );
            return $this->db_write;
        }
    }
    /**
     * @ignore
     */
    private function save_error($dblink)
    {
        $this->error = mysqli_error($dblink);
        $this->errno = mysqli_errno($dblink);
    }
    private $error;
    private $errno;
    private $last_sql;
}
?>