<?php
return [
    ['GET', '/', ['My\Controllers\Homepage', 'show']],
    ['GET', '/{slug}', ['My\Controllers\Page', 'show']],
];