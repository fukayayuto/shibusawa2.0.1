<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>渋沢栄一の真実ご予約｜いつもの旅行に「謎解き」を加えて謎解きツアー【謎解キ旅行社】</title>
  <meta name="title" content="渋沢栄一の真実ご予約｜いつもの旅行に「謎解き」を加えて謎解きツアー【謎解キ旅行社】" />
  <meta name="description" content="沢栄一の真実予約ページです。【謎解キ旅行社】" />
  <meta name="keywords" content="旅行,謎解き,脱出,ゲーム" />
  <meta property="og:title" content="渋沢栄一の真実ご予約｜いつもの旅行に「謎解き」を加えて謎解きツアー【謎解キ旅行社】">
  <meta property="og:type" content="article">
  <meta property="og:url" content="http://odekake-ashi.com/event/shibusawa/reserve/">
  <meta property="og:image" content="http://odekake-ashi.com/common/img/shared/og_image.jpg">
  <meta property="og:site_name" content="いつもの旅行に「謎解き」を加えて謎解きツアー【謎解キ旅行社】">
  <meta property="og:description" content="渋沢栄一の真実予約ページです。【謎解キ旅行社】" />
  <link rel="canonical" href="http://odekake-ashi.com/event/shibusawa/reserve/">
  <link href="{{ asset('/css/default.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/css/layout.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/css/base.css') }}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">
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
        <li><img src="../../../common/img/shared/sns_twitter.svg" alt="Twitter" /></li>
        <li><img src="../../../common/img/shared/sns_facebook.svg" alt="facebook" /></li>
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
            <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a
                href="http://odekake-ashi.com/" itemprop="item"><span itemprop="name">HOME</span></a>
              <meta itemprop="position" content="1">
            </li>
            <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a
                href="http://odekake-ashi.com/event/shibusawa/" itemprop="item"><span
                  itemprop="name">渋沢栄一の真実</span></a>
              <meta itemprop="position" content="2">
            </li>
            <li>ご予約</li>
          </ol>
        </div>
        <h1 id="pageTit">ご予約</h1>
        <p>RESERVATION</p>
      </div>

      <div id="form">
        <h2>ご予約を承りました。</h2>
        <p>お問合せいただきありがとうございました。<br>
          ご入力いただいた内容につきましては、確認の上、担当者よりお振込みのご案内をお送りいたします。<br>
          今しばらくお待ちくださいませ。<br>
          <br>
          ご入金確認後、弊社よりお送りいたします<span class="bold">【ご予約確定メール】</span>をもって、予約確定とさせていただきます。<br>
          2営業日経っても弊社からのメールが届かない場合は、大変お手数ではございますが、再度お問い合わせの手続きをお願いいたします。
        </p>
        <a href="{{route('shibusawa_reserve')}}" class="blownBtn">ホームに戻る</a>
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
  <script src="{{ asset('/js/common.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>
 @include('common.inc.js_after')
  <script>
    flatpickr.localize(flatpickr.l10ns.ja);
    flatpickr('.calendar input', {
        allowInput: true,
		dateFormat: "Y年m月d日"
    });
  </script>
</body>

</html>