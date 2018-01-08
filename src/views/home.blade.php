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

            <ul class="list-group">
                @foreach ($models as $name => $model)
                <li class="list-group-item">
                    <a href="/admin/{{ $name }}/">{{ title_case($name) }}</a>
                </li>
                @endforeach
            </ul>
        </div>
        @include('admin::partials.sidebar')
    </div>
</div>
@endsection
