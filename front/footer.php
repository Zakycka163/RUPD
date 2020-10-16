<?php
    $city = 'Тольятти';
    $year = '2020';
    $link = "http://www.tolgas.ru";
    $link_info = "Сайт ПВГУС";
?>

<div class="fixed-bottom">
    <center>
        <div class="p-1 bg-white font-weight-bold text-primary">
            <text><?php echo $city.' '.$year?></text>
            <a href=<?php echo $link?> target="_blank" title="<?php echo $link_info?>">
                <img src="/front/img/footer_icon" height="45px" alt="<?php echo $link_info?>" title="<?php echo $link_info?>">
            </a>
        </div>
    </center>
</div>