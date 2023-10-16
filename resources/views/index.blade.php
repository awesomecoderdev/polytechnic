<x-app-layout>
    @section('head')
        <title>MUPI</title>
    @endsection

    <div class="relative h-full max-w-sm mx-auto bg-primary/15 p-4 text-zinc-600 overflow-scroll">
        {{-- <a href="{{ route('index') }}"
            class="relative block bg-primary/30 rounded-xl px-2 py-1.5 shadow-xl border-primary ">
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
        </a> --}}

        <div class="py-4 mb-14">
            @if (!isset($results))
                <div class="relative bg-primary/30 flex items-center space-x-2 rounded shadow-xl border-primary ">
                    <img src="{{ asset('img/result.png') }}" alt="RESULT"
                        class="w-14 h-14 p-1.5 fill-current text-gray-500" />
                    <p class="font-bold text-sm leading-tight">Check All Polytechnic Results in one Application</p>
                </div>
            @endif


            <div class="relative py-5">
                @isset($results)
                    <div class="relative grid gap-3">

                        @foreach ($results as $result)
                            <div
                                class="relative bg-primary/30 min-h-[3.5rem] flex items-center space-x-2 rounded shadow-xl border-primary ">
                                <img src="{{ asset('img/result.png') }}" alt="RESULT"
                                    class="w-14 h-14 p-1.5 fill-current text-gray-500" />

                                @if ($result->gpa)
                                    <div
                                        class="relative flex items-center space-x-0.5 bg-emerald-200 pl-0.5 pr-1.5 py-0.5 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-emerald-700">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                                        </svg>
                                        <strong class="text-[10px] text-emerald-700">Passed</strong>
                                    </div>
                                @else
                                    <div
                                        class="relative flex items-center space-x-0.5 bg-red-200 pl-0.5 pr-1.5 py-0.5 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.182 16.318A4.486 4.486 0 0012.016 15a4.486 4.486 0 00-3.198 1.318M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                                        </svg>
                                        <strong class="text-[10px] text-red-700">Failed</strong>
                                    </div>
                                @endif

                                <p class="font-bold text-sm leading-tight flex items-center space-x-2">
                                    <span
                                        class="border rounded-full border-zinc-800 px-1 text-[12px]">{{ $result->semester }}</span>
                                    <strong class="text-emerald-600">{{ $result->gpa }}</strong>
                                </p>

                                <span class="absolute right-2 bottom-2 text-[10px] font-bold">Published :
                                    {{ $result->published }}</span>
                            </div>

                            @if ($result->failed)
                                <div class="relative bg-primary/20 p-2 rounded shadow-xl gap-3 border-red-600/25 border">
                                    @foreach (explode(', ', $result->failed) as $item)
                                        <span
                                            class="bg-red-500 text-white px-1.5 py-0.5 text-xs font-semibold mr-2 rounded-full">
                                            {{ $item }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                        <a href="{{ route('index') }}"
                            class='w-full flex items-center justify-center px-4 py-2 text-zinc-700 font-extrabold text-sm bg-primary border rounded-md focus:border-primary/20 focus:outline-none focus:ring focus:ring-primary focus:ring-opacity-40 border-primary placeholder:text-zinc-300 placeholder:font-medium'>
                            View Another Result
                        </a>
                    </div>
                @else
                    <form action="{{ route('result') }}" class="relative space-y-2" method="post">
                        @csrf
                        <div class="relative grid">
                            <p class="text-xs font-semibold text-zinc-600">Semester</p>
                            {!! Form::select('semester', $semesters, 'all', [
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
                        <div class="grid py-2" x-data="{ loading: false }">
                            <button type="submit" @click="loading = ! loading"
                                class='w-full flex items-center justify-center px-4 py-2 text-zinc-700 font-extrabold text-sm bg-primary border rounded-md focus:border-primary/20 focus:outline-none focus:ring focus:ring-primary focus:ring-opacity-40 border-primary placeholder:text-zinc-300 placeholder:font-medium'>
                                <x-spinner class="h-6 w-6 p-1 mx-1.5 animate-spin fill-slate-600 text-slate-100 "
                                    style="display: none;" x-show="loading" />
                                <span x-show="!loading">
                                    View Result
                                </span>
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
