<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;
use App\Models\User;
use Carbon\Carbon;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Limpa a tabela para evitar duplicatas e erro de chave
        Produto::truncate();

        // 2. Pega o primeiro usuário (você)
        $user = User::first();

        // Se o banco não tem usuário (após migrate:fresh), cria um temporário
        if (!$user) {
             $user = User::factory()->create([
                 'name' => 'Admin Seeder',
                 'email' => 'seeder@app.com',
                 'password' => bcrypt('password'),
            ]);
        }
        
        $userId = $user->id;

        // --- LISTA DE 50 PRODUTOS DE INFORMÁTICA E ESCRITÓRIO ---
        $produtos = [
            ['nome' => 'Mouse Óptico Sem Fio MX Master 3', 'descricao' => 'Design ergonômico, 4000 DPI, conexão USB-C e Bluetooth.', 'preco' => 389.90, 'qtd' => 35, 'data' => '2025-05-20'],
            ['nome' => 'Teclado Mecânico Gamer HyperX Alloy FPS', 'descricao' => 'Switches Cherry MX Red, layout ABNT2, iluminação RGB personalizável.', 'preco' => 649.00, 'qtd' => 12, 'data' => '2025-04-10'],
            ['nome' => 'Webcam Logitech C920S Pro HD', 'descricao' => 'Resolução Full HD 1080p, autofoco e correção automática de luz.', 'preco' => 420.00, 'qtd' => 22, 'data' => '2025-03-01'],
            ['nome' => 'Headset Gamer Astro A40 TR', 'descricao' => 'Som de alta fidelidade, microfone de precisão e design modular.', 'preco' => 999.00, 'qtd' => 7, 'data' => '2025-01-25'],
            ['nome' => 'SSD Samsung EVO 1TB NVMe M.2', 'descricao' => 'Armazenamento de alta velocidade para performance extrema. 3500 MB/s de leitura.', 'preco' => 599.50, 'qtd' => 18, 'data' => '2025-06-15'],
            ['nome' => 'Pen Drive Sandisk Ultra 128GB USB 3.0', 'descricao' => 'Transfere arquivos grandes em segundos, corpo retrátil.', 'preco' => 75.00, 'qtd' => 100, 'data' => '2025-02-01'],
            ['nome' => 'Roteador TP-Link Archer AX50 WiFi 6', 'descricao' => 'Tecnologia Wi-Fi 6 de última geração, cobre grandes áreas e suporta vários dispositivos.', 'preco' => 499.00, 'qtd' => 10, 'data' => '2025-04-20'],
            ['nome' => 'Notebook Dell Inspiron 15 (i7, 16GB)', 'descricao' => 'Processador Intel i7 de 12ª geração, 16GB RAM, SSD 512GB.', 'preco' => 5999.00, 'qtd' => 5, 'data' => '2025-07-01'],
            ['nome' => 'Monitor Samsung Odyssey G5 Curvo 27"', 'descricao' => '144Hz, tempo de resposta 1ms, resolução WQHD.', 'preco' => 1799.00, 'qtd' => 11, 'data' => '2025-05-15'],
            ['nome' => 'Placa de Vídeo Gigabyte RTX 4060', 'descricao' => '8GB GDDR6, ideal para jogos em Full HD e edição de vídeo.', 'preco' => 2850.00, 'qtd' => 3, 'data' => '2025-06-25'],
            ['nome' => 'Cadeira de Escritório Presidente Matriz', 'descricao' => 'Ajuste de altura e inclinação, revestimento em couro sintético.', 'preco' => 790.00, 'qtd' => 25, 'data' => '2025-01-05'],
            ['nome' => 'Impressora Multifuncional Epson L3250 EcoTank', 'descricao' => 'Impressão sem fio, baixo custo por página, tanques de tinta recarregáveis.', 'preco' => 1150.00, 'qtd' => 14, 'data' => '2025-03-10'],
            ['nome' => 'Mesa para Computador em L', 'descricao' => 'Design moderno, otimiza espaço e suporta múltiplos monitores.', 'preco' => 650.00, 'qtd' => 8, 'data' => '2025-02-20'],
            ['nome' => 'Hub USB-C Anker 7-em-1', 'descricao' => 'Expande para HDMI, 3x USB 3.0, SD e MicroSD, e Power Delivery.', 'preco' => 249.00, 'qtd' => 40, 'data' => '2025-05-05'],
            ['nome' => 'Etiquetadora Eletrônica Brother PT-D210', 'descricao' => 'Cria etiquetas personalizadas para organização de cabos e arquivos.', 'preco' => 199.00, 'qtd' => 30, 'data' => '2025-07-10'],
            ['nome' => 'Bateria Externa Power Bank 20000mAh', 'descricao' => 'Carregamento rápido, duas portas USB, ideal para viagens longas.', 'preco' => 145.00, 'qtd' => 60, 'data' => '2025-01-01'],
            ['nome' => 'Mousepad Gamer Extra Grande', 'descricao' => 'Superfície de tecido microtexturizado para controle preciso.', 'preco' => 95.00, 'qtd' => 75, 'data' => '2025-04-01'],
            ['nome' => 'Processador AMD Ryzen 7 5700X', 'descricao' => '8 núcleos, 16 threads, alta performance para multitarefas.', 'preco' => 1199.00, 'qtd' => 10, 'data' => '2025-06-01'],
            ['nome' => 'Câmera de Segurança Wi-Fi Externa', 'descricao' => 'Resolução Full HD, visão noturna colorida, detecção de movimento.', 'preco' => 320.00, 'qtd' => 18, 'data' => '2025-05-10'],
            ['nome' => 'Kit Limpeza de Monitores e Telas', 'descricao' => 'Solução atóxica e pano de microfibra, sem álcool.', 'preco' => 45.00, 'qtd' => 150, 'data' => '2025-02-15'],
            ['nome' => 'Luminária de Mesa LED com Clip', 'descricao' => 'Ajuste flexível, 3 tons de cor, ideal para leitura noturna.', 'preco' => 90.00, 'qtd' => 40, 'data' => '2025-03-25'],
            ['nome' => 'Switch Gigabit Ethernet 8 Portas', 'descricao' => 'Conexão estável e rápida para redes domésticas ou de escritório.', 'preco' => 165.00, 'qtd' => 15, 'data' => '2025-07-20'],
            ['nome' => 'Estabilizador de Tensão 1000VA', 'descricao' => 'Proteção contra surtos e picos de energia para PCs e monitores.', 'preco' => 210.00, 'qtd' => 20, 'data' => '2025-01-18'],
            ['nome' => 'Software Antivírus Kaspersky Total Security (1 Ano)', 'descricao' => 'Proteção completa contra vírus, ransomware e phishing.', 'preco' => 129.99, 'qtd' => 50, 'data' => '2025-04-15'],
            ['nome' => 'Cartuchos de Tinta HP 664XL (Preto)', 'descricao' => 'Tinta original de alto rendimento, compatível com Deskjet 2130/3636.', 'preco' => 85.00, 'qtd' => 80, 'data' => '2025-05-01'],
            ['nome' => 'Cabo HDMI Alta Velocidade 4K (3 Metros)', 'descricao' => 'Suporte a 4K@60Hz e HDR, conectores banhados a ouro.', 'preco' => 49.90, 'qtd' => 120, 'data' => '2025-03-05'],
            ['nome' => 'Papel A4 Chamex 75g (Pacote 500 Folhas)', 'descricao' => 'Ideal para impressão diária em jato de tinta e laser.', 'preco' => 28.50, 'qtd' => 300, 'data' => '2025-07-05'],
            ['nome' => 'Caixa Organizadora Plástica Grande', 'descricao' => 'Transparente, com tampa e travas laterais. Capacidade 50 litros.', 'preco' => 70.00, 'qtd' => 45, 'data' => '2025-06-10'],
            ['nome' => 'Grampeador de Mesa Cis 26/6', 'descricao' => 'Capacidade para 20 folhas, corpo metálico e base antiderrapante.', 'preco' => 19.90, 'qtd' => 90, 'data' => '2025-01-10'],
            ['nome' => 'Furador de Papel 2 Furos Metálico', 'descricao' => 'Capacidade para 40 folhas, guia de centralização ajustável.', 'preco' => 35.00, 'qtd' => 70, 'data' => '2025-04-25'],
            ['nome' => 'Calculadora Científica Casio FX-991ES Plus', 'descricao' => '417 funções, display de 2 linhas, tampa protetora rígida.', 'preco' => 135.00, 'qtd' => 20, 'data' => '2025-05-25'],
            ['nome' => 'Pasta Suspensa Simples (C/ 10 Unidades)', 'descricao' => 'Para organização de documentos em arquivos de metal ou madeira.', 'preco' => 48.00, 'qtd' => 80, 'data' => '2025-03-01'],
            ['nome' => 'Caneta Hidrográfica Stabilo Point 88 (Estojo)', 'descricao' => 'Ponta fina 0.4mm, estojo com 20 cores sortidas.', 'preco' => 110.00, 'qtd' => 30, 'data' => '2025-06-05'],
            ['nome' => 'Refil de Bloco Post-it Amarelo', 'descricao' => 'Bloco autoadesivo 76mm x 76mm, com 100 folhas.', 'preco' => 12.00, 'qtd' => 250, 'data' => '2025-02-05'],
            ['nome' => 'Projetor Multimídia LED 3000 Lumens', 'descricao' => 'Resolução nativa HD, ideal para apresentações em salas de reuniões.', 'preco' => 1800.00, 'qtd' => 6, 'data' => '2025-07-15'],
            ['nome' => 'Fone de Ouvido Bluetooth JBL Tune 500BT', 'descricao' => 'Som Pure Bass, leve e dobrável, até 16 horas de bateria.', 'preco' => 199.90, 'qtd' => 35, 'data' => '2025-01-01'],
            ['nome' => 'Nobreak SMS Power Sinus 1500VA', 'descricao' => 'Proteção e autonomia para equipamentos de informática sensíveis.', 'preco' => 950.00, 'qtd' => 10, 'data' => '2025-04-05'],
            ['nome' => 'Cartão de Memória MicroSDXC 256GB', 'descricao' => 'Classe 10 U3 V30, ideal para vídeos 4K e câmeras de segurança.', 'preco' => 180.00, 'qtd' => 55, 'data' => '2025-05-01'],
            ['nome' => 'Maleta para Notebook até 15.6"', 'descricao' => 'Resistente à água, acolchoada internamente, com alça de ombro.', 'preco' => 79.90, 'qtd' => 65, 'data' => '2025-03-05'],
            ['nome' => 'Apoio de Punho Ergonômico para Teclado', 'descricao' => 'Gel macio, proporciona conforto e previne lesões.', 'preco' => 55.00, 'qtd' => 45, 'data' => '2025-06-01'],
            ['nome' => 'Cabo de Rede Cat6 (10 Metros)', 'descricao' => 'Velocidade de até 1 Gbps, plugues RJ45 blindados.', 'preco' => 39.90, 'qtd' => 150, 'data' => '2025-02-10'],
            ['nome' => 'Leitor de Código de Barras USB', 'descricao' => 'Laser de alta precisão, plug and play, para automação comercial.', 'preco' => 270.00, 'qtd' => 20, 'data' => '2025-07-01'],
            ['nome' => 'Pasta Catálogo com 50 Envelopes', 'descricao' => 'Capa dura, ideal para apresentação e arquivamento de documentos.', 'preco' => 32.00, 'qtd' => 70, 'data' => '2025-05-10'],
            ['nome' => 'Apagador de Quadro Branco com Imã', 'descricao' => 'Feltro de alta densidade, apaga facilmente, fixa na superfície metálica.', 'preco' => 18.00, 'qtd' => 110, 'data' => '2025-04-18'],
            ['nome' => 'Quadro Branco Magnético 60x40cm', 'descricao' => 'Superfície de alta qualidade, moldura em alumínio.', 'preco' => 85.00, 'qtd' => 15, 'data' => '2025-03-01'],
            ['nome' => 'Pilha Recarregável AA (Kit com 4)', 'descricao' => '2500mAh, níquel-hidreto metálico, longa vida útil.', 'preco' => 79.00, 'qtd' => 50, 'data' => '2025-06-20'],
            ['nome' => 'Caixa de Som Portátil JBL Go 3', 'descricao' => 'Bluetooth, à prova dágua, som potente e design compacto.', 'preco' => 250.00, 'qtd' => 28, 'data' => '2025-01-20'],
            ['nome' => 'Cabo Adaptador HDMI para VGA', 'descricao' => 'Converte sinal digital para analógico. Ideal para projetores antigos.', 'preco' => 65.00, 'qtd' => 95, 'data' => '2025-07-25'],
            ['nome' => 'Scanner Portátil de Documentos USB', 'descricao' => 'Digitaliza documentos em alta resolução em segundos, leve e compacto.', 'preco' => 580.00, 'qtd' => 7, 'data' => '2025-05-05'],
            ['nome' => 'Pendrive Personalizado 64GB', 'descricao' => 'Chaveiro de metal, ideal para brindes e uso corporativo.', 'preco' => 55.00, 'qtd' => 180, 'data' => '2025-04-12'],
        ];

        // 3. Insere os dados no banco de dados
        foreach ($produtos as $item) {
            Produto::create([
                'nome'               => $item['nome'],
                'descricao'          => $item['descricao'],
                'preco'              => $item['preco'],
                'quantidade_estoque' => $item['qtd'],
                'data_fabricacao'    => $item['data'],
                'ativo'              => true,
                'user_id'            => $userId, // Vincula ao seu usuário
            ]);
        }
    }
}
