<?php

namespace Database\Seeders;

use App\Models\Profissoes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfissaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Profissoes::where('nome', 'gerente')->first()){
            Profissoes::create([
                'nome' => 'gerente',
                'descricao' => 'segunda à sexta',
                'salario' => '3000',
                'empresa' => 'unilfa'

            ]);
        }
        if(!Profissoes::where('nome', 'vendedor')->first()){
            Profissoes::create([
                'nome' => 'vendedor',
                'descricao' => 'segunda à sexta',
                'salario' => '2000',
                'empresa' => 'unilfa'

            ]);
        }
        if(!Profissoes::where('nome', 'secretária')->first()){
            Profissoes::create([
                'nome' => 'secretaria',
                'descricao' => 'segunda à sexta',
                'salario' => '1500',
                'empresa' => 'unilfa'

            ]);
        }
    }
}
