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
  <meta property="og:url" content="http://mystery-travelagency.com/contact/">
  <meta property="og:image" content="http://mystery-travelagency.com/img/shared/og_image.jpg">
  <meta property="og:site_name" content="いつもの旅行に「謎解き」を加えて謎解きツアー【謎解キ旅行社】">
  <meta property="og:description" content="お問い合わせページです。【謎解キ旅行社】" />
  <link rel="canonical" href="http://mystery-travelagency.com/contact/">
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
      <div id="logo"><a href="http://mystery-travelagency.com/"><img src="{{ asset('/img/shared/logo.svg') }}"
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
            <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a
                href="http://mystery-travelagency.com/" itemprop="item"><span itemprop="name">HOME</span></a>
              <meta itemprop="position" content="1">
            </li>
            <li>お問い合わせ</li>
          </ol>
        </div>
        <h1 id="pageTit">お問い合わせ</h1>
        <p>CONTACT US</p>
      </div>
      <div id="form">
        <dl class="confirm">
          <dt>お名前</dt>
          <dd>{{$data['name']}}</dd>
          <dt>メールアドレス</dt>
          <dd>{{$data['email']}}</dd>
          <dt>電話番号</dt>
          <dd>{{$data['tel']}}</dd>
          <dt>ご用件</dt>
          <dd>{{$data['subject']}}</dd>
          <dt>内容</dt>
          <dd>{!! nl2br(e($data['message'])) !!}</dd>
        </dl>
        <ul class="submitBtn">
          <li>
            <form method="post" action="{{route('contact_thanks')}}">
              @csrf

              <input type="hidden" name="name" id="name" value="{{$data['name']}}">
              <input type="hidden" name="email" id="email" value="{{$data['email']}}">
              <input type="hidden" name="tel" id="tel" value="{{$data['tel']}}">
              <input type="hidden" name="subject" id="subject" value="{{$data['subject']}}">
              <input type="hidden" name="message" id="message" value="{{$data['message']}}">

              <input type="submit" value="送信する">

            </form>
          </li>
          <li>
            <form method="post" action="{{route('contact_fix')}}">
              @csrf
              <input type="hidden" name="name" id="name" value="{{$data['name']}}">
              <input type="hidden" name="email" id="email" value="{{$data['email']}}">
              <input type="hidden" name="tel" id="tel" value="{{$data['tel']}}">
              <input type="hidden" name="subject" id="subject" value="{{$data['subject']}}">
              <input type="hidden" name="message" id="message" value="{{$data['message']}}">
              <input type="submit" value="戻る">
            </form>
          </li>
        </ul>
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
 @include('common.inc.js_after')

  <script>
    $(function () {
  $('form').submit(function () {
    $(this).find(':submit').prop('disabled', 'true');
  });
});
  </script>
</body>

</html>