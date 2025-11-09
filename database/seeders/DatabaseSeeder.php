<?php

namespace Database\Seeders;
use App\Models\Programa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
    
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@sefazemassa.com.br',
            'password' => Hash::make('12341234'),
            'role' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => Hash::make('12341234'),
        ]);
        
        Programa::create([
            'nome' => 'Prazo para regularização cadastral de empresas termina no dia 5 de julho',
            'descricao' => 'Empresas com pendências cadastrais devem regularizar até 5 de julho para manter benefícios fiscais e incentivos disponíveis.',
            'categoria' => 'Regularização Fiscal',
            'link_oficial' => 'https://maceio.al.gov.br/noticias/sefaz/prazo-para-regularizacao-cadastral-de-empresas-termina-no-dia-5-de-julho',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Programa::create([
            'nome' => 'SEFAZ orienta sobre emissão de Nota Fiscal Eletrônica',
            'descricao' => 'Empresários devem ficar atentos às regras da emissão de NF-e para evitar autuações fiscais.',
            'categoria' => 'Nota Fiscal',
            'link_oficial' => 'https://maceio.al.gov.br/noticias/sefaz/sefaz-orienta-sobre-emissao-de-nota-fiscal-eletronica',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Programa::create([
            'nome' => 'Fazenda orienta empresas sobre regularização no Simples Nacional',
            'descricao' => 'Microempreendedores individuais e empresas excluídas em 2024 têm até sexta-feira para resolver pendências financeiras e cadastrais para retornar ao regime do Simples Nacional.',
            'categoria' => 'Simples Nacional',
            'link_oficial' => 'https://maceio.al.gov.br/noticias/sefaz/fazenda-orienta-empresas-sobre-regularizacao-no-simples-nacional',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Programa::create([
            'nome' => 'Prefeitura de Maceió notifica empresas que possuem débitos de taxas mercantis',
            'descricao' => 'Empresas com débitos da Taxa de Licença de Funcionamento (TLF) ou Taxa de Licença para Instalação (TLI) são notificadas para regularizar ou enfrentar multas e suspensão do cadastro.',
            'categoria' => 'Regularização Fiscal',
            'link_oficial' => 'https://maceio.al.gov.br/noticias/sefaz/prefeitura-de-maceio-notifica-empresas-que-possuem-debitos-de-taxas-mercantis',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Programa::create([
            'nome' => 'Maceió está entre as capitais que mais simplificam início de operação de empresas no País',
            'descricao' => 'Segundo o ranking do Governo Federal, Maceió está entre as principais capitais que dispensam alvarás ou licenças para atividades econômicas; são 492 atividades listadas.',
            'categoria' => 'Desburocratização',
            'link_oficial' => 'https://maceio.al.gov.br/noticias/sefaz/maceio-esta-entre-as-capitais-que-mais-simplificam-inicio-de-operacao-de-empresas-no-pais',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Programa::create([
            'nome' => 'Sefaz Maceió alerta prestadores de serviços sobre os riscos de inadimplência',
            'descricao' => 'Débitos em atraso das taxas mercantis ou ISS podem acarretar penalidades como suspensão ou interdição de empresas; alerta focado em prestadores de serviços.',
            'categoria' => 'Inadimplência',
            'link_oficial' => 'https://maceio.al.gov.br/noticias/sefaz/sefaz-maceio-alerta-prestadores-de-servicos-sobre-os-riscos-de-inadimplencia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Programa::create([
            'nome' => 'SEFAZ oferece treinamento gratuito sobre obrigações tributárias',
            'descricao' => 'Empresários podem participar de cursos online oferecidos pela SEFAZ para compreender melhor impostos e obrigações legais.',
            'categoria' => 'Capacitação',
            'link_oficial' => 'https://maceio.al.gov.br/noticias/sefaz/sefaz-oferece-treinamento-gratuito-sobre-obrigacoes-tributarias',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Programa::create([
            'nome' => 'Programa de incentivo fiscal para novas empresas em Maceió',
            'descricao' => 'Empresas recém-criadas podem acessar incentivos fiscais para estimular investimento e geração de empregos no município.',
            'categoria' => 'Incentivo Fiscal',
            'link_oficial' => 'https://maceio.al.gov.br/noticias/sefaz/programa-de-incentivo-fiscal-para-novas-empresas-em-maceio',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        

    }
}
