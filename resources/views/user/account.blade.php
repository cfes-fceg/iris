<x-user-layout title="My Account">
    @include('admin.user.form', [
        "user" => $user,
        "action" => route('account'),
        "method" => 'PUT'
    ])
</x-user-layout>
