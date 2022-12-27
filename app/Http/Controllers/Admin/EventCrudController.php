<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EventRequest;
use App\Models\Performance;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Request;

/**
 * Class EventCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EventCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        create as baseCreate;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Event::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/event');
        CRUD::setEntityNameStrings('event', 'events');
    }

    public function create()
    {
        $request = $this->crud->getRequest();

        if (Request::exists('performance_id')) {
            $performance = Performance::query()->where('id', '=', $request->query('performance_id'))->first();

            if ($performance != null) {
                $this->crud->modifyField('performance_id', [
                    'value' => $performance->id,
                    'attributes' => [
                        'readonly' => 'readonly',
                    ],
                    'options' => function ($query) {
                        return $query->where('id', '=', $this->crud->getRequest()->query('performance_id'))->get();
                    }
                ]);
            }
        }

        return $this->baseCreate();
    }

    /**
     * Define what happens when the Show operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-show
     * @return void
     */
    protected function setupShowOperation()
    {
        $this->crud->addColumns($this->getConfig());
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumns($this->getConfig());
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(EventRequest::class);

        $this->crud->addFields($this->getConfig());
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(EventRequest::class);

        $this->crud->addFields($this->getConfig());
    }

    /**
     * Get backpack configuration.
     *
     * @return array
     */
    private function getConfig()
    {
        return [
            [
                'name' => 'performance_id',
                'label' => 'Performance',
                'type' => 'select',
                'entity' => 'performance',
            ],
            [
                'name' => 'theater_id',
                'label' => 'Theater',
                'type' => 'select',
                'entity' => 'theater',
            ],
            [
                'name' => 'performance_date',
                'label' => 'Performance date',
                'type' => 'datetime',
            ],
        ];
    }
}
