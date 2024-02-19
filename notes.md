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

##### 14/02/2024

@03-Template Method

@@01
Projeto da aula anterior

Caso queira, você pode baixar aqui o projeto do curso no ponto em que paramos na aula anterior.

[Title](https://caelum-online-public.s3.amazonaws.com/1668-php-design-pattern-comportamental/02/php-design-pattern-projeto-completo-aula-2.zip)

@@02
Cálculos condicionais de impostos

[00:00] Sejam muito bem-vindos de volta a mais um capítulo deste treinamento de padrões de projeto utilizando php. Já aprendemos bastante coisa, aprendemos sobre o padrão strategy, o padrão chain of responsibility, e agora vamos falar sobre outro padrão. Só que antes preciso criar novos impostos. Chegou a demanda, porque nossa calculadora precisa ser capaz de entender dois novos impostos. E eu não conheço mais nenhum imposto de cabeça, então vou passar a criar nomes de impostos, espero que você não se importe.
[00:35] Vou criar o ICPP. O ICPP é um pouco mais complexo que os outros, porque ele tem duas alíquotas. Se o produto for mais caro do que 500 reais, ele incide sobre 3% do valor do orçamento, se for 500 reais ou menos são 2%. Acabei de criar essa regra, mas finge que chegou junto com a demanda.

[01:03] Se é um novo imposto, ele precisa implementar a interface de imposto. Se precisa implementar essa interface precisa ter o método CalculaImposto. Até aqui nada novo. Vamos criar nossa regra, ‘if ($orcamento->valor > 500)’, e já esqueci qual foi a regra que falei especificamente, então se for acima de 500 reais vai ser de 3%. Então, orçamento valor vezes 0.03. Só 3% de imposto.

[01:33] Agora, se for 500 reais ou menos 2% de imposto. Orçamento valor 0.02. Se passar de um limite aplica a alíquota máxima de imposto. Senão aplica a alíquota mínima. Agora precisamos implementar o segundo imposto, que é o IKCV, ótimo nome de imposto, parece um imposto da Ucrânia.

[02:03] Vamos implementar esse imposto. Mesma regra, só que ele tem algumas regras diferentes. É bem parecido. Se o valor total do orçamento for maior do que 300 reais e se esse orçamento tiver mais do que três itens, ele aplica a alíquota máxima, que é de 4%. Caso contrário aplica alíquota mínima, que é de 2,5%.

[02:50] Aqui temos duas novas regras, dois novos impostos com regras diferentes. Verificamos uma condição. Se eu preciso aplicar alíquota máxima ele aplica a alíquota máxima desse imposto, senão aplica a alíquota mínima. Temos duas alíquotas nesses impostos, e repare que até trocando de tela parece muito, é muito semelhante um com o outro. Temos uma lógica parecida, um modelo, um template de algoritmo muito semelhante, só que esse código está duplicado.

[03:28] No nosso caso tem um template pequeno, mas para várias classes esse exemplo pode ficar um pouco mais chato, se essa condição acabar ficando maior vamos ter que alterar o código e alterar coisas maiores. Enfim, duplicar código nunca é legal, então como será que podemos resolver isso? Vamos pensar no próximo vídeo uma forma de começar a refatorar.

@@03
Problema atual

No último vídeo, criamos dois novos impostos, que possuem regras muito semelhantes: há duas alíquotas possíveis para cada um.
Qual o problema com o código até este ponto?

O algoritmo para o cálculo de impostos deste tipo está duplicado
 
Alternativa correta! A verificação por uma alíquota máxima e o retorno condicional da alíquota está duplicada em duas classes. Mesmo em um exemplo pequeno, como este, duplicação nunca é legal. Mas imagine um algoritmo grande. O ideal é sempre extrair códigos duplicados.
Alternativa correta
Os cálculos de impostos estão muito complexos
 
Alternativa correta
Um imposto não pode ter mais de uma alíquota

@@04
Extraindo a lógica para métodos privados

[00:00] Sejam muito bem-vindos de volta, e vamos começar a refatorar esse código nesse vídeo. Existem algumas partes desse algoritmo para serem executadas. Primeiro é verificar se deve aplicar a taxação máxima. Caso sim, calcular a taxação máxima, ou caso contrário calcular a taxação mínima. Vamos criar essas partes que são específicas de cada um dos impostos em métodos privados.
[00:35] Eu vou selecionar isso. Como estou utilizando php storm vou utilizar uma função dele que é só apertar "Ctrl + Alt + M”. Ou vou em extrair para método. O que vamos verificar é que deve aplicar taxa máxima. Estamos vendo se ele deve aplicar a taxa máxima ou não.

[01:08] Refatorei, e agora ele está verificando se deve aplicar a taxa máxima, se sim ele está aplicando a taxa máxima. Então vamos extrair isso também. Vou clicar com botão direito, refatorar, extrair para um método. Aqui é calculaTaxaMaxima, ele está realizando o cálculo. Caso contrário vai calcular a taxa mínima. Refatorar, extrair para um método, calculaTaxaMinima.

[01:53] Se você não estiver usando php storm é só criar um novo método e passar o conteúdo dele para lá. Repare que esse pedaço é comum tanto para o ICPP quanto para o IKCV. Temos um cálculo de imposto que verifica se deve aplicar a taxação máxima, se sim calcula essa taxa máxima, senão calcula a taxa mínima.

[02:20] Com isso criamos uma forma de pegar tudo que é incomum dentre esses impostos, que tem duas alíquotas de taxação e extraímos o que é específico. Primeiro, podemos simplesmente copiar isso para o ICPP e implementar as partes específicas mudando os números, só que vou ter tudo isso repetido nas duas classes? Não faz sentido.

[02:47] Então, o que vou fazer é extrair, e aí não sei se o php storm me ajuda com isso, para uma nova classe. Vou criar uma nova classe, que vai ser impostoCom2Aliquotas.

[03:06] Todos os impostos que eu vier a criar que tem duas alíquotas vão seguir esse mesmo molde, só que isso obviamente é uma classe abstrata, porque não posso simplesmente criar um imposto com duas alíquotas sem ser um imposto específico, mas ele vai ter essa implementação do cálculo do imposto. E aí obviamente precisa implementar a interface de imposto.

[03:33] Só que além de implementar essa interface, ele precisa ter esses três métodos, então vou criar como métodos abstratos, ‘abstract public function deveAplicarTaxaMacima(Orcamento $orcamento): bool”. Vou copiar, “Ctrl + D” para duplicar a linha, vou copiar esses métodos, esses dois retornam, “Alt + J” para selecionar mais de um item, float.

[04:06] Agora repara que tenho todo o template para um novo imposto que tenha duas alíquotas. Então tudo que nossos impostos vão precisar agora é implementar a parte específica. A regra, se deve aplicar taxa máxima ou não, e o cálculo de cada uma das regras. Agora não preciso mais criar todo o algoritmo em cada uma das classes, porque pode ser muito tranquilo vir aqui e esquecer um return, cometer esse tipo de bobeira que às vezes leva tempo para encontrarmos.

[04:35] Então sempre que pudermos evitar duplicação repetição de código, é muito importante, é o ideal. Vamos aplicar isso. Vou estender o imposto com duas alíquotas, e não preciso implementar isso mais, só os métodos específicos.

[04:52] Aqui o que acontece? Esses métodos estão sendo definidos como públicos, então obviamente não podemos defini-los como privados. Eu poderia colocar protected, que prefiro colocar para todos.

[05:10] Agora tenho todas as regras específicas implementadas na minha classe, e o que é genérico para qualquer imposto com duas alíquotas está numa classe separada. Vou no ICPP fazer a mesma coisa. Preciso implementar três métodos. O deveAplicarTaxaMaxima é essa parte ‘return $orcamento ->valor > 500’, se o orçamento for maior do que 500 reais ele deve aplicar. E a taxa máxima é de 3%, enquanto a mínima é de 2%. Repare que só implementei as partes específicas e o genérico posso apagar.

[06:00] Recapitulando, tenho agora um template de um método, para um imposto com duas alíquotas que vai chamar só as partes específicas, que só precisa que sejam implementadas nas classes específicas as regras específicas. E esse padrão de extrair classes com template de um algoritmo, e esse algoritmo se chamar métodos específicos na classe filha é chamado de template method. Esse padrão é muito comum, muito importante e muito prática para que evitemos duplicação de código, uma duplicação de um algoritmo que seja utilizado em várias classes.

[06:35] Aqui vimos um exemplo claro e no próximo vídeo vamos discutir sobre como poderíamos ter utilizado no nosso último capítulo sobre desconto com a cadeia de responsabilidade.

@@05
Modificadores de acesso

Durante a aplicação do padrão Template Method, foi utilizado o modificador de acesso protected para os métodos que seriam sobrescritos pelas classes específicas.
Por que não utilizar public ou private?

Não utilizamos public, pois assim os métodos não seriam acessíveis pelas classes filhas e não usamos private porque deixaria os métodos disponíveis para todos acessarem, o que quebraria o encapsulamento das regras
 
Alternativa correta
Não utilizamos private, pois assim os métodos não seriam acessíveis pelas classes filhas e não usamos public porque deixaria os métodos disponíveis para todos acessarem, o que quebraria o encapsulamento das regras
 
Alternativa correta! Se nós utilizássemos private, nenhuma das classes filhas iriam implementar o método da classe base. Não existem métodos abstratos privados. Já se deixássemos como public, os métodos que deveriam ser apenas utilizados dentro da classe estariam acessíveis de qualquer lugar, fornecendo um acesso desnecessário às regras do sistema.
Alternativa correta
Não faria nenhuma diferença entre usar public e protected, já private geraria um erro

@@06
Falando sobre o padrão

[00:00] Bem-vindos de volta. Vamos falar um pouco sobre o template method, que esse padrão de projetos que acabamos de aprender, que é bem importante. Poderíamos facilmente ter aplicado aqui de várias formas, como por exemplo se eu criasse um método calcula, que vai ser o template do nosso algoritmo, recebendo orçamento, e ele poderia verificar se o calculaDesconto desse orçamento retornou zero, então vou chamar o próximo desconto, esse próximo desconto calcula o orçamento, senão ele retornaria o valor desse cálculo. Algo do tipo. Se for zero, senão retorna ele.
[00:55] Essa é uma implementação que daria para melhorar, mas é um exemplo rápido de como poderíamos fazer isso. Aí em nossos descontos eu chamaria o método calcula, esse método tentaria realizar o método calculaDesconto que cada um dos descontos implementou, e se ele devolvesse zero eu ia dizer para tentar no próximo desconto. Teríamos uma espécie de mistura do template method com o chain of responsibility. Seria bem interessante, mas vou tirar porque não precisamos disso agora. E vamos falar sobre o template method.

[01:30] Uma analogia com o mundo real, sem pensar em código, o template method seria como fazemos para construir uma casa, por exemplo. Para construir uma casa, acredite ou não eu sei como constrói uma casa, existe todo um passo a passo que você precisa seguir. Você precisa fazer fundação da casa, levantar as paredes, esse tipo de coisa. Todo o processo que você precisa fazer. Só que cada casa é uma casa. Você precisa implementar as partes específicas.

[02:00] Por exemplo, no passo de pintar a parede cada pessoa vai pintar a parede de um jeito. No passo de construir a sala, a arquitetura da sala de cada pessoa vai ser de um jeito. Existe um template, um modelo padrão, e você implementa as partes específicas nas classes filhas, esse modelo padrão fica numa classe base, normalmente abstrata.

[02:16] Um exemplo que também poderíamos tentar dar já pensando em código seria se eu tivesse um blog e quero cada vez que publicar nesse blog também publicar numa página das redes sociais. Então para publicar numa rede social sei que preciso receber as credenciais, tentar fazer login. Caso não consiga fazer login gera um erro, um log na aplicação. Caso consiga fazer login, envia o dado desse post e depois faz logout.

[02:44] Então, eu criaria uma classe base com todo esse template, todo esse modelo genérico, e poderia criar classes específicas, para por exemplo, Facebook, Twitter, Instagram. Você poderia criar classes específicas para cada uma das redes sociais. Esse é o conceito do template method. Você tem um algoritmo, o template desse algoritmo, a base desse algoritmo, implementado numa classe base, mas nas classes filhas, nas classes que vão estender a classe base você implementa as partes específicas. Isso é o template method e é um padrão muito utilizado, bastante importante, bastante poderoso.

[03:25] Agora vamos voltar a falar sobre nosso orçamento, que ainda está muito pobre. Ainda vamos adicionar mais regras sobre ele, ele vai ter estados, e vamos conversar bastante sobre isso no próximo capítulo.

@@07
Para saber mais: Template Method

As aplicações do padrão Template Method no mundo PHP são muitas, mas além de entender a parte prática, é muito importante ler sobre a teoria por trás do padrão.
Para entendê-lo melhor, você pode conferir este link: https://refactoring.guru/design-patterns/template-method.

@@08
Faça como eu fiz

Chegou a hora de você seguir todos os passos realizados por mim durante esta aula. Caso já tenha feito, excelente. Se ainda não, é importante que você execute o que foi visto nos vídeos para poder continuar com a próxima aula.

Continue com os seus estudos, e se houver dúvidas, não hesite em recorrer ao nosso fórum!

@@09
O que aprendemos?

Nesta aula:
Reforçamos a ideia de que repetição de código é problemática
Criamos um template de algoritmo que estava sendo replicado em mais de uma classe e utilizamos herança para reaproveitar esse código
Aprendemos que a esta técnica foi dado o nome de Template Method
Vimos que é possível aplicar mais de um padrão no mesmo código

#### 15/02/2024

@04-Command

@@01
Projeto da aula anterior

Caso queira, você pode baixar aqui o projeto do curso no ponto em que paramos na aula anterior.

[Title](https://caelum-online-public.s3.amazonaws.com/1668-php-design-pattern-comportamental/04/php-design-pattern-projeto-completo-aula-4.zip)

@@02
Gerando um pedido

[00:00] Bem-vindos de volta a mais um capítulo deste treinamento de padrões de projeto utilizando php. Agora surgiu uma nova demanda, bem simples, na verdade. Quando um orçamento passar para o status de aprovado, vamos ter que gerar um pedido. Normalmente, em um sistema real, nessa tarefa de gerar pedido receberíamos um id desse orçamento, pegaríamos os dados do orçamento, criaríamos esse pedido e com ele realizaríamos as tarefas necessárias.
[00:32] No nosso caso, como não estamos utilizando banco de dados e esse tipo de coisa, vamos fazer um pouco diferente, mas a lógica vai ser de gerar pedido. Antes de fazer a lógica precisamos criar uma classe de pedido. Vamos botar a mão na massa, criar uma nova classe chamada Pedido, ela vai ter um cliente, obviamente. Só vou salvar o nome do cliente, um dateTime finalização, que vai ser um DateTimeInterface, e o orçamento em si.

[01:15] Repare que como o php 7.4 foi lançado há pouco tempo, o php storm ainda não completa para nós quando estamos colocando tipo, isso é normal, nas próximas versões provavelmente vai ser otimizado.

[01:35] Tenho uma classe de pedidos super simples. O que vou fazer agora é criar um comando da linha de comando que eu possa através do terminal gerar um novo pedido. Vou criar um novo arquivo chamado gera-pedido. Aqui o que vou fazer é, caso você não tenha feito nenhum dos treinamentos onde expliquei isso preste atenção que vai ser bem tranquilo.

[01:55] Existe uma variável chamada argv do php que é preenchida automaticamente quando chamamos o php pela linha de comando. Ela contém todos os argumentos passados para o script. Vou acessar esse link.

[02:14] Nesse array todos os valores que passarmos pela linha de comando vão chegar nela, sendo que o valor zero desenho array é o nome do script em si. Todos a partir do um são os parâmetros passados.

[02:30] Eu vou pegar o valor do orçamento, que vai ser o primeiro parâmetro, argv1. Vou pegar o número de itens para o orçamento também, vai ser argv2, e o nome do cliente vai ser argv3. Peguei esses três dados, vou criar um orçamento, importo isso. Inclusive já vou importar nosso pedido também. O orçamento vai ter como quantidade de itens o número de itens, o orçamento vai ter como valor o valor orçamento, e agora vou criar um pedido. Esse pedido tem como data de finalização hoje, igual new DateTime, ou seja, hoje. Essa é a data de finalização do pedido.

[03:35] O pedido tem como cliente o NomeCliente que pegamos. E o pedido tem como orçamento esse orçamento do pedido. Pronto. A partir do momento em que pegamos o pedido, fazemos o que precisamos fazer, como por exemplo, cria pedido no banco de dados, não vamos implementar isso agora, até porque já temos cursos de banco de dados aqui, envia e-mail para cliente, e realiza qualquer outra ação que precise realizar. Mas basicamente esse é o comando que vamos executar para gerar um pedido.

[04:26] Vou partir para o terminal, vou chamar php gera-pedido e vou passar todos os parâmetros. O valor desse orçamento vai ser de 1.200,50 reais, o número de itens é de sete, e o nome do cliente é Vinicius Dias.

[04:48] Teve um erro. Esqueci do autoloader, um pequeno detalhe muito importante. Agora sim, vamos executar de novo. Cria pedido no banco de dados, envia e-mail para o cliente, aparentemente tudo certo. Criamos um comando que pega vários dados e faz o que ele tem que fazer, regra de negócio. Pega o orçamento, cria um novo pedido utilizando esse orçamento, salva no banco, manda e-mail. Uma rotina normal, algo que um comando normalmente faz.

[05:22] Só que agora eu te pergunto, e se eu precisar criar essa mesma ação em uma página na web? Se além de conseguir fazer isso pela linha de comando que vai estar na tarefa agendada do meu servidor, por exemplo, se eu quiser fazer isso por uma página da web? E se além de fazer isso por uma página da web eu também quisesse por isso numa API? Ou seja, em outra URL, outra forma. Será que preciso ficar copiando esse código?

[05:48] Eu sei que na web os dados vão vir do formulário, não vão vir da linha de comando. Eu sei que numa API os dados vão vir em JSON e algo do tipo. Só que toda essa parte é igual. Então será que teria que ficar copiando e colando só passando essas partes por parâmetro? Não faz muito sentido ficar repetindo código. No próximo vídeo vamos conversar sobre como poderíamos separar isso em uma classe separada, um arquivo separado, alguma coisa.

@@03
Problemas com a abordagem

O código criado até aqui é muito comumente encontrado em sistemas reais. A diferença é que, ao invés de estar em um arquivo rodado na CLI, está em algum Controller ou algo do tipo.
Qual o problema de ter um código arquitetado assim, recebendo os dados e executando todas as tarefas no mesmo local?

O código utiliza variáveis globais $argv, o que pode ser um grande problema
 
Alternativa errada! $argv é uma variável especial do PHP e pode ser lida sem problemas relacionados a boas práticas.
Alternativa correta
Se fosse necessário executar o mesmo fluxo de outro lugar (web, API, filas), o código precisaria ser duplicado
 
Alternativa correta! Da forma como o código foi organizado, se precisássemos, além de executar a geração de pedido através da CLI, também executar através de um formulário web, uma API, mensagens de uma fila, precisaríamos duplicar todo este código em vários lugares.
Alternativa correta
Temos um código feio por estar sendo executado na linha de comando
 
Alternativa errada! A pergunta é sobre como o código é arquitetado, independente de onde ele estiver sendo executado.

@@04
Criando um Command

[00:00] Bem-vindos de volta. Já vimos o problema com essa abordagem. Aqui temos um código muito simples, mas mesmo assim é um código bem próximo da realidade. É muito comum criarmos objetos e salvarmos esse objeto no banco, enviar algum dado por e-mail. É muito comum esse tipo de tarefa. E também é muito comum precisarmos expor a mesma tarefa para vários mecanismos de entrega. Para linha de comando, como fizemos, para web, através de um formulário, para uma API, para uma fila, para diversos mecanismos de entrega.
[00:32] Então não é interessante executar a lógica direto no mecanismo de entrega, ou seja, em um comando da linha de comando, em um controller de uma página da web, um controller de uma API. Não é interessante fazer dessa forma.

[00:46] Vamos separar esse comando em uma classe que represente ele. Vou criar uma nova classe na raiz mesmo, porque não estou separando as classes muito bem. Vou chamar de GerarPedido, porque é um comando, uma ação que estou executando.

[01:08] Em GerarPedido tenho algumas dependências, preciso receber algumas coisas. Como por exemplo, preciso do valor do orçamento, do número de itens e do nome do cliente. Vou pegar int $numeroItens e string $nomeCliente.

[01:33] Tenho um construtor, vou inicializar esses atributos. Tudo com os tipos definidos. Tenho os dados, a estrutura do comando. Agora o que quero fazer é executar esse comando. Ou seja, GerarPedido, você que é um comando, se execute. Quero executar você. Então vou executar esse comando. E nesse momento faço tudo isso.

[02:14] Já tenho o número de itens, o valor do orçamento e o nome do cliente. Tenho todas as regras definidas em um comando. Posso criar esse GerarPedido, vou gerar esse comando passando os dados valor orçamento, número de itens e nome cliente.

[02:47] Gerei o comando. Agora chamo o execute, faça o que você tem que fazer. Se eu executar esse mesmo comando php, nome do arquivo, o valor do orçamento, o número de itens, que é doze itens, e o cliente, que é Vinicius Dias.

[03:35] Agora sim criou o pedido no meu banco de dados e enviou e-mail para o cliente. Ou seja, no meu mecanismo de entrega, que é a linha de comando, o meu comando não mudou. Continuo informando a mesma coisa, só que agora tenho todo o comando separado numa classe específica, numa classe separada. Inclusive, se eu tiver algum gerenciador de comandos, alguma coisa que lida com comandos, ainda posso gerar uma interface chamada de command, por exemplo, e dizer que ela precisa ter um ‘public funciona execute’. Todo comando precisa ter um método que se executa, e o gerar pedido é um comando.

[04:20] Agora posso, por exemplo, ter um gerenciador de comandos, uma fila de comandos, onde nessa fila posso ter uma lista de vários comandos, e essa fila de comandos vai dizendo “agora gera o próximo, gera o próximo, executa o próximo”, com isso posso colocar uma fila de comandos, uma fila de processos para ser executada.

[04:38] Mas será que é interessante deixar os dados desse comando, a possibilidade de representar o comando, e a possibilidade de executar o comando tudo na mesma classe? Vamos conversar sobre isso no próximo vídeo.

@@05
Command Handlers

[00:00] Sejam muito bem-vindos de volta. Nesse vídeo queria trocar uma ideia com vocês bastante interessante. Não sei se você já ouviu falar, mas existe um conceito chamado DDD, que é Domain-Driven Design, ou seja, design ou arquitetura, modelagem, orientada ao domínio.
[00:18] Nesse conceito existem várias coisas. Uma dessas arquiteturas que foram pensadas para se aplicar muito bem a esse modelo é a clean architecture, ou arquitetura limpa. E um outro modelo muito parecido, que é a arquitetura hexagonal. Se você não conhece nenhum desses termos, não se preocupe, não é pré-requisito para este curso, mas estou falando isso porque vale uma pesquisa.

[00:40] Mas se você já ouviu falar sobre isso você provavelmente já ouviu falar sobre application service ou use cases. Isso é muito comum no mundo da web. E o que é, bem por alto? Um use case, ou um command, como fizemos aqui, é um caso que vai acontecer na sua aplicação, só que não importa por onde esse caso de uso, esse comando vai ser executado. Tanto faz de onde ele vai vir, mas é um comando que vai ser executado na sua aplicação, que vai fazer alguma coisa no seu domínio da aplicação.

[01:10] Por exemplo, gerar pedido. Quando digo isso você sabe que é um caso de uso, um serviço que minha aplicação faz. No mundo da web, e isso obviamente casa muito bem com php, existe esse conceito de use cases ou application services, que vem do DDD, da arquitetura limpa. Enfim.

[01:30] Com esse conceito, o design pattern que acabamos de implementar no último vídeo foi um pouco alterado. O que fizemos no último vídeo é chamado de padrão de projeto command, ou comando, que é a criação de uma classe, uma estrutura de classes, na verdade, que a partir de uma interface comum sabe como executar alguma tarefa, independente de onde essa tarefa venha.

[01:55] Ela recebe os dados necessários para se executar e executa. Basicamente, isso é o padrão de projeto command. Só que com o advento da internet e várias outras modificações na forma de codificar, fizeram uma alteração muito interessante nesse padrão e vamos implementar essa alteração agora.

[02:14] Temos, como mais uma vez vou falar, os dados de um comando, a representação de um comando, e a execução do comando, tudo na mesma classe. Normalmente isso faz sentido, porque a orientação a objetos é a junção dos dados com comportamento, só que nesse caso perdemos alguns poderes em questão de código mesmo.

[02:36] Por exemplo, estou recebendo no construtor todos os dados que o use case precisa. Mas e se eu precisasse também de uma classe externa, de um repositório, de outro serviço, de um serviço para criar e-mail, por exemplo? Precisaria também receber no construtor, o que poluiria um pouco todo meu código, ou precisaria criar um setter que também poluiria meu código.

[03:02] Além desse problema, alguns outros foram surgindo, por isso surgiu um novo padrão que não é tão novo, mas hoje é muito utilizado, de command handlers, ou os application services.

[03:16] O que eu vou fazer aqui é o seguinte, tenho gerar pedido, que é um comando. Vou criar algo que execute esse comando. Vou chamar de GerarPedidoHandler. Esse nome não é o melhor do mundo, eu sei, mas é um padrão bastante comum, se você encontrar algo como GerarPedidoCommand e GerarPedidoHandler. Ou seja, a ação é dividida em duas. Entre a representação do comando em si e a execução do comando.

[03:44] No handler eu poderia, por exemplo, no construtor, receber um repositório, PedidoRepository, um MailService para enviar e-mail, esse tipo de coisa. Inicializaria minha classe. E no execute, no run, ou qualquer coisa, faria, executaria, aquele comando GerarPedido, porque nesse comando, nessa classe viriam os dados necessários para executar esse comando, e essa classe em si teria as dependências para executar esse comando. Aqui poderíamos fazer algo desse tipo.

[04:33] No GerarPedido eu teria os getters, vou adicionar. Tenho vários getters, ignore a nomenclatura, esse tipo de coisa, é só para chegarmos numa execução. Do comando GerarPedido eu pegaria o número de itens, que é um inteiro. Do comando GerarPedido pegaria o valor do orçamento. E do comando GerarPedido pegaria o nome do cliente. Assim eu executaria aqui, com o PedidoRepository executaria a criação do pedido do banco de dados. Com o MailService eu executaria o envio do e-mail para o cliente.

[05:23] Aqui ganho em dois casos. Primeiro, ganho com o conceito de ter o comando separado para que eu execute ele independente da forma de por onde está vindo, por onde está sendo executado, ou seja, seja pela linha de comando, por um formulário web, por uma API que recebe um JSON, por uma aplicação que lê na mensageria. Independente de onde vem, o meu comando é representado da mesma forma e a ação dele é executada da mesma forma, sem duplicação de dados.

[06:00] Dessa forma, separando os dois ganho um pouco mais de poder na injeção de dependência e algumas coisas desse tipo. Essa separação é bastante benéfica quando paramos para pensar na arquitetura, no código em si. Se pensarmos só nos conceitos é lindo ter um comando que tem seus dados e sabe executar. Só que quando colocamos no código esbarramos com alguns problemas, que esse padrão, criando os comandos e os handlers de forma separada podem ajudar bastante.

[06:27] No meu GerarPedido o que eu faria é, depois de criar o comando GerarPedido criaria meu GerarPedidoHandler, e aqui passaria através de algum serviço de injeção de dependência como vimos no curso de MVC, todas as dependências para cá, e depois com esse handler eu executaria esse comando GerarPedido. E pronto, assim executo as tarefas.

[07:05] Em todos os lugares que precisar só preciso disso. Todos os lugares que tiver que executar só preciso disso. Preciso do handler e crio meu comando para executar. Não preciso copiar todas as regras de negócio, tudo que precisa ser feito. Então, se em algum momento eu precisar passar além de enviar e-mail e criar um pedido no banco de dados gerar log de criação de pedido, também estou gerando log, e no meu controller, que usa esse comando, nada mudou. No meu controller da API que gera esse comando, nada mudou. No meu serviço pela linha de comando nada mudou.

[07:50] Essa é a vantagem de utilizar commands e especificamente falando para web, no mundo atual, command handlers e no php você vai ver bastante sobre isso. Só para resumir tudo que foi falado, no vídeo anterior implementamos o padrão command, o padrão de projeto chamado command, só que ele trouxe alguns problemas para o padrão de desenvolvimento atual, para como desenvolvemos hoje, com as técnicas mais atuais, principalmente se tratando de web.

[08:20] Com isso, modificaram ele um pouco para ter um command e o command handler. Dessa forma costumamos organizar aplicações muito bem arquitetadas. De novo, esse mesmo nome que estou chamando de command handler pode ser também chamado de use cases, de application services. Depende muito da literatura, de onde você está estudando.

[08:44] Basicamente, isso é o padrão command e o padrão que utiliza command handler. Mas vamos pensar nisso que já temos aqui. No mesmo método estou gerando pedido com seu orçamento, depois crio no banco de dados, envio um e-mail para o cliente, gero log de criação. Tem muita responsabilidade nesse mesmo método. No próximo capítulo vamos ver como podemos separar isso melhor.

@@06
Para saber mais: Command

O padrão de projetos Command é, provavelmente, um dos que mais gera confusão no mundo PHP (e acredito que no mundo de desenvolvimento web em geral), já que alguns conceitos mais específicos pro mundo da web surgiram.
Para você entender melhor sobre o padrão Command "original" (definido no livro da GoF), você pode dar uma olhada nesse link: https://refactoring.guru/design-patterns/command.

Mas, para começar a entender sobre a diferença que foi citada no último vídeo, você pode começar aqui: https://groups.google.com/forum/?hl=en#!topic/dddcqrs/Yfrt4OqPUD0.

Também é muito interessante o estudo mais aprofundado sobre DDD, Clean Architecture, Arquitetura Hexagonal, etc. No estudo sobre esses conceitos, você vai esbarrar no padrão de Command Handlers (que foi aplicado de forma bem simples nesta aula).

@@07
Faça como eu fiz

Chegou a hora de você seguir todos os passos realizados por mim durante esta aula. Caso já tenha feito, excelente. Se ainda não, é importante que você execute o que foi visto nos vídeos para poder continuar com a próxima aula.

Continue com os seus estudos, e se houver dúvidas, não hesite em recorrer ao nosso fórum!

@@08
O que aprendemos?

Nesta aula, aprendemos:
Que um caso de uso em nossa aplicação pode ter várias ações (salvar no banco, enviar e-mail, etc)
Que um caso de uso deve ser extraído para uma classe específica, ao invés de estar no arquivo da CLI, controller ou algo do tipo
Que a técnica de extração do caso de uso para uma classe específica pode ser chamada de padrão Command
A diferença do padrão Command da GoF para o padrão que utiliza Command Handler (muito utilizado com DDD)

#### 19/02/2024

@06-Observer

@@01
Projeto da aula anterior
PRÓXIMA ATIVIDADE

Caso queira, você pode baixar aqui o projeto do curso no ponto em que paramos na aula anterior.

@@02
Ações ao gerar um pedido

[00:00] Bem-vindos de volta a mais um capítulo desse treinamento de padrões de projeto utilizando php e vamos bater um papo sobre esse pedido handler aqui. Nesse método temos bastante coisa. A funcionalidade principal dessa classe é gerar um pedido. Já temos o pedido gerado com nome do cliente, data finalizada, o orçamento definido com seus valores, quantidade de itens, tudo certo. Esse método fez seu trabalho.
[00:40] A partir desse trabalho algumas ações são executadas, como salvar o que ela fez no banco de dados, enviar por e-mail, gerar um log dessa ação. Essas ações que vão ser executadas depois de gerar um pedido podem ser separadas, então vamos separar.

[01:02] Vou criar uma pasta e vou chamar de acoesAoGerarPedido. Vou criar algumas coisas. Primeiro CriarPedidoNoBanco. Vou também EnviarPedidoPorEmail, com name space ‘Alura\DesingPattern\AcoesAoGerarPedido’. Vou copiar. E LogGerarPedido.

[01:52] Tem algumas classes aqui. Não vamos nos atentar ao nome que eu usei, mas beleza. Agora, sempre que eu executar essa ação, ou seja, gerar pedido, eu quero executar depois algumas ações, como por exemplo CriarPedidoNoBanco, EnviarPedidoPorEmail, fazer um log de gerar pedido. Vamos implementar essas ações.

[02:20] Primeiro, CriarPedidoNoBanco. Vou colocar ‘public function executaAcao(Pedido $pedido)’. Que ação vou executar no caso? Vou executar salvando pedido no banco de dados. Ação executada. Não retornada nada, então é void.

[02:47] Posso até exibir algum dado do pedido? Não precisa. O log gerar pedido vai ser bem parecido, então vou copiar e colar. Gerando log de geração de pedido. Ficou meio redundante, mas tudo bem. E na parte de enviar e-mail, enviando e-mail de pedido gerado.

[03:26] Tenho todas as ações implementadas. Imagine que isso está indo no banco, que está salvando um log, enviando realmente um pedido por e-mail. O que quero agora é executar no meu command handler. Primeiro vou criar o salvador de pedidos, vamos chamar de PedidoRepository, CriarPedidoNoBanco. Sei que o nome não é dos melhores, mas podemos relevar.

[04:00] Depois quero executar o LogGerarPedido, e também o EnviarPedidoPorEmail. Tenho as três classes. Repare que o php storm já importou para mim. E agora posso executar essas três ações. Venho em PedidoRepository, executaAcao no pedido, LogGerarPedido executaAcao no pedido, e enviar por e-mail executaAcao no pedido. Já está relativamente melhor, porque as responsabilidades foram separadas, mas ainda assim tem muita coisa aqui.

[04:45] Imagine que toda a lógica de criar pedidos já não está mais nessa classe, mas ainda estou chamando especificamente, e se depois de fizer isso eu quiser, por exemplo, mandar para um sistema de mensageria essa ação, para que outro sistema, outro micro serviço processe essa ação e tome alguma atitude, algum tipo de auditoria, esse tipo de coisa? Eu teria que criar uma nova classe, chamar um novo método. Entra naquele problema que esse método cresceria para sempre dessa forma. No próximo vídeo vamos ver uma forma de melhorar esse código.

@@03
Muitas responsabilidades
PRÓXIMA ATIVIDADE

Um Command Handler tem como responsabilidade, normalmente, apenas orquestrar as tarefas a serem executadas, ou seja, chamar as classes necessárias que realizam as tarefas desejadas. No nosso caso, o Command Handler tinha todo o código do fluxo em seu corpo.
Por que separar cada uma das tarefas em uma classes separadas é benéfico?

Porque, com classes menores e mais concisas, é mais fácil encontrar possíveis problemas
 
Alternativa correta! Se em algum momento o log da aplicação parar de funcionar, nós sabemos que há uma classe específica para este propósito e podemos começar a depuração por ela.
Alternativa correta
Porque, quanto mais classes, mais mostramos para os nossos superiores que estamos produzindo
 
Alternativa correta
Porque a implementação de cada tarefa pode mudar com o tempo e o Command Handler não deve precisar saber disso
 
Alternativa correta! Imagine que a ferramenta utilizada para enviar e-mails mude depois de alguns anos. O nosso Command Handler não precisa saber deste detalhe específico, então é interessante que cada classe seja responsável apenas por uma pequena tarefa.

@@04
Adicionando ações como observers

[00:00] Bem-vindos de volta. Vamos botar a mão na massa e melhorar esse código. Pensa comigo. Quando essa ação é executada, quando GerarPedidoHandler é executado, alguma coisa tem que acontecer, algumas coisas têm que acontecer. Que coisas são essas? Preciso salvar no banco, gerar um log, enviar por e-mail. Algumas coisas precisam acontecer com pedido gerado.
[00:25] O que vamos fazer é salvar todas essas ações como ações do meu command handler. Vou criar um novo atributo, vai ser um array, uma lista, acoesAposGerarPedido, vai ser um array que começa vazio, e consigo aqui adicionarAcaoAoGerarPedido.

[00:52] Só que qual o tipo dessa ação? Como vou saber que essa ação possui, que esse objeto possui o método executaAcao? Mais uma vez precisamos de um objeto, certo? Vamos criar uma nova interface do php, AcaoAposGerarPedido. Tenho a interface criada, que precisa ter esse método.

[01:25] CriarPedidoNoBanco implementa essa interface AcaoAposGerarPedido, em LogGerarPedido também vai implementar, e em EnviarPedidoPorEmail. Tudo certo. Agora vou adicionar várias ações após gerar pedido, e o tipo é AcaoAposGerarPedido, e vou adicionar naquele array essa ação.

[02:06] Quando eu criar esse meu pedido handler posso adicionar várias ações que vão ser executadas depois de gerar pedido. Posso remover isso tudo e fazer um foreach. Para cada uma das ações ao gerar pedido vou executar a ação. E dessa ação vou fazer o php storm me ajudar dizendo que esse array é do tipo acoesAposGerarPedido. Agora o php storm vai saber me dizer qual o método que temos aqui, executaAcao nesse pedido.

[02:40] Agora posso criar quantas ações eu quiser que essa classe GerarPedidoHandler não vai ser alterada, não vai ser modificada. Posso, por exemplo, criei o handler e vou adicionar no GerarPedidoHandler adicionarAcaoAoGerarPedido um novo CriarPedidoNoBanco, vou gerar o de log GerarPedido.

[03:08] Por enquanto vou adicionar só essas duas ações. Vou executar esse código, ver se tudo dá certo. Esqueci de passar os parâmetros. Vou passar todos os parâmetros, php gera pedido, o valor do orçamento é 1.234,56, tenho sete itens, o cliente é Vinicius Dias, salvando pedido no banco de dados e gerando log. Geração de pedido.

[03:40] Agora, antes de gerar o log quero que ele mande e-mail. Adiciono uma ação EnviarPedidoPorEmail. Eu não mexi em nada na minha GerarPedidoHandler, mas adicionei no meu comando, na minha linha de comando essa ação e está lá, salvando pedido, enviando e-mail e gerando log, todas as ações sendo executadas de forma dinâmica.

[04:05] Vamos repensar no que fizemos aqui. Temos um alvo de uma ação que vai acontecer, temos o gerador da ação que vai ser o que vai acontecer, e temos ouvintes dessa ação. Alguém que está esperando a ação acontecer, e quando acontecer faz algo com ela, atualiza o pedido, faz qualquer coisa com o pedido gerado. Esse padrão diz que o pedido é nosso sujeito dessa ação e essas classes que os observadores, os ouvintes dessa ação, que vai pegar a partir da ação esse sujeito, esse alvo, e realizar alguma ação com ele.

[04:52] Esse padrão de projeto é chamado de observer. Um exemplo do mundo real disso seria, por exemplo, você acessa todos os dias um site de notícias. Todos os dias você executa a ação de ir lá e acessar. Só que agora ao invés de fazer isso manualmente você quer se subscrever na newsletter deles, na carta semanal ou diária que eles mandam por e-mail. Você vai colocar lá e vai se inscrever como ouvinte dessa ação de enviar a notícia.

[05:23] Com isso você vai receber notícia e vai ser notificado dessa notícia sem que precise estar no site deles especificamente. Essas ações são notificadas sem estar diretamente codificadas no método da ação em si. Esse padrão mais uma vez é chamado de observer. No próximo vídeo vamos ver algumas particularidades interessantes do php em relação a esse padrão de projeto.

@@05
Observers no PHP

[00:00] Bem-vindos de volta. Já vimos o que é o padrão de projeto observer, vimos como implementar, mas vamos conversar um pouco sobre ele no php. Primeiro, não é comum que implementemos observers no command handler. O command handler só deve executar uma ação e não avisar ninguém, não fazer mais nada além disso.
[00:22] O que seria comum nesse caso, algo mais próximo da realidade, seria se você tem um comando que gera pedido, ele vai salvar no banco de dados, é da natureza das aplicações php salvar as coisas no banco de dados, é normal. Esse é o comum. Não estou dizendo que isso que fiz está errado, mas estou falando do mais próximo da realidade, do dia a dia.

[00:45] Você salvaria no banco de dados. E nesse repositório que salva um pedido no banco de dados você adicionaria os observers, isso faz muito mais sentido no mundo real, é muito mais comum no mundo real, porque um repositório você configura no gerenciador de dependências, igual fizemos no nosso curso de MVC aqui da Alura.

[01:06] Já um command handler você não vai utilizar tantas coisas dele. Deve ser mais simples. Por isso não é comum ter as ações nele. Mas, para o nosso exemplo, como não estamos trabalhando com web, com um projeto grande e real, isso funcionou perfeitamente para conhecermos o padrão.

[01:23] Outro detalhe é que esse padrão é tão conhecido, tão famoso, que há bastante tempo, e há bastante tempo mesmo, o próprio pessoal, a equipe do php adicionou no core da linguagem, ou seja, na linguagem em si, algumas interfaces para você implementar esse padrão de projeto. Vou te mostrar como seria sem criar tudo isso por conta própria.

[01:48] Vou apagar isso aqui e isso aqui. O php fornece uma interface chamada splSubject. Essa interface quer dizer que essa classe GerarPedidoHandler está implementando ou a ação ou algo que vai notificar a outras pessoas, a observers que alguma coisa aconteceu. Então o subject, que é o alvo que eu disse, o sujeito que vai executar a ação ou ser o alvo da ação implementa essa interface.

[02:15] Se eu apertar "Alt + Enter” aqui, o php storm vai adicionar para nós os métodos dessa interface. O primeiro é o attach, que simplesmente é para salvarmos naquele array algum observer. Vamos fazer isso, ‘$this->acoesAposGerarPedido[] = $observer’.

[02:35] Repare que ele é de um tipo diferente do que estávamos usando, mas chegamos até lá. Agora, o detach é para remover. Se quiséssemos remover um observer. No nosso caso não vou implementar isso, mas caso você queira implementar não é muito difícil. Mas eu não vou porque foge do assunto do nosso exemplo.

[03:00] Agora vou implementar o notify. Basicamente, é um método que vai chamar todos os observers, que vai executar as ações dos observers. O que vou fazer é aquele foreach, para cada uma das ações ao gerar pedido como ação. E repare que aqui é um splObserver, então não é esse o tipo mais, AcaoAposGerarPedido, é splObserver. Mudamos o tipo. Vou inclusive apagar isso tudo.

[03:32] Voltando, a classe splObserver, essa interface, na verdade, possui o método update, que é a execução da ação em si, que vai receber o pulo do gato. Normalmente, o padrão observer a própria classe que vai ser atualizada é a que chama esse método, logo deveria passar por parâmetro o this, só que as ações estão sendo executadas no pedido, certo? Então vamos fornecer o pedido gerado. Vamos deixar como ‘public Pedido $pedido’.

[04:11] Agora sim tenho o pedido, estou salvando pedido, igual pedido, e no final de tudo $this->notify. Ou seja, depois de executar a ação, eu notifico todos os observers. Estou passando por todos. Então vamos modificar nossas ações.

[04:35] Ao invés de implementar ação após gerar pedido, ele vai implementar um splObserver, ao invés de ser executação, é update de um splSubject. Muda um pouco, mas na prática para nós vai funcionar exatamente igual.

[04:50] Vou atualizar todos os outros. Se eu quisesse pegar o pedido, eu pegaria do pedido, que é o comando, no caso. Por exemplo, no cria pedido no banco, na verdade lá no e-mail, vou exibir o nome do cliente, ‘echo $pedido->pedido->nomeCliente’.

[05:40] Vamos testar isso tudo, ver se funciona. Faltou um detalhe, o attach, agora que mudamos o método para aderir a interface do próprio php. Vamos ver se está tudo certo agora.

[06:04] Salvando pedido no banco de dados. Exibi meu nome e enviando por e-mail gerando log. Implementamos exatamente a mesma coisa, só que usando algumas classes do php, algumas interfaces do php. Mas se você reparar precisamos dar algumas voltas, fazer algumas coisas para implementar. Por isso, por padrão, normalmente, via de regra, você vai ver implementado da primeira forma. Você vai ver implementado de forma personalizada, criando a própria interface com nomes específicos, e não utilizando a interface genérica do php, splObserver e splSubject.

[06:40] Esse vídeo foi só para explicar que existe isso no mundo do php. Caso você veja você não vai ficar perdido por causa dos nomes genéricos. É assim que funcionam as interfaces do php. Mas no nosso caso vamos deixar implementado da forma anterior, do vídeo anterior, então vou desfazer isso tudo. Como estou utilizando git aqui, git restore e beleza. Tudo já foi desfeito e estou com meu código original de novo, utilizando a interface personalizada e ações após gerar pedido.

[07:13] Agora já fizemos bastante coisa, aprendemos muitos padrões de projeto, e quero implementar uma coisa simples. Quero implementar uma lista dos pedidos, ou uma lista dos orçamentos, quero visualizar uma lista na linha de comando mesmo, vamos conversar sobre isso no próximo vídeo.

@@06
Para saber mais: Observer
PRÓXIMA ATIVIDADE

O padrão Observer é comumente utilizado por diversas bibliotecas que trabalham com eventos. Muito provavelmente, seu framework preferido (Symfony, Laravel, Phalcon, etc) possui algum componente que lida com eventos.
A forma como o padrão foi implementado aqui na aula é a mais simples e pura, mas existem diversas modificações que podem ser feitas. Dar nomes a eventos para filtrar quais ações serão executadas, etc.

Para entender mais sobre a teoria deste padrão, você pode conferir este link: https://refactoring.guru/design-patterns/observer.

Já para conhecer melhor as interfaces do próprio PHP: https://www.php.net/manual/pt_BR/class.splobserver.php.

@@07
Faça como eu fiz
PRÓXIMA ATIVIDADE

Chegou a hora de você seguir todos os passos realizados por mim durante esta aula. Caso já tenha feito, excelente. Se ainda não, é importante que você execute o que foi visto nos vídeos para poder continuar com a próxima aula.

Continue com os seus estudos, e se houver dúvidas, não hesite em recorrer ao nosso fórum!

@@08
O que aprendemos?
PRÓXIMA ATIVIDADE

Nesta aula, aprendemos:
Que deixar a implementação de todas as tarefas de um caso de uso da aplicação na mesma classe pode trazer problemas
Dificuldade de manutenção
Classes muito grandes e difíceis de ler
Problemas quando precisar alterar a implementação de uma das tarefas
Que é mais interessante separar cada ação em uma classe separada
Como ligar um evento ocorrido com suas ações, através do padrão Observer

