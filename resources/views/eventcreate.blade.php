<x-layout>
    <div class="max-w-md mx-auto mt-10">
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('events.store') }}" method="POST" class="bg-gray-800 p-6 rounded-lg shadow-lg">
            @csrf
            <div class="relative z-0 w-full mb-5 group">
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('title') }}"
                    class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" 
                    placeholder=" " 
                />
                <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Event Title
                </label>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <textarea 
                    name="description" 
                    id="description" 
                    rows="3" 
                    class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" 
                    placeholder=" "
                >{{ old('description') }}</textarea>
                <label for="description" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Event Description
                </label>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <input 
                        type="datetime-local" 
                        name="start_datetime" 
                        placeholder="MM/DD/YYYY HH:mm AM/PM"
                        id="start_datetime" 
                        value="{{ old('start_datetime') }}"
                        class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" 
                    />
                    <label for="start_datetime" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Start Time
                    </label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input 
                        type="datetime-local" 
                        name="end_datetime" 
                        placeholder="MM/DD/YYYY HH:mm AM/PM"
                        id="end_datetime" 
                        value="{{ old('end_datetime') }}"
                        class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" 
                    />
                    <label for="end_datetime" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        End Time
                    </label>
                </div>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <input 
                    type="text" 
                    name="location" 
                    id="location" 
                    value="{{ old('location') }}"
                    class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" 
                    placeholder=" " 
                />
                <label for="location" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Event Location
                </label>
            </div>

            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">
                Create Event
            </button>
        </form>
    </div>
</x-layout>