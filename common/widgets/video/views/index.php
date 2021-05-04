<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

?>

<?php if($model): ?>
<!-- Video Start -->
<?php foreach($model as $k => $m): ?>
<div class="video wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <button type="button" class="btn-play" data-toggle="modal" data-src="<?= $m->video; ?>" data-target="#videoModal<?= $k; ?>">
            <span></span>
        </button>
    </div>
</div>

<div class="modal fade videoModal" id="videoModal<?= $k; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- 16:9 aspect ratio -->
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="<?= $m->video; ?>?autoplay=1&amp;modestbranding=1&amp;showinfo=0" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<!-- Video End -->
<?php endif; ?>