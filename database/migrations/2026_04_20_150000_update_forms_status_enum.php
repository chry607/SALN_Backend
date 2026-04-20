<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the old check constraint
        DB::statement("ALTER TABLE forms DROP CONSTRAINT IF EXISTS forms_status_check;");
        // Add the new check constraint with 'archived'
        DB::statement("ALTER TABLE forms ADD CONSTRAINT forms_status_check CHECK (status IN ('draft', 'submitted', 'completed', 'archived'));");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the new check constraint
        DB::statement("ALTER TABLE forms DROP CONSTRAINT IF EXISTS forms_status_check;");
        // Restore the old check constraint
        DB::statement("ALTER TABLE forms ADD CONSTRAINT forms_status_check CHECK (status IN ('draft', 'submitted', 'completed'));");
    }
};
