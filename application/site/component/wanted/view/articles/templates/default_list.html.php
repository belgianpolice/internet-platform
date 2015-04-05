<?
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<meta content="noimageindex" name="robots" />

<ul class="cards clearfix">
    <? foreach ($articles as $article) : ?>
        <li class="card card--horizontal">
            <? if($article->solved): ?>
                <div class="card__box">
                    <img src="assets://wanted/images/solved.png" />

                    <span class="card__metadata">
                        <span class="card__metadata--inner">
                            <span class="card__name"><?= escape($article->title) ?></span>
                            <?= translate('The search warrant has been resolved') ?>.
                        </span>
                    </span>
                </div>
            <? else : ?>
                <a class="card__box" href="<?= helper('route.article', array('row' => $article)) ?>">
                    <div class="card__image card__image--wanted">
                        <? if($article->attachments_attachment_id) : ?>
                            <?= helper('com:police.image.thumbnail', array(
                                'attachment' => $article->attachments_attachment_id,
                                'attribs' => array('width' => '400', 'height' => '500'))) ?>
                        <? else : ?>
                            <img class="card__image" src="assets://found/images/placeholder.jpg" />
                        <? endif ?>
                    </div>

                    <div class="card__metadata">
                        <span class="card__name"><?= escape($article->title) ?></span>
                        <span class="card__date"><?= date(array('date' => $article->date, 'format' => 'd/m/Y')) ?>
                        <? if($article->params->get('place', false) || $article->city) : ?>
                            <span class="card__place"><?= $article->city ? $article->city : $article->params->get('place') ?></span>
                        <? endif ?>
                        </span>
                    </div>
                </a>
            <? endif ?>
        </li>
    <? endforeach; ?>
</ul>
