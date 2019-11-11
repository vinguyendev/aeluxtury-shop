<?
require_once("lang.php");

$page = getValue("page", "int", "POST", 0);
$dv   = getValue("dv", "int", "POST", 0);
$sql  = "";
if($dv != 0){
    $sql .= " AND prj_dichvu_id = " . $dv . " ";
}
if($page > 0){
    $db_query = new db_query("SELECT * FROM project WHERE prj_active = 1 " . $sql . " ORDER BY prj_id DESC LIMIT " . 18 * $page . ",18 ");
    while ($row = mysqli_fetch_assoc($db_query->result)) {
        $link = createlink("project", array('nTitle' => $row['prj_title'], "iData" => $row['prj_id']));
        $img = getUrlImageProject($row['prj_logo'], "medium");
        ?>
        <div class="item">
            <div class="item-img">
                <img src="<?=$img?>" class="lazy initial loaded" data-original="<?=$img?>" width="100%" alt="<?=$row['prj_title']?>" data-was-processed="true">
                <a class="item-bg" style="background-color:#e94528;"></a>
                <a class="item-content" href="<?=$link?>" target="_blank">
                    <div class="item-content-inner">
                        <h3><?=$row['prj_title']?></h3>
                        <h4><?=$row['prj_description']?></h4>
                        <span class="more">View</span>
                    </div>
                </a>
                <!-- <div class="hits">6086</div> -->
            </div>
        </div>
        <?
    }
    unset($db_query);
}
?>
