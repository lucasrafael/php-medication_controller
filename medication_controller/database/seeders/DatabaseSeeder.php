<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $idCategoria = DB::table('categorias')->insertGetId(["nome" => "Analgésico", "created_at" => now()]);
        DB::table('categorias')->insert(["nome" => "Antiácido", "created_at" => now()]);
        DB::table('categorias')->insert(["nome" => "Anti-inflamatório", "created_at" => now()]);

        $idMarca = DB::table('marcas')->insert(["nome" => "Sanofi", "created_at" => now()]);
        DB::table('marcas')->insert(["nome" => "EMS Corp.", "created_at" => now()]);
        DB::table('marcas')->insert(["nome" => "Hypermarcas", "created_at" => now()]);
        DB::table('marcas')->insert(["nome" => "Novartis", "created_at" => now()]);
        DB::table('marcas')->insert(["nome" => "Ache", "created_at" => now()]);
        DB::table('marcas')->insert(["nome" => "Eurofarma", "created_at" => now()]);

        $idMedicamento = DB::table('medicamentos')->insertGetId([
            "nome" => "Novalgina",
            "descricao" => "Trata todos os níveis de febre, das mais baixas as mais altas",
            "prescricao"=> "1 comprimido por dia",
            "validade" => "01/12/2021",
            "quantidade" => 10,
            "marca_id" => $idMarca,
            "created_at" => now()
        ]);

        DB::table('medicamentos_categorias')->insert([
            "medicamentos_id" => $idMedicamento,
            "categorias_id" => $idCategoria
        ]);
    }

}
