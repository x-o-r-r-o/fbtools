<div class="col-md-12">
	<div class="c-card c-card--responsive u-mb-medium">
		<div class="c-card__header c-card__header--transparent o-line">            
			<h5 class="c-card__title">			
				Pilih Teman yang akan dihapus
			</h5>
		</div>
		<div class="c-card__body">	

			<form class='formtablecheckbox' method="post">

				<div class="c-table-responsive@desktop u-mb-medium" style="overflow: hidden">
					<table class="c-table datatablecheckbox">
						<caption class="c-table__title">							
						</caption>

						<thead class="c-table__head c-table__head--slim">
							<tr class="c-table__row">
								<th class="c-table__cell c-table__cell--head"></th>
								<th class="c-table__cell c-table__cell--head">Nama</th>
								<th class="c-table__cell c-table__cell--head">JK</th>
								<th class="c-table__cell c-table__cell--head">Location</th>
								<th class="c-table__cell c-table__cell--head">Update Terakhir</th>
								<th class="c-table__cell c-table__cell--head no-sort">URL</th>
							</tr>
						</thead>

						<tbody>
							<?php  
							$url = "https://graph.facebook.com/me/friendrequests?limit=0&access_token={$_SESSION['token']}";
							$curl = file_get_contents_curl($url);
							$result = json_decode($curl);
							?>
							<?php
							foreach ($result->data as $row) {	
								$url = "https://graph.facebook.com/{$row->from->id}/?fields=location,gender,updated_time,name,picture&access_token={$_SESSION['token']}";
								$curl = file_get_contents_curl($url);
								$resultdetail = json_decode($curl);
								$gender = !empty($resultdetail->gender) ? $resultdetail->gender : 'Tidak Diketahui';
								if ($gender == 'male') {$gender = 'Laki-Laki'; }else {$gender = 'Perempuan'; } 
								$location = !empty($resultdetail->location->name) ? $resultdetail->location->name : 'Tidak Diketahui';
								echo "
								<tr class='c-table__row odd'>	
									<td class='c-table__cell' style='width:5%'>".$resultdetail->id."</td>
									<td class='c-table__cell'>
										<div class='o-media'>
											<div class='o-media__img u-mr-xsmall'>
												<div class='c-avatar c-avatar--xsmall'>
													<img class='c-avatar__img' src='".$resultdetail->picture."' title='".$resultdetail->name."'>
												</div>
											</div>
											<div class='o-media__body'>
												". truncate($resultdetail->name, 20)."
											</div>
										</div>
									</td>
									<td class='c-table__cell'>".$gender."</td>
									<td class='c-table__cell'>".$location."</td>
									<td class='c-table__cell'>".date('Y-m-d H:i:s', strtotime($resultdetail->updated_time))."</td>
									<td class='c-table__cell'><a class='c-btn c-btn--success' target='_blank' href='https://fb.com/".$resultdetail->id."'>Kunjungi</a></td>
								</tr>
								";
							}
							?>
						</tbody>
					</table>
				</div>		

				<div class="c-field u-mb-small">
					<label class="c-field__label">Proses yang dilakukan : </label>
					<select name="action" class="c-select">
						<option value="accept">Accept All Selected</option>	
						<option value="reject">Reject All Selected</option>	
					</select>
				</div>

				<div class="c-field u-mt-small">
					<input data-post='friendrequest' class="c-btn c-btn--info" type="submit" value="Submit">
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