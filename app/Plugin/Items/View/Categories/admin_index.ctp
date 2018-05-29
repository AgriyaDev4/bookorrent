<?php /* SVN: $Id: $ */ ?>
<div class="categories index js-response">
	<ul class="breadcrumb top-mspace ver-space">
		<li><?php echo $this->Html->link(__l('Dashboard'), array('controller' => 'users', 'action' => 'stats'), array('class' => 'js-no-pjax', 'escape' => false));?><span class="divider">/</span></li>
        <li class="active"><?php echo __l('Categories'); ?></li>
	</ul> 
    <div class="tabbable ver-space sep-top top-mspace">
		<div id="list" class="tab-pane active in no-mar">
			<div class="clearfix">
			<?php 
				$class = (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Active) ? 'active' : null;
				echo $this->Html->link('<dl class="dc list users '.$class .' mob-clr mob-sep-none "><dt class="pr hor-mspace text-11 grayc"  title="'.__l('Enabled').'">'.__l('Enabled').'</dt><dd title="'.$this->Html->cInt($active,false).'" class="textb text-20 no-mar graydarkc pr hor-mspace">'.$this->Html->cInt($active ,false).'</dd></dl>', array('action' => 'index', 'filter_id' => ConstMoreAction::Active), array('escape' => false,'class'=>'no-under show pull-left mob-clr bot-space bot-mspace cur'));
				$class = (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == 			ConstMoreAction::Inactive) ? 'active' : null;
				echo $this->Html->link('<dl class="dc list users '.$class .' mob-clr mob-sep-none "><dt class="pr hor-mspace text-11 grayc"  title="'.__l('Disabled').'">'.__l('Disabled').'</dt><dd title="'.$this->Html->cInt($inactive,false).'" class="textb text-20 no-mar graydarkc pr hor-mspace">'.$this->Html->cInt($inactive ,false).'</dd></dl>', array('action' => 'index', 'filter_id' => ConstMoreAction::Inactive), array('escape' => false,'class'=>'no-under show pull-left mob-clr bot-space bot-mspace cur'));
				$class = (empty($this->request->params['named']['filter_id'])) ? 'active' : null;
				echo $this->Html->link('<dl class="dc list users '.$class .' mob-clr mob-sep-none "><dt class="pr hor-mspace text-11 grayc"  title="'.__l('Total').'">'.__l('Total').'</dt><dd title="'.$this->Html->cInt($active + $inactive,false).'" class="textb text-20 no-mar graydarkc pr hor-mspace">'.$this->Html->cInt($active + $inactive,false).'</dd></dl>', array('action' => 'index'), array('escape' => false, 'class'=>'no-under show pull-left mob-clr bot-space bot-mspace cur'));	
			?>
			</div>
			<div class="clearfix dc">
				<div class="pull-right top-space mob-clr dc top-mspace">	 
					<?php echo $this->Html->link('<span class="ver-smspace"><i class="icon-plus-sign no-pad top-smspace"></i></span>', array( 'action' => 'add'), array('escape' => false,'class' => 'add btn btn-primary textb text-18 whitec','title'=>__l('Add'))); ?>
				</div>
			</div>
			<?php 
				echo $this->element('paging_counter');
				echo $this->Form->create('Category' , array('class' => 'normal','action' => 'update'));
				echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); 
			?>
			<div class="ver-space">
				<div id="active-users" class="tab-pane active in no-mar">
					<table class="table no-round table-striped">
						<thead>
							<tr class=" well no-mar no-pad">
								<th class="sep-right dc span2"><?php echo __l('Select'); ?></th>
								<th class="sep-right dc span2"><?php echo __l('Actions');?></th>
								<th class="dc sep-right"><?php echo $this->Paginator->sort('created', __l('Created'));?></th>
								<th class="dl sep-right"><?php echo $this->Paginator->sort('parent_id', __l('Parent Category'));?></th>
								<th class="dl sep-right"><?php echo $this->Paginator->sort('name', __l('Category'));?></th>
							</tr>
						</thead>
						<tbody>
							<?php
							if (!empty($categories)):
								$i = 0;
								foreach ($categories as $category):
									$class = null;
									$active_class = '';
									if ($i++ % 2 == 0) {
									   $class = 'altrow';
									}
									if($category['Category']['is_active']):
										$status_class = 'js-checkbox-active';
									else:
										$active_class = 'disable';
										$status_class = 'js-checkbox-inactive';
									endif;
							?>
							<tr class="<?php echo $class.' '.$active_class;?>">
								<td class="dc"><?php echo $this->Form->input('Category.'.$category['Category']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$category['Category']['id'], 'label' => "", 'class' => $status_class.' js-checkbox-list')); ?></td>
								<td class="dc">
									<span class="dropdown"> 
										<span title="<?php echo __l('Action'); ?>" data-toggle="dropdown" class="graydarkc left-space hor-smspace icon-cog text-18 cur dropdown-toggle">
											<span class="hide"><?php echo __l('Action'); ?></span>
										</span>
										<ul class="dropdown-menu arrow no-mar dl">
											<li><?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array('action' => 'edit', $category['Category']['id']), array('escape' => false,'class' => 'delete', 'title' => __l('Edit')));?></li>
											<li><?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), array('action' => 'delete', $category['Category']['id']), array('escape' => false,'class' => 'delete js-delete', 'title' => __l('Delete')));?></li>
											<?php if (!empty($category['Category']['parent_id'])) { ?>
											<li><?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('Form Fields'), array('controller' => 'categories', 'action' => 'form_field_edit', $category['Category']['id']),array('class' => 'blackc', 'title' =>  __l('Form Fields'), 'escape' => false));?></li>
											<li><?php echo $this->Html->link('<i class="icon-eye-open"></i>'.__l('Preview'), array('controller' => 'categories', 'action' => 'admin_preview', $category['Category']['id']), array('class' => 'blackc', 'title' =>  __l('Preview'), 'escape' => false));?></li>
											<li><?php echo $this->Html->link('<i class="icon-sitemap"></i>'.__l('Category Types'), array('controller' => 'category_types', 'action' => 'admin_index', $category['Category']['id']), array('class' => 'blackc', 'title' =>  __l('Category Types'), 'escape' => false));?></li>
											<?php } ?>
										</ul>
									</span>
								</td>
								<td class="dc"><?php echo $this->Html->cDateTime($category['Category']['created']);?></td>
								<td class="dl"><?php echo (!empty($category['ParentCategory']['name'])) ? $this->Html->cText($category['ParentCategory']['name']): '';?></td>
								<td class="dl"><?php echo $this->Html->cText($category['Category']['name']);?></td>
							</tr>
							<?php
								endforeach;
							else:
							?>
							<tr>
								<td colspan="5"<div class="space dc grayc"><p class="ver-mspace top-space text-16"><?php echo __l('No Categories available');?></p></div></td>
							</tr>
							<?php
								endif;
							?>
						</tbody>
					</table>
					<?php
						if (!empty($categories)):
					?> 
					<div class="admin-select-block ver-mspace pull-left mob-clr dc">
						<div class="span top-mspace">
							<span class="graydarkc">
								<?php echo __l('Select:'); ?>
							</span>
							<?php 
								echo $this->Html->link(__l('All'), '#', array('class' => 'hor-smspace grayc js-select js-no-pjax {"checked":"js-checkbox-list"}','title' => __l('All')));  
								echo $this->Html->link(__l('None'), '#', array('class' => 'hor-smspace grayc js-select js-no-pjax {"unchecked":"js-checkbox-list"}','title' => __l('None')));  
								if(!isset($this->request->params['named']['filter_id'])) { 
									echo $this->Html->link(__l('Enable'), '#', array('class' => 'hor-smspace grayc js-select js-no-pjax {"checked":"js-checkbox-active","unchecked":"js-checkbox-inactive"}','title' => __l('Enable')));  
									echo $this->Html->link(__l('Disable'), '#', array('class' => 'hor-smspace grayc js-select js-no-pjax {"checked":"js-checkbox-inactive","unchecked":"js-checkbox-active"}','title' => __l('Disable')));  
								} 
							?>
						</div>
						<?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit js-no-pjax span5', 'div'=>false,'label' => false, 'empty' => __l('-- More actions --'))); ?></span>
					</div>
					<?php endif; ?>
					<div class="js-pagination pagination pull-right no-mar mob-clr dc">
						<?php echo $this->element('paging_links'); ?>
					</div>
				</div>
				<div class="hide">
					<?php echo $this->Form->submit(__l('Submit'));  ?>
				</div>
				<?php
					echo $this->Form->end();
				?>
			</div>
		</div>
	</div>
</div>