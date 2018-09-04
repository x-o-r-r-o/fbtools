<div class="col-md-12">
	<div class="c-card c-card--responsive u-mb-medium">
		<div class="c-card__header c-card__header--transparent o-line">            
			<h5 class="c-card__title">			
				Pilih Grup
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

				<div class="c-field u-mt-small">
					<input data-post='multipleleavegroup' class="c-btn c-btn--info" type="submit" value="Submit">
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