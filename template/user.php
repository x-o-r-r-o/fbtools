<?php if (!empty($_SESSION['masuk'])): ?>
    <div class="c-dropdown dropdown u-ml-small">
        <a  class="c-avatar c-avatar--xsmall has-dropdown dropdown-toggle" href="#" id="dropdwonMenuAvatar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="c-avatar__img" src="<?= $_SESSION['picture'] ?>" alt="User's Profile Picture">
        </a>

        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuAvatar">
            <a class="c-dropdown__item dropdown-item" href="?module=userinfo"> <i class="fa fa-user-o"></i> User Info
            </a>
            <a class="c-dropdown__item dropdown-item" href="?module=changelog"> <i class="fa fa-bug"></i> Changelog
            </a>
            <a class="c-dropdown__item dropdown-item" href="?module=tentangaplikasi"> <i class="fa fa-info-circle"></i> Tentang Aplikasi
            </a>
            <a class="c-dropdown__item dropdown-item" href="./keluar"> <i class="fa fa-sign-out"></i> 
                LogOut
            </a>
        </div>
    </div>
<?php else: ?>
    <div class="c-dropdown dropdown u-ml-small">
        <a class="c-notification dropdown-toggle" href="javascript:;" id="dropdownMenuAlerts" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="c-notification__icon">
                <i class="fa fa-info-circle"></i>
            </span>
        </a>

        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuAvatar">
            <a class="c-dropdown__item dropdown-item" href="?module=changelog"> <i class="fa fa-bug"></i> Changelog
            </a>
            <a class="c-dropdown__item dropdown-item" href="?module=tentangaplikasi"> <i class="fa fa-info-circle"></i> Tentang Aplikasi
            </a>
        </div>
    </div>
<?php endif ?>