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
        <form action="/task" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Task Name -->
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Task</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
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
                        <i class="fa fa-plus"></i> Add Task
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Current Tasks -->
    @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Tasks
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Task</th>
                        <th>Completed</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $task->name }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $task->complete }}</div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                    <form action="/task/{{ $task->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button class="btn btn-outline-info">Delete Task</button>
                                    </form>
                                    <form action="/task/{{ $task->id }}" method="GET">
                                        {{ csrf_field() }}

                                        <button class="btn btn-outline-info" style="margin-left:10px;">Update Task</button>
                                    </form>
                                </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
                </div>
            </div>

        </div>
    </div>

</div>

</div>
@endsection
