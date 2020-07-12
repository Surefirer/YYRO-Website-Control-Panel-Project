<?php
/**
 *
 * Pvp Ranking Module Section
 *
 * @package		GTheme
 * @author		John Gerome "Gerome" Baldonado
 * @copyright	Copyright (c) 2013, jiidesignstudio.com
 * 
 * Please do not redistribute my work without
 * permission and leave all credits in tact.
 */
 
if (!defined('FLUX_ROOT')) exit;

$title    = 'PvP Ranking';
$classes  = Flux::config('JobClasses')->toArray();
$jobClass = $params->get('jobclass');
$bind     = array();

if (trim($jobClass) === '') {
	$jobClass = null;
}

if (!is_null($jobClass) && !array_key_exists($jobClass, $classes)) {
	$this->deny();
}

$col  = "ch.char_id, ch.name AS char_name, ch.class AS char_class, ch.base_level, ch.base_exp, ch.job_level, ch.job_exp, ph.kills, ph.deaths, ph.streaks,";
$col .= "ch.guild_id, guild.name AS guild_name, guild.emblem_len AS guild_emblem_len";

$sql  = "SELECT $col FROM {$server->charMapDatabase}.char AS ch INNER JOIN {$server->charMapDatabase}.pvpladder AS ph ";
$sql .= "LEFT JOIN {$server->charMapDatabase}.pvpladder ON ph.char_id = ch.char_id ";
$sql .= "LEFT JOIN {$server->charMapDatabase}.guild ON guild.guild_id = ch.guild_id ";
$sql .= "LEFT JOIN {$server->loginDatabase}.login ON login.account_id = ch.account_id ";
$sql .= "WHERE 1=1 ";

if (Flux::config('PvpHidePermBannedCharRank')) {
	$sql .= "AND login.state != 5 ";
}
if (Flux::config('PvpHideTempBannedCharRank')) {
	$sql .= "AND (login.unban_time IS NULL OR login.unban_time = 0) ";
}

$groups = AccountLevel::getGroupID((int)Flux::config('PvPRankingHideGroupLevel'), '<');

if(!empty($groups)) {
	$ids   = implode(', ', array_fill(0, count($groups), '?'));
	$sql  .= "AND login.group_id IN ($ids) ";
	$bind  = array_merge($bind, $groups);
}

if ($days=Flux::config('PvpCharRankingThreshold')) {
	$sql    .= 'AND TIMESTAMPDIFF(DAY, login.lastlogin, NOW()) <= ? ';
	$bind[]  = $days * 24 * 60 * 60;
}

if (!is_null($jobClass)) {
	$sql .= "AND ch.class = ? ";
	$bind[] = $jobClass;
}

$sql .= "GROUP BY ph.kills DESC ";
$sql .= "LIMIT ".(int)Flux::config('PvpRankingLimit');
$sth  = $server->connection->getStatement($sql);

$sth->execute($bind);

$chars = $sth->fetchAll();
?>