<div class="col-md-12">
	<div class="c-card c-card--responsive u-mb-medium">
		<div class="c-card__header c-card__header--transparent o-line">            
			<h5 class="c-card__title">			
				Cari Nama Grup
			</h5>
		</div>
		<div class="c-card__body">	

			<form class='formtablecheckbox' method="post">

				<div class="c-field has-addon-right u-mb-small">
					<input class="c-input" type="text" name="query" placeholder="Input Query" value="<?= (!empty($_GET['q']) ? $_GET['q'] : '') ?>">
					<span class="c-field__addon">
						<button type="button" class="getquery c-btn c-btn--info" style="border-left: 0; border-top-left-radius: 0; border-bottom-left-radius: 0; ">Search</button>
					</span>
				</div>

				<?php if (@$_GET['q']): ?>
					<div class="c-table-responsive@desktop u-mb-medium" style="overflow: hidden">
						<table class="c-table datatablecheckbox">
							<caption class="c-table__title">							
							</caption>

							<thead class="c-table__head c-table__head--slim">
								<tr class="c-table__row">
									<th class="c-table__cell c-table__cell--head"></th>
									<th class="c-table__cell c-table__cell--head">Nama Grup</th>
									<th class="c-table__cell c-table__cell--head">Privasi</th>
									<th class="c-table__cell c-table__cell--head">Anggota</th>
									<th class="c-table__cell c-table__cell--head no-sort">URL</th>
								</tr>
							</thead>

							<tbody>
								<?php  					
								$q = urlencode($_GET['q']);
								$url = "https://graph.facebook.com/search?q={$q}&fields=members.limit(0).summary(true),name,privacy&type=group&access_token={$_SESSION['token']}";
								$curl = file_get_contents_curl($url);
								$result = json_decode($curl);
								?>
								<?php
								foreach ($result->data as $row) {	
									echo "
									<tr class='c-table__row odd'>	
										<td class='c-table__cell' style='width:5%'>".$row->id."</td>
										<td class='c-table__cell' title='".$row->name."'>".truncate($row->name,25)."</td>
										<td class='c-table__cell'>".$row->privacy."</td>
										<td class='c-table__cell'>".number_format($row->members->summary->total_count)."</td>
										<td class='c-table__cell'><a class='c-btn c-btn--success' target='_blank' href='https://fb.com/".$row->id."'>Kunjungi</a></td>
									</tr>
									";
								}
								?>
							</tbody>
						</table>
					</div>							

					<div class="c-field u-mt-small">
						<input data-post='joingroup' class="c-btn c-btn--info" type="submit" value="Submit">
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