@extends('layouts.app')

@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Etudiants</h2>
            </div>

        </div>
        <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
            <div
                class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
                <div class="w-2/12 px-4 py-3">Nom</div>
                <div class="w-2/12 px-4 py-3">Email</div>
                <div class="w-2/12 px-4 py-3">Classe</div>
                <div class="w-2/12 px-4 py-3">Téléphone</div>
                <div class="w-2/12 px-4 py-3">evaluation </div>
                <div class="w-2/12 px-4 py-3">note </div>
            </div>
            @foreach ($students as $student)
                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                    <div
                        class="w-2/12 px-3 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $student->user->name }}</div>
                    <div
                        class="w-2/12 px-3 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $student->user->email }}</div>
                    <div
                        class="w-2/12 px-3 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $student->class->class_name ?? '' }}</div>
                    <div
                        class="w-2/12 px-3 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $student->phone }}</div>
                    <div
                        class="d-flex flex-row w-2/12 px-3 py-3 text-sm font-semibold text-gray-600 tracking-tight text-center">{{ $student->evaluation }}
                    </div>
                    <div
                        class="d-flex flex-row w-2/12 px-3 py-3 text-sm font-semibold text-gray-600 tracking-tight text-center">{{ $student->note }}
                    </div>

                    <div class="w-2/12 flex items-center justify-end px-3">
                        <a href="{{ route('evs',$student->id) }}"
                           class="ml-1 bg-gray-600 block p-1 border border-gray-600 rounded-sm" title="Affichage">
                            <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false"
                                 data-prefix="far" data-icon="eye" class="svg-inline--fa fa-eye fa-w-18" role="img"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path fill="currentColor"
                                      d="M288 144a110.94 110.94 0 0 0-31.24 5 55.4 55.4 0 0 1 7.24 27 56 56 0 0 1-56 56 55.4 55.4 0 0 1-27-7.24A111.71 111.71 0 1 0 288 144zm284.52 97.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400c-98.65 0-189.09-55-237.93-144C98.91 167 189.34 112 288 112s189.09 55 237.93 144C477.1 345 386.66 400 288 400z"></path>
                            </svg>
                        </a>
                        <a href="{{ route('eve',$student->id) }}" class="ml-1">
                            <svg class="h-6 w-6 fill-current text-gray-600" aria-hidden="true" focusable="false"
                                 data-prefix="fas" data-icon="pen-square" class="svg-inline--fa fa-pen-square fa-w-14"
                                 role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor"
                                      d="M400 480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zM238.1 177.9L102.4 313.6l-6.3 57.1c-.8 7.6 5.6 14.1 13.3 13.3l57.1-6.3L302.2 242c2.3-2.3 2.3-6.1 0-8.5L246.7 178c-2.5-2.4-6.3-2.4-8.6-.1zM345 165.1L314.9 135c-9.4-9.4-24.6-9.4-33.9 0l-23.1 23.1c-2.3 2.3-2.3 6.1 0 8.5l55.5 55.5c2.3 2.3 6.1 2.3 8.5 0L345 199c9.3-9.3 9.3-24.5 0-33.9z"></path>
                            </svg>
                        </a>
                        <a href="{{ route('student.contact',$student->id) }}"
                           class="ml-1 bg-gray-600 block p-1 border border-gray-600 rounded-sm" title="Contacter">
                           <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" fill="white" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
                            <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                          </svg>
                        </a>
                    </div>
                </div>
                @endforeach
        </div>
        <div class="mt-8">
            {{ $students->links() }}
        </div>

        @include('backend.modals.delete',['name' => 'student'])
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $(".deletestudent").on("click", function (event) {
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
