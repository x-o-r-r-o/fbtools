<div class="col-md-12">
    <div class="c-card u-p-medium u-mb-medium">

        <div class="u-text-center">
            <div class="c-avatar c-avatar--large u-mb-small u-inline-flex">
                <img class="c-avatar__img" src="<?= $_SESSION['picture'] ?>" alt="Adam's Face">
            </div>
        </div>

        <table class="c-table u-text-left u-pv-small u-mt-medium u-border-right-zero u-border-left-zero">
            <tr>
                <td style="width:20%">User Id</td>
                <td style="width: 1%">:</td>
                <td style="padding: 5px;"><input onclick="this.select()" readonly="" class="c-input" type="text" value="<?= $_SESSION['userid']; ?>"></td>
            </tr>   
            <tr>
                <td style="width:20%">Name</td>
                <td style="width: 1%">:</td>
                <td style="padding: 5px;"><input onclick="this.select()" readonly="" class="c-input" type="text" value="<?= $_SESSION['name']; ?>"></td>
            </tr>   
            <tr>
                <td style="width:20%">Token</td>
                <td style="width: 1%">:</td>
                <td style="padding: 5px;"><input onclick="this.select()" readonly="" class="c-input" type="text" value="<?= $_SESSION['token']; ?>"></td>
            </tr>     
        </table>

        <div class="u-pt-medium u-text-center">
            <a target="_blank" class="u-text-mute u-text-small" href="https://facebook.com/<?= $_SESSION['userid'] ?>">
                <i class="fa fa-globe u-mr-xsmall"></i>https://facebook.com/<?= $_SESSION['userid'] ?>
            </a>
        </div>
    </div>
</div>