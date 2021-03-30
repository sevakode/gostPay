<?php

namespace App\Console\Commands;

use Database\Seeders\PermissionsSeeder;
use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Permissions extends Command
{
    use ConfirmableTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $databases = [
        'roles_permissions',
        'permissions_roles',
        'permissions',
        'roles',
    ];

    /**
     * Create a new migration command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Schema::disableForeignKeyConstraints();
        foreach ($this->databases as $database)
            Schema::dropIfExists($database);
        Schema::disableForeignKeyConstraints();

        self::createRolesPermissions();
        self::createPermissionsRoles();
        self::createPermissions();
        self::createRoles();

        (new PermissionsSeeder)->run();

        $this->info('Права и роли обновлены');
        return 0;
    }

    public static function createPermissions()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });
    }

    public static function createRoles()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    public static function createRolesPermissions()
    {
        Schema::create('roles_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permission_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->primary(['role_id','permission_id']);
        });
    }

    public static function createPermissionsRoles()
    {
        Schema::create('permissions_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->timestamps();
        });
    }
}
