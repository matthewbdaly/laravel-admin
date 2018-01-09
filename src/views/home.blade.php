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

            <div class="panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Models</div>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        @foreach ($models as $name => $model)
                        <li class="list-group-item">
                            <a href="/admin/{{ $name }}/">{{ title_case($name) }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @include('admin::partials.sidebar')
    </div>
</div>
@endsection
