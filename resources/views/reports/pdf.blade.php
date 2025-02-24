<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ __('Performance Report for ') . $student->first_name }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>{{ __('Performance Report for ') . $student->first_name }}</h2>
    <p><strong>{{ __('Email:') }}</strong> {{ $student->email }}</p>

    <h3>{{ __('Exam Grades') }}</h3>
    <table>
        <thead>
            <tr>
                <th>{{ __('Exam Name') }}</th>
                <th>{{ __('Score') }}</th>
                <th>{{ __('Grade') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grades as $grade)
                <tr>
                    <td>{{ $grade->exam->exam_name }}</td>
                    <td>{{ $grade->score }}</td>
                    <td>{{ $grade->grade }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>{{ __('Attendance Record') }}</h3>
    <table>
        <thead>
            <tr>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Status') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendance as $attend)
                <tr>
                    <td>{{ $attend->classSchedule->date }}</td>
                    <td>{{ $attend->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
