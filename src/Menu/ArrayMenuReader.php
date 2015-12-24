<?php

namespace My\Menu;

class ArrayMenuReader implements MenuReader
{
    public function readMenu()
    {
        return [
		    ['href' => '/', 'text' => 'Homepage'],
		    ['href' => '/one-page', 'text' => 'Page One'],
		];
    }
}