<?php
include ('./include/header.dat');
include ('./include/menu.dat');
GetMenu("/roads.php");
?>
    <div id="content">
        <div class="blockdata">
            <div class="titlecontainer">        
                <div class="title">Маршрут №1</div>
            </div>
            <div class="data">
                <img src="./roads/road_01.jpg" title="Маршрут №1: БКЗ-Мира-МузКомедия-Мира-БКЗ" alt="Маршрут №1"/><br />
                <b>БКЗ-Мира-МузКомедия-Мира-БКЗ</b><br />        
            </div>
        </div>
        <a class="goback" href="<?php echo $_SERVER['HTTP_REFERER']?>" title="Назад">◀ Назад</a>
<?php
include ('./include/footer.dat');
?>