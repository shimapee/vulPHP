var checkCommon = (function(){
  /* 定数 */
  const glbRegexYM = /^(?:\d{4}\/\d{1,2})$/;
  const glbRegexYMD =  /^(?:\d{4}\/\d{1,2}\/\d{1,2})$/;
  const glbRegexPost = /^(?:\d{3}\-\d{4})$/;
  const glbRegexTel1 = /^(\(0\d{1,4}\)\d{1,4}-\d{4})$/;
  const glbTel1Max = 13;
  const glbRegexTel2 = /^0(\d{1,4}\-\d{1,4}\-\d{4})$/;
  const glbTel2Max = 12;
  const glbRegexPhone1 = /^(\(0\d{2}\)\d{4}-\d{4})$/;
  const glbPhone1Max = 14;
  const glbRegexPhone2 =/^0(\d{2}\-\d{4}\-\d{4})$/;
  const glbPhone2Max = 13;
  const glbRegexNum6 = /^(?:\d{6})$/;
  const glbRegexNum7 = /^(?:\d{7})$/;
  const glbRegexNum8 = /^(?:\d{8})$/;
  const glbRegexNum9 = /^(?:\d{9})$/;
  const glbRegexNum10 = /^(?:\d{10})$/;
  const glbRegexNum11 = /^(?:\d{11})$/;
  const glbRegex0 = /^0/;
  const glbRegexAt = /@/;
  const glbRegexEscape = /[<>&'"]/g;

  /*
    年月入力チェック
  */
  var chkDateYM = function(data) {
    var splitDate;
    if(glbRegexYM.exec(data) == null) {
      if(glbRegexNum6.exec(data) == null)  {
        return false;
      } else {
        data = data+'';   // 文字列変換
        splitDate = [data.substr(0,4) ,data.substr(4,2)];
      }
    } else {
      splitDate= data.split('/');
    }
    try {
      var resultDate = new Date(splitDate[0], splitDate[1]-1);
      if(resultDate.getFullYear() == splitDate[0] && resultDate.getMonth() == splitDate[1]-1 ) return true;
    } catch (e) {
      console.log(e);
    }
    return false;


  };

  /*
    年月日入力チェック
  */
  var chkDateYMD = function(data) {
    var splitDate;

    if(glbRegexYMD.exec(data) == null) {
      if(glbRegexNum8.exec(data) == null)  {
        return false;
      } else {
        data = data+'';   // 文字列変換
        splitDate = [data.substr(0,4), data.substr(4,2), data.substr(6,2)];
      }
    } else {
      splitDate= data.split('/');
    }
    try {
      if(monthLastDay(splitDate[0], splitDate[1]-1) < splitDate[2]) return false;
      var resultDate = new Date(splitDate[0], splitDate[1]-1, splitDate[2]);
      if(resultDate.getFullYear() == splitDate[0] &&
          resultDate.getMonth() == splitDate[1]-1 &&
          resultDate.getDate() == splitDate[2]) return true;
    } catch(e) {
      console.log(e);
    }
    return false;

  };

  /*
    月日付判定（閏年対応）
    monthはDateのmonth（実月の-1）
  */
  var monthLastDay = function(year, month) {
    var lastDay = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    if(month == 1) {
      if((year % 4 == 0 &&  year % 100 != 0) || year % 400 == 0) {
        return 29;
      }
    }
    return lastDay[month];

  };

  /*
    日付型変換(YYYYMM ⇒ YYYY/MM)
  */
  var convertDateYM = function(data) {
    data = data+'';   // 文字列変換
    if(glbRegexNum6.exec(data) == null) return ''
    if(chkDateYM(data)) return data.substr(0,4)+'/'+data.substr(4,2);
    return '';
  };

  /*
    日付型変換(YYYYMMDD ⇒ YYYY/MM/DD)
  */
  var convertDateYMD = function(data) {
    data = data+'';   // 文字列変換
    if(glbRegexNum8.exec(data) == null) return '';
    if(chkDateYMD(data)) return data.substr(0,4)+'/'+data.substr(4,2)+'/'+data.substr(6,2);
    return '';
  };

  /*
    文字数チェック
    ※ 規定数以内
  */
  var charSizeWithin = function(data, count) {
    data = data + '';
    if(data.length <= count) return true;
    return false;
  };

  /*
    バイト数チェック
    ※ 規定数以内
  */
  var charByteSizeWithin = function(data, count) {
    data = data + '';
    var chkCount = 0;
    for(var i = 0; i < data.length; i++) {
      var charData = escape(data.charAt(i));
      if(charData.length < 4) {
        chkCount++;
      } else {
        chkCount += 2;
      }
      if(count < chkCount) return false;
    }
    return true;

  };

  /*
    文字数チェック
    ※ 規定数等価
  */
  var charSize = function(data, count) {
    data = data + '';
    if(data.length == count) return true;
    return false;
  };

  /*
    バイト数チェック
    ※ 規定数等価
  */
  var charByteSize = function(data, count) {
    data = data + '';
    var chkCount = 0;
    for(var i = 0; i < data.length; i++) {
      var charData = escape(data.charAt(i));
      if(charData.length < 4) {
        chkCount++;
      } else {
        chkCount += 2;
      }
    }
    if(count == chkCount) return true;
    return false;

  };

  /*
    郵便番号チェック
  */
  var chkPostNum = function(data) {
     if(glbRegexPost.exec(data) == null && glbRegexNum7.exec(data) == null) {
        return false;
    }
    return true;
  };

  /*
    電話番号チェック
  */
  var chkTelNum = function(data) {
    data = data + '';
    var
      tel1 = glbRegexTel1.exec(data),
      tel2 = glbRegexTel2.exec(data),
      phone1 = glbRegexPhone1.exec(data),
      phone2 = glbRegexPhone2.exec(data);
    if(tel1 != null && charSize(data, glbTel1Max)) return true;
    if(tel2 != null && charSize(data, glbTel2Max)) return true;
    if(phone1 != null && charSize(data, glbPhone1Max)) return true;
    if(phone2 != null && charSize(data, glbPhone2Max)) return true;
    if(!glbRegex0.test(data)) return false;
    if(glbRegexNum10.exec(data) != null) return true;
    if(glbRegexNum11.exec(data) != null) return true;

    return false;

  };

  /*
    Eメールアドレスチェック
    ※ @の存在のみ
  */
  var chkMailAddr = function(data) {
    if(glbRegexAt.exec(data) != null) return true;
    return false;
  };

  /*
    範囲チェック
    ※ sourceよりsubjectが大きいかをチェック
  */
  var chkContrast = function(source, subject) {
    // 型比較
    if(typeof source !== typeof subject) return false;

    // 日付型かを比較
    if(
      ( chkDateYM(source) || chkDateYMD(source) )
      !==
      ( chkDateYM(subject) || chkDateYMD(subject) )
    ) return false;

    // 範囲チェック
    if(source < subject) return true;
    return false;
  };

  /*
    HTMLエスケープ
  */
  var escapeHtml = function(data) {
    // エスケープ対象マッピング
    var map = {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#x27;'
    };
    return data.replace(glbRegexEscape, function(match){
      return map[match];
    });

  };

  return {
    chkDateYM: chkDateYM,
    chkDateYMD: chkDateYMD,
    monthLastDay: monthLastDay,
    convertDateYM: convertDateYM,
    convertDateYMD: convertDateYMD,
    charSizeWithin: charSizeWithin,
    charByteSizeWithin: charByteSizeWithin,
    charSize: charSize,
    charByteSize: charByteSize,
    chkPostNum: chkPostNum,
    chkTelNum: chkTelNum,
    chkMailAddr: chkMailAddr,
    chkContrast: chkContrast,
    escapeHtml: escapeHtml,
  };
}());
