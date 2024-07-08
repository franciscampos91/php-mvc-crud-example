<?php

    require_once 'app/Core/Core.php';
    require_once 'lib/Database/Connection.php';
    require_once 'app/Model/Produtos.php';
    require_once 'app/Model/Clientes.php';

    require_once 'app/Controller/HomeController.php';
    require_once 'app/Controller/ErrorController.php';
    require_once 'app/Controller/ProdutosController.php';
    require_once 'app/Controller/ClientesController.php';

    //O método file_get_contents() é usado para ler o conteúdo de um arquivo em uma string
    $template = file_get_contents('app/Template/template.html');

 // Inicia o buffer de saída
    ob_start();
        $core = new Core;
        $core->start($_GET);
        // Obtém o conteúdo do buffer de saída sem limpar o buffer ainda
        $saida = ob_get_contents();
    // Limpa (esvazia) o buffer de saída sem enviar para a saída padrão
    ob_end_clean();

    $str = str_replace('{{area_dinamica}}', $saida, $template);

    echo $str;


    /**
     
    Explicação detalhada:
    file_get_contents('app/Template/template.html'): Este comando lê o conteúdo do arquivo template.html que está localizado na pasta app/Template e guarda todo o conteúdo na variável $template.

    ob_start(): Inicia o buffer de saída. Isso significa que qualquer saída gerada a partir deste ponto não será enviada diretamente para o navegador ou cliente que fez a requisição HTTP, mas sim será armazenada internamente em um buffer.

    $core = new Core;: Cria uma nova instância da classe Core.

    $core->start($_GET): Chama o método start da instância $core, passando o array $_GET como argumento. O $_GET é uma superglobal do PHP que contém variáveis passadas para o script via parâmetros de URL (query string).

    ob_get_contents(): Obtém o conteúdo do buffer de saída atual, ou seja, tudo o que foi gerado desde o início do buffer até o momento antes desta chamada.

    ob_end_clean(): Limpa o buffer de saída e desativa o buffering de saída. Isso significa que o conteúdo que foi armazenado no buffer (com ob_start()) não será enviado para o navegador, mas sim armazenado na variável $saida.

    Resumo:
    O código apresentado basicamente carrega o conteúdo de um arquivo HTML (template.html) em uma variável $template, executa uma função ou método (representado pelo método start da classe Core) que gera algum conteúdo dinâmico baseado nos parâmetros $_GET, e armazena esse conteúdo gerado em uma variável $saida. Durante todo esse processo, o PHP usa buffers de saída (ob_start(), ob_get_contents(), ob_end_clean()) para manipular a saída gerada antes de enviar para o navegador.
     */