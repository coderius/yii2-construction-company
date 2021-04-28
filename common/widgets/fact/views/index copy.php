<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

?>
<?php if($model): ?>
<!-- Fact Start -->
<div class="fact">
    <div class="container-fluid">
        <div class="row counters">
        <?php $counter = 1; ?>
        <?php foreach($model as $key => $item): ?>
           
            <div class="col-md-6 fact-<?= $key%3 ? 'left': 'right'; ?> wow slideInLeft">
                <div class="row">
                    <div class="col-6">
                        <div class="fact-icon">
                            <?= $item->icon; ?>
                        </div>
                        <div class="fact-text">
                            <h2 data-toggle="counter-up"><?= $item->header; ?></h2>
                            <p><?= $item->text; ?></p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="fact-icon">
                            <?= $item->icon; ?>
                        </div>
                        <div class="fact-text">
                            <h2 data-toggle="counter-up"><?= $item->header; ?></h2>
                            <p><?= $item->text; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php $counter++; ?>
        <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Fact End -->
<?php endif; ?>

<?php

// $countModel = count($model);
// $rows = ceil($countModel / 2);

// for ($j=0; $j<$rows; $j++){
//     if($key % 2 != 0){
//         echo '';
//     }else{
//         echo '';
//     }
//     for ($x=0; $x<2; $x++){
//     echo $model[$x*$j];
//     }
// }

?>