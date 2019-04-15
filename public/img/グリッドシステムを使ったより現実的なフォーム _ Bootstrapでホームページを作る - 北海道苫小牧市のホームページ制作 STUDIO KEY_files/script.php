(function(){
  var referer=(location.href!=parent.location.href)?parent.document.referrer:document.referrer,
  requestUrl=location.protocol+'//'+location.host+location.pathname+location.search,
  userAgent=navigator.userAgent.toLowerCase(),
  browser={
    Version: (userAgent.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [])[1],
    Safari: /webkit/.test(userAgent),
    Opera: /opera/.test(userAgent),
    IE: /msie/.test(userAgent) && !/opera/.test(userAgent),
    Mozilla: /mozilla/.test(userAgent) && !/(compatible|webkit)/.test(userAgent),
    Chrome: /chrome/.test(userAgent)
  },
  RaTracker = function(){
    var t=(new Date()).getTime();
    this.accessTime=t;
    return this;
  };
  RaTracker.prototype = {
    type: {
      Load: '0',
      Click: '1',
      BtnClick: '2',
      Adsense: 'g'
    },
    clickRel: '_RAclick',
    trackingUrl: 'http://studio-key.com/ra/track.php',
    accessTime: null,
    getTitle: function(){
      if(document.getElementById('title')){
        var elmT=document.getElementsByTagName('title')[0];
        return (browser.IE)?elmT.innerHTML:elmT.firstChild.nodeValue;
      }else{
        return document.title;
      }
    },
    getTrackingUrl: function(url,title,referer,type){
      return this.trackingUrl+'?LT='+type
                             +'&RF='+encodeURIComponent(referer)
                             +'&UR='+encodeURIComponent(url)
                             +'&TI='+encodeURIComponent(title)
                             +'&SW='+screen.width
                             +'&SH='+ screen.height
                             +'&SC='+screen.colorDepth
                             +'&s='+Math.floor(Math.random()*100);
    },
    sendServer: function(url,dom){
      if(dom){
        var itemElm=document.getElementById('item');
        var bodyElm=(itemElm)?itemElm:document.getElementsByTagName('body').item(0);
        var scriptElm=document.createElement('script');
        scriptElm.setAttribute('src',url);
        scriptElm.setAttribute('defer','defer');
        bodyElm.appendChild(scriptElm);
        this.wait(0.4);
      }else{
        document.write('<script type="text/javascript" src="'+url+'" defer="defer"></script>');
      }
      return this;
    },
    clickTrack: function(e){
      var url=title=rel='';
      var targetElm=this.getTargetElm(e);
      var targetName=targetElm.nodeName.toLowerCase();
      var clickCheck=function(url,rel,clickRel){
        return (url&&url.match("^(https?|ftp):\/\/")&&(!url.match(location.host)||rel==clickRel))?true:false;
      }
      switch(targetName){
        case 'a':
          url=targetElm.href;
          title=(browser.IE)?targetElm.innerText:targetElm.text;
          rel=(targetElm.rel!==undefined)?targetElm.rel:'';
          if(clickCheck(url,rel,this.clickRel))
            this.sendServer(this.getTrackingUrl(url,title,requestUrl,this.type.Click),true);
          break;
        case 'input':
          if (targetElm.type.toLowerCase() == 'button' || targetElm.type.toLowerCase() == 'submit') {
            url=requestUrl+'#'+targetElm.value;
            title='['+targetElm.value+'] ('+this.getTitle()+')';
            this.sendServer(this.getTrackingUrl(url,title,requestUrl,this.type.BtnClick),true);
          }
          break;
        default:
          if (targetElm.parentNode.href!==undefined) {
            url=targetElm.parentNode.href;
            title=(targetElm.alt!==undefined)?targetElm.alt:((browser.IE)?targetElm.innerText:targetElm.firstChild.nodeValue);
            rel=(targetElm.parentNode.rel!==undefined)?targetElm.parentNode.rel:'';
            if(clickCheck(url,rel,this.clickRel))
              this.sendServer(this.getTrackingUrl(url,title,requestUrl,this.type.Click),true);
          }
          break;
      }
    },
    adsenseElms: new Array(),
    adsenseOnFocus: false,
    adsenseTargetElm: null,
    adsenseTrack: function(){
      if(this.adsenseOnFocus){
        for(var i=0;i<this.adsenseElms.length;i++){
          if(this.adsenseElms[i]==this.adsenseTargetElm){
            var url=encodeURIComponent('Unit='+(i+1)+',Size='+this.adsenseElms[i].width+'x'+this.adsenseElms[i].height);
            this.sendServer(this.getTrackingUrl(url,url,requestUrl,this.type.Adsense),true);
            this.adsenseOnFocus=false;
            break;
          }
        }
      }
    },
    adsenseSearch: function(e){
      var iframeElms=document.getElementsByTagName('iframe');
      var findAd=false; 
      for(var i=0;i<iframeElms.length;i++){
        findAd=false;
        if(iframeElms[i].src.indexOf('googlesyndication.com')>-1||iframeElms[i].src.indexOf('googleads.g.doubleclick.net')>-1)findAd=true;
        if(iframeElms[i].id&&iframeElms[i].id.indexOf('aswift_')>-1&&iframeElms[i].parentNode.tagName.toLowerCase()=='ins'&&iframeElms[i].parentNode.id!==undefined&&iframeElms[i].parentNode.id.indexOf('aswift_')>-1)findAd=true;
        if(findAd){
          this.adsenseElms[this.adsenseElms.length]=iframeElms[i];
          if(browser.IE){
            this.addEvent('focus',RaTracker.transfer.adsenseFocus,iframeElms[i]);
            this.addEvent('blur',RaTracker.transfer.adsenseBlur,iframeElms[i]);
            this.addEvent('beforeunload',RaTracker.transfer.adsenseTrack,window);
          }else{
            this.addEvent('mouseover',RaTracker.transfer.adsenseFocus	,iframeElms[i]);
            this.addEvent('mouseout',RaTracker.transfer.adsenseBlur,iframeElms[i]);
            if(browser.Opera){
              this.addEvent('unload',RaTracker.transfer.adsenseTrack,window);
            }else{
              this.addEvent('beforeunload',RaTracker.transfer.adsenseTrack,window);
            }
          }
        }
      }
    },
    adsenseFocus: function(e){
      this.adsenseOnFocus=true;
      this.adsenseTargetElm=this.getTargetElm(e);
    },
    adsenseBlur: function(){
      this.adsenseOnFocus=false;
      this.adsenseTargetElm=null;
    },
    documentReady: function(callback) {
      if (browser.IE) {
        (function(){
          try {
            document.documentElement.doScroll('left');
          } catch(error) {
            setTimeout(arguments.callee, 0);
            return;
          }
          callback.apply(document);
        })();
      } else {
        if (document.addEventListener) {
          document.addEventListener('DOMContentLoaded',callback,false);
        } else {
          window.attachEvent ? window.attachEvent('onload',callback) : window.addEventListener('load',callback,false);
        }
      }
      return document;
    },
    addEvent: function(e, callback, obj) {
      if ((obj.nodeType !== undefined && (obj.nodeType === 1 || obj.nodeType === 9)) || obj===window) 
        obj.attachEvent ? obj.attachEvent('on'+e,callback) : obj.addEventListener(e,callback,false);
      return obj;
    },
    getTargetElm: function(e) {
      return window.event?window.event.srcElement:e.target;
    },
    wait: function(second){
      var w=(new Date()).getTime()+(second*1000);
      while(true){
        if((new Date()).getTime()>w){return;}
      }
    },
    doTracking: function(){
      this.sendServer(this.getTrackingUrl(requestUrl,this.getTitle(),referer,this.type.Load),false);
      this.addEvent('click',RaTracker.transfer.clickTrack,document);
      if(browser.IE) this.addEvent('contextmenu',RaTracker.transfer.clickTrack,document);
      this.documentReady(RaTracker.transfer.adsenseSearch);
      return this;
    }
  }
  RaTracker.transfer = {
    clickTrack: function(e){__RaTracker.clickTrack(e);},
    adsenseTrack: function(e){__RaTracker.adsenseTrack(e);},
    adsenseSearch: function(e){__RaTracker.adsenseSearch(e);},
    adsenseFocus: function(e){__RaTracker.adsenseFocus(e);},
    adsenseBlur: function(e){__RaTracker.adsenseBlur(e);}
  }
  window.__RaTracker = new RaTracker();
  __RaTracker.doTracking();
})()