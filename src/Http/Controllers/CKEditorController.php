<?php

namespace Touge\CKEditor\Http\Controllers;

use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;

class CKEditorController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('Title')
            ->description('Description')
            ->body(view('ckeditor::index'));
    }
}