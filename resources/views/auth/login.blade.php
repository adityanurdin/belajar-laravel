<form action="{{ route('login') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="email" name="email" placeholder="email"> <br>
    <input type="password" name="password" placeholder="password">
    <button type="submit">Login</button>
</form>