<div class="col-md-12">
	<div class="c-card c-card--responsive u-mb-medium">
		<div class="c-card__header c-card__header--transparent o-line">            
			<h5 class="c-card__title">			
				<?php if (!empty($_GET['groupid'])): ?>
					Pilih Status 
				<?php else: ?>		
					Pilih Grup
				<?php endif ?>				
			</h5>
		</div>
		<div class="c-card__body">	

			<form class='formtablecheckbox' method="post">

				<?php if (!empty($_GET['groupid'])): ?>

					<label class="c-field__label">Deep Scan Feed (Loadingnya Lama) </label>
					<div class="c-field has-addon-right u-mb-small">
						<input class="c-input" type="number" name="maxwhile" placeholder="Max While" value="<?= (!empty($_GET['maxwhile']) ? $_GET['maxwhile'] : '') ?>">
						<span class="c-field__addon">
							<button type="button" data-url='./?module=multipledeletepostgroup&groupname=<?= $_GET['groupname'] ?>&groupid=<?= $_GET['groupid'] ?>&limit=1000&maxwhile=' class="maxwhile c-btn c-btn--info" style="border-left: 0; border-top-left-radius: 0; border-bottom-left-radius: 0; ">Submit</button>
						</span>
					</div>

					<div class="c-table-responsive@desktop u-mb-medium" style="overflow: hidden">
						<table class="c-table datatablecheckbox">
							<caption class="c-table__title">							
							</caption>

							<thead class="c-table__head c-table__head--slim">
								<tr class="c-table__row">
									<th class="c-table__cell c-table__cell--head"></th>
									<th class="c-table__cell c-table__cell--head">Tanggal Publish</th>
									<th class="c-table__cell c-table__cell--head">Post By</th>
									<th class="c-table__cell c-table__cell--head no-sort">Isi Status</th>
									<th class="c-table__cell c-table__cell--head">Type</th>
									<th class="c-table__cell c-table__cell--head no-sort">URL</th>
								</tr>
							</thead>

							<tbody>
								<?php  					
								$url = "https://graph.facebook.com/{$_GET['groupid']}/feed?fields=type,created_time,from,message,story,status_type&limit={$_GET['limit']}&access_token={$_SESSION['token']}";

								$curl = file_get_contents_curl($url);
								$result = json_decode($curl);
								?>
								<?php
								foreach ($result->data as $row) {		
									$message = !empty($row->message) ? $row->message : 'Photo or Share Link';
									if ($row->from->id == $_SESSION['userid']) {
										echo "
										<tr class='c-table__row odd'>	
											<td class='c-table__cell' style='width:5%'>".$row->id."</td>
											<td class='c-table__cell'>".date('Y-m-d H:i:s', strtotime($row->updated_time))."</td>
											<td class='c-table__cell'>".$row->from->name."</td>
											<td class='c-table__cell'>".strip_tags(truncate($message,50))."</td>
											<td class='c-table__cell'>".$row->type."</td>
											<td class='c-table__cell'><a class='c-btn c-btn--success' target='_blank' href='https://fb.com/".$row->id."'>Kunjungi</a></td>
										</tr>
										";
									}
								}

								$counter = 0;
								$maxwhile = @$_GET['maxwhile'];
								if ($maxwhile) {
									while (!empty(@$result->paging->next) and ($counter < $maxwhile)) {
										$url = $result->paging->next;

										$curl = file_get_contents_curl($url);
										$result = json_decode($curl);

										foreach ($result->data as $row) {		
											$message = !empty($row->message) ? $row->message : 'Photo or Share Link';
											if ($row->from->id == $_SESSION['userid']) {
												echo "
												<tr class='c-table__row odd'>	
													<td class='c-table__cell' style='width:5%'>".$row->id."</td>
													<td class='c-table__cell'>".date('Y-m-d H:i:s', strtotime($row->updated_time))."</td>
													<td class='c-table__cell'>".$row->from->name."</td>
													<td class='c-table__cell'>".strip_tags(truncate($message,50))."</td>
													<td class='c-table__cell'>".$row->type."</td>
													<td class='c-table__cell'><a class='c-btn c-btn--success' target='_blank' href='https://fb.com/".$row->id."'>Kunjungi</a></td>
												</tr>
												";
											}
										}
										$counter++;
									}
								}
								?>
							</tbody>
						</table>
					</div>
				<?php else: ?>		
					<div class="c-table-responsive@desktop u-mb-medium" style="overflow: hidden">
						<table class="c-table datatable">
							<caption class="c-table__title">							
							</caption>

							<thead class="c-table__head c-table__head--slim">
								<tr class="c-table__row">
									<th class="c-table__cell c-table__cell--head">Nama Group</th>
									<th class="c-table__cell c-table__cell--head">Anggota</th>
									<th class="c-table__cell c-table__cell--head no-sort">Option</th>
								</tr>
							</thead>

							<tbody>
								<?php  
								// fields = administrator
								$url = "https://graph.facebook.com/me/groups?fields=name,members.limit(0).summary(true)&access_token={$_SESSION['token']}";

								$curl = file_get_contents_curl($url);
								$result = json_decode($curl);
								?>
								<?php
								foreach ($result->data as $row) {	
									echo "
									<tr class='c-table__row odd'>	
										<td class='c-table__cell'>". $row->name."</td>
										<td class='c-table__cell'>". number_format($row->members->summary->total_count)."</td>
										<td class='c-table__cell'><a class='c-btn c-btn--info' href='?module=multipledeletepostgroup&groupname=".$row->name."&groupid=".$row->id."&limit=10'>Pilih</a></td>
									</tr>
									";	
								}								
								?>
							</tbody>
						</table>
					</div>	
				<?php endif ?>				

				<div class="c-field u-mt-small">
					<input data-post='multipledeletepostgroup' class="c-btn c-btn--info" type="submit" value="Submit">
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