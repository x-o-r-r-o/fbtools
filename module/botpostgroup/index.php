<div class="col-md-12">
	<div class="c-card c-card--responsive u-mb-medium">
		<div class="c-card__header c-card__header--transparent o-line">            
			<h5 class="c-card__title">			
				Pengaturan Bot Post Group
			</h5>
		</div>
		<div class="c-card__body">	

			<form class="formbotpostgroup" method="post">
				<div class="row">
					<div class="col-md-6">

						<div class="c-field u-mb-small">
							<label class="c-field__label">Status Aktif : </label>
							<?php  
							$sql = "SELECT status FROM tb_bot_postgroup WHERE userid='$_SESSION[userid]'";
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
							<label class="c-field__label"><b>Status yang ingin dibagikan : </b></label>
							<textarea class="c-input" name="message" rows="5" cols="50" placeholder="Insert Message" required="">{hai|hallo|hei hei|ok} {semuanya|kawan-kawan|anggota group} {bagaimana kabarnya|bagaimana keadaanmu sekarang|apakah kalian sehat} ?</textarea>
						</div>

						<div class="c-field u-mb-small">
							<label class="c-field__label"><b>Pengaturan Waktu Posting : </b></label>
							<select id="setting_time" class="c-select" name="time">
								<option value="setting_jam">Jam</option>							
								<option value="setting_hari">Hari</option>
								<option value="setting_minggu">Minggu</option>
							</select>
						</div>
					</div>	

					<div class="col-md-6">

						<div id="setting_jam">
							<div class="c-alert c-alert--info u-mb-medium">
								<i class="c-alert__icon fa fa-check-info"></i> Untuk Post Perjam Jangan Terlalu Banyak Atau akun Anda Terkunci !
							</div>

							<div class="c-field u-mb-medium">
								<label class="c-field__label" for="selectjam">Pilih Jam Posting</label>

								<select name="jam[]" class="c-select c-select--multiple" id="selectjam">
									<?php
									for ($i=1; $i <= 24 ; $i++) { 
										echo "<option value='".date('H',mktime($i,00,00))."'>".date('H A', mktime($i,0,0))."</option>";
									}					
									?>
								</select>
							</div>
						</div>

						<div id="setting_hari" style="display: none">
							<div class="c-alert c-alert--info u-mb-medium">
								<i class="c-alert__icon fa fa-check-info"></i> Silahkan Atur Jam Untuk Mempostingnya
							</div>

							<div class="c-field u-mb-medium">
								<label class="c-field__label">Pilih Jam Posting :</label>

								<select name="jam_hari" class="c-select">
									<?php
									for ($i=1; $i <= 24 ; $i++) { 
										echo "<option value='".date('H',mktime($i,00,00))."'>".date('H A', mktime($i,0,0))."</option>";
									}					
									?>
								</select>
							</div>
						</div>

						<div id="setting_minggu" style="display: none">
							<div class="c-alert c-alert--info u-mb-medium">
								<i class="c-alert__icon fa fa-check-info"></i> Silahkan Atur Hari Untuk Mempostingnya
							</div>

							<div class="c-field u-mb-medium">
								<label class="c-field__label" for="selecthari">Pilih Hari Posting :</label>

								<select name="hari[]" class="c-select c-select--multiple" id="selecthari">
									<?php 
									if (1 == date('N')){
										$monday = time();
									}else{
										$monday = strtotime('last Monday');
									}

									for ($i = 0; $i < 7; $i++){
										echo "<option value='". date('l', $monday)."'>". dateid(date('l', $monday),'l','')."</option>";
										$monday = strtotime('tomorrow', $monday);
									}
									?>
								</select>
							</div>

							<div class="c-field u-mb-medium">
								<label class="c-field__label">Pilih Jam Posting :</label>

								<select name="jam_minggu" class="c-select">
									<?php
									for ($i=1; $i <= 24 ; $i++) { 
										echo "<option value='".date('H',mktime($i,00,00))."'>".date('H A', mktime($i,0,0))."</option>";
									}					
									?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-md-12">
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

						<div class="c-field u-mb-small">
							<input class="c-btn c-btn--info" name="botpostgroup" type="submit" value="Submit">
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