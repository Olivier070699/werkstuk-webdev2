@foreach($sponsors as $sponsor)
        <ul>
            <li>Project: {{ $sponsor->project_id }}</li>
            <li>User: {{ $sponsor->user_id }}</li>
            <li>Credits: {{ $sponsor->credits }}</li>
        </ul>
@endforeach