<?php 
    if($this->session->flashdata('success'))
    {
        print '<div class= "success-msg">'.$this->session->flashdata('success').'</div>';
    }
    if($this->session->flashdata('error'))
    {
        print '<div class= "error-msg">'.$this->session->flashdata('error').'</div>';
    }
?>

<div class="view-btn"><a href="<?= base_url()?>admin/addCategory">Add new Category <i class="fas fa-plus-circle"></i></a></div>
<br>
<div class="container">
	<div id="table-header">Categories</div>
	<table class="table table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Category Name</th>
      <th scope="col">Description</th>
      <th scope="col"></th>
    </tr>
  </thead>


  <tbody>
  	<?php foreach($categories as $cat): ?>
    <tr>
      <?php print '<td>'.$cat->id.'</td>'; ?>
      <?php print '<td><a href = "'.base_url().'admin/categoryDetail/'.$cat->id.'" title="More Description" class= "text-info">'.strip_tags(ucwords($cat->category)).'</a></td>'; ?>

      <?php print '<td><p>'.substr(strip_tags($cat->description), 0, 90).'</p></td>'; ?>
      <?php print '<td>';
        print '<a href= "'.base_url().'admin/categoryDetail/'.$cat->id.'" title= "View More" class="btn btn-primary btn-sm">View</a>&nbsp';

        print '</td>'; 
      ?>
    </tr>
	<?php endforeach; ?>
  </tbody>
</table>
</div>