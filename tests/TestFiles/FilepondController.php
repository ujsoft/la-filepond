<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class FilepondController extends Controller
{
    use HasResourceActions;

    public function index(Content $content)
    {
        return $content
            ->body($this->grid()->render());
    }

    public function create(Content $content)
    {
        return $content->body($this->form());
    }

    protected function form()
    {
        return new Form(new Post(), function ($form) {
            $form->text('name', 'name');
            $form->filepondImage('images', 'images')->multiple();
            $form->filepondImage('avatar', 'avatar')->rules('required')->size(30);
            $form->filepondFile('files', 'files')->multiple()->mineType(['application/msword', 'application/pdf'])->rules('required');
            $form->filepondFile('file', 'file')->size(30);
        });
    }

    public function edit($id, Content $content)
    {
        return $content
            ->body($this->form()->edit($id));
    }

    protected function grid()
    {
        $grid = new Grid(new Post());
        $grid->id('ID')->sortable();
        $grid->name()->editable();

        return $grid;
    }
}
