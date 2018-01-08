<?php

namespace Matthewbdaly\LaravelBlog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Cache;

class AdminResourceController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->modelName = $request->route('resource');
        if ($this->modelName) {
            $this->modelClass = config('admin.models')[$this->modelName];
            $this->model = new $this->modelClass();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->model->all();
        return view('admin::resource.index', [
            'items' => $data,
            'model_name' => $this->modelName,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fields = $this->getModelAttributes();
        return view('admin::resource.create', [
            'fields' => $fields,
            'model_name' => $this->modelName,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = $this->model->create($request->all());
        Cache::flush();
        $fields = $this->getModelAttributes();
        return redirect()->route('admin.resource.show', [
            'resource' => $this->modelName,
            'id' => $model->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($resource, $id)
    {
        $fields = $this->getModelAttributes();
        $model = $this->model->findOrFail($id);
        return view('admin::resource.show', [
            'id' => $id,
            'fields' => $fields,
            'model' => $model,
            'model_name' => $this->modelName,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $resource, $id)
    {
        $original = $this->model->find($id);
        $model = $original->update($request->all());
        Cache::flush();
        $fields = $this->getModelAttributes();
        return redirect()->route('admin.resource.show', [
            'resource' => $this->modelName,
            'id' => $id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($resource, $id)
    {
        $model = $this->model->find($id);
        $model->delete();
        Cache::flush();
        $fields = $this->getModelAttributes();
        return redirect()->route('admin.resource', [
            'resource' => $this->modelName,
        ]);
    }

    private function getModelAttributes()
    {
        $table = $this->model->getTable();
        $fields = array_values(Schema::getColumnListing($table));
        $fielddata = [];
        foreach ($fields as $field){
            if ($field != 'id' && $field != 'created_at' && $field != 'updated_at' && $field != 'deleted_at') {
                try {
                    $fielddata[$field] = Schema::getColumnType($table, $field);
                } catch (\Exception $e) {
                    $fielddata[$field] = 'unknown';
                }
            }
        }
        return $fielddata;
    }
}
