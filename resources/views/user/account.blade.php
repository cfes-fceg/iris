<x-user-layout :title="__('My profile')">
    @include('admin.user.form', [
        "user" => $user,
        "action" => route('account'),
        "method" => 'PUT'
    ])
</x-user-layout>
