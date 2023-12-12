<table>
    <thead>
    <tr>
        <th>Order Id</th>
        <th>Order Type</th>
        <th>Customer Name</th>
        <th>Customer Code</th>
        <th>Segment</th>
        <th>Warehouse</th>
        <th>Delivery Duration</th>
        <th>Driver</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $record)
        <tr>
            <td>{{ $record->dynamics_id }}</td>
            <td>{{ $record->getType() }}</td>
            <td>{{ $record->customer?->name }}</td>
            <td>{{ $record->customer?->dynamics_id }}</td>
            <td>{{ $record->segment?->name }}</td>
            <td>{{ $record->warehouse?->name }}</td>
            <td>{{ $record->getStatusBetweenDuration(\App\Constants\OrderStatusConstants::TYPE_STATUS_PICKED_VALUE, \App\Constants\OrderStatusConstants::TYPE_STATUS_DELIVERED_VALUE) }}</td>
            <td>{{ $record->driver?->name }}</td>
            <td>{{ $record->items()->sum('price') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
