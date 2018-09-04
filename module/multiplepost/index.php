<div class="col-md-12">
	<div class="c-card c-card--responsive u-mb-medium">
		<div class="c-card__header c-card__header--transparent o-line">            
			<h5 class="c-card__title">
				
				<?php if (@isset($_GET['type'])): ?>
					Anda Akan Mingirim Post ke <?= ucfirst($_GET['type']) ?>
				<?php else: ?>
					Pilih Target untuk mengirim post anda : 
				<?php endif ?>
			</h5>
		</div>
		<div class="c-card__body">	

			<form class='formtablecheckbox' method="post">

				<?php if (@isset($_GET['type'])): ?>
					<div class="row">
						<div class="col-md-6">

							<div class="c-field u-mb-small">
								<label class="c-field__label" class="c-field__label">Pesan Komentar : Gunakan {kalimat1|kalimat2} untuk acak</label>
								<textarea onclick="this.select();" class="c-input" name="message" rows="5" cols="50" required="">{kalimat1|kalimat2|kalimat3}</textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="c-field u-mb-small">
								<label class="c-field__label">Type :</label>
								<input readonly="" value="<?= $_GET['type'] ?>" class="c-input" type="text" name="type">
							</div>
							<div class="c-field u-mb-small">
								<label class="c-field__label">Link : (optional)</label>
								<input onclick="this.select();" placeholder="https://example.com" class="c-input" type="url" name="link">
							</div>
						</div>
					</div>
					<?php include "module/_form/delay.php" ?>
				<?php endif ?>


				<?php if (@$_GET['type'] == 'profile'): ?>
					<div class="c-table-responsive@desktop u-mb-medium" style="overflow: hidden">
						<table class="c-table datatablecheckbox">
							<caption class="c-table__title">							
							</caption>

							<thead class="c-table__head c-table__head--slim">
								<tr class="c-table__row">
									<th class="c-table__cell c-table__cell--head"></th>
									<th class="c-table__cell c-table__cell--head">Nama</th>
									<th class="c-table__cell c-table__cell--head">Jenis Kelamin</th>
									<th class="c-table__cell c-table__cell--head">Update Terakhir</th>
									<th class="c-table__cell c-table__cell--head no-sort">URL</th>
								</tr>
							</thead>

							<tbody>
								<?php  
								$url = "https://graph.facebook.com/me/friends?fields=location,gender,updated_time,name,picture&access_token={$_SESSION['token']}";

								$curl = file_get_contents_curl($url);
								$result = json_decode($curl);
								?>
								<?php
								foreach ($result->data as $row) {		
									$gender = !empty($row->gender) ? $row->gender : 'Tidak Diketahui';
									if ($gender == 'male') {$gender = 'Laki-Laki'; }else {$gender = 'Perempuan'; } 
									$location = !empty($row->location->name) ? $row->location->name : 'Tidak Diketahui';
									echo "
									<tr class='c-table__row odd'>	
										<td class='c-table__cell' style='width:5%'>".$row->id."</td>
										<td class='c-table__cell'>
											<div class='o-media'>
												<div class='o-media__img u-mr-xsmall'>
													<div class='c-avatar c-avatar--xsmall'>
														<img class='c-avatar__img' src='".$row->picture."' title='".$row->name."'>
													</div>
												</div>
												<div class='o-media__body'>
													". truncate($row->name, 20)."
												</div>
											</div>
										</td>
										<td class='c-table__cell'>".$gender."</td>
										<td class='c-table__cell'>".date('Y-m-d H:i:s', strtotime($row->updated_time))."</td>
										<td class='c-table__cell'><a class='c-btn c-btn--success' target='_blank' href='https://fb.com/".$row->id."'>Kunjungi</a></td>
									</tr>
									";
								}
								?>
							</tbody>
						</table>
					</div>
				<?php elseif (@$_GET['type'] == 'group'): ?>
					<div class="c-table-responsive@desktop u-mb-medium" style="overflow: hidden">
						<table class="c-table datatablecheckbox">
							<caption class="c-table__title">							
							</caption>

							<thead class="c-table__head c-table__head--slim">
								<tr class="c-table__row">
									<th class="c-table__cell c-table__cell--head"></th>
									<th class="c-table__cell c-table__cell--head">Nama Group</th>
									<th class="c-table__cell c-table__cell--head">Anggota</th>
									<th class="c-table__cell c-table__cell--head">Update Terakhir</th>
									<th class="c-table__cell c-table__cell--head no-sort">URL</th>
								</tr>
							</thead>

							<tbody>
								<?php  
								$url = "https://graph.facebook.com/me/groups?fields=updated_time,name,members.limit(0).summary(true)&access_token={$_SESSION['token']}";

								$curl = file_get_contents_curl($url);
								$result = json_decode($curl);
								?>
								<?php
								foreach ($result->data as $row) {	
									echo "
									<tr class='c-table__row odd'>	
										<td class='c-table__cell' style='width:5%'>".$row->id."</td>
										<td class='c-table__cell'>". truncate($row->name, 20)."</td>
										<td class='c-table__cell'>".number_format($row->members->summary->total_count)."</td>
										<td class='c-table__cell'>".dateid($row->updated_time, 'l, j F Y', '')."</td>
										<td class='c-table__cell'><a class='c-btn c-btn--success' target='_blank' href='https://fb.com/".$row->id."'>Kunjungi</a></td>
									</tr>
									";
								}
								?>
							</tbody>
						</table>
					</div>
				<?php elseif (@$_GET['type'] == 'page'): ?>
					<div class="c-table-responsive@desktop u-mb-medium" style="overflow: hidden">
						<table class="c-table datatablecheckbox">
							<caption class="c-table__title">							
							</caption>

							<thead class="c-table__head c-table__head--slim">
								<tr class="c-table__row">
									<th class="c-table__cell c-table__cell--head"></th>
									<th class="c-table__cell c-table__cell--head">Nama Halaman</th>
									<th class="c-table__cell c-table__cell--head">Jumlah Like</th>
									<th class="c-table__cell c-table__cell--head no-sort">URL</th>
								</tr>
							</thead>

							<tbody>
								<?php  
								$url = "https://graph.facebook.com/v2.6/me/likes?fields=name,fan_count&access_token={$_SESSION['token']}";

								$curl = file_get_contents_curl($url);
								$result = json_decode($curl);
								?>
								<?php
								foreach ($result->data as $row) {	
									echo "
									<tr class='c-table__row odd'>	
										<td class='c-table__cell' style='width:5%'>".$row->id."</td>
										<td class='c-table__cell'>".$row->name."</td>
										<td class='c-table__cell'>".number_format($row->fan_count)."</td>
										<td class='c-table__cell'><a class='c-btn c-btn--success' target='_blank' href='https://fb.com/".$row->id."'>Kunjungi</a></td>
									</tr>
									";
								}
								?>
							</tbody>
						</table>
					</div>		
				<?php else: ?>

					<div class="row">
						<div class="col-sm-12 col-lg-6 col-xl-4">
							<a href="?module=multiplepost&type=profile" class="c-state-card" data-mh="state-cards" style="height: 125px;">
								<div class="c-state-card__icon c-state-card__icon--info">
									<i class="fa fa-user"></i>
								</div>

								<div class="c-state-card__content">
									<h5 class="c-state-card__number">Profile							
									</h5>
								</div>
							</a>
						</div>

						<div class="col-sm-12 col-lg-6 col-xl-4">
							<a href="?module=multiplepost&type=group" class="c-state-card" data-mh="state-cards" style="height: 125px;">
								<div class="c-state-card__icon c-state-card__icon--info">
									<i class="fa fa-group"></i>
								</div>

								<div class="c-state-card__content">
									<h5 class="c-state-card__number">Group							
									</h5>
								</div>
							</a>
						</div>

						<div class="col-sm-12 col-lg-6 col-xl-4">
							<a href="?module=multiplepost&type=page" class="c-state-card" data-mh="state-cards" style="height: 125px;">
								<div class="c-state-card__icon c-state-card__icon--info">
									<i class="fa fa-flag"></i>
								</div>

								<div class="c-state-card__content">
									<h5 class="c-state-card__number">Page							
									</h5>
								</div>
							</a>
						</div>		
					</div>
				<?php endif ?>

				<?php if (@isset($_GET['type'])): ?>
					<div class="c-field u-mt-small">
						<input data-post='multiplepost' class="c-btn c-btn--info" type="submit" value="Submit">
					</div>
				<?php endif ?>

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