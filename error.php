<?php
include ('./include/header.dat');
include ('./include/menu.dat');
GetMenu();
?>
    <div id="content">
        <div class="blockdata">
            <div class="titlecontainer">        
                <div class="title">ОШИБКА</div>
            </div>
            <div class="data">
                <br /><b>ВНИМАНИЕ, ОШИБКА!</b>
                <br />
                <br />Если вы видите эту страницу, то это значит что вы наткнулись на "битую" ссылку, либо обратились к файлу, доступ к которому запрещен администратором сайта.
                <br />
                <br /><a class="goback" href="<?php echo $_SERVER['HTTP_REFERER']?>" title="Назад">◀ Вернитесь назад</a>
            </div>
        </div>        
<?php
include ('./include/footer.dat');
?>