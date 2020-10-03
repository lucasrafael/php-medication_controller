<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use DateInterval;

use Throwable;

/**
 * Class DatabaseSeeder
 * Carrega as tabelas com alguns valores iniciais para testes.
 * @package Database\Seeders
 * @author lucasrafael
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            $this->createDados('Y-m-d', now());
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Cria dados de teste.
     * @param string $dtFmtMask
     * @param $date
     */
    private function createDados($dtFmtMask = 'Y-m-d', $date): void
    {
        $idCategoria_1 = DB::table('categorias')->insertGetId(["nome" => "Analgésico", "created_at" => $date]);
        $idCategoria_2 = DB::table('categorias')->insertGetId(["nome" => "Relaxante muscular", "created_at" => $date]);
        DB::table('categorias')->insert(["nome" => "Antiácido", "created_at" => $date]);
        DB::table('categorias')->insert(["nome" => "Anti-inflamatório", "created_at" => $date]);

        $idMarca_1 = DB::table('marcas')->insertGetId(["nome" => "Sanofi", "created_at" => $date]);
        $idMarca_2 = DB::table('marcas')->insertGetId(["nome" => "Boehringer Ingelheim do Brasil", "created_at" => $date]);
        $idMarca_3 = DB::table('marcas')->insertGetId(["nome" => "Nycomed Pharma", "created_at" => $date]);
        DB::table('marcas')->insert(["nome" => "EMS Corp.", "created_at" => $date]);
        DB::table('marcas')->insert(["nome" => "Hypermarcas", "created_at" => $date]);
        DB::table('marcas')->insert(["nome" => "Novartis", "created_at" => $date]);
        DB::table('marcas')->insert(["nome" => "Ache", "created_at" => $date]);
        DB::table('marcas')->insert(["nome" => "Eurofarma", "created_at" => $date]);

        $idMedicamento_1 = DB::table('medicamentos')->insertGetId([
            "nome" => "Novalgina",
            "descricao" => "Trata todos os níveis de febre, das mais baixas até as mais altas",
            "prescricao" => "1 comprimido por dia",
            "validade" => $date->add(new DateInterval('P3M'))->format($dtFmtMask),
            "quantidade" => 10,
            "marca_id" => $idMarca_1,
            "created_at" => $date
        ]);
        $idMedicamento_2 = DB::table('medicamentos')->insertGetId([
            "nome" => "Buscopan Composto",
            "descricao" => "Alivio de dores, cólicas e desconforto abdominal; em crianças e adultos",
            "prescricao" => "Drágeas\n- Adultos e crianças: 1 a 2, 3 a 5 vezes por dia;\n\nGotas\n- Adultos e crianças: 20 a 40 gotas, 3 a 5 vezes por dia",
            "validade" => $date->add(new DateInterval('P2M'))->format($dtFmtMask),
            "quantidade" => 30,
            "marca_id" => $idMarca_2,
            "created_at" => $date
        ]);
        $idMedicamento_3 = DB::table('medicamentos')->insertGetId([
            "nome" => "Dorflex",
            "descricao" => "Alivio das dores associadas a contraturas musculares em adultos",
            "prescricao" => "A dose recomendada é de 1 a 2 comprimidos, 3 a 4 vezes por dia, nunca excedendo a dose máxima diária de 8 comprimidos",
            "validade" => $date->add(new DateInterval('P1M'))->format($dtFmtMask),
            "quantidade" => 20,
            "marca_id" => $idMarca_1,
            "created_at" => $date
        ]);
        $idMedicamento_4 = DB::table('medicamentos')->insertGetId([
            "nome" => "Neosaldina",
            "descricao" => "É indicado para o tratamento de diversos tipos de dores de cabeça",
            "prescricao" => "A dose recomendada de Neosaldina é de 1 a 2 comprimidos administrados de 6 em 6 horas, cerca de 4 vezes por dia",
            "validade" => $date->add(new DateInterval('P13M'))->format($dtFmtMask),
            "quantidade" => 15,
            "marca_id" => $idMarca_3,
            "created_at" => $date
        ]);

        DB::table('medicamentos_categorias')->insert([
            "medicamentos_id" => $idMedicamento_1,
            "categorias_id" => $idCategoria_1
        ]);
        DB::table('medicamentos_categorias')->insert([
            "medicamentos_id" => $idMedicamento_2,
            "categorias_id" => $idCategoria_1
        ]);
        DB::table('medicamentos_categorias')->insert([
            "medicamentos_id" => $idMedicamento_3,
            "categorias_id" => $idCategoria_2
        ]);
        DB::table('medicamentos_categorias')->insert([
            "medicamentos_id" => $idMedicamento_4,
            "categorias_id" => $idCategoria_1
        ]);
    }

}
