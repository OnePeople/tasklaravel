@extends('layouts.main')
@section('head')
<title>@lang('user.index.header')</title>
@endsection
@section('content')

<div>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  
  <div class="head-block">
  <h1> @lang('user.index.header')</h1>
  <a href="{{ route('user.create')}}" class="btn btn-primary"> @lang('user.index.create')</a>
  </div>

  <table class="table table-striped">
    <thead>
        <tr>
          <td> @lang('user.index.name')</td>
          <td> @lang('user.index.email')</td>
          <td> @lang('user.index.created')</td>
          <td></td>
          <td></td>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->created_at}}</td>
            <td><a href="{{ route('user.show',$user->id)}}" class="btn btn-primary"> @lang('user.index.Detaled')</a></td>
            <td><a href="{{ route('user.edit',$user->id)}}" class="btn btn-primary"> @lang('user.index.Edit')</a></td>
            <td> 
                 {{ Form::model($user,['route'=>['user.destroy', $user->id], 'method' => 'DELETE']) }}
                   <button class="btn btn-danger" type="submit"> @lang('user.index.Delete')</button>
                 {{ Form::close() }}
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection