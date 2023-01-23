<?php

namespace App\Observers;

use App\Models\Inventory;

class InventoryObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;

    /**
     * Handle the Inventory "created" event.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return void
     */
    public function created(Inventory $inventory)
    {
        if (is_incevio_package_loaded('ebay')) {
            \Incevio\Package\Ebay\Jobs\UpdateInventory::dispatch($inventory);
        }
    }

    /**
     * Handle the Inventory "updated" event.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return void
     */
    public function updated(Inventory $inventory)
    {
        if (is_incevio_package_loaded('ebay')) {
            \Incevio\Package\Ebay\Jobs\UpdateInventory::dispatch($inventory);
        }
    }

    /**
     * Handle the Inventory "deleted" event.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return void
     */
    public function deleted(Inventory $inventory)
    {
        //
    }

    /**
     * Handle the Inventory "restored" event.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return void
     */
    public function restored(Inventory $inventory)
    {
        //
    }

    /**
     * Handle the Inventory "force deleted" event.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return void
     */
    public function forceDeleted(Inventory $inventory)
    {
        if (is_incevio_package_loaded('ebay')) {
            \Incevio\Package\Ebay\Jobs\DeleteInventory::dispatch($inventory->sku);
        }
    }
}
