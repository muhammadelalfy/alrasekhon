<?php

namespace App\Http\Resources;

use App\Constants\OrderConstants;
use App\Constants\OrderStatusConstants;
use Carbon\Carbon;
use \Illuminate\Http\Request;

class OrderResource extends BaseResource
{

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $this->micro = [
            'id' => $this->id,
            'code' => $this->dynamics_id,
            'type' => $this->getType() ,
            'creation_date' => Carbon::parse($this->creation_date)->format('Y-m-d H:i'),
            'standard_delivery_duration' => $this->standard_delivery_duration,
            'received_at' => $this->created_at->format('Y-m-d H:i'),
        ];

        $this->mini = [];

        $this->full = [];

        $this->relations = [
            'status' => $this->relationLoaded("statuses") ? new OrderStatusResource($this->getStatus()) : [],
            'customer' => $this->getCustomer(),
            'segment' => $this->relationLoaded('segment') ? new SegmentResource($this->segment) : [],
            'sub_segment' => $this->relationLoaded('subSegment') ? new SegmentResource($this->subSegment) : [],
            'invoice_status' => $this->relationLoaded("statuses") ? new OrderStatusResource($this->getInvoiceStatus()) : [],
            'assigned_status' => $this->relationLoaded("statuses") ? new OrderStatusResource($this->getTypeStatus(OrderStatusConstants::TYPE_STATUS_ASSIGNED_VALUE)) : [],
            'picked_status' => $this->relationLoaded("statuses") ? new OrderStatusResource($this->getTypeStatus(OrderStatusConstants::TYPE_STATUS_PICKED_VALUE)) : [],
            'duration_color' => $this->relationLoaded("statuses") ? $this->getStatusDurationToNowColor() : '',
            'delivered_status' => $this->relationLoaded("statuses") ? new OrderStatusResource($this->getTypeStatus(OrderStatusConstants::TYPE_STATUS_DELIVERED_VALUE)) : [],
            'assigned_warehouse' => $this->relationLoaded('warehouse') ? new WarehouseResource($this->warehouse) : [],
            'original_warehouse' => $this->relationLoaded('originalWarehouse') ? new WarehouseResource($this->originalWarehouse) : [],
            'assigned_driver' => $this->relationLoaded('driver') ? new DriverResource($this->driver) : [],
            'total_price' => $this->relationLoaded('items') ?  round($this->items->sum('pivot.price'), 2) : 0,
            'total_net_price' => $this->relationLoaded('items') ?  round($this->items->sum('pivot.net_amount'), 2) : 0,
            'total_items' => $this->relationLoaded('items') ? $this->items->count() : 0,
            'actions_enabled' => $this->relationLoaded("statuses") ? $this->actionsEnabled() : [],
            'pick_to_deliver_duration' => $this->relationLoaded("statuses") ? $this->getStatusBetweenDuration(OrderStatusConstants::TYPE_STATUS_PICKED_VALUE, OrderStatusConstants::TYPE_STATUS_DELIVERED_VALUE) : 0,
            'new_to_assign_duration' => $this->relationLoaded("statuses") ? $this->getStatusBetweenDuration(OrderStatusConstants::TYPE_STATUS_NEW_VALUE, OrderStatusConstants::TYPE_STATUS_ASSIGNED_VALUE) : 0,
            'assign_to_pick_duration' => $this->relationLoaded("statuses") ? $this->getStatusBetweenDuration(OrderStatusConstants::TYPE_STATUS_ASSIGNED_VALUE, OrderStatusConstants::TYPE_STATUS_PICKED_VALUE) : 0,
            'items'=>  $this->relationLoaded('items') ?  OrderItemResource::collection($this->items) : [],
            'notes'=> $this->relationLoaded("notes") ? NoteResource::collection($this->notes) : []
        ];

        return $this->getResource();
    }

    public function getCustomer(): CustomerResource|array
    {
        if ($this->relationLoaded('customer'))
        {
            $this->customer->address = $this->address_from;
            return new CustomerResource($this->customer);
        } else {
            return [];
        }
    }

}
