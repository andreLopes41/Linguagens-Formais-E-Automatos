<?php 

    // Faça a implementação do algoritmo CYK para análise da linguagem 
    // L = {a^n b^n | n >= 0}  
    // O algoritmo deve retornar se uma entrada informada pelo usuário
    // pertence ou não a linguagem L

    function algoritmoCyk($entrada) {
        $tamEntrada = strlen($entrada);
      
        // Tabela CYK
        $tabelaCyk = array();
        for ($i = 0; $i < $tamEntrada; $i++) {
          for ($j = 0; $j < $tamEntrada; $j++) {
            $tabelaCyk[$i][$j] = array();
          }
        }
      
        // Preenchimento das células da diagonal principal
        for ($i = 0; $i < $tamEntrada; $i++) {
          $terminal = $entrada[$i];
          $producoes = array();
      
          // Verificar se algum não-terminal gera o símbolo terminal
          if ($terminal === 'a') {
            $producoes[] = 'A';
          } elseif ($terminal === 'b') {
            $producoes[] = 'B';
          }
      
          $tabelaCyk[$i][$i] = $producoes;
        }
      
        // Preenchimento das células restantes
        for ($tam = 2; $tam <= $tamEntrada; $tam++) {
          for ($inicio = 0; $inicio <= $tamEntrada - $tam; $inicio++) {
            $fim = $inicio + $tam - 1;
            $producoes = array();
      
            for ($k = $inicio; $k < $fim; $k++) {
              $esqProductions = $tabelaCyk[$inicio][$k];
              $dirProductions = $tabelaCyk[$k + 1][$fim];
      
              // Verificar combinações de produções possíveis
              foreach ($esqProductions as $esq) {
                foreach ($dirProductions as $dir) {
                  // Verificar regras de produção da gramática

                  // Gramática
                  // S -> AT | BU | XX | AB | BA | ε
                  // X -> AT | BU | XX | AB | BA
                  // T -> SB
                  // U -> SA
                  // A -> a
                  // B -> b
                  if ($esq === 'S' && $dir === 'A') {
                    $producoes[] = 'U';
                  }
                  if ($esq === 'S' && $dir === 'B') {
                    $producoes[] = 'T';
                  }
                  if (($esq === 'A' && $dir === 'T') || ($esq === 'B' && $dir === 'U') || ($esq === 'X' && $dir === 'X') || ($esq === 'A' && $dir === 'B') || ($esq === 'B' && $dir === 'A')) {
                    $producoes[] = 'X';
                  }
                  if (($esq === 'A' && $dir === 'T') || ($esq === 'B' && $dir === 'U') || ($esq === 'X' && $dir === 'X') || ($esq === 'A' && $dir === 'B') || ($esq === 'B' && $dir === 'A')) {
                    $producoes[] = 'S';
                  }
                }
              }
            }
      
            $tabelaCyk[$inicio][$fim] = $producoes;
          }
        }
      
        // Verificar se o símbolo inicial está na célula final
        return in_array('S', $tabelaCyk[0][$tamEntrada - 1]);
      }

   
    // Entrada
    $entrada = 'aabb';


    if ($entrada === '' || $entrada === 'ε' || $entrada === 'vazio') {
      $entrada = 'ε';
      echo "<div style='background-color: #f0c1c1; padding: 10px; display: inline-block;'>
        <strong>A cadeia = { $entrada }</strong><br>
        <span style='color: red;'>NÃO é aceita pela gramática.</span>
        </div>";
    }
    else if (algoritmoCyk($entrada)) {
        echo "<div style='background-color: #c1f0c1; padding: 10px; display: inline-block;'>
        <strong>A cadeia = { $entrada }</strong><br>
        <span style='color: green;'>É aceita pela gramática.</span>
        </div>";
    } else {
        echo "<div style='background-color: #f0c1c1; padding: 10px; display: inline-block;'>
        <strong>A cadeia = { $entrada }</strong><br>
        <span style='color: red;'>NÃO é aceita pela gramática.</span>
        </div>";
    }