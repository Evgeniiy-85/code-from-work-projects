<?php
$slot_module_id = $request->param('slot_module_id');
validateNotEmpty($request, 'slot_module_id', 'Модуль не известен');
$request->trust();

require_once PATH_TABLES.'slot_module.php';
$slotModuleGateway = new SlotModuleGateway();
$sm = $slotModuleGateway->get($slot_module_id);
$data = unserialize($sm['slot_module_data']);
$show_models_selector = array();


$modelTypes = array('Не отображать', 'NX', 'ES','RX','LX','GS F','LS','GX','RC');
foreach ($modelTypes as $modelType)
{
	$show_models_selector [] = array(
		"value" => $modelType,
		"caption" => $modelType,
		"color" => 'green'
	);
}
$request->result('data', $data);
$request->result("show_models_selector", $show_models_selector);