@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
    <h2>Edit Student</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $student->name }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $student->email }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Courses</label>
            <select name="courses[]" class="form-control" multiple>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" 
                        @if ($student->courses->contains($course->id)) selected @endif>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
