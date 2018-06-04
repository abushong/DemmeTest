@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="panel-body">
                        <!-- Display Validation Errors -->
                        @include('common:errors')

                        <!-- New Task Form -->
                        <form action="/task/{{ $task->id }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}

                            <!-- Task Name -->
                            <div class="form-group">
                                <label for="task" class="col-sm-3 control-label">Task</label>

                                <div class="col-sm-6">
                                    <input type="text" name="name" id="task-name" class="form-control" value="{{ $task->name }}">
                                </div>
                            </div>

                            <!-- Is Completed -->
                        <div class="form-group">
                            <label for="task" class="col-sm-3 control-label">Completed</label>

                            <div class="col-sm-6">
                                <select name="complete" id="is-completed" class="form-control">
                                    <option>No</option>
                                    <option>Yes</option>
                                </select>
                            </div>
                        </div>

                            <!-- Add Task Button -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-outline-primary">
                                        <i class="fa fa-plus"></i> Update Task
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

</div>
@endsection
