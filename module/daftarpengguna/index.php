<div class="col-md-12">
	<div class="c-card c-card--responsive u-mb-medium">
		<div class="c-card__header c-card__header--transparent o-line">            
			<h5 class="c-card__title">			
				Daftar Pengguna Aplikasi ini
			</h5>
		</div>
		<div class="c-card__body">	

			<div class="c-table-responsive@desktop u-mb-medium" style="overflow: hidden">
				<table class="c-table datatable">
					<caption class="c-table__title">				
					</caption>

					<thead class="c-table__head c-table__head--slim">
						<tr class="c-table__row">
							<th class="c-table__cell c-table__cell--head">No</th>
							<th class="c-table__cell c-table__cell--head">Name</th>
							<th class="c-table__cell c-table__cell--head">Bot Reaction</th>
							<th class="c-table__cell c-table__cell--head">Bot Post Group</th>
						</tr>
					</thead>

					<tbody>
						<?php
						$sql = "SELECT tb_user.*, tb_user.userid as userid_tb_user, tb_bot_reaction.*, tb_bot_reaction.status as status_tb_bot_reaction, tb_bot_postgroup.*, tb_bot_postgroup.status as status_tb_bot_postgroup FROM tb_user LEFT JOIN tb_bot_reaction ON tb_user.userid=tb_bot_reaction.userid LEFT JOIN tb_bot_postgroup ON tb_user.userid=tb_bot_postgroup.userid ORDER BY tb_user.name ASC";
						$result = $mysql->query($sql);
						if ($result->num_rows > 0) {
							$no = 1;
							while($row = $result->fetch_assoc()) {
								if ($row['status_tb_bot_reaction'] == 'on') {
									$reaction = '<span class="c-badge c-badge--success">on</span>';
								}else {
									$reaction = '<span class="c-badge c-badge--danger">off</span>';
								}
								if ($row['status_tb_bot_postgroup'] == 'on') {
									$postgroup = '<span class="c-badge c-badge--success">on</span>';
								}else {
									$postgroup = '<span class="c-badge c-badge--danger">off</span>';
								}
								echo '
								<tr class="c-table__row">
									<td class="c-table__cell">'.$no++.'</td>
									<td class="c-table__cell">'.$row['name'].'</td>
									<td class="c-table__cell">'.$reaction.'</td>
									<td class="c-table__cell">'.$postgroup.'</td>
								</tr>
								';
							}
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>