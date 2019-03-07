<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 2019-02-25
 * Time: 10:50
 */

namespace Touge\CKEditor;


use Encore\Admin\Admin;
use Encore\Admin\Form\Field;

class CKEditorField extends Field
{
    public static $js = [
        'vendor/touge/ckeditor/4.11.2/ckeditor.js',
        'vendor/touge/ckeditor/4.11.2/adapters/jquery.js',
        'vendor/touge/ckeditor/4.11.2/lang/zh-cn.js',
    ];

    protected $view = 'ckeditor::ckeditor';

    public function render()
    {
        $csrf_token = csrf_token();

        $element= $this->getElementClassString();
        $filebrowserImageBrowseUrl = config('admin.extensions.ckeditor.filebrowserImageBrowseUrl');
        $imageBrowserUrl = $filebrowserImageBrowseUrl==null ? null :admin_url($filebrowserImageBrowseUrl);

        $filebrowserImageUploadUrl = config('admin.extensions.ckeditor.filebrowserImageUploadUrl',null);
        $imageUploadUrl = $filebrowserImageUploadUrl == null ? null :admin_url($filebrowserImageUploadUrl);

        $this->script = <<<EOF
var options= {
removeDialogTabs: 'image:advanced;image:Link',
filebrowserImageBrowseUrl: "{$imageBrowserUrl}",
filebrowserImageUploadUrl: "{$imageUploadUrl}?_token={$csrf_token}",
}
$('textarea.{$element}').ckeditor(options)

EOF;


        return parent::render();
    }

}