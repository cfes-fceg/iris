<!-- component -->
<!-- This is an example component -->
<div class="my-2 px-4">
    <div class="bg-white rounded overflow-hidden shadow-lg">
        <div class="text-center p-6  border-b">
            <p class="pt-2 text-lg font-semibold">Administration</p>
        </div>
        <div class="border-b">
            <a href="{{ route('admin.sessions.index') }}" class="px-4 py-2 hover:bg-gray-100 flex">
                <div class="text-gray-800">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="pl-3">
                    <p class="text-sm font-medium text-gray-800 leading-none">Manage Sessions</p>
                    <p class="text-xs text-gray-500">Add/manage sessions</p>
                </div>
            </a>
            <a href="{{ route('admin.streams.index') }}" class="px-4 py-2 hover:bg-gray-100 flex">
                <div class="text-gray-800">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="pl-3">
                    <p class="text-sm font-medium text-gray-800 leading-none">Manage Streams</p>
                    <p class="text-xs text-gray-500">Add/manage session streams</p>
                </div>
            </a>
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 hover:bg-gray-100 flex">
                <div class="text-gray-800">
                    <i class="fas fa-user-edit"></i>
                </div>
                <div class="pl-3">
                    <p class="text-sm font-medium text-gray-800 leading-none">Manage Users</p>
                    <p class="text-xs text-gray-500">Add/manage users</p>
                </div>
            </a>
            <a href="{{ route('admin.import') }}" class="px-4 py-2 hover:bg-gray-100 flex">
                <div class="text-gray-800">
                    <i class="fas fa-upload"></i>
                </div>
                <div class="pl-3">
                    <p class="text-sm font-medium text-gray-800 leading-none">Import</p>
                    <p class="text-xs text-gray-500">Import data into the app</p>
                </div>
            </a>
        </div>

        <div class="">
            <a href="#" class="px-4 py-4 hover:bg-gray-100 flex">
                <p class="text-sm font-medium text-gray-800 leading-none">Logout</p>
            </a>
        </div>
    </div>
</div>
