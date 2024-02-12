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