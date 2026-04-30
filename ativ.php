<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechDash | Gestão Inteligente</title>
    <style>
        :root {
            --primary: #0f172a;
            --secondary: #1e293b;
            --accent: #3b82f6;
            --text-light: #f8fafc;
            --success: #22c55e;
        }

        .video-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }


  
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(11, 15, 26, 0.85);
            z-index: -1;
        }


        body { 
            font-family: 'Inter', -apple-system, sans-serif; 
            margin: 0;
            color: var(--text-light); 
            display: flex; 
            flex-direction: column; 
            min-height: 100vh;
        }

        header {
            background-color: var(--primary);
            padding: 1rem 5%;
            border-bottom: 1px solid #334155;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }

        header h1 {
            font-size: 1.5rem;
            margin: 0;
            color: var(--accent);
            letter-spacing: -1px;
        }

        .main-content {
            flex: 1;
            padding: 40px 5%;
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .card { 
            background: var(--secondary); 
            border-radius: 16px; 
            padding: 30px; 
            flex: 1;
            min-width: 350px;
            max-width: 500px;
            min-height: 480px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2); 
            border: 1px solid #334155;
            display: flex;
            flex-direction: column;
            gap: 15px; 
            transition: transform 0.3s ease;
        }

        h2 { 
            margin-top: 0;
            color: var(--text-light); 
            font-size: 1.4rem; 
            border-bottom: 2px solid var(--accent);
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .currency-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }

        .flag {
            width: 55px;
            height: 38px;
            object-fit: cover;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.4);
        }

        .arrow-swap {
            font-size: 24px;
            color: var(--accent);
        }

        .price-container {
            text-align: center;
        }

        .price { 
            font-size: 3rem; 
            font-weight: 800; 
            color: var(--success); 
            display: block;
        }

        .img-truck { 
            width: 100%; 
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #334155;
            background-color: #0f172a;
        }

        .form-group {
            display: flex;
            gap: 10px;
        }

        input[type="text"] { 
            padding: 12px; 
            border: 1px solid #334155; 
            border-radius: 8px; 
            background: #0f172a;
            color: white;
            flex: 1;
        }

        button { 
            padding: 12px 20px; 
            background-color: var(--accent); 
            color: white; 
            border: none; 
            border-radius: 8px; 
            font-weight: bold;
            cursor: pointer; 
        }

        .result { 
            background: #0f172a;
            padding: 15px;
            border-radius: 8px;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        footer {
            background-color: var(--primary);
            text-align: center;
            padding: 20px;
            font-size: 0.8rem;
            color: #64748b;
            border-top: 1px solid #334155;
        }
    </style>
</head>
<body>

<video autoplay muted loop class="video-bg">
    <source src="video.mp4" type="video/mp4">
</video>

<header>
    <h1>TECH<span>DASH</span></h1>
    <div style="font-size: 0.9rem; color: #94a3b8;">Logística e Finanças</div>
</header>

<div class="main-content">
    <?php
        $urlFinance = "https://economia.awesomeapi.com.br/json/last/USD-BRL";
        $jsonFinance = @file_get_contents($urlFinance);
        $dadosFinance = json_decode($jsonFinance, true);
        $cotacaoDolar = $dadosFinance ? number_format($dadosFinance['USDBRL']['bid'], 2, ',', '.') : "0,00";
    ?>
    
    <div class="card">
        <h2>Câmbio Comercial</h2>
        <p style="text-align: center; color: #94a3b8; margin: 0;">Conversão USD para BRL</p>
        
        <div class="currency-wrapper">
            <img src="https://flagcdn.com/w80/us.png" class="flag" alt="EUA">
            <span class="arrow-swap">➔</span>
            <img src="https://flagcdn.com/w80/br.png" class="flag" alt="Brasil">
        </div>

        <div class="price-container">
            <small style="color: #64748b; text-transform: uppercase; letter-spacing: 1px;">Valor de venda</small>
            <span class="price">R$ <?php echo $cotacaoDolar; ?></span>
        </div>
        
        <div style="margin-top: auto; font-size: 0.75rem; color: #475569; text-align: center;">
            Cotação em tempo real 
        </div>
    </div>

    <div class="card">
        <h2>Módulo de Logística</h2>
        <img src="caminhao.avif" class="img-truck" alt="Caminhão de entrega em rua com casas"> 
        
        <form method="GET" class="form-group">
            <input type="text" name="cep" placeholder="CEP (ex: 01001000)" maxlength="8" required>
            <button type="submit">Consultar</button>
        </form>

        <div class="result">
            <?php 
            if (isset($_GET['cep'])):
                $cep = preg_replace('/[^0-9]/', '', $_GET['cep']);
                $urlCep = "https://viacep.com.br/ws/$cep/json/";
                $jsonCep = @file_get_contents($urlCep);
                $dadosCep = json_decode($jsonCep, true);

                if (isset($dadosCep['erro']) || !$dadosCep):
                    echo "<p style='color:#f87171; margin:0;'>CEP inválido ou não encontrado.</p>";
                else:
            ?>
                <strong>Destino da Entrega:</strong><br>
                <?php echo $dadosCep['logradouro']; ?>, <?php echo $dadosCep['bairro']; ?><br>
                <?php echo $dadosCep['localidade']; ?> - <?php echo $dadosCep['uf']; ?>
            <?php 
                endif; 
            else:
                echo "<p style='color:#64748b; text-align:center; margin:0;'>Aguardando entrada de CEP...</p>";
            endif; 
            ?>
        </div>
        
        <div style="margin-top: auto; font-size: 0.75rem; color: #475569; text-align: center;">
            Integração ViaCEP Ativa
        </div>
    </div>
</div>

<footer>
    &copy; 2026 TechDash Intelligence. Todos os direitos reservados.
</footer>

</body>
</html>