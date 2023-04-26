@extends('todolist.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>TODO LISTS</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('todolist.create') }}"> Create New Task</a>
            </div>
        </div>
    </div>
   <br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>DESCRIPTION</th>
            <th>DATE</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($todolist as $todo)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $todo->description }}</td>
            <td>{{ $todo->date }}</td>
            <td>
                <form action="{{ route('todolist.destroy',$todo->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('todolist.show',$todo->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('todolist.edit',$todo->id) }}">Update</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $todolist->links() !!}
      
@endsection