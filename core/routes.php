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


$router = new router();


$router->get(
    array(
        '_url' => '[:host]/',
        'controller' => 'index',
        'action' => 'index'
    )
);

$router->get(
    array(
        '_url' => '[:host]/account',
        'controller' => 'account',
        'action' => 'index'
    )
);

$router->get(
    array(
        '_url' => '[:host]/account/login',
        'controller' => 'account',
        'action' => 'login'
    )
);

$router->post(
    array(
        '_url' => '[:host]/account/login',
        'controller' => 'account',
        'action' => 'login'
    )
);

$router->get(
    array(
        '_url' => '[:host]/account/register',
        'controller' => 'account',
        'action' => 'register'
    )
);

$router->post(
    array(
        '_url' => '[:host]/account/register',
        'controller' => 'account',
        'action' => 'register'
    )
);

$router->get(
    array(
        '_url' => '[:host]/logout',
        'controller' => 'account',
        'action' => 'logout'
    )
);

$router->get(
    array(
        '_url' => '[:host]/profile',
        'controller' => 'profile',
        'action' => 'index'
    )
);

$router->get(
    array(
        '_url' => '[:host]/profile/edit',
        'controller' => 'profile',
        'action' => 'edit'
    )
);

$router->post(
    array(
        '_url' => '[:host]/profile/edit',
        'controller' => 'profile',
        'action' => 'submitEdit'
    )
);

$router->get(
    array(
        '_url' => '[:host]/health',
        'controller' => 'health',
        'action' => 'index'
    )
);

$router->invalid(
    array(
        '_url' => '[:host]/error',
        'controller' => 'error',
    )
);

