<x-app-layout>
    <x-slot name="header">
    </x-slot>
<!-- Example: resources/views/admin/user.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
</head>
<body>
    <h1>User Details</h1>

    @if(isset($user))
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Student Number:</strong> {{ $user->student_number }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Contact:</strong> {{ $user->contact }}</p>
        <p><strong>Dry Seal:</strong> {{ $user->dry_seal }}</p>
    @else
        <p>No user data available.</p>
    @endif
</body>
</html>

   
    </div>
</x-app-layout>
