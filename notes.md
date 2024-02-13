##### 12/02/2024

CURSO Design Patterns em PHP: padrões comportamentais

@01-Strategy

@@01
Introdução

[00:00] Sejam muito bem-vindos à Alura, meu nome é Vinicius Dias e vou guiar vocês nesse treinamento de padrões de projeto comportamentais. Como assim comportamentais, Vinicius? Você vai ensinar eles a se comportarem direito? Não, não é isso.
[00:14] Existe um grupo que foi muito famoso, ainda é muito famoso, carinhosamente conhecido como The Gang of 4, a gangue dos 4, que escreveu um livro muito conhecido descrevendo 23 padrões de projeto, formas de solucionar problemas um pouco mais genéricos e bem interessante, de forma bem interessante, utilizando orientação a objetos.

[00:35] Esses 23 padrões foram divididos em três categorias. A primeira são os padrões criacionais, basicamente eles provém mecanismos para você criar objetos mais complexos. Padrões estruturais, que explicam como juntar objetos de forma que mantenham uma estrutura flexível, extensível, e os que vamos tratar, que são os comportamentais, que tratam da comunicação e designação da responsabilidade de vários objetos, se comunicando entre si, trocando responsabilidades entre si.

[01:12] Vamos ver alguns desses padrões de objetos, não vamos ver todos, vamos ver os principais, que fazem mais sentido, principalmente no mundo php. Todos os exemplos que colocarmos aqui, que vamos usar, tem alguma ligação com o mundo real, de alguma forma é possível ser aplicada em um desenvolvimento de uma aplicação php.

[01:28] Vamos ver alguns padrões, e para isso vamos criar um sistema de gerenciamento de orçamentos. Um orçamento, que por enquanto vai começar tendo só valor, depois adicionamos quantidade de itens, estados para gerenciar com o padrão de projetos chamado de state, e nisso vamos ter vários estados nesse projeto, onde é possível calcular descontos, e falando em calcular descontos tem uma calculadora de descontos que vai utilizar outro padrão de projeto, que é o chain of responsibility.

[02:00] Também temos uma calculadora de impostos, onde vimos como utilizar o padrão strategy, recebemos uma estratégia e utilizamos ela para realizar algum algoritmo. Vimos também sobre template method, que é basicamente uma forma de definir um algoritmo, template, template de algoritmo base que vai ser sobrescrito em partes específicas por classes base.

[02:25] Vimos sobre observer, iterator, vamos ver sobre isso tudo, vamos ver bastante coisa, bastante conteúdo interessante, bastante conceitual, mas sempre colocando a mão na massa. Espero que você goste bastante desse conteúdo, te espero no próximo vídeo para colocarmos a mão na massa, e sempre se lembre que caso qualquer dúvida surja, não hesite, você pode entrar no fórum, entrar em contato. Eu tento responder pessoalmente sempre que dá, mas quando não consigo nossa comunidade é muito solicita, temos vários alunos e moderadores prontos para responder suas dúvidas.

[02:55] Mais uma vez, seja bem-vindo, espero que você aproveite bastante esse conteúdo, e te vejo no próximo vídeo para colocar a mão na massa e começar a desenvolver esse sistema.

@@02
Iniciando o sistema

[00:00] Nesse você só vamos ver o que é necessário ter instalado na máquina para continuarmos com esse projeto, e só vamos começar a falar um pouco sobre o sistema. Para começar, obviamente você precisa do php instalado. Hoje na data da gravação a última versão é a 7.4.2, mas você precisa ter pelo menos a 7.4.0 instalada no seu sistema para dar continuidade neste treinamento.
[00:25] Além do php também precisamos do composer, e vamos utilizar o autoloader dele. Abre seu terminal e garante que o composer já está instalado. Temos vídeos aqui sobre composer, temos outros cursos onde você aprende como instalar o php, então não vou tomar parte desse treinamento com essas coisas que já foram discutidas anteriormente.

[00:50] Com as dependências instaladas, vamos começar o nosso projeto. Primeiro, o que é nosso projeto? Vamos criar um sistema que a partir de um orçamento calcula imposto, adiciona descontos e faz alguns cálculos. Vamos ter uma classe de orçamento. Dentro de uma pasta src vou criar uma classe chamada Orcamento, e o name space vai ser Alura\DesignPattern. E vou deixar isso dentro de uma pasta chamada src.

[01:35] Criei essa classe e tudo que ela vai ter vai ser uma propriedade que vai ser um float valor. Se você estiver utilizando php storm e aparecer um erro, "Alt + Enter" e enter, ele já vai entender que você vai utilizar o php 7.4 e por isso consegue utilizar as propriedades tipadas.

[01:55] Estou deixando público porque quase não vamos utilizar essa classe diretamente, não vai ter muita regra de negócio, então não vou perder tempo encapsulando ela, colocando um getter e setter.

[02:08] Agora, para ter o autoloader configurado, vou criar o famoso composer.json e vou definir um autoload, vou utilizar a psr-4, e nosso name space é Alura\DesignPattern. Se você não está entendendo o que fiz aqui, volta no curso de composer que essa parte já foi explicada.

[02:40] Com nosso autoloader configurado, vou no nosso terminal, executo composer dump-autoload. Caso você prefira utilizar outro name space, você pode colocar o name space que você quiser, só lembre de atualizar nos dois lugares. Tem que ser o mesmo.

[03:15] Com isso já temos nosso projeto configurado para dar continuidade, para começarmos a desenvolver nossa cálculo de descontos, criar impostos, esse tipo de coisa. Agora, com nosso pontapé dado podemos partir para o próximo vídeo, colocar a mão na massa e ver realmente o que precisamos nesse sistema.

@@03
Para saber mais: Composer

Composer é uma ferramenta muito importante no universo PHP. Ele é um gerenciador de dependências que permite controlar e instalar bibliotecas de terceiros em seus projetos PHP de forma eficiente. Com o Composer, é possível especificar as bibliotecas e suas versões requeridas em um arquivo de configuração, simplificando o processo de integração e atualização de componentes externos.
Temos um curso focado no composer que pode ser acessado neste link: https://cursos.alura.com.br/course/php-composer

@@04
Composer e autoload

Neste pontapé inicial do projeto, o Composer foi utilizado para gerar um arquivo que cuida do autoload das nossas classes do sistema.
O que é autoload de classes?

É uma funcionalidade que o Composer criou para carregar automaticamente as classes
 
Alternativa errada! Essa funcionalidade não foi criada pelo Composer. Ele apenas implementa a funcionalidade nativa do PHP.
Alternativa correta
Um arquivo que o Composer cria, com todas as nossas classes definidas
 
Alternativa errada! Essa não é a definição de autoload.
Alternativa correta
É uma funcionalidade que o PHP fornece para carregar arquivos de forma mais prática
 
Alternativa correta! Através da função spl_autoload_register do PHP, nós podemos informar como ele pode carregar arquivos sempre que um símbolo (classe, função, etc) for utilizado, sem que o seu arquivo tenha sido incluído. Desta forma, não precisamos dar require (ou include) de cada um dos arquivos das nossas classes individualmente.

@@05
Aplicando impostos

@@06
Diferentes tipos de classes

No último vídeo, uma classe que calcula impostos foi criada.
Que tipo de classe é essa?

Que tipo de classe é essa?

Alternativa correta
Classe estática
 
Alternativa errada! Este conceito não existe no PHP.
Alternativa correta
Classe de serviço
 
Alternativa correta! A classe CalculadoraDeImpostos representa uma funcionalidade em nosso sistema, logo, pode ser chamada de classe de serviço.
Alternativa correta
Classe de modelo
 
Alternativa errada! A classe CalculadoraDeImpostos representa uma funcionalidade em nosso sistema, e não a definição de algo do nosso domínio.

@@07
Para saber mais: Ponto flutuante

Em computação, existe o famoso problema dos Pontos Flutuantes. Operações aritméticas com números decimais podem ser problemáticas e cada linguagem resolve este problema de uma forma.
Para entender mais sobre o problema, você pode acessar este link: https://floating-point-gui.de/

Nele, você também consegue encontrar as principais soluções existentes em diversas linguagens (incluindo PHP).

@@08
Removendo switch-case com Strategy

[00:00] Bem-vindos de volta. Vamos recapitular o que fizemos, porque antes de corrigirmos o problema é importante entendermos bem. Quando temos uma classe que pode crescer para sempre, quando ela tem, por exemplo, vários ifs, que é nosso caso, só utilizamos o switch case, mas no fundo é a mesma coisa que se tivéssemos vários ifs para verificar o nome do imposto. Isso é um sinal claro de um problema e essa classe pode acabar trazendo muitos problemas no futuro, porque sempre que for calcular um imposto novo preciso calcular ela, posso acabar editando um código que já funciona, criando novos bugs.
[00:36] O ideal, como já falamos em cursos anteriores, é que se existe funcionalidade nova, o ideal é que você crie código novo, e não edite código que já exista. Então como podemos fazer para sempre que eu precisar calcular um novo imposto criar um código novo? Vamos criar uma classe para cada imposto.

[01:00] Inclusive, vou até criar uma nova pasta chamada de Impostos. E dentro dessa classe de Impostos vou criar o ICMS, que vai ser Alura design patterns impostos, e vou criar o ISS, que também já trabalhamos com ele.

[01:26] Vamos criar o cálculo, vou chamar de CalculaImposto, acho que fica mais claro para sabermos o que estamos calculando, imposto sobre um orçamento. O ICMS, como já tínhamos definido antes, o cálculo dele é valor vezes 10%, 10% do valor total. Já o ISS, CalculaImposto sobre um orçamento e devolve um float, ele vai devolver o ISS 6%, então o orçamento valor vezes 0.06.

[02:15] Pense comigo. Primeiro, e acho que todo mundo já percebeu, eu escrevi errado, e não foi de propósito, realmente escrevi errado o nome do método. Já teríamos um problema aí. E segundo, como eu vou fazer para ao invés de receber o nome de um imposto eu receber o imposto em si, a calculadora de imposto específica? Como vou saber o tipo dele? Vou deixar só um object? Pode vir qualquer tipo, qualquer classe. Queremos que seja um imposto específico.

[02:45] Como podemos especificar que algo que uma classe qualquer é um imposto, ela assina um contrato de que vai ter um método chamado CalculaImposto? Já vimos isso nos cursos de orientação a objeto. Me parece uma interface. Vou criar uma interface chamada imposto. Ou seja, com essa interface, todo mundo que implementar ela vai precisar ter um método ‘public function CalculaImposto’ que recebe orçamento, e devolve um float.

[03:26] Agora todas as classes que forem assinar esse contrato, que forem calcular o imposto, vão precisar implementar essa interface. Posso dizer que ICMS implementa imposto. O php storm já reconheceu que o método está corretamente implementado. Se eu vier em ISS, vou dizer que ela implementa imposto. E aqui tem um erro porque não tenho o método implementado. Se eu corrigir o nome dele aqui, beleza, tudo certo.

[03:55] Consigo através de interfaces ir tendo uma IDE, isso ajuda muito. Consigo perceber se eu digitar alguma coisa errada. E também agora consigo receber um imposto. Dessa forma minha calculadora de impostos recebe um orçamento e algum imposto. Esse imposto não precisamos saber qual é. Tudo que precisamos saber é que esse imposto sabe calcular o imposto do orçamento.

[04:25] Posso remover isso tudo, e olha como nossa calculadora ficou bem mais simples. No nosso teste, repare que não posso mais passar uma string, não consigo mais passar um imposto inválido, sempre preciso passar alguma implementação de imposto. Com isso posso passar o ICMS, esse vai ser o imposto que vou utilizar. Vou clicar com o botão direito e em run. Rodou.

[04:53] Se eu rodar o ISS, tudo continua funcionando. Não consigo passar um imposto inválido e minha calculadora de impostos não vai crescer indefinidamente. Ela só faz isso, ela só chama o cálculo de algum imposto que definimos.

[05:15] Com isso matamos o problema e é um padrão de projeto muito famoso chamado strategy. Se temos algum algoritmo, alguma estratégia, algum cálculo que precisa fazer, alguma ação que precisamos fazer, e essa ação depende de algum parâmetro, podemos extrair esse parâmetro para uma nova classe, esse comportamento para uma nova classe, e ao invés de ter vários ifs para verificar o valor do parâmetro, passamos essa classe que representa essa estratégia de implementação do algoritmo, e essa estratégia vai ser executada.

[05:52] Então, ao invés de ter vários ifs para verificar qual o imposto que quero calcular, passo o imposto em si, e esse imposto sabe se calcular, ele sabe calcular o imposto baseado no orçamento. Com isso implementamos um padrão de projeto chamado strategy. Foi o primeiro padrão de projeto que implementamos e vamos continuar implementando outros durante o treinamento, mas esse foi o primeiro e se não me engano, posso estar errado, mas pelo menos no meu dia a dia é o mais comum de se implementar, é o padrão de projeto que mais utilizo, então é importante que você entenda.

[06:24] Vou deixar um exercício para saber mais, para que você possa entender toda a teoria por trás desse padrão de projeto, mas basicamente se você tem alguma ação que depende de um parâmetro, de uma informação, você extrai essa ação para uma classe e ao invés de passar uma string, um valor que representa esse parâmetro, você passa a classe em si, a implementação desse algoritmo, dessa estratégia.

@@09
Propósito do Strategy

Todos os padrões de projeto definidos pela Gang of Four (GoF) possuem uma motivação: um problema a ser resolvido.
Que tipo de problema o padrão Strategy visa resolver?

A existência de muitos métodos em uma classe
 
Alternativa correta
A existência de diversos algoritmos para uma ação, resultando na possibilidade de vários ifs
 
Alternativa correta! Este padrão pode ser utilizado quando há diversos possíveis algoritmos para uma ação (como calcular imposto, por exemplo). Nele, nós separamos cada um dos possíveis algoritmos em classes separadas.
Alternativa correta
A existência de diversas classes com código repetido

@@10
Para saber mais: Strategy

Todo padrão de projeto possui sua explicação teórica com motivação, aplicação, seus participantes, consequências, etc.
O livro Padrões de Projeto - Soluções reutilizáveis de software orientado a objetos é um catálogo para todos estes padrões, com todas as explicações necessárias.

Caso não possa (ou não queira) ler o livro, existem sites que resumem cada um dos padrões. Aqui está um que é bastante utilizado, já na página específica sobre Strategy: https://refactoring.guru/design-patterns/strategy.

@@11
Faça como eu fiz

Chegou a hora de você seguir todos os passos realizados por mim durante esta aula. Caso já tenha feito, excelente. Se ainda não, é importante que você execute o que foi visto nos vídeos para poder continuar com a próxima aula.

Continue com os seus estudos, e se houver dúvidas, não hesite em recorrer ao nosso fórum!

@@12
O que aprendemos?

Nesta aula, aprendemos que:
Padrões de projeto são soluções genéricas para problemas recorrentes do desenvolvimento de software
Existem três principais categorias de padrões de projeto
Comportamentais (que serão vistos neste treinamento)
Estruturais
Criacionais
Como diminuir a complexidade do nosso código, trocando múltiplas condicionais por classes
Esta técnica é chamada de Strategy, que é um dos padrões de projeto

#### 13/02/2024

@02-Chain of Responsibility

@@01
Projeto da aula anterior

Caso queira, você pode baixar aqui o projeto do curso no ponto em que paramos na aula anterior.

@@02
Criando a calculadora de descontos

[00:00] Bem-vindos de volta a mais um capítulo desse treinamento de padrões de projeto, onde estamos utilizando o php para aprender. Já temos uma calculadora de impostos, já aprendemos o padrão de projetos strategy. Agora vamos criar uma calculadora de descontos.
[00:16] Vou criar uma nova classe CalculadoraDeDescontos. Temos nossa calculadora. O que ela faz? calculaDescontos para algum orçamento e devolve esse valor dos descontos.

[00:35] Já temos nosso método definido. Só que como ela calcula esse desconto? Tem uma regra na nossa loja que diz que se um orçamento tiver mais de cinco itens, ou seja, mais de cinco produtos naquele orçamento, o cliente ganha 10% de desconto. Só que hoje nosso orçamento não tem a quantidade de itens, então vamos adicionar, ‘public int $quantidadeItens’.

[01:00] Agora temos a quantidade de itens. Nossa calculadora de desconto vai verificar, ‘if $orcamento->quantidadedeItens > 5’, ela vai devolver ‘return $orcamento->valor * 0.1’. Ou seja, 10% do valor do orçamento.

[01:22] Agora, se não tiver mais do que cinco, se tiver cinco itens ou menos, não tem desconto. Aqui já temos uma implementação da calculadora de descontos, vamos fazer nossos testes. Vou comentar tudo que temos, só para o arquivo ter uma espécie de histórico, e vamos criar uma $calculadora = new \Alura\DesignPattern\CalculadoraDe Descontos’.

[01:50] Nossa calculadora vai calcular os descontos para algum orçamento, só que qual é esse orçamento? Vamos criar. Tenho ‘$orcamento = new Orçamento()’, e esse orçamento vai ter o valor de 200 reais, e esse orçamento tem sete itens. vamos ter um desconto de 10%. Se eu exibir isso, meu programa tem que exibir 20, 10% de 200.

[02:22] Vamos executar. Perfeito. Agora, se eu mudar a quantidade de itens de sete para cinco, o desconto tem que ser zero, porque se não tenho mais de cinco itens não tenho desconto. Vou executar, e zero. Tudo funcionando perfeito. Só que obviamente as coisas mudam. A única constante no mundo da computação é a mudança.

[02:45] Então, surgiu uma requisição de uma nova feature, uma nova implementação, um pedido, para que implementemos uma nova regra de desconto. Vamos discutir essa nova regra no próximo vídeo.

@@04
Muitos ifs

Em diversas ocasiões, o instrutor cita que ter diversos ifs pode ser um problema, e que ter uma classe que "pode crescer para sempre" também é um problema.
Qual o problema real deste cenário, onde uma classe tem muitos ifs ou pode crescer para sempre?

Vários ifs deixam o código lento, podendo consumir mais recursos do que é necessário e quebrar toda a minha aplicação por isso
 
Alternativa errada! O simples fato de ter vários ifs não deixa uma aplicação lenta.
Alternativa correta
Se uma classe pode crescer para sempre, ela vai acabar ocupando muito espaço no meu HD e quebrar toda a minha aplicação por isso
 
Alternativa correta
Se eu precisar editar um pedaço de código, para implementar uma nova funcionalidade, as chances de quebrar funcionalidades existentes é grande
 
Alternativa correta! Sempre que uma nova funcionalidade dever ser implementada, o ideal é que possamos criar código novo e editar o mínimo possível de código já existente. Este é um dos principais pontos do princípio Aberto-Fechado (Open-Closed Principle) do SOLID. Ao editar código existente, podemos acabar quebrando funcionalidades já implementadas e funcionais.

@@05
Strategy resolve

[00:00] Bem-vindos de volta. Quis fazer esse vídeo separado para batermos um papo, conversarmos sobre como resolver esse problema. E já conhecemos uma solução para remover vários ifs de algum método, que é o padrão strategy, mas pense nesse processo, em como isso está sendo feito, e veja se conseguimos aplicar o strategy.
[00:20] Vou fechar esse monte de coisa. Repare que na calculadora de impostos, eu recebo, a calculadora já sabe qual imposto ela precisa calcular. Ela recebe como parâmetro uma informação e a partir dessa informação ela faz o cálculo em outro parâmetro.

[00:40] Agora, nossa calculadora de descontos precisa a partir do orçamento, a partir do único valor que ela recebe, decidir qual o desconto aplicado. Se fôssemos aplicar o padrão strategy, eu teria que receber, por exemplo, um desconto, e ao invés de fazer isso tudo simplesmente retornaria desconto, calculaDesconto do orçamento.

[01:05] Só que para eu poder passar o desconto para essa calculadora eu teria que fazer esse monte de if, porque teria que verificar o valor do orçamento e a quantidade de itens no orçamento. Ou seja, estaria tirando dessa classe esse monte de if, mas ia ter que colocar em algum outro lugar. Talvez no nosso arquivo de testes. Em algum lugar precisaria colocar esse monte de if.

[01:26] Por isso o padrão strategy não resolve esse problema, porque ele depende de que a classe que vai utilizar saiba qual a estratégia a ser implementada. Quando calculei o imposto eu sabia qual era a estratégia de cálculo de imposto, porque eu sabia qual imposto queria calcular.

[01:44] No caso de descontos, não conheço a estratégia do cálculo. A estratégia do cálculo, a responsabilidade de calcular o desconto, precisa ser passada e calculada, decidida, durante a execução da calculadora de descontos.

[02:00] Precisamos chegar de alguma forma numa solução que aplique toda essa cadeia de descontos pensando que primeiro tenta aplicar esse desconto, mas esse desconto não se aplica essa regra, então vê se se aplica a essa regra aqui. Não se aplica, então aplica desconto nenhum.

[02:15] Precisamos criar essa cadeia de descontos de alguma outra forma, de uma forma que eu chame uma vez só, só que tenha todos os descontos já ligados um ao outro. Existem todos esses descontos aqui, calculadora, alguém tem que descobrir qual desconto vai ser aplicado.

[02:38] Parece complexo, mas vamos ver no próximo vídeo que não é tão difícil assim de implementar.

@@06
Criando a Chain of Responsibility

[00:00] Sejam bem-vindos de volta. Vamos agora neste vídeo implementar uma solução para este problema que estamos tendo. Pensando numa solução parecida com a de impostos, já que o problema é parecido, podemos criar uma classe para cada uma das regras de desconto e vamos partir dessa solução.
[00:20] Vou criar uma nova classe para desconto, DescontoMaisDe5Itens, vai estar na pasta descontos, vou criar essa pasta. Criei a classe. Ela vai calcular o desconto, então ‘public function calculaDesconto(Orcamento $orcamento): float’. Só que existe aquela condição, ‘if ($orcamento->quantidadeItens > 5), ela calcula ‘return $orcamento>valor * 0.1’.

[01:00] Agora, se não, o que ela vai fazer? Por enquanto é retornar zero, ou seja, sem desconto nenhum. Vamos fazer a mesma coisa para desconto por mais de 500 reais, DescontoMaisDe500Reais. Vou copiar esse método e colar aqui, para alterarmos o que precisamos alterar.

[01:26] Se o valor for maior do que 500, digo que o desconto é de 5%. Criamos nossas duas classes e podemos verificar de outra forma agora. Primeiro tento aplicar desconto5Itens, DescontoMaisDe5Itens. E aí calculo o desconto desse orçamento utilizando esse desconto.

[02:03] Agora, se o desconto for zero, ou seja, se o desconto for de zero, ou seja, ele não aplicou, vamos tentar aplicar um desconto de orçamento acima de 500 reais. Vou criar um novo desconto e vou tentar aplicar esse desconto aqui.

[02:28] Agora, se continuar sendo zero, retorno um novo desconto, mas que no nosso caso é zero mesmo. Tenho o valor do desconto. Se for zero ele tenta aplicar o desconto iniciando, tem um desconto acima de cinco itens. Calculo esse desconto. Se for zero, ou seja, não teve desconto para esse orçamento, então tento aplicar um desconto daquela regra de mais de 500 reais.

[03:02] Agora começamos a resolver, já está um pouco melhor, na minha opinião, só que e se eu tiver um novo desconto. Ou seja, o desconto continua sendo de zero reais, preciso criar uma nova classe, crio a nova classe, calculo desconto, verifico se é zero. Depois a próxima classe. E vou fazendo isso.

[03:28] Essa nossa classe calculadora de descontos vai continuar crescendo infinitamente. Sempre que eu tiver uma nova regra de desconto vou ter que modificar. Ainda não está boa essa implementação.

[03:40] Vamos pensar de outra forma então. No nosso desconto de cinco itens, o que quero fazer na verdade não é retornar zero. Tenho minha regra de calcular desconto. Se essa condição não for atendida, ou seja, se não posso aplicar esse desconto, tenta aplicar o próximo desconto dessa cadeia de descontos que comentamos, e aí ele vai tentar chamar esse desconto de mais de 500 reais. Se ele não atingir essa regra, se não puder calcular, ele chama o próximo desconto.

[04:20] Com isso já começamos a pensar numa regra. Vamos criar essa regra. Vou ter uma classe base que vai representar todos os descontos, e essa classe que vai representar todos os descontos vai receber um desconto para ser o próximo e vai verificar. Atinge a condição? Se sim, calculo o desconto, senão tento o próximo.

[04:45] Vou criar uma nova classe chamada Desconto. Só que ela vai ser uma classe abstrata, ou seja, não posso criar um desconto qualquer, preciso criar um dos descontos que vão estender essa classe de desconto.

[05:05] Vamos pensar, vamos criar a regra geral de qualquer desconto. Primeiro, qualquer desconto precisa calcular o desconto. Tenho o calculaDesconto, que recebe um orçamento e devolve o valor desse desconto. Tenho a regra que todo desconto precisa ter.

[05:28] Só que todo desconto agora vai receber o próximo desconto da cadeia. Criei um desconto de mais de cinco itens, qual o próximo da cadeia? Vamos criar um construtor, que recebe um desconto, que vai ser o próximo desconto. Vou inicializar isso. Criei o próximo desconto.

[05:50] Agora o cálculo vai funcionar assim. O calculaDesconto atinge alguma característica, alguma condição? Se sim, ele vai fazer o cálculo. Senão vai chamar o próximo desconto. Como podemos fazer isso? Vou vir no mais de cinco itens e quantidadeItens é maior do que cinco? Então calculo o desconto. Senão vou no próximo desconto. Lembre que se está privado nossas classes filhas não conseguem acessar, está protegido.

[06:32] O nosso próximo desconto vai tentar calcular esse desconto do orçamento. Qual o próximo desconto? No nosso caso vai ser o de 500 reais. E aqui sempre podemos ter um próximo. Ele tem que estender de um desconto. Vou pegar o próximo desconto e vou calcular o desconto desse orçamento.

[06:55] Aqui temos uma cadeia. Repare que sempre que eu criar um novo desconto ele vai herdar de desconto e verifica se atinge alguma condição, calcula, mas se não atingir essa condição ele tenta o próximo desconto dessa cadeia. Então nossa calculadora de descontos agora que coloquei o extends errado, não era para estar aqui, vai criar uma cadeia de descontos, que vai ser primeiro tentar executar esse desconto de mais de cinco itens. Só que se esse desconto de mais de cinco itens não funcionar, se não atingir as condições dele, vai tentar o desconto de mais de 500 reais.

[07:48] Só que agora temos um problema. Já temos uma cadeia de descontos, então eu conseguiria aplicar nessa cadeia de descontos o cálculo de descontos, só que qual o próximo desconto para o desconto para mais de 500 reais? Porque neste momento só temos dois, e mesmo se tivéssemos três regras, quatro regras, cinco regras, em algum momento elas acabam, não são regras infinitas.

[08:10] Aqui o que faríamos? Passaríamos null, alguma coisa assim? Podemos criar uma regra sem desconto. Posso criar um novo tipo de desconto que vai informar que não tem desconto, que é o final dessa cadeia. Se nenhuma das regras se aplicar, não tenho desconto nenhum.

[08:30] Vamos implementar. Independente do valor do orçamento, essa regra retorna zero. Agora nossa calculadora de descontos pode criar o SemDesconto. Esse SemDesconto, para conseguir respeitar a regra do desconto vai sobrescrever o construtor. Ele sobrescreve construtor e não recebe nada.

[09:02] Agora nosso construtor não recebe nada, só que se você reparar ele está informando um erro, porque precisa chamar o construtor do pai, certo? O construtor da classe base. Como fazemos nesse caso? Chamo o construtor passando o quê? Vou fazer com que o construtor da classe base possa receber um desconto ou nulo. Vou passar nulo.

[09:30] Agora, caso não tenha um próximo desconto, ele não vai fazer nada. Só que não tem regra para chamar próximo desconto, então isso não vai dar erro. O que precisamos fazer agora? Já passamos o SemDesconto, ele não recebe nada no construtor. Perfeito, tudo funcionando. Vamos testar.

[09:52] Vamos no nosso arquivo de testes garantir que tudo continua funcionando, que não quebramos nada, porque editei bastante código. Tem um errinho, os próximos descontos na minha classe desconto precisam ser do mesmo tipo, ou seja, pode ser nulo.

[10:12] Voltando para os testes, aparentemente tudo certo. Se eu mudar a quantidade de itens para só cinco, o desconto vai mudar para 30%, e beleza. Implementamos um padrão. No próximo vídeo vou explicar um pouco melhor sobre esse padrão, porque esse vídeo ficou longo, ficou um pouco maçante, vou explicar a lógica por trás dele para entendermos melhor o que fizemos aqui.

@@07
Explicando o padrão

[00:00] Bem-vindos de volta. Vamos recapitular, vamos ver o que fizemos, aquela bagunça que fizemos no último vídeo, entender tudo que aconteceu. Nossa calculadora de descontos agora faz o quê? Ela tenta executar, fazer o cálculo para o desconto onde tem mais de cinco itens no nosso orçamento. Se por algum motivo não funcionar o próximo desconto é o que tem mais de 500 reais no orçamento. Ou se nenhum desses for aplicado, sem desconto, ou seja, esse orçamento não vai receber desconto nenhum.
[00:30] Dessa cadeia de descontos que a calculadora montou ela tenta calcular o desconto para esse orçamento. O que fizemos, essa cadeia, você pode imaginar como quando você liga para um atendimento de telemarketing, algum atendimento quando você precisa de suporte.

[00:45] Sua internet parou de funcionar. Você liga. O primeiro item da cadeia é um robozinho falando “pressione 1 se você precisa de atendimento técnico”. Esse robozinho não vai conseguir resolver seu problema, então ele passa para o próximo elo dessa cadeia, dessa corrente.

[01:03] Nesse próximo elo vai ter um atendente que não tem tanto conhecimento de redes, esse tipo de coisa, mas vai falar “tenta reiniciar seu roteador, vou reiniciar o sistema”. Se isso não funcionar, se ele não conseguir resolver seu problema, ele passa para o próximo elo dessa cadeia, dessa corrente, e uma pessoa mais técnica vai falar que talvez você precise atualizar o sistema do seu modem, talvez um técnico precise ir para sua casa.

[01:32] Existe uma cadeia de responsabilidades até chegar em alguém que consiga resolver seu problema. E foi exatamente isso que implementamos aqui. Cadeia de responsabilidades, chain of responsibility é exatamente o nome desse padrão que implementamos. Definimos uma cadeia, uma corrente de responsabilidades, onde tento aplicar uma regra. Caso não consiga por algum motivo, não atenda aos requisitos, ou não funcione essa regra, tento aplicar a próxima, e tento aplicar a próxima, até que alguém consiga atender esse pedido.

[02:02] Como implementamos isso? Existe mais de uma forma de implementar, como qualquer outro padrão. Como eu, Vinicius, escolhi implementar? Criei uma classe base de desconto, que vai representar o início dessa cadeia. E todas as classes que implementarem, que estenderem essa classe abstrata, vão ter um construtor que precisa passar o próximo desconto.

[02:28] Ou seja, sempre vai ter um próximo. Isso criou um problema que quando queremos encerrar a cadeia, como por exemplo não passando desconto nenhum, precisei criar uma nova classe, que passasse como nulo o próximo desconto.

[02:41] Existem outras formas de implementar, como por exemplo, ao invés de passar um construtor, ter um setProximo, ou defineProximoDesconto, e aí ao invés de passar no construtor criaria cada um dos descontos e chamaria o método defineProximoDesconto.

[03:00] Existe mais de uma forma. Optei por implementar assim. Mas deixo o desafio para que você implemente sem utilizar o construtor, mas utilizando setProximo, e caso não tenha um próximo desconto, você precisa verificar, por exemplo, se o próximo desconto não existir retorna zero, algo desse tipo.

[03:20] Mais uma vez. O que implementamos foi uma cadeia de responsabilidades onde alguém dessa cadeia vai precisar resolver nosso problema de aplicar desconto. Inclusive, isso pode ser até a regra de que não aplica desconto nenhum. Existe essa forma de implementar, onde definimos explicitamente o final de cadeia. Existe uma forma onde não passaria pelo construtor, definiria por um método, e se não quero ter um próximo só não chamo esse método. Tem várias formas de implementar, mas o conceito é basicamente esse.

[03:50] Muito parecido com o telemarketing, ou uma linha de produção. Você recebe um item que você quer montar, só que esse item já passou pela parte que você faz, então você entrega para a próxima pessoa montar. E assim funciona uma linha de produção também. Esse é o padrão chain of responsibility.

[04:06] Existem vários outros padrões, inclusive no próximo capítulo vamos implementar uma nova funcionalidade de impostos um pouco mais complexos, e o padrão que vamos aprender poderia até nos ajudar aqui. Mas vamos conversar sobre isso no próximo capítulo.

@@08
Para saber mais: Chain of Responsibility

Assim como qualquer outro conceito em computação, existe mais de uma forma de implementar o padrão de projeto Chain of Responsibility.
Para saber mais sobre a parte teórica deste padrão, e analisar diferentes implementações, você pode conferir este link: https://refactoring.guru/design-patterns/chain-of-responsibility.

[Title](https://refactoring.guru/design-patterns/chain-of-responsibility)

@@09
Faça como eu fiz

Chegou a hora de você seguir todos os passos realizados por mim durante esta aula. Caso já tenha feito, excelente. Se ainda não, é importante que você execute o que foi visto nos vídeos para poder continuar com a próxima aula.

Continue com os seus estudos, e se houver dúvidas, não hesite em recorrer ao nosso fórum!

@@10
O que aprendemos?

Nesta aula, aprendemos:
A diferenciar casos onde padrões semelhantes podem ser aplicados
Como criar uma cadeia de possíveis algoritmos como Chain of Responsibility
A utilizar o padrão para aplicar um desconto dentro de uma cadeia de possíveis descontos