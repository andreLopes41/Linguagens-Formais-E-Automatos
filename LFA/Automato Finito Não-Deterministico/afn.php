<?php

    // Definição de um AFN que reconheça 
    //IDs - nome de variáveis, devem começar com ao menos uma letra, que pode ser seguida de letras ou números
    //Constantes - valores numéricos
    //As palavras reservadas: IF, FOR e WHILE

    function automato($entrada) {

        // Converte a entrada para Minúsculo
        $entrada = strtolower($entrada);

        $estados = array(
            0 => array('[a-eghj-vx-z]' => 1, '[0-9]' => 4, 'i' => 2, 'f' => 5, 'w' => 8),
            1 => array('[a-z]' => 1, '[0-9]' => 1),
            2 => array('[^f]' => 1, 'f' => 3),
            3 => array('[a-z]' => 1),
            4 => array('[a-z]' => 99, '[0-9][^a-z]' => 4),
            5 => array('[^o]' => 1, 'o' => 6),
            6 => array('[^r]' => 1 ,'r' => 7),
            7 => array('[a-z]' => 1),
            8 => array('[^h]' => 1 ,'h' => 9),
            9 => array('[^i]' => 1 ,'i' => 10),
            10 => array('[^l]' => 1 ,'l' => 11),
            11 => array('[^e]' => 1 ,'e' => 12),
            12 => array('[a-z]' => 1),
            99 => array('Estado para escape'),
        );
    
        $estadoAtual = 0;
        $cadeiaAtual = '';

        for ($i = 0; $i < strlen($entrada); $i++) {
            $char = $entrada[$i];

            foreach ($estados[$estadoAtual] as $regex => $prox) {
                if (preg_match('/^' . $regex . '$/', $char)) {
                    $estadoAtual = $prox;
                    $cadeiaAtual = $char . $cadeiaAtual;
                    break;
                }
            }
        }

        $finais = array(
            1 => 'id',            
            3 => 'palavra reservada IF',
            4 => 'constante',
            7 => 'palavra reservada FOR',
            12 => 'palavra reservada WHILE',
        );

        if (isset($finais[$estadoAtual])) {
            return $entrada . '<br>' . 'Cadeia aceita Como: [' . $finais[$estadoAtual] . ']';
        } else {
            return $entrada . '<br>' . 'Cadeia não reconhecida';
        }
    }

    echo automato('andre64') . '<br>'.'<br>'; 
    echo automato('while') . '<br>'.'<br>';
    echo automato('for') . '<br>'.'<br>';
    echo automato('if') . '<br>'.'<br>';
    echo automato('5178') . '<br>'.'<br>';
    echo automato('45tempo') . '<br>'.'<br>';
?>