<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminColumnFilter;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\SaveAndCreate;
use SleepingOwl\Admin\Section;

/**
 * Class Products
 *
 * @property \App\Models\Product $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Products extends Section implements Initializable
{
    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $alias;

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation()->setPriority(100)->setIcon('fa fa-lightbulb-o');
    }

    /**
     * @param array $payload
     *
     * @return DisplayInterface
     */
    public function onDisplay($payload = [])
    {
        $columns = [
            AdminColumn::text('id', '#')->setWidth('50px')->setHtmlAttribute('class', 'text-center'),
            AdminColumn::link('name', 'Название', 'created_at')
                ->setSearchCallback(function($column, $query, $search){
                    return $query
                        ->orWhere('name', 'like', '%'.$search.'%')

                    ;
                })

            ,
            AdminColumn::link('descriprion', 'Описание', 'created_at')
                ->setSearchCallback(function($column, $query, $search){
                    return $query
                        ->orWhere('descriprion', 'like', '%'.$search.'%')

                        ;
                }),
            AdminColumn::link('category_id', 'Категория', 'created_at')
                ->setSearchCallback(function($column, $query, $search){
                    return $query
                        ->orWhere('category_id', 'like', '%'.$search.'%')

                        ;
                }),

        ];

        $display = AdminDisplay::datatables()
            ->setName('firstdatatables')
            ->setOrder([[0, 'asc']])
            ->setDisplaySearch(true)
            ->paginate(25)
            ->setColumns($columns)
            ->setHtmlAttribute('class', 'table-primary table-hover th-center')
        ;

        $display->setColumnFilters([
            AdminColumnFilter::select()
                ->setModelForOptions(\App\Models\Product::class, 'name')
                ->setLoadOptionsQueryPreparer(function($element, $query) {
                    return $query;
                })
                ->setDisplay('name')
                ->setColumnName('name')
                ->setPlaceholder('All names')
            ,
        ]);
        $display->getColumnFilters()->setPlacement('card.heading');

        return $display;
    }

    /**
     * @param int|null $id
     * @param array $payload
     *
     * @return FormInterface
     */
    public function onEdit($id = null, $payload = [])
    {
        $form = AdminForm::card()->addBody([
            AdminFormElement::columns()->addColumn([
                AdminFormElement::text('category_id', 'Категория (1-Товар 2-Сет)')
                    ->required(),
                AdminFormElement::text('name', 'Название')
                    ->required(),
                AdminFormElement::textarea('descriprion', 'Описание')
                    ->required(),
                AdminFormElement::textarea('pathes', 'Состав')
                    ->required(),
                AdminFormElement::text('price', 'Цена')
                    ->required(),
                AdminFormElement::text('weight', 'Вес')
                    ->required(),
                AdminFormElement::file('image', 'Изображение')
                    ->required()
                ,
                AdminFormElement::html('<hr>'),

                AdminFormElement::html('last AdminFormElement without comma')
            ], 'col-xs-12 col-sm-6 col-md-4 col-lg-4')->addColumn([

                AdminFormElement::html('last AdminFormElement without comma')
            ], 'col-xs-12 col-sm-6 col-md-8 col-lg-8'),
        ]);

        $form->getButtons()->setButtons([
            'Сохранить'  => new Save(),
            'Сохранить и закрыть'  => new SaveAndClose(),
            'Сохранить и создать новый'  => new SaveAndCreate(),
            'Отмена'  => (new Cancel()),
        ]);

        return $form;
    }

    /**
     * @return FormInterface
     */
    public function onCreate($payload = [])
    {
        return $this->onEdit(null, $payload);
    }

    /**
     * @return bool
     */
    public function isDeletable(Model $model)
    {
        return true;
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // remove if unused
    }
}
