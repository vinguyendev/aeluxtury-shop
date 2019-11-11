<form action="" method="GET">
<div class="search">
	<table>
		<tr>
			<td valign="top">
				<table width="100%" cellpadding="2">
					<tr>
						<td class="text">Tên sản phẩm</td>
						<td>
							<input type="text" id="tou_keyword" name="tou_keyword" class="form-control" style="width: 150px;" value="<?=$tou_keyword?>" />
						</td>
					</tr>
				</table>
			</td>
			<td valign="top">
				<table width="100%" cellpadding="2">
					<tr>
						<td class="text">Danh mục</td>
						<td>
							<select id="iCat" class="form-control" name="iCat" style="width: 150px;">
								<option value="0">Danh mục</option>
								<?
			               foreach($arrCategory as $rowCat) {
			               	$text_line	= "";
									for($j=0;$j<$rowCat["level"];$j++) $text_line	.= "--";
									$style	= ($rowCat["level"] == 0) ? "bold" : "";
			                  echo('<option style="font-weight: ' . $style . '" value="' . $rowCat["cat_id"] . '"' . ($rowCat["cat_id"] == $iCat ? ' selected="selected"' : '') . '>' . $text_line . $rowCat["cat_name"] . '</option>');
			               }
			               ?>
							</select>
						</td>
					</tr>
				</table>
			</td>

			<td valign="top">
				<table width="100%" cellpadding="2">
					<tr>
						<td></td>
						<td style="padding-top: 2px;">
							<input style="width: 100%; font-weight: bold;" type="submit" class="btn btn-info" value="Tìm kiếm" />
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
</form>