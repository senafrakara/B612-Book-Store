<br>
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-xs-7" style="min-height: 500px">
			<div id="table-header">Category Detail</div><br>
			<h4>Category Name: <?= strip_tags($catDetail->category) ?></h4>
			<p><?= strip_tags($catDetail->description) ?></p>
			<b>Tag: <?= strip_tags($catDetail->tag) ?></b>
			<hr>
		  <div><h5>Action</h5></div>
	      <?php print '<td>';
	        print '<a href= "'.base_url().'admin/editCategory/'.$catDetail->id.'" title= "Edit" class="btn btn-success btn-sm"> <i class= "fas fa-wrench"></i> Update</a>&nbsp';
	        print '<a href= "'.base_url().'admin/deleteCategory/'.$catDetail->id.'" title= "Delete" class="btn btn-danger btn-sm delete" data-confirm = "Are you sure to delete this category? If it deleted user can not find the books from this category."> <i class= "fas fa-trash"></i> Delete</a>&nbsp';

	        print '</td>'; 
	      ?>
		</div>
		<div class="col-sm-6 col-xs-5">
			
		</div>
	</div>
</div>