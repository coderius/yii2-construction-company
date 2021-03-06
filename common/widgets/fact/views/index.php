<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

/**
 * In one row has two items
 * Find count rows and each row has two cols
 * Counter needed for get key in array model and print some result in current column.
 */
$countModel = count($model);
$rows = ceil($countModel / 2);

?>

<?php if($model): ?>
<!-- Fact Start -->
<div class="fact">
    <div class="container-fluid">
        <div class="row counters">
        <?php $counter = 0; ?>
        <?php for($j=1; $j<=$rows; $j++): ?>
            <div class="col-md-6 fact-<?= $j % 2 == 0 ? 'left' : 'right'; ?> wow slideIn<?= $j % 2 == 0 ? 'Left' : 'Right'; ?>">
                <div class="row">
                <?php for($x=0; $x<2; $x++): ?>
                    <div class="col-6">
                        <div class="fact-icon">
                            <?= $model[$counter]->icon; ?>
                        </div>
                        <div class="fact-text">
                            <h2 data-toggle="counter-up"><?= $model[$counter]->header; ?></h2>
                            <p><?= $model[$counter]->text; ?></p>
                        </div>
                    </div>
                    <?php $counter++; ?>
                <?php endfor; ?>
                </div>
            </div>
        <?php endfor; ?>
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