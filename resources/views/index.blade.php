<x-app-layout>
    @section('head')
        <title>MUPI</title>
    @endsection

    <div
        class="relative h-full min-h-screen max-w-sm mx-auto bg-primary/15 p-4 text-zinc-600 overflow-scroll no-scrollbar">
        <div class="relative bg-primary/30 rounded-xl px-2 py-1.5 shadow-xl border-primary">
            <div class="relative flex justify-between items-center">
                <x-application-logo class="w-14 h-14 p-1.5 fill-current text-gray-500" />
                <div class="w-full flex items-center">
                    <h1 class="text-4xl font-extrabold">MUPI</h1>
                    <div class="px-2">
                        <p class="base text-xs font-medium leading-tight">
                            There is only one goal, to connect together.
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <div class="py-4 mb-14">
            @if (!$results)
                <div class="relative bg-primary/30 flex items-center space-x-2 rounded shadow-xl border-primary ">
                    <img src="{{ asset('img/result.png') }}" alt="RESULT"
                        class="w-14 h-14 p-1.5 fill-current text-gray-500" />
                    <p class="font-bold text-sm leading-tight">Check All Polytechnic Results in one Application</p>
                </div>
            @endif


            <div class="relative py-5">
                @isset($results)
                    <div class="relative grid gap-4">
                        @foreach ($results as $result)
                            @json($result)
                            <div
                                class="relative bg-primary/30 min-h-[3.5rem] flex items-center space-x-2 rounded shadow-xl border-primary ">
                                <img src="{{ asset('img/result.png') }}" alt="RESULT"
                                    class="w-14 h-14 p-1.5 fill-current text-gray-500" />
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-emerald-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>

                                <p class="font-bold text-sm leading-tight">
                                    {{ $result->semester }}
                                    {{ $result->gpa }}
                                </p>

                                {{ $result->failed }}
                            </div>
                        @endforeach
                    </div>
                @else
                    <form action="{{ route('result') }}" class="relative space-y-2" method="post">
                        @csrf
                        <div class="relative grid">
                            <p class="text-xs font-semibold text-zinc-600">Semester</p>
                            {!! Form::select('semester', $semesters, '1st', [
                                'class' =>
                                    'px-4 py-2 text-zinc-500 font-extrabold text-sm bg-white border rounded-md focus:border-primary/20 focus:outline-none focus:ring focus:ring-primary focus:ring-opacity-40 border-primary',
                            ]) !!}
                            @error('semester')
                                <p class="text-xs font-semibold text-red-600 dark:text-red-500">
                                    {{ __($message) }}
                                </p>
                            @enderror
                        </div>
                        <div class="relative grid">
                            <p class="text-xs font-semibold text-zinc-600">Roll No</p>
                            <input type="number" name="roll" id="roll" placeholder="e.g. 113838" min="1"
                                value="{{ old('roll') }}"
                                class='px-4 py-2 text-zinc-500 font-extrabold text-sm bg-white border rounded-md focus:border-primary/20 focus:outline-none focus:ring focus:ring-primary focus:ring-opacity-40 border-primary placeholder:text-zinc-300 placeholder:font-medium'>
                            @error('roll')
                                <p class="text-xs font-semibold text-red-600 dark:text-red-500">
                                    {{ __($message) }}
                                </p>
                            @enderror
                        </div>
                        <div class="grid py-2">
                            <button type="submit"
                                class='w-full flex items-center justify-center px-4 py-2 text-zinc-700 font-extrabold text-sm bg-primary border rounded-md focus:border-primary/20 focus:outline-none focus:ring focus:ring-primary focus:ring-opacity-40 border-primary placeholder:text-zinc-300 placeholder:font-medium'>
                                {{-- <x-spinner class="h-6 w-6 p-1 mx-1.5 animate-spin fill-slate-600 text-slate-100 " /> --}}
                                View Result
                            </button>
                        </div>
                    </form>
                @endisset
            </div>
        </div>

        <div class="absolute h-14 w-full left-0 right-0 bottom-0 max-w-sm bg-primary/30 z-10">
            <div class="relative flex justify-center items-center px-3 space-x-2">
                <p class="base text-xs font-medium leading-tight">
                    This app is developed by
                </p>

                <x-orioca class="w-14" />

            </div>
        </div>
    </div>
</x-app-layout>
