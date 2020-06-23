<h1>{{ env('APP_NAME') }}</h1>
<div class="container">
    <p>От: {{ $data['name'] }}</p>
    <p>Email: {{ $data['email'] }}</p>
    <p>Телефон: {{ $data['phone'] }}</p>
    <p>{{ $data['message'] }}</p>
</div>
