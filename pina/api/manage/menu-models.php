<?php
validateNotEmpty($request, 'slot_module_id', 'Внутренняя ошибка');
$request->trust();

$params = $request->params();
unset($params['action']);

$slot_module_id = $params['slot_module_id'];
unset($params['slot_module_id']);


require_once PATH_TABLES.'slot_module.php';
$slotModuleGateway = new SlotModuleGateway();
$sm = $slotModuleGateway->get($slot_module_id);
$data = unserialize($sm['slot_module_data']);

$items = array();
foreach ($params as $key=>$param) {
    if(is_array($param)) {
        foreach ($param as $name=>$value) {
            $items[$name][$key] = $value;
        }
    } else	{
        $data[$key] = $param;
    }
}

$data['items'] = $items;
require_once PATH_TABLES.'slot_module.php';
$slotModuleGateway = new SlotModuleGateway();
$slotModuleGateway->edit($slot_module_id, array('slot_module_data' => serialize($data)));


$request->set("site_version_comment", "Настройки модуля <Меню моделей> были изменены");
$request->run("site-version.manage.save");

$request->ok();
