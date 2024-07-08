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
     * Explicação detalhada:
     * 
     * 1. require_once: Inclui os arquivos necessários para o funcionamento do sistema, como classes Core, Model e Controllers.
     * 
     * 2. file_get_contents('app/Template/template.html'): Este comando lê o conteúdo do arquivo template.html que está localizado na pasta app/Template e guarda todo o conteúdo na variável $template.
     * 
     * 3. ob_start(): Inicia o buffer de saída. Isso significa que qualquer saída gerada a partir deste ponto não será enviada diretamente para o navegador ou cliente que fez a requisição HTTP, mas sim será armazenada internamente em um buffer.
     * 
     * 4. $core = new Core;: Cria uma nova instância da classe Core.
     * 
     * 5. $core->start($_GET): Chama o método start da instância $core, passando o array $_GET como argumento. O $_GET é uma superglobal do PHP que contém variáveis passadas para o script via parâmetros de URL (query string).
     * 
     * 6. ob_get_contents(): Obtém o conteúdo do buffer de saída atual, ou seja, tudo o que foi gerado desde o início do buffer até o momento antes desta chamada.
     * 
     * 7. ob_end_clean(): Limpa o buffer de saída e desativa o buffering de saída. Isso significa que o conteúdo que foi armazenado no buffer (com ob_start()) não será enviado para o navegador, mas sim armazenado na variável $saida.
     * 
     * 8. str_replace('{{area_dinamica}}', $saida, $template): Substitui a marcação {{area_dinamica}} no template pelo conteúdo dinâmico gerado e armazenado em $saida, resultando em $str.
     * 
     * 9. echo $str;: Exibe o resultado final no navegador, que é o conteúdo HTML completo com a área dinâmica preenchida.
     * 
     * Resumo:
     * 
     * O código apresentado carrega um template HTML, executa a lógica do sistema (representada pela classe Core e seus métodos) que gera conteúdo dinâmico baseado nos parâmetros recebidos via $_GET, e insere esse conteúdo dinâmico no template. Finalmente, o código exibe o HTML resultante para o usuário final.
     */