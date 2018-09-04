<!-- <h4 class="c-sidebar__title">Halaman</h4> -->

<li class="c-sidebar__item">
	<a class="c-sidebar__link dashboard" href="./">
		<i class="fa fa-home u-mr-xsmall"></i>Dashboard
	</a>
</li>

<?php if (!empty($_SESSION['masuk'])): ?>
	<li class="c-sidebar__item">
		<a class="c-sidebar__link" href="?module=multiplepost">
			<i class="fa fa-send u-mr-xsmall"></i>
			Multiple Post
		</a>
	</li> 		
	<li class="c-sidebar__item">
		<a class="c-sidebar__link" href="?module=multipledeletestatus">
			<i class="fa fa-trash u-mr-xsmall"></i>
			Multiple Delete Status
		</a>
	</li> 
	<li class="c-sidebar__item">
		<a class="c-sidebar__link" href="?module=bomlike">
			<i class="fa fa-thumbs-o-up u-mr-xsmall"></i>
			Bom Like
		</a>
	</li> 
	<li class="c-sidebar__item">
		<a class="c-sidebar__link" href="?module=addfriend">
			<i class="fa fa-user-plus u-mr-xsmall"></i>
			Add Friend
		</a>
	</li> 
	<li class="c-sidebar__item">
		<a class="c-sidebar__link" href="?module=multipleunfriend">
			<i class="fa fa-user-times u-mr-xsmall"></i>
			Multiple Unfriend
		</a>
	</li> 
	<li class="c-sidebar__item">
		<a class="c-sidebar__link" href="?module=friendrequest">
			<i class="fa fa-users u-mr-xsmall"></i>
			Friend Request
		</a>
	</li> 
	<li class="c-sidebar__item">
		<a class="c-sidebar__link" href="?module=joingroup">
			<i class="fa fa-group u-mr-xsmall"></i>
			Join Group
		</a>
	</li> 
	<li class="c-sidebar__item">
		<a class="c-sidebar__link" href="?module=multipleleavegroup">
			<i class="fa fa-trash u-mr-xsmall"></i>
			Multiple Leave Group
		</a>
	</li> 
	<li class="c-sidebar__item">
		<a class="c-sidebar__link" href="?module=multipledeletepostgroup">
			<i class="fa fa-trash u-mr-xsmall"></i>
			Multiple Delete Post Group
		</a>
	</li> 
	<li class="c-sidebar__item">
		<a class="c-sidebar__link" href="?module=multiplecomment">
			<i class="fa fa-comments-o u-mr-xsmall"></i>
			Multiple Comment
		</a>
	</li> 
	<li class="c-sidebar__item">
		<a class="c-sidebar__link" href="?module=profileguard">
			<i class="fa fa-shield u-mr-xsmall"></i>
			Profile Guard
		</a>
	</li> 
	<li class="c-sidebar__item">
		<a class="c-sidebar__link" href="?module=botreaction">
			<i class="fa fa-smile-o u-mr-xsmall"></i>
			Bot Reaction
		</a>
	</li> 	
	<li class="c-sidebar__item">
		<a class="c-sidebar__link" href="?module=botpostgroup">
			<i class="fa fa-send u-mr-xsmall"></i>
			Bot Post Group
		</a>
	</li> 					 	
<?php endif ?>

<?php if (empty($_SESSION['masuk'])): ?>
	<li class="c-sidebar__item">
		<a class="c-sidebar__link" href="?module=masuk">
			<i class="fa fa-sign-in u-mr-xsmall"></i>Masuk
		</a>
	</li>
<?php else: ?>

<li class="c-sidebar__item">
	<a class="c-sidebar__link" href="?module=laporan">
		<i class="fa fa-clock-o u-mr-xsmall"></i>Table Laporan
	</a>
</li>

<?php endif ?>

<li class="c-sidebar__item">
	<a class="c-sidebar__link" href="?module=changelog">
		<i class="fa fa-bug u-mr-xsmall"></i>Changelog
	</a>
</li>

<li class="c-sidebar__item">
	<a class="c-sidebar__link" href="?module=tentangaplikasi">
		<i class="fa fa-info-circle u-mr-xsmall"></i>Tentang Aplikasi
	</a>
</li>