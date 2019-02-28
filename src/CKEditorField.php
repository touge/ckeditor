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
        '//cdn.bootcss.com/ckeditor/4.11.2/ckeditor.js',
        '//cdn.bootcss.com/ckeditor/4.11.2/adapters/jquery.js',
        '//cdn.bootcss.com/ckeditor/4.11.2/lang/zh-cn.js',
    ];

    protected $view = 'ckeditor::ckeditor';

    public function render()
    {
        $element= $this->getElementClassString();
        $filebrowserImageBrowseUrl = config('admin.extensions.ckeditor.filebrowserImageBrowseUrl');
        $imageBrowserUrl = $filebrowserImageBrowseUrl==null ? null :admin_url($filebrowserImageBrowseUrl);
//        echo $imageBrowserUrl;

        $this->script = <<<EOF
var options= {
filebrowserImageBrowseUrl: "{$imageBrowserUrl}"
}
$('textarea.{$element}').ckeditor(options)

console.log(CKEDITOR.tools)

EOF;


        return parent::render();
    }

}