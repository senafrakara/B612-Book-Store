<div class="section-title">
	<?php
	$this->load->model('user_model');
	$countComment = count($this->user_model->getCommentsCommentField());

	print "<a href = '#collapseReview' data-toggle = 'collapse' role = 'button' aria-controls='collapseReview'><i class = 'far fa-comment'></i> Comments : (" . $countComment . ")</a>";
	?>
</div>

<div class="collapse" id="collapseReview">
	<div class="card card-body">
		<table class="table table-hover">
			<tbody>
				<?php foreach ($comments as $comment) : ?>
					<tr>
						<?php print '<td style="width: 230px">';
						print '<b class = "text-info">' . htmlentities($comment->name) . '</b>';
						print '<p>' . htmlentities($comment->email) . '</p>';
						print '<small>' . date('h:i a, d M Y', strtotime($comment->dateTime)) . '</small>';
						print '</td>'; ?>
						<?php print '<td><p>' . nl2br(htmlentities($comment->comment)) . '</p></td>'; ?>
						<?php 
						if($comment->userId == $this->session->userdata('id'))
						{
							print '<td><a href= "' . base_url() . 'users/deleteComment/' . $comment->id . '" title= "Delete" class="btn btn-danger btn-sm delete" data-confirm = "Are you sure to delete this comment?"> <i class= "fas fa-trash"></i> Delete</a>&nbsp</td>';
						}
					?>
				
					</tr>
				
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div><br>