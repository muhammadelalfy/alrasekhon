<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', env('APP_NAME'));
        $this->migrator->add('general.site_active', true);
        $this->migrator->add('general.on_hold_order_time', 0);
        $this->migrator->add('general.max_driver_orders_count', 0);
        $this->migrator->add('general.mobile_app_version', 1);
        $this->migrator->add('general.driver_max_time_to_accept_order', 1);
        $this->migrator->add('general.driver_max_time_to_pick_up_order', 1);
        $this->migrator->add('general.driver_max_time_to_deliver_an_order', 1);
        $this->migrator->add('general.driver_max_time_to_move_after_accepting_order', 1);
        $this->migrator->add('general.driver_max_time_to_move_after_picking_up_order', 1); 
        $this->migrator->add('general.driver_max_time_to_spend_at_the_pickup_location', 1);
        $this->migrator->add('general.driver_max_time_to_spend_in_the_delivery_location', 1);
        $this->migrator->add('general.driver_max_time_order_to_be_assigned', 1);        
    }
}
