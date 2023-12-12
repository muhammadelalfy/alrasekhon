<table>
    <thead>
    <tr>
        <th>RT Code</th>
        <th>Name</th>
        <th>Segment</th>
        <th>Total Orders</th>
        <th>Average Delivery Duration</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $record)
        <tr>
            <td>{{ $record->rt_code }}</td>
            <td>{{ $record->name }}</td>
            <td>{{ $record->segment?->name }}</td>
            <td>{{ $record->orders_count }}</td>
            <td>{{ $record->averageDeliveredDuration() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
