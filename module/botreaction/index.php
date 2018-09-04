<div class="col-md-12">
	<div class="c-card c-card--responsive u-mb-medium">
		<div class="c-card__header c-card__header--transparent o-line">            
			<h5 class="c-card__title">			
				Pengaturan Bot Reaction
			</h5>
		</div>
		<div class="c-card__body">	

			<form method="post">
				<div class="row">
					<div class="col-md-6">

						<div class="c-field u-mb-small">
							<label class="c-field__label">Status Aktif : </label>
							<?php  
							$sql = "SELECT status FROM tb_bot_reaction WHERE userid='$_SESSION[userid]'";
							$result = $mysql->query($sql);
							$read = $result->fetch_array();
							?>
							<?php if ($read['status'] == 'on'): ?>
								<div class="c-switch is-active">
									<input class="c-switch__input" name="status" type="checkbox" checked="checked">
									<label class="c-switch__label">ON</label>
								</div>
							<?php else: ?>
								<div class="c-switch">
									<input class="c-switch__input" name="status" type="checkbox">
									<label class="c-switch__label">OFF</label>
								</div>
							<?php endif ?>							
						</div>
						<div class="c-field u-mb-small">
							<label class="c-field__label">Maksimal Proses : </label>
							<select name="maxprocess" class="c-select" required>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							</select>
						</div>
						<div class="c-field u-mb-small">
							<label class="c-field__label">Tipe Reaction : </label>
							<select class="c-select" name="reaction" required>
								<option value='LIKE'>LIKE</option>
								<option value='LOVE'>LOVE</option>
								<option value='WOW'>WOW</option>
								<option value='HAHA'>HAHA</option>
								<option value='SAD'>SAD</option>
								<option value='ANGRY'>ANGRY</option>
							</select>
						</div>
						<div>
							<div class="c-field u-mb-small">
								<input class="c-btn c-btn--info" name="saveaccount" type="submit" value="Submit">
							</div>
						</div>	
					</div>
				</div>
			</form>

		</div>
	</div>
</div>

<?php  
include "execute.php";
?>