<!DOCTYPE html>
<html lang="ru">
<head>
	<title>Реафит-Про</title>
	<meta charset="utf-8">
	<link rel="apple-touch-icon-precomposed" href="/home/favicon.png">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="Программное обеспечение для создания персонализированных программ тренировок. Cоздавайте комплексы упражнений, одобренные профессионалами">
	<style>
* {
	margin: 0;
	padding: 0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
body {
	color: #333;
	font: 14px/18px 'Open Sans', sans-serif;
	position: relative;
	-webkit-text-size-adjust:none;
	-webkit-overflow-scrolling: touch;
	min-width: 320px;
}
a {
	color: inherit;
	text-decoration: none;
}
a:hover {
	cursor: pointer;
	text-decoration: none !important
}
:focus,
:active {
	outline:none
}
::-moz-selection {
	color: #fff;
	background: #ff7c66;
}
*::selection {
	color: #fff;
	background: #ff7c66;
}
img {
	border: 0;
	max-width: 100%;
	position: relative;
	vertical-align: top;
}
li {
	list-style: none;
	position: relative;
}
header, main, nav, section, article, aside, footer {
	display:block;
	position: relative;
}
.clr:after {
	clear: both;
	content: '';
	display: table;
}

.center {
	margin: 0 auto;
	max-width: 1200px;
	position: relative;
}

.input {
	vertical-align: middle;
	padding: 10px 50px;
	width: 100%;
	height: 45px;
	font: 16px/22px 'Open Sans', sans-serif;
	position: relative;
	-webkit-appearance: none;
	color: #4f7c89;
	border: solid 2px #e0e0e0;
	border-radius: 4px;
	background: #fff;
	display: block;
	margin-bottom: 16px;
	-webkit-appearance: none;
}
::-moz-placeholder {
	opacity: 1;
}
:-ms-input-placeholder {
	opacity: 1;
}
::-webkit-input-placeholder {
	opacity: 1;
}
.input:focus::-moz-placeholder {
	color: #e0e0e0;
	opacity: 1;
}
.input:focus:-ms-input-placeholder {
	color: #e0e0e0;
	opacity: 1;
}
.input:focus::-webkit-input-placeholder {
	color: #e0e0e0;
	opacity: 1;
}
.input::-ms-clear {
	display: none
}

/* btn
-----------------------------------------------------------------------------*/
.btn {
	display:inline-block;
	cursor: pointer;
	text-align: center;
	padding:0 33px;
	height: 70px;
	line-height: 70px;
	font-size: 24px;
	font-weight: 600;
	position: relative;
	color: #fff;
	text-transform: uppercase;
	white-space: nowrap;
	border-radius: 5px;
	background: #ff7c66;
}
.btn:before {
	position: absolute;
	height: 8px;
	left: 0;
	right: 0;
	bottom: 0;
	content: '';
	background: #e56f5c;
	border-radius: 0 0 5px 5px;
}
.btn:hover {
	background: #c54c38;
}
.btn:hover:before {
	background: #b14432;
}
.btn:active {
	top: 1px;
}
.btn--form {
	padding:0 48px;
	height: 54px;
	line-height: 54px;
	font-size: 14px;
	font-weight: 400;
	background: #5ba6b9;
}
.btn--form:before {
	background: #5295a6;
}
.btn--form:hover {
	background: #467e8d;
}
.btn--form:hover:before {
	background: #3f717f;
}

.btn--video {
	background: none;
	font-weight: 400;
	border: 1px solid;
	border-radius: 6px;
	height: 72px;
	padding-left: 68px;
	padding-right: 28px;
}
.btn--video:before {
	top: 20px;
	left: 20px;
	width: 36px;
	height: 28px;
	right: auto;
	bottom: auto;
	background: url(/home/images/sprite.png) -34px -185px !important;
}
.btn--video:hover {
	background: rgba(54,54,54,.3);
}

.btn input {
	position: absolute;
	top: 0;
	left: 0;
	width: 0;
	height: 0;
	z-index: -1;
	opacity: 0
}

.arrow:after {
	position: absolute;
	left: 50%;
	top: 0;
	margin-left: -800px;
	content: '';
	border-style: solid;
	border-width: 218px 800px 0;
	border-color: #f0f3f6 transparent;
}
.arrow--white:after {
	border-color: #fff transparent;
}
.arrow--bottom:after {
	top: auto;
	bottom: 0;
}
.arrow--revers:after {
	border-color: transparent #f0f3f6;
}
.arrow--revers.arrow--white:after {
	border-color: transparent #fff;
}

.hide {
	display: none;
}

/* header
-----------------------------------------------------------------------------*/
.header {
	padding: 18px 20px 16px;
	background: #fff;
}
.header .center{
	max-width: 1530px;
	padding: 0 220px;
}
.header__logo {
	width: 180px;
	height: 45px;
	top: 5px;
	left: 12px;
	z-index: 1;
	position: absolute;
	background: url(/home/images/sprite.png) -30px -26px;
}
.header .btn {
	position: absolute;
	top: 0;
	left: 100%;
	margin-left: 60px;
}

.header__menu {
	text-align: center;
}
.header__menu li{
	display: inline-block;
}
.header__menu a {
	display: block;
	text-transform: uppercase;
	line-height: 28px;
	margin: 14px 16px;
}
.header__menu a:hover {
	color: #f17767;
	text-decoration: underline !important;
}

/* block-1
-----------------------------------------------------------------------------*/
main {
	overflow: hidden;
}
.block-1 {
	color: #fff;
	text-align: center;
	padding-top: 72px;
	height: 882px;
	position: relative;
	background: #46707e;
}
.block-1:before {
	position: absolute;
	height: 218px;
	left: 0;
	right: 0;
	bottom: 0;
	content: '';
	background: #f0f3f6;
}
.block-1 .center{
	z-index: 1;
}
.block-1__bg {
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background: url(/home/images/block-1.jpg) center 0 no-repeat;
	background-size: 1600px auto;
}
.block-1__bg:before {
	position: absolute;
	height: 244px;
	top: 0;
	left: 0;
	right: 0;
	content: '';
	background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAD0CAYAAAEtTXy1AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTExIDc5LjE1ODMyNSwgMjAxNS8wOS8xMC0wMToxMDoyMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTUgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkE4RjNBQkZCNkJDQzExRTY4MkQzOEI3NUY5OENBRTk3IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkE4RjNBQkZDNkJDQzExRTY4MkQzOEI3NUY5OENBRTk3Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6QThGM0FCRjk2QkNDMTFFNjgyRDM4Qjc1Rjk4Q0FFOTciIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6QThGM0FCRkE2QkNDMTFFNjgyRDM4Qjc1Rjk4Q0FFOTciLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz5O0PqfAAAAcUlEQVR42mJgYGCQZAIS/+EEAyoXpxiZBE6jGJhhshAAEEAgIIFFBwP1rCRWB8RpYAAQQAwoAcaAqpgILn4WSYopYVGiBJ3LjCKBFoMMAAEGDzBspjAQlmAgT+9/qphCkvGDSWwAFFOsDWtCwpuuIAAAFMRc3QeW+UAAAAAASUVORK5CYII=);
}
.block-1 h2:before {
	width: 72px;
	height: 72px;
	content: '';
	display: block;
	margin: 0 auto 48px;
	background: url(/home/images/sprite.png) -327px -33px;
}
.block-1 h2{
	text-transform: uppercase;
	line-height: 54px;
	font-size: 27px;
	font-weight: 300;
}
.block-1 h2 span{
	display: block;
	line-height: 59px;
	font-size: 50px;
	font-weight: 800;
}
.block-1 h2:after{
	height: 2px;
	display: block;
	content: '';
	width: 700px;
	max-width: 100%;
	margin: 48px auto 0;
	background: -webkit-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,.5) 40%, rgba(255,255,255,.6) 50%, rgba(255,255,255,.5) 60%, rgba(255,255,255,0) 100%);
	background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,.5) 40%, rgba(255,255,255,.6) 50%, rgba(255,255,255,.5) 60%, rgba(255,255,255,0) 100%);
}
.block-1 p{
	font-size: 20px;
	font-weight: 300;
	line-height: 30px;
	padding: 30px 250px;
}
.block-1 .btn{
	margin: 48px 10px;
}


@media only screen and (max-width:480px){

.block-1__bg {
	background-image: url(/home/images/block-1__480.jpg);
	background-size: cover;
}
.block-form {
	background: #46707e !important;;
}

}



	</style>
</head>

<body>

	<header id="header" class="header">

		<div class="center clr">

			<div class="header__fixed">

				<nav class="header__nav">

					<ul class="header__menu">
						<li><a href="#o-reafit">О ReaFit</a></li>
						<li><a href="#function">Функции</a></li>
						<li class="hidden-sm"><a href="#present">Презентация</a></li>
						<li><a href="#for">Для кого это?</a></li>
						<li class="hidden-md"><a href="#clients">Клиенты</a></li>
						<li><a href="#contact">Контакты</a></li>
					</ul>

					<a class="header__btn btn btn--form" href="https://reafit-pro.ru/login">Войти</a>
					<a class="header__btn btn hide" href="https://reafit-pro.ru/registration">Попробовать</a>

				</nav>

			</div>

			<a class="header__logo" href="/"></a>

			<a class="menu-mobile-toggle">
				<span class="menu-mobile-toggle__line"></span>
			</a>

		</div>

	</header>

	<main class="main">

		<article class="block-1" id="o-reafit">

			<div class="center">

				<h2>Инновационное программное обеспечение <span>для создания персонализированных программ тренировок</span></h2>

				<p>Быстро и просто создавайте персонализированные комплексы упражнений, выбирая более чем из 1000 упражнений, одобренных профессионалами!</p>

				<a class="btn hidden-sm" href="https://reafit-pro.ru/registration">Попробуйте сейчас</a>
				<a class="btn btn--video" href="#present" data-src="https://www.youtube.com/embed/32bmDcsPv70?autohide=1&amp;autoplay=1&amp;rel=0&amp;theme=light">Посмотрите видео</a>

			</div>

			<span class="block-1__bg parallax arrow arrow--revers arrow--bottom"></span>

		</article>

		<article>

			<div class="block-2" id="function">

				<div class="center">

					<h2 class="hidden-sm">Функции</h2>

					<p>На что способно приложение</p>

					<ul class="clr">
						<li>
							<strong>Большой выбор <br>упражнений</strong>
							Комбинируйте программу из более чем 1000 упражнений, созданных лучшими специалистами, и добавляйте собственные.
						</li>
						<li>
							<strong>Персонализированные <br>программы тренировок</strong>
							Создавайте индивидуальные программы тренировок, полностью соответствующие запросу вашего клиента.
						</li>
						<li>
							<strong>Лучшие специалисты, <br>лучший результат</strong>
							Все упражнения и описания к ним  разработаны и составлены лучшими специалистами в области pеабилитации и фитнеса.
						</li>
						<li>
							<strong>Сохранение или отправка <br>по электронной почте</strong>
							После создания программы вы можете сохранить её в библиотеке или отправить на почтовый ящик клиента.
						</li>
						<li>
							<strong>Длительное <br>сопровождение клиента</strong>
							Получая обратную связь от клиента, вы можете корректировать программу в соответствии с динамикой процесса.
						</li>
						<li>
							<strong>Командное <br>взаимодействие</strong>
							Специалисты, использующие «Reafit pro», могут делиться между собой лучшими комплексами упражнений, обмениваться знаниями и опытом.
						</li>
						<li>
							<strong>Экономия ваших <br>сил и времени</strong>
							Удобные функции поиска подходящих упражнений и простой интерфейс сэкономят ваше время и силы.
						</li>
						<li>
							<strong>Оформление программ <br>на бланках предприятия </strong>
							Вы можете настроить ваш аккаунт, добавив контакты вашего учреждения или данные специалиста, создавшего программу.
						</li>
						<li>
							<strong>Удобная база данных <br>по вашим клиентам</strong>
							Программа позволяет сохранять данные о вашем клиенте, что особенно важно при длительном взаимодействии с клиентом.
						</li>
					</ul>

				</div>

			</div>

			<div class="block-3 center hidden-sm arrow">

				<div class="clr">

					<img src="/home/images/block-3.png" srcset="/home/images/block-3__2x.png 2x" alt="функции реафит">

					<p class="clr">
						<span class="block-3__selected"> Создавайте, редактируйте, комментируйте, сохраняйте</span>
						<span class="block-3__selected"> или отправляйте на email вашему клиенту. Программа позволяет</span>
						<span>вам или вашему персоналу быстро и просто создавать</span>
						<span>персонализированные комплексы упражнений, выбирая более чем</span>
						<span>из 1000 упражнений, одобренных профессионалами.</span>
						<span>Возможно напечатать и выдать клиенту на руки, либо отправить</span>
						<span>на его электронную почту.</span>
					</p>

				</div>

			</div>

			<div class="block-4 hidden-md">

				<div class="center">

					<div class="block-4__img">
						<img src="/home/images/block-4_1.jpg" width="313" srcset="/home/images/block-4_1__1x.jpg 1x, /home/images/block-4_1__2x.jpg 2x" alt="реафит всегда на связи">
						<img src="/home/images/block-4_2.jpg" width="313" srcset="/home/images/block-4_2__1x.jpg 1x, /home/images/block-4_2__2x.jpg 2x" alt="реафит всегда на связи">
					</div>

					<h3>Оставайтесь всегда на связи <span>с Вашими клиентами</span></h3>

					<p>Программа REAFIT синхронизирует  работу клиента с персональным тренером, повышая эффективность и качество тренировок. <br>Получая обратную связь от клиента, вы можете корректировать программу в соответствии с динамикой процесса, не зависимо от того, на сколько далеко клиент находится от вас. Контролируя и поддерживая тренировочный процесс, вы можете легко мотивировать клиента на систематичные тренировки и достижение поставленных задач.</p>

				</div>

			</div>

			<div class="block-5 hidden-sm arrow arrow--white">

				<div class="center">

					<h3>Создать программу тренировки <span>быстро и просто</span></h3>

					<p>Экономьте время и энергию, создавая быстро и профессионально программы тренировок, в любое время, в любом месте и на любом удобном девайсе. Достаточно написать фокус упражнения, тип тренировки и выбрать исходное положение в нашем умном модуле поиска и программа предложит вам наиболее подходящие варианты. Выберите из предложенного списка наиболее подходящие упражнения для вашего клиента, либо используйте готовый шаблон, созданный профессионалами в данной области.</p>

				</div>

			</div>

		</article>

		<aside class="video-player hidden-sm" id="present">

			<div class="video-player__box">

				<iframe id="youtube" src="https://www.youtube.com/embed/32bmDcsPv70?rel=0&amp;showinfo=0" allowfullscreen></iframe>

			</div>

			<a class="btn" href="https://reafit-pro.ru/registration">Попробуйте сейчас</a>
			<p class="video-player__text">Демонстрационная версия бесплатно!</p>

		</aside>

		<article class="block-6 arrow">

			<div class="block-6__img arrow arrow--revers arrow--bottom arrow--white hidden-md">
				<img src="/home/images/block-6_1.jpg" width="800" srcset="/home/images/block-6_1__1x.jpg 1x, /home/images/block-6_1__2x.jpg 2x" alt="реафит для реабилитации">
				<img src="/home/images/block-6_2.jpg" width="800" srcset="/home/images/block-6_2__2x.jpg 1x, /home/images/block-6_2__2x.jpg 2x" alt="реафит для фитнеса">
			</div>

			<div class="center clr" id="for">

				<div class="block-6__left">

					<h2>Reafit <span>для реабилитации</span></h2>

					<p>В разделе реабилитация представлен большой выбор  упражнений для  восстановительного лечения больных с различными заболеваниями и повреждениями нервной системы, опорно- двигательного аппарата, внутренних органов, сердечно- сосудистой системы и органов дыхания. <br>В программу включены  шаблоны восстановительных  программ,  разработанные ведущими отечественными и зарубежными специалистами. Авторы приложили все усилия, чтобы максимально корректно описать упражнения и рекомендации по их выполнению.</p>

					<h3>Эта программа будет полезна:</h3>

					<ul>
						<li>Врачам спортивной медицины</li>
						<li>Физиотерапевтам и специалистам ЛФК</li>
						<li>Мануальным терапевтам</li>
						<li>Остеопатам</li>
						<li>Эрготерапевтам</li>
					</ul>

				</div>

				<div class="block-6__right">

					<h2>Reafit <span>для фитнеса</span></h2>

					<p>В разделе фитнес представлены упражнения на разные группы мышц, разной сложности,  на различных тренажерах. Вы можете создавать комплексные программы тренировок, состоящие из разных по типу и виду упражнений, рассчитанных на длительный период времени. Вам достаточно выбрать часть тела, тип и сложность, после чего программа подберёт для вас наиболее подходящие упражнения. <br>Также вы можете добавлять в программу тренировок новые упражнения непосредственно в процессе занятия вашего клиента, используя  планшет либо смартфон.</p>

					<h3>Эта программа будет полезна:</h3>

					<ul>
						<li>Спортивным тренерам</li>
						<li>Фитнес тренерам</li>
						<li>Инструкторам по йоге</li>
						<li>Инструкторам по пилатесу</li>
						<li>Тренерам по функциональным тренировкам</li>
					</ul>

				</div>

			</div>

		</article>

		<aside class="block-7 hidden-md arrow arrow--white" style="display:none">

			<div class="center">

				<h4 id="clients">Нашими клиентами уже являются</h4>

				<div>

					<img src="/home/images/client-1.jpg" srcset="/home/images/client-1__2x.png 2x" alt="Клиент реафит">
					<img src="/home/images/client-2.jpg" srcset="/home/images/client-2__2x.png 2x" alt="Клиент реафит">
					<img src="/home/images/client-3.jpg" srcset="/home/images/client-3__2x.png 2x" alt="Клиент реафит">

				</div>

				<a class="btn" href="https://reafit-pro.ru/registration">Попробуйте сейчас</a>

			</div>

		</aside>

		<form class="block-form arrow arrow--white">

			<div class="center">

				<h2 class="hidden-md">Инновационное программное обеспечение <span>для создания персонализированных программ тренировок</span></h2>

				<div class="block-form__box" id="contact">

					<h4>Оставьте заявку на обратный звонок</h4>

					<input class="input block-form__name" placeholder="Ваше имя">
					<input class="input block-form__tel" placeholder="Номер телефона" type="tel">
					<label class="btn btn--form">Отправить заявку<input type="submit"></label>

					<div class="block-form__send">
						Ваша заявка зарегистрирована. <br> Наши сотрудники свяжутся с Вами.<br> дополнительные контакты <a href="https://reafit-pro.ru/feedback">Обратная связь</a>
					</div>

				</div>

			</div>

		</form>

	</main>

	<footer id="footer" class="footer hidden-sm">

		<div class="center clr">

			<ul class="footer__menu">
				<li><a>Контакты</a></li>
				<li><a>Правовая информация</a></li>
				<li><a>Лицензионная политика</a></li>
				<li><a>Сотрудничество</a></li>
			</ul>

			<p class="copyright">© Реафит-Про, 2016</p>

		</div>

	</footer>

	<style>
/* block-2
-----------------------------------------------------------------------------*/
.block-2 {
	position: relative;
	background: #f0f3f6;
	padding: 84px 0;
}
.block-2 h2 {
	color: #000;
	font-size: 24px;
	font-weight: 300;
	line-height: 30px;
	text-transform: uppercase;
	text-align: center;
}
.block-2 p {
	text-transform: uppercase;
	text-align: center;
	line-height: 59px;
	font-size: 40px;
	font-weight: 800;
	color: #316e7d
}
.block-4 h3:after,
.block-2 p:after{
	height: 1px;
	display: block;
	content: '';
	width: 700px;
	max-width: 100%;
	margin: 12px auto 90px;
	background: -webkit-linear-gradient(left, rgba(0,0,0,0) 0%, rgba(0,0,0,.5) 40%, rgba(0,0,0,.6) 50%, rgba(0,0,0,.5) 60%, rgba(0,0,0,0) 100%);
	background: linear-gradient(to right, rgba(0,0,0,0) 0%, rgba(0,0,0,.1) 30%, rgba(0,0,0,.1) 50%, rgba(0,0,0,.1) 70%, rgba(0,0,0,0) 100%);
}
.block-2 li{
	width: 365px;
	float: left;
	color: #666;
	font-size: 16px;
	line-height: 19px;
	padding: 13px 0 26px 14px
}
.block-2 li:nth-child(3n+4){
	clear: both;
}
.block-2 li:nth-child(3n+2){
	width: 345px;
	margin-left: 36px;
}
.block-2 li:nth-child(3n+3){
	width: 400px;
	float: right;
}
.block-2 strong {
	color: #000;
	font-size: 18px;
	font-weight: 600;
	line-height: 22px;
	display: block;
	padding: 2px 0 28px;
}
.block-2 li:before{
	width: 70px;
	height: 100px;
	display: block;
	content: '';
	background: url(/home/images/sprite.png);
}
.block-2 li:nth-child(1):before{
	background-position: -63px -314px;
}
.block-2 li:nth-child(2):before{
	background-position: -218px -314px;
}
.block-2 li:nth-child(3):before{
	background-position: -373px -314px;
}
.block-2 li:nth-child(4):before{
	width: 64px;
	background-position: -517px -314px;
}
.block-2 li:nth-child(5):before{
	width: 64px;
	background-position: -654px -314px;
}
.block-2 li:nth-child(6):before{
	width: 84px;
	background-position: -68px -462px;
}
.block-2 li:nth-child(7):before{
	width: 62px;
	background-position: -206px -468px;
}
.block-2 li:nth-child(8):before{
	width: 62px;
	background-position: -340px -468px;
}
.block-2 li:nth-child(9):before{
	width: 62px;
	background-position: -474px -468px;
}

/* block-3
-----------------------------------------------------------------------------*/
.block-3 {
	padding: 348px 0 55px;
	position: relative;
}
.block-3 img {
	float: left;
	margin: 0 66px 0 23px;
}
.block-3 p {
	overflow: hidden;
	color: #333;
	font-size: 18px;
	line-height: 36px;
	padding: 45px 0;
}
.block-3 p span{
	float: left;
	padding: 0 10px;
}
.block-3__selected {
	color: #fff;
	background: #ff7c66;
}


/* block-4
-----------------------------------------------------------------------------*/
.block-4 {
	text-align: center;
	padding: 124px 0 48px;
	background: -webkit-linear-gradient(top, #f2f2f2 0%, #ffffff 100%);
	background: linear-gradient(to bottom, #f2f2f2 0%, #ffffff 100%);
}
.block-4__img {
	width: 1015px;
	height: 339px;
	background: url(/home/images/block-4__bg.png) no-repeat bottom;
	background-size: contain;
	margin: auto;
	position: relative;
}
.block-4__img img{
	border-radius: 50%;
	position: absolute;
	top: 0;
	left: 680px;
}
.block-4__img img:first-child{
	left: 16px;
}
.block-4 h3 {
	color: #499cb2;
	font-size: 36px;
	line-height: 43px;
	padding: 87px 0 0;
	font-weight: 800;
	letter-spacing: -.3px;
	text-transform: uppercase;
}
.block-4 h3 span {
	color: #000;
	display: block;
	font-weight: 400;
}
.block-4 h3:after{
	margin: 30px auto;
}
.block-4 p {
	color: #666;
	font-size: 18px;
	line-height: 30px;
	padding: 17px 213px;
	text-align: left;
}

/* block-5
-----------------------------------------------------------------------------*/
.block-5 {
	text-align: center;
	padding: 382px 0 0;
	background: #f0f3f6;
	position: relative;
}
.block-5 h3 {
	color: #000;
	font-size: 40px;
	line-height: 52px;
	font-weight: 800;
	letter-spacing: -1px;
}
.block-5 h3 span {
	color: #499cb2;
	display: block;
	font-size: 60px;
	text-transform: uppercase;
	letter-spacing: -1.5px;
}
.block-5 p {
	color: #666;
	font-size: 18px;
	line-height: 30px;
	padding: 60px 84px;
	text-align: left;
}


/* video-player
-----------------------------------------------------------------------------*/
.video-player {
	padding: 29px 0 0;
	text-align: center;
	background: url(/home/images/video-player.png) center 12px no-repeat #f0f3f6;
	background-size: 1397px 750px;
}
.video-player__box {
	width: 1024px;
	height: 576px;
	height: 700px;
	margin: 0 auto 127px;
	position: relative;
	background: #fff;
}
.video-player p {
	color: #666;
	font-weight: 300;
	font-size: 18px;
	padding: 40px 0 0;
	letter-spacing: -.5px;
}
.video-player__box iframe {
	height: 700px;
	width: 1024px;
	display: block;
	border: 0
}

/* block-6
-----------------------------------------------------------------------------*/
.block-6__img {
	display: block;
	height: 832px;
	position: relative;
	overflow: hidden;
}
.block-6__img img {
	position: absolute;
	top: 0;
	left: 50%;
	margin-left: -1px;
}
.block-6__img img:first-child{
	margin-left: -800px;
}
.block-6:before {
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	content: '';
	height: 614px;
	background: -webkit-linear-gradient(left, #499cb2 0%, #499cb2 50%, #ff7c66 50%, #ff7c66 100%);
	background: linear-gradient(to right, #499cb2 0%, #499cb2 50%, #ff7c66 50%, #ff7c66 100%);
}
.block-6 .center {
	padding: 72px 0 64px;
}
.block-6 .center:before {
	position: absolute;
	top: 0;
	margin-left: -1px;
	left: 50%;
	width: 1px;
	height: 800px;
	content: '';
	background: -webkit-linear-gradient(top, rgba(0,0,0,.15) 0, rgba(0,0,0,0) 100%);
	background: linear-gradient(to bottom, rgba(0,0,0,.15) 0, rgba(0,0,0,0) 100%);
}
.block-6__left {
	float: left;
	width: 520px;
	position: relative;
	left: 14px;
}
.block-6__right {
	float: right;
	width: 500px;
	position: relative;
	left: -16px;
}
.block-6 h2 {
	font-weight: 400;
	color: #555;
	font-size: 24px;
	line-height: 26px;
	text-transform: uppercase;
	padding-bottom: 57px;
}
.block-6 h2 span {
	display: block;
	color: #499cb2;
	font-weight: 800;
	font-size: 40px;
	line-height: 42px;
}
.block-6 p {
	color: #666;
	min-height: 200px;
	font-size: 18px;
	line-height: 36px;
	padding-bottom: 34px;
}
.block-6 h3 {
	color: #499cb2;
	font-weight: 800;
	font-size: 24px;
	line-height: 36px;
	padding-bottom: 38px;
}
.block-6 li {
	padding-left: 27px;
	color: #666;
	font-size: 18px;
	line-height: 36px;
}
.block-6 li:before {
	position: absolute;
	width: 20px;
	height: 20px;
	top: 8px;
	left: -2px;
	content: '';
	background: url(/home/images/sprite.png) -252px -188px;
}
.block-6__right h3,
.block-6__right h2 span {
	color: #ff7c66;
}


/* block-7
-----------------------------------------------------------------------------*/
.block-7 {
	background: #f0f3f6;
	text-align: center;
	z-index: 1;
}
.block-7 h4{
	color: #333;
	font-weight: 800;
	font-size: 40px;
	line-height: 46px;
	padding: 306px 0 56px;
	text-transform: uppercase;
}
.block-7 .btn{
	margin-top: 38px;
	-webkit-transform: translateY(62px);
	transform: translateY(62px);
}

/* block-form
-----------------------------------------------------------------------------*/
.block-form {
	position: relative;
	padding-top: 323px;
	height: 1000px;
	background: url(/home/images/block-form.jpg) no-repeat top #46707e;
	background-size: 1600px auto;
	background-size: cover;
}
.block-form h2 {
	color: #fff;
	font-size: 30px;
	line-height: 40px;
	font-weight: 400;
	text-transform: uppercase;
	text-align: center;
}
.block-form h2 span{
	display: block;
	font-weight: 800;
}
.block-form h2:after {
	display: block;
	width: 256px;
	height: 52px;
	margin: 40px auto 86px;
	content: '';
	background: url(/home/images/sprite.png) -32px -94px;
}
.block-form__box {
	border-radius: 8px;
	width: 350px;
	padding: 20px;
	margin: auto;
	background: #fff;
}
.block-form__box h4 {
	color: #000;
	font-size: 21px;
	line-height: 24px;
	font-weight: 600;
	padding-bottom: 36px;
	text-transform: uppercase;
	text-align: center;
}
.block-form__box .btn {
	display: block;
	margin-top: 48px;
	font-size: 21px;
	padding: 0 0 0 40px;
	text-align: left;
	line-height: 50px;
	text-transform: none;
}
.block-form__box .btn:after {
	width: 26px;
	height: 26px;
	position: absolute;
	top: 14px;
	right: 22px;
	content: '';
	background: url(/home/images/sprite.png) -112px -186px;
}
.block-form__tel,
.block-form__name {
	background-repeat: no-repeat;
	background-position: -748px 0;
	background-image: url(/home/images/sprite.png);
}
.block-form__tel {
	background-position: -748px -43px;
}

.block-form__send,
.block-form--send .btn {
	display: none;
}
.block-form--send .block-form__send {
	color: #000;
	padding-left: 10px;
	display: block;
}
.block-form__send a {
	text-decoration: underline;
}

/* page
-----------------------------------------------------------------------------*/
.main--page {
	max-width: 960px;
	padding: 50px 0;
}
.main--page h1{
	font-weight: 600;
	text-align: center;
}

/* footer
-----------------------------------------------------------------------------*/
.footer {
	padding: 40px 0;
	background: #1f3439;
}
.copyright {
	text-align: center;
	line-height: 20px;
	color: #fff;
	font-size: 14px;
	float: left;
}
.footer__menu{
	float: right;
}

.footer__menu li{
	float: left;
	padding: 0 10px;
	border-left: 1px solid #fff;
}
.footer__menu li:first-child{
	border-left: 0;
}
.footer__menu a{
	height: 12px;
	display: block;
	line-height: 10px;
	font-size: 12px;
	color: #fff;
}
.footer__menu a:hover{
	border-bottom: 1px solid;
}



/*Retina graphics!*/
@media only screen and (-webkit-min-device-pixel-ratio: 1.5),
	   only screen and (min--moz-device-pixel-ratio: 1.5),
	   only screen and (min-device-pixel-ratio: 1.5){

	.header__logo,
	.block-1 h2:before,
	.block-2 li:before,
	.block-6 li:before,
	.block-form h2:after,
	.block-form__tel,
	.block-form__name,
	.block-form__box .btn:after {
		background-image: url(/home/images/sprite2x.png);
		background-size: 800px 800px;
	}

}


/* 1200
----------------------------------------*/
@media only screen and (min-width:1200px){

.block-1 {
	background-image: url(/home/images/block-1__2x.jpg);
}
.block-form {
	background-image: url(/home/images/block-form__2x.jpg);
}

}

/* 1200
----------------------------------------*/
@media only screen and (max-width:1200px){

	.center {
		max-width: 960px;
	}
	body {
		left: 0;
		transition: left 1s;
	}
	.menu-mobile-show {
		left: -320px;
	}

	.arrow:after {
		margin-left: -600px;
		border-width: 100px 600px 0;
	}

	.header {
		padding: 0;
		height: 96px;
	}
	.header .center {
		padding: 0;
	}
	.header__logo {
		margin: 0 auto;
		display: block;
		position: relative;
		left: 0;
		top: 26px;
	}
	.header__fixed {
		position: fixed;
		top: 0;
		right: 0;
		width: 0;
		height: 100%;
		background: #fff;
		overflow: hidden;
		z-index: 8;
		transition: width 1s;
	}
	.header__nav {
		white-space: nowrap;
		width: 320px;
		position: absolute;
		top: 0;
		left: 0;
		height: 100%;
		border-left: 1px solid #e1e1e1;
	}
	.menu-mobile-show .header__fixed {
		width: 320px;
	}
	.header__menu {
		padding: 60px 0 20px;
	}
	.header__menu li {
		display: block;
		text-align: left;
		margin-left: 4px;
		border-bottom: 1px solid #deedf1;
	}
	.header__menu a {
		color: #000;
		font-size: 18px;
		padding: 5px 0 5px 40px;
	}
	.header .btn {
		margin: 20px 48px 0;
		display: block;
		font-size: 18px;
		position: relative;
		left: 4px;
		padding: 0;
		height: 54px;
		line-height: 54px;
	}

	.menu-mobile-toggle {
		position: fixed;
		top: 0;
		z-index: 9;
		right: 0;
		width: 96px;
		height: 96px;
	}
	.menu-mobile-toggle__line {
		position: absolute;
		width: 40px;
		height: 6px;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		margin: auto;
		background-color: #5ba6b9;
		-webkit-transition: background-color .4s ease 1s;
		transition: background-color .4s ease 1s;
	}
	.menu-mobile-toggle__line:after,
	.menu-mobile-toggle__line:before {
		position: absolute;
		top: -15px;
		left: 0;
		right: 0;
		height: 6px;
		content: '';
		background-color: #5ba6b9;
		-webkit-transition: all .4s ease 1s;
		transition: all .4s ease 1s;
	}
	.menu-mobile-toggle__line:before {
		top: 15px;
	}
	.menu-mobile-show .menu-mobile-toggle__line {
		background: transparent;
	}
	.menu-mobile-show .menu-mobile-toggle__line:before {
		top: 0;
		-webkit-transform: rotate(225deg);
		transform: rotate(225deg);
	}
	.menu-mobile-show .menu-mobile-toggle__line:after {
		top: 0;
		-webkit-transform: rotate(-225deg);
		transform: rotate(-225deg);
	}



.block-1 {
	padding: 68px 20px;
	height: auto;
}
.block-1 h2:before {
	height: 50px;
	margin: 0 auto 54px;
	width: 50px;
	background-position: -514px -40px
}
.block-1 h2 {
	font-size: 18px;
	line-height: 24px;
}
.block-1 h2 span {
	font-size: 36px;
	line-height: 46px;
	padding-top: 18px;
}
.block-1 h2:after {
	margin: 42px auto 0;
}
.block-1 p {
	padding: 35px 0;
}
.block-1 .btn{
	font-size: 18px;
	height: 52px;
	line-height: 52px;
	padding: 0;
	width: 260px;
}
.btn.btn--video {
	padding-left: 36px;
}
.btn--video:before {
	left: 8px;
	background-position: -584px -54px !important;
	top: 12px;
}


.block-2 {
	padding: 50px 10px 0;
	text-align: center;
}
.block-2 h2 {
	font-size: 18px;
}
.block-2 p {
	font-size: 36px;
	line-height: 40px;
	padding: 8px 20px;
}
.block-2 p:after {
	margin: 24px auto;
}
.block-2 li {
	float: none !important;
	padding: 2px 0 38px;
	margin: 0 20px !important;
	display: inline-block;
}
.block-2 li:before {
	margin: auto;
}


.block-3 {
	padding: 150px 0 50px;
	text-align: center;
}
.block-3 img {
	float: none;
	margin: 0;
}
.block-3 p {
	font-size: 16px;
	line-height: 30px;
	padding: 40px 20px 0;
}
.block-3 p span {
	display: inline-block;
	float: none;
	padding: 0;
	background: inherit;
	color: inherit;
}

.block-4 {
	padding: 40px;
}
.block-4__img {
	width: 900px;
}
.block-4__img img {
	left: 620px;
	top: 50px;
	width: 250px;
}
.block-4__img img:first-child {
	left: 20px;
}
.block-4 h3 {
	font-size: 30px;
	padding: 17px 0 0;
}
.block-4 p {
	line-height: 25px;
	padding: 0;
}
.block-4 h3::after {
	margin: 20px auto 36px;
}

.block-5 {
	padding-top: 150px;
}
.block-5 h3 {
	font-size: 25px;
	line-height: 40px;
}
.block-5 h3 span {
	font-size: 50px;
	letter-spacing: -1px;
}
.block-5 p {
	padding: 43px 50px;
}


.video-player {
	padding: 50px 0;
	background: #f0f3f6;
}
.video-player__box {
	margin: 0 auto 57px;
	width: 860px;
	height: 588px;
}
.video-player__box iframe{
	width: 860px;
	height: 588px;
}

.block-6:before {
	display: none;
}
.block-6 .center {
	padding-bottom: 0;
}
.block-6__img {
	height: 600px;
}
.block-6__img img {
	width: 600px;
}
.block-6__img img:first-child {
	margin-left: -600px;
}
.block-6__left,
.block-6__right {
	width: 45%;
}
.block-6 h2 span {
	font-size: 36px;
	font-weight: 700;
}

.block-7 h4 {
	padding-top: 150px;
}
.block-7 .btn {
	margin: 50px auto 20px;
	-webkit-transform: translateY(0);
	transform: translateY(0);
}

.block-form {
	height: auto;
	padding: 150px 0 50px;
}
.block-form h2::after {
	margin: 30px auto;
}

}


/* 960
----------------------------------------*/
@media only screen and (max-width:959px){


.hidden-md {
	display: none !important;
}
.center {
	max-width: 768px;
}

.block-2 li {
	float: none !important;
	padding: 2px 0 38px;
	width: 100% !important;
	max-width: 500px;
	margin: auto !important;
}

.block-6__img img:nth-child(2),
.block-6__img:before {
	display: none;
}
.block-6__img img {
	margin: 0 !important;
	width: 100% !important;
	left: 0 !important;
}
.block-6__img--md {
	display: block;
}
.block-6 .center {
	padding: 25px 0 64px;
}
.block-6 .center::before {
	display: none;
}
.block-6__left,
.block-6__right {
	float: none;
	margin: auto;
	width: auto;
	position: static;
	padding: 50px 20px;
}
.block-6__left:before,
.block-6__right:before {
	height: 200px;
	display: block;
	margin: 20px auto;
	content: '';
	background: url(/home/images/block-6_1--md.jpg) center no-repeat;
	background-size: contain;
}
.block-6__right:before {
	background-image: url(/home/images/block-6_2--md.jpg);
}
.block-6__left {
	padding-bottom: 30px;
}
.block-6 h2 {
	text-align: center;
	padding-bottom: 20px;
}
.block-6 h3 {
	font-weight: 700;
	padding-bottom: 0;
}

.block-form {
	padding: 50px 0 50px;
}
.block-6:after,
.block-form:after {
	display: none;
}
.footer{
	padding: 20px;
}

}


/* 768
----------------------------------------*/
@media only screen and (max-width:767px){


.hidden-sm {
	display: none !important;
}
.center {
	max-width: 100%;
	min-width: 300px;
}

.header {
	height: 48px;
}
.header__logo {
	background-position: -510px 0;
	height: 32px;
	top: 8px;
	width: 100px;
}
.menu-mobile-toggle {
	width: 48px;
	height: 48px;
}
.menu-mobile-toggle__line {
	width: 34px;
	height: 3px;
}
.menu-mobile-toggle__line:after,
.menu-mobile-toggle__line:before {
	top: -10px;
	height: 3px;
}
.menu-mobile-toggle__line:before {
	top: 10px;
}

.header__menu {
	padding: 40px 0 10px;
}
.header__menu a {
	color: #000;
	font-size: 16px;
	padding: 10px 0 10px 26px;
	margin: 0;
}
.header .btn {
	margin: 22px 20px;
}

.block-2::before,
.block-6::before,
.block-form::before{
	display: none;
}

.block-1 {
	padding: 20px 10px 40px;
}
.block-1__bg {
	background-position: center !important;
}
.block-1 h2::before {
	margin: 10px auto;
}
.block-1 h2::after {
	margin: 20px auto 0;
}
.block-1 h2 {
	font-size: 16px;
	line-height: 22px;
}
.block-1 h2 span,
.block-2 p {
	font-size: 22px;
	font-weight: 700;
	line-height: 26px;
	padding-top: 10px;
}
.block-1 p {
	font-size: 16px;
	line-height: 20px;
	padding: 24px 0;
}
.block-1 .btn {
	margin: 6px auto;
}

.block-5 {
	padding-top: 280px;
}
.block-5 p {
	padding-bottom: 0;
}

.block-6 .center {
	padding: 0;
}
.block-6 h2 {
	padding-bottom: 12px;
}
.block-2 strong {
	padding: 0 0 10px;
}
.block-6 h2 span {
	font-size: 24px;
	line-height: 30px;
	font-weight: 700;
}
.block-6 p {
	font-size: 16px;
	line-height: 26px;
	padding-bottom: 20px;
}
.block-6 h3 {
	font-size: 20px;
	line-height: 22px;
	padding-bottom: 6px;
}
.block-6 li {
	font-size: 16px;
	line-height: 20px;
	padding-bottom: 10px;
}
.block-6 li::before {
	top: 0;
}

.block-form__box {
	width: 300px;
}
.block-form__box .btn {
	font-size: 18px;
	margin-top: 20px;
}

}
	</style>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&amp;subset=cyrillic" rel="stylesheet">

	<script defer src="/home/js/jquery-3.1.1.min.js"></script>
	<script defer src="/home/js/js.js"></script>

	<script>
		(function (d, w, c) {
			(w[c] = w[c] || []).push(function() {
				try {
					w.yaCounter39779235 = new Ya.Metrika({
						id:39779235,
						clickmap:true,
						trackLinks:true,
						accurateTrackBounce:true,
						webvisor:true
					});
				} catch(e) { }
			});

			var n = d.getElementsByTagName("script")[0],
				s = d.createElement("script"),
				f = function () { n.parentNode.insertBefore(s, n); };
			s.async = true;
			s.src = "https://mc.yandex.ru/metrika/watch.js";

			if (w.opera == "[object Opera]") {
				d.addEventListener("DOMContentLoaded", f, false);
			} else { f(); }
		})(document, window, "yandex_metrika_callbacks");
	</script>

</body>
</html>