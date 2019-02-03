@extends('layouts.main')
@section('head')
<title> @lang('task.editcreate.header')</title>
@endsection
@section('content')

<div>
  <div class="object-header">
    <h1> @lang('task.editcreate.header')</h1>
  </div>
  <div class="object-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
    {{ Form::model($task,$formParams) }}
     
        <div class="form-group">
          <label for="name">@lang('task.editcreate.theme')</label>
          {{ Form::text('theme', null, ['class'=>'form-control']) }} 
        </div>
        <div class="form-group">
          <label for="price">@lang('task.editcreate.content')</label>
          {{ Form::textarea('content',null, ['class'=>'form-control']) }} 
        </div> 
        <div class="form-group">
          <label for="quantity">@lang('task.editcreate.type')</label>
          {!!Form::select('type', $task->types() , $task->type, ['class' => 'form-control'])!!} 
        </div>
      @if( $task->id )
        <div class="form-group">
          <label for="quantity">@lang('task.editcreate.status')</label>
          {!!Form::select('status',$task->statuses()  , $task->status, ['class' => 'form-control'])!!} 
        </div>
      @endif
        <div class="form-group">
          <label for="quantity">@lang('task.editcreate.performer')</label>
          {!!Form::select('performer_id',$users  , $task->performer->id, ['class' => 'form-control'])!!} 
        </div>
        <button type="submit" class="btn btn-primary">@lang('task.save')</button>
    
      {{ Form::close() }}
  </div>
</div>
@endsection