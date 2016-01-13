<?php
return [
    ['GET', '/', ['My\Controllers\Homepage', 'show']],
    //['GET', '/{slug}', ['My\Controllers\Page', 'show']],
    ['GET', '/register', ['My\Controllers\Homepage', 'register']],
    ['GET', '/user_center', ['My\Controllers\Homepage', 'user_center']],
    ['GET', '/write_graghpy', ['My\Controllers\Homepage', 'write_graghpy']],
    ['GET', '/scratch', ['My\Controllers\Admin', 'scratch']],
    ['POST', '/scratch', ['My\Controllers\Admin', 'scratch']]
];