@extends('layouts.app')

@section('title', 'Dokumentasi')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center mb-6">
            <i class="fas fa-book text-blue-600 text-2xl mr-3"></i>
            <h1 class="text-2xl font-bold text-gray-800">Dokumentasi Aplikasi</h1>
        </div>
        
        <div class="prose prose-lg max-w-none">
            <div class="markdown-content">
                {!! Str::markdown($content) !!}
            </div>
        </div>
    </div>
</div>

<style>
.markdown-content {
    line-height: 1.6;
}

.markdown-content h1 {
    @apply text-3xl font-bold text-gray-800 mb-4 mt-6 border-b-2 border-blue-200 pb-2;
}

.markdown-content h2 {
    @apply text-2xl font-semibold text-gray-700 mb-3 mt-5;
}

.markdown-content h3 {
    @apply text-xl font-medium text-gray-600 mb-2 mt-4;
}

.markdown-content p {
    @apply mb-4 text-gray-700;
}

.markdown-content ul {
    @apply list-disc list-inside mb-4 space-y-1;
}

.markdown-content ol {
    @apply list-decimal list-inside mb-4 space-y-1;
}

.markdown-content li {
    @apply text-gray-700;
}

.markdown-content code {
    @apply bg-gray-100 px-2 py-1 rounded text-sm font-mono text-red-600;
}

.markdown-content pre {
    @apply bg-gray-900 text-gray-100 p-4 rounded-lg overflow-x-auto mb-4;
}

.markdown-content pre code {
    @apply bg-transparent text-gray-100 p-0;
}

.markdown-content blockquote {
    @apply border-l-4 border-blue-500 pl-4 italic text-gray-600 mb-4;
}

.markdown-content table {
    @apply w-full border-collapse border border-gray-300 mb-4;
}

.markdown-content th {
    @apply bg-gray-100 border border-gray-300 px-4 py-2 text-left font-semibold;
}

.markdown-content td {
    @apply border border-gray-300 px-4 py-2;
}

.markdown-content a {
    @apply text-blue-600 hover:text-blue-800 underline;
}

.markdown-content strong {
    @apply font-semibold text-gray-800;
}

.markdown-content em {
    @apply italic;
}
</style>
@endsection