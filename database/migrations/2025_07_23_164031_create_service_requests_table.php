<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->string('requester_name');
            $table->string('requester_contact')->nullable();
            $table->string('request_type'); // e.g., 'complaint', 'letter_request'
            $table->string('subject')->nullable();
            $table->text('message');
            $table->string('status')->default('submitted');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};