<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'alvestar');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'senha');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'RPG[MY9?n9l@wmVx,&}|)RFEL:}bPs6w[:|7|~mq9aDL#q.K&#e?KqSVc+FA}`:*');
define('SECURE_AUTH_KEY',  '4|}oYc;hT!.+Lc=L/$Ml|{>}V57he[IV|+~R1pnnR:K/>Q~BY-8+WU=YvG*@-rBp');
define('LOGGED_IN_KEY',    '*N=94SAue3}2`PjzyVDS=e,E>- 0Vk_c@]mT/W^Dc9T&2tspNKSy&f~YLEqw_M=K');
define('NONCE_KEY',        'l<5Pyb{pXTThNWRn&mrYq)Ub79+.|gg+kLr}-X-qJ<= `+KH{1k$}Kj+t&%~cpBP');
define('AUTH_SALT',        'f]4K$904!,J$u_`+v^%X?A12s|y#e7N^|1>Y(#QHhYD}M_6mslIotpHK)h(;m{~u');
define('SECURE_AUTH_SALT', '+x$>paz[|v_~O_FumVI8 3M`*Qcrxtc2Mp(lUQGf[6xMJW-?bi53BIGH!h0eDc.+');
define('LOGGED_IN_SALT',   '9WR1Avy%)jYoZ?/K?D[}&GhT;o=cQ+>>m`b.i|[*|-Q^qQPOyXlA[Z:!ht|07a@s');
define('NONCE_SALT',       'akF;/*O:,@`G:AP<e%Z^t/oN_x@z`:`U:J{ffE39RUfA>!9JPwS$ega+R~;PR{%}');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * O idioma localizado do WordPress é o inglês por padrão.
 *
 * Altere esta definição para localizar o WordPress. Um arquivo MO correspondente ao
 * idioma escolhido deve ser instalado em wp-content/languages. Por exemplo, instale
 * pt_BR.mo em wp-content/languages e altere WPLANG para 'pt_BR' para habilitar o suporte
 * ao português do Brasil.
 */
define('WPLANG', 'pt_BR');

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
