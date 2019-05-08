<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 2019-02-25
 * Time: 10:50
 */

namespace Touge\CKEditor;

use Encore\Admin\Form\Field;

class CKEditorField extends Field
{
    public static $js = [
        'vendor/touge/ckeditor/ckeditor.js',
        'vendor/touge/ckeditor/adapters/jquery.js',
    ];

    protected $view = 'ckeditor::ckeditor';

    public function render()
    {
        $csrf_token = csrf_token();

        $element= $this->getElementClassString();
        $filebrowserImageBrowseUrl = config('admin.extensions.ckeditor.filebrowserImageBrowseUrl');
        $imageBrowserUrl = $filebrowserImageBrowseUrl==null ? null :admin_url($filebrowserImageBrowseUrl);

        $filebrowserImageUploadUrl = config('admin.extensions.ckeditor.filebrowserImageUploadUrl',null);

        $imageUploadUrl= "";

        /**
         * 此处依赖touge/oss-media插件
         */
        if(config("oss-media.filesystem")=="alioss")
        {
            $imageUploadUrl = $filebrowserImageUploadUrl == null ? null :admin_url("{$filebrowserImageUploadUrl}?_token={$csrf_token}");
        }

        $this->script = <<<EOF
var options= {
removeDialogTabs: 'image:advanced;image:Link',
filebrowserImageBrowseUrl: "{$imageBrowserUrl}",
filebrowserImageUploadUrl: "{$imageUploadUrl}",
}
$('textarea.{$element}').ckeditor(options)

EOF;


        return parent::render();
    }

}