<?php

use Touge\CKEditor\Http\Controllers\CKEditorController;

Route::get('ckeditor', CKEditorController::class.'@index');