<div class="col-md-12">
	<?php if (!empty($_SESSION['masuk'])): ?>
		<div class="c-alert c-alert--info u-mb-medium">
			<i class="c-alert__icon fa fa-check-circle"></i> Selamat Datang di <?= $settings['title']; ?> !
		</div>
	<?php else: ?>
		<div class="c-card c-card--responsive u-mb-medium">
			<div class="c-card__header c-card__header--transparent o-line">
				<h5 class="c-card__title">Fitur <?= $settings['title'] ?></h5>
			</div>
			<div class="c-card__body">

				<div class="row">
					<div class="col-sm-12 col-lg-6 col-xl-3">
						<div class="c-state-card" data-mh="state-cards" style="height: 100px;">
							<div class="c-state-card__icon c-state-card__icon--info">
								<i class="fa fa-send"></i>
							</div>

							<div class="c-state-card__content">
								<h5 class="c-state-card__meta">Multiple Post </h5>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6 col-xl-3">
						<div class="c-state-card" data-mh="state-cards" style="height: 100px;">
							<div class="c-state-card__icon c-state-card__icon--success">
								<i class="fa fa-trash"></i>
							</div>

							<div class="c-state-card__content">
								<h5 class="c-state-card__meta">Multiple Delete Status </h5>
							</div>
						</div>
					</div>					
					<div class="col-sm-12 col-lg-6 col-xl-3">
						<div class="c-state-card" data-mh="state-cards" style="height: 100px;">
							<div class="c-state-card__icon c-state-card__icon--warning">
								<i class="fa fa-thumbs-o-up"></i>
							</div>

							<div class="c-state-card__content">
								<h5 class="c-state-card__meta">Bom Like </h5>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6 col-xl-3">
						<div class="c-state-card" data-mh="state-cards" style="height: 100px;">
							<div class="c-state-card__icon c-state-card__icon--fancy">
								<i class="fa fa-user-plus"></i>
							</div>

							<div class="c-state-card__content">
								<h5 class="c-state-card__meta">Add Friend </h5>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6 col-xl-3">
						<div class="c-state-card" data-mh="state-cards" style="height: 100px;">
							<div class="c-state-card__icon c-state-card__icon--info">
								<i class="fa fa-user-times"></i>
							</div>

							<div class="c-state-card__content">
								<h5 class="c-state-card__meta">Multiple Unfriend </h5>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6 col-xl-3">
						<div class="c-state-card" data-mh="state-cards" style="height: 100px;">
							<div class="c-state-card__icon c-state-card__icon--success">
								<i class="fa fa-users"></i>
							</div>

							<div class="c-state-card__content">
								<h5 class="c-state-card__meta">Friend Request </h5>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6 col-xl-3">
						<div class="c-state-card" data-mh="state-cards" style="height: 100px;">
							<div class="c-state-card__icon c-state-card__icon--warning">
								<i class="fa fa-group"></i>
							</div>

							<div class="c-state-card__content">
								<h5 class="c-state-card__meta">Join Group </h5>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6 col-xl-3">
						<div class="c-state-card" data-mh="state-cards" style="height: 100px;">
							<div class="c-state-card__icon c-state-card__icon--fancy">
								<i class="fa fa-trash"></i>
							</div>

							<div class="c-state-card__content">
								<h5 class="c-state-card__meta">Multiple Leave Group </h5>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6 col-xl-3">
						<div class="c-state-card" data-mh="state-cards" style="height: 100px;">
							<div class="c-state-card__icon c-state-card__icon--info">
								<i class="fa fa-trash"></i>
							</div>

							<div class="c-state-card__content">
								<h5 class="c-state-card__meta">Multiple Delete Post Group </h5>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6 col-xl-3">
						<div class="c-state-card" data-mh="state-cards" style="height: 100px;">
							<div class="c-state-card__icon c-state-card__icon--success">
								<i class="fa fa-comments-o"></i>
							</div>

							<div class="c-state-card__content">
								<h5 class="c-state-card__meta">Multiple Comment </h5>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6 col-xl-3">
						<div class="c-state-card" data-mh="state-cards" style="height: 100px;">
							<div class="c-state-card__icon c-state-card__icon--warning">
								<i class="fa fa-shield"></i>
							</div>

							<div class="c-state-card__content">
								<h5 class="c-state-card__meta">Profile Guard </h5>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6 col-xl-3">
						<div class="c-state-card" data-mh="state-cards" style="height: 100px;">
							<div class="c-state-card__icon c-state-card__icon--fancy">
								<i class="fa fa-smile-o"></i>
							</div>

							<div class="c-state-card__content">
								<h5 class="c-state-card__meta">Bot Reaction </h5>
							</div>
						</div>
					</div>					
				</div>
			</div>
		</div>
	<?php endif ?>
</div>

<?php if (!empty($_SESSION['masuk'])): ?>

	<div class="col-md-12">
		<span class="c-divider has-text u-mb-medium">Status Aplikasi</span>
	</div>

	<?php  
	$sqluser = "SELECT status FROM tb_bot_reaction WHERE userid='$_SESSION[userid]'";
	$result = $mysql->query($sqluser);
	$read = $result->fetch_assoc();
	if ($read['status'] == 'on') {
		$reaction = '<span class="c-badge c-badge--success">on</span>';
	}else {
		$reaction = '<span class="c-badge c-badge--danger">off</span>';
	}
	?>
	<div class="col-xl-6">
		<div class="c-graph-card" data-mh="graph-cards">
			<div class="c-graph-card__content">
				<h3 class="c-graph-card__title">Bot Reaction</h3>			
				<h4 class="c-graph-card__number"><?= $reaction  ?></h4>
				<p class="c-graph-card__status">Status Bot Reaction anda</p>
			</div>

			<div class="c-graph-card__chart">
				<canvas id="js-chart-payout" width="300" height="74"></canvas>
			</div>
		</div>
	</div>

	<?php  
	$sqlprocess = "SELECT count(*) as jumlahproses FROM tb_laporan WHERE userid='$_SESSION[userid]'";
	$result = $mysql->query($sqlprocess);
	$read = $result->fetch_assoc();
	?>
	<div class="col-xl-6">
		<div class="c-graph-card" data-mh="graph-cards">
			<div class="c-graph-card__content">
				<h3 class="c-graph-card__title">Jumlah Proses Berjalan</h3>			
				<h4 class="c-graph-card__number"><?= $read['jumlahproses'] ?></h4>
				<p class="c-graph-card__status"><?= $read['jumlahproses'] ?> Proses telah Berjalan Untuk Anda</p>
			</div>

			<div class="c-graph-card__chart">
				<canvas id="js-chart-earnings" width="300" height="74"></canvas>
			</div>
		</div>
	</div>

<?php else: ?>


	<div class="col-md-12">
		<span class="c-divider has-text u-mb-medium">Status Aplikasi</span>
	</div>

	<?php  
	$sqluser = "SELECT count(*) as userterdaftar FROM tb_user";
	$result = $mysql->query($sqluser);
	$read = $result->fetch_assoc();
	?>
	<div class="col-xl-6">
		<div class="c-graph-card" data-mh="graph-cards">
			<div class="c-graph-card__content">
				<h3 class="c-graph-card__title">User Terdaftar</h3>			
				<h4 class="c-graph-card__number"><?= $read['userterdaftar'] ?></h4>
				<p class="c-graph-card__status"><?= $read['userterdaftar'] ?> User Terdaftar di aplikasi ini</p>
			</div>

			<div class="c-graph-card__chart">
			</div>
		</div>
	</div>

	<?php  
	$sqlprocess = "SELECT count(*) as jumlahproses FROM tb_laporan";
	$result = $mysql->query($sqlprocess);
	$read = $result->fetch_assoc();
	?>
	<div class="col-xl-6">
		<div class="c-graph-card" data-mh="graph-cards">
			<div class="c-graph-card__content">
				<h3 class="c-graph-card__title">Total Jumlah Proses Berjalan</h3>			
				<h4 class="c-graph-card__number"><?= $read['jumlahproses'] ?></h4>
				<p class="c-graph-card__status"><?= $read['jumlahproses'] ?> Proses telah Berjalan di Aplikasi ini</p>
			</div>

			<div class="c-graph-card__chart">	
			</div>
		</div>
	</div>

	<?php  
	$sqluser = "SELECT count(*) as useraktif FROM tb_bot_reaction";
	$result = $mysql->query($sqluser);
	$read = $result->fetch_assoc();
	?>
	<div class="col-xl-6">
		<div class="c-graph-card" data-mh="graph-cards">
			<div class="c-graph-card__content">
				<h3 class="c-graph-card__title">User Aktif Menggunakan Bot</h3>			
				<h4 class="c-graph-card__number"><?= $read['useraktif'] ?></h4>
				<p class="c-graph-card__status"><?= $read['useraktif'] ?> User Aktif Menggunakan Bot di aplikasi ini</p>
			</div>

			<div class="c-graph-card__chart">
			</div>
		</div>
	</div>

	<?php  
	$sqlprocess = "SELECT count(*) as jumlahproses FROM tb_laporan WHERE type='Bot Reaction'";
	$result = $mysql->query($sqlprocess);
	$read = $result->fetch_assoc();
	?>
	<div class="col-xl-6">
		<div class="c-graph-card" data-mh="graph-cards">
			<div class="c-graph-card__content">
				<h3 class="c-graph-card__title">Jumlah Proses Bot Berjalan</h3>			
				<h4 class="c-graph-card__number"><?= $read['jumlahproses'] ?></h4>
				<p class="c-graph-card__status"><?= $read['jumlahproses'] ?> Proses telah Berjalan di Aplikasi ini</p>
			</div>

			<div class="c-graph-card__chart">			
			</div>
		</div>
	</div>
<?php endif ?>