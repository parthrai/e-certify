<?php
/**
 * Created by PhpStorm.
 * User: Parth
 * Date: 2016-04-29
 * Time: 9:16 PM
 */


$user = JWTAuth::parseToken()->authenticate();
echo $user->id;
