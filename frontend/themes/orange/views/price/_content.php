<?php

$count = 1;

$js = <<< JS
$(document).ready(function () {
    $('.collapse')
        .on('shown.bs.collapse', function() {
            $(this)
                .parent()
                .find(".fa-plus")
                .toggleClass("box-rotate")
                .removeClass("fa-plus")
                .addClass("fa-minus",1000);
        })
        .on('hidden.bs.collapse', function() {
            $(this)
                .parent()
                .find(".fa-minus")
                .toggleClass("box-rotate")
                .removeClass("fa-minus")
                .addClass("fa-plus",1000);
        });
});

JS;

$this->registerJs($js);

$css = <<< CSS
.trans{
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}
.box-rotate {
  transform: rotate(360deg);
}
CSS;

$this->registerCss($css);

?>

<!-- <style>
.trans{
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}
.box-rotate {
  transform: rotate(360deg);
}
</style> -->


<?php if($price && !empty($price)): ?>

<div id="accordion">
    <?php foreach($price as $item): ?>
    <div class="card">
        <div class="card-header" id="headingOne" style="background-color:#fdbe33;cursor:pointer;" data-toggle="collapse" data-target="#collapse-<?= $count; ?>" aria-expanded="true" aria-controls="collapse-<?= $count; ?>">
            <h5 class="mb-0">
                <i class="fa fa-minus text-muted trans" aria-hidden="true"></i>
                <strong class="text-white">
                <?= $item->header; ?>
                </strong>
            </h5>
        </div>

        <?php if($item->prices): ?>
        
        <div id="collapse-<?= $count; ?>" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <!-- <div class="card-body"> -->
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                    <!-- <th scope="col">#</th> -->
                    <th scope="col">Наименование</th>
                    <th scope="col">Ед.изм.</th>
                    <th scope="col">Цена</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($item->prices as $row): ?>
                    <tr style="cursor:pointer;">
                    <!-- <th scope="row">1</th> -->
                        <td><?= $row->name; ?></td>
                        <td><?= $row->unit; ?></td>
                        <td><?= $row->equal . " " . $row->cost; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <!-- </div> -->
            
        </div>
        
        <?php endif; ?>
    </div>
    <?php $count++; ?>
    <?php endforeach; ?>
</div>

<?php endif; ?>