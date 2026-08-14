<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DatabaseSyncService
{
    protected $local;
    protected $remote;
    protected $historyTable = 'sync_history';

    public function __construct()
    {
        $this->local = DB::connection('mysql');
        $this->remote = DB::connection('mysql_remote');
    }

    /**
     * Sincroniza todas las tablas excepto las excluidas
     */
    public function syncAllTables(array $excludeTables = [])
    {
        $tables = $this->getAllTables();

        foreach ($tables as $table) {
            if (in_array($table, $excludeTables)) {
                echo "⏭️  Omitiendo tabla: {$table}\n";
                Log::info("Omitiendo tabla: {$table}");
                continue;
            }

            echo "🔄 Sincronizando tabla: {$table}\n";
            Log::info("Sincronizando tabla: {$table}");
            $this->syncTable($table);
        }

        echo "✅ Sincronización completada.\n";
        Log::info("Sincronización completada.");
    }

    /**
     * Obtiene todas las tablas disponibles en la base remota
     */
    protected function getAllTables()
    {
        $dbName = $this->remote->getDatabaseName();
        $tables = $this->remote->select("SHOW TABLES");

        dd($dbName, $tables);

        // Detecta el nombre de la columna según MySQL
        $key = "Tables_in_{$dbName}";

        return array_map(fn($t) => $t->$key, $tables);
    }

    /**
     * Sincroniza una tabla específica
     */
    protected function syncTable($table)
    {
        $lastId = 0;
        $batchSize = 500;

        while (true) {
            $rows = $this->remote->table($table)
                ->where('id', '>', $lastId)
                ->orderBy('id')
                ->limit($batchSize)
                ->get();

            if ($rows->isEmpty()) {
                break;
            }

            foreach ($rows as $row) {
                $this->syncRecord($table, (array) $row);
                $lastId = $row->id;
            }

            echo "✅ Procesados hasta ID {$lastId} en {$table}\n";
        }
    }

    /**
     * Sincroniza un registro individual
     */
    protected function syncRecord($table, $remoteRow)
    {
        $exists = $this->local->table($table)->where('id', $remoteRow['id'])->first();

        if ($exists) {
            // Guardar histórico antes de actualizar
            $this->saveHistory($table, $remoteRow['id'], (array) $exists, 'update');
            $this->local->table($table)->where('id', $remoteRow['id'])->update($remoteRow);
        } else {
            $this->local->table($table)->insert($remoteRow);
            $this->saveHistory($table, $remoteRow['id'], null, 'insert');
        }
    }

    /**
     * Guarda histórico de sincronización
     */
    protected function saveHistory($table, $recordId, $oldData = null, $action = 'update')
    {
        if (!$this->local->getSchemaBuilder()->hasTable($this->historyTable)) {
            $this->local->statement("
                CREATE TABLE IF NOT EXISTS {$this->historyTable} (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    table_name VARCHAR(255),
                    record_id INT,
                    action VARCHAR(50),
                    old_data JSON NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )
            ");
        }

        $this->local->table($this->historyTable)->insert([
            'table_name' => $table,
            'record_id' => $recordId,
            'action' => $action,
            'old_data' => $oldData ? json_encode($oldData) : null,
            'created_at' => Carbon::now(),
        ]);
    }
}
