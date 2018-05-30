<?php

use Illuminate\Database\Seeder;

class ActivityTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Emprestimo - EMP
     * Mão de obra familiar - MOF
     * Administração - ADM
     * Pro Agro - PRO
     * Gestão Tecninca - GT
     * Formação/Renovação - FR
     * Adubação via Solo - ADS
     * Adubação via Folha - ADF
     * Controle de Pragas e Doenças - CPD
     * Controle de Plantas - CPL
     * Tratos Culturais - TRC
     * Irrigação - IRG
     * Colheita - COL
     * Pós-Colheita - PCOL
     * Comercialização - COM
     * Investimentos Realizados - INVS
     * @return void
     */
    public function run()
    {
        DB::table('activity_types')->insert([
          ['id'=>'EMP01','name'=>'Empréstimos Bancários','unity_id'=>'R$'],
          ['id'=>'EMP02','name'=>'Empréstimos Pessoais','unity_id'=>'R$'],
          ['id'=>'EMP03','name'=>'Pagamento de Empréstimo Bancário','unity_id'=>'R$'],
          ['id'=>'EMP04','name'=>'Juros Pagos - Empréstimo Bancário','unity_id'=>'R$'],
          ['id'=>'EMP05','name'=>'Pagamento de Empréstimo Pessoal','unity_id'=>'R$'],
          ['id'=>'EMP06','name'=>'Juros Pagos - Empréstimo Pessoal','unity_id'=>'R$'],
          ['id'=>'EMP07','name'=>'Outros Empréstimos ','unity_id'=>'R$'],
          ['id'=>'MOF01','name'=>'Mão de obra Familiar','unity_id'=>'R$'],
          ['id'=>'ADM01','name'=>'Aluguel de máquinas','unity_id'=>'R$'],
          ['id'=>'ADM02','name'=>'EPI/Uso geral','unity_id'=>'R$'],
          ['id'=>'ADM03','name'=>'Conservação de benfeitorias','unity_id'=>'R$'],
          ['id'=>'ADM04','name'=>'Energia elétrica','unity_id'=>'Kw'],
          ['id'=>'ADM05','name'=>'Frete/Deslocamento','unity_id'=>'R$'],
          ['id'=>'ADM06','name'=>'Impostas e taxas','unity_id'=>'R$'],
          ['id'=>'ADM07','name'=>'Mão de obra (Contratada)','unity_id'=>'R$'],
          ['id'=>'ADM08','name'=>'Treinamento/Capacitação','unity_id'=>'R$'],
          ['id'=>'ADM09','name'=>'Mão de obra (Fixa)','unity_id'=>'R$'],
          ['id'=>'ADM10','name'=>'Telefone/Internet','unity_id'=>'R$'],
          ['id'=>'ADM11','name'=>'Água','unity_id'=>'R$'],
          ['id'=>'ADM12','name'=>'Aluguel de equipamentos','unity_id'=>'R$'],
          ['id'=>'ADM13','name'=>'Aluguel de imóveis','unity_id'=>'R$'],
          ['id'=>'ADM14','name'=>'Conservação de equipamentos','unity_id'=>'R$'],
          ['id'=>'ADM15','name'=>'Contador','unity_id'=>'R$'],
          ['id'=>'ADM16','name'=>'Correios','unity_id'=>'R$'],
          ['id'=>'ADM17','name'=>'Deslocamento do produtor','unity_id'=>'R$'],
          ['id'=>'ADM18','name'=>'Despesas gerais de escritório','unity_id'=>'R$'],
          ['id'=>'ADM19','name'=>'Conservação de máquinas','unity_id'=>'R$'],
          ['id'=>'PRO01','name'=>'Pro Agro','unity_id'=>'R$'],
          ['id'=>'GT01','name'=>'Frete/Deslocamento','unity_id'=>'R$'],
          ['id'=>'GT02','name'=>'Impostos e taxas','unity_id'=>'R$'],
          ['id'=>'GT03','name'=>'Certificação','unity_id'=>'R$'],
          ['id'=>'GT04','name'=>'Telefone/Internet','unity_id'=>'R$'],
          ['id'=>'GT05','name'=>'Aluguel de equipamentos','unity_id'=>'R$'],
          ['id'=>'GT06','name'=>'Assistência técnica','unity_id'=>'R$'],
          ['id'=>'GT07','name'=>'Simpósios/Congressos','unity_id'=>'R$'],
          ['id'=>'GT08','name'=>'Conservação de equipamentos','unity_id'=>'R$'],
          ['id'=>'GT09','name'=>'Livros/Revistas','unity_id'=>'R$'],
          ['id'=>'GT10','name'=>'EPI','unity_id'=>'R$'],
          ['id'=>'FR01','name'=>'Aluguel de máquinas','unity_id'=>'R$'],
          ['id'=>'FR02','name'=>'Combustível','unity_id'=>'L'],
          ['id'=>'FR03','name'=>'Conservação de benfeitorias','unity_id'=>'R$'],
          ['id'=>'FR04','name'=>'Conservação de máquinas','unity_id'=>'R$'],
          ['id'=>'FR05','name'=>'Defensivos','unity_id'=>'R$'],
          ['id'=>'FR06','name'=>'Energia elétrica','unity_id'=>'Kw'],
          ['id'=>'FR07','name'=>'Frete/Deslocamento','unity_id'=>'R$'],
          ['id'=>'FR08','name'=>'Herbicida','unity_id'=>'L'],
          ['id'=>'FR09','name'=>'Impostos e taxas','unity_id'=>'R$'],
          ['id'=>'FR10','name'=>'Mão de obra (Contratada)','unity_id'=>'R$'],
          ['id'=>'FR11','name'=>'Mão de obra (Fixa)','unity_id'=>'R$'],
          ['id'=>'FR12','name'=>'Sementes/Mudas','unity_id'=>'R$'],
          ['id'=>'FR13','name'=>'Adubo orgânico','unity_id'=>'Ton'],
          ['id'=>'FR14','name'=>'Adubo químico','unity_id'=>'Ton'],
          ['id'=>'FR15','name'=>'Inoculante Semente ','unity_id'=>'R$'],
          ['id'=>'FR16','name'=>'Levantamento planialtimétrico','unity_id'=>'R$'],
          ['id'=>'FR17','name'=>'EPI','unity_id'=>'R$'],
          ['id'=>'FR18','name'=>'Sementes','unity_id'=>'Kg'],
          ['id'=>'ADS01','name'=>'Aluguel de máquinas','unity_id'=>'R$'],
          ['id'=>'ADS02','name'=>'Combustível','unity_id'=>'L'],
          ['id'=>'ADS03','name'=>'Conservação de benfeitorias','unity_id'=>'R$'],
          ['id'=>'ADS04','name'=>'Conservação de máquinas','unity_id'=>'R$'],
          ['id'=>'ADS05','name'=>'Energia elétrica','unity_id'=>'Kw'],
          ['id'=>'ADS06','name'=>'Impostos e taxas','unity_id'=>'R$'],
          ['id'=>'ADS07','name'=>'Mão de obra (Contratada)','unity_id'=>'R$'],
          ['id'=>'ADS08','name'=>'Mão de obra (Fixa)','unity_id'=>'R$'],
          ['id'=>'ADS09','name'=>'Adubo orgânico','unity_id'=>'Ton'],
          ['id'=>'ADS10','name'=>'Adubo químico','unity_id'=>'Ton'],
          ['id'=>'ADS11','name'=>'Corretivos de solo','unity_id'=>'Ton'],
          ['id'=>'ADS12','name'=>'Frete/Carregamento','unity_id'=>'R$'],
          ['id'=>'ADS13','name'=>'Análise de solo','unity_id'=>'R$'],
          ['id'=>'ADS14','name'=>'Análise foliar','unity_id'=>'R$'],
          ['id'=>'ADS15','name'=>'EPI','unity_id'=>'R$'],
          ['id'=>'ADF01','name'=>'Aluguel de máquinas','unity_id'=>'R$'],
          ['id'=>'ADF02','name'=>'Combustível','unity_id'=>'L'],
          ['id'=>'ADF03','name'=>'Conservação de benfeitorias','unity_id'=>'R$'],
          ['id'=>'ADF04','name'=>'Conservação de máquinas','unity_id'=>'R$'],
          ['id'=>'ADF05','name'=>'Energia elétrica','unity_id'=>'Kw'],
          ['id'=>'ADF06','name'=>'Impostos e taxas','unity_id'=>'R$'],
          ['id'=>'ADF07','name'=>'Mão de obra (Contratada)','unity_id'=>'R$'],
          ['id'=>'ADF08','name'=>'Mão de obra (Fixa)','unity_id'=>'R$'],
          ['id'=>'ADF09','name'=>'Adubos foliares não quelatizados','unity_id'=>'Kg'],
          ['id'=>'ADF10','name'=>'Adubos foliares quelatizados','unity_id'=>'L'],
          ['id'=>'ADF11','name'=>'Espalhante adesivo','unity_id'=>'L'],
          ['id'=>'ADF12','name'=>'Frete/Carregamento','unity_id'=>'R$'],
          ['id'=>'ADF13','name'=>'Análise de solo','unity_id'=>'R$'],
          ['id'=>'ADF14','name'=>'Análise foliar','unity_id'=>'R$'],
          ['id'=>'ADF15','name'=>'EPI','unity_id'=>'R$'],
          ['id'=>'ADF16','name'=>'Cal Hidratada','unity_id'=>'R$'],
          ['id'=>'ADF17','name'=>'Ácidos/Aminoácidos','unity_id'=>'L'],
          ['id'=>'ADF18','name'=>'Açúcar','unity_id'=>'Kg'],
          ['id'=>'CPD01','name'=>'Aluguel de máquinas','unity_id'=>'R$'],
          ['id'=>'CPD02','name'=>'Combustível','unity_id'=>'L'],
          ['id'=>'CPD03','name'=>'Conservação de benfeitorias','unity_id'=>'R$'],
          ['id'=>'CPD04','name'=>'Conservação de máquinas','unity_id'=>'R$'],
          ['id'=>'CPD05','name'=>'Energia elétrica','unity_id'=>'Kw'],
          ['id'=>'CPD06','name'=>'Impostos e taxas','unity_id'=>'R$'],
          ['id'=>'CPD07','name'=>'Mão de obra (Contratada)','unity_id'=>'R$'],
          ['id'=>'CPD08','name'=>'Mão de obra (Fixa)','unity_id'=>'R$'],
          ['id'=>'CPD09','name'=>'Acaricida','unity_id'=>'R$'],
          ['id'=>'CPD10','name'=>'Bactericida','unity_id'=>'R$'],
          ['id'=>'CPD11','name'=>'Adjuvante','unity_id'=>'L'],
          ['id'=>'CPD12','name'=>'Frete/Carregamento','unity_id'=>'R$'],
          ['id'=>'CPD13','name'=>'Fungicida','unity_id'=>'R$'],
          ['id'=>'CPD14','name'=>'Inseticida Solo, Folha, TS','unity_id'=>'R$'],
          ['id'=>'CPD15','name'=>'EPI','unity_id'=>'R$'],
          ['id'=>'CPD16','name'=>'Nematicida','unity_id'=>'R$'],
          ['id'=>'CPD17','name'=>'Óleo Mineral','unity_id'=>'R$'],
          ['id'=>'CPL01','name'=>'Aluguel de máquinas','unity_id'=>'R$'],
          ['id'=>'CPL02','name'=>'Combustível','unity_id'=>'R$'],
          ['id'=>'CPL03','name'=>'Conservação de benfeitorias','unity_id'=>'R$'],
          ['id'=>'CPL04','name'=>'Conservação de máquinas','unity_id'=>'R$'],
          ['id'=>'CPL05','name'=>'Energia elétrica','unity_id'=>'Kw'],
          ['id'=>'CPL06','name'=>'Impostos e taxas','unity_id'=>'R$'],
          ['id'=>'CPL07','name'=>'Mão de obra (Contratada)','unity_id'=>'R$'],
          ['id'=>'CPL08','name'=>'Mão de obra (Fixa)','unity_id'=>'R$'],
          ['id'=>'CPL09','name'=>'Herbicida Pré emergente','unity_id'=>'R$'],
          ['id'=>'CPL10','name'=>'Herbicida Pós emergente','unity_id'=>'R$'],
          ['id'=>'CPL11','name'=>'Adjuvantes','unity_id'=>'L'],
          ['id'=>'CPL12','name'=>'Frete/Carregamento','unity_id'=>'R$'],
          ['id'=>'CPL13','name'=>'EPI','unity_id'=>'R$'],
          ['id'=>'TRC01','name'=>'Aluguel de máquinas','unity_id'=>'R$'],
          ['id'=>'TRC02','name'=>'Combustível','unity_id'=>'L'],
          ['id'=>'TRC03','name'=>'Conservação de benfeitorias','unity_id'=>'R$'],
          ['id'=>'TRC04','name'=>'Conservação de máquinas','unity_id'=>'R$'],
          ['id'=>'TRC05','name'=>'Energia elétrica','unity_id'=>'R$'],
          ['id'=>'TRC06','name'=>'Impostos e taxas','unity_id'=>'R$'],
          ['id'=>'TRC07','name'=>'Mão de obra (Contratada)','unity_id'=>'R$'],
          ['id'=>'TRC08','name'=>'Mão de obra (Fixa)','unity_id'=>'R$'],
          ['id'=>'TRC09','name'=>'Hormônois','unity_id'=>'R$'],
          ['id'=>'TRC10','name'=>'Frete/Carregamento','unity_id'=>'R$'],
          ['id'=>'TRC11','name'=>'EPI','unity_id'=>'R$'],
          ['id'=>'IRG01','name'=>'Aluguel de máquinas','unity_id'=>'R$'],
          ['id'=>'IRG02','name'=>'Combustível','unity_id'=>'L'],
          ['id'=>'IRG03','name'=>'Conservação de benfeitorias','unity_id'=>'R$'],
          ['id'=>'IRG04','name'=>'Conservação de máquinas','unity_id'=>'R$'],
          ['id'=>'IRG05','name'=>'Energia elétrica','unity_id'=>'Kw'],
          ['id'=>'IRG06','name'=>'Impostos e taxas','unity_id'=>'R$'],
          ['id'=>'IRG07','name'=>'Mão de obra (Contratada)','unity_id'=>'R$'],
          ['id'=>'IRG08','name'=>'Mão de obra (Fixa)','unity_id'=>'R$'],
          ['id'=>'IRG09','name'=>'Frete/Carregamento','unity_id'=>'R$'],
          ['id'=>'IRG10','name'=>'EPI','unity_id'=>'R$'],
          ['id'=>'COL01','name'=>'Aluguel de máquinas','unity_id'=>'R$'],
          ['id'=>'COL02','name'=>'Combustível','unity_id'=>'L'],
          ['id'=>'COL03','name'=>'Conservação de benfeitorias','unity_id'=>'R$'],
          ['id'=>'COL04','name'=>'Conservação de máquinas','unity_id'=>'R$'],
          ['id'=>'COL05','name'=>'Energia elétrica','unity_id'=>'Kw'],
          ['id'=>'COL06','name'=>'Impostos e taxas','unity_id'=>'R$'],
          ['id'=>'COL07','name'=>'Mão de obra (Contratada)','unity_id'=>'R$'],
          ['id'=>'COL08','name'=>'Mão de obra (Fixa)','unity_id'=>'R$'],
          ['id'=>'COL09','name'=>'Frete/Carregamento','unity_id'=>'R$'],
          ['id'=>'COL10','name'=>'EPI','unity_id'=>'R$'],
          ['id'=>'COL11','name'=>'Hormônios/Maturadores','unity_id'=>'R$'],
          ['id'=>'COL12','name'=>'Material de colheita','unity_id'=>'R$'],
          ['id'=>'PCOL01','name'=>'Aluguel de máquinas','unity_id'=>'R$'],
          ['id'=>'PCOL02','name'=>'Combustível','unity_id'=>'L'],
          ['id'=>'PCOL03','name'=>'Conservação de benfeitorias','unity_id'=>'R$'],
          ['id'=>'PCOL04','name'=>'Conservação de máquinas','unity_id'=>'R$'],
          ['id'=>'PCOL05','name'=>'Energia elétrica','unity_id'=>'R$'],
          ['id'=>'PCOL06','name'=>'Mão de obra (Contratada)','unity_id'=>'R$'],
          ['id'=>'PCOL07','name'=>'Mão de obra (Fixa)','unity_id'=>'R$'],
          ['id'=>'PCOL08','name'=>'Frete/Carregamento','unity_id'=>'R$'],
          ['id'=>'PCOL09','name'=>'EPI','unity_id'=>'R$'],
          ['id'=>'PCOL10','name'=>'Armazenamento','unity_id'=>'Sc'],
          ['id'=>'PCOL11','name'=>'Gás/Lenha/Carvão','unity_id'=>'R$'],
          ['id'=>'PCOL12','name'=>'Saco/Embalagens','unity_id'=>'Sc'],
          ['id'=>'PCOL13','name'=>'Materiais de pós-colheita','unity_id'=>'R$'],
          ['id'=>'PCOL14','name'=>'Benefício','unity_id'=>'Sc'],
          ['id'=>'PCOL15','name'=>'Rebenefício','unity_id'=>'Sc'],
          ['id'=>'COM01','name'=>'Frete/Carregamento','unity_id'=>'R$'],
          ['id'=>'COM02','name'=>'Impostos e taxas','unity_id'=>'R$'],
          ['id'=>'COM03','name'=>'Corretagem','unity_id'=>'R$'],
          ['id'=>'COM04','name'=>'Saco/Embalagens','unity_id'=>'Sc'],
          ['id'=>'COM05','name'=>'Seguro','unity_id'=>'R$'],
          ['id'=>'INVS01','name'=>'Benfeitorias Construídas em Construção','unity_id'=>'R$'],
          ['id'=>'INVS02','name'=>'Máquinas ou Equipamentos Comprados','unity_id'=>'R$'],
          ['id'=>'INVS03','name'=>'Outros Investimentos Realizados','unity_id'=>'R$']
        ]);
    }
}
