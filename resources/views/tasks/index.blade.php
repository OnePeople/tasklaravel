@extends('layouts.main')
@section('head')
<title>@lang('task.index.header')</title>
@endsection
@section('content')

<div>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  
  <div class="head-block">
  <h1> @lang('task.index.header')</h1>
  <a href="{{ route('task.create')}}" class="btn btn-primary"> @lang('task.index.create')</a>
  </div>


   <div class="report">
       <div class="progress">
           @foreach($report['byStatus'] as $status=>$data)
           <div class="bar {{ collect(['bar-success','bar-warning','bar-danger'])->get($loop->index)}}"
                style="width: {{round(100*$data/$report['total'])}}%;">{{$status}} ({{$data}})</div>
           @endforeach

       </div>
   </div>
  <table class="table table-striped">
    <thead>
        <tr>
          <td> @lang('task.index.code')</td>
          <td> @lang('task.index.theme')</td>
          <td> @lang('task.index.creator')</td>
          <td> @lang('task.index.performer')</td>
          <td> @lang('task.index.type')</td>
          <td> @lang('task.index.status')</td>
          <td> @lang('task.index.created')</td>
          <td></td>
          <td></td>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        <tr>
            <td>{{$task->code}}</td>
            <td>{{$task->theme}}</td>
            <td>{{$task->creator->name}}</td>
            <td>{{$task->performer->name}}</td>
            <td><span class="label label-warning">{{$task->type}}</span></td>
            <td><span class="label label-info">{{$task->status}}</span></td>
            <td>{{$task->created_at}}</td>
            <td><a href="{{ route('task.show',$task->id)}}" class="btn btn-primary"> @lang('task.index.Detaled')</a></td>
            <td><a href="{{ route('task.edit',$task->id)}}" class="btn btn-primary"> @lang('task.index.Edit')</a></td>
            <td> 
                 {{ Form::model($task,['route'=>['task.destroy', $task->id], 'method' => 'DELETE']) }}
                   <button class="btn btn-danger" type="submit"> @lang('task.index.Delete')</button>
                 {{ Form::close() }}
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection