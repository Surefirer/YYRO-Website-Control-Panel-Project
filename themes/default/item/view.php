<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2>Viewing Item</h2>
<?php if ($item): ?>
<?php $icon = $this->iconImage($item->item_id); ?>
<h3>
	<?php if ($icon): ?><img src="<?php echo $icon ?>" /><?php endif ?>
	#<?php echo htmlspecialchars($item->item_id) ?>: <?php echo htmlspecialchars($item->name) ?>
</h3>
<table class="vertical-table">
	<tr>
		<th>Item ID</th>
		<td><?php echo htmlspecialchars($item->item_id) ?></td>
		<?php if ($image=$this->itemImage($item->item_id)): ?>
		<td rowspan="<?php echo ($server->isRenewal)?9:8 ?>" style="width: 150px; text-align: center; vertical-alignment: middle">
			<img src="<?php echo $image ?>" />
		</td>
		<?php endif ?>
		<th>For Sale</th>
		<td>
			<?php if ($item->cost): ?>
				<span class="for-sale yes">
					是
				</span>
			<?php else: ?>
				<span class="for-sale no">
					否
				</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>名称</th>
		<td><?php echo htmlspecialchars($item->name) ?></td>
		<th>类别</th>
		<td><?php echo $this->itemTypeText($item->type, $item->view) ?></td>
	</tr>
	<tr>
		<th>买价</th>
		<td><?php echo number_format((int)$item->price_buy) ?></td>
		<th>重量</th>
		<td><?php echo round($item->weight, 1) ?></td>
	</tr>
	<tr>
		<th>卖价</th>
		<td>
			<?php if (is_null($item->price_sell) && $item->price_buy): ?>
				<?php echo number_format(floor($item->price_buy / 2)) ?>
			<?php else: ?>
				<?php echo number_format((int)$item->price_sell) ?>
			<?php endif ?>
		</td>
		<th>武器等级</th>
		<td><?php echo number_format((int)$item->weapon_level) ?></td>
	</tr>
	<tr>
		<th>范围</th>
		<td><?php echo number_format((int)$item->range) ?></td>
		<th>防御</th>
		<td><?php echo number_format((int)$item->defence) ?></td>
	</tr>
	<tr>
		<th>洞数</th>
		<td><?php echo number_format((int)$item->slots) ?></td>
		<th>精炼</th>
		<td>
			<?php if ($item->refineable): ?>
				是
			<?php else: ?>
				否
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>Attack</th>
		<td><?php echo number_format((int)$item->attack) ?></td>
		<th>最低装备等级</th>
		<td><?php echo number_format((int)$item->equip_level_min) ?></td>
	</tr>
	<?php if($server->isRenewal): ?>
	<tr>
		<th>MATK</th>
		<td><?php echo number_format((int)$item->matk) ?></td>
		<th>最高装备等级</th>
		<td>
			<?php if ($item->equip_level_max == 0): ?>
				<span class="not-applicable">None</span>
			<?php else: ?>
				<?php echo number_format((int)$item->equip_level_max) ?>
			<?php endif ?>
		</td>
	</tr>
	<?php endif ?>
	<tr>
		<th>装备位置</th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($locs=$this->equipLocations($item->equip_locations)): ?>
				<?php echo htmlspecialchars(implode(' + ', $locs)) ?>
			<?php else: ?>
				<span class="not-applicable">None</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>适合职业</th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($jobs=$this->equippableJobs($item->equip_jobs)): ?>
				<?php echo htmlspecialchars(implode(' / ', $jobs)) ?>
			<?php else: ?>
				<span class="not-applicable">None</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>适合性别</th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($item->equip_genders === '0'): ?>
				女
			<?php elseif ($item->equip_genders === '1'): ?>
				男
			<?php elseif ($item->equip_genders === '2'): ?>
				两者 (男和女)
			<?php else: ?>
				<span class="not-applicable">Unknown</span>
			<?php endif ?>
		</td>
	</tr>
	<?php if (($isCustom && $auth->allowedToSeeItemDb2Scripts) || (!$isCustom && $auth->allowedToSeeItemDbScripts)): ?>
	<?php endif ?>
    <?php if(Flux::config('ShowItemDesc')):?>
	<tr>
		<th>描述</th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if($item->itemdesc): ?>
                <?php echo $item->itemdesc ?>
            <?php else: ?>
                <span class="not-applicable">Unknown</span>
			<?php endif ?>
		</td>
	</tr>
    <?php endif ?>
    
</table>
<?php if ($itemDrops): ?>
<h3><?php echo htmlspecialchars($item->name) ?> Dropped By</h3>
<table class="vertical-table">
	<tr>
		<th>Monster ID</th>
		<th>Monster Name</th>
		<th><?php echo htmlspecialchars($item->name) ?> Drop Chance</th>
		<th>Monster Level</th>
		<th>Monster Race</th>
		<th>Monster Element</th>
	</tr>
	<?php foreach ($itemDrops as $itemDrop): ?>
	<tr class="item-drop-<?php echo $itemDrop['type'] ?>">
		<td align="right">
			<?php if ($auth->actionAllowed('monster', 'view')): ?>
				<?php echo $this->linkToMonster($itemDrop['monster_id'], $itemDrop['monster_id']) ?>
			<?php else: ?>
				<?php echo $itemDrop['monster_id'] ?>
			<?php endif ?>
		</td>
		<td>
			<?php if ($itemDrop['type'] == 'mvp'): ?>
				<span class="mvp">MVP!</span>
			<?php endif ?>
			<?php echo htmlspecialchars($itemDrop['monster_name']) ?>
		</td>
		<td><strong><?php echo $itemDrop['drop_chance'] ?>%</strong></td>
		<td><?php echo number_format($itemDrop['monster_level']) ?></td>
		<td><?php echo Flux::monsterRaceName($itemDrop['monster_race']) ?></td>
		<td>
			Level <?php echo floor($itemDrop['monster_ele_lv']) ?>
			<em><?php echo Flux::elementName($itemDrop['monster_element']) ?></em>
		</td>
	</tr>
	<?php endforeach ?>
</table>
<?php endif ?>

<?php else: ?>
<p>No such item was found. <a href="javascript:history.go(-1)">Go back</a>.</p>
<?php endif ?>
