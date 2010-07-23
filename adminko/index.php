<?
    @session_start();

    if(!isset($_POST['login']) || !isset($_POST['pwd']))
    {
?>
<html>
<body>
<form action="index.php" method="post">
<input type="hidden" name="hook" value="<?=time()?>" />
<input type="text" name="login" id="login" />
<input type="text" name="pwd" id="pwd" />
<input type="submit" />
</form>
</body>
</html>
<?
    }
    else
    {
        include "../conf.php";
        $sql = new MySQL();
        $sql->connect($cfg['db_host'],$cfg['db_user'],$cfg['db_password'],$cfg['db_db']);

        if($sql->isError) 
        {
	        RaiseError('e_db_is_not_connected');
	        exit;
        }
        $sql->SetEncoding("utf8");
        $sql->Query("SELECT * FROM `k_managers` WHERE `m_login`=? AND `m_password`=PASSWORD(?)", array($_POST['login'], $_POST['pwd']));
        if($sql->GetRowsCount()<=0)
        {
            header('Location: '.$_SERVER['PHP_SELF']);
            exit;
        }
        $_SESSION = $sql->Assoc();
        $_SESSION['enabled'] = true;
        unset($_SESSION['m_password']);
        header('Location: cpl.php');
    }
?>
