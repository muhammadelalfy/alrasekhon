<table>
    <thead>
    <tr>
        <th>Order Id</th>
        <th>Order Type</th>
        <th>Customer Name</th>
        <th>Customer Phone</th>
        <th>Segment</th>
        <th>Warehouse</th>
        <th>Sales Origins</th>
        <th>Creation Date</th>
        <th>Driver</th>
        <th>Received Time</th>
        <th>Assigned time</th>
        <th>Pickup time</th>
        <th>Delivered Time</th>
        <th>Time Between Receive And Assign</th>
        <th>Time Between assign And Pick</th>
        <th>Time Between Pick And Deliver</th>
        <th>Total Delivery Time</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $record)
        <tr>
            <td>{{ $record->dynamics_id }}</td>
            <td>{{ $record->getType() }}</td>
            <td>{{ $record->customer?->name }}</td>
            <td>{{ $record->customer?->phone }}</td>
            <td>{{ $record->segment?->name }}</td>
            <td>{{ $record->warehouse?->name }}</td>
            <td>{{ $record->originalWarehouse?->name }}</td>
            <td>{{ $record->creation_date }}</td>
            <td>{{ $record->driver?->name }}</td>
            <td>{{ $record->created_at->format('Y-m-d H:i') }}</td>
            <td>
                {{ $record->getTypeStatus(\App\Constants\OrderStatusConstants::TYPE_STATUS_ASSIGNED_VALUE)?->datetime }}
            </td>
            <td>
                {{ $record->getTypeStatus(\App\Constants\OrderStatusConstants::TYPE_STATUS_PICKED_VALUE)?->datetime }}
            </td>
            <td>
                {{ $record->getTypeStatus(\App\Constants\OrderStatusConstants::TYPE_STATUS_DELIVERED_VALUE)?->datetime }}
            </td>
            <td>
                {{ $record->getStatusBetweenDuration(\App\Constants\OrderStatusConstants::TYPE_STATUS_NEW_VALUE, \App\Constants\OrderStatusConstants::TYPE_STATUS_ASSIGNED_VALUE) }}
            </td>
            <td>
                {{ $record->getStatusBetweenDuration(\App\Constants\OrderStatusConstants::TYPE_STATUS_ASSIGNED_VALUE, \App\Constants\OrderStatusConstants::TYPE_STATUS_PICKED_VALUE) }}
            </td>
            <td>
                {{ $record->getStatusBetweenDuration(\App\Constants\OrderStatusConstants::TYPE_STATUS_PICKED_VALUE, \App\Constants\OrderStatusConstants::TYPE_STATUS_DELIVERED_VALUE) }}
            </td>
            <td>
                {{ $record->getTypeStatus(\App\Constants\OrderStatusConstants::TYPE_STATUS_DELIVERED_VALUE)?->duration }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
