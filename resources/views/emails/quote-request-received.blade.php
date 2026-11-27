<h1>New cabinet quote request</h1>

<p><strong>Name:</strong> {{ $quoteRequest->name }}</p>
<p><strong>Phone:</strong> {{ $quoteRequest->phone }}</p>
<p><strong>Email:</strong> <a href="mailto:{{ $quoteRequest->email }}">{{ $quoteRequest->email }}</a></p>

<h2>Project details</h2>
<p>{!! nl2br(e($quoteRequest->project_details)) !!}</p>

@if (count($quoteRequest->attachment_paths ?? []))
    <p>{{ count($quoteRequest->attachment_paths) }} photo(s) are attached.</p>
@endif
