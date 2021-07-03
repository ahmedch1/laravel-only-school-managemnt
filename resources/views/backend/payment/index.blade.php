@extends('layouts.app')

@section('content')
    <div class="roles-permissions">
        @role('Admin')
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Payments</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('payment.create') }}"
                   class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas"
                         data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor"
                              d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                    </svg>
                    <span class="ml-2 text-xs font-semibold">Payment</span>
                </a>
            </div>
        </div>
        @endrole
        <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
            <div
                class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
                <div class="w-3/12 px-4 py-3">Nom</div>
                <div class="w-2/12 px-4 py-3">Prix</div>
                <div class="w-2/12 px-4 py-3">Description</div>
                <div class="w-2/12 px-4 py-3">Etat</div>
                <div class="w-2/12 px-4 py-3 text-right">Action</div>
            </div>
            @role('Admin')
            @foreach ($payment as $payment)
                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                    <div
                        class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $payment->user->name }}</div>
                    <div
                        class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $payment->amount }}</div>
                    <div
                        class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $payment->description }}</div>
                    @if ($payment->state == 0)
                    <div
                    class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">Non-Payé</div>
                    @else
                    <div
                    class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">Payé</div>
                    @endif    

                    <div class="w-2/12 flex items-center justify-end px-3">
                        <a href="{{ route('payment.edit',$payment->id) }}">
                            <svg class="h-6 w-6 fill-current text-gray-600" aria-hidden="true" focusable="false"
                                 data-prefix="fas" data-icon="pen-square" class="svg-inline--fa fa-pen-square fa-w-14"
                                 role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor"
                                      d="M400 480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zM238.1 177.9L102.4 313.6l-6.3 57.1c-.8 7.6 5.6 14.1 13.3 13.3l57.1-6.3L302.2 242c2.3-2.3 2.3-6.1 0-8.5L246.7 178c-2.5-2.4-6.3-2.4-8.6-.1zM345 165.1L314.9 135c-9.4-9.4-24.6-9.4-33.9 0l-23.1 23.1c-2.3 2.3-2.3 6.1 0 8.5l55.5 55.5c2.3 2.3 6.1 2.3 8.5 0L345 199c9.3-9.3 9.3-24.5 0-33.9z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('payment.destroy',$payment->id) }}" method="POST"
                              class="inline-flex ml-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gray-600 block p-1 border border-gray-600 rounded-sm">
                                <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false"
                                     data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14"
                                     role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="currentColor"
                                          d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
            @endrole
            @role('Parent')
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">{{ session('success') }}</strong>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                  <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
              </div>
            @endif
            @foreach ($payments as $payment)
                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                    <div
                        class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $payment->user->name }}</div>
                    <div
                        class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $payment->amount }}</div>
                    <div
                        class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $payment->description }}</div>
                    @if ($payment->state == 0)
                    <div
                    class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">Non-Payé</div>
                    @else
                    <div
                    class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">Payé</div>
                    @endif    

                    <div class="w-2/12 flex items-center justify-end px-3">
                        @if($payment->state == 0)
                        <a href="{{ route('payment.check',$payment->id) }}" class="bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                            Payer
                        </a>
                        @else
                        <span class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                            Payé
                        </span>
                        @endif                        
                    </div>
                </div>
            @endforeach
            @endrole
        </div>

    </div>
@endsection
