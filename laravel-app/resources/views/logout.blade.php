<h2>Force Logout</h2>

<form method="POST" action="{{ route('patient.logout') }}">
    @csrf
    <button type="submit">Logout (Patient)</button>
</form>

<form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button type="submit">Logout (Admin)</button>
</form>
