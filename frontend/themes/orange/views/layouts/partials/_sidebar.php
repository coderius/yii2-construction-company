<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\components\helpers\TextHelper;

/* @var $this yii\web\View */
// var_dump($sidebar->randomPost);
?>

<!-- Sidebar -->
<div class="col-lg-4">
    <div class="sidebar">

        <?php if($sidebar->hasSearchForm()): ?>
        <div class="sidebar-widget wow fadeInUp">
            <div class="search-widget">
                <form>
                    <input class="form-control" type="text" placeholder="Search Keyword">
                    <button class="btn"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <?php endif; ?>

        <?php if($sidebar->hasRecentPosts()): ?>
            <!-- RecentPosts -->
        <div class="sidebar-widget wow fadeInUp">
            <h2 class="widget-title">Новые посты</h2>
            <div class="recent-post">
                <?php foreach($sidebar->recentPosts as $recentPost): ?>
                <div class="post-item">
                    <div class="post-img">
                    <?= Html::img("@blogPostHeaderPicsWeb/{$recentPost->id}/small/{$recentPost->img}"); ?>
                    </div>
                    <div class="post-text">
                        <?= Html::a(TextHelper::truncate($recentPost->header1, 150), ['blog/article', 'alias' => $recentPost->alias]); ?>
                        <div class="post-meta">
                            <p>By<?= Html::a($recentPost->createdBy0->username, ['#']); ?></p>
                            <p>In<?= Html::a($recentPost->category->header, ['blog/category', 'alias' => $recentPost->category->alias]); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- ./RecentPosts -->
        <?php endif; ?>

        <?php if($sidebar->hasRandomPostsPics() && $postPic = $sidebar->nextRandomPostsPics()): ?>
        <div class="sidebar-widget wow fadeInUp">
            <div class="image-widget">
                <a href="<?= Url::toRoute(['blog/article', 'alias' => $postPic->alias]); ?>"><?= Html::img("@blogPostHeaderPicsWeb/{$postPic->id}/middle/{$postPic->img}"); ?></a>
            </div>
        </div>
        <?php endif; ?>

        <div class="sidebar-widget wow fadeInUp">
            <div class="tab-post">
                <ul class="nav nav-pills nav-justified">
                    <?php if($sidebar->hasPopularPosts()): ?>
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#popular">Популярные</a>
                    </li>
                    <?php endif; ?>

                    <?php if($sidebar->hasRandomPosts()): ?>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#random">Случайные</a>
                    </li>
                    <?php endif; ?>

                    <?php if($sidebar->hasRecentPosts()): ?>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#latest">Новые</a>
                    </li>
                    <?php endif; ?>
                </ul>

                <div class="tab-content">
                <?php if($sidebar->hasPopularPosts()): ?>
<!-- Популярные -->
                    <div id="popular" class="container tab-pane active">
                        <?php foreach($sidebar->popularPosts as $post): ?>
                        <div class="post-item">
                            <div class="post-img">
                            <?= Html::img("@blogPostHeaderPicsWeb/{$post->id}/small/{$post->img}"); ?>
                            </div>
                            <div class="post-text">
                            <?= Html::a(TextHelper::truncate($post->header1, 150), ['blog/article', 'alias' => $post->alias]); ?>
                                <div class="post-meta">
                                    <p>By<?= Html::a($post->createdBy0->username, ['#']); ?></p>
                                    <p>In<?= Html::a($post->category->header, ['blog/category', 'alias' => $post->category->alias]); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
<!-- ./Популярные -->
                <?php endif; ?>

                <?php if($sidebar->hasRandomPosts()): ?>
<!-- Случайные -->
                    <div id="random" class="container tab-pane fade">
                        <?php foreach($sidebar->randomPosts as $post): ?>
                        <div class="post-item">
                            <div class="post-img">
                            <?= Html::img("@blogPostHeaderPicsWeb/{$post->id}/small/{$post->img}"); ?>
                            </div>
                            <div class="post-text">
                            <?= Html::a(TextHelper::truncate($post->header1, 150), ['blog/article', 'alias' => $post->alias]); ?>
                                <div class="post-meta">
                                    <p>By<?= Html::a($post->createdBy0->username, ['#']); ?></p>
                                    <p>In<?= Html::a($post->category->header, ['blog/category', 'alias' => $post->category->alias]); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
<!-- ./Случайные -->
                <?php endif; ?>

                <?php if($sidebar->hasRecentPosts()): ?>
<!-- Новые -->
                    <div id="latest" class="container tab-pane fade">
                        <?php foreach($sidebar->recentPosts as $post): ?>
                        <div class="post-item">
                            <div class="post-img">
                            <?= Html::img("@blogPostHeaderPicsWeb/{$post->id}/small/{$post->img}"); ?>
                            </div>
                            <div class="post-text">
                            <?= Html::a(TextHelper::truncate($post->header1, 150), ['blog/article', 'alias' => $post->alias]); ?>
                                <div class="post-meta">
                                    <p>By<?= Html::a($post->createdBy0->username, ['#']); ?></p>
                                    <p>In<?= Html::a($post->category->header, ['blog/category', 'alias' => $post->category->alias]); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
<!-- ./Новые -->
                <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if($sidebar->hasRandomPostsPics() && $postPic = $sidebar->nextRandomPostsPics()): ?>
        <div class="sidebar-widget wow fadeInUp">
            <div class="image-widget">
                <a href="<?= Url::toRoute(['blog/article', 'alias' => $postPic->alias]); ?>"><?= Html::img("@blogPostHeaderPicsWeb/{$postPic->id}/middle/{$postPic->img}"); ?></a>
            </div>
        </div>
        <?php endif; ?>

        <?php if($sidebar->hasCategories()): ?>
<!-- Categories -->
        <div class="sidebar-widget wow fadeInUp">
            <h2 class="widget-title">Категории</h2>
            <div class="category-widget">
                <ul>
                <?php foreach($sidebar->categories as $cat): ?>
                    <li>
                    <?= Html::a(TextHelper::truncate($cat->header, 150), ['blog/category', 'alias' => $cat->alias]); ?>
                    <span>(<?= $cat->surrogateArticleCount; ?>)</span>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
<!-- ./Categories -->
        <?php endif; ?>

        <?php if($sidebar->hasRandomPostsPics() && $postPic = $sidebar->nextRandomPostsPics()): ?>
        <div class="sidebar-widget wow fadeInUp">
            <div class="image-widget">
                <a href="<?= Url::toRoute(['blog/article', 'alias' => $postPic->alias]); ?>"><?= Html::img("@blogPostHeaderPicsWeb/{$postPic->id}/middle/{$postPic->img}"); ?></a>
            </div>
        </div>
        <?php endif; ?>

        <?php if($sidebar->hasTagsCloud()): ?>
        <div class="sidebar-widget wow fadeInUp">
            <h2 class="widget-title">Облако тегов</h2>
            <div class="tag-widget">
            <?php foreach($sidebar->tagsCloud as $tag): ?>
                <?= Html::a(
                    TextHelper::truncate($tag->header, 150), 
                    ['blog/tag', 'alias' => $tag->alias],
                    ["data-toggle" => "tooltip", "data-placement" => "top", "title" => "материалов: {$tag->surrogateArticleCount}"]
                ); ?>
            <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if($sidebar->hasPopularPostText()): ?>
        <div class="sidebar-widget wow fadeInUp">
            <h2 class="widget-title">Популярное.</h2>
            <div class="text-widget">
                <p>
                    <?= TextHelper::truncate($sidebar->popularPostText->text, 200); ?>
                </p>
                <i><?= Html::a("Подробнее...", ['blog/article', 'alias' => $sidebar->popularPostText->alias]); ?></i>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<!-- ./Sidebar -->