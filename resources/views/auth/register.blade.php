@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form action="{{route('register')}}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nama" required> <br>
    <input type="email" name="email" placeholder="Email"> <br>
    <input type="password" name="password" placeholder="password"> <br>
    <input type="password" name="password_confirmation" placeholder="password confirmation"> <br>
    <button type="submit">Daftar</button>
</form>