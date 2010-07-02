<?php
include ('./include/header.dat');
include ('./include/menu.dat');
GetMenu("/roads.php");
?>
    <div id="content">
        <div class="blockdata">
            <div class="titlecontainer">        
                <div class="title">Маршрут №7</div>
            </div>
            <div class="data">
                <center><img src="./roads/road_07.jpg" title="Маршрут №7: БКЗ-ул. Мира-театр_музкомедии-копыловский мост-копылова-ГорДК-пр. Свободный-Маерчака-Профсоюзов-ул. Мира-БКЗ" alt="Маршрут №6"/></center><br />
                <b>БКЗ-ул. Мира-театр_музкомедии-копыловский мост-копылова-ГорДК-пр. Свободный-Маерчака-Профсоюзов-ул. Мира-БКЗ</b><br />
            </div>
        </div>
        <a class="goback" href="<?php echo $_SERVER['HTTP_REFERER']?>" title="Назад">◀ Назад</a>
<?php
include ('./include/footer.dat');
?>