<?php
namespace My\Template;

interface Renderer
{
    public function render($template, $data = []);
}