<?

/**
 * @return	string $text
 * @param	string $data
 */
function asciiToHtml($data)
{
	$data = htmlspecialchars($data);			// html entities is now not valid!
	$data = str_replace("\n","<br />", $data);	// allowing text formatting
	
	$data = preg_replace("/(ftp:\/\/|http:\/\/|(www\.))(([^\s<]{4,68})[^\s<]*)/", '<a href="$1$2$3" rel="nofollow" target="blank_">$1$2$4</a>', $data);
	//$data = preg_replace("/(ftp:\/\/|http:\/\/|(www\.))(([^\s<]{4,68})[^\s<]*)(\.jpg|\.jpeg|\.gif|\.png)/", '<img src="$1$2$4$5" />', $data);
	return $data;
}

function getMicrotime()
{
    $mt = microtime();
    $mt = substr($mt,strpos($mt,".")+1,strpos($mt," ")-2);
    return $mt;
}

function boolToStr($b,$mode=0)
{
	if($mode == 0)
	{
		if($b) return 'Yes';
		else return 'No';
	}
	else if($mode == 1)
	{
		if($b) return True;
		else return False;
	}
	else if($mode == 2)
	{
		if($b) return '1';
		else return '0';
	}
	
}

function strToBool($s)
{
	if(empty($s) || !isset($s))
	{
		return 0;
		exit;
	}
	switch(strtolower($s))
	{
		case 'yes':
		case 'on':
		case 'checked':
		case 'enabled':
		case 'visible':
		case 'true':
		case '1': {return 1; break;}
		
		default: {return 0; break;}
	}
}

function guid($withmtime)
{
    $chars = md5(uniqid(mt_rand(), true));
    $uuid  = substr($chars,0,8) . '-';
    $uuid .= substr($chars,8,4) . '-';
    $uuid .= substr($chars,12,4) . '-';
    $uuid .= substr($chars,16,4) . '-';
    $uuid .= substr($chars,20,12);
    if($withmtime)
        return $uuid.getMicrotime();
    else
        return $uuid;
}

#	quick access to global arrays
function req($key)
{
	return $_REQUEST[$key];
}

function get($key)
{
	return $_GET[$key];
}

function post($key)
{
	return $_POST[$key];
}

function serv($key)
{
	return $_SERVER[$key];
}

function ses($key)
{
	return $_SESSION[$key];
}

function br()
{
    return "<br />";
}

function LoadClass($className)
{
    if(file_exists("classes/class.".strtolower($className).".php"))
    {
        require_once "classes/class.".strtolower($className).".php";
        return true;
    }
    else if(file_exists("../classes/class.".strtolower($className).".php"))
    {
        require_once "../classes/class.".strtolower($className).".php";
        return true;
    }
    else
    {
        return false;
    }
}

function AddPrefix($arr, $pfx)
{
    $new_a = array();
    foreach($arr as $k=> $v)
    {
        $new_a[$pfx.$k] = $v;
    }
    return $new_a;
}

function AddPostfix($arr, $pfx)
{
    $new_a = array();
    foreach($arr as $k=> $v)
    {
        $new_a[$k.$pfx] = $v;
    }
    return $new_a;
}

function StringClone($str, $times)
{
    $tmp = "";
    for($i=0;$i<$times;$i++)
    {
        $tmp.= $str;
    }
    return $tmp;
}

function FilterInput($pattern, $data)
{
    if(is_array($data))
    {
        $a = array();
        foreach($data as $k => $v)
        {
            $a[preg_replace($pattern,"",$k)] = preg_replace($pattern,"",$v);    
        }
        return $a;
    }
    else
    {
    preg_replace($pattern,"",$data);
    }
}

?>
