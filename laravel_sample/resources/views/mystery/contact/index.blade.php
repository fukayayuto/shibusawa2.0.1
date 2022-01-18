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
  <meta property="og:image" content="http://odekake-ashi.com/img/shared/og_image.jpg">
  <meta property="og:site_name" content="いつもの旅行に「謎解き」を加えて謎解きツアー【謎解キ旅行社】">
  <meta property="og:description" content="お問い合わせページです。【謎解キ旅行社】" />
  <link rel="canonical" href="http://odekake-ashi.com/contact/">
  <link href="{{ asset('/css/default.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/css/layout.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/css/base.css') }}" rel="stylesheet" type="text/css" />
  <style>
    .error {
      color: red;
    }
  </style>
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
            <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a
                href="http://odekake-ashi.com/" itemprop="item"><span itemprop="name">HOME</span></a>
              <meta itemprop="position" content="1">
            </li>
            <li>お問い合わせ</li>
          </ol>
        </div>
        <h1 id="pageTit">お問い合わせ</h1>
        <p>CONTACT US</p>
      </div>
      <div id="form">
        <p>お問い合わせは下記よりご連絡ください。項目は全て<span>必須</span>です。</p>
        <form method="post" action="{{route('contact_confirm')}}">
          @csrf
          <dl>
            <dt>お名前</dt>
            <dd><input type="text" name="name" value="<?php echo $data['name']; ?>" placeholder="例）ナゾトキ タロウ"></dd>
            <dt>メールアドレス</dt>
            <dd><input type="email" name="email" value="<?php echo $data['email']; ?>"
                placeholder="例）agent@nazotoki.com"></dd>
            <dt>電話番号</dt>
            <dd><input type="tel" name="tel" value="<?php echo $data['tel']; ?>" placeholder="例）03-3333-3333"></dd>
            <dt>ご用件</dt>
            <dd class="icoSelect">
              <select name="subject">
                <?php foreach(array('ご予約について','サイトについて','謎解きツアーについて','エージェント募集について','その他') as $subject):?>
                <option value="<?php echo $subject;?>" <?php if($data['subject']===$subject){ echo 'selected' ;}?>>
                  <?php echo $subject;?>
                </option>
                <?php endforeach;?>
              </select>
            </dd>
            <dt>内容</dt>
            <dd><textarea rows="5" name="message"><?php echo $data['message']; ?></textarea></dd>
          </dl>
          <ul class="submitBtn">
            <li>
              <input type="submit" value="確認画面へ進む">
            </li>
          </ul>
        </form>
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
    $('form').validate({
		rules: {
			name: {
				required: true,
			},
			tel: {
				required: true,
			},
			email: {
				required: true,
			},
			subject: {
				required: true,
			},
			message: {
				required: true,
			},
		},
		messages: {
			name: {
				required: 'お名前は必須です。'
			},
			tel: {
				required: '電話番号は必須です。'
			},
			email: {
				required: 'メールアドレスは必須です。'
			},
			subject: {
				required: 'ご用件は必須です。'
			},
			message: {
				required: '内容は必須です。'
			},
		}
  });
  </script>
</body>

</html>