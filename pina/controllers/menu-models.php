<?php

require_once PATH_TABLES."slot_module.php";
$slotModuleGateway = new SlotModuleGateway();
$sm = $slotModuleGateway->get($request->param("slot_module_id"));
$data = unserialize($sm["slot_module_data"]);


if(!isset($data['show_models']) || empty($data['show_models']) || $data['show_models'] == 'Не отображать') {
    $data['show_models'] = '';
}

$request->result('subModels', $data['show_models']);
$request->result('is_mobile', $request->param("is_mobile"));
$request->ok();