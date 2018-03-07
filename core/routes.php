<?php


# {h} is inplace of domain
# {w} is a wildcard


//todo impliment wild cards, so only routes with wildcard defined can make use of them
//wildcard example  /account/user/profile
//                  /account/{w}/profile
//                  /account/5/profile


//todo think about explicitly defining where route goes
//$routes = array(
//          '{h}/' => "index/index,
//          '{h}/account/{w}/profile' => "account/profile/{w}",
//where profile is the controller method and {w} is the variable place holder
$routes = array(
    '{h}/',
    '{h}/account',
    '{h}/account/login',
    '{h}/account/register',
    '{h}/account/logout',
    '{h}/index',
    '{h}/test/test',
);