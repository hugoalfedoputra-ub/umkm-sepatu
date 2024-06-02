@if ($paginator->hasPages())
   <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}"
      class="flex items-center justify-between lg:text-lg">

      <div class="flex-1 flex items-center justify-between">
         <div>
            <span class="relative z-0 inline-flex shadow-sm rounded-md">
               {{-- First Page Link --}}
               @if (!$paginator->onFirstPage())
                  <a href="{{ $paginator->url(1) }}"
                     class="relative inline-flex items-center px-1 py-1 ml-1 text-xs lg:text-lg font-medium text-white bg-gray-600 border border-gray-600 rounded-l-md leading-6 hover:bg-gray-600 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-700 transition ease-in-out duration-150 dark:bg-gray-700 dark:border-gray-800 dark:hover:bg-gray-600 dark:active:bg-gray-900 dark:focus:border-blue-800"
                     aria-label="{{ __('pagination.first') }}">
                     <svg class="w-4 h-4 lg:w-6 lg:h-6 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                           d="M11.707 14.707a1 1 0 01-1.414 0L5.293 10l5-5a1 1 0 111.414 1.414L7.414 10l4.293 4.293a1 1 0 010 1.414z M17.707 14.707a1 1 0 01-1.414 0L11.293 10l5-5a1 1 0 111.414 1.414L13.414 10l4.293 4.293a1 1 0 010 1.414z"
                           clip-rule="evenodd" />
                     </svg>
                  </a>
               @endif

               {{-- Previous Page Link --}}
               @if ($paginator->onFirstPage())
                  <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                     <span
                        class="relative inline-flex items-center px-1 py-2 mx-1 text-xs lg:text-lg font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5 h-full dark:bg-gray-800 dark:border-gray-600"
                        aria-hidden="true">
                        <svg class="w-4 h-4 lg:w-6 lg:h-6" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd" />
                        </svg>
                     </span>
                  </span>
               @else
                  <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                     class="relative inline-flex items-center px-1 py-1 mx-1 text-xs lg:text-lg font-medium text-white bg-gray-600 border border-gray-600 leading-5 hover:bg-gray-600 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-700 transition ease-in-out duration-150 dark:bg-gray-700 dark:border-gray-800 dark:hover:bg-gray-600 dark:active:bg-gray-900 dark:focus:border-blue-800"
                     aria-label="{{ __('pagination.previous') }}">
                     <svg class="w-4 h-4 lg:w-6 lg:h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                           d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                           clip-rule="evenodd" />
                     </svg>
                  </a>
               @endif

               {{-- Pagination Elements --}}
               @foreach ($elements as $element)
                  {{-- Array Of Links --}}
                  @if (is_array($element))
                     @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                           <span aria-current="page">
                              <span
                                 class="relative inline-flex items-center px-2 py-1 mx-1 -ml-px text-xs lg:text-lg font-medium text-white bg-gray-600 border border-gray-600 cursor-default leading-6 dark:bg-gray-700 dark:border-gray-800 lg:px-4 lg:py-2">{{ $page }}</span>
                           </span>
                        @elseif ($page >= $paginator->currentPage() - 2 && $page <= $paginator->currentPage() + 2)
                           <a href="{{ $url }}"
                              class="relative inline-flex items-center px-2 py-1 mx-1 -ml-px text-xs lg:text-lg font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800 lg:px-4 lg:py-2"
                              aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                              {{ $page }}
                           </a>
                        @endif
                     @endforeach
                  @endif
               @endforeach

               {{-- Next Page Link --}}
               @if ($paginator->hasMorePages())
                  <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                     class="relative inline-flex items-center px-1 py-1 mx-1 -ml-px text-xs lg:text-lg font-medium text-white bg-gray-600 border border-gray-600 leading-5 hover:bg-gray-600 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-700 transition ease-in-out duration-150 dark:bg-gray-700 dark:border-gray-800 dark:hover:bg-gray-600 dark:active:bg-gray-900 dark:focus:border-blue-800"
                     aria-label="{{ __('pagination.next') }}">
                     <svg class="w-4 h-4 lg:w-6 lg:h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                           d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                           clip-rule="evenodd" />
                     </svg>
                  </a>
               @else
                  <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                     <span
                        class="relative inline-flex items-center px-1 py-1 mx-1 -ml-px text-xs lg:text-lg font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md leading-5 dark:bg-gray-800 dark:border-gray-600 h-full"
                        aria-hidden="true">
                        <svg class="w-4 h-4 lg:w-6 lg:h-6" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd"
                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                              clip-rule="evenodd" />
                        </svg>
                     </span>
                  </span>
               @endif

               {{-- Last Page Link --}}
               @if ($paginator->hasMorePages())
                  <a href="{{ $paginator->url($paginator->lastPage()) }}"
                     class="relative inline-flex items-center px-1 py-1 mx-1 -ml-px text-xs lg:text-lg font-medium text-white bg-gray-600 border border-gray-600 rounded-r-md leading-5 hover:bg-gray-600 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-700 transition ease-in-out duration-150 dark:bg-gray-700 dark:border-gray-800 dark:hover:bg-gray-600 dark:active:bg-gray-900 dark:focus:border-blue-800"
                     aria-label="{{ __('pagination.last') }}">
                     <svg class="w-4 h-4 lg:w-6 lg:h-6 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                           d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z M13.293 14.707a1 1 0 010-1.414L16.586 10 13.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                           clip-rule="evenodd" />
                     </svg>
                  </a>
               @endif
            </span>
         </div>
      </div>
   </nav>
@endif
