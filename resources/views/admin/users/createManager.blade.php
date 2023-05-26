<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer un nouveau gestionnaire
        </h2>
    </x-slot>

    <a href="{{ route('admin.users.create') }}" id="changerType" style="text-decoration:underline">Changer de type d'utilisateur</a>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <x-form action="{{ route('admin.users.storeManager') }}">
            <x-form-input name="name" :label="__('Name')" required />
            <x-form-input type="email" name="email" :label="__('Email')" required />
            <x-form-input type="tel" name="telephone" :label="__('Telephone')" required />
            <x-form-input name="company" :label="__('Company\'s name')" required />
            <x-form-input type="datetime-local" id="myDateTime" name="activation_start" :label="__('Start of activation')" required />
            <x-form-input type="datetime-local" id="myDateTime2" name="activation_end" :label="__('End of activation')" />
            <x-form-input type="password" name="password" :label="__('Password')" required />
            <x-form-input type="password" name="password_confirmation" :label="__('Confirm Password')" required />
            <x-form-submit />
        </x-form>
    </div>

<script>
    var now = new Date();
    var year = now.getFullYear();
    var month = ('0' + (now.getMonth() + 1)).slice(-2);
    var day = ('0' + now.getDate()).slice(-2);
    var hours = ('0' + now.getHours()).slice(-2);
    var minutes = ('0' + now.getMinutes()).slice(-2);
    var formattedDateTime = year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;
    document.getElementById('myDateTime').value = formattedDateTime;
    document.getElementById('myDateTime').min = formattedDateTime;


    document.getElementById('myDateTime2').min = formattedDateTime;
</script>

</x-app-layout>
