<?
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<?= @helper('behavior.validator'); ?>

<ktml:module position="toolbar">
    <?= @helper('toolbar.render', array('toolbar' => $toolbar))?>
</ktml:module>

<!--
<script src="media://js/koowa.js" />
-->

<form action="" method="post" class="-koowa-form">	
	<input type="hidden" name="published" value="0" />
	
	<div class="main">
        <div class="title">
            <input class="required" type="text" name="title" maxlength="255" value="<?= $article->title ?>" placeholder="<?= @text('Title') ?>" />
            <div class="slug">
                <span class="add-on">Slug</span>
                <input type="text" name="slug" maxlength="255" value="<?= $article->slug ?>" />
            </div>
        </div>
		
		<?= @object('com:wysiwyg.controller.editor')->render(array('name' => 'text', 'text' => $article->text)) ?>
	</div>
	<div class="sidebar">
		<div class="scrollable">
			<fieldset>
				<legend><?= @text('Publish') ?></legend>
				<div>
				    <label for="published"><?= @text('Published') ?></label>
				    <div>
				        <input type="checkbox" name="published" value="1" <?= $article->published ? 'checked="checked"' : '' ?> />
				    </div>
				</div>
			</fieldset>
            <fieldset>
                <legend><?= @text('Details') ?></legend>
                <div>
                    <label for="date">
                        <?= @text('Start on') ?>
                    </label>
                    <div class="controls-calendar">
                        <?= @helper('behavior.calendar', array('date' => $article->start_on, 'name' => 'start_on')); ?>
                        <input type="datetime-local" name="start_on" value="<?= $article->start_on ?>" />
                    </div>
                </div>
                <div>
                    <label for="date">
                        <?= @text('End on') ?>
                    </label>
                    <div class="controls-calendar">
                        <input type="datetime-local" name="end_on" value="<?= $article->end_on ?>" />
                    </div>
                </div>
            </fieldset>
            <fieldset class="categories group">
                <legend><?= @text('Category') ?></legend>
                <div>
                    <?= @helper('listbox.radiolist', array(
                        'list'     => @object('com:traffic.model.categories')->sort('title')->table('traffic')->getRowset(),
                        'selected' => $article->categories_category_id,
                        'name'     => 'categories_category_id',
                        'text'     => 'title',
                    ));
                    ?>
                </div>
            </fieldset>
            <fieldset>
                <legend><?= @text('Streets') ?></legend>
                    <?= @helper('com:streets.listbox.streets', array('selected' => $streets, 'deselect' => false, 'attribs' => array('multiple' => 'multiple', 'class' => 'select-streets', 'style' => 'width:100%;'))); ?>
                    <script data-inline> $jQuery(".select-streets").select2(); </script>
            </fieldset>
	    </div>
	</div>
</form>