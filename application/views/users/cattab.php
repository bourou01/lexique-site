
<h2><?php echo "<h2>".$category['name']."</h2>\n";?></h2>
<hr>
<blockquote>
<p><?php echo "<p>".$category['description'] . "</p>\n";?></p>
</blockquote>	


<form class="form-actions form-inline" style="text-align:justify;">
<?php
// On exclu 'Autre' car pas ˆ jour!
if ($cat_id != 25)
{
	echo '<a class="btn btn-primary" id="submit" title ="Envoyer un message" href="../../tools/pdfCreator/download/'.$cat_id.'">T&eacute;l&eacute;charger la fiche</a>';
}
?>
</form>




<div id="dynamic">

	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered  table-condensed" id="example">
		<thead>
			<tr>
				<th width="2%">#</th>
				<th width="30%">Mahorais</th>
				<th width="30%">Francais</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="5" class="dataTables_empty">Loading data from server</td>
			</tr>
		</tbody>
	</table>

</div>
