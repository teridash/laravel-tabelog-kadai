<?php

namespace App\Admin\Controllers;

use App\Models\Store;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StoreController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Store';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Store());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('price', __('Price'))->sortable();
        $grid->column('opening_time', __('Open Time'));
        $grid->column('closing_time', __('Close Time'));
        $grid->column('postal_code', __('Postal Code'));
        $grid->column('address', __('Address'));
        $grid->column('phone_number', __('Phone Number'));
        $grid->column('holiday', __('Holiday'));
        $grid->column('category.name', __('Category Name'));
        $grid->column('image', __('Image'))->image();
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function($filter) {
            $filter->like('name', '店舗名');
            $filter->like('description', '店舗説明');
            $filter->between('price', '金額');
            $filter->like('open_time', '開店時間');
            $filter->like('close_time', '閉店時間');
            $filter->in('category_id', 'カテゴリー')->multipleSelect(Category::all()->pluck('name', 'id'));
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Store::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('price', __('Price'));
        $show->field('opening_time', __('Open Time'));
        $show->field('closing_time', __('Close Time'));
        $show->field('postal_code', __('Postal Code'));
        $show->field('address', __('Address'));
        $show->field('phone_number', __('Phone Number'));
        $show->field('holiday', __('Holiday'));
        $show->field('category.name', __('Category Name'));
        $show->field('image', __('Image'))->image();
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Store());

        $form->text('name', __('Name'));
        $form->text('description', __('Description'));
        $form->text('price', __('Price'));
        $form->text('opening_time', __('Open Time'));
        $form->text('closing_time', __('Close Time'));
        $form->text('postal_code', __('Postal Code'));
        $form->text('address', __('Address'));
        $form->text('phone_number', __('Phone Number'));
        $form->checkbox('holiday', __('Holiday'))->options(Store::DAY_OF_WEEK);
        $form->select('category_id', __('Category Name'))->options(Category::all()->pluck('name', 'id'));
        $form->image('image', __('Image'));

        return $form;
    }
}
