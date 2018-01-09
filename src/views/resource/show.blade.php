@extends('admin::layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            <form class="form-horizontal" method="POST" action="/admin/{{ $model_name }}/{{ $id }}">
                {{ csrf_field() }}

                @foreach ($fields as $name => $type)
                <input type="hidden" name="_method" value="PATCH" />
                <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">{{ title_case($name) }}</label>

                    <div class="col-md-8">

                        @if($type == 'text')
                        <textarea id="{{ $name }}" class="form-control" name="{{ $name }}" rows="20" required>{{ $model->getAttribute($name) }}</textarea>
                        @elseif($type == 'datetime')
                        <input id="{{ $name }}" type="datetime-local" class="form-control" name="{{ $name }}" value="{{ format_date($model->getAttribute($name)) }}" required autofocus>
                        @else
                        <input id="{{ $name }}" type="text" class="form-control" name="{{ $name }}" value="{{ $model->getAttribute($name) }}" required>
                        @endif

                        @if ($errors->has($name))
                        <span class="help-block">
                            <strong>{{ $errors->first($name) }}</strong>
                        </span>
                        @endif

                    </div>
                </div>
                @endforeach

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
            <form class="form-horizontal" method="POST" action="/admin/{{ $model_name }}/{{ $id }}/">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE" />
                <button type="submit" class="btn btn-danger">Delete</a>
            </form>

            @include('admin::partials.sidebar')
        </div>
    </div>
</div>
@endsection
