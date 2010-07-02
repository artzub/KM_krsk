<?php
include ('./include/header.dat');
include ('./include/menu.dat');
GetMenu();
if($_GET['outsite']==""){$_GET['outsite']=$_SERVER['HTTP_HOST'];}
?> 
    <div id="content">    
        
        <div class="blockdata">
            <div class="titlecontainer">
                <div class="title">Редирект....</div>
            </div>
            <div class="data">
                Вы собираетесь покинуть сайт <b><?php echo $_SERVER['HTTP_HOST']?></b> и перейти по адресу <b>http://<?php echo $_GET["outsite"]?></b>.
                <br />
                <br /><b>Вы подтверждаете переход по внешней ссылке?</b>
                <br /><a class="m" href="http://<?php echo $_GET["outsite"] ?>">Да, перейти по указанному адресу</a>                
            </div>            
        </div>
        <a class="goback" href="<?php echo $_SERVER['HTTP_REFERER']?>">◀ Вернуться назад</a>
<?php
include ('./include/footer.dat');
?>