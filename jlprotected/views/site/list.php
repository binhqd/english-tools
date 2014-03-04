<table class="table table-striped">
<tr>
	<th class='span1'>#</th>
	<th class='span4'>Data</th>
	<th class='span4'>Options</th>
</tr>
<tbody>
<?php $cnt = 0;foreach ($records as $item):
$cnt++;
?>
<tr>
	<td><?php echo $cnt;?></td>
	<td><a href='<?php echo GNRouter::createUrl('/vocabulary/list?id=' . IDHelper::uuidFromBinary($item->id, true))?>'><?php echo $item->title?></a></td>
	<td></td>
</tr>
<?php endforeach;?>
</tbody>
</table>
[ <a href='<?php echo GNRouter::createUrl("/vocabulary/create/dataset")?>'>Create new dataset</a> ]