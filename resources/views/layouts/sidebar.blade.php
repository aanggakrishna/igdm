<div class="min-h-screen flex flex-col flex-shrink-0 antialiased bg-gray-800 text-gray-100 w-64">
    <div class="flex flex-col top-0 left-0 w-64 bg-gray-900 h-full border-r border-gray-800">
        <div class="flex items-center justify-center h-14 border-b border-gray-800">
            <div class="text-xl font-bold">My App</div>
        </div>
        <div class="overflow-y-auto overflow-x-hidden flex-grow">
            <ul class="flex flex-col py-4 space-y-1">
                <li class="px-5">
                    <div class="flex flex-row items-center h-8">
                        <div class="text-sm font-light tracking-wide text-gray-400 uppercase">Menu</div>
                    </div>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-gray-100 border-l-4 border-transparent hover:border-blue-500 pr-6 {{ request()->routeIs('dashboard') ? 'bg-gray-700 border-blue-500' : '' }}">
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-gray-100 border-l-4 border-transparent hover:border-blue-500 pr-6 {{ request()->routeIs('users.*') ? 'bg-gray-700 border-blue-500' : '' }}">
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('instagram.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-gray-100 border-l-4 border-transparent hover:border-blue-500 pr-6 {{ request()->routeIs('instagram.index') ? 'bg-gray-700 border-blue-500' : '' }}">
                        <span class="inline-flex justify-center items-center ml-4">
                            <!-- Suggestion: Using a chat bubble icon or similar -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Messages</span>
                    </a>
                </li>
                <li class="px-5">
                    <div class="flex flex-row items-center h-8">
                        <div class="text-sm font-light tracking-wide text-gray-400 uppercase">Settings</div>
                    </div>
                </li>
                <li>
                   <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700 text-gray-100 border-l-4 border-transparent hover:border-red-500 pr-6">
                            <span class="inline-flex justify-center items-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Logout</span>
                        </a>
                   </form>
                </li>
            </ul>
        </div>
    </div>
</div>
