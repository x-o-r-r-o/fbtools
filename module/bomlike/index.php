<div class="col-md-12">
	<div class="c-card c-card--responsive u-mb-medium">
		<div class="c-card__header c-card__header--transparent o-line">            
			<h5 class="c-card__title">			
				Pilih Target untuk di Bom Like
			</h5>
		</div>
		<div class="c-card__body">	

			<form class="formsingle" method="post">
				<div class="row">
					<div class="col-md-6">
						<div class="c-field u-mb-small">
							<label class="c-field__label">Pilih Profile : </label>
							<select name="people" class="c-select has-search">
								<?php  
								$url = "https://graph.fb.me/me/friends?access_token={$_SESSION['token']}";

								$curl = file_get_contents_curl($url);
								$result = json_decode($curl);
								?>
								<?php
								foreach ($result->data as $row) {							
									echo "<option value='{$row->id}'>{$row->name}</option>";
								}
								?>
							</select>
						</div>
						<div class="c-field u-mb-small">
							<label class="c-field__label">Maksimal Proses : </label>
							<select name="max" class="c-select">
								<option value="1">1</option>
								<option value="5">5</option>
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="50">50</option>		
							</select>
						</div>
						<?php include "module/_form/delay.php" ?>
						<div class="c-field u-mb-small">
							<input data-post='bomlike' class="c-btn c-btn--info" name="bomlike" type="submit" value="Submit">
						</div>
					</div>
				</div>
			</form>

			<div class="c-progress c-progress--info u-mt-medium" style="display: none; height: 40px;">
				<div class="c-progress__bar" style="width:0;">
					<div id="fullResponse" style="
					text-align: center;
					width: 100%;
					line-height: 40px;
					"></div>
				</div>
			</div>

		</div>
	</div>
</div>