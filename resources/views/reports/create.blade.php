@extends('layouts.app')

@section('title', 'Report Task')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0"><i class="bi bi-flag-fill me-2"></i>Report a Task</h4>
                </div>
                <div class="card-body bg-light">
                    <form method="POST" action="{{ route('reports.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="message" class="form-label fw-semibold">Your Message</label>
                            <textarea id="message" name="message" rows="5" required class="form-control rounded-3 shadow-sm"></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4 py-2 shadow">
                                <i class="bi bi-send-fill me-2"></i>Send Report
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
