<?php

    // Defina um AP para a linguagem abaixo e faça a implementação desse autômato
    // L = {wXwr  | w pertence a {a|b}* e wr é w invertido}

    function automato($entrada) {

        $pilha = [];
        $i = 0;
    
        // Empilha os símbolos 'a' e 'b'
        while ($i < strlen($entrada) && ($entrada[$i] === 'a' || $entrada[$i] === 'b')) {
            array_push($pilha, $entrada[$i]);
            $i++;
        }
    
        // Verifica se o próximo símbolo é 'X'
        if ($i < strlen($entrada) && $entrada[$i] === 'X') {
            $i++;
        } else {
            return "[" . $entrada . "] = Cadeia não reconhecida";
        }
    
        // Desempilha e compare com a entrada
        while ($i < strlen($entrada) && !empty($pilha)) {
            if ($entrada[$i] === end($pilha)) {
                array_pop($pilha);
            } else {
                return "[" . $entrada . "] = Cadeia não reconhecida";
            }
            $i++;
        }
    
        // Verifica se a pilha está vazia e a entrada foi totalmente processada
        if (empty($pilha) && $i === strlen($entrada)) {
            return "[" . $entrada . "] = Cadeia aceita";
        } else {
            return "[" . $entrada . "] = Cadeia não reconhecida";
        }
    }

    echo automato('baaXaab') . '<br>'.'<br>';
    echo automato('abXbb') . '<br>'.'<br>';
    echo automato('aaXaa') . '<br>'.'<br>';
    echo automato('aaXbb') . '<br>'.'<br>';  
?>
