<?php

namespace app\thunder\controller;

use think\Controller;
use think\db;

class Login extends Controller
{
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

    public function register()
    {
        /**
         *  -1 用户名重复
         *  0 添加成功
         *  1 添加失败 未知错误
         */
        $user = input("user");
        $pwd = input("pwd");
        if ($user == null || $pwd == null)
            return 1;
        $data = ['User_user' => $user, 'User_pwd' => $pwd];
        if (db::name('thunder_user')->where('User_user', $user)->find() != null)
            return -1;
        // 在注册的同时返回自增的主键 从而去 创建用户对于的分组
        if (db::name('thunder_group')->insert(['thunder_user' => db::name('thunder_user')->insertGetId($data)]) == 1)
            return 0;
        else
            return 1;
    }
}