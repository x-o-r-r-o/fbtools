<div class="col-md-6">
    <div class="c-card c-card--responsive u-mb-medium">
        <div class="c-card__header c-card__header--transparent o-line">            
            <h5 class="c-card__title">Ambil Token Iphone</h5>
        </div>
        <div class="c-card__body">
            <form method="POST">
                <div class="c-field u-mb-small">
                    <input type="text" name="username" class="c-input" placeholder="Username" required="" />
                </div>
                <div class="c-field u-mb-small">
                   <input type="password" name="password" class="c-input" placeholder="Password" required="" />
               </div>
               <input class="c-btn c-btn--info c-btn--fullwidth" name="tokeniphone" type="submit" value="Submit"/>
           </form>
       </div>
   </div>
</div>

<div class="col-md-6">
    <div class="c-card c-card--responsive u-mb-medium">
        <div class="c-card__header c-card__header--transparent o-line">            
            <h5 class="c-card__title">Masuk Menggunakan Token Iphone</h5>
        </div>
        <div class="c-card__body">
            <form method="POST">
                <div class="c-field u-mb-small">
                    <textarea name="token" class="c-input" placeholder="Insert Token..." required=""></textarea>
                </div>
                <input class="c-btn c-btn--info c-btn--fullwidth" name="bytoken" type="submit" value="Submit"/>             
            </form>
        </div>
    </div>
</div>

<?php  
include "execute.php";
?>