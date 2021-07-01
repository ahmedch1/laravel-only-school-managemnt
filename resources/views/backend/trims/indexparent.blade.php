@extends('layouts.app')

@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold"> Les Programmes Trimestriels</h2>
            </div>
        </div>
        <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
            <div
                class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
                <div class="w-2/12 px-4 py-3">Nom</div>
                <div class="w-2/12 px-4 py-3">Nom de fichier</div>
                <div class="w-2/12 px-4 py-3">Description</div>
                <div class="w-2/12 px-4 py-3 text-right">Action</div>
            </div>
            @foreach ($trims as $trim)
                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                    <div
                        class="w-2/12 px-3 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $trim->name }}</div>
                    <div
                        class="w-2/12 px-3 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $trim->link }}</div>
                    <div
                        class="w-2/12 px-3 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $trim->description }}</div>

                    <div class="w-2/12 flex items-center justify-end px-3">
                        @role('Student')
                        <a href="{{ route('trims.show',$trim->id) }}"
                           class="ml-1 bg-gray-600 block p-1 border border-gray-600 rounded-sm" title="Affichage">
                            <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false"
                                 data-prefix="far" data-icon="eye" class="svg-inline--fa fa-eye fa-w-18" role="img"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path fill="currentColor"
                                      d="M288 144a110.94 110.94 0 0 0-31.24 5 55.4 55.4 0 0 1 7.24 27 56 56 0 0 1-56 56 55.4 55.4 0 0 1-27-7.24A111.71 111.71 0 1 0 288 144zm284.52 97.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400c-98.65 0-189.09-55-237.93-144C98.91 167 189.34 112 288 112s189.09 55 237.93 144C477.1 345 386.66 400 288 400z"></path>
                            </svg>
                        </a>
                        @endrole
                        @role('Parent')
                        <a href="{{ route('trim.show',$trim->id) }}"
                            class="ml-1 bg-gray-600 block p-1 border border-gray-600 rounded-sm" title="Affichage">
                             <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false"
                                  data-prefix="far" data-icon="eye" class="svg-inline--fa fa-eye fa-w-18" role="img"
                                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                 <path fill="currentColor"
                                       d="M288 144a110.94 110.94 0 0 0-31.24 5 55.4 55.4 0 0 1 7.24 27 56 56 0 0 1-56 56 55.4 55.4 0 0 1-27-7.24A111.71 111.71 0 1 0 288 144zm284.52 97.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400c-98.65 0-189.09-55-237.93-144C98.91 167 189.34 112 288 112s189.09 55 237.93 144C477.1 345 386.66 400 288 400z"></path>
                             </svg>
                         </a>
                        @endrole
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $trims->links() }}
        </div>

        @include('backend.modals.delete',['name' => 'trim'])
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $(".deletetrim").on("click", function (event) {
                event.preventDefault();
                $("#deletemodal").toggleClass("hidden");
                var url = $(this).attr('data-url');
                $(".remove-record").attr("action", url);
            })

            $("#deletemodelclose").on("click", function (event) {
                event.preventDefault();
                $("#deletemodal").toggleClass("hidden");
            })
        })
    </script>
@endpush
