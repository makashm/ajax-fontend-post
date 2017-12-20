<div class="wrap">
	<div class="ajax-form">
		<form type="post" action="" id="fontend_ajax_form">
			<label for="post_title">Post Title</label>
			<input name="post_title" id="post_title" type="text" />

			<label for="post_desc">Post Content</label>
			<textarea name="post_desc" id="post_desc" cols="30" rows="6"></textarea>

			<label for="post_cat">Category</label>
			<input name="post_cat" id="post_cat" type="text" />

			<label for="post_type">Post Type</label>
			<select id="post_type" class="post_type" name="state">
			  	<option value="post">Post</option>
			  	<option value="page">Page</option>
			  	<option value="attachment">Attachment</option>
			  	<option value="revision">Revision</option>
			  	<option value="nav_menu_item">Nav Menu Item</option>
			  	<option value="custom_css">Custom Css</option>
			  	<option value="customize_changeset">Customize Changeset</option>
			</select>


			<label for="post_status_select2">Post Status</label>
			<select id="post_status" class="post_status" name="state">
			  	<option value="publish">Publish</option>
			  	<option value="future">Future</option>
			  	<option value="draft">Draft</option>
			  	<option value="pending">Pending</option>
			  	<option value="private">Private</option>
			  	<option value="trash">Trash</option>
			  	<option value="auto-draft">Auto Draft</option>
			  	<option value="inherit">Inherit</option>
			</select>

			<br/>
			<button type="submit">Submit Post</button>
		</form>
		<br/><br/>
		<div id="feedback"></div>
		<br/><br/>
	</div>
</div>