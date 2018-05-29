<?php /* SVN: $Id: $ */ ?>
<div class="formFieldGroup form js-response-containter">
  <div class="modal-header">
    <button type="button" class="close js-no-pjax" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h2 id="js-modal-heading"><?php echo __l('Edit Group'); ?></h2>
  </div>
  <div class="clearfix main-section top-space">
  <?php
      $url = Router::url(array('controller' => 'categories', 'action' => 'form_field_edit', $this->request->data['FormFieldGroup']['category_id']), true);
      echo $this->Form->create('FormFieldGroup', array('class' => 'space form-horizontal js-modal-form {"responsecontainer":"js-response-containter","redirect_url":"'.$url.'"}'));
    ?>
  <fieldset>
    <?php
      echo $this->Form->input('id');
      echo $this->Form->hidden('category_id');
      echo $this->Form->input('name', array('class'=>'span11','label' => __l('Name')));
      echo $this->Form->input('info', array('class'=>'span11','label' => __l('Info')));
	  echo $this->Form->input('is_editable', array('type' => 'checkbox', 'info' => '<i class="icon-info-sign"></i> '.__l('User can edit this group before \'Booking\'')));
    ?>
  </fieldset>
  <div class="form-actions">
    <?php echo $this->Form->submit(__l('Update'));?>
  </div>
  <?php echo $this->Form->end();?>
  </div>
</div>