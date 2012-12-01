<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>
    
	  <form action="<?php echo url_for('item_new_by_shortcut', array()) ?>" method="post">
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
	      
	      	<!-- Warning :  Customizar la renderizacion del formulario, que se escriban en <tr><td>
	      	     parecido a como se renderiza el formulario de filtros
	      	-->
	      	
	        <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      			<?php include_partial('item/form_fieldset', array('item' => $item, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
			<?php endforeach; ?>
	      </tbody>
	    </table>
	  </form>
</div>
