<?php use_helper('I18N', 'Date') ?>
<?php include_partial('channel/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New Channel', array(), 'messages') ?></h1>

  <?php include_partial('channel/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('channel/form_header', array('channel' => $channel, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('item/shortcut_form', array('item' => null, 'form' => $itemShortcutForm, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>
  
  <div id="sf_admin_content">
    <?php include_partial('channel/form', array('channel' => $channel, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('channel/form_footer', array('channel' => $channel, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
