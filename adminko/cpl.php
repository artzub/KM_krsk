<?
    @session_start();
    header('Content-Type: text/html; charset=utf-8');
    include '../conf.php';
    
    if(@!ses('enabled'))
    {
        die('e_session_not_allowed');
    }
    
    $sql = new MySQL();
    $sql->connect($cfg['db_host'],$cfg['db_user'],$cfg['db_password'],$cfg['db_db']);

    if($sql->isError) 
    {
        RaiseError('e_db_is_not_connected');
        exit;
    }
    $sql->SetEncoding("utf8");
    
?>
<html>
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
    <script src="js/xternalx.js" type="text/javascript"></script>
</head>
<body>
<div><a href="?module=lines">Ленты</a></div>
<?

$req = FilterInput('/[^A-Za-z0-9]/',$_GET);
//print_r($req);

if(isset($req['module']))
{
    if(file_exists($req['module'].".php"))
    {
        require_once $req['module'].".php";
    }
    else
    {
        header("Location: ".$_SERVER['PHP_SELF']);
    }
}
else
{
    echo "Выберите пункт меню";
}
?>  
</body>
</html>
