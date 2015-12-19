<?php

namespace My\Page;

interface PageReader
{
    public function readBySlug($slug);
}