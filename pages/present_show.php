<?php
	/* Димон, тут кароч кор ↓, может у тебя в другом месте */
	include "../components/conn.php";
	/*                      ↑                              */

	mb_internal_encoding( "UTF-8" );
	mb_http_output( "UTF-8" );
	mb_http_input( "UTF-8" );
	mb_language( "uni" );
	mb_regex_encoding( "UTF-8" );
	ob_start( "mb_output_handler" );
	setlocale( LC_ALL, array( 'ru_RU.UTF-8', 'ru_RU.UTF8', 'ru_RU.65001' ), array( 'rus_RUS.UTF-8', 'rus_RUS.UTF8', 'rus_RUS.65001' ), array( 'Russian_Russia.UTF-8', 'Russian_Russia.UTF8', 'Russian_Russia.65001' ) );
	setlocale( LC_NUMERIC, 'C' ); //in float number deilmiter = "."

	/* Боремся с включенными magic quotes
	if ( function_exists( "get_magic_quotes_gpc" ) && get_magic_quotes_gpc() === 1 ) {
		$_COOKIE = array_map( "stripslashes", $_COOKIE );
		$_POST = array_map( "stripslashes", $_POST );
	}
	*/

	define( "DBFILE", realpath( str_replace( '\\', '/', __DIR__ ) ) . "/chat.db" ); //Путь и имя файла с чатом
	define( "REFRESHTIME", 4 * 1000 ); //Клиентская задержка опроса сервера

	define( "COOKIEPATH", "/" );

	define( "CHATTRIM", 0 ); //Максимальная длина пересылаемого куска чата, 0 - без ограничений

	define( "MAXUSERNAMELEN", 50 ); //Максимальная длина имени пользователя
	define( "MAXUSERTEXTLEN", 2048 ); //Максимальная длина сообщения пользователя

	function makeURL( $matches ) {
		return '<a href="' . ( mb_strpos( $matches[1], "://" ) === false ? "http://" : "" ) . $matches[1] . '" target="_blank">' . $matches[1] . '</a>';
	}

	function chatOut( $status = null, $chat = null ) {
		if ( $status !== null ) {
			$lastMod = filemtime( DBFILE );
			if ( $lastMod === false ) $lastMod = 0;
			echo( "{$status}:$lastMod\n" );
		}

		if ( $chat === null ) {
			if ( CHATTRIM ) {
				$f = fopen( DBFILE, "r" );
				fseek( $f, -CHATTRIM, SEEK_END );
				$chat = fread( $f, CHATTRIM );
				fclose( $f );
				$p =  mb_strpos( $chat, '<div class="msg"' );
				if ( $p !== false ) {
					$chat = mb_substr( $chat, $p );
				}
			}
			else $chat = file_get_contents( DBFILE );
		}

		echo( $chat );
	}

	function cleanName( $str ) {
		$str = trim( $str );
		$str = preg_replace( "~[^ 0-9a-zа-яё]~iu", "", $str );
		$str = mb_substr( $str, 0, MAXUSERNAMELEN );
		return $str;
	}

	function cleanText( $str ) {
		$str = trim( $str );
		$str = preg_replace( "~\r~u", "", $str );
		$str = preg_replace( "\x07[^ \t\n!\"#$%&'()*+,\\-./:;<=>?@\\[\\]^_`{|}~0-9a-zа-яё]\x07iu", "", $str );
		$str = preg_replace( "~&~u", "&amp;", $str );
		$str = preg_replace( "~<~u", "&lt;", $str );
		$str = preg_replace( "~>~u", "&gt;", $str );
		$str = mb_substr( $str, 0, MAXUSERTEXTLEN );
		$str = preg_replace( "~\n~u", "<br />", $str );

		return $str;
	}






	$exit = false;
	if (isset($_SESSION['user']) and ($_SESSION['user']!='')) {
		$_POST['name'] = $_SESSION['user'];
	}
	else {
		header("Location: ../index.php");
	}
	$name = $_SESSION['user']['name'];

	$text = @$_POST["text"];
	$mode = null;

	switch( @$_POST["mode"] ) {
		case "post":
			$mode = "post";
		break;

		case "list":
			$mode = "list";
		break;
	}

	if ( $mode == "post" ) {
		if ( !$name || !$text ) {
			header( 'HTTP/1.1 400 Bad Request' );
			exit( 0 );
		}

		if ( !@empty( $_SERVER[ "HTTP_CLIENT_IP" ] ) ) $id = $_SERVER[ "HTTP_CLIENT_IP" ];
		elseif ( !@empty( $_SERVER["HTTP_X_FORWARDED_FOR"] ) ) $id = $_SERVER["HTTP_X_FORWARDED_FOR"];
		else $id = @$_SERVER["REMOTE_ADDR"];

		$exit = true;

		if ( $name != $cookieName ) setcookie( "userName", $name, mktime( 0, 0, 0, 12, 31, 3000 ), COOKIEPATH );

		$text = preg_replace_callback( "\x07((?:[a-z]+://(?:www\\.)?)[_.+!*'(),/:@~=?&$%a-z0-9\\-]+)\x07iu", "makeURL", $text );
		$msg = '<div class="msg"><div class="info"><span class="name">' . $name . '</span><span class="misc"><span class="date">' . date( "d.m.Y H:i:s" ) . '</span></span></div>' . $text . '</div>' . "\n\n";

		file_put_contents( DBFILE, $msg, FILE_APPEND );

		$mode = "list";
	}

	if ( $mode == "list" ) {
		$exit = true;

		$rlm = preg_match( "~^\\d+$~u", @$_POST["lastMod"] ) ? (int)$_POST["lastMod"] : 0;

		$lastMod = filemtime( DBFILE );
		if ( $lastMod === false ) $lastMod = 0;

		if ( $rlm == $lastMod ) chatOut( "NONMODIFIED", "" );
		else chatOut( "OK", null );
	}

	if ( $exit ) exit( 0 );

	$lastMod = filemtime( DBFILE );
	if ( $lastMod === false ) $lastMod = 0;
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<title>ProtoChat</title>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/style.css">
		<!-- <link rel="stylesheet" href="../css/present_show.css"> -->
		<link rel="stylesheet" href="../css/bad1.css">
   	     <link rel="stylesheet" href="../css/style.css">
	</head>
	<body>
		<header class="main_menu">
    	    <a href="../index.php">
    	        <div class="logo">
    	            <img src="https://media.licdn.com/dms/image/D4E0BAQG-i2j7Q2WFIA/company-logo_200_200/0/1694593112031/img_logo?e=2147483647&v=beta&t=o1304VK0Zbh3CBA-8_LNYNZZCNrQjMIBS-nwKrAMzbY" alt="">
					<h6>Prese<b style="color: #1b4aa0;font-size: 2vw">INTE<b style="font-size: 2.5vw;">X</b></b><b style="color:#2ca3dc;font-size: 2vw">PRO</b></h6>
    	        </div>
    	    </a>
    	    <div class="main_menu_items">
    	            <!-- <a href="" class="main_menu_item">Предпросмотр</a> -->
    	            <!-- <a href="" class="main_menu_item">Показ</a> -->
    	        <?php 
    	            if (isset($_SESSION['user']) and isset($_SESSION['user']['name'])) {
    	                echo "<a href='' class='main_menu_item'>Пользователь: {$_SESSION['user']['name']}</a>
    	                <a href='../components/exit.php' class='main_menu_item'>Выход</a>";
    	            } else {
    	                echo "<a href='registration.php' class='main_menu_item'>Регистрация</a>
    	                <a href='authorization.php' class='main_menu_item'>Авторизация</a>";
    	            }
					?>
    	    </div>
    	</header>
		<main>
			<?php
				session_start(); 
				if(isset($_SESSION['user'])){ 
					$userId = $_SESSION['user']['id'];  
					
					// Получаем id презентации из URL
					$presentationId = isset($_GET['id']) ? $_GET['id'] : null;
					
					if ($presentationId !== null) {
						// Запрос к базе данных для получения user_id презентации
						$sql = "SELECT user_id FROM presentations WHERE id = $presentationId";
						$result = $conn->query($sql);
						
						if ($result->num_rows > 0) {
							$row = $result->fetch_assoc();
							$presentationUserId = $row['user_id'];
							
							if ($userId == $presentationUserId) {
								echo "<aside class='slides'>
								<div id='slideContainer'> </div>
								<div class='slide'  id='addSlideButton' style='display: none'>
								<img src='../img/plus.png' alt=''>
								</div>
								</aside>
								
								<article class='article' style='margin: 0; width: 74vw;'>
								<div class='fixed activeSlide' id='activeSlide'>
								
								
								<p style='margin-top: 5vw;'>для изменения слайда используйте РС или laptop</p>
								
								
								
								</div>
								</article>";
							} else {
								echo "		
								<article class='article' style='margin: 0; width: 74vw;'>
								<div class='fixed activeSlide' id='activeSlide'>

								
								<p style='margin-top: 5vw;'>для изменения слайда используйте РС или laptop</p>
								
								
								
								</div>
								</article>";
							}}}}
							?>




<div class="right-menu" style="margin: 0;">
	<div id="wrapper">
		<!-- <h1>Чат</h1>
		
		<div id="msgsDialog" class="block">
			<div id="msgsContent">
				<?php chatOut(); ?>
			</div>
			
			<label class="options first"><input id="autoScroll" type="checkbox" checked="checked" /> прокручивать вниз</label>
			<label class="options"><input id="autoHeight" type="checkbox" checked="checked" /> авторазмер ввода</label>
			
			<div class="ct"></div>
			<div class="cb"></div>
		</div>
		<br />
		<br />
		<form action="" method="post" id="sendForm">
			<div id="sendDialog" class="block2">
				<input type="hidden" name="name" value="<?php echo( $name ); ?>" maxlength="<?php echo( MAXUSERNAMELEN ) ?>" />
				<textarea name="text" placeholder="Текст" style="margin-top: 0.5em;" maxlength="<?php echo( MAXUSERTEXTLEN ); ?>"></textarea>
				<input type="submit" value="отправить" class="button" title="ctrl + enter" id="submit"/>
				<div class="ad"></div>
			</div>
		</form> -->
	</div>
</div>
<button id="change-color-btn" style="none"></button>
<form id="form">
	
	</form>

</main>
<script>
	 const userId = <?php echo $_SESSION['user']['id']; ?>;
  	  var variable1 = 1;

 const observer = new MutationObserver((mutations) => {
  mutations.forEach((mutation) => {
    if (mutation.addedNodes.length > 0) {
      console.log('Добавлено:', mutation.addedNodes);
      const block = document.querySelector('.block.ask-question');
	  if (block && variable1 !== userId) {
 	 block.style.display = 'block';
	}

    }
  });
});

observer.observe(document.body, {
  childList: true,
  subtree: true
});

</script>
<script src="../app.js"></script>
<!-- script -->
<script type="text/javascript">
	( function() {
		var msgsDialog = document.getElementById( "msgsDialog" );
		var sendDialog = document.getElementById( "sendDialog" );
		var submit = document.getElementById( "submit" );
		
		var msgs = document.getElementById( "msgsContent" );
		var oAS = document.getElementById( "autoScroll" );
		var oAH = document.getElementById( "autoHeight" );
		var f = document.getElementById( "sendForm" );
		var name = f.elements.name;
		var text = f.elements.text;
		
		// вроде как авто увеличение высоты инпута для сообщения
		function ah( el, maxH, state ) {									
			if ( arguments.length === 1 ) {
				if ( el._ah_ ) el._ah_();
				return;
			}
			
			if ( el._ah_ ) de( el, "input", el._ah_ );
			delete( el._ah_ );
			el.style.height = "auto";
			
			if ( state ) {
				el.style.boxSizing = "border-box";
				var h = el.offsetHeight;
				var dh = h - el.clientHeight;
				
				el._ah_ = function() {							
					while ( true ) {
						t = el.offsetHeight - 16;
						el.style.height = t + "px";
						if ( t < h || el.scrollHeight > el.clientHeight ) break;
					}
					
					//		el.style.height = "auto";
					var nh = el.scrollHeight + dh;
					if ( maxH && nh > maxH ) nh = maxH;
					el.style.height = nh + "px";
				};
				
				ae( el, "input", el._ah_ );
				el._ah_();
			}
		}
		
		if ( oAH.checked ) ah( text, 500, true );
		
		var msgsDialogWaiter = WAITER( msgsDialog );
		var sendDialogWaiter = WAITER( sendDialog );
		
				function ae( obj, event, handler ) {
					if ( typeof( obj.addEventListener ) != 'undefined' ) obj.addEventListener( event, handler, true );
					else if ( typeof ( obj.attachEvent ) != 'undefined' ) obj.attachEvent( 'on' + event, handler, true );
				}
				
				function de( obj, event, handler ) {
					if ( typeof( obj.removeEventListener) != 'undefined' ) obj.removeEventListener( event, handler, true );
					else if ( typeof( obj.detachEvent ) != 'undefined' ) obj.detachEvent( 'on' + event, handler );
				}
				
				// выполняет асинхронный POST-запрос на указанный URL с заданными параметрами и обрабатывает ответ?
				function post( url, reqParams, handler ) {
					var XMLo;
					
					if ( window.XMLHttpRequest ) {
						try { XMLo = new XMLHttpRequest(); }
						catch ( e ) { XMLo = null; }
					} else if ( window.ActiveXObject ) {
						try { XMLo = new ActiveXObject( "Msxml2.XMLHTTP" ); }
						catch ( e ) {
							try { XMLo = new ActiveXObject( "Microsoft.XMLHTTP" ); }
							catch ( e ) { XMLo = null; }
						}
					}
					
					if ( XMLo == null ) return null;
					
					XMLo.open( "POST", url, true );
					
					XMLo.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded" );
					if ( reqParams ) {
						var prm = "";
						for ( var i in reqParams ) prm += "&" + i + "=" + encodeURIComponent( reqParams[i] );
						reqParams = prm;
						//XMLo.setRequestHeader( "Content-Length", reqParams.length );
					}
					else {
						reqParams = " ";
						//XMLo.setRequestHeader( "Content-Length", 1 );
					}
					XMLo.setRequestHeader( "X-Requested-With", "XMLHttpRequest" );
					XMLo.setRequestHeader( "Accept", "*/*" );
					
					XMLo.onreadystatechange = function() {
						if ( XMLo.readyState == 4 ) {
							if ( XMLo.status == 200 || XMLo.status == 0 ) {
								handler( true, XMLo.status, XMLo.responseText, ( XMLo.responseXML ? XMLo.responseXML.documentElement : null ) );
							}
							else {
								handler( false, XMLo.status, XMLo.responseText );
							}
							
							delete XMLo;
							XMLo = null;
						}
					};
					
					XMLo.send( reqParams );
					
					return ( XMLo != null );
				}

				// реализует анимацию плавного изменения прозрачности элемента на веб-странице?
				function fade( o, opts, dontStartNow ) {
					var ov, ob, oe, os, t;
					
					function th() {
						ov += os;
						if ( ( os > 0 && ov >= oe ) || ( os < 0 && ov <= oe ) ) {
							ov = oe;
							clearInterval( t );
							t = null;
						}
						
						o.style.opacity = ov;
						
						if ( !t && opts.hasOwnProperty( "handler" ) ) opts.handler( true, fs, o );
					}
					
					function init() {
						os = opts.hasOwnProperty( "os" ) ? Math.abs( opts.os ) : 0.1;
						
						if ( !opts.hasOwnProperty( "delay" ) ) opts.delay = 30;
						
						if ( !opts.hasOwnProperty( "ob" ) ) {
							ob = parseFloat( o.style.opacity );
							if ( isNaN( ob ) ) ob = 1;
						}
						else {
							ob = opts.ob;
							o.style.opacity = ob;
						}
						ov = ob;
						
						if ( !opts.hasOwnProperty( "oe" ) ) {
							oe = parseFloat( o.style.opacity );
							if ( isNaN( oe ) ) oe = 1;
						}
						else oe = opts.oe;
						
						if ( ob > oe ) os = -os;
						
						if ( ob != oe ) t = setInterval( th, opts.delay );
					}
					
					var fs = {
						get: function() {
							return {
								opts:	opts,
								ov:		ov,
								ob:		ob,
								oe:		oe,
								os:		os
							};
						},
						
						stop: function( end, dontNotify ) {
							if ( !t ) return;
							
							clearInterval( t );
							t = null;
							if ( end ) o.style.opacity = oe;
							
							if ( dontNotify !== true && opts.hasOwnProperty( "handler" ) ) opts.handler( true, fs, o );
						},
						
						start: function( restart, newOpts, dontNotify ) {
							if ( t ) return;
							
							if ( newOpts ) opts = newOpts;
							
							if ( restart ) {
								init();
								if ( dontNotify !== true && opts.hasOwnProperty( "handler" ) ) opts.handler( false, fs, o );
							}
							else t = setInterval( th, opts.delay );
						}
					};
					
					if ( dontStartNow !== true ) fs.start( true );
					return fs;
				}

				// подсказки?
				var tipUpper = (function() {
					var lastTip = null;
					
					return function( o, html, ax, ay ) {
						if ( ax == undefined ) ax = 0;
						if ( ay == undefined ) ay = -5;
						
						function getCords( elem ) {
							var box = elem.getBoundingClientRect();
							
							var body = document.body;
							var docEl = document.documentElement;
							
							var scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
							var scrollLeft = window.pageXOffset || docEl.scrollLeft || body.scrollLeft;
							
							var clientTop = docEl.clientTop || body.clientTop || 0;
							var clientLeft = docEl.clientLeft || body.clientLeft || 0;
							
							var top  = box.top +  scrollTop - clientTop;
							var left = box.left + scrollLeft - clientLeft;
							
							return { top: Math.round(top), left: Math.round(left) };
						}
						
						function attachEvents( tip, o ) {
							detachEvents( tip );
							tip.eh = function() {
								detachEvents( tip );
								f.stop();
								lastTip = null;
								f.start(
									true,
									
									{
										oe: 0,
										os: 0.1,
										handler: function( over, f ) {
											if ( over ) {
												tip.style.display= "none";
												tip.parentNode.removeChild( tip );
											}
										}
									},
									true
								);
							};
							tip.o = o;

							ae( o, "change", tip.eh );
							ae( document, "mousedown", tip.eh );
							ae( document, "keydown", tip.eh );
						}

						function detachEvents( tip ) {
							if ( !tip.eh ) return;

							de( tip.o, "change", tip.eh );
							de( document, "mousedown", tip.eh );
							de( document, "keydown", tip.eh );
						}

						if ( lastTip ) lastTip.eh();

						var t = document.createElement( "div" );
						t.className = "tipUpper";
						t.innerHTML = '<div class="ugol"></div><div class="ugolI"></div><div class="msg">' + html + '</div>';
						var c = getCords( o );
						t.style.left = ( c.left + ax ) + "px";
						t.style.top = ( c.top + o.offsetHeight + ay ) + "px";
						var f = fade(
							t,
							{
								ob: 0,
								oe: 1,
								os: 0.1
							}
						);

						document.body.appendChild( t );

						attachEvents( t, o );
						o.focus();

						lastTip = t;
					};
				})();

				// waiter
				function WAITER( o ) {
					var count = 0;
					var w = document.createElement( "div" );
					remove();
					var f = fade( w, null, true );
					var oMax = 0.3;
					var t = null;


					function th() {
						clearTimeout( t );
						t = null;

						if ( count > 0 ) {
							w.style.visibility = "hidden";
							if ( !w.parentNode ) {
								if ( !o.style.position ) o.style.position = "relative";
								o.appendChild( w );
							}
							w.className = "waiter waiterProgress";
							f.start( true, { ob: 0, oe: oMax, os: 0.05 }, true );
							w.style.visibility = "visible";
						}
						else remove();
					}

					function remove() {
						if ( w.parentNode ) w.parentNode.removeChild( w );
						w.className = "waiter";
						w.style.opacity = 0;
					}

					return {
						show: function( state, always ) {
							var full = w.className.indexOf( "waiterProgress" ) >= 0;

							if ( state ) {
								if ( t ) clearTimeout( t );

								if ( count == 0 ) {
									if ( !w.parentNode && always !== false ) {
										if ( !o.style.position ) o.style.position = "relative";
										o.appendChild( w );
									}
									if ( full ) {
										f.stop( false, true );
										f.start( true, { oe: oMax, os: 0.05 }, true );
									}
								}

								if ( !full ) t = setTimeout( th, 500 );
								count++;
							}
							else {
								if ( count > 0 ) {
									if ( count == 1 ) {
										count = 0;
										if ( t ) {
											clearTimeout( t );
											t = null;
										}

										if ( full ) {
											f.stop( false, true );
											f.start(
												true,
												{
													oe: 0,
													os: 0.05,
													handler: remove
												},
												true
											);
										}
										else remove();
									}
									else count--;
								}
							}
						},

						isShow: function() {
							return count > 0 ;
						}
					};
				}

				function scrollBottom() {
					var os = msgs.onscroll;
					msgs.onscroll = function( e ) {
						if ( !e ) e = window.event;
						if ( e.preventDefault ) e.preventDefault();
						if ( e.stopPropagation ) e.stopPropagation();

						return false;
					};
					msgs.scrollLeft = 0;
					msgs.scrollTop = msgs.scrollHeight;
					setTimeout( function() { msgs.onscroll = os; }, 10 );
				}

				function insertAtCursor( o, val ) {
					if ( document.selection ) {
						o.focus();
						sel = document.selection.createRange();
						sel.text = val;
					}
					else if ( o.selectionStart || o.selectionStart == '0' ) {
						var startPos = o.selectionStart;
						var endPos = o.selectionEnd;
						o.value = o.value.substring( 0, startPos ) + val + o.value.substring( endPos, o.value.length );
					}
					else o.value += val;
				}

				// редакт текста и т.д., обработчик от начала до отправления?
				var refresh = (function() {
					var lastMod = "<?php echo( $lastMod ); ?>";

					return function( params, handler ) {
						if ( !params ) params = {};
						if ( !params.hasOwnProperty( "lastMod" ) ) params.lastMod = lastMod;

						post(
							window.location.toString(),
							params,
							function( state, status, txt ) {
								if ( !state ) {
									tipUpper( msgsDialog, "Ошибка сервера: " + status );
									txt = undefined;
								}

								if ( txt !== undefined ) {
									var p = txt.indexOf( "\n" );
									if ( p > 0 ) {
										var s = /^([a-z]+):(\d+)$/i.exec( txt.substring( 0, p ) ), lm;
										if ( s ) {
											lm = s[2];
											s = s[1];

											txt = txt.substring( p + 1 );

											if ( s == "NONMODIFIED" ) txt = undefined;
											if ( s == "OK" ) lastMod = lm;
										}
									}

									if ( txt !== undefined ) {
										msgs.innerHTML = txt;
										if ( oAS.checked ) scrollBottom();
										
									}
								}

								if ( handler ) handler( state, status, txt );
							}
						);
					};
				})();

				// периодически обновляет содержимое страницы с помощью функции refresh (посылает запрос?)
				var poll = (function() {
					var t = null;
					var inProgress = false;

					var rq = function() {
						if ( inProgress ) return;

						inProgress = true;
						msgsDialogWaiter.show( true, false );
						refresh(
							{ mode: "list" },
							function( state, status, txt ) {
								msgsDialogWaiter.show( false );
								inProgress = false;
								poll( false, true );
							}
						);
					};

					return function( refreshNow, rewait ) {
						if ( rewait === true ) {
							if ( t ) clearTimeout( t );
							t = setTimeout( rq, <?php echo( REFRESHTIME ); ?> );
						}

						if ( refreshNow === true ) rq();
					};
				})();

				oAS.onclick = function() {
					if ( this.checked ) scrollBottom();
				};


				oAH.onclick = function() {
					ah( text, 500, oAH.checked );
				};
				
				// форма
				f.onsubmit = function() {
					if ( /^\s*$/.test( name.value ) ) {
						tipUpper( name, "Пожалуйста, введите свое имя" );
						return false;
					}

					if ( /^\s*$/.test( text.value ) ) {
						tipUpper( text, "Пожалуйста, введите текст" );
						return false;
					}

					sendDialogWaiter.show( true );
					msgsDialogWaiter.show( true, false );

					refresh(
						{
							mode: "post",
							lastMod: 0,
							name: name.value,
							text: text.value
						},
						function( state, status, txt ) {
							if ( state ) {
								text.value = "";
								ah( text );
							}
							sendDialogWaiter.show( false );
							msgsDialogWaiter.show( false );
						}
					);

					return false;
				};

				msgs.onclick = function( e ) {
					if ( !e ) e = window.event;

					var s = e.srcElement || e.target;
					if ( s.tagName == "A" ) return;

					for ( var i = 0; i < 4; i++ ) {
						if ( !s || s.className.indexOf( "msg" ) >= 0 ) break;
						s = s.parentNode;
					}

					if ( s && s.className.indexOf( "msg" ) >= 0 ) {
						var ps = s.getElementsByTagName( "span" );
						var name = ps[0].innerText || ps[0].textContent;
						var misc = ps[1].innerText || ps[1].textContent;
						var txt = "";
						s = s.firstChild.nextSibling;
						while ( s ) {
							if ( s.tagName ) txt += s.tagName == "BR" ? "\n" : s.innerText || s.textContent;
							else txt += s.nodeValue;
							s = s.nextSibling;
						}

						if ( text.value ) text.value += "\n";
						text.value += ">" + name + " " + misc + "\n" + txt.replace( /(^|\n)/g, "$1>" );
					}
				};

				// при скроле вверх снимает галочку о автопрокрутке вниз
				msgs.onscroll = function() {
					oAS.checked = false;
				};

				name.onkeydown = text.onkeydown = function( e ) {
					if ( sendDialogWaiter.isShow() ) return;
					if ( !e ) e = window.event;
					if ( e.keyCode === 13 && e.ctrlKey ) f.onsubmit();
				};

				if ( oAS.checked ) scrollBottom();

				text.focus();

				poll( false, true );

				
			} )();

			function clear_chat() {
					
			}
		</script>
		<script>
        

        // Получение всех слайдов, для каждого устанавливается автоматическое сохранение 
document.addEventListener('DOMContentLoaded', function() {
  var slides = document.getElementsByClassName('slide');
  for (var i = 0; i < slides.length; i++) {
    (function(slideId) {
      setInterval(function() {
        autoSaveSlideContent(slideId);
      }, 10000);
    })(slides[i].id);
  }
});

            // JavaScript-код для отображения и добавления слайдов
            document.getElementById('addSlideButton').addEventListener('click', addSlide);

// Функция для добавления слайда
function addSlide() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../components/add_slide.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                loadSlides(); // После добавления слайда обновляем список слайдов
            } else {
                alert('Произошла ошибка при добавлении слайда в базу данных.');
            }
        }
    };
    // Также отправляем id презентации, к которой привязан слайд
    xhr.send('pr_id=<?php echo $_GET["id"]; ?>');
}

 // Функция для удаления слайда
 function deleteSlide(slideId) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../components/delete_slide.php?id=' + slideId, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                loadSlides(); // После удаления слайда обновляем список слайдов
            } else {
                alert('Произошла ошибка при удалении слайда.');
            }
        }
    };
    xhr.send();
}


function loadSlides() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../components/get_slides.php?id=<?php echo $_GET["id"]; ?>', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById('slideContainer').innerHTML = xhr.responseText;
                let smallSlides = document.querySelectorAll('.small-slide');
                smallSlides.forEach(slide => {
                    var slideId = slide.firstChild.textContent;
                    slide.addEventListener('click', function() {
                        loadSlideContent(slideId);
                        toggleHover(slide);
                        smallSlides.forEach(otherSlide => {
                            if (otherSlide !== slide) {
                                otherSlide.classList.remove('hover');
                            }
                        });
                    });

                    var deleteButton = slide.lastChild;
                    deleteButton.addEventListener('click', function(event) {
                        event.stopPropagation();
                        deleteSlide(slideId);
                    });
                });
            } else {
                alert('Произошла ошибка при получении списка слайдов.');
            }
        }
    };
    xhr.send();
}

function toggleHover(element) {
    element.classList.toggle('hover');
}


var activeSlideId = null;

// Функция для загрузки содержимого конкретного слайда
// function loadSlideContent(slideId) {
//     var xhr = new XMLHttpRequest();
//     xhr.open('GET', '../components/get_slide_content.php?id=' + slideId, true);
//     xhr.onreadystatechange = function() {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 document.getElementById('activeSlide').innerHTML = xhr.responseText;
//                 // Устанавливаем текущий активный слайд
//                 activeSlideId = slideId;
//             } else {
//                 alert('Произошла ошибка при получении содержимого слайда.');
//             }
//         }
//     };
//     xhr.send();
// }

// Функция для сохранения содержимого слайда
function saveSlideContent(slideId) {
if (!slideId) {
console.error("Ошибка: slideId не был предоставлен.");
return;
}

var slideContent = document.getElementById('activeSlide').innerHTML;
var xhr = new XMLHttpRequest();
var url = "../components/save_slide_content.php"; // Это endpoint, куда будет отправлен запрос
var params = "id=" + slideId + "&content=" + encodeURIComponent(slideContent);
xhr.open("POST", url, true);

// Установка заголовка Content-Type для отправки данных формы
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

xhr.onreadystatechange = function () {
if (xhr.readyState === 4 && xhr.status === 200) {
  console.log(xhr.responseText);
}
};

xhr.send(params);
}

// Функция для отправки содержимого слайда на сервер и его сохранения
function saveSlideContentToServer(slideId, slideContent) { 
  var xhr = new XMLHttpRequest(); 
  var url = "../components/save_slide_content.php"; // Это endpoint, куда будет отправлен запрос 
  var params = "id=" + slideId + "&content=" + encodeURIComponent(slideContent); 
  xhr.open("POST", url, true); 

  // Установка заголовка Content-Type для отправки данных формы 
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 

  xhr.onreadystatechange = function () { 
    if (xhr.readyState === 4 && xhr.status === 200) { 
      console.log(xhr.responseText);
    } 
  }; 

  xhr.send(params); 
} 
// Функция для автоматического сохранения содержимого активного слайда через каждые 10 секунд
function autoSaveSlideContent() {
    setInterval(function() {
        if (activeSlideId) {
            saveSlideContent(activeSlideId);
        }
    }, 1000); // 10 секунд в миллисекундах
}



// Загружаем список слайдов при загрузке страницы
document.addEventListener('DOMContentLoaded', loadSlides);

    </script>
 <script src="../js/questions.js"></script>
	</body>
</html>