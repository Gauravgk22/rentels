<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('vehicle.{id}', function ($user, $id) {
    // Only allow owner or admins to track?
    // For now, allow authenticated users to track vehicles
    return true;
});
