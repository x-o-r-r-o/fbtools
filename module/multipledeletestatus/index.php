<div class="col-md-12">
	<div class="c-card c-card--responsive u-mb-medium">
		<div class="c-card__header c-card__header--transparent o-line">            
			<h5 class="c-card__title">				
				Pilih status yang akan dihapus : 
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
								<th class="c-table__cell c-table__cell--head">Tanggal Publish</th>
								<th class="c-table__cell c-table__cell--head no-sort">Isi Status</th>
								<th class="c-table__cell c-table__cell--head no-sort">URL</th>
							</tr>
						</thead>

						<tbody>
							<?php  
							// https://graph.facebook.com/me/statuses
							// for statuses <td style='width:5%'>".$_SESSION['id']."_".$row->id."</td>
							$url = "https://graph.facebook.com/me/posts?access_token={$_SESSION['token']}";

							$curl = file_get_contents_curl($url);
							$result = json_decode($curl);
							?>
							<?php
							foreach ($result->data as $row) {		
								$message = !empty($row->message) ? $row->message : 'Photo or Share Link';
								echo "
								<tr class='c-table__row odd'>	
									<td class='c-table__cell' style='width:5%'>".$row->id."</td>
									<td class='c-table__cell'>".date('Y-m-d H:i:s', strtotime($row->updated_time))."</td>
									<td class='c-table__cell'>".strip_tags(truncate($message,50))."</td>
									<td class='c-table__cell'><a class='c-btn c-btn--success' target='_blank' href='https://fb.com/".$row->id."'>Kunjungi</a></td>
								</tr>
								";
							}
							?>
						</tbody>
					</table>
				</div>

				<div class="c-field u-mt-small">
					<input data-post='multipledeletestatus' class="c-btn c-btn--info" type="submit" value="Submit">
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