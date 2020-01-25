<!-- Modal -->
<div class="modal fade" id="searchandrequestfriend" role="dialog">
<div class='modal-dialog'>
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Search and Request Friend</h4>
</div>
<div class="modal-body">

<textarea style="min-width:100%;max-width:100%;" cols="25" rows="10" readonly="">
//SCRIPT BY IGNIEL.COM
var igniel = document.querySelectorAll('[aria-label="Add Friend"]');
var rainerd = 0;
var alphabetees = setInterval(function()
{
rainerd += 1;
if (rainerd == 10) // JUMLAH TEMAN YANG AKAN DI ADD
{
clearInterval(alphabetees);
}
igniel[rainerd].click();
console.log("Berhasil Menambah " + rainerd + " Teman. Oleh: igniel.com");
[].forEach.call(document.querySelectorAll('a.autofocus'), function (bjita)
{
bjita.click();
});
[].forEach.call(document.querySelectorAll('button._42ft._4jy0.layerConfirm.uiOverlayButton._4jy3._4jy1.selected._51sy'), function (zerohero)
{
zerohero.click();
});

}, 2000); // DELAY 2 detik</textarea>				

</div>
</div>
</div>
</div>