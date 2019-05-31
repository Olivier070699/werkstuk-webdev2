@foreach($sponsors as $sponsor)
    @if(\Auth::user()->id == $sponsor->user_id)
    <ul>
        <li>amount: {{ $sponsor->credits }}</li>
        <li>date: {{ $sponsor->created_at }}</li>
    </ul>
    @endif
@endforeach