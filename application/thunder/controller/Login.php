<?php

namespace app\thunder\controller;

use think\Controller;
use think\db;
use think\Exception;

class Login extends Controller
{
    /**
     * 登陆逻辑
     * 成功0
     * 失败1
     * @return int
     */
    public function login()
    {
        $user = input("user");
        $pwd = input("pwd");
        if ($user == null || $pwd == null)
            return 1;
        $result = Db::Query("select count(*) from thunder_xust17_t.thunder_user where user_user = ? and  user_pwd = ? ", [$user, $pwd]);
        if ($result[0]["count(*)"] == 1)
            return 0;
        else
            return 1;
    }

    /**
     * 注册逻辑
     * -1 用户名重复
     *  0 添加成功
     * 1 添加失败 未知错误
     * @return int
     * @throws \think\exception\DbException
     * @throws db\exception\DataNotFoundException
     * @throws db\exception\ModelNotFoundException
     */
    public function register()
    {
        $user = input("user");
        $pwd = input("pwd");
        if ($user == null || $pwd == null)
            return 1;
        $data = ['User_user' => $user, 'User_pwd' => $pwd];
        try{
            if (db::name('thunder_user')->where('User_user', $user)->find() != null)
                return -1;
            // 在注册的同时返回自增的主键 从而去 创建用户对于的分组
            if (db::name('thunder_group')->insert(['thunder_user' => db::name('thunder_user')->insertGetId($data)]) == 1)
                return 0;
            else
                return 1;
        }catch (Exception $exception){
            return 1;
        }
    }
}