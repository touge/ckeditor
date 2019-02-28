<?php

namespace Touge\CKEditor;

use Illuminate\Support\ServiceProvider;
use Encore\Admin\Admin;
use Encore\Admin\Form;

class CKEditorServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(CKEditor $extension)
    {
        if (! CKEditor::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'ckeditor');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [
                    $assets => public_path('vendor/touge/ckeditor'),
                ],
                'ckeditor'
            );
        }

        Admin::booting(function () {
            Form::extend('ckeditor', CKEditorField::class);
        });

//        $this->app->booted(function () {
//            CKEditor::routes(__DIR__.'/../routes/web.php');
//        });
    }
}