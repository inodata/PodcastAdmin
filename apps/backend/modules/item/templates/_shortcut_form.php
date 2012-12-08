<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
    
	 <?php echo form_tag_for($form, '@item_by_shortcut') ?>
	  <?php echo $form->renderHiddenFields(false) ?>
	  <?php if ($form->hasGlobalErrors()): ?>
      	<?php echo $form->renderGlobalErrors() ?>
      <?php endif; ?>
	    <table cellspacing="0">
	      <tfoot>
	        <tr>
	          <td colspan="2">
	            <?php echo $form->renderHiddenFields() ?>
	            <input type="submit" value="<?php echo __('Upload Item', array(), 'sf_admin') ?>" />
	          </td>
	        </tr>
	      </tfoot>
	      <tbody>
	      	<tr>
				<td><?php echo $form['channel_id']->renderLabel()?></td>
				<td><?php echo $form['channel_id']->render()?></td>
			</tr>
			<tr>
				<td><?php echo $form['file']->renderLabel()?></td>
				<td><?php echo $form['file']->render()?></td>
			</tr>
	      </tbody>
	    </table>
	  </form>
</div>
