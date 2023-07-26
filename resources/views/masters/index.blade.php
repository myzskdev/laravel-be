<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Masters') }}
        </h2>
    </x-slot>

    <div x-data="{ showMessage: true }" x-show="showMessage" class="flex justify-center mt-10" x-init="setTimeout(() => showMessage = false, 3000)">
        @if (session()->has('status'))
        <div class="flex items-center justify-between max-w-xl p-4 bg-white border rounded-md shadow-sm">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <p class="ml-3 text-sm font-bold text-green-600">{{ session()->get('status') }}</p>
            </div>
            <span @click="showMessage = false" class="inline-flex items-center cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
        </div>
        @endif
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('masters.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Create Master
                </a>
            </div>
            <div class="bg-white">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="border px-6 py-4">No</th>
                            <th class="border px-6 py-4">Parent</th>
                            <th class="border px-6 py-4">Name</th>
                            <th class="border px-6 py-4">Value</th>
                            <th class="border px-6 py-4">Description</th>
                            <th class="border px-6 py-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{ $masters }}
                        @forelse ($masters as $key => $item)
                            <tr>
                                <th class="border px-6 py-4">{{ $key+1 }}</th>
                                <th class="border px-6 py-4">{{ $item->master ? $item->master : '' }}</th>
                                <th class="border px-6 py-4">{{ $item->name }}</th>
                                <th class="border px-6 py-4">{{ $item->value }}</th>
                                <th class="border px-6 py-4">{{ $item->description }}</th>
                                <th class="border px-6 py-4 text-center">
                                    <a href="{{ route('masters.edit', $item->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mx-2 rounded">
                                        Edit
                                    </a>
                                    <form action="{{ route('masters.destroy', $item->id) }}" method="POST" class="inline-block">
                                        {!! method_field('delete') . csrf_field() !!}
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mx-2 rounded">
                                            Delete
                                        </button>
                                    </form>
                                </th>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="border text-center p-5">
                                    Data not found!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-5">
                {{ $masters->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
