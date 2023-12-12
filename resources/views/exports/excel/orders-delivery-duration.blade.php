<table>
    <thead>
    <tr>
        <th>Driver code</th>
        <th>Driver Name</th>
        <th>Segment</th>
        <th>Total Orders</th>
        <th>TIME BETWEEN RECEIVING AND ASSIGN</th>
        <th>TIME BETWEEN RECEIVING AND ASSIGN ( AVERAGE )</th>
        <th>TIME BETWEEN ASSIGN AND PICKED</th>
        <th>TIME BETWEEN ASSIGN AND PICKED ( AVERAGE )</th>
        <th>TIME BETWEEN PICKED AND DELIVERED</th>
        <th>TIME BETWEEN PICKED AND DELIVERED ( AVERAGE )</th>
        <th>TOTAL DELIVERY TIME</th>
        <th>TOTAL DELIVERY TIME ( AVERAGE )</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $record)
        <tr>
            <td>{{ $record->code }}</td>
            <td>{{ $record->name }}</td>
            <td>{{ $record->segment?->name }}</td>
            <td>{{ $record->orders_count }}</td>
            <td>{{ $record->assignedReceivedDuration() }}</td>
            <td>{{ $record->averageAssignedReceivedDuration() }}</td>
            <td>{{ $record->pickedAssignedDuration() }}</td>
            <td>{{ $record->averagePickedAssignedDuration() }}</td>
            <td>{{ $record->deliveredPickedDuration() }}</td>
            <td>{{ $record->averageDeliveredPickedDuration() }}</td>
            <td>{{ $record->delivered_duration }}</td>
            <td>{{ $record->averageDeliveredDuration() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
