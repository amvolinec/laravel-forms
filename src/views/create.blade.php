@extends('forms::app')

@section('content')
    <div class="container form-inner">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create new CRUD | BREAD') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form
                            action="{{ isset($table) ? route('forms.update', $table->route) : route('forms.store')  }}"
                            method="post">
                            @method( isset($table) ? 'PUT' : 'POST')
                            @csrf

                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="model">{{ __("Model") }}</label>
                                    <input id="model" type="text" name="model"
                                           class="form-control @error('model') is-invalid @enderror"
                                           value="{{ $table->model ?? old('model') }}" required autofocus>
                                    @error('model')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="name">{{ __("Table name") }}</label>
                                    <input id="name" type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ $table->name ?? old('name') }}" required
                                           autocomplete="name">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="route">{{ __("Route") }}</label>
                                    <input id="route" type="text" name="route"
                                           class="form-control @error('route') is-invalid @enderror"
                                           value="{{ $table->route ?? old('route') }}" required>
                                    @error('route')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label
                                        for="description">{{ __("Searchable fields (coma separated)") }}</label>
                                    <input id="description" type="text" name="description"
                                           class="form-control @error('description') is-invalid @enderror"
                                           value="{{ $table->description ?? old('description') }}">
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-check col-md-2 ml-3 mb-3">
                                    <input type="checkbox" id="createModelCheck" class="form-check-input"
                                           name="create_model" value="1"
                                           @if (isset($table->create_model)) @if($table->create_model === 1) checked
                                           @endif @else checked @endif>
                                    <label class="form-check-label"
                                           for="createModelCheck">{{ __('Create Model') }}</label>
                                </div>
                                <div class="form-check col-md-2 ml-3 mb-3">
                                    <input type="checkbox" id="createMigrationCheck"
                                           class="form-check-input" name="create_migration" value="1"
                                           @if (isset($table->create_migration)) @if($table->create_migration === 1) checked
                                           @endif @else checked @endif>
                                    <label class="form-check-label"
                                           for="createMigrationCheck">{{ __('Create Migration') }}</label>
                                </div>
                                <div class="form-check col-md-2 ml-3 mb-3">
                                    <input type="checkbox" id="createControllerCheck"
                                           class="form-check-input" name="create_controller" value="1"
                                           @if (isset($table->create_controller)) @if($table->create_controller === 1) checked
                                           @endif @else checked @endif>
                                    <label class="form-check-label"
                                           for="createControllerCheck">{{ __('Create Controller') }}</label>
                                </div>
                                <div class="form-check col-md-2 ml-3 mb-3">
                                    <input type="checkbox" id="createViewsCheck" class="form-check-input"
                                           name="create_views" value="1"
                                           @if (isset($table->create_views)) @if($table->create_views === 1) checked
                                           @endif @else checked @endif>
                                    <label class="form-check-label"
                                           for="createViewsCheck">{{ __('Create Views') }}</label>
                                </div>
                                <div class="form-check col-md-2 ml-3 mb-3">
                                    <input type="checkbox" id="createPermissionsCheck"
                                           class="form-check-input" name="create_permissions" value="0"
                                           @if (isset($table->create_permissions)) @if($table->create_permissions === 1) checked @endif @endif>
                                    <label class="form-check-label"
                                           for="createPermissionsCheck">{{ __('Create Permissions') }}</label>
                                </div>
                            </div>
                            <hr>

                            <div class="row" id="form-line"
                                 style="visibility:hidden; opacity: 0; display: none;">
                                <div class="form-group col-md-3">
                                    <label for="field-name">{{ __("Field name") }}</label>
                                    <input id="field-name" type="text" name="names[]" class="form-control">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="field-title">{{ __("Field title") }}</label>
                                    <input id="field-title" type="text" name="titles[]"
                                           class="form-control">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="field-type">{{ __("Fild type") }}</label>
                                    <select id="field-type" type="text" name="types[]" class="form-control">
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}
                                                | {{ $type->class }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="field-defaults">{{ __("Field default value") }}</label>
                                    <input id="field-defaults" type="text" name="defaults[]"
                                           class="form-control">
                                </div>

                                <div class="form-check col-md-3 ml-3 mb-3">
                                    <input type="checkbox" class="form-check-input" name="nullable[]"
                                           value="1" checked>
                                    <label class="form-check-label"
                                           for="nullableCheck">{{ __('Nullable') }}</label>
                                </div>
                                <div class="form-check col-md-3 mb-3">
                                    <input type="checkbox" class="form-check-input" name="fillable[]"
                                           value="1" checked>
                                    <label class="form-check-label"
                                           for="fillableCheck">{{ __('Fillable') }}</label>
                                </div>
                                <div class="form-check col-md-3 mb-3">
                                    <input type="checkbox" class="form-check-input" name="inlist[]"
                                           value="1" checked>
                                    <label class="form-check-label"
                                           for="inlistCheck">{{ __('In list') }}</label>
                                </div>

                            </div>

                            <div class="row m-1">
                                <div class="form-group col-md-12">
                                    <button id="add-field" type="button"
                                            class="btn btn-success">{{ __('+ Add field') }}</button>
                                </div>
                            </div>

                            <div class="row p-0 m-0" id="form-inner">
                                @if(isset($fields) && !empty($fields))
                                    @foreach($fields as $field)
                                        @include('forms::field', ['field' => $field, 'types' => $types])
                                    @endforeach
                                @endif
                            </div>

                            <div class="row mt-3">
                                <div class="form-group col-md-12">
                                    <button id="store-fields" type="button"
                                            class="btn btn-success float-right"><i
                                            class="fa fa-save"></i> {{ __('Save') }}</button>
                                </div>
                            </div>

                        </form>
                        <div><strong>Settings:</strong></div>
                        <div>{"belongsTo": "App\\User", "fieldName":"user", "fieldToShow": "name"}</div>
                        <div>{"belongsTo": "App\\Company", "fieldName":"company", "fieldToShow": "name"}</div>
                        <div>{"belongsToMany": "App\\Offer", "fieldName":"offers", "fieldToShow": "title"}</div>
                        <div>{"parameters": "13,3"}</div>
                        <div>{"parameters": "45"}</div>
                        <div>
                            <a href="https://jsonformatter.curiousconcept.com/#" target="_blank">Link to check</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



