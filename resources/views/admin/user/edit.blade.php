<x-admin-layout :title="(isset($user) ? 'Edit' : 'New' ). ' User'">
    @include('admin.user.form', [
        "user" => $user,
        "action" => isset($user) ? route('admin.users.update', $user) : route('admin.users.store'),
        "method" => isset($user) ? 'PUT' : 'POST'
    ])
</x-admin-layout>
