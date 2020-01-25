<div class="form-group">
	<label><?= $lang['PAGE_TARGET'] ?> :</label>
	<?php if (!empty($_SESSION['token_facebook'])): ?>
		<?php  
		$token = $_SESSION['token_facebook'];
		$url = "https://graph.fb.me/me/accounts?access_token={$token}";

		$curl = file_get_contents_curl($url);
		$result = json_decode($curl);
		?>
		<select name="select_page[]" class="form-control selectpicker" multiple='' data-live-search="true" data-actions-box="true" title="<?= $lang['SELECT'] ?>">
			<?php
			foreach ($result->data as $value_group) {							
				echo "<option data-icon='fa fa-star' value='{$value_group->id}'>{$value_group->name}</option>";
			}
			?>
		</select>
	<?php else: ?>
		<input placeholder="<?= $lang['PAGE_TARGET_PLACEHOLDER'] ?>" class="form-control" type="text" name="select_page[]">
	<?php endif ?>
</div>   