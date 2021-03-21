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

<div class="view-btn"><a href="<?= base_url()?>admin/addUser">Add new user <i class="fas fa-plus-circle"></i></a></div>
<br>
<div class="container">
	<div id="table-header">Users</div>
	<table class="table table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Phone</th>
      <th scope="col">Email</th>
      <th scope="col">Type</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>


  <tbody>
  	<?php foreach($users as $user): ?>
    <tr>
      <?php print '<td>'.htmlentities($user->id).'</td>'; ?>
      <?php print '<td class= "text-info">'.htmlentities($user->name).'</td>'; ?>
      <?php print '<td>'.htmlentities($user->contact).'</td>'; ?>
      <?php print '<td>'.htmlentities($user->email).'</td>'; ?>
      <?php print '<td>'.htmlentities($user->type).'</td>'; ?>
      <?php print '<td>';
        print '<a href= "'.base_url().'admin/deleteUser/'.$user->id.'" title= "Delete" class="btn btn-outline-danger btn-sm delete" data-confirm = "Are you sure to delete this User?"><i class="fas fa-times"></i></a>';

        print '</td>'; 
      ?>
    </tr>
	<?php endforeach; ?>
  </tbody>
</table>
</div>