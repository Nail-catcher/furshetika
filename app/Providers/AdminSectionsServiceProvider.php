<?php

namespace App\Providers;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $sections = [
        \App\Models\User::class => 'App\Http\Sections\Users',
        \App\Models\Product::class => 'App\Http\Sections\Products',
        \App\Models\Order::class => 'App\Http\Sections\Orders',
        \App\Models\AltOrder::class => 'App\Http\Sections\AltOrders',
        \App\Models\Texted::class => 'App\Http\Sections\Texteds',

    ];

    /**
     * Register sections.
     *
     * @param \SleepingOwl\Admin\Admin $admin
     * @return void
     */
    public function boot(\SleepingOwl\Admin\Admin $admin)
    {
    	//

        parent::boot($admin);
    }
}
