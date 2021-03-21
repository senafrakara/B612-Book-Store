<br>
<div class="row">
  <div class="col-lg-3">
    <div id="table-header"></div>
    <div class="ebooks-menu">
      <ul>
        <?php foreach($categories as $cat): ?>
                                
        <?php print '<li><a href="'.base_url('users/allEBooks').'/?cat='.$cat->tag.'">'.$cat->category.'</a></li>';?>
       
        <?php endforeach; ?>
      </ul>
    </div>

  </div>
  <div class="col-lg-9">
    <div class="container-fluid">
      <div id="table-header">E-Books
    
      <?php foreach($categories as $cat): ?>
        <?php 
        if(isset($_GET['cat']))
        {
          if($_GET['cat'] == $cat->tag)
          {
            print '<i class="fas fa-angle-double-right" style="color: #ddd"></i> '.$cat->category;
          }
        } 
        ?>
      <?php endforeach; ?>
      </div>
      <table class="table">
      <thead class="">
        <tr>
          <th scope="col">Book Name</th>
          <th scope="col">Description</th>
          <th scope="col">Author</th>
          <th scope="col">Category</th>
          <th scope="col">Book Image</th>
          <th scope="col">Action</th>
        </tr>
      </thead>


      <tbody>
        <?php foreach($eBooks as $eBook): ?>
        <tr>
          <?php print '<td><a href = "'.base_url().'users/eBookDetail/'.$eBook->id.'" title="More Description" class= "text-info">'.strip_tags(ucwords($eBook->ebook_name)).'</a></td>'; ?>

          <?php print '<td><p>'.substr(strip_tags($eBook->description), 0, 100).'<p></td>'; ?>
          <?php print '<td>'.strip_tags($eBook->author).'</td>'; ?>
          <?php print '<td>'.ucwords(strip_tags($eBook->category)).'</td>'; ?>
          <?php print '<td><img src = "'.strip_tags($eBook->book_image).'" alt = "" width="50" hieght="80" </td>';?>

          <?php print '<td>';
            print '<a href= "'.base_url().'users/eBookDetail/'.$eBook->id.'" title= "View details" class="btn btn-primary btn-sm">Detail</a>&nbsp';

            print '</td>'; 
          ?>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    </div>
  </div>
</div>
<br>
