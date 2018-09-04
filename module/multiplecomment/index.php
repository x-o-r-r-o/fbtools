<div class="col-md-12">
	<div class="c-card c-card--responsive u-mb-medium">
		<div class="c-card__header c-card__header--transparent o-line">            
			<h5 class="c-card__title">			
				Multiple Comment			
			</h5>
		</div>
		<div class="c-card__body">	

			<form class='formsingle' method="post">

				<div class="row">
					<div class="col-md-12">
						<div class="c-field u-mt-small">
							<label class="c-field__label">URL Postingan : </label>
							<input class="c-input" placeholder="https://" type="text" name="postid" required="">
						</div>		
					</div>
					<div class="col-md-6">
						<div class="c-field u-mt-small u-mb-small">
							<label class="c-field__label">Pesan Komentar : (massup|massnumb)</label>
							<textarea class="c-input" name="message" rows="5" cols="50" placeholder="Insert Message" required="">{Up|Recomended|Tertarik !|Jejak Dulu}</textarea>
						</div>

						<?php include "module/_form/delay.php" ?>
					</div>
					<div class="col-md-6">

						<div class="c-field u-mt-small">
							<label class="c-field__label">URL Gambar : (Komentar dengan gambar pisah dengan || untuk acak)</label>
							<textarea class="c-input" name="images" rows="5" cols="50" placeholder="https://"></textarea>
						</div>

						<div class="c-field u-mt-small">
							<label class="c-field__label">Maksimal Proses : </label>
							<input onclick="this.select();" class="c-input" placeholder="1" type="number" name="max" required="">
						</div>
					</div>
				</div>

				<div class="c-field u-mt-small">
					<input data-post='multiplecomment' class="c-btn c-btn--info" type="submit" value="Submit">
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