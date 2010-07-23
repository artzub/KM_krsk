<?
#
#   MySQL wrapper
#
#   copyright xternalx, 2008 - 2010
#

class MySQL
{
    var $version = "0.8";
    var $logText="";
    var $sql;
    var $sqlresult;
    var $isError = false;
    var $debugBacktrace;
    public $AffectedRows;
    var $sqlError;
    var $queryCount=0;

    private $host;
    private $user;
    private $pwd;
    private $db;
    private $encoding;

    private $errorHandler = null;

    function __construct($errorHandler = null)
    {
        $this->LogMessage("My SQL Helper created at: ".date('d.m.Y - H:i:s'));
        if($errorHandler)
        {
            $this->errorHandler = $errorHandler;
            $this->LogMessage("Error handler is set");
        }
    }

    function __clone()
    {
        $this->isError = false;
        $this->logText = "";
    }

    function LogMessage($message)
    {
        $this->logText.=$message."<br>\n";
    }

    function ShowLog()
    {
        return $this->logText;
    }

    function UDie($message)
    {
        echo '<pre>';
        $this->debugBacktrace = debug_backtrace();
        $this->LogMessage("<font color=\"red\">$message</font><br><pre>".$this->debugBacktrace."</pre><br>");
        $this->isError = true;
        die($this->ShowLog()."<br></pre>");
    }

    function Connect($host,$user,$pwd,$db)
    {
        $this->host = $host;
        $this->user = $user;
        $this->pwd  = $pwd;
        $this->db   = $db;
        $this->isError = false;
        $this->LogMessage('Connecting to '.$host.'...');
        $this->sql = @mysql_connect($host,$user,$pwd);
        if(!$this->sql)
        {
        	$this->isError = true;
        	$this->LogMessage("cannot connect to database server<br>".@mysql_error($this->sql));
        	return false;
        	exit;
        }
        if(!mysql_select_db($db))
        {
       		$this->isError = true;
        	$this->LogMessage("cannot select DB<br>".@mysql_error($this->sql));
        	return false;
        	exit;
        }
        $this->LogMessage('Connected!');
        #   If Connection Success
        return true;
    }

    public function GetInstance()
    {
        $s = clone $this;
        return $s;
    }

        /**
        * @method  array   Выполнить очистку массива значений от неправильных значений.
        *                  Неправильными считаются значения, полей с названиями которых нет в БД
        * @param   string  $tablename  Таблица, на основании которой будет производиться очистка
        * @param   array   $data - ассоциативный массив вида <ключ> = <значение>, где <ключ> равен названию поля в таблице.
        */
	function CleanData($tablename, $data)
	{
	    global $sql, $db_tables;
	    $columns = array();
	    // получаем список полей из запрошенной таблицы
	    $sql->Query("SHOW COLUMNS FROM `".mysql_real_escape_string($tablename)."`");
	    while($record = $sql->Assoc('Field'))
	    {
	        $columns[] = $record;
	    }
	    // "кэшируем" :D
	    if(count($this->tables_fields[$tablename]) != count($columns))
	    {
	        $this->tables_fields[$tablename] = $columns;
	    }

	    // Самое веселое: Пробегаем по каждому элементу из переданного массива,
	    // и если название этого элемента не существует в таблице
	    // угандошиваем его нахуй блять суку такую!!!
	    $counter = 0;
	    foreach($data as $k => $v)
	    {
	        $match = false;
	        for($i = count($this->tables_fields[$tablename]); $i>=0; $i--)
	        {
	            if($this->tables_fields[$tablename][$i] == $k)
	            {
	                // если совпадение найдено, продолжаем дальше - этот элемент правильный
	                $match = true;
	                break;
	            }
	        }
	        if(!$match)
	        {
	            // а этот неправильный
	            $this->LogMessage('incorrect key '.$k."<br />");
	            unset($data[$k]);
	        }
	        $counter++;
	    }
	    // Отдаем очищенный массив значений
	    return $data;
	}

    function Query($query,$args = null)
    {
        $this->isError = false;
        if($args)
        {
            #   делаем копию запроса
            $tmpquery = $query;
            #   оригинал обнуляем - его мы будем формировать в цикле уже
            $query = '';
            #   счетчик элемента массива, которым заменяется каждый следующий спецсимвол
            $cargs = (gettype($args) == "array") ? 0 : 1;

            for($i=0; $i<strlen($tmpquery); $i++)
            {
                if($tmpquery[$i] != "?")
                {
                    $query .= $tmpquery[$i];
                }
                else
                {
                    $query .= "'".mysql_real_escape_string((gettype($args) == "array") ? $args[$cargs]: func_get_arg($cargs))."'";
                    $cargs++;
                }
            }
            unset($tmpquery);
        }
        $this->LogMessage('Query: '.$query);
        if(!($this->sqlresult = @mysql_query($query,$this->sql)))
        {
        	$this->isError = true;
        	$this->LogMessage("cant send query to server<br>".@mysql_error($this->sql));
        	return false;
        	exit;
        }
        if(stripos($query,'select')>-1)
        {
            $this->LogMessage('... '.@mysql_num_rows($this->sqlresult).' rows in query');
        }
        if(stripos($query,'update')>-1 || stripos($query,'insert')>-1 || stripos($query,'delete')>-1 || stripos($query,'replace')>-1)
        {
        	$this->AffectedRows = @mysql_affected_rows($this->sql);
            $this->LogMessage('... '.$this->AffectedRows.' rows affected by query');
        }
        $this->queryCount++;
        return true;
    }

    function Execute($query, $args = null)
    {
    	$this->Query($query,$args);
    	return $this;
    }

    function Insert($tablename, $values_table)
    {
        $values_table = $this->CleanData($tablename, $values_table);
    	$tmp = "INSERT INTO `".$tablename."` ";
    	$keys="(";
    	$values = " VALUES(";
    	$fields_count = count($values_table);
    	$i = 1;
    	foreach($values_table as $k=>$v)
    	{
    		$keys .= "`".mysql_real_escape_string($k).(($fields_count> $i) ? "`,": "`)");
    		$values .= "'".mysql_real_escape_string($v).(($fields_count> $i) ? "',": "')");
    		$i++;
    	}
    	$this->LogMessage("Inserting to table `".$tablename."`");
    	return $this->Execute($tmp.$keys.$values);
    }

    function GetError()
    {
    	return @mysql_error($this->sql);
    }

    function GetErrorCode()
    {
    	return @mysql_errno($this->sql);
    }

    function GetRowsCount()
    {
        return @mysql_num_rows($this->sqlresult);
    }

    function GetLastId()
    {
    	return $this->Execute("SELECT LAST_INSERT_ID() as `last_id`")->Assoc('last_id');
    }


#*************************
    function GetResultAssoc()
    {
        return @mysql_fetch_assoc($this->sqlresult);
    }

    function Assoc($field = null)
    {
    	if($field == null)
    		return $this->GetResultAssoc();
    	else
    	{
    		$data = $this->GetResultAssoc();
    		return $data[$field];
    	}
    }

#*************************
    function GetResultArray()
    {
    	return @mysql_fetch_array($this->sqlresult);
    }

    function Arr()
    {
    	return $this->GetResultArray();
    }

#*************************
    function GetResultRow()
    {
    	return @mysql_fetch_row($this->sqlresult);
    }

    function Row()
    {
    	return $this->GetResultRow();
    }

#*************************
    function GetResultObject()
    {
        return @mysql_fetch_object($this->sqlresult);
    }

    function Obj()
    {
    	return $this->GetResultObject();
    }

#*************************
    function SetEncoding($enc)
    {
        $this->Query("set names ".$enc);
    }

    function Encoding($enc)
    {
        $this->encoding = $enc;
    	$this->SetEncoding($enc);
    }

    function Close()
    {
    	$this->LogMessage("Closing session.");
        mysql_close($this->sql);
    }

}

?>