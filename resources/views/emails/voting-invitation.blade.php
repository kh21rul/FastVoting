<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Invitation | FastVoting</title>
</head>
<body>
    <h1>Hello, {{ $voter->name }}!</h1>
    <p>You has been invited to vote in <strong>{{ $voter->event->title }}</strong> by {{ $voter->event->creator->name }} ({{ $voter->event->creator->email }}).</p>
    <p>You have time to vote starting from <strong>{{ $voter->event->started_at }}</strong> until <strong>{{ $voter->event->finished_at }}</strong>.</p>
    <p>Please click on the link below to vote.</p>

    <a href="{{ route('vote', ['voterId' => $voter->id, 'token' => $voter->token]) }}"><strong>Vote Now</strong></a>

    <p><strong>Warning!</strong> Don't share and give this vote link to anybody.</p>
    <p>Thank you for your participation!</p>
    <p>FastVoting</p>
    <hr>
    <p>If you can't click on the vote link, copy and paste the following URL into your browser:</p>
    <p>{{ route('vote', ['voterId' => $voter->id, 'token' => $voter->token]) }}</p>
</body>
</html>
