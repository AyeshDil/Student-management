@extends('layouts.app')

@section('title', 'Students List')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h2>Students</h2>
        <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Courses</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                        {{ $student->courses->pluck('name')->join(', ') }}
                    </td>
                    <td>
                        {{-- show --}}
                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
