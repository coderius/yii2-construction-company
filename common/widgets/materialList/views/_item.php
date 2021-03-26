<?php

/**
 * @package myblog
 * @file _item.php created 16.06.2018 18:25:58
 * 
 * @copyright Copyright (C) 2018 Sergio coderius <coderius>
 * @license This program is free software: GNU General Public License
 */

?>

<div class="linkbox-elem" data-link="<?php echo $linkPage; ?>">
    <?php if(isset($image)): ?>
    <div class="linkbox-elem-header">
        <?= $image; ?>
        <div class="fade-img"></div>
    </div>
    <?php endif; ?>
    
    <div class="linkbox-elem-footer">
        <?php if(isset($category)): ?>
        <p class="linkbox-elem-category">
            <a title="Смотреть всю категорию." href="<?= $linkCategory; ?>"><?= $category; ?></a>
        </p>
        <?php endif; ?>
        
        <?php if(isset($title)): ?>
        <p class="linkbox-elem-title">
            <a href="<?= $linkPage; ?>"><?= $title; ?></a>

        </p>
        <?php endif; ?>
        
        <?php if(isset($date)): ?>
        <p class="linkbox-elem-data">
            <span><?= $date; ?></span>
        </p>
        <?php endif; ?>
    </div>
</div>