@props(['paginator', 'label' => 'item'])

@if ($paginator->hasPages())
    <!-- Modern Pagination Component -->
    <div class="mt-8 flex flex-col items-center space-y-4">
        <!-- Pagination Info -->
        <div class="text-sm text-gray-600">
            Menampilkan <span class="font-semibold text-gray-900">{{ $paginator->firstItem() ?? 0 }}</span>
            sampai <span class="font-semibold text-gray-900">{{ $paginator->lastItem() ?? 0 }}</span>
            dari <span class="font-semibold text-gray-900">{{ $paginator->total() }}</span> {{ $label }}
        </div>

        <!-- Pagination Controls -->
        <div class="flex items-center space-x-1">
            {{-- First Page Link --}}
            @if ($paginator->onFirstPage())
                <button class="px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed shadow-sm" disabled>
                    <i class="fas fa-angle-double-left"></i>
                </button>
            @else
                <a href="{{ $paginator->url(1) }}"
                   class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 hover:border-blue-300 shadow-sm hover:shadow-md">
                    <i class="fas fa-angle-double-left"></i>
                </a>
            @endif

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <button class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed shadow-sm" disabled>
                    <i class="fas fa-chevron-left mr-1"></i>
                    <span class="hidden sm:inline">Sebelumnya</span>
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 hover:border-blue-300 shadow-sm hover:shadow-md">
                    <i class="fas fa-chevron-left mr-1"></i>
                    <span class="hidden sm:inline">Sebelumnya</span>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @php
                $currentPage = $paginator->currentPage();
                $lastPage = $paginator->lastPage();
            @endphp
            
            {{-- Desktop Pagination --}}
            <div class="hidden sm:flex items-center space-x-1">
                @if ($lastPage <= 7)
                    {{-- Show all pages if 7 or fewer --}}
                    @for ($i = 1; $i <= $lastPage; $i++)
                        @if ($i == $currentPage)
                            <button class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 border border-blue-600 rounded-lg shadow-sm">
                                {{ $i }}
                            </button>
                        @else
                            <a href="{{ $paginator->url($i) }}" 
                               class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-all duration-200">
                                {{ $i }}
                            </a>
                        @endif
                    @endfor
                @else
                    {{-- Show condensed pagination --}}
                    {{-- First page --}}
                    @if ($currentPage == 1)
                        <button class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 border border-blue-600 rounded-lg shadow-sm">
                            1
                        </button>
                    @else
                        <a href="{{ $paginator->url(1) }}" 
                           class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-all duration-200">
                            1
                        </a>
                    @endif
                    
                    @if ($currentPage > 3)
                        <span class="px-2 py-2 text-sm font-medium text-gray-500">...</span>
                    @endif
                    
                    {{-- Pages around current --}}
                    @for ($i = max(2, $currentPage - 1); $i <= min($lastPage - 1, $currentPage + 1); $i++)
                        @if ($i == $currentPage)
                            <button class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 border border-blue-600 rounded-lg shadow-sm">
                                {{ $i }}
                            </button>
                        @else
                            <a href="{{ $paginator->url($i) }}" 
                               class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-all duration-200">
                                {{ $i }}
                            </a>
                        @endif
                    @endfor
                    
                    @if ($currentPage < $lastPage - 2)
                        <span class="px-2 py-2 text-sm font-medium text-gray-500">...</span>
                    @endif
                    
                    {{-- Last page --}}
                    @if ($lastPage > 1)
                        @if ($currentPage == $lastPage)
                            <button class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 border border-blue-600 rounded-lg shadow-sm">
                                {{ $lastPage }}
                            </button>
                        @else
                            <a href="{{ $paginator->url($lastPage) }}" 
                               class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-all duration-200">
                                {{ $lastPage }}
                            </a>
                        @endif
                    @endif
                @endif
            </div>
            
            {{-- Mobile Pagination - Only show current page indicator --}}
            <div class="flex sm:hidden items-center space-x-1">
                {{-- Current page indicator --}}
                <button class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 border border-blue-600 rounded-lg shadow-sm">
                    {{ $currentPage }}
                </button>
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 hover:border-blue-300 shadow-sm hover:shadow-md">
                    <span class="hidden sm:inline">Selanjutnya</span>
                    <i class="fas fa-chevron-right ml-1"></i>
                </a>
            @else
                <button class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed shadow-sm" disabled>
                    <span class="hidden sm:inline">Selanjutnya</span>
                    <i class="fas fa-chevron-right ml-1"></i>
                </button>
            @endif

            {{-- Last Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->url($paginator->lastPage()) }}"
                   class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 hover:border-blue-300 shadow-sm hover:shadow-md">
                    <i class="fas fa-angle-double-right"></i>
                </a>
            @else
                <button class="px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed shadow-sm" disabled>
                    <i class="fas fa-angle-double-right"></i>
                </button>
            @endif
        </div>
    </div>
@endif