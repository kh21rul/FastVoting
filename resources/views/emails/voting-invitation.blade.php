<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Invitation | FastVoting</title>
    <style>
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 24px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            transition-duration: 0.4s;
        }

        .button:hover {
            background-color: #ffffff; /* Green */
            color: rgb(0, 0, 0);
            border: 2px;
            border-color: #4CAF50;
        }
    </style>
</head>
<body>
    <h1 style="color: #5463FF;text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.25);">FastVoting</h1>
    <h3>Hello, {{ $voter->name }}!</h3>
    <p>You has been invited to vote
    <table style="background-color: #f3f4f5; width:90%;">
        <tr>
            <td>Tittle</td>
            <td><strong>{{ $voter->event->title }}</strong></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><strong>{{ $voter->event->description }}</strong></td>
        </tr>
        <tr>
            <td>Invited by</td>
            <td><strong>{{ $voter->event->creator->name }}</strong></td>
        </tr>
        <tr>
            <td>Invited email</td>
            <td><strong>{{ $voter->event->creator->email }</strong></td>
        </tr>
        <tr>
            <td>Starting from</td>
            <td><strong>{{ $voter->event->started_at }}</strong></td>
        </tr>
        <tr>
            <td>Closed at</td>
            <td><strong>{{ $voter->event->finished_at }}</strong></td>
        </tr>
    </table>
    <p>Please click on the link below to vote.</p>

    <a href="{{ route('vote') }}" class="button"><strong>Vote Now</strong></a>

    <p><strong>Warning!</strong> Don't share and give this vote link to anybody.</p>
    <p>Thank you for your participation!</p>
    <p>FastVoting</p>
    <hr>
    <p>If you can't click on the vote link, copy and paste the following URL into your browser:</p>
    <p>{{ route('vote') }}</p>
</body>
</html>
