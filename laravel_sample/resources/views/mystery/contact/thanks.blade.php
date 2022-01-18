<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>お問い合わせ｜いつもの旅行に「謎解き」を加えて謎解きツアー【謎解キ旅行社】</title>
<meta name="title" content="お問い合わせ｜いつもの旅行に「謎解き」を加えて謎解きツアー【謎解キ旅行社】" />
<meta name="description" content="お問い合わせページです。【謎解キ旅行社】" />
<meta name="keywords" content="旅行,謎解き,脱出,ゲーム" />
<meta property="og:title" content="お問い合わせ｜いつもの旅行に「謎解き」を加えて謎解きツアー【謎解キ旅行社】">
<meta property="og:type" content="article">
<meta property="og:url" content="http://odekake-ashi.com/contact/">
<meta property="og:image" content="http://odekake-ashi.com/common/img/shared/og_image.jpg">
<meta property="og:site_name" content="いつもの旅行に「謎解き」を加えて謎解きツアー【謎解キ旅行社】">
<meta property="og:description" content="お問い合わせページです。【謎解キ旅行社】" />
<link rel="canonical" href="http://odekake-ashi.com/contact/">
<link href="{{ asset('/css/default.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/css/layout.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/css/base.css') }}" rel="stylesheet" type="text/css" />
<script>
  (function(d) {
    var config = {
      kitId: 'etc6qrd',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>
@include('common.inc.head_before')
</head>

<body id="base">
  @include('common.inc.body_after')
<div id="wrapper"> 
  <!-- header// -->
  <header>
    <div id="logo"><a href="http://odekake-ashi.com/"><img src="{{ asset('/img/shared/logo.svg') }}"
      alt="謎解キ旅行社" /></div>    
      <div id="global">
      <!--<ul id="sns">
        <li><img src="../common/img/shared/sns_twitter.svg" alt="Twitter" /></li>
        <li><img src="../common/img/shared/sns_facebook.svg" alt="facebook" /></li>
      </ul>-->
      <div class="navTrigger"><span>&nbsp;</span></div>
      <nav>
        <ul>
          <li><a href="/about/">謎解キ旅行社について</a></li>
          <li><a href="#topTour">ツアー 一覧</a></li>
          <li><a href="/faq/">よくある質問</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <!-- //header --> 
  <!-- main// -->
  <main>
    <div id="bodyHead">
      <div id="breadCrumbs">
        <ol itemscope="" itemtype="https://schema.org/BreadcrumbList">
          <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a href="http://odekake-ashi.com/" itemprop="item"><span itemprop="name">HOME</span></a>
            <meta itemprop="position" content="1">
          </li>
          <li>お問い合わせ</li>
        </ol>
      </div>
      <h1 id="pageTit">お問い合わせ</h1>
      <p>CONTACT US</p>
    </div>
	  <div id="form">
		  <h2>送信が完了しました。</h2>
		  <p>お問合せいただきありがとうございました。<br>
ご入力いただいた内容につきましては、確認の上、担当者よりご連絡いたします。<br>
今しばらくお待ちくださいませ。<br>
<br>
なお、ご入力いただいたメールアドレス宛に受付完了メールを配信しております。<br>
完了メールが届かない場合、処理が正常に行われていない可能性があります。<br>
大変お手数ですが、再度お問い合わせの手続きをお願い致します。</p>
		  <a href="" class="blownBtn">ホームに戻る</a>
	  </div>
  </main>
  <!-- //main --> 
  <!-- footer// -->
 @include('common.inc.base_footer')
  <!-- //footer --> 
</div>

<!-- js --> 
<script src="{{ asset('/js/jquery-2.2.0.min.js') }}"></script>
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
@include('common.inc.body_after')
</body>
</html>
