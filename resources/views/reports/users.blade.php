<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users Report</title>
</head>
<body>
    <h3 style="text-align: center; text-decoration: underline;">{{ __('reports.users_report') }}</h3>
    <table border="1" style="width: 100%">
        <thead>
            <tr>
                <th>{{ __('reports.name') }}</th>
                <th>{{ __('reports.email') }}</th>
                <th>{{ __('reports.tweets_count') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->tweets_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h4>{{ __('reports.avg_tweets_per_user') }} : {{ $averagePerUser }}</h4>
</body>
</html>
