<?php echo $this->element('chart-admin_chart_overview', array('plugin' => 'Insights')); ?>
<?php echo $this->element('chart-admin_chart_users', array('role_id'=> ConstUserTypes::User), array('plugin' => 'Insights')); ?>
<?php echo $this->element('chart-admin_chart_user_logins', array('role_id'=> ConstUserTypes::User), array('plugin' => 'Insights')); ?>
<?php echo $this->element('chart-admin_chart_items', array('plugin' => 'Insights'));?>
<?php echo $this->element('chart-admin_chart_requests', array('plugin' => 'Insights'));?>