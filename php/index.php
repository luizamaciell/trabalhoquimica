<!DOCTYPE html>
<html>
<head>
    <title>Distribuição Eletrônica</title>
</head>
<body>
    <h1>Distribuição Eletrônica dos Elementos Químicos</h1>

    <form method="POST" action="">
        <label for="atomic_number">Número Atômico:</label>
        <input type="text" id="atomic_number" name="atomic_number">
        <input type="submit" value="Calcular">
    </form>

    <?php
    function calculate_electronic_distribution($atomic_number)
    {
        $distribution = array(
            1 => array('K', 's', 2),
            2 => array('K', 's', 2, 'L', 's', 2),
            3 => array('K', 's', 2, 'L', 's', 2, 'M', 's', 2),
            // Preencher com os demais elementos da tabela periódica...
        );

        
        return $distribution;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $atomic_number = $_POST['atomic_number'];

        // Validar se o número atômico é válido
        if (!empty($atomic_number) && is_numeric($atomic_number) && $atomic_number > 0) {
            $distribution = calculate_electronic_distribution($atomic_number);

            $distribuicao = '';
            $camadaValencia = '';
            $numEletronsValencia = 0;
            $subnivelMaisEnergetico = '';
            $numEletronsMaisEnergetico = 0;
        
            $elemento = $tabelaPeriodica[$atomic_number];
            for ($i = 0; $i < count($elemento); $i += 3) {
                $camada = $elemento[$i];
                $subnivel = $elemento[$i + 1];
                $maxEletrons = $elemento[$i + 2];
        
                $distribuicao .= "$camada$subnivel";
                if ($i + 3 < count($elemento)) {
                    $distribuicao .= ', ';
                }
        
                // Verificar se é a camada de valência
                if ($i + 3 >= count($elemento)) {
                    $camadaValencia = $camada;
                    $numEletronsValencia += $maxEletrons;
                }
        
                // Verificar o subnível mais energético
                if ($maxEletrons > $numEletronsMaisEnergetico) {
                    $subnivelMaisEnergetico = $subnivel;
                    $numEletronsMaisEnergetico = $maxEletrons;
                }
            }
        
            // Retornar os resultados
            $resultado = "Distribuição Eletrônica: $distribuicao" . PHP_EOL;
            $resultado .= "Camada de Valência: $camadaValencia" . PHP_EOL;
            $resultado .= "Nº de Elétrons na Camada de Valência: $numEletronsValencia" . PHP_EOL;
            $resultado .= "Subnível Mais Energético: $subnivelMaisEnergetico" . PHP_EOL;
            $resultado .= "Nº de Elétrons no Subnível Mais Energético: $numEletronsMaisEnergetico" . PHP_EOL;
        
            return $resultado;
        }
        } else {
            echo "Por favor, insira um número atômico válido.";
        }

    ?>
</body>
</html>