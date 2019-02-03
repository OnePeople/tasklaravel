@extends('layouts.main')
@section('head')
<title>{{$task->theme}}</title>
@endsection
@section('content')

<div>
  <div class="object-header">
    <h1>  @lang('task.show.header')</h1>
  </div>
  <div class="object-body">
 
     
        <div class="form-group">
          <label for="name"> @lang('task.show.theme')</label>
          <h3>{{$task->theme}}</h3>
          
        </div>
        <div class="form-group">
          <label for="price"> @lang('task.show.content')</label>
          
          <div>{{$task->content}}</div> 
        </div> 
        <div class="form-group">
          <label  > @lang('task.show.type')</label>
          <div>{{$task->type}}</div>  
        </div>
        <div class="form-group">
          <label  > @lang('task.show.header')</label>
          <div>{{$task->status}}</div>  
        </div>
        <div class="form-group">
          <label > @lang('task.show.performer')</label>
          <div>{{$task->performer->name}}</div>  
        </div>
        
        <div class="form-group">
          <label > @lang('task.show.creator')</label>
          <div>{{$task->creator->name}}</div>  
        </div> 
        
        <div class="form-group">
          <label > @lang('task.show.created_at')</label>
          <div>{{$task->created_at}}</div>  
        </div> 
  </div>
</div>
@endsection