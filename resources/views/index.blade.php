<x-app-layout>
    @section('head')
        <title>MUPI</title>
    @endsection

    <div
        class="relative h-full min-h-screen max-w-sm mx-auto bg-[#FFDC70]/25 p-4 text-zinc-600 overflow-x-hidden overflow-y-scroll">
        <div class="relative bg-[#FFDC70]/30 rounded-xl px-2 py-1.5">
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
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum, fugiat. Assumenda aliquam a eveniet
            aspernatur doloribus necessitatibus, similique nam veritatis voluptas tenetur cumque culpa id, repudiandae
            quibusdam alias hic. Sint.
        </div>

        <div class="absolute h-14 w-full left-0 right-0 bottom-0 max-w-sm bg-[#FFDC70]/30 z-10">
            <div class="relative flex justify-center items-center px-3 space-x-2">
                <p class="base text-xs font-medium leading-tight">
                    This app is developed by
                </p>

                <x-orioca class="w-14" />

            </div>
        </div>
    </div>
</x-app-layout>
