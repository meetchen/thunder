<?php
namespace app\index\controller;
use think\Controller;

class Admin extends Controller
{
    public function ceshi()
    {
    	$user = input("id");
        $password = input("pwd");
    	$db =\Db::table('xust_user')->where('user_user',$user)->select();
        return json($db);
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}