<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola User</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('partials.flash')

            <div class="bg-white shadow sm:rounded-lg p-6 overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2">Nama</th>
                            <th class="p-2">Email</th>
                            <th class="p-2">Role</th>
                            <th class="p-2">Ubah Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $u)
                            <tr class="border-b">
                                <td class="p-2">{{ $u->name }}</td>
                                <td class="p-2">{{ $u->email }}</td>
                                <td class="p-2">{{ $u->role }}</td>
                                <td class="p-2">
                                    <form method="POST" action="{{ route('users.role', $u) }}" class="flex gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role" class="border-gray-300 rounded text-sm">
                                            <option value="staff" @selected($u->role == 'staff')>staff</option>
                                            <option value="admin" @selected($u->role == 'admin')>admin</option>
                                        </select>
                                        <button class="bg-blue-600 text-white px-3 rounded">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">{{ $users->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>