<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<?= @helper('behavior.validator'); ?>

<!--
<script src="media://js/koowa.js" />
-->

<ktml:module position="toolbar">
    <?= @helper('toolbar.render', array('toolbar' => $toolbar))?>
</ktml:module>

<form action="" method="post" class="-koowa-form">
	<div class="main">
		<div class="scrollable">
			<fieldset>
				<legend><?= @text( 'Relation' ); ?></legend>
				<div>
				    <label for="">
				    	<?= @text( 'District' ); ?>
				    </label>
				    <div>
				        <?= @helper('listbox.districts', array('selected' => $relation->districts_district_id, 'deselect' => false, 'attribs' => array('class' => 'select-district', 'style' => 'width:100%'))) ?>
                        <script data-inline> $jQuery(".select-district").select2(); </script>
				    </div>
				</div>
				<div>
				    <label for="">
				    	<?= @text( 'Street' ); ?>
				    </label>
				    <div>
				        <?= @helper('com:streets.listbox.streets', array('autocomplete' => true, 'selected' => $relation->street_id, 'validate' => true)) ?>
				    </div>
				</div>
			</fieldset>
			<fieldset>
				<legend><?= @text( 'Exceptions' ); ?></legend>
				<div>
				    <label for="">
				    	<?= @text( 'Start' ); ?>
				    </label>
				    <div>
				        <input type="text" name="range_start" size="32" maxlength="250" value="<?= $relation->range_start; ?>" />
				    </div>
				</div>
				<div>
				    <label for="">
				    	<?= @text( 'End' ); ?>
				    </label>
				    <div>
				        <input type="text" name="range_end" size="32" maxlength="250" value="<?= $relation->range_end == null ? '9999' : $relation->range_end; ?>" />
				    </div>
				</div>
				<div>
				    <label for="">
				    	<?= @text( 'Parity' ); ?>
				    </label>
				    <div>
				        <?= @helper('listbox.parities', array('selected' => $relation->range_parity)) ?>
				    </div>
				</div>
			</fieldset>
		</div>
	</div>
</form>