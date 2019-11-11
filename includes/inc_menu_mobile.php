<!-- <div class="button_menu_mobile" onclick="show_menu()">
    <div id="nav-icon3" >
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<ul class="menu_mobile">
	<?
	$url_current = $_SERVER['REQUEST_URI'];
	$i = 0;
	$db_query = new db_query("SELECT * FROM menus WHERE mnu_type = 1 AND mnu_active = 1 AND mnu_parent_id = 0 ORDER BY mnu_order ASC");
	while ($row = mysqli_fetch_assoc($db_query->result)) {
		$classChild = "";
		$classHome = "";
		$classActive = "";

		// if($url_current == $row['mnu_link']){
		// 	$classActive = " active";
		// }

		echo '<li><a class="' . $classActive . '" href="' . $row['mnu_link'] . '" target="' . $row['mnu_target'] . '">' . $row['mnu_name'] . '</a>';
		$db_sub = new db_query("SELECT * FROM menus WHERE  mnu_type = 1 AND mnu_active = 1 AND mnu_parent_id = " . $row['mnu_id'] . " ORDER BY mnu_order ASC ");
		if(mysqli_num_rows($db_sub->result) > 0){
			echo '<ul class="menu_mobile_sub">';
			while ($row_sub = mysqli_fetch_assoc($db_sub->result)) {
				echo '<li><a target="' . $row_sub['mnu_target'] . '" href="' . $row_sub['mnu_link'] . '">' . $row_sub['mnu_name'] . '</a></li>';
			}
			echo '</ul>';
		}
		unset($db_sub);

		echo '</li>';
		$i++;
	}
	unset($db_query);
	?>
</ul> -->