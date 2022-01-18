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
<meta property="og:url" content="http://mystery-travelagency.com/event/shibusawa/reserve/">
<meta property="og:image" content="http://mystery-travelagency.com/common/img/shared/og_image.jpg">
<meta property="og:site_name" content="いつもの旅行に「謎解き」を加えて謎解きツアー【謎解キ旅行社】">
<meta property="og:description" content="渋沢栄一の真実予約ページです。【謎解キ旅行社】" />
<link rel="canonical" href="http://mystery-travelagency.com/event/shibusawa/reserve/">
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
    <div id="logo"><a href="http://mystery-travelagency.com/"><img src="{{ asset('/img/shared/logo.svg') }}" alt="謎解キ旅行社" /></div>
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
          <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a href="http://mystery-travelagency.com/" itemprop="item"><span itemprop="name">HOME</span></a>
            <meta itemprop="position" content="1">
          </li>
          <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a href="http://mystery-travelagency.com/event/shibusawa/" itemprop="item"><span itemprop="name">渋沢栄一の真実</span></a>
          <meta itemprop="position" content="2"></li>
          <li>ご予約</li>
        </ol>
      </div>
      <h1 id="pageTit">ご予約</h1>
      <p>RESERVATION</p>
    </div>
	  <div id="form">
		  <dl class="confirm">
			  <dt>参加ツアー</dt>
			  <dd class="tourTit"></dd>
			  <dt>参加日/出発時間</dt>
			  <dd>
        {{$data['tour_date']}} {{$data['departure_h']}}:{{$data['departure_i']}}～</dd>
			  <dt>乗車地</dt>
			  <dd> {{$data['pickup']}} {{$data['pickup_sup']}}</dd>
			  <dt>降車地</dt>
			  <dd>{{$data['drop']}} {{$data['drop_sup']}}</dd>
			  <dt>参加人数</dt>
			  <dd>大人{{$data['adult']}}人 子供(4歳~満12歳){{$data['child']}}人　幼児(0歳~満3歳){{$data['inf']}}人</dd>
			  <dt>代表者を含め、ご参加者の中に20歳以上の方はいらっしゃいますか？</dt>
			  <dd>{{$data['rep_over20']}}</dd>
			  <dt>代表者名(漢字)</dt>
			  <dd>{{$data['rep_name']}}</dd>
			  <dt>代表者名(カナ)</dt>
			  <dd>{{$data['rep_kana']}}</dd>
			  <dt>ご連絡先</dt>
			  <dd>{{$data['tel']}}</dd>
			  <dt>メールアドレス</dt>
			  <dd>{{$data['email']}}</dd>
			  <dt>住所</dt>
			  <dd>{{$data['pref']}}{{$data['address']}}</dd>
			  <dt>お支払方法</dt>
			  <dd>{{$data['payment_method']}}</dd></dl>

			  <ul class="submitBtn">
			    <li>
            <form method="post" action="{{route('shibusawa_reserve_store')}}">
            @csrf
              <input type="hidden" name="tour_date" id="tour_date" value="{{$data['tour_date']}}">
              <input type="hidden" name="departure_h" id="departure_h" value="{{$data['departure_h']}}">
              <input type="hidden" name="departure_i" id="departure_i" value="{{$data['departure_i']}}">
              <input type="hidden" name="pickup" id="pickup" value="{{$data['pickup']}}">
              <input type="hidden" name="pickup_sup" id="pickup_sup" value="{{$data['pickup_sup']}}">
              <input type="hidden" name="drop" id="drop" value="{{$data['drop']}}">
              <input type="hidden" name="drop_sup" id="drop_sup" value="{{$data['drop_sup']}}">
              <input type="hidden" name="adult" id="adult" value="{{$data['adult']}}">
              <input type="hidden" name="child" id="child" value="{{$data['child']}}">
              <input type="hidden" name="inf" id="inf" value="{{$data['inf']}}">
              <input type="hidden" name="rep_over20" id="rep_over20" value="{{$data['rep_over20']}}">
              <input type="hidden" name="rep_name" id="rep_name" value="{{$data['rep_name']}}">
              <input type="hidden" name="rep_kana" id="rep_kana" value="{{$data['rep_kana']}}">
              <input type="hidden" name="tel" id="tel" value="{{$data['tel']}}">
              <input type="hidden" name="email" id="email" value="{{$data['email']}}">
              <input type="hidden" name="pref" id="pref" value="{{$data['pref']}}">
              <input type="hidden" name="address" id="address" value="{{$data['address']}}">
              <input type="hidden" name="payment_method" id="payment_method" value="{{$data['payment_method']}}">
              @if($data['payment_method'] == 'クレジット')
                <input type="submit" value="支払い画面へ" id="submit_btn">
              @else
              <input type="submit" value="予約する" id="submit_btn">
              @endif             
            </form>
          </li>
				  <li>
            <form method="post" action="{{route('shibusawa_fix')}}">
            @csrf
              <input type="hidden" name="tour_date" id="tour_date" value="{{$data['tour_date']}}">
              <input type="hidden" name="departure_h" id="departure_h" value="{{$data['departure_h']}}">
              <input type="hidden" name="departure_i" id="departure_i" value="{{$data['departure_i']}}">
              <input type="hidden" name="pickup" id="pickup" value="{{$data['pickup']}}">
              <input type="hidden" name="pickup_sup" id="pickup_sup" value="{{$data['pickup_sup']}}">
              <input type="hidden" name="drop" id="drop" value="{{$data['drop']}}">
              <input type="hidden" name="drop_sup" id="drop_sup" value="{{$data['drop_sup']}}">
              <input type="hidden" name="adult" id="adult" value="{{$data['adult']}}">
              <input type="hidden" name="child" id="child" value="{{$data['child']}}">
              <input type="hidden" name="inf" id="inf" value="{{$data['inf']}}">
              <input type="hidden" name="rep_over20" id="rep_over20" value="{{$data['rep_over20']}}">
              <input type="hidden" name="rep_name" id="rep_name" value="{{$data['rep_name']}}">
              <input type="hidden" name="rep_kana" id="rep_kana" value="{{$data['rep_kana']}}">
              <input type="hidden" name="tel" id="tel" value="{{$data['tel']}}">
              <input type="hidden" name="email" id="email" value="{{$data['email']}}">
              <input type="hidden" name="pref" id="pref" value="{{$data['pref']}}">
              <input type="hidden" name="address" id="address" value="{{$data['address']}}">
              <input type="hidden" name="payment_method" id="payment_method" value="{{$data['payment_method']}}">
              <input type="hidden" name="terms" id="terms" value="{{$data['terms']}}">

              
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> 
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@include('common.inc.body_after')
<script>
    flatpickr.localize(flatpickr.l10ns.ja);
    flatpickr('.calendar input', {
        allowInput: true,
		dateFormat: "Y年m月d日"
    });
</script>

<script>
  $(function () {
  $('form').submit(function () {
    $(this).find(':submit').prop('disabled', 'true');
  });
});
</script>

<script>
   $(function () {
     var err = <?php echo $err;?>;
     if(err == 1){
      swal('決済に失敗しました。\nお手数ではございますが、もう一度実施をお願い致します。');
     }
});
</script>


</body>
</html>
