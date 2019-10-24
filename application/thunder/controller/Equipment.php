<?php


namespace app\thunder\controller;

use think\db;

/**
 * Class equipment  分组
 * @package app\thunder\controller
 */
class equipment
{
    public function register()
    {
        $equipment_id = input('id');
        $data = ['equipment_id', $equipment_id];
        if ($equipment_id == null)
            return -1;
        if (db::name('thunder_equipment')->find('equipment_id', $equipment_id) != null)
            return 1;
        if (db::name('thunder_equipment')->insert($data) == 1)
            return 0;
        else
            return -1;
    }

    public function createGroup()
    {
        $group_name = input('name');
        $group_userId = input('id');
        if ($group_name == null || $group_userId == null)
            return -1;
        if ((db::name('thunder_group')->find('group_name', $group_name)) != null)
            return 1;
        $data = ['group_name' => $group_name, 'group_user' => $group_userId];
        if (db::name('thunder_group')->insert($data) == 1)
            return 0;
        else
            return -1;
    }
}