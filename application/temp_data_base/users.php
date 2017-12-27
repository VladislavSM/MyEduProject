<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 26.12.17
 * Time: 17:41
 */

$users = [
    'user1'=>
        [   'id' => 1,
            'login'=>'vlad',
            'password'=>'1',
            'email'=>'vlad@edu.loc',
            'name'=>'Vlad',
            'surename'=>'Med',
            'phone'=>'7777777',
            'status'=>'1'
        ],

    'user2'=>
        [   'id' => 2,
            'login'=>'student',
            'password'=>'1',
            'email'=>'student@edu.loc',
            'name'=>'PhpStudent',
            'surename'=>'Studenttttttt',
            'phone'=>'3332211',
            'status'=>'0'
        ],

    'user3'=>
        [   'id' => 3,
            'login'=>'admin',
            'password'=>'1',
            'email'=>'admin@edu.loc',
            'name'=>'VladAdmin',
            'surename'=>'MedAdmin',
            'phone'=>'9995544',
            'status'=>'2'
        ],

];

return $users;