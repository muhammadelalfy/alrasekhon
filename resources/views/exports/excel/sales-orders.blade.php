<table>
    <thead>
    <tr>
        <th>Order Id</th>
        <th>Order Type</th>
        <th>Customer Name</th>
        <th>Customer Code</th>
        <th>Customer Address</th>
        <th>Segment</th>
        <th>Sub Segment</th>
        <th>Creation Date</th>
        <th>Sales Origins</th>
        <th>Warehouse</th>
        <th>Delivery Duration</th>
        <th>Driver</th>
        <th>Total</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $record)
        <tr>
            <td>{{ $record->dynamics_id }}</td>
            <td>{{ $record->getType() }}</td>
            <td>{{ $record->customer?->name }}</td>
            <td>{{ $record->customer?->dynamics_id }}</td>
            <td>{{ $record->address_from }}</td>
            <td>{{ $record->segment?->name }}</td>
            <td>{{ $record->subSegment?->name }}</td>
            <td>{{ $record->creation_date }}</td>
            <td>{{ $record->originalWarehouse?->name }}</td>
            <td>{{ $record->warehouse?->name }}</td>
            <td>{{ $record->getStatusBetweenDuration(\App\Constants\OrderStatusConstants::TYPE_STATUS_PICKED_VALUE, \App\Constants\OrderStatusConstants::TYPE_STATUS_DELIVERED_VALUE) }}</td>
            <td>{{ $record->driver?->name }}</td>
            <td>{{ $record->items()->sum('price') }}</td>
            <td>{{ $record->getStatus()?->getStatusValueText() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
