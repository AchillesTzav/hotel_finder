@props(['user'])

<div
    class="flex items-center gap-3 bg-gray-100 text-gray-800 px-3 py-2 rounded-lg shadow-sm max-w-fit hover:bg-gray-300 hover:cursor-pointer">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="w-5 h-5 text-gray-500">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.1a7.5 7.5 0 0 1 15 0A18 18 0 0 1 12 21.75a18 18 0 0 1-7.5-1.65Z" />
    </svg>
    <span class="text-sm font-medium">{{ $user->email }}</span>
    <span class="text-sm text-gray-600">{{ $user->name }}</span>
</div>