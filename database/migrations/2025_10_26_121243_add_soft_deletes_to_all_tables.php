<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add soft deletes to products table
        Schema::table('products', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to categories table
        Schema::table('categories', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to contacts table
        Schema::table('contacts', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to users table
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to orders table (if exists)
        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->softDeletes();
            });
        }

        // Add soft deletes to order_items table (if exists)
        if (Schema::hasTable('order_items')) {
            Schema::table('order_items', function (Blueprint $table) {
                $table->softDeletes();
            });
        }

        // Add soft deletes to reviews table (if exists)
        if (Schema::hasTable('reviews')) {
            Schema::table('reviews', function (Blueprint $table) {
                $table->softDeletes();
            });
        }

        // Add soft deletes to carts table (if exists)
        if (Schema::hasTable('carts')) {
            Schema::table('carts', function (Blueprint $table) {
                $table->softDeletes();
            });
        }

        // Add soft deletes to wishlists table (if exists)
        if (Schema::hasTable('wishlists')) {
            Schema::table('wishlists', function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove soft deletes from products table
        Schema::table('products', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Remove soft deletes from categories table
        Schema::table('categories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Remove soft deletes from contacts table
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Remove soft deletes from users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Remove soft deletes from orders table (if exists)
        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }

        // Remove soft deletes from order_items table (if exists)
        if (Schema::hasTable('order_items')) {
            Schema::table('order_items', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }

        // Remove soft deletes from reviews table (if exists)
        if (Schema::hasTable('reviews')) {
            Schema::table('reviews', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }

        // Remove soft deletes from carts table (if exists)
        if (Schema::hasTable('carts')) {
            Schema::table('carts', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }

        // Remove soft deletes from wishlists table (if exists)
        if (Schema::hasTable('wishlists')) {
            Schema::table('wishlists', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }
    }
};
