@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Student Details</h2>
    <a href="{{ route('students.index') }}" class="btn btn-secondary mb-3">Back</a>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $student->name }}</h4>
            <p><strong>Email:</strong> {{ $student->email }}</p>

            <h5>Courses Enrolled:</h5>
            <ul class="list-group">
                @forelse ($student->courses as $course)
                    <li class="list-group-item">{{ $course->name }}</li>
                @empty
                    <li class="list-group-item text-muted">No courses assigned</li>
                @endforelse
            </ul>

            <div class="mt-3">
                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
