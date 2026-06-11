@if ($paginator->hasPages())
    <div class="pagination-wrapper d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3">

        {{-- Summary Text --}}
        <p class="pagination-summary mb-0">
            Menampilkan
            <span class="fw-semibold text-dark">{{ $paginator->firstItem() }}</span>
            –
            <span class="fw-semibold text-dark">{{ $paginator->lastItem() }}</span>
            dari
            <span class="fw-semibold text-dark">{{ $paginator->total() }}</span>
            data
        </p>

        {{-- Page Buttons --}}
        <ul class="pagination mb-0">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link"><i class="fas fa-chevron-left" style="font-size:0.7rem;"></i></span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">
                        <i class="fas fa-chevron-left" style="font-size:0.7rem;"></i>
                    </a>
                </li>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">
                        <i class="fas fa-chevron-right" style="font-size:0.7rem;"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link"><i class="fas fa-chevron-right" style="font-size:0.7rem;"></i></span>
                </li>
            @endif

        </ul>
    </div>
@endif
