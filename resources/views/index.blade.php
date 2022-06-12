<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simuladores de investimento</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/app.js') }}" defer></script>

    @if(App::environment(['production']))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-85ZMZMW04P"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-85ZMZMW04P');
    </script>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5507757504814188"
            crossorigin="anonymous"></script>
    @endif

</head>
<body class="bg-light">

    <div class="container">
        <div class="row mt-3">

            <div class="col-md-3"></div>
            <div class="col-md-6 col-12">
                <h1 class="mb-3">Simuladores de investimento</h1>
                <div id="simulator"></div>
            </div>
            <div class="col-md-3"></div>

        </div>

        <div class="row mt-3">

            <div class="col-md-3"></div>

            <div class="col-md-6 col-12">
                    <h2 class="mb-3">Sobre os simuladores</h2>

                    <p>Este simulador tem como objetivo calcular o valor esperado ao investir um valor nas aplicações disponíveis.</p>

                    <p>Para utilizar o simulador você deve preencher:</p>

                    <ul>
                        <li><strong>Aplicação:</strong> qual aplicação você deseja simular</li>
                        <li><strong>Valor inicial:</strong> o valor que será investido</li>
                        <li><strong>Prazo:</strong> quanto tempo o valor ficará investido (em anos, meses ou dias)</li>
                        <li>
                            <strong>Taxa:</strong> a taxa da aplicação ao ano
                            <ul>
                                <li><strong>CDI ou SELIC:</strong> aqui você define qual é a porcentagem dessa taxa na aplicação (algumas aplicações podem ter 110% do CDI por exemplo)</li>
                                <li><strong>Pré-fixado:</strong> aqui você define a taxa fixa (10%, por exemplo)</li>
                            </ul>
                        </li>
                    </ul>

                    <p>Depois de preenchido, você pode simular. A simulação irá te retornar quatro informações:</p>

                    <ul>
                        <li><strong>Valor inicial:</strong> o valor que foi investido</li>
                        <li><strong>Valor bruto:</strong> o valor bruto da aplicação, ainda sem os descontos</li>
                        <li><strong>Descontos:</strong> descontos na fonte dessa aplicação. Aqui podem ser aplicados dois descontos (dependendo da aplicação): Imposto de Renda e IOF</li>
                        <li><strong>Valor líquido:</strong> valor bruto com os descontos aplicados</li>
                    </ul>

                    <p>Se quiser, você poderá fazer uma nova simulação.</p>

                    <h2>Aplicações disponíveis</h2>

                    O simulador possui quatro aplicações:

                    <ul>
                        <li>Nenhuma</li>
                        <li>CDB</li>
                        <li>LC</li>
                        <li>LCI</li>
                        <li>LCA</li>
                    </ul>

                    <p>A primeira opção (nenhuma) é quando você deseja simplesmente calcular os efeitos dos juros compostos no valor inicial.</p>

                    <h3>CDB</h3>

                    <p>CDB é uma sigla para Certificado de Depósito Bancário, a ideia deste investimento de renda fixa é que o investidor empreste dinheiro para o banco. Com esse dinheiro o banco pode movimentar suas operações, e ele se compromete a devolver o dinheiro acrescido de juros ao investidor.</p>

                    <p>A ideia aqui é muito semelhante ao Tesouro Direto, mas no caso do Tesouro o dinheiro é destinado ao Governo. Já no CDB é o banco quem recebe esse dinheiro. De grosso modo, de qualquer forma, o funcionamento é parecido.</p>

                    <p>Assim, o banco pode capturar dinheiro de pessoas dispostas através do CDB. Esse dinheiro é usado para que o banco faça empréstimos para os seus clientes. Os clientes pagam ao banco e o banco então paga os investidores.</p>

                    <p>É interessante observar, entretanto, que o banco cobra uma taxa de juros maior dos seus clientes do que paga aos investidores do CDB. Essa diferença é chamada de spread. Mas por que essa diferença?</p>

                    <p>Por alguns motivos. O primeiro é que é nessa diferença que o banco terá o seu lucro. O segundo é que o banco tem um risco maior do que você, investidor no CDB.</p>

                    <p>Mesmo que o banco não receba dos seus clientes ele deverá pagar os investidores. Como o risco do banco é maior, o seu prêmio também é maior.</p>

                    <p>No Brasil, entretanto, esse spread é bem alto quando comparado a outros países. Ou seja, em outros países a diferença de juros do que o banco paga dos investidores e cobra dos seus clientes é menor.</p>

                    <h3>LC</h3>

                    <p>LC é muito parecido com o CDB, mas ao invés de "emprestar" dinheiro para um banco, você empresta para uma entidade financeira.</p>

                    <h3>LCI e LCA</h3>

                    <p>Aqui vai uma curiosidade interessante para você.</p>

                    <p>Durante as cruzadas, alguns nobres e outras pessoas que possuíam tesouros e queriam peregrinar para a Terra Santa, mas não tinham condições de levar suas riquezas, procuravam por membros da Ordem dos Templários e confiavam a eles suas posses.</p>

                    <p>Eles recebiam uma "letra" e, quando chegavam a Jerusalém, conseguiam resgatar o valor proporcional de sua riqueza apresentando o comprovante dado pela Ordem.</p>

                    <p>A ideia é muito parecida quando se fala em Letras de Crédito Imobiliário (LCI) ou do Agronegócio (LCA). Enquanto o primeiro se trata de um título emitido para levantar fundos a serem investidos em negócios imobiliários, o segundo é voltado para o agronegócio.</p>

                    <p>Eles são parecidos com os títulos do Tesouro Direto, pois também podem ser pré-fixados, bem como pós-fixados, atrelado a um índice específico. Neste último, geralmente se usa o CDI como indexador principal ou o IPCA.</p>

                    <p>Uma das principais diferenças entre as Letras de Crédito e o Tesouro Direto é que os títulos são emitidos por entidades privadas, como bancos e instituições financeiras. E além disto, o que mais atrai os investidores para as LCIs e LCAs é que ambos são <strong>isentos de imposto de renda</strong>.</p>

                    <p>Porém, existe um problema relacionado com a liquidez destes títulos. As Letras de Crédito devem ter um período mínimo de investimento, que varia de acordo com a natureza dos títulos.</p>

                    <p>Por exemplo, no caso dos pré-fixados, o tempo mínimo de investimento é de 90 dias. Já em casos de LCIs ou LCAs atreladas a algum índice, este período mínimo pode ser de 12 a 36 meses.&nbsp;</p>

                    <p>Por isso, faça bastante pesquisas e se planeje bem, caso esteja pensando em investir nessa modalidade de renda fixa.</p>

                </div>
            
            <div class="col-md-3"></div>

        </div>

    </div>

</body>
</html>
