<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2>道具</h2>
<p class="toggler"><a href="javascript:toggleSearchForm()">搜索...</a></p>
<form class="search-form" method="get">
	<?php echo $this->moduleActionFormInputs($params->get('module')) ?>
	<p>
		<label for="item_id">道具 ID:</label>
		<input type="text" name="item_id" id="item_id" value="<?php echo htmlspecialchars($params->get('item_id')) ?>" />
		...
		<label for="name">名称:</label>
		<input type="text" name="name" id="name" value="<?php echo htmlspecialchars($params->get('name')) ?>" />
		...
		<label for="type">类型:</label>
		<select name="type">
			<option value="-1"<?php if (($type=$params->get('type')) === '-1') echo ' selected="selected"' ?>>
				任何
			</option>
			<?php foreach (Flux::config('ItemTypes')->toArray() as $typeId => $typeName): ?>
				<option value="<?php echo $typeId ?>"<?php if (($type=$params->get('type')) === strval($typeId)) echo ' selected="selected"' ?>>
					<?php echo htmlspecialchars($typeName) ?>
				</option>
				<?php $itemTypes2 = Flux::config('ItemTypes2')->toArray() ?>
				<?php if (array_key_exists($typeId, $itemTypes2)): ?>
					<?php foreach ($itemTypes2[$typeId] as $typeId2 => $typeName2): ?>
					<option value="<?php echo $typeId ?>-<?php echo $typeId2 ?>"<?php if (($type=$params->get('type')) === ($typeId . '-' . $typeId2)) echo ' selected="selected"' ?>>
						<?php echo htmlspecialchars($typeName . ' - ' . $typeName2) ?>
					</option>
					<?php endforeach ?>
				<?php endif ?>
			<?php endforeach ?>
		</select>
		...
		<label for="equip_loc">装备位置:</label>
		<select name="equip_loc">
			<option value="-1"<?php if (($equip_loc=$params->get('equip_loc')) === '-1') echo ' selected="selected"' ?>>
				任何
			</option>
			<?php foreach (Flux::config('EquipLocationCombinations')->toArray() as $locId => $locName): ?>
				<option value="<?php echo $locId ?>"<?php if (($equip_loc=$params->get('equip_loc')) === strval($locId)) echo ' selected="selected"' ?>>
					<?php echo htmlspecialchars($locName) ?>
				</option>
			<?php endforeach ?>
		</select>
	</p>
	<p>
		<label for="npc_buy">买价:</label>
		<select name="npc_buy_op">
			<option value="eq"<?php if (($npc_buy_op=$params->get('npc_buy_op')) == 'eq') echo ' selected="selected"' ?>>等于</option>
			<option value="gt"<?php if ($npc_buy_op == 'gt') echo ' selected="selected"' ?>>大于</option>
			<option value="lt"<?php if ($npc_buy_op == 'lt') echo ' selected="selected"' ?>>小于</option>
		</select>
		<input type="text" name="npc_buy" id="npc_buy" value="<?php echo htmlspecialchars($params->get('npc_buy')) ?>" />
		...
		<label for="npc_sell">卖价:</label>
		<select name="npc_sell_op">
			<option value="eq"<?php if (($npc_sell_op=$params->get('npc_sell_op')) == 'eq') echo ' selected="selected"' ?>>等于</option>
			<option value="gt"<?php if ($npc_sell_op == 'gt') echo ' selected="selected"' ?>>大于</option>
			<option value="lt"<?php if ($npc_sell_op == 'lt') echo ' selected="selected"' ?>>小于</option>
		</select>
		<input type="text" name="npc_sell" id="npc_sell" value="<?php echo htmlspecialchars($params->get('npc_sell')) ?>" />
		...
		<label for="weight">Weight:</label>
		<select name="weight_op">
			<option value="eq"<?php if (($weight_op=$params->get('weight_op')) == 'eq') echo ' selected="selected"' ?>>等于</option>
			<option value="gt"<?php if ($weight_op == 'gt') echo ' selected="selected"' ?>>大于</option>
			<option value="lt"<?php if ($weight_op == 'lt') echo ' selected="selected"' ?>>小于</option>
		</select>
		<input type="text" name="weight" id="weight" value="<?php echo htmlspecialchars($params->get('weight')) ?>" />
	</p>
	<p>
		<label for="range">Range:</label>
		<select name="range_op">
			<option value="eq"<?php if (($range_op=$params->get('range_op')) == 'eq') echo ' selected="selected"' ?>>等于</option>
			<option value="gt"<?php if ($range_op == 'gt') echo ' selected="selected"' ?>>大于</option>
			<option value="lt"<?php if ($range_op == 'lt') echo ' selected="selected"' ?>>小于</option>
		</select>
		<input type="text" name="range" id="range" value="<?php echo htmlspecialchars($params->get('range')) ?>" />
		...
		<label for="slots">Slots:</label>
		<select name="slots_op">
			<option value="eq"<?php if (($slots_op=$params->get('slots_op')) == 'eq') echo ' selected="selected"' ?>>等于</option>
			<option value="gt"<?php if ($slots_op == 'gt') echo ' selected="selected"' ?>>大于</option>
			<option value="lt"<?php if ($slots_op == 'lt') echo ' selected="selected"' ?>>小于</option>
		</select>
		<input type="text" name="slots" id="slots" value="<?php echo htmlspecialchars($params->get('slots')) ?>" />
		...
		<label for="defense">Defense:</label>
		<select name="defense_op">
			<option value="eq"<?php if (($defense_op=$params->get('defense_op')) == 'eq') echo ' selected="selected"' ?>>等于</option>
			<option value="gt"<?php if ($defense_op == 'gt') echo ' selected="selected"' ?>>大于</option>
			<option value="lt"<?php if ($defense_op == 'lt') echo ' selected="selected"' ?>>小于</option>
		</select>
		<input type="text" name="defense" id="defense" value="<?php echo htmlspecialchars($params->get('defense')) ?>" />
	</p>
	<p>
		<label for="attack">Attack:</label>
		<select name="attack_op">
			<option value="eq"<?php if (($attack_op=$params->get('attack_op')) == 'eq') echo ' selected="selected"' ?>>等于</option>
			<option value="gt"<?php if ($attack_op == 'gt') echo ' selected="selected"' ?>>大于</option>
			<option value="lt"<?php if ($attack_op == 'lt') echo ' selected="selected"' ?>>小于</option>
		</select>
		<input type="text" name="attack" id="attack" value="<?php echo htmlspecialchars($params->get('attack')) ?>" />
		...
		<?php if($server->isRenewal): ?>
		<label for="matk">MATK:</label>
		<select name="matk_op">
			<option value="eq"<?php if (($matk_op=$params->get('matk_op')) == 'eq') echo ' selected="selected"' ?>>等于</option>
			<option value="gt"<?php if ($matk_op == 'gt') echo ' selected="selected"' ?>>大于</option>
			<option value="lt"<?php if ($matk_op == 'lt') echo ' selected="selected"' ?>>小于</option>
		</select>
		<input type="text" name="matk" id="matk" value="<?php echo htmlspecialchars($params->get('matk')) ?>" />
		...
		<?php endif ?>
		<label for="refineable">Refineable:</label>
		<select name="refineable" id="refineable">
			<option value=""<?php if (!($refineable=$params->get('refineable'))) echo ' selected="selected"' ?>>全部</option>
			<option value="yes"<?php if ($refineable == 'yes') echo ' selected="selected"' ?>>是</option>
			<option value="no"<?php if ($refineable == 'no') echo ' selected="selected"' ?>>否</option>
		</select>
		...
		<label for="for_sale">For Sale:</label>
		<select name="for_sale" id="for_sale">
			<option value=""<?php if (!($for_sale=$params->get('for_sale'))) echo ' selected="selected"' ?>>全部</option>
			<option value="yes"<?php if ($for_sale == 'yes') echo ' selected="selected"' ?>>是</option>
			<option value="no"<?php if ($for_sale == 'no') echo ' selected="selected"' ?>>否</option>
		</select>
		...
		<label for="custom">Custom:</label>
		<select name="custom" id="custom">
			<option value=""<?php if (!($custom=$params->get('custom'))) echo ' selected="selected"' ?>>全部</option>
			<option value="yes"<?php if ($custom == 'yes') echo ' selected="selected"' ?>>是</option>
			<option value="no"<?php if ($custom == 'no') echo ' selected="selected"' ?>>否</option>
		</select>
		...
		<input type="submit" value="Search" />
		<input type="button" value="Reset" onclick="reload()" />
	</p>
</form>
<?php if ($items): ?>
<?php echo $paginator->infoText() ?>
<table class="horizontal-table">
	<tr>
		<th><?php echo $paginator->sortableColumn('item_id', '物品 ID') ?></th>
		<th colspan="2"><?php echo $paginator->sortableColumn('name', '名称') ?></th>
		<th>类型</th>
		<th>装备位置</th>
		<th><?php echo $paginator->sortableColumn('price_buy', '买价') ?></th>
		<th><?php echo $paginator->sortableColumn('price_sell', '卖价') ?></th>
		<th><?php echo $paginator->sortableColumn('weight', '重量') ?></th>
		<th><?php echo $paginator->sortableColumn('attack', 'Attack') ?></th>
		<?php if($server->isRenewal): ?>
		<th><?php echo $paginator->sortableColumn('matk', 'MATK') ?></th>
		<?php endif ?>
		<th><?php echo $paginator->sortableColumn('defense', '防御') ?></th>
		<th><?php echo $paginator->sortableColumn('range', '范围') ?></th>
		<th><?php echo $paginator->sortableColumn('slots', '洞数') ?></th>
		<th><?php echo $paginator->sortableColumn('refineable', '精炼') ?></th>
		<th><?php echo $paginator->sortableColumn('cost', 'For Sale') ?></th>
		<th><?php echo $paginator->sortableColumn('origin_table', 'Custom') ?></th>
	</tr>
	<?php foreach ($items as $item): ?>
	<tr>
		<td align="right">
			<?php if ($auth->actionAllowed('item', 'view')): ?>
				<?php echo $this->linkToItem($item->item_id, $item->item_id) ?>
			<?php else: ?>
				<?php echo htmlspecialchars($item->item_id) ?>
			<?php endif ?>
		</td>
		<?php if ($icon=$this->iconImage($item->item_id)): ?>
			<td width="24"><img src="<?php echo htmlspecialchars($icon) ?>?nocache=<?php echo rand() ?>" /></td>
			<td><?php echo htmlspecialchars($item->name) ?></td>
		<?php else: ?>
			<td colspan="2"><?php echo htmlspecialchars($item->name) ?></td>
		<?php endif ?>
		<td>
			<?php if ($type=$this->itemTypeText($item->type, $item->view)): ?>
				<?php echo htmlspecialchars($type) ?>
			<?php else: ?>
				<span class="not-applicable">Unknown<?php echo " (".$item->type.")" ?></span>
			<?php endif ?>
		</td>
		<td>
			<?php if ($loc=$this->equipLocationCombinationText($item->equip_locations)): ?>
				<?php echo htmlspecialchars($loc) ?>
			<?php else: ?>
				<span class="not-applicable">Unknown<?php echo " (".$item->equip_locations.")" ?></span>
			<?php endif ?>
		</td>
		<td><?php echo number_format((int)$item->price_buy) ?></td>
		<td><?php echo number_format((int)$item->price_sell) ?></td>
		<td><?php echo round($item->weight, 1) ?></td>
		<td><?php echo number_format((int)$item->attack) ?></td>
		<?php if($server->isRenewal): ?>
			<td><?php echo number_format((int)$item->matk) ?></td>
		<?php endif ?>
		<td><?php echo number_format((int)$item->defense) ?></td>
		<td><?php echo number_format((int)$item->range) ?></td>
		<td><?php echo number_format((int)$item->slots) ?></td>
		<td>
			<?php if ($item->refineable): ?>
				<span class="refineable yes">是</span>
			<?php else: ?>
				<span class="refineable no">否</span>
			<?php endif ?>
		</td>
		<td>
			<?php if ($item->cost): ?>
				<span class="for-sale yes"><a href="<?php echo $this->url('purchase') ?>" title="Go to Item Shop">是</a></span>
			<?php else: ?>
				<span class="for-sale no">否</span>
			<?php endif ?>
		</td>
		<td>
			<?php if (preg_match('/item_db2$/', $item->origin_table)): ?>
				Yes
			<?php else: ?>
				
			<?php endif ?>
		</td>
	</tr>
	<?php endforeach ?>
</table>
<?php echo $paginator->getHTML() ?>
<?php else: ?>
<p>No items found. <a href="javascript:history.go(-1)">返回</a>.</p>
<?php endif ?>
