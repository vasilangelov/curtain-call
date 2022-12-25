<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TheaterRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TheaterCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TheaterCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    private $displayConfig = [
        [
            'name' => 'name',
            'label' => 'Name',
            'type' => 'text',
        ],
        [
            'name' => 'address',
            'label' => 'Address',
            'type' => 'text',
        ],
        [
            'name' => 'city_id',
            'label' => 'City',
            'type' => 'select',
            'entity' => 'city',
            'attribute' => 'name',
        ],
    ];

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Theater::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/theater');
        CRUD::setEntityNameStrings('theater', 'theaters');
    }

    /**
     * Define what happens when the Show operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-show
     * @return void
     */
    protected function setupShowOperation()
    {
        $this->crud->addColumns($this->displayConfig);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumns($this->displayConfig);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TheaterRequest::class);

        $this->crud->addFields($this->displayConfig);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(TheaterRequest::class);

        $this->crud->addFields($this->displayConfig);
    }
}
