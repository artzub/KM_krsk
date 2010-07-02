<?php
include ('./include/header.dat');
include ('./include/menu.dat');
GetMenu("/roads.php");
?>
    <div id="content">
        <div class="blockdata">
            <div class="titlecontainer">        
                <div class="title">Маршрут №6</div>
            </div>
            <div class="data">
                <center><img src="./roads/road_06.jpg" title="Маршрут №6: 
                БКЗ-Татышева-Октябырьский-Авиаторов-9 Мая-Комсомольский-Краснодарская-Партизана Железника-Соревнований-Дубенского-Ленина-БКЗ" alt="Маршрут №6"/></center><br />
                <b>БКЗ-Татышева-Октябырьский-Авиаторов-9 Мая-Комсомольский-Краснодарская-Партизана Железника-Соревнований-Дубенского-Ленина-БКЗ</b><br />
            </div>
        </div>
        <a class="goback" href="<?php echo $_SERVER['HTTP_REFERER']?>" title="Назад">◀ Назад</a>
<?php
include ('./include/footer.dat');
?>