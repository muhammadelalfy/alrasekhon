<table>
    <thead>
    <tr>
        <th>code</th>
        <th>RT Code</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Status</th>
        <th>Order Count</th>
        <th>Segment</th>
        <th>Creation Date</th>
        <th>Active Date</th>
        <th>Inactive Date</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $record)
        <tr>
            <td>{{ $record->code }}</td>
            <td>{{ $record->rt_code }}</td>
            <td>{{ $record->name }}</td>
            <td>{{ $record->phone }}</td>
            <td>{{ $record->email }}</td>
            <td>{{ $record->statusText() }}</td>
            <td>{{ $record->order_count }}</td>
            <td>{{ $record->segment?->name }}</td>
            <td>{{ $record->created_at?->format('Y-m-d H:i:s') }}</td>
            <td>{{ $record->active_at?->format('Y-m-d H:i:s') }}</td>
            <td>{{ $record->inactive_at?->format('Y-m-d H:i:s') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
