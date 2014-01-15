<?php $plugin = apAuthSplashOnlyMain::getPlugin(); ?>
<?php echo __($plugin->getConfigValue('text_before', "")); ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2" style="text-align:center;">
          <?php echo $form->renderHiddenFields();?>
          <input type="submit" name="submit[apAuthSplashOnlyConnect]" value="<?php echo __($plugin->getConfigValue('connect_button_text', "Connect"))?>" />
        </td>
      </tr>
      <tr>
      	
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors(); ?>
      <?php if (isset($form['optional_name'])) : ?>
      <tr>
      
        <th><?php echo $form['optional_name']->renderLabel() ?></th>
        <td>
          <?php echo $form['optional_name']->renderError() ?>
          <?php echo $form['optional_name'] ?>
        </td>
      </tr>
      <?php else: ?>
      <tr>
        <td></td>
        <td></td>
      </tr>
      <?php endif; ?>
    </tbody>
  </table>
  
  <?php echo __($plugin->getConfigValue('text_after', "")); ?>