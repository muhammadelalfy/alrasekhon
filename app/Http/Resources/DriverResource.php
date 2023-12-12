<?php

namespace App\Http\Resources;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DriverResource extends BaseResource
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
            'name'=> $this->name,
            'order_count' => $this->order_count,
            'available' => (bool) $this->available,
            'driver_info' => $this->name . ' - ' .$this->phone . ' - ' .$this->rt_code . ' - ' .$this->order_count
        ];

        $this->mini = [
            'code' => $this->code,
            'rt_code' => $this->rt_code,
            'phone' => $this->phone,
            'email' => $this->email,
            'description' => $this->description,
            'status_text' => $this->statusText(),
            'is_active' => (bool) $this->is_active,
            'avatar' => $this->relationLoaded("avatar") ? Storage::url($this->avatar->url) : "",
            'active_at' =>  $this->active_at?->format('Y-m-d H:i:s'),
            'inactive_at' =>  $this->inactive_at?->format('Y-m-d H:i:s'),
            'creation_date' => $this->created_at?->format('Y-m-d H:i:s'),
            $this->mergeWhen(isset($this->api_token), [
                'token' => $this->api_token,
            ])
        ];

        $this->full = [
            'received_duration' => $this->relationLoaded("orders") ? $this->received_duration : '',
            'assigned_duration' => $this->relationLoaded("orders") ? $this->assigned_duration : '',
            'picked_duration' => $this->relationLoaded("orders") ? $this->picked_duration : '',
            'delivered_duration' => $this->relationLoaded("orders") ? $this->delivered_duration: '',
            'assigned_received_duration' => $this->relationLoaded("orders") ? $this->assignedReceivedDuration() : '',
            'picked_assigned_duration' => $this->relationLoaded("orders") ? $this->pickedAssignedDuration() : '',
            'delivered_picked_duration' => $this->relationLoaded("orders") ? $this->deliveredPickedDuration() : '',
            'orders_count' => $this->orders_count,
            'average_delivered_duration' => $this->relationLoaded("orders") ? $this->averageDeliveredDuration() : '',
            'average_assigned_received_duration' => $this->relationLoaded("orders") ? $this->averageAssignedReceivedDuration() : '',
            'average_picked_assigned_duration' => $this->relationLoaded("orders") ? $this->averagePickedAssignedDuration() : '',
            'average_delivered_picked_duration' => $this->relationLoaded("orders") ? $this->averageDeliveredPickedDuration()  : '',

            'latest_schedule_day' => $this->relationLoaded("latestScheduleDay") ? $this->latestScheduleDay->day_date : null
        ];

        $this->relations = [
            'driver_type_id' => $this->getDriverType('id'),
            'driver_type' => $this->getDriverType('name'),
            'segment' => $this->getSegment('name'),
            'segment_id' => $this->getSegment('id'),
            'sub_segment_names' => $this->getSubSegments('name'),
            'sub_segment_ids' => $this->getSubSegments('id'),
            'warehouse_names' => $this->getWarehouses('name'),
            'warehouse_ids' => $this->getWarehouses('id'),
        ];

        return $this->getResource();
    }

    public function getSubSegments($key)
    {
        return $this->relationLoaded('subSegments') ? $this->subSegments?->pluck($key)->toArray() : [];
    }

    public function getWarehouses($key)
    {
        return $this->relationLoaded('warehouses') ? $this->warehouses?->pluck($key)->toArray() : [];
    }

    public function getSegment($key)
    {
        return $this->relationLoaded('segment') ? $this->segment?->$key : [];
    }

    public function getDriverType($key)
    {
        return $this->relationLoaded('driverType') ? $this->driverType?->$key : [];
    }
}
