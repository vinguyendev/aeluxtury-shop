<?  
$db_about = new db_query("SELECT * FROM about LIMIT 1");
$row = mysqli_fetch_assoc($db_about->result);
?>

<div class="about-view">
    <div class="inner-page-content">
        <div class="team-header">
            <div class="container">
                <div class="square-default"></div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <?=$row['ab_text2']?>  
                    </div>
                </div>
            </div>
        </div>
        <div class="photo-block">
            <div class="container">
                <?
                $db_per = new db_query("SELECT * FROM personnel WHERE per_active = 1 ORDER BY per_pos ASC");
                while ($row2 = mysqli_fetch_assoc($db_per->result)) {
                    ?>
                    <div class="photo-name">
                        <div class="photo"><img src="<?=LANG_PATH.'data/personnel/'.$row2['per_image']?>" alt="<?=$row2['per_name']?>" /></div>
                        <div class="photo-main">
                            <div class="name"><span class="wrap"><?=$row2['per_name']?></span></div>
                            <div class="prof"><?=$row2['per_pos']?></div>
                        </div>
                    </div>
                    <?
                }
                unset($db_per);
                ?>
                
               
                
            </div>
        </div>
    </div>
</div>
<?
unset($db_about);
?>