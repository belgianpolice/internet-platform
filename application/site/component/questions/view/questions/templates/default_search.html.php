<?
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<div class="well">
    <form action="<?=route('option=com_questions&view=questions&Itemid=67')?>" method="get" class="form-search" style="margin-bottom: 0;">
        <input id="searchword" name="searchword" class="" style="width: 80%" type="text"
               value="<?=escape($state->searchword)?>" placeholder="<?=translate('Search')?> ..."/>
        <button type="submit" class="btn btn-primary"><?= translate('Search') ?></button>
    </form>
</div>