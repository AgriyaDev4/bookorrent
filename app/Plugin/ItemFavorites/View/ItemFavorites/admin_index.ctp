<?php /* SVN: $Id: $ */ ?>
<div class="itemFavorites index js-response js-responses">
<?php if(empty($this->request->params['named']['simple_view'])) : ?>
<ul class="breadcrumb top-mspace ver-space">
              <li><?php echo $this->Html->link(__l('Dashboard'), array('controller'=>'users','action'=>'stats'), array('class' => 'js-no-pjax', 'escape' => false));?> <span class="divider">/</span></li>
              <li class="active"><?php echo sprintf(__l('%s Favorites'), Configure::read('item.alt_name_for_item_singular_caps')); ?></li>
            </ul> 
<?php endif; ?>				
            <div class="tabbable ver-space <?php echo (empty($this->request->params['named']['simple_view'])) ? "sep-top" : "";?> top-mspace">
                <div id="list" class="tab-pane active in no-mar">
<?php if(empty($this->request->params['named']['simple_view'])) : ?>
			<div class="clearfix dc">
					<?php echo $this->Form->create('ItemFavorite', array('type' => 'get', 'class' => 'form-search bot-mspace big-input span', 'action'=>'index')); ?>
					<?php echo $this->Form->input('q', array('placeholder' => __l('Keyword'),'class'=>'span9 ver-mspace text-16','label' => false, 'maxlength' => '255')); ?>
					<?php echo $this->Form->submit(__l('Search'), array('class'=>'btn btn-large hor-mspace btn-primary textb text-16'));?>
					<?php echo $this->Form->end(); ?>
					
			</div>
<?php endif; ?>			
			<?php echo $this->element('paging_counter'); ?>
        <?php echo $this->Form->create('ItemFavorite' , array('class' => 'normal','action' => 'update')); ?>
        <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>

    <div class="ver-space">
                    <div id="active-users" class="tab-pane active in no-mar">
     <table class="table no-round table-striped">
	<thead>
	<tr class=" well no-mar no-pad">
        <?php if(empty($this->request->params['named']['simple_view'])) : ?>
	       <th class="dc sep-right"><?php echo __l('Select');?></th>
        <?php endif; ?>
        <th class="dc span2 sep-right span2"><?php echo __l('Actions');?></th>
        <th class="dc sep-right"><div class="js-pagination"><?php echo $this->Paginator->sort('created',__l('Created'));?></div></th>
        <th class="dl sep-right"><div class="js-pagination"><?php echo $this->Paginator->sort('User.username',__l('User'));?></div></th>
        <th class="dl sep-right"><div class="js-pagination"><?php echo $this->Paginator->sort('Item.title', Configure::read('item.alt_name_for_item_singular_caps'));?></div></th>
        <th class="dl sep-right"><div class="js-pagination"><?php echo $this->Paginator->sort( 'Ip.ip',__l('IP'));?></div></th>
    </tr>
	</thead>
	<tbody>
<?php
if (!empty($itemFavorites)):
$i = 0;
foreach ($itemFavorites as $itemFavorite):
$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
        <?php if(empty($this->request->params['named']['simple_view'])) : ?>
		  <td class="dc"><?php echo $this->Form->input('ItemFavorite.'.$itemFavorite['ItemFavorite']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$itemFavorite['ItemFavorite']['id'], 'label' => "", 'class' => 'js-checkbox-list')); ?></td>
        <?php endif; ?>
		 <td class="dc"><span class="dropdown"> <span title="<?php echo __l('Actions');?>" data-toggle="dropdown" class="graydarkc left-space hor-smspace icon-cog text-18 cur dropdown-toggle"> <span class="hide"><?php echo __l('Actions');?></span> </span>
                                <ul class="dropdown-menu arrow no-mar dl">
        			
        			<li><?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), array('action' => 'delete', $itemFavorite['ItemFavorite']['id']), array('escape' => false,'class' => 'delete js-delete', 'title' => __l('Delete')));?></li>
			   </ul>
   	  </span>
		</td>
		<td class="dc"><?php echo $this->Html->cDateTimeHighlight($itemFavorite['ItemFavorite']['created']);?></td>
		<td class="dl"><?php echo $this->Html->link($this->Html->cText($itemFavorite['User']['username']), array('controller'=> 'users', 'action'=>'view', $itemFavorite['User']['username'] , 'admin' => false), array( 'class' => 'js-no-pjax', 'escape' => false));?></td>
		<td class="dl"><div class="htruncate js-bootstrap-tooltip span5" title="<?php echo $this->Html->cText($itemFavorite['Item']['title'], false);?>"><?php echo $this->Html->link($this->Html->cText($itemFavorite['Item']['title'],false), array( 'action'=>'view', $itemFavorite['Item']['slug'] , 'admin' => false), array('class' => 'js-no-pjax', 'escape' => false));?></div></td>
		<td class="dl">
	             <?php
                 if(!empty($itemFavorite['Ip']['ip'])): ?>
                            <?php echo  $this->Html->link($itemFavorite['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $itemFavorite['Ip']['ip'], 'admin' => false), array('class' => 'js-no-pjax', 'target' => '_blank', 'title' => 'whois '.$itemFavorite['Ip']['host'], 'escape' => false));
							?>
							<div>
							<?php
                            if(!empty($itemFavorite['Ip']['Country'])):
                                ?>
                                <span class="flags flag-<?php echo $this->Html->cText(strtolower($itemFavorite['Ip']['Country']['iso_alpha2']), false); ?>" title ="<?php echo $this->Html->cText($itemFavorite['Ip']['Country']['name'], false); ?>">
									<?php echo $this->Html->cText($itemFavorite['Ip']['Country']['name'], false); ?>
								</span>
                                <?php
                            endif;
							 if(!empty($itemFavorite['Ip']['City'])):
                            ?>
                            <p class="htruncate js-bootstrap-tooltip span2" title="<?php echo $this->Html->cText($itemFavorite['Ip']['City']['name'], false);?>"><span> 	<?php echo $this->Html->cText($itemFavorite['Ip']['City']['name'], false); ?>    </p>
                            <?php endif; ?></div>                            
                        <?php else: ?>
							<?php echo __l('N/A'); ?>
						<?php endif; ?>
		</td> 
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="7"><div class="space dc grayc"><p class="ver-mspace top-space text-16 "><?php echo __l('No Favorites available');?></p></div></td>
	</tr>
<?php
endif;
?>
</tbody>
</table>
</div>
<?php
if (!empty($itemFavorites)):
        ?>
		<div class="admin-select-block ver-mspace pull-left mob-clr dc"><div class="span top-mspace">
       <span class="graydarkc">
	   <?php if(empty($this->request->params['named']['simple_view'])) : ?>
                <?php echo __l('Select:'); ?>
				</span>
				<?php echo $this->Html->link(__l('All'), '#', array('class' => 'hor-smspace grayc js-select js-no-pjax {"checked":"js-checkbox-list"}', 'title' => __l('All'))); ?>
				<?php echo $this->Html->link(__l('None'), '#', array('class' => 'hor-smspace grayc js-select js-no-pjax {"unchecked":"js-checkbox-list"}', 'title' => __l('None'))); ?>
				
             </div><?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit js-no-pjax span5', 'div'=>false,'label' => false, 'empty' => __l('-- More actions --'))); ?></span>
            <?php endif; ?>
         </div>
          <div class="js-pagination pagination pull-right no-mar mob-clr dc">
            <?php echo $this->element('paging_links'); ?>
        </div>
        </div>
        <div class="hide">
            <?php echo $this->Form->submit(__l('Submit'));  ?>
        </div>
        <?php
    endif;
    echo $this->Form->end();
    ?>
</div>